<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
<title>Parkify — Pilih Slot</title>
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
<style>
/* ═══════════════════════════════════════
   TOKENS  (same as parent pages)
═══════════════════════════════════════ */
:root {
  --bg-base:      #D9E5F8;
  --bg-surface:   #ffffff;
  --bg-card:      #ffffff;
  --bg-input:     #f3f6fb;
  --bg-hover:     #f0f4ff;
  --border:       #e2e8f2;
  --border-focus: #93c5fd;

  --text-primary:   #0f1e36;
  --text-secondary: #4a6080;
  --text-muted:     #94a3b8;

  --blue-main:   #2563eb;
  --blue-bright: #3b82f6;
  --blue-pale:   #dbeafe;
  --blue-soft:   #eff6ff;

  --green:       #10b981;
  --green-soft:  #ecfdf5;
  --red:         #ef4444;
  --red-soft:    #fef2f2;
  --amber:       #f59e0b;
  --amber-soft:  #fffbeb;

  --shadow-sm:   0 1px 4px rgba(15,30,54,0.07), 0 1px 2px rgba(15,30,54,0.04);
  --shadow-md:   0 4px 16px rgba(15,30,54,0.10), 0 2px 4px rgba(15,30,54,0.05);
  --shadow-lg:   0 10px 32px rgba(15,30,54,0.13);
  --shadow-card: 0 2px 12px rgba(37,99,235,0.08);

  --bottom-nav-h: 72px;
  --max-content:  480px;
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
html, body { overflow-x: hidden; width: 100%; }

body {
  font-family: 'Poppins', sans-serif;
  background: var(--bg-base);
  color: var(--text-primary);
  min-height: 100vh;
}

::-webkit-scrollbar { width: 4px; }
::-webkit-scrollbar-thumb { background: var(--border); border-radius: 999px; }

/* ═══════════════════════════════════════
   TOP HEADER
═══════════════════════════════════════ */
.top-header {
  background: rgba(255,255,255,0.75);
  backdrop-filter: blur(18px) saturate(1.6);
  -webkit-backdrop-filter: blur(18px) saturate(1.6);
  border-bottom: 1px solid rgba(255,255,255,0.55);
  box-shadow: 0 2px 16px rgba(15,30,54,0.07);
  position: sticky;
  top: 0; left: 0; right: 0;
  z-index: 200;
  width: 100%;
}

.top-header-inner {
  max-width: var(--max-content);
  margin: 0 auto;
  padding: 0 20px;
  height: 64px;
  display: flex; align-items: center;
  justify-content: space-between; gap: 12px;
  width: 100%;
}

.header-logo {
  display: flex; align-items: center; gap: 8px;
  text-decoration: none;
}
.logo-icon {
  width: 40px; height: 40px;
  border-radius: 12px;
  background: var(--bg-surface);
  display: flex; align-items: center; justify-content: center;
  box-shadow: var(--shadow-md);
  overflow: hidden;
}
.logo-icon img { width: 26px; height: 26px; object-fit: contain; }
.logo-text {
  font-family: 'Space Grotesk', sans-serif;
  font-size: 18px; font-weight: 800;
  color: var(--text-primary); letter-spacing: -0.5px;
}
.logo-text span { color: var(--blue-main); }

.header-right { display: flex; align-items: center; gap: 8px; }

.header-back-btn {
  width: 38px; height: 38px;
  background: rgba(255,255,255,0.9); backdrop-filter: blur(12px);
  border: 1px solid rgba(255,255,255,0.7); border-radius: 12px;
  display: flex; align-items: center; justify-content: center;
  cursor: pointer; box-shadow: var(--shadow-sm);
  color: var(--text-secondary); text-decoration: none;
  transition: border-color 0.15s, color 0.15s;
}
.header-back-btn:hover { border-color: var(--blue-main); color: var(--blue-main); }

.header-user-chip {
  display: flex; align-items: center; gap: 8px;
  background: rgba(255,255,255,0.9);
  backdrop-filter: blur(12px);
  border: 1px solid rgba(255,255,255,0.7);
  border-radius: 12px;
  padding: 5px 10px 5px 5px;
  cursor: pointer; box-shadow: var(--shadow-sm);
}
.user-avatar {
  width: 30px; height: 30px; border-radius: 50%;
  background: linear-gradient(135deg, #f59e0b, #ef4444);
  display: flex; align-items: center; justify-content: center;
  font-weight: 700; font-size: 11px; color: #fff;
  font-family: 'Space Grotesk', sans-serif;
  flex-shrink: 0; overflow: hidden;
}
.user-avatar img { width: 100%; height: 100%; object-fit: cover; }
.user-name-text {
  font-size: 12px; font-weight: 600; color: var(--text-primary); white-space: nowrap;
}

/* ═══════════════════════════════════════
   HERO / LOKASI INFO
═══════════════════════════════════════ */
.hero-section {
  position: relative;
  max-width: var(--max-content); margin: 0 auto;
}

.hero-img {
  width: 100%; height: 200px; object-fit: cover; display: block;
}
.hero-img-placeholder {
  width: 100%; height: 200px;
  background: linear-gradient(135deg, #c7d9f5 0%, #a8c4f0 100%);
  display: flex; align-items: center; justify-content: center;
  font-size: 56px;
}
.hero-overlay {
  position: absolute; inset: 0;
  background: linear-gradient(to bottom, transparent 40%, rgba(15,30,54,0.55) 100%);
}
.hero-bottom {
  position: absolute; bottom: 16px; left: 20px; right: 20px;
  display: flex; align-items: flex-end; justify-content: space-between;
}
.hero-name {
  font-family: 'Space Grotesk', sans-serif;
  font-size: 20px; font-weight: 800; color: #fff;
  text-shadow: 0 2px 8px rgba(0,0,0,0.4); line-height: 1.2;
}
.hero-sub {
  font-size: 11.5px; color: rgba(255,255,255,0.8); margin-top: 3px;
  font-weight: 500; display: flex; align-items: center; gap: 4px;
}
.hero-status-badge {
  font-size: 11px; font-weight: 600;
  padding: 4px 10px; border-radius: 999px;
  backdrop-filter: blur(8px); white-space: nowrap;
  display: flex; align-items: center; gap: 4px;
}
.hero-status-badge.avail { background: rgba(236,253,245,0.88); color: var(--green); }
.hero-status-badge.busy  { background: rgba(255,251,235,0.88); color: var(--amber); }
.hero-status-badge.full  { background: rgba(254,242,242,0.88); color: var(--red); }

/* ═══════════════════════════════════════
   CONTENT PANEL
═══════════════════════════════════════ */
.content-panel {
  position: relative; z-index: 20;
  max-width: var(--max-content); margin: -20px auto 0;
  background: #ffffff;
  border-radius: 24px 24px 0 0;
  box-shadow: 0 -4px 24px rgba(15,30,54,0.08);
  padding-bottom: calc(var(--bottom-nav-h) + 100px + env(safe-area-inset-bottom));
  min-height: 60vh;
}

/* ═══════════════════════════════════════
   INFO STRIP
═══════════════════════════════════════ */
.info-strip {
  display: flex; gap: 8px; padding: 20px 20px 0;
  overflow-x: auto; -webkit-overflow-scrolling: touch; scrollbar-width: none;
}
.info-strip::-webkit-scrollbar { display: none; }

.info-chip {
  display: flex; align-items: center; gap: 6px;
  background: var(--bg-input); border: 1px solid var(--border);
  border-radius: 10px; padding: 7px 11px;
  font-size: 11.5px; font-weight: 600; color: var(--text-secondary);
  white-space: nowrap; flex-shrink: 0;
}
.info-chip svg { color: var(--blue-main); flex-shrink: 0; }
.info-chip.price { background: var(--blue-soft); border-color: var(--blue-pale); color: var(--blue-main); }

/* ═══════════════════════════════════════
   STEP INDICATOR
═══════════════════════════════════════ */
.step-indicator {
  padding: 18px 20px 0;
  display: flex; align-items: center; gap: 8px;
}
.step-dot {
  width: 28px; height: 28px; border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
  font-size: 11px; font-weight: 700; font-family: 'Space Grotesk', sans-serif;
  flex-shrink: 0; transition: all 0.25s;
}
.step-dot.active { background: var(--blue-main); color: #fff; }
.step-dot.done   { background: var(--green); color: #fff; }
.step-dot.idle   { background: var(--bg-input); color: var(--text-muted); border: 1.5px solid var(--border); }

.step-label {
  font-size: 11.5px; font-weight: 600;
  transition: color 0.25s;
}
.step-label.active { color: var(--blue-main); }
.step-label.done   { color: var(--green); }
.step-label.idle   { color: var(--text-muted); }

.step-line {
  flex: 1; height: 2px; border-radius: 999px;
  background: var(--border); transition: background 0.3s;
  max-width: 32px;
}
.step-line.done { background: var(--green); }

/* ═══════════════════════════════════════
   SECTION TITLE
═══════════════════════════════════════ */
.section-title {
  padding: 18px 20px 4px;
  font-family: 'Space Grotesk', sans-serif;
  font-size: 16px; font-weight: 800; color: var(--text-primary);
}
.section-sub {
  padding: 0 20px 14px;
  font-size: 12px; color: var(--text-muted);
}

/* ═══════════════════════════════════════
   ZONA GRID
═══════════════════════════════════════ */
.zona-grid {
  padding: 0 20px;
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(130px, 1fr));
  gap: 10px;
}

.zona-card {
  border: 2px solid var(--border);
  border-radius: 16px;
  padding: 16px 12px;
  background: var(--bg-surface);
  cursor: pointer;
  transition: all 0.2s cubic-bezier(0.34,1.26,0.64,1);
  display: flex; flex-direction: column; align-items: center; gap: 8px;
  position: relative; overflow: hidden;
}
.zona-card:hover {
  border-color: var(--blue-pale);
  background: var(--blue-soft);
  transform: translateY(-2px);
  box-shadow: var(--shadow-md);
}
.zona-card.selected {
  border-color: var(--blue-main);
  background: var(--blue-soft);
  box-shadow: 0 0 0 3px rgba(37,99,235,0.12), var(--shadow-md);
}
.zona-card.selected::after {
  content: '';
  position: absolute; top: 8px; right: 8px;
  width: 16px; height: 16px; border-radius: 50%;
  background: var(--blue-main);
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='10' viewBox='0 0 24 24' fill='none' stroke='white' stroke-width='3'%3E%3Cpolyline points='20 6 9 17 4 12'/%3E%3C/svg%3E");
  background-repeat: no-repeat; background-position: center; background-size: 10px;
}

.zona-icon {
  width: 44px; height: 44px; border-radius: 12px;
  background: var(--bg-input); border: 1px solid var(--border);
  display: flex; align-items: center; justify-content: center;
  font-size: 20px; transition: all 0.2s;
}
.zona-card.selected .zona-icon {
  background: var(--blue-pale); border-color: var(--blue-pale);
}
.zona-card:hover .zona-icon { background: var(--blue-pale); border-color: var(--blue-pale); }

.zona-name {
  font-family: 'Space Grotesk', sans-serif;
  font-size: 13px; font-weight: 700; color: var(--text-primary); text-align: center;
}
.zona-slot-count {
  font-size: 11px; color: var(--text-muted); font-weight: 500;
}
.zona-card.selected .zona-slot-count { color: var(--blue-bright); }

/* ═══════════════════════════════════════
   SLOT GRID
═══════════════════════════════════════ */
.slot-section { animation: slideUp 0.28s ease; }

@keyframes slideUp {
  from { opacity: 0; transform: translateY(14px); }
  to   { opacity: 1; transform: translateY(0); }
}

.slot-legend {
  padding: 0 20px 12px;
  display: flex; gap: 12px; flex-wrap: wrap;
}
.legend-item {
  display: flex; align-items: center; gap: 5px;
  font-size: 11px; color: var(--text-muted); font-weight: 500;
}
.legend-dot {
  width: 10px; height: 10px; border-radius: 3px;
}
.legend-dot.avail { background: var(--bg-input); border: 1.5px solid var(--border); }
.legend-dot.selected-dot { background: var(--blue-main); }
.legend-dot.occupied { background: #e2e8f2; }

.slot-grid {
  padding: 0 20px;
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 10px;
}

.slot-btn {
  border: 2px solid var(--border);
  border-radius: 14px;
  padding: 16px 8px;
  background: var(--bg-surface);
  cursor: pointer;
  transition: all 0.18s cubic-bezier(0.34,1.26,0.64,1);
  display: flex; flex-direction: column;
  align-items: center; justify-content: center; gap: 4px;
  position: relative; min-height: 72px;
}
.slot-btn:not(.occupied):hover {
  border-color: var(--blue-pale);
  background: var(--blue-soft);
  transform: translateY(-2px);
  box-shadow: var(--shadow-sm);
}
.slot-btn.selected {
  border-color: var(--blue-main);
  background: var(--blue-main);
  box-shadow: 0 4px 16px rgba(37,99,235,0.35);
  transform: translateY(-2px) scale(1.03);
}
.slot-btn.occupied {
  background: var(--bg-input); border-color: #e2e8f2;
  cursor: not-allowed; opacity: 0.55;
}

.slot-kode {
  font-family: 'Space Grotesk', sans-serif;
  font-size: 13px; font-weight: 700; color: var(--text-primary);
  transition: color 0.15s;
}
.slot-btn.selected .slot-kode { color: #fff; }
.slot-btn.occupied .slot-kode { color: var(--text-muted); }

.slot-status-dot {
  width: 6px; height: 6px; border-radius: 50%;
  background: var(--green);
  transition: background 0.15s;
}
.slot-btn.occupied .slot-status-dot { background: var(--text-muted); }
.slot-btn.selected .slot-status-dot { background: rgba(255,255,255,0.6); }

/* Car icon inside selected */
.slot-car-icon {
  display: none;
  position: absolute; top: 6px; right: 7px;
}
.slot-btn.selected .slot-car-icon { display: block; }
.slot-btn.selected .slot-status-dot { display: none; }

/* ═══════════════════════════════════════
   NEXT BUTTON
═══════════════════════════════════════ */
.next-btn-wrap {
  padding: 20px 20px 0;
}
.next-btn {
  width: 100%; padding: 16px;
  background: var(--blue-main); color: #fff;
  border: none; border-radius: 16px;
  font-family: 'Space Grotesk', sans-serif;
  font-size: 15px; font-weight: 700; letter-spacing: 0.2px;
  cursor: pointer; transition: all 0.2s;
  display: flex; align-items: center; justify-content: center; gap: 8px;
  box-shadow: 0 4px 20px rgba(37,99,235,0.30);
}
.next-btn:hover:not(:disabled) {
  background: var(--blue-bright);
  box-shadow: 0 6px 28px rgba(37,99,235,0.40);
  transform: translateY(-1px);
}
.next-btn:disabled {
  background: var(--bg-input); color: var(--text-muted);
  box-shadow: none; cursor: not-allowed; transform: none;
  border: 1.5px solid var(--border);
}

/* ═══════════════════════════════════════
   BOOKING INFO BAR (bottom sticky)
═══════════════════════════════════════ */
.booking-bar {
  position: fixed;
  bottom: calc(var(--bottom-nav-h) + 8px + env(safe-area-inset-bottom));
  left: 50%; transform: translateX(-50%) translateY(120%);
  width: calc(min(var(--max-content), 100vw) - 32px);
  z-index: 500;
  background: var(--bg-surface);
  border: 1px solid var(--border);
  border-radius: 20px;
  box-shadow: var(--shadow-lg);
  padding: 14px 16px;
  display: flex; align-items: center; gap: 12px;
  transition: transform 0.35s cubic-bezier(0.34,1.26,0.64,1);
}
.booking-bar.visible {
  transform: translateX(-50%) translateY(0);
}

.booking-bar-info { flex: 1; }
.booking-bar-label {
  font-size: 10.5px; color: var(--text-muted); font-weight: 500; margin-bottom: 2px;
}
.booking-bar-slot {
  font-family: 'Space Grotesk', sans-serif;
  font-size: 14px; font-weight: 800; color: var(--text-primary);
  display: flex; align-items: center; gap: 6px;
}
.booking-bar-slot-badge {
  background: var(--blue-soft); border: 1px solid var(--blue-pale);
  color: var(--blue-main); border-radius: 6px; padding: 1px 7px;
  font-size: 11.5px; font-weight: 700;
}
.booking-bar-price {
  font-size: 12px; color: var(--text-secondary); margin-top: 2px;
  display: flex; align-items: center; gap: 10px;
}
.booking-bar-price strong { color: var(--blue-main); font-weight: 700; }

.booking-confirm-btn {
  padding: 12px 20px;
  background: var(--blue-main); color: #fff;
  border: none; border-radius: 13px;
  font-family: 'Space Grotesk', sans-serif;
  font-size: 13px; font-weight: 700;
  cursor: pointer; white-space: nowrap;
  box-shadow: 0 3px 14px rgba(37,99,235,0.30);
  transition: all 0.18s; flex-shrink: 0;
}
.booking-confirm-btn:hover {
  background: var(--blue-bright);
  box-shadow: 0 4px 18px rgba(37,99,235,0.40);
}

/* ═══════════════════════════════════════
   BOTTOM NAV (unchanged from parent)
═══════════════════════════════════════ */
.bottom-nav {
  position: fixed; bottom: 0; left: 0; right: 0; width: 100%;
  z-index: 9999; display: flex; align-items: flex-end; justify-content: center;
  background: transparent; pointer-events: none;
  padding-bottom: calc(12px + env(safe-area-inset-bottom));
}
.bottom-nav-inner {
  display: flex; align-items: center;
  background: var(--bg-surface); border: 1px solid var(--border);
  border-radius: 999px;
  box-shadow: 0 4px 24px rgba(15,30,54,0.13), 0 1px 4px rgba(15,30,54,0.06);
  padding: 6px 8px; gap: 6px;
  pointer-events: all; width: auto; max-width: calc(100vw - 32px);
}
.bn-item {
  display: flex; flex-direction: row; align-items: center;
  justify-content: center; gap: 7px;
  padding: 10px 12px; border-radius: 999px;
  cursor: pointer; color: var(--text-secondary);
  font-size: 13px; font-weight: 600; font-family: 'Poppins', sans-serif;
  transition: all 0.22s cubic-bezier(0.34,1.56,0.64,1);
  -webkit-tap-highlight-color: transparent;
  white-space: nowrap; background: transparent; text-decoration: none;
}
.bn-item:not(.active) {
  background: #f3f4f6; border-radius: 50%;
  width: 46px; height: 46px; padding: 0;
}
.bn-item:not(.active) span { display: none; }
.bn-item svg { width: 22px; height: 22px; flex-shrink: 0; }
.bn-item.active {
  background: var(--blue-main); color: #fff;
  padding: 12px 20px; border-radius: 999px; width: auto; height: auto;
}
.bn-item.active span { display: inline; color: #fff; }
.bn-item:not(.active):hover { background: #e9eaf0; border-radius: 50%; }

/* ═══════════════════════════════════════
   PAGE WRAP
═══════════════════════════════════════ */
.page-wrap { max-width: var(--max-content); margin: 0 auto; position: relative; }

/* ═══════════════════════════════════════
   DESKTOP
═══════════════════════════════════════ */
@media (min-width: 860px) {
  .bottom-nav { display: none; }
  .content-panel { padding-bottom: 40px; }
  :root { --max-content: 560px; }
  .slot-grid { grid-template-columns: repeat(4, 1fr); }
  .booking-bar { bottom: 20px; }
}
@media (max-width: 859px) {
  .user-name-text { display: none !important; }
}
</style>
</head>
<body>

{{-- ════════ TOP HEADER ════════ --}}
<header class="top-header">
  <div class="top-header-inner">
    <a class="header-logo" href="{{ route('user.dashboard') }}">
      <div class="logo-icon">
        <img src="{{ asset('assets/img/logo-round.png') }}" alt="Parkify">
      </div>
      <span class="logo-text">Parki<span>fy</span></span>
    </a>

    <div class="header-right">
      <a class="header-back-btn" href="{{ route('user.lokasi.show', $lokasi->id) }}" title="Kembali">
        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <polyline points="15 18 9 12 15 6"/>
        </svg>
      </a>
      <div class="header-user-chip">
        <div class="user-avatar">
          @if(auth()->user()->foto)
            <img src="{{ asset('storage/' . auth()->user()->foto) }}" alt="">
          @else
            {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
          @endif
        </div>
        <span class="user-name-text">{{ auth()->user()->name }}</span>
      </div>
    </div>
  </div>
</header>

{{-- ════════ HERO SECTION ════════ --}}
<div class="page-wrap">
  <div class="hero-section">
    @if($lokasi->foto)
      <img class="hero-img" src="{{ asset('storage/' . $lokasi->foto) }}" alt="{{ $lokasi->nama }}">
    @else
      <div class="hero-img-placeholder">🏬</div>
    @endif
    <div class="hero-overlay"></div>
    <div class="hero-bottom">
      <div>
        <div class="hero-name">{{ $lokasi->nama }}</div>
        <div class="hero-sub">
          <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
          {{ $lokasi->alamat }}
        </div>
      </div>
      @php
        $slotTersedia = $lokasi->slotParkir()->where('status','tersedia')->count();
        $totalSlot    = $lokasi->slotParkir()->count();
        $ratio = $totalSlot > 0 ? $slotTersedia / $totalSlot : 0;
        $heroStatus = $ratio > 0.4 ? 'avail' : ($ratio > 0 ? 'busy' : 'full');
        $heroStatusLabel = ['avail' => 'Tersedia', 'busy' => 'Hampir Penuh', 'full' => 'Penuh'];
      @endphp
      <div class="hero-status-badge {{ $heroStatus }}">
        <span style="width:6px;height:6px;border-radius:50%;background:currentColor;display:inline-block"></span>
        {{ $heroStatusLabel[$heroStatus] }}
      </div>
    </div>
  </div>

  {{-- ════════ CONTENT PANEL ════════ --}}
  <div class="content-panel">

    {{-- Info Strip --}}
    <div class="info-strip">
      @if($lokasi->jam_buka && $lokasi->jam_tutup)
      <div class="info-chip">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
        {{ \Carbon\Carbon::parse($lokasi->jam_buka)->format('H:i') }} – {{ \Carbon\Carbon::parse($lokasi->jam_tutup)->format('H:i') }} WIB
      </div>
      @endif
      <div class="info-chip price">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/></svg>
        Rp {{ number_format($lokasi->harga_per_jam, 0, ',', '.') }}/jam
      </div>
      <div class="info-chip">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="1" y="3" width="15" height="13" rx="2"/><circle cx="5.5" cy="18.5" r="2.5"/></svg>
        {{ $slotTersedia }} / {{ $totalSlot }} tersedia
      </div>
    </div>

    {{-- Step Indicator --}}
    <div class="step-indicator">
      <div class="step-dot active" id="dot1">1</div>
      <span class="step-label active" id="label1">Pilih Zona</span>
      <div class="step-line" id="line1"></div>
      <div class="step-dot idle" id="dot2">2</div>
      <span class="step-label idle" id="label2">Pilih Slot</span>
    </div>

    {{-- ════ STEP 1: ZONA ════ --}}
    <div id="step-zona">
      <div class="section-title">Pilih Zona Parkir</div>
      <div class="section-sub">Pilih zona yang kamu inginkan terlebih dahulu</div>

      @php
        // Group slots by zona
        $zonaGroups = $lokasi->slotParkir()
          ->selectRaw('zona, COUNT(*) as total, SUM(status = "tersedia") as tersedia')
          ->groupBy('zona')
          ->get();

        $zonaEmoji = ['A'=>'🅰️','B'=>'🅱️','C'=>'🅾️','D'=>'🇩','E'=>'🇪','F'=>'🅵','G'=>'🇬','H'=>'🇭'];
        $zonaIconDefault = '🏢';
      @endphp

      <div class="zona-grid">
        @forelse($zonaGroups as $zona)
          @php
            $ratioZ = $zona->total > 0 ? $zona->tersedia / $zona->total : 0;
            $statusZ = $ratioZ > 0.4 ? 'has-slot' : ($ratioZ > 0 ? 'few-slot' : 'no-slot');
            $statusColorZ = $ratioZ > 0.4 ? '#10b981' : ($ratioZ > 0 ? '#f59e0b' : '#ef4444');
            $statusTextZ  = $ratioZ > 0.4 ? 'Tersedia' : ($ratioZ > 0 ? 'Hampir Penuh' : 'Penuh');
          @endphp
          <div
            class="zona-card {{ $zona->tersedia == 0 ? 'occupied' : '' }}"
            data-zona="{{ $zona->zona }}"
            onclick="{{ $zona->tersedia > 0 ? 'selectZona(this)' : '' }}"
            style="{{ $zona->tersedia == 0 ? 'opacity:0.5;cursor:not-allowed' : '' }}"
          >
            <div class="zona-icon">{{ $zonaEmoji[$zona->zona] ?? $zonaIconDefault }}</div>
            <div class="zona-name">Zona {{ $zona->zona }}</div>
            <div class="zona-slot-count" style="color:{{ $statusColorZ }}">
              {{ $zona->tersedia }} slot bebas
            </div>
          </div>
        @empty
          <div style="grid-column: 1/-1; text-align:center; padding: 32px 0; color: var(--text-muted); font-size:13px;">
            Tidak ada zona tersedia
          </div>
        @endforelse
      </div>

      <div class="next-btn-wrap">
        <button class="next-btn" id="btn-next-zona" disabled onclick="goToSlot()">
          Lanjut Pilih Slot
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
        </button>
      </div>
    </div>

    {{-- ════ STEP 2: SLOT ════ --}}
    <div id="step-slot" style="display:none">
      <div class="section-title" id="slot-section-title">Pilih Slot — Zona <span id="slot-zona-label">A</span></div>
      <div class="section-sub">Slot berwarna biru = pilihanmu · Abu-abu = terisi</div>

      <div class="slot-legend">
        <div class="legend-item"><div class="legend-dot avail"></div> Tersedia</div>
        <div class="legend-item"><div class="legend-dot selected-dot"></div> Dipilih</div>
        <div class="legend-item"><div class="legend-dot occupied"></div> Terisi</div>
      </div>

      <div class="slot-grid" id="slot-grid">
        {{-- Filled by JS --}}
      </div>

      <div class="next-btn-wrap" style="margin-top:8px">
        <button class="next-btn" style="background:var(--bg-input);color:var(--text-secondary);box-shadow:none;border:1.5px solid var(--border);margin-bottom:10px" onclick="backToZona()">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"/></svg>
          Ganti Zona
        </button>
      </div>
    </div>

  </div>{{-- end content-panel --}}
</div>{{-- end page-wrap --}}

{{-- ════════ BOOKING BAR ════════ --}}
<div class="booking-bar" id="bookingBar">
  <div class="booking-bar-info">
    <div class="booking-bar-label">Konfirmasi Pemesanan</div>
    <div class="booking-bar-slot">
      <span id="bar-slot-name">—</span>
      <span class="booking-bar-slot-badge" id="bar-zona-name">—</span>
    </div>
    <div class="booking-bar-price">
      <strong>Rp {{ number_format($lokasi->harga_per_jam, 0, ',', '.') }}/Jam</strong>
      @if($lokasi->jam_buka)
        <span>{{ \Carbon\Carbon::parse($lokasi->jam_buka)->format('H:i') }} WIB dst.</span>
      @endif
    </div>
  </div>
  <form id="bookingForm" method="POST" action="{{ route('user.lokasi.booking.store') }}">
    @csrf
    <input type="hidden" name="lokasi_parkir_id" value="{{ $lokasi->id }}">
    <input type="hidden" name="slot_id" id="form-slot-id" value="">
    <button type="submit" class="booking-confirm-btn">Konfirmasi</button>
  </form>
</div>

{{-- ════════ BOTTOM NAV ════════ --}}
<nav class="bottom-nav">
  <div class="bottom-nav-inner">
    <a class="bn-item" href="{{ route('user.dashboard') }}">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
      <span>Home</span>
    </a>
    <a class="bn-item active" href="{{ route('user.lokasi') }}">
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

{{-- ════════ SCRIPT ════════ --}}
<script>
// All slots data from PHP, indexed by zona
// const allSlots = @json(
//   $lokasi->slotParkir()
//     ->get(['id','kode_slot','zona','status'])
//     ->groupBy('zona')
// );
const allSlots = {!! json_encode(
    $lokasi->slotParkir()
        ->get(['id', 'kode_slot', 'zona', 'status'])
        ->groupBy('zona')
        ->toArray()
) !!};

let selectedZona   = null;
let selectedSlotId = null;
let selectedSlotKode = null;

/* ─── ZONA SELECTION ─── */
function selectZona(el) {
  document.querySelectorAll('.zona-card').forEach(c => c.classList.remove('selected'));
  el.classList.add('selected');
  selectedZona = el.dataset.zona;
  document.getElementById('btn-next-zona').disabled = false;
}

function goToSlot() {
  if (!selectedZona) return;

  // Transition steps
  document.getElementById('dot1').classList.replace('active','done');
  document.getElementById('dot1').textContent = '✓';
  document.getElementById('label1').classList.replace('active','done');
  document.getElementById('line1').classList.add('done');
  document.getElementById('dot2').classList.replace('idle','active');
  document.getElementById('label2').classList.replace('idle','active');

  document.getElementById('slot-zona-label').textContent = selectedZona;
  renderSlots(selectedZona);

  document.getElementById('step-zona').style.display = 'none';
  document.getElementById('step-slot').style.display = 'block';
  window.scrollTo({ top: 0, behavior: 'smooth' });
}

function backToZona() {
  // Reset step indicator
  document.getElementById('dot1').classList.replace('done','active');
  document.getElementById('dot1').textContent = '1';
  document.getElementById('label1').classList.replace('done','active');
  document.getElementById('line1').classList.remove('done');
  document.getElementById('dot2').classList.replace('active','idle');
  document.getElementById('label2').classList.replace('active','idle');

  // Reset slot selection
  selectedSlotId = null;
  selectedSlotKode = null;
  hideBookingBar();

  document.getElementById('step-slot').style.display = 'none';
  document.getElementById('step-zona').style.display = 'block';
  window.scrollTo({ top: 0, behavior: 'smooth' });
}

/* ─── SLOT RENDER ─── */
function renderSlots(zona) {
  const grid  = document.getElementById('slot-grid');
  const slots = allSlots[zona] || [];
  grid.innerHTML = '';

  slots.forEach(slot => {
    const isOccupied = slot.status !== 'tersedia';
    const btn = document.createElement('div');
    btn.className = 'slot-btn' + (isOccupied ? ' occupied' : '');
    btn.dataset.id   = slot.id;
    btn.dataset.kode = slot.kode_slot;

    btn.innerHTML = `
      <svg class="slot-car-icon" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5">
        <rect x="1" y="3" width="15" height="13" rx="2"/>
        <circle cx="5.5" cy="18.5" r="2.5"/>
        <circle cx="12.5" cy="18.5" r="2.5"/>
      </svg>
      <div class="slot-status-dot"></div>
      <div class="slot-kode">${slot.kode_slot}</div>
    `;

    if (!isOccupied) {
      btn.addEventListener('click', () => selectSlot(btn, slot.id, slot.kode_slot));
    }
    grid.appendChild(btn);
  });
}

/* ─── SLOT SELECTION ─── */
function selectSlot(el, id, kode) {
  if (el.classList.contains('occupied')) return;

  const already = el.classList.contains('selected');

  document.querySelectorAll('.slot-btn').forEach(b => b.classList.remove('selected'));

  if (already) {
    selectedSlotId   = null;
    selectedSlotKode = null;
    hideBookingBar();
  } else {
    el.classList.add('selected');
    selectedSlotId   = id;
    selectedSlotKode = kode;
    showBookingBar(kode);
  }
}

/* ─── BOOKING BAR ─── */
function showBookingBar(kode) {
  document.getElementById('bar-slot-name').textContent   = kode;
  document.getElementById('bar-zona-name').textContent   = 'Zona ' + selectedZona;
  document.getElementById('form-slot-id').value          = selectedSlotId;
  document.getElementById('bookingBar').classList.add('visible');
}
function hideBookingBar() {
  document.getElementById('bookingBar').classList.remove('visible');
  document.getElementById('form-slot-id').value = '';
}
</script>
</body>
</html>