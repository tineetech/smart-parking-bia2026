<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AllSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    function generateKodePemesanan($lokasiId)
    {
        $lokasi = DB::table('lokasi_parkir')->find($lokasiId);

        // Ambil kode unik lokasi
        $kodeLokasi = strtoupper($lokasi->kode_unik);

        // Total booking hari ini
        $count = DB::table('pemesanan')
            ->whereDate('created_at', today())
            ->count();

        // Format nomor urut
        $nomor = str_pad($count + 1, 4, '0', STR_PAD_LEFT);

        // Format tanggal
        $tanggal = now()->format('dmY');

        // Hasil akhir
        return "{$kodeLokasi}-{$nomor}-{$tanggal}";
    }

    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | USERS
        |--------------------------------------------------------------------------
        */

        $adminId = DB::table('users')->insertGetId([
            'name' => 'Admin',
            'email' => 'superadmin@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('admin'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $userId = DB::table('users')->insertGetId([
            'name' => 'Justine',
            'email' => 'justine@gmail.com',
            'jenis_kelamin' => 'laki',
            'tanggal_lahir' => '2009-06-06',
            'alamat' => 'JL RAYA TAJUR',
            'role' => 'user',
            'password' => Hash::make('justin123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        /*
        |--------------------------------------------------------------------------
        | LOKASI PARKIR
        |--------------------------------------------------------------------------
        */

        $lokasiId = DB::table('lokasi_parkir')->insertGetId([
            'kode_unik' => 'POB',
            'nama' => 'Parkify Office Bogor',
            'alamat' => 'Jl. Raya Bogor No. 123',
            'latitude' => -6.6408366,
            'longitude' => 106.8244098,
            'total_slot' => 2,
            'harga_per_jam' => 5000,
            'jam_buka' => '06:00:00',
            'jam_tutup' => '23:00:00',
            'aktif' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        /*
        |--------------------------------------------------------------------------
        | SENSOR
        |--------------------------------------------------------------------------
        */

        $sensorId = DB::table('sensor')->insertGetId([
            'nama_sensor' => 'Ultrasonic A01',
            'status' => 'tersedia',
            'jarak_cm' => 120,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $sensorId2 = DB::table('sensor')->insertGetId([
            'nama_sensor' => 'Ultrasonic A02',
            'status' => 'tersedia',
            'jarak_cm' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        /*
        |--------------------------------------------------------------------------
        | SLOT PARKIR
        |--------------------------------------------------------------------------
        */

        $slotId = DB::table('slot_parkir')->insertGetId([
            'lokasi_parkir_id' => $lokasiId,
            'kode_slot' => 'A-01',
            'lantai' => '1',
            'zona' => 'A',
            'jenis_slot' => 'reguler',
            'status' => 'terisi',
            'id_sensor' => $sensorId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('slot_parkir')->insertGetId([
            'lokasi_parkir_id' => $lokasiId,
            'kode_slot' => 'A-02',
            'lantai' => '1',
            'zona' => 'A',
            'jenis_slot' => 'reguler',
            'status' => 'tersedia',
            'id_sensor' => $sensorId2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        /*
        |--------------------------------------------------------------------------
        | KENDARAAN
        |--------------------------------------------------------------------------
        */

        $kendaraanId = DB::table('kendaraan')->insertGetId([
            'user_id' => $userId,
            'plat_nomor' => 'F 9833 BBX',
            'merek' => 'Toyota',
            'model' => 'Avanza',
            'warna' => 'Hitam',
            'jenis' => 'mobil',
            'utama' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        /*
        |--------------------------------------------------------------------------
        | PEMESANAN
        |--------------------------------------------------------------------------
        */

        $pemesananId = DB::table('pemesanan')->insertGetId([
            'user_id' => $userId,
            'slot_id' => $slotId,
            'kendaraan_id' => $kendaraanId,
            'kode_pemesanan' => $this->generateKodePemesanan($lokasiId),
            'waktu_mulai' => Carbon::now(),
            'waktu_selesai' => Carbon::now()->addHours(2),
            'durasi_parkir' => 2,
            'total_harga' => 2000,
            'status' => 'aktif',
            'catatan' => 'Parkir lantai 1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        /*
        |--------------------------------------------------------------------------
        | PEMBAYARAN
        |--------------------------------------------------------------------------
        */

        DB::table('pembayaran')->insert([
            'pemesanan_id' => $pemesananId,
            'jumlah' => 10000,
            'metode' => 'qris',
            'status' => 'sukses',
            'referensi_pembayaran' => 'PAY-001',
            'dibayar_pada' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}