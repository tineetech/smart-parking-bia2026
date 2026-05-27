@extends('layouts.main')

@section('styles')
  <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
@endsection

@section('content')


  <!-- NAVBAR -->
  <nav id="navbar">
    <a class="nav-logo" href="#">Park<span>ify</span></a>
    <ul class="nav-links">
      <li><a href="#beranda" class="active">Beranda</a></li>
      <li><a href="#fitur">Detail Layanan</a></li>
      <li><a href="#layanan">Tentang Kami</a></li>
      <li><a href="#kontak">Hubungi Kami</a></li>
    </ul>
    <a class="nav-cta" href="{{ route('user.dashboard') }}">Mulai Sekarang</a>
    <div class="hamburger" id="hamburger"><span></span><span></span><span></span></div>
  </nav>
 
  <!-- Mobile menu -->
  <div class="overlay" id="overlay"></div>
  <div class="mobile-menu" id="mobileMenu">
    <button class="close-btn" id="closeMenu">✕</button>
    <a href="#beranda">Beranda</a>
    <a href="#fitur">Detail Layanan</a>
    <a href="#layanan">Tentang Kami</a>
    <a href="#kontak">Hubungi Kami</a>
    <a class="nav-cta" href="{{ route('user.dashboard') }}">Mulai Sekarang</a>
  </div>
 
  <!-- HERO — wrapped so it's not fullwidth -->
  <div class="hero-wrapper" id="beranda">
    <section class="hero">
      <div class="hero-map-bg"></div>
      <div class="pin"></div><div class="pin"></div><div class="pin"></div>
      <div class="pin"></div><div class="pin"></div>
      <div class="road road-h"></div>
      <div class="road road-h2"></div>
      <div class="road road-v"></div>
      <div class="road road-v2"></div>
      <div class="hero-content">
        <h1>Mulai Pengelolaan Parkir mu<br>Dengan Cerdas Bersama Park<span>ify</span>.</h1>
        <p>Monitoring Slot parkir dan booking parkir mu sekarang !</p>
        <a href="#fitur" class="hero-btn">
          Coba Dan Mulai
          <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
        </a>
      </div>
    </section>
  </div>
  <!-- ══ PARTNERS MARQUEE ══ -->
  <div class="partners">
    <div class="absolute left-0 top-0 h-full w-[200px] bg-gradient-to-r from-white to-transparent z-10 pointer-events-none"></div>
    <div class="absolute right-0 top-0 h-full w-[200px] bg-gradient-to-l from-white to-transparent z-10 pointer-events-none"></div>
    <div class="marquee-track">
      <span><b>ROVES</b>123</span>
      <span>LIPPOMALLS</span>
      <span>★ KOTAKUNINGMALL</span>
      <span><b>ROVES</b>123</span>
      <span>LIPPOMALLS</span>
      <span>★ KOTAKUNINGMALL</span>
      <span><b>ROVES</b>123</span>
      <span>LIPPOMALLS</span>
      <span>★ KOTAKUNINGMALL</span>
      <span><b>ROVES</b>123</span>
      <span>LIPPOMALLS</span>
      <span>★ KOTAKUNINGMALL</span>
      <span><b>ROVES</b>123</span>
      <span>LIPPOMALLS</span>
      <span>★ KOTAKUNINGMALL</span>
      <span><b>ROVES</b>123</span>
      <span>LIPPOMALLS</span>
      <span>★ KOTAKUNINGMALL</span>
    </div>
  </div>

  <!-- ══ FEATURES ══ -->
  <!-- ══ FEATURES ══ -->
