<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AllSeeder extends Seeder
{
    /**
     * Generate kode pemesanan berdasarkan lokasi.
     */
    function generateKodePemesanan($lokasiId, $offset = 0)
    {
        $lokasi = DB::table('lokasi_parkir')->find($lokasiId);
        $kodeLokasi = strtoupper($lokasi->kode_unik);

        $count = DB::table('pemesanan')
            ->whereDate('created_at', today())
            ->count();

        $nomor   = str_pad($count + 1 + $offset, 4, '0', STR_PAD_LEFT);
        $tanggal = now()->format('dmY');

        return "{$kodeLokasi}-{$nomor}-{$tanggal}";
    }

    public function run(): void
    {
        // ============================================================
        // USERS
        // ============================================================

        $adminId = DB::table('users')->insertGetId([
            'name'       => 'Admin',
            'email'      => 'superadmin@gmail.com',
            'role'       => 'admin',
            'password'   => Hash::make('admin'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // User lama (tetap seperti semula)
        $userId = DB::table('users')->insertGetId([
            'name'           => 'Justine',
            'email'          => 'justine@gmail.com',
            'jenis_kelamin'  => 'laki',
            'tanggal_lahir'  => '2009-06-06',
            'alamat'         => 'JL RAYA TAJUR',
            'role'           => 'user',
            'password'       => Hash::make('justin123'),
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);

        // 3 Dummy users tambahan
        $dummyUser1Id = DB::table('users')->insertGetId([
            'name'           => 'Budi Santoso',
            'email'          => 'budi@gmail.com',
            'jenis_kelamin'  => 'laki',
            'tanggal_lahir'  => '1995-03-15',
            'alamat'         => 'Jl. Pajajaran No. 45, Bogor',
            'role'           => 'user',
            'password'       => Hash::make('budi1234'),
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);

        $dummyUser2Id = DB::table('users')->insertGetId([
            'name'           => 'Siti Rahayu',
            'email'          => 'siti@gmail.com',
            'jenis_kelamin'  => 'perempuan',
            'tanggal_lahir'  => '1998-07-22',
            'alamat'         => 'Jl. Cendana No. 12, Bogor',
            'role'           => 'user',
            'password'       => Hash::make('siti1234'),
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);

        $dummyUser3Id = DB::table('users')->insertGetId([
            'name'           => 'Rizky Pratama',
            'email'          => 'rizky@gmail.com',
            'jenis_kelamin'  => 'laki',
            'tanggal_lahir'  => '2000-11-08',
            'alamat'         => 'Jl. Sudirman No. 78, Bogor',
            'role'           => 'user',
            'password'       => Hash::make('rizky1234'),
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);

        // ============================================================
        // KENDARAAN (untuk dummy users)
        // ============================================================

        $kendaraan1Id = DB::table('kendaraan')->insertGetId([
            'user_id'    => $userId,
            'plat_nomor' => 'F 9833 BBX',
            'merek'      => 'Toyota',
            'model'      => 'Avanza',
            'warna'      => 'Hitam',
            'jenis'      => 'mobil',
            'utama'      => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $kendaraan2Id = DB::table('kendaraan')->insertGetId([
            'user_id'    => $dummyUser1Id,
            'plat_nomor' => 'F 1234 ABC',
            'merek'      => 'Honda',
            'model'      => 'Brio',
            'warna'      => 'Putih',
            'jenis'      => 'mobil',
            'utama'      => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $kendaraan3Id = DB::table('kendaraan')->insertGetId([
            'user_id'    => $dummyUser2Id,
            'plat_nomor' => 'F 5678 DEF',
            'merek'      => 'Yamaha',
            'model'      => 'NMAX',
            'warna'      => 'Biru',
            'jenis'      => 'motor',
            'utama'      => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $kendaraan4Id = DB::table('kendaraan')->insertGetId([
            'user_id'    => $dummyUser3Id,
            'plat_nomor' => 'F 9012 GHI',
            'merek'      => 'Honda',
            'model'      => 'Beat',
            'warna'      => 'Merah',
            'jenis'      => 'motor',
            'utama'      => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // ============================================================
        // LOKASI PARKIR
        // Format data: [kode_unik, nama, alamat, latitude, longitude, harga_per_jam]
        // ============================================================

        $lokasiData = [
            // --- Parkify Office (tetap seperti semula) ---
            [
                'kode_unik'     => 'POB',
                'nama'          => 'Parkify Office Bogor',
                'alamat'        => 'Jl. Raya Bogor No. 123',
                'latitude'      => -6.6408366,
                'longitude'     => 106.8244098,
                'total_slot'    => 160,
                'harga_per_jam' => 5000,
                'jam_buka'      => '06:00:00',
                'jam_tutup'     => '23:00:00',
            ],

            // --- MALL ---
            [
                'kode_unik'     => 'BTN',
                'nama'          => 'Botani Square Mall',
                'alamat'        => 'Jl. Raya Pajajaran No.1, Bogor',
                'latitude'      => -6.5898,
                'longitude'     => 106.8048,
                'total_slot'    => 160,
                'harga_per_jam' => 5000,
                'jam_buka'      => '08:00:00',
                'jam_tutup'     => '22:00:00',
            ],
            [
                'kode_unik'     => 'LKR',
                'nama'          => 'Lippo Plaza Kebun Raya',
                'alamat'        => 'Jl. Raya Pajajaran No.23, Bogor',
                'latitude'      => -6.5952,
                'longitude'     => 106.7980,
                'total_slot'    => 160,
                'harga_per_jam' => 5000,
                'jam_buka'      => '08:00:00',
                'jam_tutup'     => '22:00:00',
            ],
            [
                'kode_unik'     => 'LEK',
                'nama'          => 'Lippo Plaza Ekalokasari',
                'alamat'        => 'Jl. Siliwangi No.123, Bogor',
                'latitude'      => -6.6020,
                'longitude'     => 106.8089,
                'total_slot'    => 160,
                'harga_per_jam' => 5000,
                'jam_buka'      => '08:00:00',
                'jam_tutup'     => '22:00:00',
            ],
            [
                'kode_unik'     => 'BTM',
                'nama'          => 'BTM Mall Bogor',
                'alamat'        => 'Jl. Perintis Kemerdekaan No.1, Bogor',
                'latitude'      => -6.5958,
                'longitude'     => 106.8044,
                'total_slot'    => 160,
                'harga_per_jam' => 4000,
                'jam_buka'      => '08:00:00',
                'jam_tutup'     => '22:00:00',
            ],
            [
                'kode_unik'     => 'PJD',
                'nama'          => 'Plaza Jambu Dua',
                'alamat'        => 'Jl. Achmad Adnawijaya No.1, Bogor',
                'latitude'      => -6.5745,
                'longitude'     => 106.8014,
                'total_slot'    => 160,
                'harga_per_jam' => 4000,
                'jam_buka'      => '08:00:00',
                'jam_tutup'     => '22:00:00',
            ],
            [
                'kode_unik'     => 'BX3',
                'nama'          => 'Boxies 123 Mall',
                'alamat'        => 'Jl. Pajajaran No.37, Bogor',
                'latitude'      => -6.5877,
                'longitude'     => 106.8085,
                'total_slot'    => 160,
                'harga_per_jam' => 4000,
                'jam_buka'      => '08:00:00',
                'jam_tutup'     => '22:00:00',
            ],
            [
                'kode_unik'     => 'RAM',
                'nama'          => 'Ramayana Mall Bogor',
                'alamat'        => 'Jl. Raya Dewi Sartika No.5, Bogor',
                'latitude'      => -6.5964,
                'longitude'     => 106.7927,
                'total_slot'    => 160,
                'harga_per_jam' => 3000,
                'jam_buka'      => '08:00:00',
                'jam_tutup'     => '21:00:00',
            ],

            // --- SMK ---
            [
                'kode_unik'     => 'S1B',
                'nama'          => 'SMKN 1 Bogor',
                'alamat'        => 'Jl. Raya Budi No.1, Bogor',
                'latitude'      => -6.5944,
                'longitude'     => 106.8053,
                'total_slot'    => 160,
                'harga_per_jam' => 2000,
                'jam_buka'      => '06:00:00',
                'jam_tutup'     => '18:00:00',
            ],
            [
                'kode_unik'     => 'S2B',
                'nama'          => 'SMKN 2 Bogor',
                'alamat'        => 'Jl. Raya Tanah Baru No.8, Bogor',
                'latitude'      => -6.5874,
                'longitude'     => 106.8219,
                'total_slot'    => 160,
                'harga_per_jam' => 2000,
                'jam_buka'      => '06:00:00',
                'jam_tutup'     => '18:00:00',
            ],
            [
                'kode_unik'     => 'S3B',
                'nama'          => 'SMKN 3 Bogor',
                'alamat'        => 'Jl. Raya Pajajaran No.5, Bogor',
                'latitude'      => -6.5919,
                'longitude'     => 106.7993,
                'total_slot'    => 160,
                'harga_per_jam' => 2000,
                'jam_buka'      => '06:00:00',
                'jam_tutup'     => '18:00:00',
            ],
            [
                'kode_unik'     => 'S4B',
                'nama'          => 'SMKN 4 Bogor',
                'alamat'        => 'Jl. Raya Dramaga No.2, Bogor',
                'latitude'      => -6.5567,
                'longitude'     => 106.7242,
                'total_slot'    => 160,
                'harga_per_jam' => 2000,
                'jam_buka'      => '06:00:00',
                'jam_tutup'     => '18:00:00',
            ],
            [
                'kode_unik'     => 'WKR',
                'nama'          => 'SMK Wikrama Bogor',
                'alamat'        => 'Jl. Raya Pemda No.10, Bogor',
                'latitude'      => -6.5398,
                'longitude'     => 106.8401,
                'total_slot'    => 160,
                'harga_per_jam' => 2000,
                'jam_buka'      => '06:00:00',
                'jam_tutup'     => '18:00:00',
            ],
            [
                'kode_unik'     => 'BSI',
                'nama'          => 'SMK Bina Informatika Bogor',
                'alamat'        => 'Jl. Raya Dramaga Km.7, Bogor',
                'latitude'      => -6.5620,
                'longitude'     => 106.7310,
                'total_slot'    => 160,
                'harga_per_jam' => 2000,
                'jam_buka'      => '06:00:00',
                'jam_tutup'     => '18:00:00',
            ],

            // --- UNIVERSITAS ---
            [
                'kode_unik'     => 'IBI',
                'nama'          => 'IBIK Kesatuan Bogor',
                'alamat'        => 'Jl. Ranggagading No.1, Bogor',
                'latitude'      => -6.5909,
                'longitude'     => 106.7892,
                'total_slot'    => 160,
                'harga_per_jam' => 3000,
                'jam_buka'      => '07:00:00',
                'jam_tutup'     => '21:00:00',
            ],
            [
                'kode_unik'     => 'UIK',
                'nama'          => 'UIKA Bogor',
                'alamat'        => 'Jl. KH. Sholeh Iskandar Km.2, Bogor',
                'latitude'      => -6.5567,
                'longitude'     => 106.7778,
                'total_slot'    => 160,
                'harga_per_jam' => 3000,
                'jam_buka'      => '07:00:00',
                'jam_tutup'     => '21:00:00',
            ],
            [
                'kode_unik'     => 'UBI',
                'nama'          => 'Univ Bina Sarana Informatika Bogor',
                'alamat'        => 'Jl. Raya Cilebut No.1, Bogor',
                'latitude'      => -6.5320,
                'longitude'     => 106.8120,
                'total_slot'    => 160,
                'harga_per_jam' => 3000,
                'jam_buka'      => '07:00:00',
                'jam_tutup'     => '21:00:00',
            ],
            [
                'kode_unik'     => 'IPB',
                'nama'          => 'Institut Pertanian Bogor (IPB)',
                'alamat'        => 'Jl. Raya Dramaga, Bogor',
                'latitude'      => -6.5598,
                'longitude'     => 106.7247,
                'total_slot'    => 160,
                'harga_per_jam' => 3000,
                'jam_buka'      => '06:00:00',
                'jam_tutup'     => '22:00:00',
            ],
            [
                'kode_unik'     => 'UPK',
                'nama'          => 'Universitas Pakuan Bogor',
                'alamat'        => 'Jl. Pakuan No.1, Bogor',
                'latitude'      => -6.6000,
                'longitude'     => 106.8070,
                'total_slot'    => 160,
                'harga_per_jam' => 3000,
                'jam_buka'      => '07:00:00',
                'jam_tutup'     => '21:00:00',
            ],
            [
                'kode_unik'     => 'UTB',
                'nama'          => 'Universitas Terbuka Bogor',
                'alamat'        => 'Jl. Cabe Raya, Pamulang, Bogor',
                'latitude'      => -6.3618,
                'longitude'     => 106.7413,
                'total_slot'    => 160,
                'harga_per_jam' => 3000,
                'jam_buka'      => '07:00:00',
                'jam_tutup'     => '21:00:00',
            ],
        ];

        // Lantai & zona mapping
        $lantaiZona = [
            1 => 'A',
            2 => 'B',
            3 => 'C',
            4 => 'D',
        ];

        // Kumpulkan first slot tiap lokasi untuk dummy pemesanan
        $firstMobilSlots = [];
        $firstMotorSlots = [];

        foreach ($lokasiData as $lokasi) {
            // Insert lokasi
            $lokasiId = DB::table('lokasi_parkir')->insertGetId([
                'kode_unik'     => $lokasi['kode_unik'],
                'nama'          => $lokasi['nama'],
                'alamat'        => $lokasi['alamat'],
                'latitude'      => $lokasi['latitude'],
                'longitude'     => $lokasi['longitude'],
                'total_slot'    => $lokasi['total_slot'],
                'harga_per_jam' => $lokasi['harga_per_jam'],
                'jam_buka'      => $lokasi['jam_buka'],
                'jam_tutup'     => $lokasi['jam_tutup'],
                // 'foto'     => '/lokasi/foto/default.jpg',
                // 'foto_360' => '/lokasi/foto/default.jpg',
                'aktif'         => true,
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);

            $firstMobilSlotId = null;
            $firstMotorSlotId = null;

            // --------------------------------------------------------
            // Generate SLOT + SENSOR untuk setiap lokasi
            // 4 lantai × 20 slot MOBIL + 4 lantai × 20 slot MOTOR
            // --------------------------------------------------------
            foreach ($lantaiZona as $lantai => $zona) {

                // --- 20 Slot MOBIL ---
                for ($i = 1; $i <= 20; $i++) {
                    $nomorSlot  = str_pad($i, 2, '0', STR_PAD_LEFT);
                    $kodeSlot   = "{$zona}-{$nomorSlot}";
                    $namaSensor = "Ultrasonic {$lokasi['nama']} {$zona}-" . str_pad($i, 3, '0', STR_PAD_LEFT);

                    // Insert sensor
                    $sensorId = DB::table('sensor')->insertGetId([
                        'nama_sensor' => $namaSensor,
                        'status'      => 'tersedia',
                        'jarak_cm'    => 150,
                        'created_at'  => now(),
                        'updated_at'  => now(),
                    ]);

                    // Insert slot mobil
                    $slotId = DB::table('slot_parkir')->insertGetId([
                        'lokasi_parkir_id' => $lokasiId,
                        'kode_slot'        => $kodeSlot,
                        'lantai'           => (string) $lantai,
                        'zona'             => $zona,
                        'jenis_slot'       => 'reguler',
                        'kendaraan_type'       => 'mobil',
                        'status'           => 'tersedia',
                        'id_sensor'        => $sensorId,
                        'created_at'       => now(),
                        'updated_at'       => now(),
                    ]);

                    // Simpan slot mobil pertama dari lantai 1 zona A
                    if ($lantai === 1 && $i === 1 && $firstMobilSlotId === null) {
                        $firstMobilSlotId = $slotId;
                    }
                }

                // --- 20 Slot MOTOR (kode slot M-xx per zona) ---
                for ($i = 1; $i <= 20; $i++) {
                    $nomorSlot  = str_pad($i, 2, '0', STR_PAD_LEFT);
                    $kodeSlot   = "M{$zona}-{$nomorSlot}";
                    $namaSensor = "Ultrasonic {$lokasi['nama']} M{$zona}-" . str_pad($i, 3, '0', STR_PAD_LEFT);

                    // Insert sensor
                    $sensorId = DB::table('sensor')->insertGetId([
                        'nama_sensor' => $namaSensor,
                        'status'      => 'tersedia',
                        'jarak_cm'    => 80,
                        'created_at'  => now(),
                        'updated_at'  => now(),
                    ]);

                    // Insert slot motor
                    $slotId = DB::table('slot_parkir')->insertGetId([
                        'lokasi_parkir_id' => $lokasiId,
                        'kode_slot'        => $kodeSlot,
                        'lantai'           => (string) $lantai,
                        'zona'             => $zona,
                        'jenis_slot'       => 'reguler',
                        'kendaraan_type'       => 'motor',
                        'status'           => 'tersedia',
                        'id_sensor'        => $sensorId,
                        'created_at'       => now(),
                        'updated_at'       => now(),
                    ]);

                    // Simpan slot motor pertama dari lantai 1 zona A
                    if ($lantai === 1 && $i === 1 && $firstMotorSlotId === null) {
                        $firstMotorSlotId = $slotId;
                    }
                }
            }

            $firstMobilSlots[$lokasi['kode_unik']] = [
                'slot_id'   => $firstMobilSlotId,
                'lokasi_id' => $lokasiId,
                'harga'     => $lokasi['harga_per_jam'],
            ];
            $firstMotorSlots[$lokasi['kode_unik']] = [
                'slot_id'   => $firstMotorSlotId,
                'lokasi_id' => $lokasiId,
                'harga'     => $lokasi['harga_per_jam'],
            ];
        }

        // ============================================================
        // PEMESANAN & PEMBAYARAN (dummy untuk 3 users)
        // Gunakan slot dari beberapa lokasi berbeda
        // ============================================================

        // --- Justine (userId) → mobil di PARKIFY OFFICE ---
        $slotJustine   = $firstMobilSlots['POB'];
        $pemesanan1Id  = DB::table('pemesanan')->insertGetId([
            'user_id'       => $userId,
            'slot_id'       => $slotJustine['slot_id'],
            'kendaraan_id'  => $kendaraan1Id,
            'kode_pemesanan' => $this->generateKodePemesanan($slotJustine['lokasi_id'], 0),
            'waktu_mulai'   => Carbon::now(),
            'waktu_selesai' => Carbon::now()->addHours(2),
            'durasi_parkir' => 2,
            'total_harga'   => $slotJustine['harga'] * 2,
            'status'        => 'aktif',
            'catatan'       => 'Parkir lantai 1 zona A',
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);
        DB::table('slot_parkir')->where('id', $slotJustine['slot_id'])->update(['status' => 'terisi']);
        DB::table('pembayaran')->insert([
            'pemesanan_id'         => $pemesanan1Id,
            'jumlah'               => $slotJustine['harga'] * 2,
            'metode'               => 'qris',
            'status'               => 'sukses',
            'referensi_pembayaran' => 'PAY-001',
            'dibayar_pada'         => now(),
            'created_at'           => now(),
            'updated_at'           => now(),
        ]);

    }
}