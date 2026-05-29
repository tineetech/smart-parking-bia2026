<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
<title>Parkify — Kendaraan Ku</title>
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
   SUMMARY STRIP
═══════════════════════════════════════ */
.summary-strip {
  display: flex; align-items: center; justify-content: space-between;
  margin-top: 20px; margin-bottom: 16px; flex-wrap: wrap; gap: 10px;
}
.summary-count {
  font-size: 13px; color: var(--text-muted); font-weight: 500;
}
.summary-count span {
  font-family: 'Space Grotesk', sans-serif;
  font-weight: 800; color: var(--text-primary); font-size: 14px;
}

/* ═══════════════════════════════════════
   ADD BUTTON
═══════════════════════════════════════ */
.add-btn {
  display: inline-flex; align-items: center; gap: 7px;
  background: var(--blue-main); color: #fff;
  border: none; border-radius: 12px; padding: 9px 16px;
  font-size: 12.5px; font-weight: 600; font-family: 'Poppins', sans-serif;
  cursor: pointer; transition: background 0.16s, transform 0.15s;
  box-shadow: 0 3px 10px rgba(37,99,235,0.25); white-space: nowrap;
  text-decoration: none;
}
.add-btn:hover { background: var(--blue-bright); transform: translateY(-1px); }

/* ═══════════════════════════════════════
   VEHICLE LIST
═══════════════════════════════════════ */
.vehicle-list {
  display: flex; flex-direction: column; gap: 12px;
}

/* ── Vehicle Row Card — matching design ── */
.vehicle-card {
  background: var(--bg-card);
  border: 1.5px solid var(--border);
  border-radius: 20px;
  padding: 14px 18px 14px 14px;
  display: flex; align-items: center; gap: 14px;
  cursor: pointer;
  transition: border-color 0.2s, box-shadow 0.2s, transform 0.18s, background 0.15s;
  text-decoration: none; color: inherit;
  position: relative;
  overflow: hidden;
  box-shadow: var(--shadow-sm);
}

.vehicle-card:hover {
  border-color: var(--blue-pale);
  box-shadow: var(--shadow-md);
  transform: translateY(-2px);
}

.vehicle-card:active { transform: scale(0.985); }

/* Accent line on left for active vehicle */
.vehicle-card.is-active::before {
  content: '';
  position: absolute; left: 0; top: 20%; bottom: 20%;
  width: 3.5px; background: var(--blue-main);
  border-radius: 0 4px 4px 0;
}