<section class="features" id="fitur">

  <div class="features-header reveal">
    <span class="section-tag">Fitur Utama</span>
    <h2 class="section-title">Semua yang Kamu Butuhkan<br>Ada di Park<span>ify</span></h2>
    <p class="features-sub">Dari monitoring real-time hingga reservasi otomatis — satu aplikasi untuk pengalaman parkir yang lebih cerdas.</p>
  </div>

  <div class="features-tabs reveal">
    <button class="ftab active" onclick="switchFeature('monitor',this)">
      <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="3"/></svg>
      Monitoring Real-Time
    </button>
    <button class="ftab" onclick="switchFeature('reservasi',this)">
      <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/><polyline points="9 16 11 18 15 14"/></svg>
      Reservasi Slot
    </button>
    <button class="ftab" onclick="switchFeature('notif',this)">
      <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
      Notifikasi Cerdas
    </button>
    <button class="ftab" onclick="switchFeature('riwayat',this)">
      <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
      Riwayat & Analitik
    </button>
  </div>

  <div class="features-body">

    <!-- LEFT: Panel Konten -->
    <div class="features-content">

      <div class="fpanel active" id="fpanel-monitor">
        <div class="fpanel-eyebrow">
          <span class="fpanel-dot"></span> Live Update
        </div>
        <h3>Pantau Slot Parkir<br>Secara Real-Time</h3>
        <p>Lihat kondisi parkiran secara langsung tanpa perlu datang ke lokasi. Data diperbarui setiap 30 detik dari sensor IoT di setiap slot.</p>
        <ul class="fpanel-points">
          <li><span class="fp-check"><svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></span>Tampilan peta interaktif dengan status tiap slot</li>
          <li><span class="fp-check"><svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></span>Filter berdasarkan lantai, zona, atau tipe kendaraan</li>
          <li><span class="fp-check"><svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></span>Estimasi waktu tempuh ke lokasi parkir</li>
          <li><span class="fp-check"><svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></span>Riwayat kepadatan per jam dan hari</li>
        </ul>
        <a href="{{ route('user.login') }}" class="fpanel-cta">
          Coba Sekarang
          <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
        </a>
      </div>

      <div class="fpanel" id="fpanel-reservasi">
        <div class="fpanel-eyebrow"><span class="fpanel-dot"></span> Reservasi Mudah</div>
        <h3>Pesan Slot Sebelum<br>Kamu Berangkat</h3>
        <p>Tidak perlu khawatir kehabisan tempat. Reservasi slot hingga 24 jam ke depan dan dapatkan konfirmasi instan langsung ke hp kamu.</p>
        <ul class="fpanel-points">
          <li><span class="fp-check"><svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></span>Pilih slot spesifik atau biarkan sistem memilihkan</li>
          <li><span class="fp-check"><svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></span>Konfirmasi via QR code atau plat nomor otomatis</li>
          <li><span class="fp-check"><svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></span>Perpanjang atau batalkan kapan saja sebelum batas waktu</li>
          <li><span class="fp-check"><svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></span>Integrasi kalender untuk jadwal parkir rutin</li>
        </ul>
        <a href="{{ route('user.login') }}" class="fpanel-cta">
          Coba Sekarang
          <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
        </a>
      </div>

      <div class="fpanel" id="fpanel-notif">
        <div class="fpanel-eyebrow"><span class="fpanel-dot"></span> Smart Alert</div>
        <h3>Notifikasi yang Tepat<br>di Waktu yang Tepat</h3>
        <p>Sistem AI kami belajar dari kebiasaan parkirmu dan mengirim notifikasi proaktif sebelum kamu membutuhkannya.</p>
        <ul class="fpanel-points">
          <li><span class="fp-check"><svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></span>Peringatan slot hampir habis di gedung favoritmu</li>
          <li><span class="fp-check"><svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></span>Reminder reservasi 30 menit sebelum waktu parkir</li>
          <li><span class="fp-check"><svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></span>Notifikasi tarif promo dan jam bebas macet</li>
          <li><span class="fp-check"><svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></span>Alert kedaluwarsa tiket parkir secara otomatis</li>
        </ul>
        <a href="{{ route('user.login') }}" class="fpanel-cta">
          Coba Sekarang
          <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
        </a>
      </div>

      <div class="fpanel" id="fpanel-riwayat">
        <div class="fpanel-eyebrow"><span class="fpanel-dot"></span> Insights Pribadi</div>
        <h3>Lacak Pengeluaran &<br>Kebiasaan Parkirmu</h3>
        <p>Dashboard analitik personal membantu kamu memahami pola parkir, mengoptimalkan pengeluaran, dan menemukan slot terbaik.</p>
        <ul class="fpanel-points">
          <li><span class="fp-check"><svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></span>Rekap pengeluaran parkir mingguan dan bulanan</li>
          <li><span class="fp-check"><svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></span>Gedung dan slot yang paling sering digunakan</li>
          <li><span class="fp-check"><svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></span>Ekspor laporan ke PDF atau CSV</li>
          <li><span class="fp-check"><svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></span>Tips penghematan berdasarkan data penggunaanmu</li>
        </ul>
        <a href="{{ route('user.login') }}" class="fpanel-cta">
          Coba Sekarang
          <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
        </a>
      </div>

    </div>

    <!-- RIGHT: Phone Mockup -->
    <div class="features-mockup">

      <div class="fmock-float fmock-float--left" id="fmock-float-left">
        <div class="fmock-float-label">Slot Tersedia</div>
        <div class="fmock-float-val" id="ffl-val">24</div>
        <div class="fmock-float-sub" id="ffl-sub">dari 60 total</div>
      </div>

      <div class="fmock-phone">
        <div class="fmock-bar">
          <span class="fmock-dot" style="background:#ef4444"></span>
          <span class="fmock-dot" style="background:#f59e0b"></span>
          <span class="fmock-dot" style="background:#22c55e"></span>
          <span class="fmock-bar-title" id="fmock-title">Parkify · Live Map</span>
        </div>

        <!-- Screen: Monitor -->
        <div class="fscreen active" id="fscreen-monitor">
          <div class="fmap-area">
            <div class="fmap-grid"></div>
            <div class="fmap-road fmap-road--h" style="top:40%"></div>
            <div class="fmap-road fmap-road--h" style="top:70%"></div>
            <div class="fmap-road fmap-road--v" style="left:35%"></div>
            <div class="fmap-road fmap-road--v" style="left:68%"></div>
            <div class="fmap-pin">
              <div class="fmap-pin-ring"></div>
              <div class="fmap-pin-inner"></div>
              <div class="fmap-pin-dot"></div>
            </div>
            <div class="fmap-zone fmap-zone--green" style="top:10px;left:10px">
              <div class="fz-label">ZONA A</div>
              <div class="fz-val">18 kosong</div>
            </div>
            <div class="fmap-zone fmap-zone--red" style="top:10px;right:10px">
              <div class="fz-label">ZONA B</div>
              <div class="fz-val">2 sisa</div>
            </div>
            <div class="fmap-zone fmap-zone--blue" style="bottom:8px;left:10px">
              <div class="fz-label">ZONA C</div>
              <div class="fz-val">8 kosong</div>
            </div>
          </div>
          <div class="finfo-row">
            <div class="finfo-icon">
              <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#60a5fa" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
            </div>
            <div class="finfo-text">
              <div class="fi-label">Lokasi</div>
              <div class="fi-val">Botani Square Lt.2</div>
            </div>
            <span class="fi-badge fi-badge--green">Buka</span>
          </div>
          <div class="finfo-row">
            <div class="finfo-icon">
              <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#60a5fa" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            </div>
            <div class="finfo-text">
              <div class="fi-label">Estimasi kedatangan</div>
              <div class="fi-val">~7 menit dari lokasi Anda</div>
            </div>
          </div>
          <div class="fprogress">
            <div class="fprogress-label"><span>Kapasitas terisi</span><span>60%</span></div>
            <div class="fprogress-track"><div class="fprogress-fill" style="width:60%;background:#fb923c"></div></div>
          </div>
        </div>

        <!-- Screen: Reservasi -->
        <div class="fscreen" id="fscreen-reservasi">
          <div class="fscreen-label">Pilih Slot — Lantai 2</div>
          <div class="fslot-grid">
            <div class="fslot fslot--taken">A1</div><div class="fslot fslot--empty">A2</div>
            <div class="fslot fslot--empty">A3</div><div class="fslot fslot--taken">A4</div>
            <div class="fslot fslot--empty">B1</div><div class="fslot fslot--selected">B2</div>
            <div class="fslot fslot--taken">B3</div><div class="fslot fslot--empty">B4</div>
            <div class="fslot fslot--empty">C1</div><div class="fslot fslot--empty">C2</div>
            <div class="fslot fslot--taken">C3</div><div class="fslot fslot--taken">C4</div>
          </div>
          <div class="fslot-legend">
            <span class="fsl-item fsl-item--empty">Kosong</span>
            <span class="fsl-item fsl-item--taken">Terisi</span>
            <span class="fsl-item fsl-item--sel">Dipilih</span>
          </div>
          <div class="finfo-row">
            <div class="finfo-icon">
              <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#60a5fa" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
            </div>
            <div class="finfo-text">
              <div class="fi-label">Slot terpilih</div>
              <div class="fi-val">B2 · Lantai 2 · Zona Tengah</div>
            </div>
            <span class="fi-badge fi-badge--blue">Rp5K/jam</span>
          </div>
          <div class="fconfirm-btn">Konfirmasi Reservasi</div>
        </div>

        <!-- Screen: Notifikasi -->
        <div class="fscreen" id="fscreen-notif">
          <div class="fscreen-label">Notifikasi Hari Ini</div>
          <div class="fnotif fnotif--blue">
            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#60a5fa" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
            <div>
              <div class="fn-title">Slot favoritmu hampir habis</div>
              <div class="fn-body">Botani Square Zona A — tersisa 3 slot!</div>
            </div>
          </div>
          <div class="fnotif fnotif--green">
            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#22c55e" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
            <div>
              <div class="fn-title">Reservasi berhasil dikonfirmasi</div>
              <div class="fn-body">Slot B2 · 14:00–17:00 · Botani Square</div>
            </div>
          </div>
          <div class="fnotif fnotif--orange">
            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#fb923c" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            <div>
              <div class="fn-title">Pengingat: 30 menit lagi</div>
              <div class="fn-body">Siapkan QR code-mu untuk pukul 14:00.</div>
            </div>
          </div>
          <div class="fnotif fnotif--blue">
            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#60a5fa" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
            <div>
              <div class="fn-title">Promo weekend aktif!</div>
              <div class="fn-body">Diskon 20% Sabtu–Minggu semua mitra.</div>
            </div>
          </div>
        </div>

        <!-- Screen: Riwayat -->
        <div class="fscreen" id="fscreen-riwayat">
          <div class="fscreen-label">Mei 2026</div>
          <div class="friwayat-stats">
            <div class="frs-item">
              <div class="frs-label">Total parkir</div>
              <div class="frs-val">14 kali</div>
            </div>
            <div class="frs-item frs-item--blue">
              <div class="frs-label" style="color:rgba(96,165,250,.6)">Pengeluaran</div>
              <div class="frs-val" style="color:#60a5fa">Rp 87K</div>
            </div>
          </div>
          <div class="fhistory-item">
            <div class="fhi-icon" style="background:rgba(34,197,94,.12)">
              <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#22c55e" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="3" width="15" height="13" rx="1"/><path d="M16 8h4l3 3v5h-7V8z"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
            </div>
            <div class="fhi-text">
              <div class="fhi-name">Botani Square Lt.2</div>
              <div class="fhi-date">Hari ini · 09:00–11:30</div>
            </div>
            <div class="fhi-price">Rp 12.500</div>
          </div>
          <div class="fhistory-item">
            <div class="fhi-icon" style="background:rgba(37,99,235,.15)">
              <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#60a5fa" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="3" width="15" height="13" rx="1"/><path d="M16 8h4l3 3v5h-7V8z"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
            </div>
            <div class="fhi-text">
              <div class="fhi-name">Lippo Mall Bogor</div>
              <div class="fhi-date">25 Mei · 13:00–15:00</div>
            </div>
            <div class="fhi-price">Rp 10.000</div>
          </div>
          <div class="fhistory-item">
            <div class="fhi-icon" style="background:rgba(251,146,60,.12)">
              <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#fb923c" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="3" width="15" height="13" rx="1"/><path d="M16 8h4l3 3v5h-7V8z"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
            </div>
            <div class="fhi-text">
              <div class="fhi-name">Boxies 123 Mall</div>
              <div class="fhi-date">24 Mei · 17:30–19:00</div>
            </div>
            <div class="fhi-price">Rp 7.500</div>
          </div>
        </div>

      </div>

      <div class="fmock-float fmock-float--right" id="fmock-float-right">
        <div class="fmock-float-label" id="ffr-label">Waktu Respons</div>
        <div class="fmock-float-val" id="ffr-val">30s</div>
        <div class="fmock-float-sub" id="ffr-sub">update sensor</div>
      </div>
    </div>

  </div>
