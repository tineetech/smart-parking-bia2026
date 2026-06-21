<style>
    .cb-fab {
        position: fixed;
        bottom: 24px;
        right: 24px;
        width: 54px;
        height: 54px;
        background: var(--blue-main, #2563eb);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        border: none;
        z-index: 999;
        box-shadow: 0 4px 16px rgba(37, 99, 235, 0.35);
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .cb-cursor {
    display: inline-block;
    width: 1px;
    background: #0f1e36;
    margin-left: 1px;
    animation: cbCursorBlink 0.7s infinite;
    font-weight: 100;
    color: #0f1e36;
    font-size: 13px;
}
@keyframes cbCursorBlink {
    0%, 100% { opacity: 1; }
    50% { opacity: 0; }
}

    .cb-fab:hover {
        transform: scale(1.08);
        box-shadow: 0 6px 24px rgba(37, 99, 235, 0.45);
    }

    .cb-fab svg {
        color: #fff;
    }

    .cb-notif {
        position: absolute;
        top: 1px;
        right: 1px;
        width: 16px;
        height: 16px;
        background: #ef4444;
        border-radius: 50%;
        border: 2px solid #fff;
        font-size: 8px;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-family: 'Space Grotesk', sans-serif;
    }
    
    .cb-popup {
    position: fixed;
    bottom: 90px;
    right: 24px;
    width: 360px;
    background: #fff;
    border-radius: 20px;
    border: 1px solid #e2e8f2;
    box-shadow: 0 12px 48px rgba(15, 30, 54, 0.15);
    display: flex;
    flex-direction: column;
    overflow: hidden;
    z-index: 99999;
    transform-origin: bottom right;
    transition: opacity 0.22s ease, transform 0.22s ease;
    height: 80vh;
    max-height: 580px;
    min-height: 300px;
}

    .cb-popup.cb-hidden {
        opacity: 0;
        transform: scale(0.92) translateY(10px);
        pointer-events: none;
    }

    .cb-head {
        background: #2563eb;
        padding: 14px 16px;
        display: flex;
        align-items: center;
        gap: 10px;
        flex-shrink: 0;
    }

    .cb-head-avatar {
        width: 38px;
        height: 38px;
        border-radius: 11px;
        background: rgba(255, 255, 255, 0.18);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .cb-head-avatar svg {
        color: #fff;
    }

    .cb-head-info {
        flex: 1;
    }

    .cb-head-name {
        font-size: 13.5px;
        font-weight: 700;
        color: #fff;
        font-family: 'Space Grotesk', sans-serif;
        line-height: 1.2;
    }

    .cb-head-status {
        font-size: 11px;
        color: rgba(255, 255, 255, 0.75);
        display: flex;
        align-items: center;
        gap: 5px;
        margin-top: 2px;
    }

    .cb-online-dot {
        width: 6px;
        height: 6px;
        background: #4ade80;
        border-radius: 50%;
        animation: livepulse 1.6s infinite;
    }

    .cb-close-btn {
        width: 28px;
        height: 28px;
        background: rgba(255, 255, 255, 0.15);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        border: none;
        color: #fff;
        transition: background 0.15s;
    }

    .cb-close-btn:hover {
        background: rgba(255, 255, 255, 0.25);
    }

    
    .cb-messages {
    flex: 1;
    overflow-y: auto;
    padding: 14px;
    display: flex;
    flex-direction: column;
    gap: 10px;
    background: #f8fafc;
    min-height: 0; /* penting agar flex bisa shrink */
}

    .cb-messages::-webkit-scrollbar {
        width: 3px;
    }

    .cb-messages::-webkit-scrollbar-thumb {
        background: #e2e8f2;
        border-radius: 999px;
    }

    .cb-msg {
        display: flex;
        gap: 8px;
        align-items: flex-end;
    }

    .cb-msg.user {
        flex-direction: row-reverse;
    }

    .cb-bubble {
        max-width: 240px;
        padding: 9px 13px;
        border-radius: 14px;
        font-size: 12.5px;
        line-height: 1.55;
        font-family: 'Poppins', sans-serif;
    }

    .cb-msg.bot .cb-bubble {
        background: #fff;
        border: 1px solid #e2e8f2;
        color: #0f1e36;
        border-bottom-left-radius: 4px;
    }

    .cb-msg.user .cb-bubble {
        background: #2563eb;
        color: #fff;
        border-bottom-right-radius: 4px;
    }

    .cb-msg-icon {
        width: 26px;
        height: 26px;
        border-radius: 8px;
        background: #dbeafe;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .cb-msg-icon svg {
        color: #2563eb;
    }

    .cb-typing-bubble {
        display: flex;
        gap: 5px;
        align-items: center;
        padding: 10px 14px;
    }

    .cb-typing-bubble span {
        width: 7px;
        height: 7px;
        background: #cbd5e1;
        border-radius: 50%;
        animation: cbBounce 1.2s infinite;
        display: block;
    }

    .cb-typing-bubble span:nth-child(2) {
        animation-delay: 0.2s;
    }

    .cb-typing-bubble span:nth-child(3) {
        animation-delay: 0.4s;
    }

    @keyframes cbBounce {

        0%,
        60%,
        100% {
            transform: translateY(0);
        }

        30% {
            transform: translateY(-6px);
        }
    }

    .cb-quick-chips {
        display: flex;
        gap: 6px;
        padding: 10px 14px;
        overflow-x: auto;
        scrollbar-width: none;
        border-top: 1px solid #e2e8f2;
        background: #fff;
        flex-shrink: 0;
    }

    .cb-quick-chips::-webkit-scrollbar {
        display: none;
    }

    .cb-chip {
        padding: 5px 12px;
        border-radius: 999px;
        font-size: 11.5px;
        font-weight: 600;
        background: #eff6ff;
        color: #2563eb;
        border: 1px solid #dbeafe;
        cursor: pointer;
        white-space: nowrap;
        transition: all 0.15s;
        font-family: 'Poppins', sans-serif;
        flex-shrink: 0;
    }

    .cb-chip:hover {
        background: #2563eb;
        color: #fff;
        border-color: #2563eb;
    }

    .cb-input-row {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 10px 12px;
        border-top: 1px solid #e2e8f2;
        background: #fff;
        flex-shrink: 0;
    }

    .cb-text-input {
        flex: 1;
        border: 1px solid #e2e8f2;
        border-radius: 10px;
        padding: 9px 13px;
        font-size: 12.5px;
        outline: none;
        font-family: 'Poppins', sans-serif;
        background: #f8fafc;
        color: #0f1e36;
        transition: border-color 0.15s, box-shadow 0.15s;
    }

    .cb-text-input:focus {
        border-color: #93c5fd;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .cb-send-btn {
        width: 38px;
        height: 38px;
        background: #2563eb;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: none;
        cursor: pointer;
        flex-shrink: 0;
        transition: background 0.15s;
    }

    .cb-send-btn:hover {
        background: #1d4ed8;
    }

    .cb-send-btn:disabled {
        background: #94a3b8;
        cursor: not-allowed;
    }

    .cb-send-btn svg {
        color: #fff;
    }

    @media (max-width: 480px) {
    .cb-popup {
        width: calc(100vw - 24px);
        right: 12px;
        bottom: 76px;
        height: 80vh;
        max-height: none; /* full 80vh di mobile */
    }
    .cb-fab {
        right: 16px;
        bottom: 82px;
    }
}
</style>

{{-- FAB BUTTON --}}
<button class="cb-fab" id="cbFab" onclick="toggleChatbot()" aria-label="Buka chatbot Parkify">
    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" />
    </svg>
    <div class="cb-notif" id="cbNotif">1</div>
</button>

{{-- POPUP CHATBOT --}}
<div class="cb-popup cb-hidden" id="cbPopup">

    {{-- Header --}}
    <div class="cb-head">
        <div class="cb-head-avatar">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2">
                <rect x="2" y="3" width="7" height="7" rx="1" />
                <rect x="15" y="3" width="7" height="7" rx="1" />
                <rect x="2" y="14" width="7" height="7" rx="1" />
                <rect x="15" y="14" width="7" height="7" rx="1" />
            </svg>
        </div>
        <div class="cb-head-info">
            <div class="cb-head-name">Parki Assistant</div>
            <div class="cb-head-status">
                <div class="cb-online-dot"></div>
                Online · Smart Parking AI
            </div>
        </div>
        <button class="cb-close-btn" onclick="toggleChatbot()">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2.5">
                <line x1="18" y1="6" x2="6" y2="18" />
                <line x1="6" y1="6" x2="18" y2="18" />
            </svg>
        </button>
    </div>

    {{-- Messages --}}
    <div class="cb-messages" id="cbMessages"></div>

    {{-- Quick Chips --}}
    <div class="cb-quick-chips" id="cbChips">
        <div class="cb-chip" onclick="sendQuick(this)">Cek slot tersedia</div>
        <div class="cb-chip" onclick="sendQuick(this)">Cara booking parkir</div>
        <div class="cb-chip" onclick="sendQuick(this)">Tarif parkir</div>
        <div class="cb-chip" onclick="sendQuick(this)">Sensor IoT</div>
    </div>

    {{-- Input --}}
    <div class="cb-input-row">
        <input class="cb-text-input" id="cbInput" placeholder="Tanya sesuatu tentang parkir..."
            onkeydown="if(event.key==='Enter')sendMessage()" />
        <button class="cb-send-btn" id="cbSendBtn" onclick="sendMessage()">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2.5">
                <line x1="22" y1="2" x2="11" y2="13" />
                <polygon points="22 2 15 22 11 13 2 9 22 2" />
            </svg>
        </button>
    </div>
</div>

<script>
    function renderMarkdown(text) {
        return text
            .replace(/\*\*(.+?)\*\*/g, '<strong>$1</strong>')
            .replace(/\n/g, '<br>');
    }

    const KNOWLEDGE_BASE = {
        salam: {
            keywords: ['halo', 'hello', 'hei', 'hi', 'hai', 'hey', 'pagi', 'siang', 'sore', 'malam', 'selamat', 'hy', 'hii', 'helo'],
            answer: 'Halo juga! Ada yang bisa saya bantu hari ini? Kamu bisa tanya soal **slot parkir**, **cara booking**, **tarif**, atau fitur Parkify lainnya.'
        },
        tentang: {
            keywords: ['tentang', 'parkify', 'aplikasi', 'apa itu', 'info', 'smart parking', 'perkenalan'],
            answer: `Parkify adalah sistem smart parking berbasis IoT yang memudahkan kamu.\n\nFitur utama:\n• Monitoring slot parkir real-time via sensor ultrasonik\n• Booking slot parkir online\n• Perpanjang waktu parkir lewat aplikasi\n• Gate otomatis (buka/tutup) via QR code\n• Dashboard live untuk admin\n\nParkify menggabungkan ESP32, MQTT, dan web app untuk pengalaman parkir yang lebih cerdas dan efisien.`
        },
        slot: {
            keywords: ['slot', 'tersedia', 'kosong', 'ketersediaan', 'tempat', 'penuh', 'sisa'],
            answer: `Untuk mengecek slot parkir yang tersedia:\n\n1. Buka halaman **Dashboard** di aplikasi Parkify\n2. Pilih **lokasi parkir** yang ingin dicek\n3. Lihat slot parkir yang berwarna **hijau** (tersedia) dan **merah** (terisi)\n4. Setiap slot menggunakan sensor ultrasonik yang mendeteksi ada/tidaknya mobil secara real-time\n\nJumlah slot dan kapasitas bisa berbeda tergantung lokasi parkir yang dipilih. Status diperbarui otomatis melalui koneksi MQTT dari perangkat IoT.`
        },
        booking: {
            keywords: ['booking', 'pesan', 'reservasi', 'reserve', 'daftar', 'cara booking', 'pesan slot', 'book'],
            answer: `Cara booking slot parkir di Parkify:\n\n1. Login ke akun Parkify kamu\n2. Pilih **Booking** di menu utama\n3. Pilih slot yang tersedia (warna hijau)\n4. Pilih durasi parkir yang diinginkan\n5. Klik **Pesan Sekarang**\n6. Sistem akan generate QR code sebagai tiket parkir kamu\n\nSetelah booking, QR code bisa digunakan untuk akses masuk/keluar gate otomatis. Jangan lupa screenshot QR code kamu ya.`
        },
        tarif: {
            keywords: ['tarif', 'harga', 'biaya', 'bayar', 'cost', 'ongkos', 'rate', 'mahal'],
            answer: `Tarif parkir Parkify bervariasi tergantung lokasi:\n\n**Per jam**: Rp 2.000 - Rp 5.000\n**Parkir malam (22.00-06.00)**: Rp 10.000 flat\n**Langganan bulanan**: Rp 300.000 - Rp 500.000\n\nPembayaran bisa melalui:\n• Transfer bank (BCA/Mandiri)\n• E-wallet (GoPay, OVO, Dana)\n• Scan QRIS di lokasi\n\nCek aplikasi untuk tarif pasti di lokasi parkir pilihan kamu.`
        },
        perpanjang: {
            keywords: ['perpanjang', 'tambah', 'extend', 'durasi', 'waktu', 'lebih lama', 'perpanjangan', 'perpanjangan waktu'],
            answer: `Cara perpanjang waktu parkir:\n\n1. Buka menu **Booking Aktif** di dashboard\n2. Pilih sesi parkir yang ingin diperpanjang\n3. Klik **Perpanjang Waktu**\n4. Pilih tambahan durasi yang diinginkan\n5. Lakukan pembayaran jika ada tambahan biaya\n\nPerpanjangan bisa dilakukan **maksimal 30 menit sebelum waktu habis**.\n\nKalau waktu habis dan belum diperpanjang, gate out tetap bisa dibuka tapi akan dikenakan denda Rp 5.000 per 30 menit.`
        },
        iot: {
            keywords: ['iot', 'sensor', 'hardware', 'esp32', 'ultrasonik', 'alat', 'perangkat', 'cara kerja sensor'],
            answer: `Cara kerja sistem IoT Parkify:\n\n**ESP32** sebagai mikrokontroler utama\n**Sensor Ultrasonik HC-SR04** mendeteksi jarak mobil ke dinding (6 sensor untuk 5 slot + 1 cadangan)\n**Gate servo** membuka/tutup palang otomatis\n**LCD I2C** menampilkan info slot dan kapasitas\n**LED indikator** di setiap slot (hijau = kosong, merah = terisi)\n**PCF8574** IO expander untuk kontrol LED dan buzzer\n**MQTT protocol** mengirim data sensor ke server setiap ada perubahan status\n**WiFi** menghubungkan ESP32 ke internet\n\nData dari sensor langsung terkirim ke backend dan muncul di aplikasi web Parkify secara real-time.`
        },
        qrcode: {
            keywords: ['qr', 'qrcode', 'barcode', 'scan', 'tiket', 'gate', 'masuk', 'keluar', 'pintu', 'gagal scan'],
            answer: `Tentang QR Code Parkify:\n\n• QR code adalah tiket parkir digital kamu (muncul setelah booking berhasil)\n• Scan QR code di **gate masuk** untuk buka palang\n• Scan lagi di **gate keluar** saat mau pergi\n• QR code bisa discan dari HP, tidak perlu dicetak\n\n**Kalau QR gagal discan:**\n1. Perbesar brightness layar HP\n2. Pastikan QR tidak rusak/terpotong\n3. Dekatkan QR ke scanner (10-15cm)\n4. Hubungi admin parkir via menu Bantuan di aplikasi`
        },
        lokasi: {
            keywords: ['lokasi', 'alamat', 'dimana', 'tempat', 'posisi', 'gedung', 'map', 'maps'],
            answer: `**Lokasi Parkify Smart Parking:**\n\nJl. Soekarno Hatta No. 123\nKota Malang, Jawa Timur\n(Dekat Kampus Universitas Brawijaya)\n\nTersedia **5 slot parkir** di area ini.\n\nFasilitas:\n• CCTV 24 jam\n• Akses 24/7\n• Charging station untuk mobil listrik\n• Area jaga keamanan\n\nCek **Google Maps** langsung dari menu Lokasi di aplikasi Parkify.`
        },
        akun: {
            keywords: ['akun', 'login', 'register', 'daftar', 'sign up', 'sign in', 'log in', 'lupa password', 'profil'],
            answer: `**Akun Parkify:**\n\n**Daftar**: Buka aplikasi, klik **Daftar**, isi email dan password\n**Login**: Masukkan email dan password yang sudah didaftarkan\n**Lupa Password**: Klik "Lupa Password" di halaman login, ikuti instruksi via email\n\nFitur akun:\n• Melihat riwayat parkir\n• Booking slot\n• Manajemen kendaraan (nopol)\n• Top up saldo\n• Notifikasi real-time\n\nButuh bantuan akun? Hubungi **cs@parkify.app** atau chat admin di aplikasi.`
        },
        admin: {
            keywords: ['admin', 'petugas', 'pengelola', 'operator', 'panel admin', 'dashboard admin'],
            answer: `**Panel Admin Parkify:**\n\nFitur untuk pengelola parkir:\n**Dashboard real-time** - pantau semua slot\n**Manajemen booking** - lihat dan kelola pesanan\n**Manajemen pengguna** - data member parkir\n**Laporan pendapatan** - rekap transaksi harian/bulanan\n**Monitoring IoT** - status sensor dan perangkat\n**Statistik okupansi** - analisis tingkat kepadatan\n\nLogin sebagai admin untuk mengakses semua fitur ini.`
        },
        kendala: {
            keywords: ['error', 'masalah', 'kendala', 'rusak', 'trouble', 'troubleshoot', 'nggak bisa', 'tidak bisa', 'gagal', 'salah'],
            answer: `**Troubleshooting Cepat:**\n\n**QR gagal discan** - Tingkatkan brightness, bersihkan kamera, ulangi scan\n**Slot tidak update** - Refresh halaman dashboard, cek koneksi internet\n**Gate tidak terbuka** - Hubungi admin via tombol darurat di gate\n**Login gagal** - Cek email dan password, atau reset password\n**Booking gagal** - Cek saldo/cukup, slot mungkin sudah diisi orang lain\n\nKalau masih bermasalah, hubungi **CS Parkify** di:\nTelp/WA: 0812-3456-7890\nEmail: cs@parkify.app`
        },
        kontak: {
            keywords: ['kontak', 'cs', 'customer service', 'hubungi', 'bantuan', 'help', 'telepon', 'email', 'whatsapp', 'wa'],
            answer: `**Hubungi Parkify:**\n\nEmail: cs@parkify.app\nTelepon/WA: 0812-3456-7890\nWebsite: parkify.app\nLokasi: Jl. Soekarno Hatta No. 123, Malang\n\nJam operasional CS:\nSenin - Jumat: 07.00 - 21.00\nSabtu - Minggu: 08.00 - 18.00\n\nUntuk laporan darurat di luar jam operasional, silakan hubungi petugas parkir di lokasi.`
        }
    };

    const FALLBACK_ANSWERS = [
        'Maaf, saya belum paham maksudnya. Coba tanya dengan kata kunci lain ya, misalnya: **slot tersedia**, **cara booking**, atau **tarif parkir**.',
        'Hmm, saya kurang mengerti pertanyaannya. Ketik ulang dengan lebih jelas atau pilih rekomendasi pertanyaan di atas ya.',
        'Maaf, saya belum bisa menjawab itu. Coba tanya soal **slot parkir**, **booking**, **tarif**, atau **cara pakai sensor IoT** Parkify.'
    ];

    let cbHistory = [];
    let cbOpen = false;
    let cbGreeted = false;

    function toggleChatbot() {
        cbOpen = !cbOpen;
        const popup = document.getElementById('cbPopup');
        const notif = document.getElementById('cbNotif');
        if (cbOpen) {
            popup.classList.remove('cb-hidden');
            notif.style.display = 'none';
            document.getElementById('cbInput').focus();
            if (!cbGreeted) {
                cbGreeted = true;
                setTimeout(() => addBotMessage(
                    'Halo! Saya **Parki**, asisten smart parking Parkify.\nAda yang bisa saya bantu hari ini? Kamu bisa tanya soal booking slot, tarif, cara pakai sensor IoT, atau fitur lainnya.'
                    ), 300);
            }
        } else {
            popup.classList.add('cb-hidden');
        }
    }

    function addBotMessage(text) {
        const msgs = document.getElementById('cbMessages');
        const div = document.createElement('div');
        div.className = 'cb-msg bot';
        div.innerHTML = `
            <div class="cb-msg-icon">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="2" y="3" width="7" height="7" rx="1"/>
                    <rect x="15" y="3" width="7" height="7" rx="1"/>
                    <rect x="2" y="14" width="7" height="7" rx="1"/>
                    <rect x="15" y="14" width="7" height="7" rx="1"/>
                </svg>
            </div>
            <div class="cb-bubble"></div>`;
        msgs.appendChild(div);
        msgs.scrollTop = msgs.scrollHeight;

        const bubble = div.querySelector('.cb-bubble');
        typeMessage(bubble, text, msgs);
    }

    function typeMessage(el, text, scrollContainer) {
        const html = renderMarkdown(text);
        const tokenRegex = /<strong>.*?<\/strong>|<br>|<[^>]+>|./gs;
        const tokens = html.match(tokenRegex) || [];
        let idx = 0;
        let rendered = '';

        const interval = setInterval(() => {
            if (idx >= tokens.length) {
                clearInterval(interval);
                el.innerHTML = rendered;
                return;
            }

            rendered += tokens[idx];
            idx++;

            el.innerHTML = rendered + '<span class="cb-cursor">|</span>';
            scrollContainer.scrollTop = scrollContainer.scrollHeight;
        }, 16);
    }

    function addUserMessage(text) {
        const msgs = document.getElementById('cbMessages');
        const div = document.createElement('div');
        div.className = 'cb-msg user';
        div.innerHTML = `<div class="cb-bubble">${text}</div>`;
        msgs.appendChild(div);
        msgs.scrollTop = msgs.scrollHeight;
    }

    function addTyping() {
        const msgs = document.getElementById('cbMessages');
        const div = document.createElement('div');
        div.className = 'cb-msg bot';
        div.id = 'cbTyping';
        div.innerHTML = `
            <div class="cb-msg-icon">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="2" y="3" width="7" height="7" rx="1"/>
                    <rect x="15" y="3" width="7" height="7" rx="1"/>
                    <rect x="2" y="14" width="7" height="7" rx="1"/>
                    <rect x="15" y="14" width="7" height="7" rx="1"/>
                </svg>
            </div>
            <div class="cb-bubble" style="padding:8px 12px">
                <div class="cb-typing-bubble"><span></span><span></span><span></span></div>
            </div>`;
        msgs.appendChild(div);
        msgs.scrollTop = msgs.scrollHeight;
        return div;
    }

    function sendQuick(el) {
        const text = el.textContent;
        document.getElementById('cbInput').value = text;
        sendMessage();
    }

    function findAnswer(input) {
        const lower = input.toLowerCase().trim();
        let bestMatch = null;
        let bestLength = 0;

        for (const key in KNOWLEDGE_BASE) {
            const entry = KNOWLEDGE_BASE[key];
            for (const keyword of entry.keywords) {
                if (lower.includes(keyword) && keyword.length > bestLength) {
                    bestMatch = entry.answer;
                    bestLength = keyword.length;
                }
            }
        }

        return bestMatch;
    }

    function sendMessage() {
        const input = document.getElementById('cbInput');
        const sendBtn = document.getElementById('cbSendBtn');
        const text = input.value.trim();
        if (!text) return;

        input.value = '';
        sendBtn.disabled = true;
        addUserMessage(text);

        cbHistory.push({ role: 'user', content: text });

        const typing = addTyping();

        setTimeout(() => {
            typing.remove();

            const answer = findAnswer(text);

            if (answer) {
                cbHistory.push({ role: 'assistant', content: answer });
                if (cbHistory.length > 20) cbHistory = cbHistory.slice(-20);
                addBotMessage(answer);
            } else {
                const fallback = FALLBACK_ANSWERS[Math.floor(Math.random() * FALLBACK_ANSWERS.length)];
                addBotMessage(fallback);
            }

            sendBtn.disabled = false;
            input.focus();
        }, 600);
    }
</script>
