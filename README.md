# Parkify — Smart Parking System

Sistem parkir cerdas berbasis IoT yang dikembangkan untuk BIA 2026. Parkify menggabungkan pembacaan sensor ultrasonik, gerbang otomatis, kamera QR, MQTT, dan aplikasi web untuk memantau serta memesan slot parkir secara real-time.

## Fitur

- Monitoring slot parkir real-time melalui sensor ultrasonik (ESP32).
- Booking slot parkir online oleh pengguna.
- Pembayaran online (Midtrans Snap).
- QR code untuk verifikasi masuk/keluar dan pembukaan gate otomatis.
- Dashboard admin: lokasi, slot, pengguna, pemesanan, notifikasi, dan monitoring.
- Dashboard pengguna: booking, riwayat, kendaraan, notifikasi, dan pengaturan.
- Notifikasi dan data slot real-time melalui MQTT.
- Indikator LED per slot, LCD I2C, dan buzzer pada perangkat.
- Landing page, halaman Tentang Kami, dan Hubungi Kami.

## Arsitektur

```
[6x Sensor Ultrasonik] ─┐
[Gate Servo In/Out]      ├── ESP32 (MQTT) ──► MQTT Broker ──► Laravel (web)
[LED + Buzzer/PCF8574]   │                        ▲
[LCD I2C] ───────────────┘                        │
                                               [Python QR Scanner]
[ESP32 Camera Stream] ──► HTTP Stream ──► [OpenCV QR Detector] ──► REST API
```

Alur gate masuk:

1. Kamera ESP32 mengirim stream JPEG via HTTP.
2. `stream-qr` membaca QR, lalu memanggil API `GET /api/pemesanan/cek-kode/{kode}`.
3. Jika valid, scanner mengirim perintah MQTT untuk membuka gate dan membunyikan buzzer.
4. Gate ditutup otomatis setelah beberapa detik.

## Teknologi

| Bagian | Teknologi |
| --- | --- |
| Web app | Laravel 12, PHP 8.2+, Blade, Vite, Tailwind CSS, Alpine.js |
| Autentikasi | Laravel Breeze, Sanctum, Socialite (Google) |
| Pembayaran | Midtrans PHP SDK |
| Backend API (eksperimental) | Node.js, Express 5, Sequelize, Socket.IO, MQTT |
| IoT | ESP32, Arduino C++, PubSubClient, ArduinoJson, NewPing, ESP32Servo, PCF8574 |
| QR Scanner | Python, OpenCV, paho-mqtt, requests |
| Protokol | MQTT (TCP 1883 / WebSocket 9001), HTTP REST |

## Struktur Proyek

```
smart-parking-bia2026/
├── arduino/
│   ├── main.cpp               # Firmware utama ESP32 (sensor, gate, LED, LCD, MQTT)
│   ├── ioexpander.cpp         # Eksperimen PCF8574
│   ├── qr-scanner.html        # Halaman uji scanner QR
│   ├── qr-backup.html
│   └── stream-qr/
│       ├── stream.cpp         # Firmware kamera ESP32 (stream JPEG)
│       ├── main.py            # QR scanner OpenCV + MQTT
│       └── .env.example
├── website/
│   ├── frontend/              # Aplikasi Laravel (utama)
│   └── backend/               # Skeleton API Express (opsional/eksperimental)
├── opencam.bat                # Menjalankan stream-qr/main.py (Windows)
└── README.md
```

## Prasyarat

- PHP 8.2+ dan Composer
- Node.js 18+ dan npm
- MySQL (default proyek) atau SQLite
- Python 3.10+
- Arduino IDE / PlatformIO (untuk ESP32)
- MQTT broker (Mosquitto, EMQX, atau sejenisnya) dengan dukungan WebSocket
- Kamera ESP32 (modul AI Thinker ESP32-CAM)

## Menjalankan Web App (Laravel)

```bash
cd website/frontend
composer install
```

Buat file `.env` (tidak disertakan di repository) lalu isi konfigurasi berikut:

```env
APP_NAME="Parkify - Smart parking system"
APP_ENV=local
APP_KEY=
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bia_smartparking
DB_USERNAME=root
DB_PASSWORD=

QUEUE_CONNECTION=database

MIDTRANS_SERVER_KEY=your-server-key
MIDTRANS_CLIENT_KEY=your-client-key
MIDTRANS_IS_PRODUCTION=false
```

Generate application key, lalu jalankan migrasi, seeder, dan storage link:

```bash
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
```

