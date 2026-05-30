<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
<title>Parkify — Pembayaran Berhasil</title>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
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
.page-wrap{max-width:var(--max-w);margin:0 auto;padding-bottom:calc(var(--bottom-nav-h) + 120px + env(safe-area-inset-bottom));padding-top:8px}

/* ══ SUCCESS HERO ══ */
.success-hero{margin:20px 20px 0;background:var(--bg-surface);border-radius:var(--r-xl);border:1px solid var(--border);box-shadow:var(--shadow-md);padding:32px 24px 28px;text-align:center;position:relative;overflow:hidden}
.success-hero::before{content:'';position:absolute;top:-60px;left:50%;transform:translateX(-50%);width:200px;height:200px;background:radial-gradient(circle,rgba(16,185,129,.10) 0%,transparent 70%);pointer-events:none}

/* Animated check */
.success-icon-wrap{width:68px;height:68px;border-radius:50%;background:linear-gradient(135deg,#10b981,#059669);margin:0 auto 20px;display:flex;align-items:center;justify-content:center;box-shadow:0 6px 24px rgba(16,185,129,.35),0 0 0 10px rgba(16,185,129,.08),0 0 0 20px rgba(16,185,129,.04);animation:success-pop .5s cubic-bezier(.34,1.56,.64,1) both}
@keyframes success-pop{from{transform:scale(0);opacity:0}to{transform:scale(1);opacity:1}}
.success-icon-wrap svg{width:32px;height:32px;stroke:#fff;stroke-width:3;animation:check-draw .4s ease .3s both}
@keyframes check-draw{from{stroke-dasharray:0 100;opacity:0}to{stroke-dasharray:100 0;opacity:1}}

.success-label{font-size:13px;font-weight:700;color:var(--text-muted);letter-spacing:.3px;margin-bottom:6px;animation:fade-up .4s ease .2s both}
.success-amount{font-size:34px;font-weight:800;color:var(--text-primary);letter-spacing:-1.5px;font-variant-numeric:tabular-nums;animation:fade-up .4s ease .3s both}
@keyframes fade-up{from{opacity:0;transform:translateY(10px)}to{opacity:1;transform:translateY(0)}}

/* ══ DETAIL CARD ══ */
.detail-card{margin:12px 20px 0;background:var(--bg-surface);border-radius:var(--r-xl);border:1px solid var(--border);box-shadow:var(--shadow-md);overflow:hidden;animation:fade-up .4s ease .35s both}
.detail-card-header{padding:16px 20px;display:flex;align-items:center;justify-content:space-between;cursor:pointer;user-select:none;-webkit-tap-highlight-color:transparent}
.detail-card-title{font-size:15px;font-weight:800;color:var(--text-primary);letter-spacing:-.2px}
.detail-toggle{width:28px;height:28px;border-radius:50%;background:var(--bg-input);border:1px solid var(--border);display:flex;align-items:center;justify-content:center;transition:transform .25s,background .15s}
.detail-toggle.open{transform:rotate(180deg);background:var(--blue-soft);border-color:var(--blue-pale)}
.detail-toggle svg{width:14px;height:14px;color:var(--text-secondary)}
.detail-toggle.open svg{color:var(--blue-main)}
.detail-body{border-top:1px solid var(--border);overflow:hidden;max-height:0;transition:max-height .35s cubic-bezier(.4,0,.2,1)}
.detail-body.open{max-height:400px}
.detail-rows{padding:14px 20px 6px;display:flex;flex-direction:column;gap:0}
.drow{display:flex;align-items:center;justify-content:space-between;padding:10px 0;border-bottom:1px solid var(--bg-input)}
.drow:last-child{border-bottom:none}
.drow-label{font-size:12.5px;color:var(--text-muted);font-weight:600}
.drow-val{font-size:12.5px;color:var(--text-primary);font-weight:700;text-align:right;max-width:60%}
.drow-val.green{display:flex;align-items:center;gap:5px;color:var(--green)}
.drow-val.green svg{width:13px;height:13px;flex-shrink:0}
.detail-total-row{padding:14px 20px 16px;display:flex;align-items:center;justify-content:space-between;border-top:1px solid var(--border);margin-top:4px}
.detail-total-label{font-size:13px;font-weight:800;color:var(--text-primary)}
.detail-total-val{font-size:18px;font-weight:800;color:var(--text-primary);letter-spacing:-.5px}

/* ══ BOOKING INFO CARD ══ */
.booking-info-card{margin:12px 20px 0;background:var(--blue-soft);border-radius:var(--r-lg);border:1px solid var(--blue-pale);padding:14px 16px;display:flex;align-items:center;gap:12px;animation:fade-up .4s ease .45s both}
.bic-icon{width:40px;height:40px;border-radius:var(--r-md);background:var(--blue-main);display:flex;align-items:center;justify-content:center;flex-shrink:0}
.bic-icon svg{width:20px;height:20px;stroke:#fff}
.bic-info{flex:1;min-width:0}
.bic-label{font-size:10.5px;font-weight:700;color:var(--blue-bright);text-transform:uppercase;letter-spacing:.4px;margin-bottom:3px}
.bic-val{font-size:14px;font-weight:800;color:var(--text-primary)}
.bic-sub{font-size:11.5px;color:var(--text-secondary);font-weight:500;margin-top:2px}

/* ══ QR BUTTON (floating fixed) ══ */
.qr-btn-wrap{
  position:fixed;
  bottom:calc(var(--bottom-nav-h) + 12px + env(safe-area-inset-bottom));
  left:50%;
  transform:translateX(-50%);
  width:calc(min(var(--max-w),100vw) - 40px);
  z-index:500;
  animation:slide-up-btn .5s cubic-bezier(.34,1.20,.64,1) .6s both
}
@keyframes slide-up-btn{from{transform:translateX(-50%) translateY(40px);opacity:0}to{transform:translateX(-50%) translateY(0);opacity:1}}
.btn-qr{
  width:100%;
  padding:17px 24px;
  background:var(--blue-main);
  color:#fff;
  border:none;
  border-radius:999px;
  font-family:inherit;
  font-size:15px;
  font-weight:800;
  letter-spacing:.1px;
  cursor:pointer;
  display:flex;
  align-items:center;
  justify-content:center;
  gap:10px;
  box-shadow:0 6px 28px rgba(37,99,235,.40),0 2px 8px rgba(37,99,235,.20);
  transition:all .2s;
  text-decoration:none
}
.btn-qr:hover{background:var(--blue-bright);transform:translateY(-2px);box-shadow:0 10px 36px rgba(37,99,235,.50)}
.btn-qr svg{width:20px;height:20px;opacity:.9;flex-shrink:0}

/* ══ CONFETTI DOTS ══ */
.confetti-wrap{position:fixed;inset:0;pointer-events:none;z-index:9999;overflow:hidden}
.confetti-dot{position:absolute;top:-10px;border-radius:50%;animation:confetti-fall linear both}
@keyframes confetti-fall{0%{transform:translateY(0) rotate(0deg);opacity:1}100%{transform:translateY(110vh) rotate(720deg);opacity:0}}

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

@media(min-width:860px){
  :root{--max-w:560px}
  .bottom-nav{display:none}
  .page-wrap{padding-bottom:80px}
  .qr-btn-wrap{bottom:24px}
  .user-name{display:block !important}
}
@media(max-width:479px){
  .user-name{display:none}
  .success-amount{font-size:28px}
}
</style>
</head>
<body>

{{-- Confetti container --}}
<div class="confetti-wrap" id="confetti-wrap"></div>

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
  $pemesanan    = $pembayaran->pemesanan;
  $slot         = $pemesanan->slotParkir;
  $lokasi       = $slot->lokasiParkir;
  $kendaraan    = $pemesanan->kendaraan;

  $totalHarga    = $pembayaran->jumlah;
  $refNumber     = $pembayaran->referensi_pembayaran ?? '-';
  $dibayarPada   = $pembayaran->dibayar_pada
                     ? \Carbon\Carbon::parse($pembayaran->dibayar_pada)
                     : \Carbon\Carbon::now();
  $metode        = $pembayaran->metode;
  $metodeLabel   = ['bca'=>'Transfer BCA','qris'=>'QRIS','gopay'=>'GoPay','ovo'=>'OVO','dana'=>'DANA'];
  $kodePemesanan = $pemesanan->kode_pemesanan;
  $pemesananId   = $pemesanan->id;

  $slotKode      = $slot->kode_slot;
  $lokasiNama    = $lokasi->nama;
  $kendaraanPlat = $kendaraan->plat_nomor;

  $waktuMulai    = \Carbon\Carbon::parse($pemesanan->waktu_mulai);
  $waktuSelesai  = \Carbon\Carbon::parse($pemesanan->waktu_selesai);
  $durasi        = $pemesanan->durasi_parkir;
  $hargaPerJam   = $lokasi->harga_per_jam;
  $subtotal      = $hargaPerJam * $durasi;
  $ppn           = (int) round($subtotal * 0.10);
@endphp

<div class="page-wrap">

  {{-- ── Success Hero ── --}}
  <div class="success-hero">
    <div class="success-icon-wrap">
      <svg viewBox="0 0 24 24" fill="none"><polyline points="20 6 9 17 4 12"/></svg>
    </div>
    <div class="success-label">Pembayaran berhasil !</div>
    <div class="success-amount">Rp {{ number_format($totalHarga, 0, ',', '.') }}</div>
  </div>

  {{-- ── Booking Info Strip ── --}}
  <div class="booking-info-card">
    <div class="bic-icon">
      <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5"><rect x="1" y="3" width="15" height="13" rx="2"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="12.5" cy="18.5" r="2.5"/></svg>
    </div>
    <div class="bic-info">
      <div class="bic-label">Slot Parkir</div>
      <div class="bic-val">{{ $slotKode }} — {{ $lokasiNama }}</div>
      <div class="bic-sub">{{ $waktuMulai->format('H:i') }} – {{ $waktuSelesai->format('H:i') }} WIB · {{ $durasi }} jam · {{ $kendaraanPlat }}</div>
    </div>
  </div>

  {{-- ── Detail Card (collapsible) ── --}}
  <div class="detail-card">
    <div class="detail-card-header" onclick="toggleDetail()" id="detail-header">
      <span class="detail-card-title">Detail Pembayaran</span>
      <div class="detail-toggle open" id="detail-toggle">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="18 15 12 9 6 15"/></svg>
      </div>
    </div>
    <div class="detail-body open" id="detail-body">
      <div class="detail-rows">
        <div class="drow">
          <span class="drow-label">Ref Number</span>
          <span class="drow-val">{{ $refNumber }}</span>
        </div>
        <div class="drow">
          <span class="drow-label">Kode Booking</span>
          <span class="drow-val">{{ $kodePemesanan }}</span>
        </div>
        <div class="drow">
          <span class="drow-label">Payment Status</span>
          <span class="drow-val green">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            Berhasil
          </span>
        </div>
        <div class="drow">
          <span class="drow-label">Payment Time</span>
          <span class="drow-val">{{ $dibayarPada->format('d-m-Y H:i:s') }}</span>
        </div>
        <div class="drow">
          <span class="drow-label">Metode</span>
          <span class="drow-val">{{ $metodeLabel[$metode] ?? $metode }}</span>
        </div>
        <div class="drow">
          <span class="drow-label">Harga/Jam</span>
          <span class="drow-val">Rp {{ number_format($hargaPerJam, 0, ',', '.') }}</span>
        </div>
        <div class="drow">
          <span class="drow-label">Durasi</span>
          <span class="drow-val">{{ $durasi }} jam</span>
        </div>
        <div class="drow">
          <span class="drow-label">Subtotal</span>
          <span class="drow-val">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
        </div>
        <div class="drow">
          <span class="drow-label">PPN (10%)</span>
          <span class="drow-val">Rp {{ number_format($ppn, 0, ',', '.') }}</span>
        </div>
      </div>
      <div class="detail-total-row">
        <span class="detail-total-label">Total Payment</span>
        <span class="detail-total-val">Rp {{ number_format($totalHarga, 0, ',', '.') }}</span>
      </div>
    </div>
  </div>

</div>{{-- end page-wrap --}}

{{-- ══ QR CODE BUTTON (fixed) ══ --}}
<div class="qr-btn-wrap">
  <a class="btn-qr" href="{{ route('user.booking.qr', $pemesananId) }}">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
      <rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/>
      <rect x="3" y="14" width="7" height="7"/>
      <rect x="14" y="14" width="3" height="3"/><rect x="19" y="14" width="2" height="2"/>
      <rect x="14" y="19" width="2" height="2"/><rect x="18" y="19" width="3" height="2"/>
    </svg>
    Lihat QR Code Tiket
  </a>
</div>

{{-- ══ BOTTOM NAV ══ --}}
<nav class="bottom-nav">
  <div class="bottom-nav-inner">
    <a class="bn-item active" href="{{ route('user.dashboard') }}">
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
    <a class="bn-item" href="{{ route('user.pengaturan') }}">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.07 4.93l-1.41 1.41M4.93 4.93l1.41 1.41M12 2v2m0 16v2m7.07 1.07l-1.41-1.41M4.93 19.07l1.41-1.41M22 12h-2M4 12H2"/></svg>
      <span>Pengaturan</span>
    </a>
  </div>
</nav>

<script>
// ── Collapsible detail ──
function toggleDetail() {
  const body   = document.getElementById('detail-body');
  const toggle = document.getElementById('detail-toggle');
  const isOpen = body.classList.contains('open');
  body.classList.toggle('open', !isOpen);
  toggle.classList.toggle('open', !isOpen);
}

// ── Confetti burst ──
(function spawnConfetti() {
  const wrap   = document.getElementById('confetti-wrap');
  const colors = ['#10b981','#2563eb','#f59e0b','#3b82f6','#a7f3d0','#dbeafe'];
  const sizes  = [6, 8, 10, 7, 9];
  for (let i = 0; i < 48; i++) {
    const dot = document.createElement('div');
    dot.className = 'confetti-dot';
    const size  = sizes[Math.floor(Math.random() * sizes.length)];
    const color = colors[Math.floor(Math.random() * colors.length)];
    const left  = Math.random() * 100;
    const delay = Math.random() * 1.2;
    const dur   = 2.2 + Math.random() * 1.8;
    dot.style.cssText = `
      width:${size}px;height:${size}px;
      background:${color};
      left:${left}%;
      animation-name:confetti-fall;
      animation-duration:${dur}s;
      animation-delay:${delay}s;
      animation-fill-mode:both;
    `;
    wrap.appendChild(dot);
  }
  // Remove after animation done
  setTimeout(() => { wrap.innerHTML = ''; }, 4500);
})();
</script>
</body>
</html>