/* Car image area */
.vehicle-img-wrap {
  width: 100px; height: 66px;
  border-radius: 12px;
  background: linear-gradient(135deg, #f0f4fb, #e4edf8);
  display: flex; align-items: center; justify-content: center;
  flex-shrink: 0; overflow: hidden;
  border: 1px solid var(--border);
}

.vehicle-img-wrap img {
  width: 100%; height: 100%; object-fit: cover;
  transition: transform 0.3s ease;
}
.vehicle-card:hover .vehicle-img-wrap img { transform: scale(1.05); }

/* Placeholder car SVG */
.vehicle-img-placeholder {
  display: flex; align-items: center; justify-content: center;
  width: 100%; height: 100%;
}

/* Info block */
.vehicle-info { flex: 1; min-width: 0; }

.vehicle-name {
  font-family: 'Space Grotesk', sans-serif;
  font-size: 14.5px; font-weight: 800;
  color: var(--text-primary);
  margin-bottom: 3px;
  white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
}

.vehicle-plate {
  display: inline-flex; align-items: center; gap: 5px;
  font-family: 'Space Grotesk', sans-serif;
  font-size: 12.5px; font-weight: 700;
  color: var(--text-secondary);
  background: var(--bg-input); border: 1px solid var(--border);
  padding: 3px 10px; border-radius: 7px;
  letter-spacing: 0.04em;
}

.vehicle-meta {
  display: flex; align-items: center; gap: 8px;
  margin-top: 7px; flex-wrap: wrap;
}

.vehicle-tag {
  font-size: 10.5px; font-weight: 600;
  padding: 2px 9px; border-radius: 999px;
  font-family: 'Poppins', sans-serif; white-space: nowrap;
}
.tag-active  { background: var(--green-soft); color: var(--green); }
.tag-inactive{ background: var(--bg-input);   color: var(--text-muted); }
.tag-type    { background: var(--blue-soft);  color: var(--blue-main); }
.tag-motor   { background: var(--amber-soft); color: var(--amber); }

/* Arrow */
.vehicle-arrow {
  color: var(--text-muted); flex-shrink: 0;
  transition: color 0.15s, transform 0.2s;
}
.vehicle-card:hover .vehicle-arrow {
  color: var(--blue-main); transform: translateX(3px);
}

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
   SEARCH BAR
═══════════════════════════════════════ */
.search-bar {
  display: flex; align-items: center; gap: 10px;
  background: var(--bg-card);
  border: 1.5px solid var(--border);
  border-radius: 14px; padding: 11px 16px;
  box-shadow: var(--shadow-sm);
  margin-bottom: 16px;
  transition: border-color 0.18s, box-shadow 0.18s;
}
.search-bar:focus-within {
  border-color: var(--blue-main);
  box-shadow: 0 0 0 3.5px rgba(37,99,235,0.10);
}
.search-bar input {
  flex: 1; border: none; outline: none;
  font-family: 'Poppins', sans-serif;
  font-size: 13px; color: var(--text-primary); background: transparent;
}
.search-bar input::placeholder { color: var(--text-muted); }
.search-icon { color: var(--text-muted); flex-shrink: 0; }

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
  .vehicle-img-wrap { width: 88px; height: 58px; }
}
@media (max-width: 400px) {
  .vehicle-name { font-size: 13px; }
  .vehicle-img-wrap { width: 78px; height: 52px; }
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
      <a class="active">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="3" width="15" height="13" rx="2"/><path d="M16 8h4a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2h-4"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
        Kendaraan
      </a>
      <a>
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
        Riwayat
      </a>
      <a href="parkify-user-settings.html">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.07 4.93l-1.41 1.41M4.93 4.93l1.41 1.41M12 2v2m0 16v2m7.07 1.07l-1.41-1.41M4.93 19.07l1.41-1.41M22 12h-2M4 12H2"/></svg>
        Pengaturan
      </a>
    </nav>

    <div style="display:flex;align-items:center;gap:10px;margin-left:auto">
      <div style="position:relative">
        <div class="icon-btn" style="cursor:pointer">
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
    <a class="back-btn" href="{{  route('user.pengaturan') }}" title="Kembali">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"/></svg>
    </a>
    <div class="page-topbar-title">Kendaraan Ku</div>
    <div class="icon-btn" title="Opsi">
      <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="5" r="1"/><circle cx="12" cy="12" r="1"/><circle cx="12" cy="19" r="1"/></svg>
    </div>
  </div>

  <div class="content-inner">

    <!-- Summary + Add -->
    <div class="summary-strip">
      <div class="summary-count"><span id="vehicleCount">{{ $kendaraan->count() }}</span> kendaraan terdaftar</div>
      <a class="add-btn" href="{{ route('user.kendaraan.create') }}">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Tambah Kendaraan
      </a>
    </div>

    <!-- Search -->
    <div class="search-bar">
      <svg class="search-icon" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
      <input id="searchInput" 
       placeholder="Cari nama atau plat kendaraan..." 
       value="{{ $search ?? '' }}"
       oninput="filterVehicles(this.value)" />
    </div>

    <!-- Vehicle Cards -->
    <div class="vehicle-list" id="vehicleList">
    @forelse ($kendaraan as $v)
        @php
            $isMotor  = strtolower($v->jenis) === 'motor';
            $namaLengkap = trim($v->merek . ' ' . $v->model);

            // Cek apakah kendaraan sedang parkir (ada pemesanan aktif)
            $sedangParkir = $v->pemesanan()
                ->whereIn('status', ['aktif', 'berlangsung'])
                ->exists();
        @endphp

        <a class="vehicle-card {{ $sedangParkir ? 'is-active' : '' }}"
           href="{{ route('user.kendaraan.detail', $v->id) }}">

            {{-- Ilustrasi kendaraan --}}
            <div class="vehicle-img-wrap">
                @if ($isMotor)
                    <svg width="62" height="42" viewBox="0 0 80 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <ellipse cx="20" cy="38" rx="10" ry="10" fill="#cbd5e1" stroke="#94a3b8" stroke-width="2"/>
                        <ellipse cx="20" cy="38" rx="5" ry="5" fill="#e2e8f0"/>
                        <ellipse cx="60" cy="38" rx="10" ry="10" fill="#cbd5e1" stroke="#94a3b8" stroke-width="2"/>
                        <ellipse cx="60" cy="38" rx="5" ry="5" fill="#e2e8f0"/>
                        <path d="M20 28 L35 18 L55 18 L65 28 L20 28Z" fill="#94a3b8" stroke="#64748b" stroke-width="1.5"/>
                        <path d="M35 18 L38 10 L50 10 L55 18Z" fill="#cbd5e1" stroke="#94a3b8" stroke-width="1.5"/>
                        <circle cx="68" cy="22" r="4" fill="#fde68a" stroke="#f59e0b" stroke-width="1.5"/>
                    </svg>
                @else
                    <svg width="96" height="58" viewBox="0 0 120 70" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10 45 L10 35 Q10 28 18 28 L30 20 Q36 15 50 14 L72 14 Q86 14 92 20 L104 28 Q112 28 112 35 L112 45 Q112 50 107 50 L15 50 Q10 50 10 45Z" fill="#cbd5e1" stroke="#94a3b8" stroke-width="2"/>
                        <path d="M30 20 Q36 12 52 11 L72 11 Q86 11 91 20Z" fill="#e2e8f0" stroke="#94a3b8" stroke-width="1.5"/>
                        <path d="M33 20 L39 13 L58 13 L58 20Z" fill="#bfdbfe" stroke="#93c5fd" stroke-width="1" opacity="0.9"/>
                        <path d="M61 20 L61 13 L74 13 L88 20Z" fill="#bfdbfe" stroke="#93c5fd" stroke-width="1" opacity="0.9"/>
                        <circle cx="88" cy="51" r="12" fill="#64748b" stroke="#475569" stroke-width="2"/>
                        <circle cx="88" cy="51" r="6" fill="#94a3b8"/>
                        <circle cx="88" cy="51" r="3" fill="#cbd5e1"/>
                        <circle cx="34" cy="51" r="12" fill="#64748b" stroke="#475569" stroke-width="2"/>
                        <circle cx="34" cy="51" r="6" fill="#94a3b8"/>
                        <circle cx="34" cy="51" r="3" fill="#cbd5e1"/>
                        <ellipse cx="109" cy="36" rx="5" ry="4" fill="#fde68a" stroke="#f59e0b" stroke-width="1.5" opacity="0.9"/>
                        <ellipse cx="13" cy="36" rx="4" ry="3.5" fill="#fca5a5" stroke="#ef4444" stroke-width="1.5" opacity="0.8"/>
                        <line x1="58" y1="16" x2="60" y2="48" stroke="#94a3b8" stroke-width="1" opacity="0.5"/>
                        <rect x="44" y="32" width="9" height="3" rx="1.5" fill="#94a3b8"/>
                        <rect x="68" y="32" width="9" height="3" rx="1.5" fill="#94a3b8"/>
                    </svg>
                @endif
            </div>

            {{-- Info --}}
            <div class="vehicle-info">
                <div class="vehicle-name">{{ $namaLengkap }}</div>
                <div class="vehicle-plate">
                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 3h-8v4h8z"/>
                    </svg>
                    {{ $v->plat_nomor }}
                </div>
                <div class="vehicle-meta">
                    {{-- Jenis --}}
                    @if ($isMotor)
                        <span class="vehicle-tag tag-motor">Motor</span>
                    @else
                        <span class="vehicle-tag tag-type">Mobil</span>
                    @endif

                    {{-- Status utama --}}
                    @if ($v->utama)
                        <span class="vehicle-tag" style="background:#f0fdf4;color:#16a34a">★ Utama</span>
                    @endif

                    {{-- Sedang parkir --}}
                    @if ($sedangParkir)
                        <span class="vehicle-tag" style="background:#eff6ff;color:var(--blue-main)">⬡ Parkir Sekarang</span>
                    @endif
                </div>
            </div>

            <svg class="vehicle-arrow" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <polyline points="9 18 15 12 9 6"/>
            </svg>
        </a>

    @empty
        <div class="empty-state">
            <div class="empty-icon">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <rect x="1" y="3" width="15" height="13" rx="2"/>
                    <path d="M16 8h4a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2h-4"/>
                    <circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/>
                </svg>
            </div>
            @if ($search)
                <div class="empty-title">Tidak ditemukan</div>
                <div class="empty-desc">Kendaraan "<strong>{{ $search }}</strong>" tidak ada.<br>Coba kata kunci lain.</div>
            @else
                <div class="empty-title">Belum ada kendaraan</div>
                <div class="empty-desc">Tambahkan kendaraan pertama kamu<br>untuk mulai menggunakan Parkify.</div>
            @endif
        </div>
    @endforelse
</div>

  </div>
</main>

<!-- ════════════ BOTTOM NAV ════════════ -->
<nav class="bottom-nav">
  <div class="bottom-nav-inner">
    <div class="bn-item" id="bn-home">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
      <span>Home</span>
    </div>
    <div class="bn-item active" id="bn-kendaraan">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="3" width="15" height="13" rx="2"/><path d="M16 8h4a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2h-4"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
      <span>Kendaraan</span>
    </div>
    <div class="bn-item" id="bn-riwayat">
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
// Search: debounce lalu redirect dengan query param ?q=...
let debounceTimer;
function filterVehicles(val) {
    clearTimeout(debounceTimer);
    debounceTimer = setTimeout(() => {
        const url = new URL(window.location.href);
        if (val.trim()) {
            url.searchParams.set('q', val.trim());
        } else {
            url.searchParams.delete('q');
        }
        window.location.href = url.toString();
    }, 400);
}
</script>
</body>
</html>