</section>

  <!-- ══ SERVICES ══ -->
  <section class="services" id="layanan">
    <span class="section-tag reveal">Layanan Kami</span>
    <h2 class="section-title reveal" style="margin-bottom:16px">Yang Dapat Kami<br>Berikan</h2>

    <div class="cards-grid" style="margin-top:56px">
      <!-- Card 1 -->
      <div class="card reveal reveal-d1">
        <div class="card-icon">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/><polyline points="9 16 11 18 15 14"/></svg>
        </div>
        <h3>Reservasi Parkiran</h3>
        <p>Amankan slot parkir Anda bahkan sebelum tiba di lokasi. Cukup pilih gedung tujuan, pesan tempat, dan berkendara tanpa rasa khawatir.</p>
        <a href="#" class="card-link">Learn More <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
      </div>

      <!-- Card 2 -->
      <div class="card reveal reveal-d2">
        <div class="card-icon">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
        </div>
        <h3>Informasi Real-Time</h3>
        <p>Dapatkan data akurat mengenai jumlah slot, lengkap dengan navigasi langsung menuju lokasi terdekat. Selalu tahu kondisi parkir sebelum tiba.</p>
        <a href="#" class="card-link">Learn More <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
      </div>

      <!-- Card 3 -->
      <div class="card reveal reveal-d3">
        <div class="card-icon">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
        </div>
        <h3>Efisiensi & Waktu</h3>
        <p>Dapatkan rute tercepat menuju slot kosong, lengkap dengan estimasi waktu jalan dan notifikasi otomatis saat slot hampir terisi.</p>
        <a href="#" class="card-link">Learn More <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
      </div>
    </div>
  </section>

  <!-- ══ HOW IT WORKS ══ -->
  <section class="how">
    <div style="position:relative;z-index:1;text-align:center">
      <span class="section-tag reveal">Cara Kerja</span>
      <h2 class="section-title reveal" style="color:white">Cara Menggunakan<br>Park<span>ify</span></h2>
    </div>
    <div class="how-grid">
      <div class="how-step reveal reveal-d1">
        <div class="step-num">01</div>
        <div class="step-icon">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#3B82F6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
        </div>
        <h4>Buat Akun</h4>
        <p>Daftar dengan email atau nomor telepon dalam hitungan detik.</p>
      </div>
      <div class="how-step reveal reveal-d2">
        <div class="step-num">02</div>
        <div class="step-icon">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#3B82F6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        </div>
        <h4>Cari Lokasi</h4>
        <p>Temukan gedung parkir terdekat dengan slot yang masih tersedia.</p>
      </div>
      <div class="how-step reveal reveal-d3">
        <div class="step-num">03</div>
        <div class="step-icon">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#3B82F6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
        </div>
        <h4>Reservasi Slot</h4>
        <p>Pilih slot, pilih waktu, dan konfirmasi reservasi Anda.</p>
      </div>
      <div class="how-step reveal reveal-d4">
        <div class="step-num">04</div>
        <div class="step-icon">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#3B82F6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
        </div>
        <h4>Parkir & Selesai</h4>
        <p>Tiba di lokasi, scan QR, dan langsung masuk tanpa antre.</p>
      </div>
    </div>
  </section>

  <!-- ══ STATS ══ -->
  <div class="stats">
    <div class="stat reveal"><h3>50+</h3><p>Gedung Parkir Mitra</p></div>
    <div class="stat reveal reveal-d1"><h3>100K+</h3><p>Pengguna Aktif</p></div>
    <div class="stat reveal reveal-d2"><h3>99.9%</h3><p>Uptime Sistem</p></div>
    <div class="stat reveal reveal-d3"><h3>4.9★</h3><p>Rating Pengguna</p></div>
  </div>

  <!-- ══ CTA BANNER ══ -->
  <!-- ══ CTA BANNER ══ -->
