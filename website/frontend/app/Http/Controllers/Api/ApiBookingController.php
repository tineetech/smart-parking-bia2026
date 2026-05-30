<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pemesanan;
use App\Models\SlotParkir;
use App\Models\Pembayaran;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class ApiBookingController extends Controller
{
    /**
     * Konstanta toleransi waktu (menit)
     * IoT boleh trigger selesai maksimal 10 menit SETELAH waktu_selesai
     */
    const TOLERANSI_MENIT = 10;

    /**
     * Hit dari IoT untuk menyelesaikan sesi parkir
     * 
     * 
     * Query Params:
     *   - kode_slot     : string (kode slot parkir, misal "A-01") [wajib]
     *   - kode_pemesanan: string (opsional, untuk validasi lebih ketat)
     */
    public function selesai(Request $request): JsonResponse
    {
        $request->validate([
            'kode_slot'      => 'required|string',
            'kode_pemesanan' => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {
            // 1. Temukan slot parkir berdasarkan kode_slot atau id_sensor
            $slotParkir = $this->temukanSlot($request);

            if (!$slotParkir) {
                return $this->errorResponse('Slot parkir tidak ditemukan.', 404);
            }

            // 2. Temukan pemesanan aktif/running pada slot tersebut
            $pemesanan = $this->temukanPemesananAktif($slotParkir, $request->kode_pemesanan);

            if (!$pemesanan) {
                return $this->errorResponse(
                    'Tidak ada pemesanan aktif atau sedang berjalan pada slot ini.',
                    404
                );
            }

            // 3. Validasi waktu: cek apakah masih dalam toleransi 10 menit
            $now            = Carbon::now();
            $waktuSelesai   = Carbon::parse($pemesanan->waktu_selesai);
            $selisihMenit   = $now->diffInMinutes($waktuSelesai, false); 
            // positif  = waktu_selesai masih di masa depan (belum habis)
            // negatif  = waktu_selesai sudah lewat (kadaluarsa)

            $menitKeterlambatan = $waktuSelesai->diffInMinutes($now, false);
            // positif = sudah berapa menit melewati waktu_selesai

            // Jika sudah melewati waktu_selesai lebih dari TOLERANSI_MENIT menit
            if ($menitKeterlambatan > self::TOLERANSI_MENIT) {
                return $this->tanganiKeterlambatan($pemesanan, $slotParkir, $menitKeterlambatan, $now);
            }

            // 4. Update: status pemesanan → selesai, slot → tersedia
            $pemesanan->update([
                'status'        => 'selesai',
                'waktu_selesai' => $now, // update waktu selesai aktual dari IoT
            ]);

            $slotParkir->update([
                'status'              => 'tersedia',
                
            ]);

            DB::commit();

            Log::info('IoT: Pemesanan selesai', [
                'kode_pemesanan' => $pemesanan->kode_pemesanan,
                'slot'           => $slotParkir->kode_slot,
                'waktu_selesai'  => $now->toDateTimeString(),
            ]);

            return $this->successResponse('Pemesanan berhasil diselesaikan.', [
                'kode_pemesanan' => $pemesanan->kode_pemesanan,
                'slot'           => $slotParkir->kode_slot,
                'waktu_selesai'  => $now->toDateTimeString(),
                'status_pemesanan' => 'selesai',
                'status_slot'      => 'tersedia',
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('IoT: Gagal menyelesaikan pemesanan', [
                'error'   => $e->getMessage(),
                'request' => $request->all(),
            ]);

            return $this->errorResponse('Terjadi kesalahan internal. Silakan coba lagi.', 500);
        }
    }

    // -------------------------------------------------------------------------
    // Private helpers
    // -------------------------------------------------------------------------

    /**
     * Temukan slot parkir dari request berdasarkan kode_slot
     */
    private function temukanSlot(Request $request): ?SlotParkir
    {
        return SlotParkir::where('kode_slot', $request->kode_slot)->first();
    }

    /**
     * Temukan pemesanan aktif atau running pada slot yang diberikan
     */
    private function temukanPemesananAktif(SlotParkir $slot, ?string $kodePemesanan): ?Pemesanan
    {
        $query = Pemesanan::where('slot_id', $slot->id)
            ->whereIn('status', ['aktif', 'running'])
            ->orderBy('waktu_mulai', 'desc');

        if ($kodePemesanan) {
            $query->where('kode_pemesanan', $kodePemesanan);
        }

        return $query->first();
    }

    /**
     * Tangani kasus di mana kendaraan melewati batas waktu > 10 menit.
     * 
     * Logika:
     *  - Buat pemesanan baru sebagai "tagihan tambahan" (status menunggu)
     *  - Selesaikan pemesanan lama
     *  - Set slot kembali tersedia
     *  - Kembalikan response dengan pesan wajib selesaikan di aplikasi
     */
    private function tanganiKeterlambatan(
        Pemesanan $pemesananLama,
        SlotParkir $slot,
        int $menitKeterlambatan,
        Carbon $now
    ): JsonResponse {
        // Hitung tagihan tambahan berdasarkan tarif per jam dari pemesanan asli
        $tagihanTambahan = $this->hitungTagihanTambahan($pemesananLama, $menitKeterlambatan);

        // Buat pemesanan baru sebagai tagihan tambahan
        $pemesananBaru = Pemesanan::create([
            'user_id'       => $pemesananLama->user_id,
            'slot_id'       => $pemesananLama->slot_id,
            'kendaraan_id'  => $pemesananLama->kendaraan_id,
            'kode_pemesanan'=> $this->generateKodePemesanan(),
            'waktu_mulai'   => $pemesananLama->waktu_selesai, // dimulai dari batas waktu asli
            'waktu_selesai' => $now,
            'durasi_parkir' => $menitKeterlambatan,
            'total_harga'   => $tagihanTambahan,
            'status'        => 'menunggu', // wajib diselesaikan di aplikasi
            'catatan'       => sprintf(
                'TAGIHAN TAMBAHAN: Kendaraan melebihi batas waktu %d menit dari pemesanan %s. '
                . 'Tagihan ini harus segera diselesaikan di aplikasi.',
                $menitKeterlambatan,
                $pemesananLama->kode_pemesanan
            ),
        ]);

        // Selesaikan pemesanan lama
        $pemesananLama->update([
            'status'        => 'selesai',
            'waktu_selesai' => Carbon::parse($pemesananLama->waktu_selesai), // tetap waktu asli
        ]);

        // Bebaskan slot parkir
        $slot->update([
            'status'              => 'tersedia',
            
        ]);

        DB::commit();

        Log::warning('IoT: Pemesanan melewati batas waktu, tagihan tambahan dibuat', [
            'pemesanan_lama'  => $pemesananLama->kode_pemesanan,
            'pemesanan_baru'  => $pemesananBaru->kode_pemesanan,
            'menit_keterlambatan' => $menitKeterlambatan,
            'tagihan_tambahan'    => $tagihanTambahan,
        ]);

        return response()->json([
            'success' => false,
            'code'    => 'TAGIHAN_TAMBAHAN',
            'message' => 'Kendaraan melewati batas waktu parkir lebih dari ' . self::TOLERANSI_MENIT
                . ' menit. Tagihan tambahan telah dibuat dan HARUS segera diselesaikan di aplikasi.',
            'data' => [
                'pemesanan_sebelumnya' => [
                    'kode_pemesanan' => $pemesananLama->kode_pemesanan,
                    'status'         => 'selesai',
                ],
                'tagihan_tambahan' => [
                    'kode_pemesanan'     => $pemesananBaru->kode_pemesanan,
                    'durasi_menit'       => $menitKeterlambatan,
                    'total_tagihan'      => $tagihanTambahan,
                    'status'             => 'menunggu',
                    'catatan'            => $pemesananBaru->catatan,
                    'wajib_diselesaikan' => true,
                ],
                'slot' => [
                    'kode_slot' => $slot->kode_slot,
                    'status'    => 'tersedia',
                ],
            ],
        ], 402); // 402 Payment Required
    }

    /**
     * Hitung tagihan tambahan berdasarkan total_harga & durasi_parkir asli (per menit)
     */
    private function hitungTagihanTambahan(Pemesanan $pemesanan, int $menitKeterlambatan): float
    {
        if (!$pemesanan->durasi_parkir || $pemesanan->durasi_parkir <= 0) {
            // Fallback: pakai tarif flat jika durasi tidak ada
            return 0;
        }

        $tarifPerMenit = $pemesanan->total_harga / $pemesanan->durasi_parkir;

        return round($tarifPerMenit * $menitKeterlambatan);
    }

    /**
     * Generate kode pemesanan unik untuk tagihan tambahan
     */
    private function generateKodePemesanan(): string
    {
        do {
            $kode = 'PKR-' . strtoupper(substr(uniqid(), -6)) . '-' . rand(100, 999);
        } while (Pemesanan::where('kode_pemesanan', $kode)->exists());

        return $kode;
    }

    private function successResponse(string $message, array $data = []): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data'    => $data,
        ], 200);
    }

    private function errorResponse(string $message, int $status = 400): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message,
        ], $status);
    }
}