<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Parkify — Pengaturan</title>
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

  --bottom-nav-h: 72px;
  --max-content:  1100px;
}

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

/* ── TOP HEADER ── */
.top-header {
  background: var(--bg-surface); border-bottom: 1px solid var(--border);
  position: sticky; top: 0; z-index: 100; width: 100%;
}
.top-header-inner {
  max-width: var(--max-content); margin: 0 auto;
  padding: 0 24px; height: 64px;
  display: flex; align-items: center; justify-content: space-between; gap: 16px; width: 100%;
}
.header-logo { display: flex; align-items: center; gap: 9px; flex-shrink: 0; text-decoration: none; }
.logo-icon {
  width: 36px; height: 36px; background: var(--blue-main);
  border-radius: 10px; display: flex; align-items: center; justify-content: center;
}
.logo-icon svg { color: #fff; }
.logo-text { font-family: 'Space Grotesk', sans-serif; font-size: 20px; font-weight: 800; color: var(--text-primary); letter-spacing: -0.5px; }
.logo-text span { color: var(--blue-main); }
.desktop-nav { display: flex; align-items: center; gap: 4px; }
.desktop-nav a {
  display: flex; align-items: center; gap: 6px; padding: 7px 14px; border-radius: 10px;
  font-size: 13px; font-weight: 500; color: var(--text-secondary);
  text-decoration: none; transition: all 0.16s; cursor: pointer;
}
.desktop-nav a:hover { background: var(--bg-hover); color: var(--text-primary); }
.desktop-nav a.active { background: var(--blue-soft); color: var(--blue-main); font-weight: 600; border: 1px solid var(--blue-pale); }
.header-user {
  display: flex; align-items: center; gap: 10px;
  padding: 6px 12px 6px 6px; border-radius: 12px;
  background: var(--bg-input); border: 1px solid var(--border);
  cursor: pointer; transition: border-color 0.16s; flex-shrink: 0;
}
.header-user:hover { border-color: var(--border-focus); }
.user-avatar {
  width: 32px; height: 32px; border-radius: 50%; overflow: hidden;
  background: linear-gradient(135deg, #f59e0b, #ef4444);
  display: flex; align-items: center; justify-content: center;
  font-weight: 700; font-size: 13px; color: #fff;
  font-family: 'Space Grotesk', sans-serif; flex-shrink: 0;
}
.user-avatar img { width: 100%; height: 100%; object-fit: cover; }
.user-name-text { font-size: 13px; font-weight: 600; color: var(--text-primary); white-space: nowrap; }
.icon-btn {
  width: 36px; height: 36px; background: var(--bg-input); border: 1px solid var(--border);
  border-radius: 10px; display: flex; align-items: center; justify-content: center;
  cursor: pointer; color: var(--text-secondary); transition: all 0.15s; flex-shrink: 0;
}
.icon-btn:hover { border-color: var(--border-focus); color: var(--text-primary); }

/* ── MAIN ── */
.main-wrap { width: 100%; padding-bottom: calc(var(--bottom-nav-h) + 24px + env(safe-area-inset-bottom)); }
.content-inner { max-width: 680px; margin: 0 auto; padding: 0 24px; width: 100%; }
.page-topbar {
  max-width: 680px; margin: 0 auto; padding: 24px 24px 0;
  display: flex; align-items: center; justify-content: space-between; gap: 12px;
}
.page-topbar-title { font-family: 'Space Grotesk', sans-serif; font-size: 22px; font-weight: 800; color: var(--text-primary); letter-spacing: -0.3px; }

/* ── ALERT ── */
.alert {
  display: flex; align-items: center; gap: 10px;
  padding: 12px 16px; border-radius: 14px;
  font-size: 13px; font-weight: 500;
  margin-bottom: 16px; margin-top: 16px;
  animation: slide-down 0.3s ease;
}
@keyframes slide-down { from { opacity: 0; transform: translateY(-8px); } to { opacity: 1; transform: translateY(0); } }
.alert-success { background: var(--green-soft); color: var(--green); border: 1px solid #a7f3d0; }
.alert-error   { background: var(--red-soft);   color: var(--red);   border: 1px solid #fca5a5; }

/* ── PROFILE CARD ── */
.profile-card {
  background: linear-gradient(135deg, #1d4ed8 0%, #2563eb 100%);
  border-radius: 20px; padding: 22px 24px;
  display: flex; align-items: center; gap: 16px;
  position: relative; overflow: hidden;
  cursor: pointer; transition: opacity 0.15s; margin-top: 20px;
  text-decoration: none;
}
.profile-card::before {
  content: ''; position: absolute; top: -50px; right: -50px;
  width: 180px; height: 180px; border-radius: 50%;
  background: rgba(255,255,255,0.07); pointer-events: none;
}
.profile-card::after {
  content: ''; position: absolute; bottom: -30px; left: -20px;
  width: 120px; height: 120px; border-radius: 50%;
  background: rgba(255,255,255,0.05); pointer-events: none;
}
.profile-card:hover { opacity: 0.93; }
.profile-avatar-wrap {
  width: 58px; height: 58px; border-radius: 50%;
  background: rgba(255,255,255,0.2); border: 2.5px solid rgba(255,255,255,0.4);
  display: flex; align-items: center; justify-content: center;
  flex-shrink: 0; position: relative; z-index: 1; overflow: hidden;
}
.profile-avatar-wrap img { width: 100%; height: 100%; object-fit: cover; }
.profile-avatar-wrap svg { color: rgba(255,255,255,0.85); }
.profile-info { flex: 1; min-width: 0; position: relative; z-index: 1; }
.profile-name { font-family: 'Space Grotesk', sans-serif; font-size: 17px; font-weight: 800; color: #fff; margin-bottom: 4px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.profile-email { font-size: 12.5px; color: rgba(255,255,255,0.75); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.profile-badge {
  display: inline-flex; align-items: center; gap: 4px;
  background: rgba(255,255,255,0.15); border: 1px solid rgba(255,255,255,0.25);
  padding: 2px 9px; border-radius: 999px; margin-top: 5px;
  font-size: 11px; font-weight: 600; color: rgba(255,255,255,0.9);
}
.profile-arrow { color: rgba(255,255,255,0.6); flex-shrink: 0; position: relative; z-index: 1; }

/* ── STATS ── */
.stats-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 10px; margin-top: 16px; }
.stat-card {
  background: var(--bg-card); border: 1px solid var(--border); border-radius: 14px;
  padding: 14px 12px; text-align: center; box-shadow: var(--shadow-sm);
}
.stat-value { font-family: 'Space Grotesk', sans-serif; font-size: 22px; font-weight: 800; line-height: 1; margin-bottom: 4px; }
.stat-label { font-size: 11px; color: var(--text-muted); font-weight: 500; }

/* ── SECTION LABEL ── */
.section-label {
  font-size: 11px; font-weight: 700; letter-spacing: 0.09em; text-transform: uppercase;
  color: var(--text-muted); margin-bottom: 10px; padding-left: 2px;
}

/* ── MENU GROUP ── */
.menu-group { background: var(--bg-card); border: 1px solid var(--border); border-radius: 18px; overflow: hidden; box-shadow: var(--shadow-sm); }
.menu-item {
  display: flex; align-items: center; gap: 14px; padding: 16px 18px;
  cursor: pointer; transition: background 0.15s;
  border-bottom: 1px solid var(--border);
  text-decoration: none; color: inherit;
}
.menu-item:last-child { border-bottom: none; }
.menu-item:hover { background: var(--bg-hover); }
.menu-item:active { background: var(--blue-soft); }
.menu-icon { width: 40px; height: 40px; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
.menu-text { flex: 1; min-width: 0; }
.menu-title { font-size: 13.5px; font-weight: 600; color: var(--text-primary); margin-bottom: 2px; }
.menu-desc  { font-size: 11.5px; color: var(--text-muted); }
.menu-arrow { color: var(--text-muted); flex-shrink: 0; transition: color 0.15s, transform 0.15s; }
.menu-item:hover .menu-arrow { color: var(--blue-main); transform: translateX(2px); }
.menu-badge { background: var(--blue-main); color: #fff; font-size: 10px; font-weight: 700; padding: 2px 8px; border-radius: 999px; font-family: 'Space Grotesk', sans-serif; }
.menu-badge.green { background: var(--green); }
.menu-item.danger .menu-title { color: var(--red); }
.menu-item.danger:hover { background: var(--red-soft); }

/* ── TOGGLE ── */
.toggle-wrap {
  width: 44px; height: 24px; border-radius: 999px;
  background: var(--border); position: relative; cursor: pointer;
  transition: background 0.22s; flex-shrink: 0; border: none;
  outline: none; padding: 0;
}
.toggle-wrap.on { background: var(--blue-main); }
.toggle-thumb {
  position: absolute; top: 3px; left: 3px;
  width: 18px; height: 18px; border-radius: 50%;
  background: #fff; box-shadow: 0 1px 4px rgba(0,0,0,0.18);
  transition: transform 0.22s cubic-bezier(0.34,1.56,0.64,1);
  pointer-events: none;
}
.toggle-wrap.on .toggle-thumb { transform: translateX(20px); }

/* ── VERSION ── */
.version-row { text-align: center; padding: 20px 0 8px; }
.version-logo { font-family: 'Space Grotesk', sans-serif; font-size: 18px; font-weight: 800; color: var(--text-muted); letter-spacing: -0.3px; margin-bottom: 5px; }
.version-logo span { color: var(--blue-main); opacity: 0.5; }
.version-text { font-size: 11.5px; color: var(--text-muted); }

/* ── LOGOUT FORM (hidden) ── */
#logout-form { display: none; }

/* ── BOTTOM NAV ── */
.bottom-nav {
  position: fixed; bottom: 0; left: 0; right: 0; width: 100%; z-index: 9999;
  display: flex; align-items: flex-end; justify-content: center;
  background: transparent; pointer-events: none;
  padding-bottom: calc(12px + env(safe-area-inset-bottom));
}
.bottom-nav-inner {
  display: flex; align-items: center;
  background: var(--bg-surface); border: 1px solid var(--border); border-radius: 999px;
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
  text-decoration: none;
}
.bn-item:not(.active) { background: #f3f4f6; border-radius: 50%; width: 46px; height: 46px; padding: 0; }
.bn-item:not(.active) span { display: none; }
.bn-item svg { width: 22px; height: 22px; flex-shrink: 0; }
.bn-item.active { background: var(--blue-main); color: #fff; padding: 12px 20px; border-radius: 999px; width: auto; height: auto; }
.bn-item.active span { display: inline; color: #fff; }
.bn-item:not(.active):hover { background: #e9eaf0; border-radius: 50%; }

/* ── RESPONSIVE ── */
@media (min-width: 860px) { .bottom-nav { display: none; } .main-wrap { padding-bottom: 40px; } }
@media (max-width: 859px) {
  .desktop-nav { display: none; }
  .header-user .user-name-text { display: none; }
  .top-header-inner, .page-topbar { padding-left: 16px; padding-right: 16px; }
  .page-topbar { padding-top: 20px; }
  .content-inner { padding: 0 16px; }
}
@media (max-width: 400px) { .profile-name { font-size: 15px; } .stat-value { font-size: 18px; } }
</style>
</head>
<body>

{{-- ════════════ TOP HEADER ════════════ --}}
<header class="top-header">
  <div class="top-header-inner">
    <a class="header-logo" href="{{ route('user.dashboard') }}">
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
      <a href="{{ route('user.dashboard') }}">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
        Home
      </a>
      <a href="{{ route('user.kendaraan') }}">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="3" width="15" height="13" rx="2"/><path d="M16 8h4a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2h-4"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
        Kendaraan
      </a>
      <a href="{{ route('user.riwayat') }}">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
        Riwayat
      </a>
      <a class="active" href="{{ route('user.pengaturan') }}">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.07 4.93l-1.41 1.41M4.93 4.93l1.41 1.41M12 2v2m0 16v2m7.07 1.07l-1.41-1.41M4.93 19.07l1.41-1.41M22 12h-2M4 12H2"/></svg>
        Pengaturan
      </a>
    </nav>

    <div style="display:flex;align-items:center;gap:10px;margin-left:auto">
      <div style="position:relative">
        <div class="icon-btn">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
        </div>
        {{-- Ganti dengan logika notifikasi belum dibaca --}}
        <div style="position:absolute;top:7px;right:7px;width:8px;height:8px;background:var(--red);border-radius:50%;border:2px solid #fff"></div>
      </div>
      <div class="header-user">
        <div class="user-avatar">
          @if($user->foto_profil)
            <img src="{{ Storage::url($user->foto_profil) }}" alt="{{ $user->name }}">
          @else
            {{ strtoupper(substr($user->name, 0, 2)) }}
          @endif
        </div>
        <span class="user-name-text">{{ $user->name }}</span>
      </div>
    </div>
  </div>
</header>

{{-- Logout form (hidden, disubmit via JS) --}}
<form id="logout-form" action="{{ route('logout') }}" method="GET">
  @csrf
</form>

{{-- ════════════ MAIN ════════════ --}}
<main class="main-wrap">

  <div class="page-topbar">
    <div class="page-topbar-title">Pengaturan</div>
    <div class="icon-btn">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="5" r="1"/><circle cx="12" cy="12" r="1"/><circle cx="12" cy="19" r="1"/></svg>
    </div>
  </div>

  <div class="content-inner">

    {{-- ── Flash Messages ── --}}
    @if(session('success'))
      <div class="alert alert-success">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
        {{ session('success') }}
      </div>
    @endif

    @if($errors->any())
      <div class="alert alert-error">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        {{ $errors->first() }}
      </div>
    @endif

    {{-- ── Profile Card ── --}}
    <a class="profile-card" href="{{ route('user.pengaturan.user-edit') }}">
      <div class="profile-avatar-wrap">
        @if($user->foto_profil)
          <img src="{{ Storage::url($user->foto_profil) }}" alt="{{ $user->name }}">
        @else
          <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
            <circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/>
          </svg>
        @endif
      </div>
      <div class="profile-info">
        <div class="profile-name">{{ $user->name }}</div>
        <div class="profile-email">{{ $user->email }}</div>
        @if($user->sudah_verifikasi)
          <div class="profile-badge">
            <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
            Terverifikasi
          </div>
        @else
          <div class="profile-badge" style="background:rgba(245,158,11,0.2);border-color:rgba(245,158,11,0.3);color:#fde68a">
            Belum Verifikasi
          </div>
        @endif
      </div>
      <svg class="profile-arrow" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
    </a>

    {{-- ── Stats ── --}}
    <div class="stats-grid">
      <div class="stat-card">
        <div class="stat-value" style="color:var(--blue-main)">{{ $stats['total_parkir'] }}</div>
        <div class="stat-label">Total Parkir</div>
      </div>
      <div class="stat-card">
        <div class="stat-value" style="color:var(--green)">{{ $stats['total_kendaraan'] }}</div>
        <div class="stat-label">Kendaraan</div>
      </div>
      <div class="stat-card">
        <div class="stat-value" style="color:var(--amber)">{{ $stats['booking_aktif'] }}</div>
        <div class="stat-label">Booking Aktif</div>
      </div>
    </div>

    {{-- ── Akun ── --}}
    <div style="margin-top:26px">
      <div class="section-label">Akun</div>
      <div class="menu-group">

        <a class="menu-item" href="{{ route('user.pengaturan.user-edit') }}">
          <div class="menu-icon" style="background:var(--blue-soft)">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--blue-main)" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
          </div>
          <div class="menu-text">
            <div class="menu-title">Ubah Profil</div>
            <div class="menu-desc">Nama, foto, dan informasi pribadi</div>
          </div>
          <svg class="menu-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
        </a>

        <a class="menu-item" href="{{ route('user.pengaturan.user-edit') ?? '#' }}">
          <div class="menu-icon" style="background:#f5f3ff">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#8b5cf6" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
          </div>
          <div class="menu-text">
            <div class="menu-title">Keamanan & Sandi</div>
            <div class="menu-desc">Ubah password dan PIN</div>
          </div>
          <svg class="menu-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
        </a>

        <a class="menu-item" href="{{ route('user.kendaraan') }}">
          <div class="menu-icon" style="background:var(--green-soft)">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--green)" stroke-width="2"><rect x="1" y="3" width="15" height="13" rx="2"/><path d="M16 8h4a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2h-4"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
          </div>
          <div class="menu-text">
            <div class="menu-title">Kendaraan Ku</div>
            <div class="menu-desc">Kelola daftar kendaraan terdaftar</div>
          </div>
          <div style="display:flex;align-items:center;gap:8px">
            @if($stats['total_kendaraan'] > 0)
              <span class="menu-badge">{{ $stats['total_kendaraan'] }}</span>
            @endif
            <svg class="menu-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
          </div>
        </a>

        <a class="menu-item" href="{{ route('user.riwayat') }}">
          <div class="menu-icon" style="background:var(--amber-soft)">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--amber)" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
          </div>
          <div class="menu-text">
            <div class="menu-title">Booking-Ku</div>
            <div class="menu-desc">Riwayat dan reservasi parkir</div>
          </div>
          <div style="display:flex;align-items:center;gap:8px">
            @if($stats['booking_aktif'] > 0)
              <span class="menu-badge green">{{ $stats['booking_aktif'] }} aktif</span>
            @endif
            <svg class="menu-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
          </div>
        </a>

      </div>
    </div>

    {{-- ── Preferensi ── --}}
    <div style="margin-top:22px">
      <div class="section-label">Preferensi</div>
      <div class="menu-group">

        {{-- Toggle Notifikasi --}}
        <div class="menu-item" onclick="togglePreferensi('notifikasi_aktif', this)">
          <div class="menu-icon" style="background:#f0fdf4">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--green)" stroke-width="2"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
          </div>
          <div class="menu-text">
            <div class="menu-title">Notifikasi</div>
            <div class="menu-desc">Pemberitahuan parkir dan promo</div>
          </div>
          {{-- Nilai default dari DB jika ada kolom notifikasi_aktif, fallback ke true --}}
          <button
            class="toggle-wrap {{ ($user->notifikasi_aktif ?? true) ? 'on' : '' }}"
            id="toggle-notifikasi_aktif"
            data-key="notifikasi_aktif"
            data-value="{{ ($user->notifikasi_aktif ?? true) ? '1' : '0' }}"
            onclick="event.stopPropagation(); togglePreferensi('notifikasi_aktif')"
          >
            <div class="toggle-thumb"></div>
          </button>
        </div>

        {{-- Toggle Lokasi --}}
        <div class="menu-item" onclick="togglePreferensi('lokasi_aktif')">
          <div class="menu-icon" style="background:var(--blue-soft)">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--blue-main)" stroke-width="2"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/><circle cx="12" cy="9" r="2.5"/></svg>
          </div>
          <div class="menu-text">
            <div class="menu-title">Akses Lokasi</div>
            <div class="menu-desc">Izinkan deteksi lokasi otomatis</div>
          </div>
          <button
            class="toggle-wrap {{ ($user->lokasi_aktif ?? true) ? 'on' : '' }}"
            id="toggle-lokasi_aktif"
            data-key="lokasi_aktif"
            data-value="{{ ($user->lokasi_aktif ?? true) ? '1' : '0' }}"
            onclick="event.stopPropagation(); togglePreferensi('lokasi_aktif')"
          >
            <div class="toggle-thumb"></div>
          </button>
        </div>

        <a class="menu-item" href="#">
          <div class="menu-icon" style="background:var(--amber-soft)">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--amber)" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/></svg>
          </div>
          <div class="menu-text">
            <div class="menu-title">Metode Pembayaran</div>
            <div class="menu-desc">Kelola kartu dan dompet digital</div>
          </div>
          <svg class="menu-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
        </a>

        <a class="menu-item" href="#">
          <div class="menu-icon" style="background:var(--bg-input)">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--text-secondary)" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
          </div>
          <div class="menu-text">
            <div class="menu-title">Bahasa</div>
            <div class="menu-desc">Bahasa Indonesia</div>
          </div>
          <svg class="menu-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
        </a>

      </div>
    </div>

    {{-- ── Lainnya ── --}}
    <div style="margin-top:22px">
      <div class="section-label">Lainnya</div>
      <div class="menu-group">

        <a class="menu-item" href="#">
          <div class="menu-icon" style="background:var(--blue-soft)">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--blue-main)" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
          </div>
          <div class="menu-text">
            <div class="menu-title">Bantuan & FAQ</div>
            <div class="menu-desc">Pusat bantuan Parkify</div>
          </div>
          <svg class="menu-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
        </a>

        <a class="menu-item" href="#">
          <div class="menu-icon" style="background:var(--bg-input)">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--text-secondary)" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
          </div>
          <div class="menu-text">
            <div class="menu-title">Syarat & Ketentuan</div>
            <div class="menu-desc">Kebijakan privasi dan penggunaan</div>
          </div>
          <svg class="menu-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
        </a>

      </div>
    </div>

    {{-- ── Danger Zone ── --}}
    <div style="margin-top:22px">
      <div class="menu-group">
        <a class="menu-item danger" href="#" onclick="handleLogout(event)">
          <div class="menu-icon" style="background:var(--red-soft)">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--red)" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
          </div>
          <div class="menu-text">
            <div class="menu-title">Logout</div>
            <div class="menu-desc" style="color:var(--text-muted)">Keluar dari akun ini</div>
          </div>
          <svg class="menu-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--red)" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
        </a>
      </div>
    </div>

    <div class="version-row">
      <div class="version-logo">Parki<span>fy</span></div>
      <div class="version-text">Versi 1.0.0 · © {{ date('Y') }} Parkify</div>
    </div>

  </div>{{-- /content-inner --}}