<section class="cta-banner">
  <div class="cta-inner reveal">
    <div class="cta-glow-right"></div>

    <div class="cta-text">
      <div class="cta-eyebrow">Bergabung Sekarang</div>
      <h2>Siap Parkir Lebih<br><span>Cerdas & Efisien?</span></h2>
      <p>Ribuan pengguna sudah menikmati kemudahan booking parkir real-time. Tidak perlu antre, tidak perlu khawatir kehabisan slot.</p>

      <div class="cta-stats">
        <div class="cta-stat">
          <strong>100K+</strong>
          <span>Pengguna Aktif</span>
        </div>
        <div class="cta-divider"></div>
        <div class="cta-stat">
          <strong>50+</strong>
          <span>Gedung Mitra</span>
        </div>
        <div class="cta-divider"></div>
        <div class="cta-stat">
          <strong>4.9★</strong>
          <span>Rating App</span>
        </div>
      </div>
    </div>

    <div class="cta-action">
      <div class="cta-badge">✦ Gratis Daftar</div>
      <div class="cta-action-title">Mulai dalam 30 detik</div>
      <div class="cta-btns">
        <a href="{{ route('user.login') }}" class="btn-primary">Mulai Sekarang</a>
        <a href="#fitur" class="btn-secondary">Pelajari Lebih</a>
      </div>
      <p class="cta-note">Tidak perlu kartu kredit · Gratis selamanya</p>
    </div>
  </div>