Jalankan aplikasi:

```bash
npm install
npm run dev
php artisan serve
```

Atau jalankan semuanya sekaligus (server, queue, log, Vite):

```bash
composer dev
```

Buka `http://localhost:8000`.

### Testing

```bash
cd website/frontend
php artisan test
```

## Menjalankan QR Scanner (Python)

Scanner membutuhkan stream kamera ESP32 yang sudah aktif dan MQTT broker yang sama dengan perangkat.

```bash
cd arduino/stream-qr
python -m venv venv
venv\Scripts\activate          # Windows
pip install opencv-python requests paho-mqtt python-dotenv
copy .env.example .env
```

Isi `.env`:

```env
STREAM_URL=http://IP_ESP32_CAM/stream
API_URL=http://IP_SERVER:8000/api
MQTT_BROKER=your-mqtt-host
MQTT_PORT=1883
MQTT_USERNAME=your-username
MQTT_PASSWORD=your-password
MQTT_TOPIC=parking/gate/in
```

Jalankan:

```bash
python main.py
```

Di Windows, `opencam.bat` dapat dipakai untuk mengaktifkan virtualenv dan menjalankan scanner.

## Firmware ESP32

### 1. Kamera stream (`arduino/stream-qr/stream.cpp`)

- Board: AI Thinker ESP32-CAM.
- Sesuaikan `ssid` dan `password` WiFi.
- Upload, lalu akses `http://IP_ESP32_CAM/stream`.

### 2. Perangkat parkir (`arduino/main.cpp`)

Sesuaikan konfigurasi WiFi, broker MQTT, dan topik. Ringkasan pin yang dipakai:

| Komponen | Pin / Alamat |
| --- | --- |
| Sensor ultrasonik (Trig/Echo) | 4/34, 5/35, 18/32, 19/33, 21/25, 22/26 |
| Servo gate masuk | GPIO 13 |
| Servo gate keluar | GPIO 12 |
| PCF8574 (LED & buzzer) | I2C `0x20` |
| LCD masuk | I2C `0x27` |
| LCD keluar | I2C `0x26` |
| Jumlah sensor | 6 (5 slot + 1 cadangan) |

Topik MQTT yang digunakan:

| Topik | Arah | Payload |
| --- | --- | --- |
| `parking/data/{id}` | ESP32 → broker | Data sensor slot |
| `parking/led/{1-5}` | broker → ESP32 | `{"status":"on"}` / `{"status":"off"}` |
| `parking/gate/in` | broker → ESP32 | `{"status":"open"}`, `{"status":"close"}`, `{"buzzer":"on"}` |
| `parking/gate/out` | broker → ESP32 | `{"status":"open"}`, `{"status":"close"}`, `{"buzzer":"on"}` |

Library Arduino yang diperlukan: `PubSubClient`, `ArduinoJson`, `NewPing`, `ESP32Servo`, `LiquidCrystal_I2C`, `PCF8574`.

## Backend Express (Opsional)

Folder `website/backend` berisi skeleton API Express yang belum terhubung penuh ke aplikasi Laravel.

```bash
cd website/backend
npm install
npm run start
```

Default berjalan di `http://localhost:3000`.

## API Utama (Laravel)

| Method | Endpoint | Keterangan |
| --- | --- | --- |
| GET | `/api/lokasi` | Daftar lokasi parkir |
| GET | `/api/lokasi/{id}` | Detail lokasi |
| GET | `/api/pemesanan/cek-kode/{kode}` | Validasi QR masuk |
| GET | `/api/pemesanan/cek-kode-out/{kode}` | Validasi QR keluar |
| GET | `/api/monitor/slots` | Data slot untuk monitoring |
| GET/POST | `/api/pemesanan` | Daftar / buat pemesanan |
| GET/POST | `/api/pembayaran` | Daftar / buat pembayaran |
| GET/POST | `/api/notifikasi` | Daftar / kelola notifikasi |

Endpoint lain tersedia di `website/frontend/routes/api.php`.

## Keamanan

- File `.env` tidak boleh di-commit. Gunakan `.env.example` sebagai template.
- Ganti kredensial MQTT, Midtrans, dan database sebelum deploy.
- Aktifkan HTTPS dan autentikasi broker MQTT di lingkungan produksi.
- Jangan menaruh kredensial perangkat langsung di kode firmware untuk produksi.

## Lisensi

Proyek ini dibuat untuk keperluan lomba BIA 2026. Hak dan lisensi mengikuti kesepakatan pemilik proyek.