</main>

{{-- ════════════ BOTTOM NAV ════════════ --}}
<nav class="bottom-nav">
  <div class="bottom-nav-inner">
    <a class="bn-item" href="{{ route('user.dashboard') }}">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
      <span>Home</span>
    </a>
    <a class="bn-item" href="{{ route('user.kendaraan') }}">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="3" width="15" height="13" rx="2"/><path d="M16 8h4a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2h-4"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
      <span>Kendaraan</span>
    </a>
    <a class="bn-item" href="{{ route('user.riwayat') }}">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
      <span>Riwayat</span>
    </a>
    <a class="bn-item active" href="{{ route('user.pengaturan') }}">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.07 4.93l-1.41 1.41M4.93 4.93l1.41 1.41M12 2v2m0 16v2m7.07 1.07l-1.41-1.41M4.93 19.07l1.41-1.41M22 12h-2M4 12H2"/></svg>
      <span>Pengaturan</span>
    </a>
  </div>
</nav>

<script>
/* ─── LOGOUT ─────────────────────────────── */
function handleLogout(e) {
  e.preventDefault();
  if (confirm('Yakin ingin keluar dari akun Parkify?')) {
    document.getElementById('logout-form').submit();
  }
}

/* ─── TOGGLE PREFERENSI (AJAX) ───────────── */
function togglePreferensi(key) {
  const btn = document.getElementById('toggle-' + key);
  if (!btn) return;

  const isOn     = btn.classList.contains('on');
  const newValue = isOn ? 0 : 1;

  // Optimistic UI
  btn.classList.toggle('on', !isOn);
  btn.dataset.value = newValue;

  // Kirim ke server
  fetch('{{ route("user.pengaturan.user-edit") }}', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
    },
    body: JSON.stringify({ [key]: newValue }),
  })
  .then(res => res.json())
  .then(data => {
    if (!data.success) {
      // Rollback jika gagal
      btn.classList.toggle('on', isOn);
      btn.dataset.value = isOn ? 1 : 0;
    }
  })
  .catch(() => {
    // Rollback jika error jaringan
    btn.classList.toggle('on', isOn);
  });
}
</script>
</body>
</html>