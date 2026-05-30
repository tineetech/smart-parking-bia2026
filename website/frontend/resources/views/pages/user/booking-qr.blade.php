<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
<title>Parkify — QR Tiket</title>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
{{-- QR generator library --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
{{-- html2canvas untuk download --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<style>
:root {
  --bg-base:    #EEF3FB;
  --bg-surface: #ffffff;
  --bg-input:   #f3f6fb;
  --border:     #e2e8f2;
  --text-primary:   #0f1e36;
  --text-secondary: #4a6080;
  --text-muted:     #94a3b8;
  --blue-main:  #2563eb;
  --blue-bright:#3b82f6;
  --blue-pale:  #dbeafe;
  --blue-soft:  #eff6ff;
  --green:      #10b981;
  --green-soft: #ecfdf5;
  --green-pale: #a7f3d0;
  --red:        #ef4444;
  --amber:      #f59e0b;
  --shadow-sm:  0 1px 4px rgba(15,30,54,0.07);
  --shadow-md:  0 4px 20px rgba(15,30,54,0.10);
  --shadow-lg:  0 12px 40px rgba(15,30,54,0.14);
  --bottom-nav-h: 76px;
  --header-h:   64px;
  --max-w:      520px;
  --r-xl: 24px; --r-lg: 16px; --r-md: 12px;
}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
html{scroll-behavior:smooth}
html,body{overflow-x:hidden;width:100%}
body{font-family:'Plus Jakarta Sans',sans-serif;background:var(--bg-base);color:var(--text-primary);min-height:100vh}
::-webkit-scrollbar{width:4px}
::-webkit-scrollbar-thumb{background:var(--border);border-radius:99px}

/* ══ HEADER ══ */
.top-header{background:rgba(255,255,255,0.85);backdrop-filter:blur(20px) saturate(1.8);-webkit-backdrop-filter:blur(20px) saturate(1.8);border-bottom:1px solid rgba(226,232,240,0.6);box-shadow:0 1px 12px rgba(15,30,54,0.06);position:sticky;top:0;left:0;right:0;z-index:300;width:100%}
.top-header-inner{max-width:var(--max-w);margin:0 auto;padding:0 20px;height:var(--header-h);display:flex;align-items:center;justify-content:space-between;gap:12px}
.header-logo{display:flex;align-items:center;gap:9px;text-decoration:none}
.logo-mark{width:38px;height:38px;border-radius:11px;background:var(--blue-main);display:flex;align-items:center;justify-content:center;box-shadow:0 3px 10px rgba(37,99,235,0.30)}
.logo-mark svg{width:20px;height:20px}
.logo-text{font-size:18px;font-weight:800;color:var(--text-primary);letter-spacing:-0.6px}
.logo-text em{font-style:normal;color:var(--blue-main)}
.header-right{display:flex;align-items:center;gap:8px}
.btn-icon{width:38px;height:38px;border-radius:var(--r-md);background:var(--bg-surface);border:1px solid var(--border);display:flex;align-items:center;justify-content:center;cursor:pointer;box-shadow:var(--shadow-sm);color:var(--text-secondary);text-decoration:none;transition:border-color .15s,color .15s}
.btn-icon:hover{border-color:var(--blue-main);color:var(--blue-main)}
.user-chip{display:flex;align-items:center;gap:7px;background:var(--bg-surface);border:1px solid var(--border);border-radius:var(--r-md);padding:4px 10px 4px 4px;cursor:pointer;box-shadow:var(--shadow-sm)}
.user-avatar{width:30px;height:30px;border-radius:50%;background:linear-gradient(135deg,#f59e0b,#ef4444);display:flex;align-items:center;justify-content:center;font-weight:700;font-size:11px;color:#fff;flex-shrink:0;overflow:hidden}
.user-avatar img{width:100%;height:100%;object-fit:cover}
.user-name{font-size:12px;font-weight:700;color:var(--text-primary);white-space:nowrap}

/* ══ PAGE LAYOUT ══ */
.page-wrap{max-width:var(--max-w);margin:0 auto;padding-bottom:calc(var(--bottom-nav-h) + 120px + env(safe-area-inset-bottom));padding-top:24px}

/* ══ PAGE TITLE ══ */
.page-title-row{padding:0 20px 20px;display:flex;align-items:center;gap:12px}
.back-btn{width:36px;height:36px;border-radius:50%;background:var(--bg-surface);border:1px solid var(--border);display:flex;align-items:center;justify-content:center;text-decoration:none;color:var(--text-secondary);box-shadow:var(--shadow-sm);flex-shrink:0;transition:border-color .15s,color .15s}
.back-btn:hover{border-color:var(--blue-main);color:var(--blue-main)}
.page-title-text{font-size:18px;font-weight:800;color:var(--text-primary);letter-spacing:-.4px}

/* ══ TIKET CARD ══ */
.tiket-card{margin:0 20px;background:var(--bg-surface);border-radius:var(--r-xl);border:1px solid var(--border);box-shadow:var(--shadow-lg);overflow:hidden;animation:fade-up .45s cubic-bezier(.34,1.20,.64,1) both}
@keyframes fade-up{from{opacity:0;transform:translateY(16px)}to{opacity:1;transform:translateY(0)}}

/* header tiket */
.tiket-head{background:linear-gradient(135deg,var(--blue-main) 0%,#1d4ed8 100%);padding:22px 24px 20px;position:relative;overflow:hidden}
.tiket-head::after{content:'';position:absolute;right:-30px;top:-30px;width:130px;height:130px;border-radius:50%;background:rgba(255,255,255,.06);pointer-events:none}
.tiket-head::before{content:'';position:absolute;right:40px;bottom:-40px;width:100px;height:100px;border-radius:50%;background:rgba(255,255,255,.04);pointer-events:none}
.tiket-brand{display:flex;align-items:center;gap:8px;margin-bottom:16px}
.tiket-brand-mark{width:28px;height:28px;border-radius:8px;background:rgba(255,255,255,.2);display:flex;align-items:center;justify-content:center}
.tiket-brand-mark svg{width:14px;height:14px}
.tiket-brand-name{font-size:14px;font-weight:800;color:rgba(255,255,255,.9);letter-spacing:-.3px}
.tiket-brand-name em{font-style:normal;color:#fff}
.tiket-lokasi{font-size:18px;font-weight:800;color:#fff;letter-spacing:-.4px;margin-bottom:4px}
.tiket-slot-badge{display:inline-flex;align-items:center;gap:5px;background:rgba(255,255,255,.18);border-radius:6px;padding:4px 10px;font-size:12px;font-weight:700;color:rgba(255,255,255,.9)}
.tiket-slot-badge svg{width:12px;height:12px;opacity:.8}

/* perforasi / tear line */
.tiket-tear{display:flex;align-items:center;position:relative;margin:0 -1px}
.tiket-tear-circle{width:20px;height:20px;border-radius:50%;background:var(--bg-base);border:1px solid var(--border);flex-shrink:0;position:relative;z-index:2}
.tiket-tear-circle.left{margin-left:-10px}
.tiket-tear-circle.right{margin-right:-10px}
.tiket-tear-line{flex:1;border-top:2px dashed var(--border)}

/* QR section */
.tiket-qr-section{padding:24px 24px 20px;display:flex;flex-direction:column;align-items:center;gap:0}
.qr-box{width:200px;height:200px;padding:10px;background:#fff;border:1.5px solid var(--border);border-radius:var(--r-md);box-shadow:var(--shadow-sm);display:flex;align-items:center;justify-content:center;margin-bottom:12px}
.qr-box canvas,
.qr-box img{width:180px !important;height:180px !important;display:block}
.tiket-kode{font-size:13px;font-weight:700;color:var(--text-muted);letter-spacing:.5px;margin-bottom:6px;font-variant-numeric:tabular-nums}
.tiket-qr-hint{font-size:11.5px;color:var(--text-muted);text-align:center;line-height:1.5}

/* info rows */
.tiket-info-rows{border-top:1px solid var(--bg-input);padding:16px 24px 6px}
.tiket-info-row{display:flex;align-items:center;justify-content:space-between;padding:9px 0;border-bottom:1px solid var(--bg-input)}
.tiket-info-row:last-child{border-bottom:none}
.tir-label{font-size:12px;color:var(--text-muted);font-weight:600;display:flex;align-items:center;gap:6px}
.tir-label svg{width:13px;height:13px;opacity:.6;flex-shrink:0}
.tir-val{font-size:12.5px;color:var(--text-primary);font-weight:700;text-align:right;max-width:58%}

/* total strip */
.tiket-total-strip{margin:12px 24px 20px;background:var(--blue-soft);border:1px solid var(--blue-pale);border-radius:var(--r-md);padding:14px 18px;display:flex;align-items:center;justify-content:space-between}
.tiket-total-label{font-size:13px;font-weight:700;color:var(--blue-main)}
.tiket-total-val{font-size:20px;font-weight:800;color:var(--text-primary);letter-spacing:-.6px}

/* status badge */
.status-badge{display:inline-flex;align-items:center;gap:5px;background:var(--green-soft);border:1px solid var(--green-pale);border-radius:6px;padding:4px 10px;font-size:11.5px;font-weight:700;color:var(--green)}
.status-badge svg{width:12px;height:12px}

/* ══ DOWNLOAD BUTTON ══ */
.dl-btn-wrap{
  position:fixed;
  bottom:calc(var(--bottom-nav-h) + 12px + env(safe-area-inset-bottom));
  left:50%;
  transform:translateX(-50%);
  width:calc(min(var(--max-w),100vw) - 40px);
  z-index:500;
  display:flex;gap:10px;
  animation:slide-up-btn .5s cubic-bezier(.34,1.20,.64,1) .4s both
}
@keyframes slide-up-btn{from{transform:translateX(-50%) translateY(40px);opacity:0}to{transform:translateX(-50%) translateY(0);opacity:1}}
.btn-dl{
  flex:1;
  padding:17px 20px;
  background:var(--blue-main);
  color:#fff;
  border:none;
  border-radius:999px;
  font-family:inherit;
  font-size:14px;
  font-weight:800;
  letter-spacing:.1px;
  cursor:pointer;
  display:flex;align-items:center;justify-content:center;gap:8px;
  box-shadow:0 6px 28px rgba(37,99,235,.40),0 2px 8px rgba(37,99,235,.20);
  transition:all .2s;text-decoration:none
}
.btn-dl:hover{background:var(--blue-bright);transform:translateY(-2px)}
.btn-dl svg{width:18px;height:18px;opacity:.9;flex-shrink:0}
.btn-dl-sec{
  width:54px;height:54px;
  background:var(--bg-surface);
  border:1.5px solid var(--border);
  border-radius:999px;
  display:flex;align-items:center;justify-content:center;
  cursor:pointer;
  box-shadow:var(--shadow-md);
  flex-shrink:0;transition:border-color .15s,color .15s;color:var(--text-secondary)
}
.btn-dl-sec:hover{border-color:var(--blue-main);color:var(--blue-main)}
.btn-dl-sec svg{width:20px;height:20px}

/* ══ BOTTOM NAV ══ */
.bottom-nav{position:fixed;bottom:0;left:0;right:0;width:100%;z-index:9999;display:flex;align-items:flex-end;justify-content:center;pointer-events:none;padding-bottom:calc(12px + env(safe-area-inset-bottom))}
.bottom-nav-inner{display:flex;align-items:center;background:var(--bg-surface);border:1px solid var(--border);border-radius:999px;box-shadow:0 4px 28px rgba(15,30,54,.13);padding:6px 8px;gap:5px;pointer-events:all;width:auto;max-width:calc(100vw - 32px)}
.bn-item{display:flex;flex-direction:row;align-items:center;justify-content:center;gap:7px;padding:11px 12px;border-radius:999px;cursor:pointer;color:var(--text-secondary);font-size:13px;font-weight:700;font-family:inherit;transition:all .22s cubic-bezier(.34,1.56,.64,1);-webkit-tap-highlight-color:transparent;white-space:nowrap;background:transparent;text-decoration:none}
.bn-item:not(.active){background:#f3f4f6;border-radius:50%;width:46px;height:46px;padding:0}
.bn-item:not(.active) span{display:none}
.bn-item svg{width:21px;height:21px;flex-shrink:0}
.bn-item.active{background:var(--blue-main);color:#fff;padding:12px 22px;border-radius:999px;width:auto;height:auto}
.bn-item.active span{display:inline;color:#fff}
.bn-item:not(.active):hover{background:#e5e7eb}

/* loading overlay */
.dl-loading{display:none;position:fixed;inset:0;background:rgba(15,30,54,.45);z-index:9998;align-items:center;justify-content:center;backdrop-filter:blur(4px)}
.dl-loading.show{display:flex}
.dl-spinner{width:44px;height:44px;border:3px solid rgba(255,255,255,.3);border-top-color:#fff;border-radius:50%;animation:spin .7s linear infinite}
@keyframes spin{to{transform:rotate(360deg)}}

@media(min-width:860px){
  :root{--max-w:560px}
  .bottom-nav{display:none}
  .page-wrap{padding-bottom:80px}
  .dl-btn-wrap{bottom:24px}
  .user-name{display:block !important}
}
@media(max-width:479px){
  .user-name{display:none}
  .tiket-lokasi{font-size:16px}
}
</style>
</head>
<body>

<div class="dl-loading" id="dl-loading"><div class="dl-spinner"></div></div>

{{-- ══ HEADER ══ --}}
<header class="top-header">
  <div class="top-header-inner">
    <a class="header-logo" href="{{ route('user.dashboard') }}">
      <div class="logo-mark">
        <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/><circle cx="12" cy="9" r="2.5" fill="white" stroke="none"/></svg>
      </div>
      <span class="logo-text">Parki<em>fy</em></span>
    </a>
    <div class="header-right">
      <a class="btn-icon" href="{{ route('user.dashboard') }}" title="Ke Beranda">
        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
      </a>
      <div class="user-chip">
        <div class="user-avatar">
          @if(auth()->user()->foto)
            <img src="{{ asset('storage/'.auth()->user()->foto) }}" alt="">
          @else
            {{ strtoupper(substr(auth()->user()->name,0,2)) }}
          @endif
        </div>
        <span class="user-name">{{ auth()->user()->name }}</span>
      </div>
    </div>
  </div>
</header>

{{-- ══ PAGE DATA ══ --}}
@php
  $slot         = $pemesanan->slotParkir;
  $lokasi       = $slot->lokasiParkir;
  $kendaraan    = $pemesanan->kendaraan;
  $pembayaran   = $pemesanan->pembayaran;

  $kodePemesanan = $pemesanan->kode_pemesanan;
  $slotKode      = $slot->kode_slot;
  $lokasiNama    = $lokasi->nama;
  $kendaraanPlat = $kendaraan->plat_nomor;
  $kendaraanNama = trim(($kendaraan->merek ?? '') . ' ' . ($kendaraan->model ?? ''));

  $waktuMulai    = \Carbon\Carbon::parse($pemesanan->waktu_mulai);
  $waktuSelesai  = \Carbon\Carbon::parse($pemesanan->waktu_selesai);
  $durasi        = $pemesanan->durasi_parkir;
  $hargaPerJam   = $lokasi->harga_per_jam;
  $subtotal      = $hargaPerJam * $durasi;
  $ppn           = (int) round($subtotal * 0.10);
  $totalHarga    = $pemesanan->total_harga;

  $metode        = $pembayaran?->metode ?? '-';
  $metodeLabel   = ['bca'=>'Transfer BCA','qris'=>'QRIS','gopay'=>'GoPay','ovo'=>'OVO','dana'=>'DANA'];
  $statusPembayaran = $pembayaran?->status ?? 'menunggu';
@endphp

<div class="page-wrap">

  {{-- page title --}}
  <div class="page-title-row">
    <a class="back-btn" href="{{ url()->previous() }}">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"/></svg>
    </a>
    <span class="page-title-text">QR Tiket Parkir</span>
  </div>

  {{-- ── TIKET CARD ── --}}
  <div class="tiket-card" id="tiket-card">

    {{-- header biru --}}
    <div class="tiket-head">
      <div class="tiket-brand">
        <div class="tiket-brand-mark">
          <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/><circle cx="12" cy="9" r="2.5" fill="white" stroke="none"/></svg>
        </div>
        <span class="tiket-brand-name">Parki<em>fy</em></span>
      </div>
      <div class="tiket-lokasi">{{ $lokasiNama }}</div>
      <div style="display:flex;align-items:center;gap:8px;margin-top:8px">
        <div class="tiket-slot-badge">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="1" y="3" width="15" height="13" rx="2"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="12.5" cy="18.5" r="2.5"/></svg>
          Slot {{ $slotKode }}
        </div>
        @if($statusPembayaran === 'sukses')
          <div class="status-badge">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            Lunas
          </div>
        @else
          <div class="status-badge" style="background:#fff7ed;border-color:#fed7aa;color:#f59e0b">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            Menunggu
          </div>
        @endif
      </div>
    </div>

    {{-- tear line --}}
    <div class="tiket-tear">
      <div class="tiket-tear-circle left"></div>
      <div class="tiket-tear-line"></div>
      <div class="tiket-tear-circle right"></div>
    </div>

    {{-- QR code --}}
    <div class="tiket-qr-section">
      <div class="qr-box">
        <div id="qr-render"></div>
      </div>
      <div class="tiket-kode">{{ $kodePemesanan }}</div>
      <div class="tiket-qr-hint">Tunjukkan QR ini kepada petugas parkir<br>saat masuk & keluar area parkir</div>
    </div>

    {{-- info rows --}}
    <div class="tiket-info-rows">
      <div class="tiket-info-row">
        <span class="tir-label">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="3" width="15" height="13" rx="2"/><path d="M16 8h4a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2h-4"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
          Kendaraan
        </span>
        <span class="tir-val">{{ $kendaraanNama ?: $kendaraanPlat }} · {{ $kendaraanPlat }}</span>
      </div>
      <div class="tiket-info-row">
        <span class="tir-label">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
          Mulai parkir
        </span>
        <span class="tir-val">{{ $waktuMulai->format('d M Y, H:i') }} WIB</span>
      </div>
      <div class="tiket-info-row">
        <span class="tir-label">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
          Selesai parkir
        </span>
        <span class="tir-val">{{ $waktuSelesai->format('d M Y, H:i') }} WIB</span>
      </div>
      <div class="tiket-info-row">
        <span class="tir-label">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
          Durasi
        </span>
        <span class="tir-val">{{ $durasi }} jam</span>
      </div>
      <div class="tiket-info-row">
        <span class="tir-label">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
          Harga/Jam
        </span>
        <span class="tir-val">Rp {{ number_format($hargaPerJam, 0, ',', '.') }}</span>
      </div>
      <div class="tiket-info-row">
        <span class="tir-label">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
          PPN (10%)
        </span>
        <span class="tir-val">Rp {{ number_format($ppn, 0, ',', '.') }}</span>
      </div>
      <div class="tiket-info-row">
        <span class="tir-label">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>
          Metode bayar
        </span>
        <span class="tir-val">{{ $metodeLabel[$metode] ?? $metode }}</span>
      </div>
    </div>

    {{-- total --}}
    <div class="tiket-total-strip">
      <span class="tiket-total-label">Total Pembayaran</span>
      <span class="tiket-total-val">Rp {{ number_format($totalHarga, 0, ',', '.') }}</span>
    </div>

  </div>{{-- end tiket-card --}}

</div>{{-- end page-wrap --}}

{{-- ══ DOWNLOAD BUTTON (fixed) ══ --}}
<div class="dl-btn-wrap">
  <button class="btn-dl" onclick="downloadTiket()">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
    Download Tiket
  </button>
  <a class="btn-dl-sec" href="{{ route('user.dashboard') }}" title="Ke Beranda">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
  </a>
</div>

{{-- ══ BOTTOM NAV ══ --}}
<nav class="bottom-nav">
  <div class="bottom-nav-inner">
    <a class="bn-item" href="{{ route('user.dashboard') }}">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
      <span>Home</span>
    </a>
    <a class="bn-item" href="{{ route('user.lokasi') }}">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
      <span>Cari</span>
    </a>
    <a class="bn-item" href="{{ route('user.kendaraan') }}">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="3" width="15" height="13" rx="2"/><path d="M16 8h4a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2h-4"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
      <span>Kendaraan</span>
    </a>
    <a class="bn-item active" href="#">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="3" height="3"/></svg>
      <span>QR Tiket</span>
    </a>
  </div>
</nav>

<script>
// ── Generate QR (HD) ──
new QRCode(document.getElementById('qr-render'), {
  text:          '{{ $kodePemesanan }}',
  width:         400,   // ← naikkan dari 180
  height:        400,
  colorDark:     '#0f1e36',
  colorLight:    '#ffffff',
  correctLevel:  QRCode.CorrectLevel.H
});

// ── Download QR saja ──
function downloadTiket() {
  const qrCanvas = document.querySelector('#qr-render canvas');
  if (!qrCanvas) { alert('QR belum siap, coba sebentar lagi.'); return; }

  const kode  = '{{ $kodePemesanan }}';
  const pad   = 40;
  const textH = 60;

  const out = document.createElement('canvas');
  out.width  = qrCanvas.width  + pad * 2;
  out.height = qrCanvas.height + pad * 2 + textH;

  const ctx = out.getContext('2d');

  ctx.fillStyle = '#ffffff';
  ctx.fillRect(0, 0, out.width, out.height);

  ctx.drawImage(qrCanvas, pad, pad);

  ctx.fillStyle    = '#94a3b8';
  ctx.font         = `bold 28px "Plus Jakarta Sans", sans-serif`;
  ctx.textAlign    = 'center';
  ctx.textBaseline = 'middle';
  ctx.fillText(kode, out.width / 2, qrCanvas.height + pad + textH / 2);

  const link = document.createElement('a');
  link.download = `qr-parkify-${kode}.png`;
  link.href     = out.toDataURL('image/png');
  link.click();
}
</script>
</body>
</html>