</section>

  <!-- ══ FOOTER ══ -->
  <footer id="kontak">
    <div class="footer-top">
      <div class="footer-brand">
          <div class="flex gap-2">
              <div>
                  <img src="{{ asset('assets/img/logo-light.png') }}" style="width: 50px" alt="">
              </div>
            <div class="logo">Parki<span>fy</span></div>
          </div>
        <p>Parkify: Solusi Digital Booking parkiran Mu. Kelola parkir lebih cerdas, hemat waktu, dan bebas ribet.</p>
      </div>
      <div class="footer-col">
        <h5>Navigasi</h5>
        <ul>
          <li><a href="#beranda">Beranda</a></li>
          <li><a href="#">Berlangganan</a></li>
          <li><a href="#layanan">Tentang Kami</a></li>
          <li><a href="#kontak">Kontak Kami</a></li>
        </ul>
      </div>
      <div class="footer-col footer-contact">
        <h5>Lokasi</h5>
        <p>Jl. Raya Tajur, Kp. Buntar, Kel. Muara Sari, Kec. Bogor Selatan</p>
        <br>
        <h5 style="margin-top:4px">Kontak</h5>
        <p><a href="tel:+62838796300647">+62 838 7963 0647</a></p>
        <p><a href="tel:+628577025310">+62 857 7025 3106</a></p>
        <br>
        <h5 style="margin-top:4px">Email</h5>
        <p><a href="mailto:parkify@gmail.com">parkify@gmail.com</a></p>
        <div class="social-links">
          <a href="#" title="Facebook">
            <svg viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
          </a>
          <a href="#" title="Twitter">
            <svg viewBox="0 0 24 24"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"/></svg>
          </a>
          <a href="#" title="Instagram">
            <svg viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
          </a>
          <a href="#" title="LinkedIn">
            <svg viewBox="0 0 24 24"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/></svg>
          </a>
        </div>
      </div>
    </div>

    <div class="footer-bottom">
      <p class="footer-copyright">© 2026 Parkify. Semua hak dilindungi.</p>
    </div>

    <div class="footer-wordmark">
      <span>Parki<b>fy</b></span>
    </div>
  </footer>

  <div class="back-top">
    <a href="#beranda">
      Kembali Ke Halaman Paling Atas
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="18 15 12 9 6 15"/></svg>
    </a>
  </div>

  <script>
    // Navbar scroll
    const nav = document.getElementById('navbar');
    window.addEventListener('scroll', () => {
      nav.classList.toggle('scrolled', window.scrollY > 20);
    });

    // Mobile menu
    const hamburger = document.getElementById('hamburger');
    const mobileMenu = document.getElementById('mobileMenu');
    const overlay = document.getElementById('overlay');
    const closeMenu = document.getElementById('closeMenu');

    function openMenu() {
      mobileMenu.classList.add('open');
      overlay.classList.add('show');
      document.body.style.overflow = 'hidden';
    }
    function closeMenuFn() {
      mobileMenu.classList.remove('open');
      overlay.classList.remove('show');
      document.body.style.overflow = '';
    }
    hamburger.addEventListener('click', openMenu);
    overlay.addEventListener('click', closeMenuFn);
    closeMenu.addEventListener('click', closeMenuFn);
    mobileMenu.querySelectorAll('a').forEach(a => a.addEventListener('click', closeMenuFn));

    // Scroll reveal
    const reveals = document.querySelectorAll('.reveal');
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(e => {
        if (e.isIntersecting) {
          e.target.classList.add('visible');
          observer.unobserve(e.target);
        }
      });
    }, { threshold: 0.12 });
    reveals.forEach(el => observer.observe(el));

    // features interactive
    // Features tab switch
