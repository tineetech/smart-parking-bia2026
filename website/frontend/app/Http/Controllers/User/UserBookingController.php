<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\LokasiParkir;
use App\Models\Pemesanan;
use App\Models\Pembayaran;
use App\Models\SlotParkir;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class UserBookingController extends Controller
{
    public function index(LokasiParkir $lokasi)
    {
        return view('pages.user.lokasi-booking', compact('lokasi'));
    }

    public function storeBooking(Request $request)
    {
        $request->validate([
            'lokasi_parkir_id' => ['required', 'exists:lokasi_parkir,id'],
            'slot_id'          => ['required', 'exists:slot_parkir,id'],
            'kendaraan_id'     => ['required', 'exists:kendaraan,id'],
            'jam_mulai'        => ['required', 'date_format:H:i'],
            'durasi'           => ['required', 'integer', 'min:1', 'max:24'],
            'metode_bayar'     => ['required', 'in:bca,qris,gopay,ovo,dana'],
        ]);

        $user = Auth::user();

        // ── Cek apakah user punya pemesanan yang belum selesai ──
        $adaPemesananAktif = Pemesanan::where('user_id', $user->id)
            ->whereIn('status', ['menunggu', 'aktif'])
            ->exists();

        if ($adaPemesananAktif) {
            return redirect()->back()
                ->with('error', 'Kamu masih memiliki pemesanan yang aktif atau menunggu pembayaran. Selesaikan terlebih dahulu sebelum membuat booking baru.')
                ->withInput();
        }

        // ── Cek pembayaran yang masih menunggu ──
        $adaPembayaranMenunggu = Pembayaran::whereHas('pemesanan', fn($q) => $q->where('user_id', $user->id))
            ->where('status', 'menunggu')
            ->exists();

        if ($adaPembayaranMenunggu) {
            return redirect()->back()
                ->with('error', 'Kamu masih memiliki tagihan yang belum dibayar. Selesaikan pembayaran terlebih dahulu.')
                ->withInput();
        }

        // ── Ambil slot & pastikan masih tersedia (lock untuk cegah race condition) ──
        $slot = SlotParkir::where('id', $request->slot_id)
            ->where('status', 'tersedia')
            ->lockForUpdate()
            ->firstOrFail();

        $lokasi   = $slot->lokasiParkir;
        $durasi   = (int) $request->durasi;
        $hargaJam = $lokasi->harga_per_jam;

        // ── Hitung waktu & harga ──
        $today        = Carbon::today();
        $waktuMulai   = Carbon::parse($today->toDateString() . ' ' . $request->jam_mulai);
        $waktuSelesai = $waktuMulai->copy()->addHours($durasi);
        $subtotal     = $hargaJam * $durasi;
        $ppn          = (int) round($subtotal * 0.10);
        $totalHarga   = $subtotal + $ppn;
        
        // Ambil kode unik lokasi
        $kodeLokasi = strtoupper($lokasi->kode_unik);
        $count = \App\Models\Pemesanan::whereDate('created_at', today())->count();
        $nomor = str_pad($count + 1, 4, '0', STR_PAD_LEFT);
        $tanggal = $today->format('dmY');
        $kodePemesanan = "{$kodeLokasi}-{$nomor}-{$tanggal}";

        DB::beginTransaction();

        try {
            $pemesanan = Pemesanan::create([
                'user_id'        => $user->id,
                'slot_id'        => $slot->id,
                'kendaraan_id'   => $request->kendaraan_id,
                'kode_pemesanan' => $kodePemesanan,
                'waktu_mulai'    => $waktuMulai,
                'waktu_selesai'  => $waktuSelesai,
                'durasi_parkir'  => $durasi,
                'total_harga'    => $totalHarga,
                'status'         => 'menunggu',
            ]);

            Pembayaran::create([
                'pemesanan_id' => $pemesanan->id,
                'jumlah'       => $totalHarga,
                'metode'       => $request->metode_bayar,
                'status'       => 'menunggu',
            ]);

            // $slot->update(['status' => 'terisi']);

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::info('Gagal buat booking', [
                'error' => $e,
            ]);
            return redirect()->back()
                ->with('error', 'Gagal membuat pemesanan. Silakan coba lagi.')
                ->withInput();
        }

        return redirect()->route('user.pembayaran.show', $pemesanan->id)
            ->with('success', 'Pemesanan berhasil dibuat!');
    }

    // ── Halaman konfirmasi pembayaran ──────────────────────────────────────

    public function showPembayaran(Pemesanan $pemesanan)
    {
        // Pastikan hanya pemilik yang bisa akses
        abort_if($pemesanan->user_id !== Auth::id(), 403);

        $pemesanan->load(['slotParkir.lokasiParkir', 'kendaraan', 'pembayaran']);

        // Generate Midtrans Snap Token untuk metode selain BCA
        $snapToken = null;
        $pembayaran = $pemesanan->pembayaran;

        if ($pembayaran && $pembayaran->status === 'menunggu' && $pembayaran->metode !== 'bca') {
            $snapToken = $this->getMidtransSnapToken($pemesanan);
        }

        return view('pages.user.lokasi-booking-confirm', compact('pemesanan', 'snapToken'));
    }

    // ── Buat BCA Virtual Account (dipanggil via AJAX) ──────────────────────

    public function createBcaVA(Request $request)
    {
        $request->validate(['pemesanan_id' => ['required', 'exists:pemesanan,id']]);

        $pemesanan = Pemesanan::with('pembayaran')->findOrFail($request->pemesanan_id);
        abort_if($pemesanan->user_id !== Auth::id(), 403);

        try {
            \Midtrans\Config::$serverKey    = config('midtrans.server_key');
            \Midtrans\Config::$isProduction = config('midtrans.is_production', false);
            \Midtrans\Config::$isSanitized  = true;
            \Midtrans\Config::$is3ds        = true;

            $params = [
                'payment_type' => 'bank_transfer',
                'transaction_details' => [
                    'order_id'     => $pemesanan->kode_pemesanan,
                    'gross_amount' => $pemesanan->total_harga,
                ],
                'bank_transfer' => ['bank' => 'bca'],
                'customer_details' => [
                    'first_name' => Auth::user()->name,
                    'email'      => Auth::user()->email,
                ],
            ];

            $response  = \Midtrans\CoreApi::charge($params);
            $vaNumber  = $response->va_numbers[0]->va_number ?? null;
            $expiredAt = $response->expiry_time ?? now()->addDay()->format('d M Y, H:i');

            // Simpan referensi VA
            $pemesanan->pembayaran()->update([
                'referensi_pembayaran' => $vaNumber,
            ]);

            return response()->json([
                'success'    => true,
                'va_number'  => $vaNumber,
                'expired_at' => $expiredAt,
            ]);
        } catch (\Throwable $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    // ── Cek status pembayaran (polling dari frontend) ──────────────────────

    public function checkStatus(Request $request)
    {
        $request->validate(['pemesanan_id' => ['required', 'exists:pemesanan,id']]);

        $pemesanan = Pemesanan::with('pembayaran')->findOrFail($request->pemesanan_id);
        abort_if($pemesanan->user_id !== Auth::id(), 403);

        // Cek status ke Midtrans langsung
        try {
            \Midtrans\Config::$serverKey    = config('midtrans.server_key');
            \Midtrans\Config::$isProduction = config('midtrans.is_production', false);

            $status = \Midtrans\Transaction::status($pemesanan->kode_pemesanan);

            if (in_array($status->transaction_status, ['settlement', 'capture'])) {
                $this->markAsPaid($pemesanan);
                return response()->json(['status' => 'sukses']);
            }

            if ($status->transaction_status === 'expire') {
                return response()->json(['status' => 'gagal']);
            }
        } catch (\Throwable $e) {
            // Jika Midtrans error, return status dari DB
        }

        return response()->json(['status' => $pemesanan->pembayaran?->status ?? 'menunggu']);
    }

    // ── Midtrans Webhook / Notification callback ───────────────────────────

    public function midtransCallback(Request $request)
    {
        \Midtrans\Config::$serverKey    = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production', false);

        $notif  = new \Midtrans\Notification();
        $status = $notif->transaction_status;
        $type   = $notif->payment_type;
        $fraud  = $notif->fraud_status ?? null;
        $orderId = $notif->order_id;

        $pemesanan = Pemesanan::where('kode_pemesanan', $orderId)
            ->with('pembayaran')
            ->first();

        if (!$pemesanan) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        if ($status === 'capture') {
            $bayar = $fraud === 'accept' ? 'sukses' : 'menunggu';
        } elseif ($status === 'settlement') {
            $bayar = 'sukses';
        } elseif (in_array($status, ['cancel', 'deny', 'expire'])) {
            $bayar = 'gagal';
        } else {
            $bayar = 'menunggu';
        }

        if ($bayar === 'sukses') {
            $this->markAsPaid($pemesanan);
        } elseif ($bayar === 'gagal') {
            $pemesanan->update(['status' => 'batal']);
            $pemesanan->slotParkir()->update(['status' => 'tersedia']);
            $pemesanan->pembayaran()->update(['status' => 'gagal']);
        }

        return response()->json(['message' => 'OK']);
    }

    // ── Callback dari frontend setelah Snap sukses (QRIS / e-wallet) ───────

    public function frontendCallback(Request $request)
    {
        $request->validate([
            'pemesanan_id'   => ['required', 'exists:pemesanan,id'],
            'transaction_id' => ['required', 'string'],
            'payment_type'   => ['required', 'string'],
            'status'         => ['required', 'string'],
        ]);

        $pemesanan = Pemesanan::findOrFail($request->pemesanan_id);
        abort_if($pemesanan->user_id !== Auth::id(), 403);

        if ($request->status === 'sukses') {
            $this->markAsPaid($pemesanan, $request->transaction_id);
        }

        return response()->json(['message' => 'OK']);
    }

    // ── Helper: tandai pemesanan lunas ─────────────────────────────────────

    private function markAsPaid(Pemesanan $pemesanan, ?string $referensi = null): void
    {
        DB::transaction(function () use ($pemesanan, $referensi) {
            $pemesanan->update(['status' => 'aktif']);

            $pemesanan->pembayaran()->update([
                'status'               => 'sukses',
                'dibayar_pada'         => now(),
                'referensi_pembayaran' => $referensi ?? $pemesanan->pembayaran?->referensi_pembayaran,
            ]);

            $pemesanan->slotParkir()->update(['status' => 'terisi']);
            // Slot sudah ditandai tidak_tersedia saat booking, biarkan sampai selesai
        });
    }

    // ── Helper: generate Midtrans Snap Token ───────────────────────────────

    private function getMidtransSnapToken(Pemesanan $pemesanan): ?string
    {
        try {
            \Midtrans\Config::$serverKey    = config('midtrans.server_key');
            \Midtrans\Config::$isProduction = config('midtrans.is_production', false);
            \Midtrans\Config::$isSanitized  = true;
            \Midtrans\Config::$is3ds        = true;

            $params = [
                'transaction_details' => [
                    'order_id'     => $pemesanan->kode_pemesanan,
                    'gross_amount' => $pemesanan->total_harga,
                ],
                'customer_details' => [
                    'first_name' => $pemesanan->user->name,
                    'email'      => $pemesanan->user->email,
                ],
                // 'enabled_payments' => $this->getMidtransPaymentType($pemesanan->pembayaran?->metode),
            ];

            return \Midtrans\Snap::getSnapToken($params);
        } catch (\Throwable $e) {
            return null;
        }
    }

    private function getMidtransPaymentType(?string $metode): array
    {
        return match ($metode) {
            'qris'  => ['qris'],
            'gopay' => ['gopay'],
            'ovo'   => ['other_qris'],
            'dana'  => ['other_qris'],
            default => ['qris', 'gopay', 'other_qris'],
        };
    }

    public function paymentSuccess(Pembayaran $pembayaran) {
        abort_if($pembayaran->pemesanan->user_id !== Auth::id(), 403);

        $pembayaran->load([
            'pemesanan.slotParkir.lokasiParkir',
            'pemesanan.kendaraan',
        ]);

        return view('pages.user.payment-sukses', compact('pembayaran'));
    }

    public function qrShow(Pemesanan $pemesanan)
    {
        abort_if($pemesanan->user_id !== Auth::id(), 403);

        $pemesanan->load(['slotParkir.lokasiParkir', 'kendaraan', 'pembayaran']);

        return view('pages.user.booking-qr', compact('pemesanan'));
    }
}