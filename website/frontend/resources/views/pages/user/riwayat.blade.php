<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
<title>Parkify — Riwayat Booking</title>
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
<style>
/* ═══════════════════════════════════════
   TOKENS
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

  --green:      #10b981;
  --green-soft: #ecfdf5;
  --red:        #ef4444;
  --red-soft:   #fef2f2;
  --amber:      #f59e0b;
  --amber-soft: #fffbeb;

  --shadow-sm:   0 1px 4px rgba(15,30,54,0.07), 0 1px 2px rgba(15,30,54,0.04);
  --shadow-md:   0 4px 16px rgba(15,30,54,0.10), 0 2px 4px rgba(15,30,54,0.05);
  --shadow-lg:   0 10px 32px rgba(15,30,54,0.13);

  --bottom-nav-h: 72px;
  --max-content:  1100px;
}

/* ═══════════════════════════════════════
   RESET
═══════════════════════════════════════ */
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
html, body { overflow-x: hidden; width: 100%; }

body {
  font-family: 'Poppins', sans-serif;
  background: linear-gradient(180deg, #D9E5F8 0%, #ECF2FB 50%, #D9E5F8 100%);
  background-attachment: fixed;
  color: var(--text-primary);
  min-height: 100vh;
}

::-webkit-scrollbar { width: 4px; }
::-webkit-scrollbar-thumb { background: var(--border); border-radius: 999px; }

/* ═══════════════════════════════════════
   TOP HEADER
═══════════════════════════════════════ */
.top-header {
  background: var(--bg-surface);
  border-bottom: 1px solid var(--border);
  position: sticky; top: 0; z-index: 100; width: 100%;
}
.top-header-inner {
  max-width: var(--max-content); margin: 0 auto;
  padding: 0 24px; height: 64px;
  display: flex; align-items: center;
  justify-content: space-between; gap: 16px; width: 100%;
}
.header-logo {
  display: flex; align-items: center; gap: 9px;
  flex-shrink: 0; text-decoration: none;
}
.logo-icon {
  width: 36px; height: 36px; background: var(--blue-main);
  border-radius: 10px; display: flex; align-items: center; justify-content: center;
}
.logo-icon svg { color: #fff; }
.logo-text {
  font-family: 'Space Grotesk', sans-serif;
  font-size: 20px; font-weight: 800; color: var(--text-primary); letter-spacing: -0.5px;
}
.logo-text span { color: var(--blue-main); }

.desktop-nav { display: flex; align-items: center; gap: 4px; }
.desktop-nav a {
  display: flex; align-items: center; gap: 6px;
  padding: 7px 14px; border-radius: 10px;
  font-size: 13px; font-weight: 500; color: var(--text-secondary);
  text-decoration: none; transition: all 0.16s; cursor: pointer;
}
.desktop-nav a:hover { background: var(--bg-hover); color: var(--text-primary); }
.desktop-nav a.active {
  background: var(--blue-soft); color: var(--blue-main);
  font-weight: 600; border: 1px solid var(--blue-pale);
}

.header-user {
  display: flex; align-items: center; gap: 10px;
  padding: 6px 12px 6px 6px; border-radius: 12px;
  background: var(--bg-input); border: 1px solid var(--border);
  cursor: pointer; transition: border-color 0.16s; flex-shrink: 0;
}
.header-user:hover { border-color: var(--border-focus); }
.user-avatar {
  width: 32px; height: 32px; border-radius: 50%;
  background: linear-gradient(135deg, #f59e0b, #ef4444);
  display: flex; align-items: center; justify-content: center;
  font-weight: 700; font-size: 13px; color: #fff;
  font-family: 'Space Grotesk', sans-serif; flex-shrink: 0;
}
.user-name-text { font-size: 13px; font-weight: 600; color: var(--text-primary); white-space: nowrap; }

.icon-btn {
  width: 36px; height: 36px; background: var(--bg-input);
  border: 1px solid var(--border); border-radius: 10px;
  display: flex; align-items: center; justify-content: center;
  cursor: pointer; color: var(--text-secondary); transition: all 0.15s; flex-shrink: 0;
}
.icon-btn:hover { border-color: var(--border-focus); color: var(--text-primary); }

/* ═══════════════════════════════════════
   MAIN
═══════════════════════════════════════ */
.main-wrap {
  width: 100%;
  padding-bottom: calc(var(--bottom-nav-h) + 24px + env(safe-area-inset-bottom));
}
.content-inner {
  max-width: 680px; margin: 0 auto;
  padding: 0 24px; width: 100%;
}

/* ═══════════════════════════════════════
   PAGE TOP BAR
═══════════════════════════════════════ */
.page-topbar {
  max-width: 680px; margin: 0 auto;
  padding: 24px 24px 0;
  display: flex; align-items: center; gap: 12px;
}
.back-btn {
  width: 38px; height: 38px;
  background: var(--bg-surface); border: 1px solid var(--border);
  border-radius: 12px; display: flex; align-items: center; justify-content: center;
  cursor: pointer; color: var(--text-secondary);
  transition: border-color 0.15s, color 0.15s;
  box-shadow: var(--shadow-sm); flex-shrink: 0; text-decoration: none;
}
.back-btn:hover { border-color: var(--border-focus); color: var(--text-primary); }
.page-topbar-title {
  font-family: 'Space Grotesk', sans-serif;
  font-size: 20px; font-weight: 800; color: var(--text-primary);
  flex: 1; letter-spacing: -0.3px;
}

/* ═══════════════════════════════════════
   FILTER TABS
═══════════════════════════════════════ */
.filter-tabs {
  display: flex; gap: 8px;
  margin-top: 20px; margin-bottom: 16px;
  overflow-x: auto; padding-bottom: 2px;
  scrollbar-width: none;
}
.filter-tabs::-webkit-scrollbar { display: none; }

.filter-tab {
  flex-shrink: 0;
  padding: 7px 16px; border-radius: 999px;
  font-size: 12.5px; font-weight: 600;
  font-family: 'Poppins', sans-serif;
  cursor: pointer; border: 1.5px solid var(--border);
  background: var(--bg-card); color: var(--text-secondary);
  transition: all 0.18s; white-space: nowrap;
}
.filter-tab:hover { border-color: var(--blue-pale); color: var(--blue-main); }
.filter-tab.active {
  background: var(--blue-main); color: #fff;
  border-color: var(--blue-main);
  box-shadow: 0 3px 10px rgba(37,99,235,0.25);
}

/* ═══════════════════════════════════════
   SUMMARY STRIP
═══════════════════════════════════════ */
.summary-strip {
  display: flex; align-items: center; justify-content: space-between;
  margin-bottom: 14px; flex-wrap: wrap; gap: 8px;
}
.summary-count {
  font-size: 13px; color: var(--text-muted); font-weight: 500;
}
.summary-count span {
  font-family: 'Space Grotesk', sans-serif;
  font-weight: 800; color: var(--text-primary); font-size: 14px;
}

/* ═══════════════════════════════════════
   MONTH GROUP LABEL
═══════════════════════════════════════ */
.month-label {
  font-family: 'Space Grotesk', sans-serif;
  font-size: 11.5px; font-weight: 700;
  color: var(--text-muted); letter-spacing: 0.06em;
  text-transform: uppercase;
  margin: 18px 0 10px;
}
.month-label:first-child { margin-top: 0; }

/* ═══════════════════════════════════════
   BOOKING CARD
═══════════════════════════════════════ */
.booking-list {
  display: flex; flex-direction: column; gap: 12px;
}

.booking-card {
  background: var(--bg-card);
  border: 1.5px solid var(--border);
  border-radius: 20px;
  overflow: hidden;
  box-shadow: var(--shadow-sm);
  transition: border-color 0.2s, box-shadow 0.2s, transform 0.18s;
  cursor: pointer;
  text-decoration: none; color: inherit;
  display: block;
}
.booking-card:hover {
  border-color: var(--blue-pale);
  box-shadow: var(--shadow-md);
  transform: translateY(-2px);
}
.booking-card:active { transform: scale(0.985); }

/* Status stripe on top */
.booking-card.status-done   { border-top: 3px solid var(--green); }
.booking-card.status-active { border-top: 3px solid var(--blue-main); }
.booking-card.status-cancel { border-top: 3px solid var(--red); }

.card-head {
  padding: 14px 16px 10px;
  display: flex; align-items: flex-start; gap: 12px;
}

.card-loc-wrap { flex: 1; min-width: 0; }

.card-loc-name {
  font-size: 11px; font-weight: 600;
  color: var(--blue-main); margin-bottom: 2px;
  letter-spacing: 0.02em;
}

.card-slot {
  font-family: 'Space Grotesk', sans-serif;
  font-size: 28px; font-weight: 800;
  color: var(--text-primary); letter-spacing: -1px;
  line-height: 1.1;
}

.card-map-thumb {
  width: 68px; height: 54px; border-radius: 12px;
  background: #e8eef8; border: 1px solid var(--border);
  overflow: hidden; flex-shrink: 0;
  display: flex; align-items: center; justify-content: center;
  position: relative;
}
.card-map-thumb svg.map-pin { position: absolute; }
.map-bg {
  width: 100%; height: 100%;
  background:
    repeating-linear-gradient(0deg, transparent, transparent 9px, rgba(37,99,235,0.06) 9px, rgba(37,99,235,0.06) 10px),
    repeating-linear-gradient(90deg, transparent, transparent 9px, rgba(37,99,235,0.06) 9px, rgba(37,99,235,0.06) 10px),
    linear-gradient(135deg, #dce8f8, #eaf1fb);
}

.card-divider {
  height: 1px; background: var(--border); margin: 0 16px;
}

.card-vehicle-row {
  padding: 9px 16px;
  display: flex; align-items: center; gap: 7px;
}
.card-vehicle-plate {
  display: inline-flex; align-items: center; gap: 5px;
  font-family: 'Space Grotesk', sans-serif;
  font-size: 11.5px; font-weight: 700;
  color: var(--text-secondary);
  background: var(--bg-input); border: 1px solid var(--border);
  padding: 3px 10px; border-radius: 6px; letter-spacing: 0.04em;
}
.card-vehicle-name {
  font-size: 12px; font-weight: 500; color: var(--text-muted);
}

.card-log-row {
  padding: 4px 16px 12px;
}
.card-log-title {
  font-size: 11px; font-weight: 600; color: var(--text-muted);
  margin-bottom: 8px; letter-spacing: 0.03em;
}

.log-timeline {
  display: flex; flex-direction: column; gap: 0;
  position: relative;
}
.log-item {
  display: flex; align-items: center; gap: 10px;
  position: relative; padding-left: 0;
}
.log-dot-wrap {
  display: flex; flex-direction: column; align-items: center;
  width: 14px; flex-shrink: 0; position: relative;
}
.log-dot {
  width: 11px; height: 11px; border-radius: 50%;
  flex-shrink: 0; z-index: 1;
  border: 2px solid currentColor;
}
.log-dot.dot-in  { color: var(--green);  background: var(--green-soft); }
.log-dot.dot-out { color: var(--green);  background: var(--green); }
.log-line {
  width: 2px; height: 16px;
  background: repeating-linear-gradient(
    to bottom,
    var(--green) 0px, var(--green) 4px,
    transparent 4px, transparent 7px
  );
  margin: 1px 0;
}
.log-time {
  font-family: 'Space Grotesk', sans-serif;
  font-size: 14px; font-weight: 700;
  color: var(--text-primary); min-width: 44px;
}
.log-date {
  font-size: 11.5px; color: var(--text-muted); font-weight: 400;
}

.card-footer {
  padding: 10px 16px 14px;
  display: flex; align-items: center; justify-content: space-between; gap: 8px;
  border-top: 1px solid var(--border);
}
.footer-total-label {
  font-size: 11px; color: var(--text-muted); font-weight: 500; margin-bottom: 1px;
}
.footer-total-val {
  font-family: 'Space Grotesk', sans-serif;
  font-size: 17px; font-weight: 800; color: var(--text-primary);
}
.footer-duration {
  font-size: 11px; color: var(--text-muted); font-weight: 500;
}

.status-badge {
  display: inline-flex; align-items: center; gap: 5px;
  padding: 5px 12px; border-radius: 999px;
  font-size: 11.5px; font-weight: 700;
  font-family: 'Poppins', sans-serif; white-space: nowrap;
}
.badge-done   { background: var(--green-soft); color: var(--green); }
.badge-active { background: var(--blue-soft);  color: var(--blue-main); }
.badge-cancel { background: var(--red-soft);   color: var(--red); }

/* Check icon animation */
.check-icon { animation: pop-in 0.35s cubic-bezier(0.34,1.56,0.64,1) both; }
@keyframes pop-in { from { transform: scale(0); opacity: 0; } to { transform: scale(1); opacity: 1; } }

/* ═══════════════════════════════════════
   EMPTY STATE
═══════════════════════════════════════ */
.empty-state {
  text-align: center; padding: 60px 20px 40px;
}
.empty-icon {
  width: 72px; height: 72px; border-radius: 20px;
  background: var(--blue-soft); border: 1px solid var(--blue-pale);
  display: flex; align-items: center; justify-content: center;
  margin: 0 auto 16px; color: var(--blue-main);
}
.empty-title {
  font-family: 'Space Grotesk', sans-serif;
  font-size: 16px; font-weight: 800; color: var(--text-primary); margin-bottom: 8px;
}
.empty-desc { font-size: 13px; color: var(--text-muted); line-height: 1.6; }

/* ═══════════════════════════════════════
   BOTTOM NAV
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
  padding: 6px 8px; gap: 6px; pointer-events: all;
  width: auto; max-width: calc(100vw - 32px);
}
.bn-item {
  display: flex; flex-direction: row; align-items: center; justify-content: center;
  gap: 7px; padding: 10px 12px; border-radius: 999px; cursor: pointer;
  color: var(--text-secondary); font-size: 13px; font-weight: 600;
  font-family: 'Poppins', sans-serif;
  transition: all 0.22s cubic-bezier(0.34, 1.56, 0.64, 1);
  -webkit-tap-highlight-color: transparent; white-space: nowrap; background: transparent;
}
.bn-item:not(.active) { background: #f3f4f6; border-radius: 50%; width: 46px; height: 46px; padding: 0; }
.bn-item:not(.active) span { display: none; }
.bn-item svg { width: 22px; height: 22px; flex-shrink: 0; }
.bn-item.active { background: var(--blue-main); color: #fff; padding: 12px 20px; border-radius: 999px; width: auto; height: auto; }
.bn-item.active span { display: inline; color: #fff; }
.bn-item:not(.active):hover { background: #e9eaf0; border-radius: 50%; }

/* ═══════════════════════════════════════
   RESPONSIVE
═══════════════════════════════════════ */
@media (min-width: 860px) {
  .bottom-nav { display: none; }
  .main-wrap { padding-bottom: 48px; }
}
@media (max-width: 859px) {
  .desktop-nav { display: none; }
  .header-user .user-name-text { display: none; }
  .top-header-inner { padding: 0 16px; }
  .page-topbar { padding: 20px 16px 0; }
  .content-inner { padding: 0 16px; }
  .card-slot { font-size: 24px; }
}
@media (max-width: 400px) {
  .card-slot { font-size: 21px; }
  .card-map-thumb { width: 56px; height: 46px; }
}
</style>
</head>
<body>

<!-- ════════════ TOP HEADER ════════════ -->
<header class="top-header">
  <div class="top-header-inner">
    <a class="header-logo" href="#">
      <div class="logo-icon">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
          <rect x="1" y="3" width="15" height="13" rx="2"/>
          <path d="M16 8h4a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2h-4"/>
          <circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/>
        </svg>
      </div>
      <span class="logo-text">Parki<span>fy</span></span>
    </a>

    <nav class="desktop-nav">
      <a href="#">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
        Home
      </a>
      <a href="#">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="3" width="15" height="13" rx="2"/><path d="M16 8h4a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2h-4"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
        Kendaraan
      </a>
      <a class="active">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
        Riwayat
      </a>
      <a href="#">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.07 4.93l-1.41 1.41M4.93 4.93l1.41 1.41M12 2v2m0 16v2m7.07 1.07l-1.41-1.41M4.93 19.07l1.41-1.41M22 12h-2M4 12H2"/></svg>
        Pengaturan
      </a>
    </nav>

    <div style="display:flex;align-items:center;gap:10px;margin-left:auto">
      <div style="position:relative">
        <div class="icon-btn">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
        </div>
        <div style="position:absolute;top:7px;right:7px;width:8px;height:8px;background:var(--red);border-radius:50%;border:2px solid #fff"></div>
      </div>
      <div class="header-user">
        <div class="user-avatar">AM</div>
        <span class="user-name-text">Adam Mustahir</span>
      </div>
    </div>
  </div>
</header>

<!-- ════════════ MAIN ════════════ -->
<main class="main-wrap">

  <!-- Page top bar -->
  <div class="page-topbar">
    <a class="back-btn" href="#" title="Kembali">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"/></svg>
    </a>
    <div class="page-topbar-title">Riwayat Booking</div>
    <div class="icon-btn" title="Opsi">
      <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="5" r="1"/><circle cx="12" cy="12" r="1"/><circle cx="12" cy="19" r="1"/></svg>
    </div>
  </div>

  <div class="content-inner">

    <!-- Filter Tabs -->
    <div class="filter-tabs" id="filterTabs">
      <button class="filter-tab active" data-filter="all">Semua</button>
      <button class="filter-tab" data-filter="done">Selesai</button>
      <button class="filter-tab" data-filter="active">Aktif</button>
      <button class="filter-tab" data-filter="cancel">Dibatalkan</button>
    </div>

    <!-- Summary -->
    <div class="summary-strip">
      <div class="summary-count"><span id="bookingCount">0</span> riwayat booking</div>
    </div>

    <!-- Booking List -->
    <div class="booking-list" id="bookingList"></div>

  </div>
</main>

<!-- ════════════ BOTTOM NAV ════════════ -->
<nav class="bottom-nav">
  <div class="bottom-nav-inner">
    <div class="bn-item" id="bn-home">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
      <span>Home</span>
    </div>
    <div class="bn-item" id="bn-kendaraan">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="3" width="15" height="13" rx="2"/><path d="M16 8h4a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2h-4"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
      <span>Kendaraan</span>
    </div>
    <div class="bn-item active" id="bn-riwayat">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
      <span>Riwayat</span>
    </div>
    <div class="bn-item" id="bn-settings">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.07 4.93l-1.41 1.41M4.93 4.93l1.41 1.41M12 2v2m0 16v2m7.07 1.07l-1.41-1.41M4.93 19.07l1.41-1.41M22 12h-2M4 12H2"/></svg>
      <span>Pengaturan</span>
    </div>
  </div>
</nav>

<script>
/* ═══════════════════════════════════════
   DATA
═══════════════════════════════════════ */
const bookings = [
  {
    id: 'BK-001',
    location: 'Parkir Mall BTM',
    slot: 'A-012',
    plate: 'F 922 XX',
    vehicleName: 'BMW M4 CS/CSL',
    checkIn:  { time: '11:00', date: '03/06/2022' },
    checkOut: { time: '13:00', date: '03/06/2022' },
    duration: '2 jam',
    total: 'Rp6.600',
    status: 'done',
    month: 'Juni 2022',
  },
  {
    id: 'BK-002',
    location: 'Parkir Mall BTM',
    slot: 'A-012',
    plate: 'F 922 XX',
    vehicleName: 'BMW M4 CS/CSL',
    checkIn:  { time: '08:30', date: '01/06/2022' },
    checkOut: { time: '10:00', date: '01/06/2022' },
    duration: '1,5 jam',
    total: 'Rp4.950',
    status: 'done',
    month: 'Juni 2022',
  },
  {
    id: 'BK-003',
    location: 'Parkir Stasiun Bogor',
    slot: 'C-007',
    plate: 'B 1234 AB',
    vehicleName: 'Toyota Avanza',
    checkIn:  { time: '14:00', date: '29/05/2022' },
    checkOut: { time: '16:30', date: '29/05/2022' },
    duration: '2,5 jam',
    total: 'Rp8.250',
    status: 'done',
    month: 'Mei 2022',
  },
  {
    id: 'BK-004',
    location: 'Parkir Transmart Yasmin',
    slot: 'B-019',
    plate: 'D 5678 CD',
    vehicleName: 'Honda Jazz RS',
    checkIn:  { time: '10:15', date: '22/05/2022' },
    checkOut: null,
    duration: 'Sedang Parkir',
    total: 'Rp3.300',
    status: 'active',
    month: 'Mei 2022',
  },
  {
    id: 'BK-005',
    location: 'Parkir Mall Botani Square',
    slot: 'D-003',
    plate: 'B 4455 GH',
    vehicleName: 'Yamaha NMAX 155',
    checkIn:  { time: '09:00', date: '15/05/2022' },
    checkOut: { time: '11:00', date: '15/05/2022' },
    duration: '2 jam',
    total: 'Rp4.000',
    status: 'cancel',
    month: 'Mei 2022',
  },
  {
    id: 'BK-006',
    location: 'Parkir Mall BTM',
    slot: 'A-008',
    plate: 'B 9900 KL',
    vehicleName: 'Mitsubishi Xpander',
    checkIn:  { time: '13:00', date: '10/04/2022' },
    checkOut: { time: '15:30', date: '10/04/2022' },
    duration: '2,5 jam',
    total: 'Rp8.250',
    status: 'done',
    month: 'April 2022',
  },
];

/* ═══════════════════════════════════════
   RENDER
═══════════════════════════════════════ */
let currentFilter = 'all';

function statusMeta(status) {
  if (status === 'done')   return { cls: 'badge-done',   label: '✓ Selesai',    cardCls: 'status-done'   };
  if (status === 'active') return { cls: 'badge-active', label: '● Aktif',      cardCls: 'status-active' };
  if (status === 'cancel') return { cls: 'badge-cancel', label: '✕ Dibatalkan', cardCls: 'status-cancel' };
}

function renderBookings() {
  const list = currentFilter === 'all'
    ? bookings
    : bookings.filter(b => b.status === currentFilter);

  document.getElementById('bookingCount').textContent = list.length;
  const container = document.getElementById('bookingList');

  if (list.length === 0) {
    container.innerHTML = `
      <div class="empty-state">
        <div class="empty-icon">
          <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
            <polyline points="14 2 14 8 20 8"/>
            <line x1="16" y1="13" x2="8" y2="13"/>
            <line x1="16" y1="17" x2="8" y2="17"/>
          </svg>
        </div>
        <div class="empty-title">Tidak ada riwayat</div>
        <div class="empty-desc">Belum ada booking dengan status ini.<br>Mulai parkir sekarang!</div>
      </div>`;
    return;
  }

  // Group by month
  const groups = {};
  list.forEach(b => {
    if (!groups[b.month]) groups[b.month] = [];
    groups[b.month].push(b);
  });

  let html = '';
  Object.entries(groups).forEach(([month, items]) => {
    html += `<div class="month-label">${month}</div>`;
    items.forEach(b => {
      const sm = statusMeta(b.status);
      const mapThumb = `
        <div class="card-map-thumb">
          <div class="map-bg"></div>
          <svg class="map-pin" width="22" height="28" viewBox="0 0 22 28" fill="none">
            <path d="M11 0C6.03 0 2 4.03 2 9c0 6.5 9 19 9 19s9-12.5 9-19c0-4.97-4.03-9-9-9z" fill="#1d4ed8"/>
            <circle cx="11" cy="9" r="4" fill="white"/>
          </svg>
        </div>`;

      const checkOutRow = b.checkOut
        ? `<div class="log-item">
             <div class="log-dot-wrap"><div class="log-dot dot-out"></div></div>
             <span class="log-time">${b.checkOut.time}</span>
             <span class="log-date">${b.checkOut.date}</span>
           </div>`
        : `<div class="log-item">
             <div class="log-dot-wrap"><div class="log-dot dot-in" style="border-style:dashed;opacity:0.5"></div></div>
             <span class="log-time" style="color:var(--text-muted)">--:--</span>
             <span class="log-date" style="font-style:italic">Belum checkout</span>
           </div>`;

      const footerRight = b.status === 'done'
        ? `<svg class="check-icon" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="var(--green)" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>`
        : `<span class="status-badge ${sm.cls}">${sm.label}</span>`;

      html += `
        <a class="booking-card ${sm.cardCls}" href="#" onclick="handleBookingClick(event,'${b.id}')">
          <!-- Head -->
          <div class="card-head">
            <div class="card-loc-wrap">
              <div class="card-loc-name">${b.location}</div>
              <div class="card-slot">${b.slot}</div>
            </div>
            ${mapThumb}
          </div>

          <div class="card-divider"></div>

          <!-- Vehicle -->
          <div class="card-vehicle-row">
            <span class="card-vehicle-plate">
              <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 3h-8v4h8z"/></svg>
              ${b.plate}
            </span>
            <span class="card-vehicle-name">${b.vehicleName}</span>
          </div>

          <div class="card-divider"></div>

          <!-- Log -->
          <div class="card-log-row">
            <div class="card-log-title">Log activities</div>
            <div class="log-timeline">
              <div class="log-item">
                <div class="log-dot-wrap">
                  <div class="log-dot dot-in"></div>
                  <div class="log-line"></div>
                </div>
                <span class="log-time">${b.checkIn.time}</span>
                <span class="log-date">${b.checkIn.date}</span>
              </div>
              ${checkOutRow}
            </div>
          </div>

          <!-- Footer -->
          <div class="card-footer">
            <div>
              <div class="footer-total-label">Total</div>
              <div class="footer-total-val">${b.total}</div>
            </div>
            <div style="display:flex;align-items:center;gap:8px">
              <span class="footer-duration" style="color:var(--text-muted)">${b.duration}</span>
              ${footerRight}
            </div>
          </div>
        </a>`;
    });
  });

  container.innerHTML = html;
}

/* ═══════════════════════════════════════
   FILTER TABS
═══════════════════════════════════════ */
document.getElementById('filterTabs').addEventListener('click', e => {
  const tab = e.target.closest('.filter-tab');
  if (!tab) return;
  document.querySelectorAll('.filter-tab').forEach(t => t.classList.remove('active'));
  tab.classList.add('active');
  currentFilter = tab.dataset.filter;
  renderBookings();
});

/* ═══════════════════════════════════════
   CARD CLICK
═══════════════════════════════════════ */
function handleBookingClick(e, id) {
  e.preventDefault();
  console.log('Navigate to booking id:', id);
}

/* Init */
renderBookings();
</script>
</body>
</html>