const floatData = {
  monitor:  { lv:'24',    ls:'dari 60 total',  rl:'Waktu Respons', rv:'30s',  rs:'update sensor' },
  reservasi:{ lv:'B2',    ls:'slot terpilih',  rl:'Estimasi Tiba', rv:'7 mnt',rs:'dari lokasimu' },
  notif:    { lv:'4',     ls:'notif hari ini', rl:'Terakhir dikirim',rv:'5m', rs:'yang lalu' },
  riwayat:  { lv:'Rp87K', ls:'bulan ini',      rl:'Total parkir',  rv:'14x',  rs:'bulan ini' },
};
const mockTitles = {
  monitor:'Parkify · Live Map', reservasi:'Parkify · Reservasi',
  notif:'Parkify · Notifikasi', riwayat:'Parkify · Riwayat',
};

function switchFeature(id, btn) {
  document.querySelectorAll('.ftab').forEach(t => t.classList.remove('active'));
  btn.classList.add('active');
  document.querySelectorAll('.fpanel').forEach(p => p.classList.remove('active'));
  document.getElementById('fpanel-' + id).classList.add('active');
  document.querySelectorAll('.fscreen').forEach(s => s.classList.remove('active'));
  document.getElementById('fscreen-' + id).classList.add('active');
  const d = floatData[id];
  document.getElementById('ffl-val').textContent  = d.lv;
  document.getElementById('ffl-sub').textContent  = d.ls;
  document.getElementById('ffr-label').textContent = d.rl;
  document.getElementById('ffr-val').textContent  = d.rv;
  document.getElementById('ffr-sub').textContent  = d.rs;
  document.getElementById('fmock-title').textContent = mockTitles[id];
}
    
  </script>
@endsection