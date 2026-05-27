<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
<title>Parkify — Dashboard</title>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
<style>
/* ═══════════════════════════════════════════
   THEME TOKENS
═══════════════════════════════════════════ */
:root,
[data-theme="light"] {
  --bg-base:      #f0f4f9;
  --bg-surface:   #ffffff;
  --bg-card:      #ffffff;
  --bg-hover:     #f5f8ff;
  --bg-input:     #f7f9fc;
  --border:       #e2e8f2;
  --border-focus: #93c5fd;

  --text-primary:   #0f1e36;
  --text-secondary: #4a6080;
  --text-muted:     #94a3b8;

  --blue-main:   #2563eb;
  --blue-bright: #3b82f6;
  --blue-glow:   #60a5fa;
  --blue-pale:   #dbeafe;
  --blue-soft:   #eff6ff;

  --green:       #10b981;
  --green-soft:  #ecfdf5;
  --red:         #ef4444;
  --red-soft:    #fef2f2;
  --amber:       #f59e0b;
  --amber-soft:  #fffbeb;
  --purple:      #8b5cf6;
  --purple-soft: #f5f3ff;

  --shadow-sm: 0 1px 3px rgba(15,30,54,0.06), 0 1px 2px rgba(15,30,54,0.04);
  --shadow-md: 0 4px 12px rgba(15,30,54,0.08), 0 2px 4px rgba(15,30,54,0.04);
  --shadow-lg: 0 10px 30px rgba(15,30,54,0.1);

  --sidebar-width: 240px;
  --bottom-nav-h: 64px;
}

[data-theme="dark"] {
  --bg-base:      #050a14;
  --bg-surface:   #0b1628;
  --bg-card:      #0f1e36;
  --bg-hover:     #152640;
  --bg-input:     #0b1628;
  --border:       #1a2f4a;
  --border-focus: #3b82f6;

  --text-primary:   #f0f6ff;
  --text-secondary: #7a9abf;
  --text-muted:     #3d5a80;

  --blue-main:   #2563eb;
  --blue-bright: #3b82f6;
  --blue-glow:   #60a5fa;
  --blue-pale:   #1e3a5f;
  --blue-soft:   #0f1e36;

  --green:       #10b981;
  --green-soft:  #052e1c;
  --red:         #ef4444;
  --red-soft:    #2d0a0a;
  --amber:       #f59e0b;
  --amber-soft:  #2d1a00;
  --purple:      #a78bfa;
  --purple-soft: #1e0a3c;

  --shadow-sm: 0 1px 3px rgba(0,0,0,0.3);
  --shadow-md: 0 4px 12px rgba(0,0,0,0.4);
  --shadow-lg: 0 10px 30px rgba(0,0,0,0.5);
}

/* ═══════════════════════════════════════════
   RESET & BASE — no horizontal overflow ever
═══════════════════════════════════════════ */
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

html, body {
  overflow-x: hidden;
  width: 100%;
  max-width: 100%;
}

body {
  font-family: 'Poppins', sans-serif;
  background: var(--bg-base);
  color: var(--text-primary);
  min-height: 100vh;
  transition: background 0.25s, color 0.25s;
}

::-webkit-scrollbar { width: 4px; height: 4px; }
::-webkit-scrollbar-track { background: transparent; }
::-webkit-scrollbar-thumb { background: var(--border); border-radius: 999px; }

/* ═══════════════════════════════════════════
   LAYOUT
═══════════════════════════════════════════ */
.app-shell {
  display: flex;
  min-height: 100vh;
  width: 100%;
  overflow-x: hidden;
}

/* ── SIDEBAR (desktop) ── */
.sidebar {
  width: var(--sidebar-width);
  min-width: var(--sidebar-width);
  background: var(--bg-surface);
  border-right: 1px solid var(--border);
  position: fixed;
  top: 0; left: 0;
  height: 100vh;
  display: flex;
  flex-direction: column;
  z-index: 50;
  transition: transform 0.3s cubic-bezier(.4,0,.2,1), background 0.25s, border-color 0.25s;
}

.sidebar-logo {
  padding: 22px 20px 18px;
  border-bottom: 1px solid var(--border);
  display: flex;
  align-items: center;
  gap: 10px;
}

.logo-icon {
  width: 34px; height: 34px;
  background: var(--blue-main);
  border-radius: 9px;
  display: flex; align-items: center; justify-content: center;
  flex-shrink: 0;
}
.logo-icon svg { color: #fff; }

.logo-text {
  font-family: 'Space Grotesk', sans-serif;
  font-size: 20px; font-weight: 800;
  color: var(--text-primary);
  letter-spacing: -0.5px; line-height: 1;
}
.logo-text span { color: var(--blue-main); }
.logo-sub { font-size: 10px; font-weight: 500; color: var(--text-muted); margin-top: 2px; }

.sidebar-nav { padding: 14px 10px; flex: 1; overflow-y: auto; }

.nav-label {
  font-size: 9.5px; font-weight: 700;
  letter-spacing: 0.1em; text-transform: uppercase;
  color: var(--text-muted);
  padding: 0 10px; margin: 14px 0 5px;
}

.nav-item {
  display: flex; align-items: center; gap: 10px;
  padding: 9px 10px; border-radius: 10px;
  cursor: pointer; color: var(--text-secondary);
  font-size: 13px; font-weight: 500;
  transition: all 0.16s ease;
  margin-bottom: 1px; text-decoration: none;
  border: 1px solid transparent;
  position: relative;
}

.nav-item:hover { background: var(--bg-hover); color: var(--text-primary); }

.nav-item.active {
  background: var(--blue-soft);
  color: var(--blue-main);
  border-color: var(--blue-pale);
  font-weight: 600;
}

[data-theme="dark"] .nav-item.active {
  background: rgba(37,99,235,0.15);
  border-color: rgba(59,130,246,0.22);
  color: var(--blue-glow);
}

.nav-item.active .nav-icon { color: var(--blue-main); }
[data-theme="dark"] .nav-item.active .nav-icon { color: var(--blue-glow); }

.nav-item.active::before {
  content: '';
  position: absolute;
  left: -10px; top: 50%;
  transform: translateY(-50%);
  width: 3px; height: 55%;
  background: var(--blue-main);
  border-radius: 0 3px 3px 0;
}

.nav-icon { width: 16px; height: 16px; flex-shrink: 0; opacity: 0.7; }
.nav-item.active .nav-icon { opacity: 1; }

.nav-badge {
  margin-left: auto;
  background: var(--blue-main); color: #fff;
  font-size: 9.5px; font-weight: 700;
  padding: 1px 7px; border-radius: 999px;
  font-family: 'Space Grotesk', sans-serif;
}
.nav-badge.green { background: var(--green); }

.sidebar-footer {
  padding: 14px 10px;
  border-top: 1px solid var(--border);
}

.user-chip {
  display: flex; align-items: center; gap: 10px;
  padding: 10px; border-radius: 10px;
  background: var(--bg-input); border: 1px solid var(--border);
  cursor: pointer; transition: border-color 0.16s;
}
.user-chip:hover { border-color: var(--border-focus); }

.avatar {
  width: 32px; height: 32px; border-radius: 9px;
  background: linear-gradient(135deg, var(--blue-main), #1d4ed8);
  display: flex; align-items: center; justify-content: center;
  font-family: 'Space Grotesk', sans-serif;
  font-weight: 700; font-size: 12px; color: #fff; flex-shrink: 0;
}

.user-info { flex: 1; min-width: 0; }
.user-name { font-size: 12.5px; font-weight: 600; color: var(--text-primary); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.user-role { font-size: 10.5px; color: var(--text-muted); }

/* ── MAIN ── */
.main-area {
  flex: 1;
  margin-left: var(--sidebar-width);
  display: flex;
  flex-direction: column;
  min-height: 100vh;
  min-width: 0;
  width: calc(100% - var(--sidebar-width));
  overflow-x: hidden;
}

/* ── TOPBAR ── */
.topbar {
  position: sticky; top: 0; z-index: 40;
  background: rgba(255,255,255,0.88);
  backdrop-filter: blur(14px);
  -webkit-backdrop-filter: blur(14px);
  border-bottom: 1px solid var(--border);
  padding: 0 26px;
  height: 58px;
  display: flex; align-items: center; gap: 12px;
  transition: background 0.25s, border-color 0.25s;
  width: 100%;
}

[data-theme="dark"] .topbar { background: rgba(5,10,20,0.88); }

.topbar-title {
  font-family: 'Space Grotesk', sans-serif;
  font-size: 16px; font-weight: 700;
  flex: 1; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
}

.search-box {
  display: flex; align-items: center; gap: 8px;
  background: var(--bg-input); border: 1px solid var(--border);
  border-radius: 10px; padding: 7px 13px; width: 210px;
  transition: border-color 0.16s, box-shadow 0.16s;
}
.search-box:focus-within { border-color: var(--border-focus); box-shadow: 0 0 0 3px rgba(59,130,246,0.12); }
.search-box input { background: none; border: none; outline: none; color: var(--text-primary); font-size: 12.5px; font-family: 'Poppins', sans-serif; width: 100%; }
.search-box input::placeholder { color: var(--text-muted); }

/* ── Theme Toggle ── */
.theme-toggle {
  width: 52px; height: 28px; border-radius: 999px;
  background: var(--bg-input); border: 1.5px solid var(--border);
  position: relative; cursor: pointer;
  transition: background 0.25s, border-color 0.25s; flex-shrink: 0;
}
[data-theme="dark"] .theme-toggle { background: var(--blue-main); border-color: var(--blue-main); }
.toggle-thumb {
  position: absolute; top: 3px; left: 3px;
  width: 20px; height: 20px; border-radius: 50%;
  background: #fff; box-shadow: 0 1px 4px rgba(0,0,0,0.15);
  transition: transform 0.25s cubic-bezier(.4,0,.2,1);
  display: flex; align-items: center; justify-content: center;
}
[data-theme="dark"] .toggle-thumb { transform: translateX(24px); }
.toggle-thumb svg { width: 11px; height: 11px; }
.toggle-thumb .icon-sun { display: block; color: var(--amber); }
.toggle-thumb .icon-moon { display: none; color: #fff; }
[data-theme="dark"] .toggle-thumb .icon-sun { display: none; }
[data-theme="dark"] .toggle-thumb .icon-moon { display: block; }

.topbar-btn {
  width: 36px; height: 36px;
  display: flex; align-items: center; justify-content: center;
  background: var(--bg-input); border: 1px solid var(--border);
  border-radius: 10px; cursor: pointer; color: var(--text-secondary);
  transition: all 0.16s; position: relative; flex-shrink: 0;
}
.topbar-btn:hover { border-color: var(--border-focus); color: var(--text-primary); }
.notif-dot {
  position: absolute; top: 7px; right: 7px;
  width: 7px; height: 7px; background: var(--blue-main);
  border-radius: 50%; border: 1.5px solid var(--bg-surface);
}

.hamburger {
  display: none;
  width: 36px; height: 36px;
  flex-direction: column; align-items: center; justify-content: center; gap: 5px;
  cursor: pointer; background: var(--bg-input);
  border: 1px solid var(--border); border-radius: 10px; flex-shrink: 0;
}
.hamburger span { width: 16px; height: 2px; background: var(--text-secondary); border-radius: 999px; transition: all 0.22s; }

/* ── CONTENT ── */
.content {
  padding: 26px; flex: 1;
  width: 100%; overflow-x: hidden;
}

.page { display: none; }
.page.active { display: block; }

/* ── PAGE HEADER ── */
.page-header {
  display: flex; align-items: flex-end; justify-content: space-between;
  margin-bottom: 22px; flex-wrap: wrap; gap: 12px;
}
.page-title { font-family: 'Space Grotesk', sans-serif; font-size: 21px; font-weight: 800; color: var(--text-primary); }
.page-sub { font-size: 12.5px; color: var(--text-muted); margin-top: 3px; }

/* ── STAT CARDS — flat border style, no shadow ── */
.stats-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 12px; margin-bottom: 22px;
}

.stat-card {
  background: var(--bg-card);
  border: 1px solid var(--border);
  border-radius: 12px;
  padding: 16px 18px;
  transition: border-color 0.2s, background 0.25s;
  cursor: default;
}

.stat-card:hover { border-color: var(--border-focus); }

.stat-top { display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 10px; }

.stat-icon {
  width: 36px; height: 36px; border-radius: 9px;
  display: flex; align-items: center; justify-content: center;
}
.si-blue   { background: var(--blue-soft);   color: var(--blue-main); }
.si-green  { background: var(--green-soft);  color: var(--green); }
.si-amber  { background: var(--amber-soft);  color: var(--amber); }
.si-purple { background: var(--purple-soft); color: var(--purple); }

.stat-trend { font-size: 11px; font-weight: 600; padding: 3px 7px; border-radius: 6px; }
.t-up   { background: var(--green-soft); color: var(--green); }
.t-down { background: var(--red-soft);   color: var(--red); }
.t-warn { background: var(--amber-soft); color: var(--amber); }

.stat-label { font-size: 11.5px; color: var(--text-muted); font-weight: 500; margin-bottom: 4px; }
.stat-value { font-family: 'Space Grotesk', sans-serif; font-size: 26px; font-weight: 800; color: var(--text-primary); line-height: 1; }
.stat-footer { font-size: 11px; color: var(--text-muted); margin-top: 5px; }

/* ── GRID ── */
.grid-2   { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; margin-bottom: 22px; }
.grid-3-1 { display: grid; grid-template-columns: 2fr 1fr; gap: 14px; margin-bottom: 22px; }

/* ── CARD ── */
.card {
  background: var(--bg-card); border: 1px solid var(--border);
  border-radius: 14px; padding: 20px;
  box-shadow: var(--shadow-sm);
  transition: background 0.25s, border-color 0.25s;
  min-width: 0; overflow: hidden;
}

.card-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px; flex-wrap: wrap; gap: 8px; }
.card-title { font-family: 'Space Grotesk', sans-serif; font-size: 13.5px; font-weight: 700; color: var(--text-primary); }
.card-action { font-size: 12px; color: var(--blue-main); cursor: pointer; font-weight: 600; }
.card-action:hover { opacity: 0.75; }

.chart-wrap { position: relative; height: 215px; width: 100%; }

/* ── DONUT LEGEND ── */
.donut-legend { display: flex; flex-direction: column; gap: 9px; margin-top: 4px; }
.dl-item { display: flex; align-items: center; justify-content: space-between; }
.dl-label { display: flex; align-items: center; gap: 7px; font-size: 12px; color: var(--text-secondary); }
.dl-dot { width: 9px; height: 9px; border-radius: 3px; }
.dl-val { font-family: 'Space Grotesk', sans-serif; font-size: 13px; font-weight: 700; }

/* ── TABLE (scrollable on mobile) ── */
.table-wrap { width: 100%; overflow-x: auto; -webkit-overflow-scrolling: touch; }
.data-table { width: 100%; border-collapse: collapse; min-width: 520px; }

.data-table th {
  text-align: left; font-size: 10.5px; font-weight: 700;
  letter-spacing: 0.08em; text-transform: uppercase;
  color: var(--text-muted); padding: 0 12px 11px;
  border-bottom: 1px solid var(--border);
  white-space: nowrap;
}
.data-table td {
  padding: 11px 12px; font-size: 12.5px;
  color: var(--text-secondary); border-bottom: 1px solid var(--border);
  vertical-align: middle;
}
.data-table tr:last-child td { border-bottom: none; }
.data-table tr:hover td { background: var(--bg-hover); }
.cell-primary { color: var(--text-primary); font-weight: 600; }

/* ── BADGE ── */
.badge {
  display: inline-flex; align-items: center; gap: 3px;
  padding: 3px 9px; border-radius: 999px;
  font-size: 11px; font-weight: 600; font-family: 'Poppins', sans-serif;
  white-space: nowrap;
}
.b-green  { background: var(--green-soft);  color: var(--green); }
.b-blue   { background: var(--blue-soft);   color: var(--blue-main); }
.b-amber  { background: var(--amber-soft);  color: var(--amber); }
.b-red    { background: var(--red-soft);    color: var(--red); }
.b-gray   { background: var(--bg-input);    color: var(--text-muted); }
.b-purple { background: var(--purple-soft); color: var(--purple); }

/* ── ACTIVITY ── */
.activity-item {
  display: flex; align-items: flex-start; gap: 11px;
  padding: 10px 0; border-bottom: 1px solid var(--border);
}
.activity-item:last-child { border-bottom: none; }
.act-icon { width: 30px; height: 30px; border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; margin-top: 1px; }
.act-main { font-size: 12.5px; color: var(--text-primary); font-weight: 500; line-height: 1.4; }
.act-sub  { font-size: 11px; color: var(--text-muted); margin-top: 1px; }

/* ── PROGRESS ── */
.prog-bar { height: 5px; background: var(--bg-input); border-radius: 999px; overflow: hidden; }
.prog-fill { height: 100%; border-radius: 999px; transition: width 0.5s ease; }

/* ── BUTTONS ── */
.btn-primary {
  display: inline-flex; align-items: center; gap: 7px;
  background: var(--blue-main); color: #fff;
  border: none; border-radius: 10px; padding: 9px 16px;
  font-size: 12.5px; font-weight: 600; font-family: 'Poppins', sans-serif;
  cursor: pointer; transition: background 0.16s, transform 0.15s;
  white-space: nowrap;
}
.btn-primary:hover { background: var(--blue-bright); transform: translateY(-1px); }

.btn-ghost {
  display: inline-flex; align-items: center; gap: 6px;
  background: transparent; color: var(--text-secondary);
  border: 1px solid var(--border); border-radius: 9px;
  padding: 7px 12px; font-size: 12px; font-weight: 500;
  font-family: 'Poppins', sans-serif; cursor: pointer; transition: all 0.16s;
  white-space: nowrap;
}
.btn-ghost:hover { border-color: var(--border-focus); color: var(--text-primary); background: var(--bg-hover); }

/* ── FILTER BAR ── */
.filter-bar { display: flex; align-items: center; gap: 10px; margin-bottom: 18px; flex-wrap: wrap; }

.filter-input {
  display: flex; align-items: center; gap: 8px;
  background: var(--bg-card); border: 1px solid var(--border);
  border-radius: 10px; padding: 8px 13px; flex: 1; min-width: 160px;
  box-shadow: var(--shadow-sm);
  transition: border-color 0.16s, box-shadow 0.16s;
}
.filter-input:focus-within { border-color: var(--border-focus); box-shadow: 0 0 0 3px rgba(59,130,246,0.1); }
.filter-input input { background: none; border: none; outline: none; color: var(--text-primary); font-size: 12.5px; font-family: 'Poppins', sans-serif; width: 100%; }
.filter-input input::placeholder { color: var(--text-muted); }

.filter-select {
  background: var(--bg-card); border: 1px solid var(--border);
  border-radius: 10px; padding: 8px 13px;
  color: var(--text-secondary); font-size: 12.5px;
  font-family: 'Poppins', sans-serif; outline: none; cursor: pointer;
  box-shadow: var(--shadow-sm); transition: border-color 0.16s;
}
.filter-select:focus { border-color: var(--border-focus); }

/* ── LIVE PILL ── */
.live-pill {
  display: inline-flex; align-items: center; gap: 6px;
  background: var(--green-soft); color: var(--green);
  padding: 5px 12px; border-radius: 999px;
  font-size: 11.5px; font-weight: 600;
  white-space: nowrap;
}
.live-dot { width: 7px; height: 7px; background: var(--green); border-radius: 50%; animation: livepulse 1.6s infinite; }
@keyframes livepulse {
  0%,100% { opacity:1; box-shadow:0 0 0 0 rgba(16,185,129,0.5); }
  50%      { opacity:.7; box-shadow:0 0 0 5px rgba(16,185,129,0); }
}

/* ── MONITOR ── */
.m-stats { display: grid; grid-template-columns: repeat(4,1fr); gap: 12px; margin-bottom: 18px; }
.m-stat {
  background: var(--bg-card); border: 1px solid var(--border);
  border-radius: 12px; padding: 16px 18px;
  transition: background 0.25s, border-color 0.25s;
}
.m-val { font-family: 'Space Grotesk', sans-serif; font-size: 24px; font-weight: 800; line-height: 1; margin-bottom: 4px; }
.m-lbl { font-size: 11.5px; color: var(--text-muted); }

.monitor-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 14px; }

/* ── FLOOR TABS ── */
.floor-tabs {
  display: flex; gap: 3px; flex-wrap: wrap;
  background: var(--bg-base); border-radius: 10px; padding: 4px;
  margin-bottom: 14px; width: fit-content; max-width: 100%;
  border: 1px solid var(--border);
}
.floor-tab { padding: 5px 12px; border-radius: 7px; font-size: 12px; font-weight: 600; cursor: pointer; color: var(--text-muted); transition: all 0.16s; }
.floor-tab.active { background: var(--bg-card); color: var(--text-primary); box-shadow: var(--shadow-sm); border: 1px solid var(--border); }

/* ── PARKING MAP ── */
.parking-map {
  display: grid; grid-template-columns: repeat(10,1fr); gap: 5px;
  padding: 14px; background: var(--bg-base);
  border-radius: 12px; border: 1px solid var(--border);
  overflow-x: auto;
}
.pm-slot {
  aspect-ratio: 1.7; border-radius: 5px; border: 1.5px solid;
  display: flex; align-items: center; justify-content: center;
  font-size: 7.5px; font-weight: 700; cursor: pointer;
  transition: transform 0.12s; font-family: 'Space Grotesk', sans-serif;
  min-width: 0;
}
.pm-slot:hover:not(.pm-dis) { transform: scale(1.1); }
.pm-av  { background: var(--green-soft);   border-color: rgba(16,185,129,.4); color: var(--green); }
.pm-oc  { background: var(--blue-soft);    border-color: rgba(59,130,246,.4); color: var(--blue-main); }
.pm-rs  { background: var(--amber-soft);   border-color: rgba(245,158,11,.4); color: var(--amber); }
.pm-di  { background: var(--bg-input);     border-color: var(--border); color: var(--text-muted); opacity:.35; cursor:default; }

/* ── LOG ── */
.log-row { display: flex; align-items: center; gap: 9px; padding: 8px 0; border-bottom: 1px solid var(--border); min-width: 0; }
.log-row:last-child { border-bottom: none; }
.log-time  { font-size: 10.5px; color: var(--text-muted); width: 42px; flex-shrink: 0; }
.log-plate { font-family: 'Space Grotesk', sans-serif; font-size: 11.5px; font-weight: 700; color: var(--text-primary); width: 68px; flex-shrink: 0; }
.log-desc  { font-size: 12px; color: var(--text-secondary); flex: 1; min-width: 0; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }

/* ── LOCATION GRID ── */
.loc-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 14px; margin-bottom: 22px; }

.loc-card {
  background: var(--bg-card); border: 1px solid var(--border);
  border-radius: 14px; padding: 18px 20px;
  box-shadow: var(--shadow-sm); cursor: pointer;
  transition: border-color 0.2s, box-shadow 0.2s, transform 0.2s, background 0.25s;
  min-width: 0;
}
.loc-card:hover { border-color: var(--blue-main); box-shadow: var(--shadow-md); transform: translateY(-2px); }
.loc-head { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 14px; gap: 8px; }
.loc-name { font-family: 'Space Grotesk', sans-serif; font-size: 14.5px; font-weight: 700; }
.loc-addr { font-size: 11.5px; color: var(--text-muted); margin-top: 3px; }
.loc-stats { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-top: 12px; }
.ls-label { font-size: 10.5px; color: var(--text-muted); }
.ls-val   { font-family: 'Space Grotesk', sans-serif; font-size: 19px; font-weight: 800; margin-top: 2px; }
.loc-bar-row { display: flex; justify-content: space-between; font-size: 11px; color: var(--text-secondary); margin-bottom: 5px; margin-top: 12px; }

/* ── USER AVATAR ── */
.uav {
  width: 32px; height: 32px; border-radius: 9px;
  display: flex; align-items: center; justify-content: center;
  font-family: 'Space Grotesk', sans-serif; font-weight: 700; font-size: 12px;
  color: #fff; flex-shrink: 0;
}

/* ── PAGINATION ── */
.pagination { display: flex; align-items: center; gap: 5px; margin-top: 18px; flex-wrap: wrap; }
.pg-btn {
  width: 31px; height: 31px; border-radius: 8px;
  display: flex; align-items: center; justify-content: center;
  background: var(--bg-input); border: 1px solid var(--border);
  color: var(--text-secondary); font-size: 12.5px; cursor: pointer;
  transition: all 0.15s; font-family: 'Space Grotesk', sans-serif; font-weight: 600;
}
.pg-btn:hover { border-color: var(--blue-main); color: var(--blue-main); }
.pg-btn.active { background: var(--blue-main); border-color: var(--blue-main); color: #fff; }

/* ── OVERLAY ── */
.overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,.45); z-index: 45; backdrop-filter: blur(2px); }
.overlay.show { display: block; }

/* ═══════════════════════════════════════════
   BOTTOM NAV — mobile only
═══════════════════════════════════════════ */
.bottom-nav {
  display: none;
  position: fixed; bottom: 0; left: 0; right: 0; width: 100%;
  height: var(--bottom-nav-h);
  background: var(--bg-surface);
  border-top: 1px solid var(--border);
  z-index: 60;
  padding-bottom: env(safe-area-inset-bottom);
  box-shadow: 0 -1px 0 var(--border);
}

.bottom-nav-inner {
  display: flex; align-items: stretch;
  height: 100%;
  width: 100%;
}

.bn-item {
  flex: 1 1 0;
  display: flex; flex-direction: column;
  align-items: center; justify-content: center; gap: 3px;
  cursor: pointer; color: var(--text-muted);
  font-size: 10px; font-weight: 600;
  transition: color 0.16s;
  padding: 6px 0;
  position: relative;
  font-family: 'Poppins', sans-serif;
  -webkit-tap-highlight-color: transparent;
  min-width: 0;
}

.bn-item svg { width: 22px; height: 22px; flex-shrink: 0; }

.bn-item.active { color: var(--blue-main); }
[data-theme="dark"] .bn-item.active { color: var(--blue-glow); }

.bn-item.active::before {
  content: '';
  position: absolute;
  top: 0; left: 50%;
  transform: translateX(-50%);
  width: 32px; height: 2.5px;
  background: var(--blue-main);
  border-radius: 0 0 4px 4px;
}

.bn-badge {
  position: absolute; top: 5px; right: calc(50% - 18px);
  background: var(--green); color: #fff;
  font-size: 7.5px; font-weight: 700;
  padding: 1px 5px; border-radius: 999px;
  font-family: 'Space Grotesk', sans-serif;
  line-height: 1.4;
}

/* ═══════════════════════════════════════════
   RESPONSIVE
═══════════════════════════════════════════ */
@media (max-width: 1180px) {
  .stats-grid      { grid-template-columns: repeat(2,1fr); }
  .loc-grid        { grid-template-columns: repeat(2,1fr); }
  .grid-3-1        { grid-template-columns: 1fr; }
  .m-stats         { grid-template-columns: repeat(2,1fr); }
  .monitor-grid    { grid-template-columns: 1fr; }
}

@media (max-width: 860px) {
  /* Sidebar hides, bottom nav shows */
  .sidebar         { transform: translateX(-100%); box-shadow: none; }
  .sidebar.open    { transform: translateX(0); box-shadow: var(--shadow-lg); }
  .main-area       { margin-left: 0; width: 100%; }
  .hamburger       { display: flex; }
  .search-box      { display: none; }
  .bottom-nav      { display: flex; }
  .content         { padding: 16px; padding-bottom: calc(var(--bottom-nav-h) + 16px + env(safe-area-inset-bottom)); }
  .topbar          { padding: 0 14px; }
  .grid-2          { grid-template-columns: 1fr; }
  .parking-map     { grid-template-columns: repeat(8,1fr); }
  .loc-grid        { grid-template-columns: 1fr; }
  .topbar-btn      { display: none; }
}

@media (max-width: 640px) {
  .stats-grid      { grid-template-columns: 1fr 1fr; gap: 10px; }
  .m-stats         { grid-template-columns: 1fr 1fr; }
  .stat-value      { font-size: 22px; }
  .parking-map     { grid-template-columns: repeat(6,1fr); }
  .page-header     { flex-direction: column; align-items: flex-start; }
  .filter-bar      { gap: 8px; }
  .filter-select   { width: 100%; }
  .loc-grid        { grid-template-columns: 1fr; }
}

@media (max-width: 400px) {
  .stats-grid      { grid-template-columns: 1fr 1fr; gap: 8px; }
  .stat-value      { font-size: 20px; }
  .stat-card       { padding: 12px 14px; }
  .content         { padding: 12px; padding-bottom: calc(var(--bottom-nav-h) + 12px + env(safe-area-inset-bottom)); }
}
</style>
</head>
<body>

<div class="overlay" id="overlay" onclick="closeSidebar()"></div>

<div class="app-shell">

<!-- ════════════ SIDEBAR ════════════ -->
<aside class="sidebar" id="sidebar">
  <div class="sidebar-logo">
    <div class="logo-icon">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="1" y="3" width="15" height="13" rx="2"/><path d="M16 8h4a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2h-4"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
    </div>
    <div>
      <div class="logo-text">Parki<span>fy</span></div>
      <div class="logo-sub">Smart Parking System</div>
    </div>
  </div>

  <nav class="sidebar-nav">
    <div class="nav-label">Menu Utama</div>
    <a class="nav-item active" onclick="showPage('dashboard')">
      <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
      Dashboard
    </a>
    <a class="nav-item" onclick="showPage('monitor')">
      <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><circle cx="12" cy="12" r="9"/><line x1="12" y1="2" x2="12" y2="5"/><line x1="12" y1="19" x2="12" y2="22"/><line x1="2" y1="12" x2="5" y2="12"/><line x1="19" y1="12" x2="22" y2="12"/></svg>
      Monitor Parkir
      <span class="nav-badge green">Live</span>
    </a>
    <a class="nav-item" onclick="showPage('lokasi')">
      <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/><circle cx="12" cy="9" r="2.5"/></svg>
      Kelola Lokasi
      <span class="nav-badge">52</span>
    </a>
    <a class="nav-item" onclick="showPage('pengguna')">
      <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
      Kelola Pengguna
    </a>

    <div class="nav-label">Laporan</div>
    <a class="nav-item">
      <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
      Laporan Harian
    </a>
    <a class="nav-item">
      <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
      Analitik
    </a>

    <div class="nav-label">Sistem</div>
    <a class="nav-item">
      <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.07 4.93l-1.41 1.41M4.93 4.93l1.41 1.41M12 2v2m0 16v2m7.07 1.07l-1.41-1.41M4.93 19.07l1.41-1.41M22 12h-2M4 12H2"/></svg>
      Pengaturan
    </a>
  </nav>

  <div class="sidebar-footer">
    <div class="user-chip">
      <div class="avatar">AP</div>
      <div class="user-info">
        <div class="user-name">Admin Parkify</div>
        <div class="user-role">Super Admin</div>
      </div>
      <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="var(--text-muted)" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
    </div>
  </div>
</aside>

<!-- ════════════ MAIN AREA ════════════ -->
<div class="main-area">

  <!-- TOPBAR -->
  <header class="topbar">
    <div class="hamburger" id="hamburger" onclick="toggleSidebar()">
      <span></span><span></span><span></span>
    </div>
    <div class="topbar-title" id="topbar-title">Dashboard</div>

    <div class="search-box">
      <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="var(--text-muted)" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
      <input placeholder="Cari lokasi, pengguna, plat..." />
    </div>

    <div style="margin-left:auto;display:flex;align-items:center;gap:8px">
      <span style="font-size:11px;color:var(--text-muted);font-weight:500" id="theme-label">Light</span>
      <div class="theme-toggle" id="themeToggle" onclick="toggleTheme()" title="Ganti tema">
        <div class="toggle-thumb">
          <svg class="icon-sun" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/></svg>
          <svg class="icon-moon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
        </div>
      </div>
    </div>

    <div class="topbar-btn">
      <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
      <span class="notif-dot"></span>
    </div>
    <div class="topbar-btn">
      <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M20 21a8 8 0 1 0-16 0"/></svg>
    </div>
  </header>

  <div class="content">

  <!-- ══════════════ DASHBOARD ══════════════ -->
  <div class="page active" id="page-dashboard">
    <div class="page-header">
      <div>
        <div class="page-title">Selamat Datang, Admin 👋</div>
        <div class="page-sub">Senin, 26 Mei 2026 — Data diperbarui real-time</div>
      </div>
      <div class="live-pill"><div class="live-dot"></div>Live Update</div>
    </div>

    <div class="stats-grid">
      <div class="stat-card">
        <div class="stat-top">
          <div class="stat-icon si-blue">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="3" width="15" height="13" rx="2"/><path d="M16 8h4a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2h-4"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
          </div>
          <span class="stat-trend t-up">↑ 3.2%</span>
        </div>
        <div class="stat-label">Total Slot Parkir</div>
        <div class="stat-value">2,840</div>
        <div class="stat-footer">Di 52 lokasi aktif</div>
      </div>
      <div class="stat-card">
        <div class="stat-top">
          <div class="stat-icon si-green">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
          </div>
          <span class="stat-trend t-up">↑ 12%</span>
        </div>
        <div class="stat-label">Slot Terisi Aktif</div>
        <div class="stat-value">1,647</div>
        <div class="stat-footer">58% dari kapasitas</div>
      </div>
      <div class="stat-card">
        <div class="stat-top">
          <div class="stat-icon si-amber">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/><circle cx="12" cy="9" r="2.5"/></svg>
          </div>
          <span class="stat-trend t-warn">4 alert</span>
        </div>
        <div class="stat-label">Lokasi Aktif</div>
        <div class="stat-value">52</div>
        <div class="stat-footer">4 perlu perhatian</div>
      </div>
      <div class="stat-card">
        <div class="stat-top">
          <div class="stat-icon si-purple">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
          </div>
          <span class="stat-trend t-up">↑ 8.5%</span>
        </div>
        <div class="stat-label">Pendapatan Hari Ini</div>
        <div class="stat-value">4.8jt</div>
        <div class="stat-footer">vs kemarin 4.4jt</div>
      </div>
    </div>

    <div class="grid-3-1">
      <div class="card">
        <div class="card-header">
          <span class="card-title">Tren Penggunaan Parkir</span>
          <span class="card-action">7 Hari Terakhir ↓</span>
        </div>
        <div class="chart-wrap"><canvas id="usageChart"></canvas></div>
      </div>
      <div class="card">
        <div class="card-header"><span class="card-title">Distribusi Slot</span></div>
        <div style="position:relative;height:175px;margin-bottom:14px">
          <canvas id="donutChart"></canvas>
        </div>
        <div class="donut-legend">
          <div class="dl-item">
            <div class="dl-label"><span class="dl-dot" style="background:var(--blue-main)"></span>Terisi</div>
            <span class="dl-val" style="color:var(--blue-main)">58%</span>
          </div>
          <div class="dl-item">
            <div class="dl-label"><span class="dl-dot" style="background:var(--green)"></span>Tersedia</div>
            <span class="dl-val" style="color:var(--green)">33%</span>
          </div>
          <div class="dl-item">
            <div class="dl-label"><span class="dl-dot" style="background:var(--amber)"></span>Dipesan</div>
            <span class="dl-val" style="color:var(--amber)">9%</span>
          </div>
        </div>
      </div>
    </div>

    <div class="grid-2">
      <div class="card">
        <div class="card-header">
          <span class="card-title">Transaksi Terbaru</span>
          <span class="card-action">Lihat Semua →</span>
        </div>
        <div class="table-wrap">
          <table class="data-table">
            <thead><tr><th>Kendaraan</th><th>Lokasi</th><th>Durasi</th><th>Status</th><th>Biaya</th></tr></thead>
            <tbody>
              <tr><td><span class="cell-primary">B 1234 ABC</span></td><td>ROVES123</td><td>2j 15m</td><td><span class="badge b-green">● Aktif</span></td><td class="cell-primary">Rp 15.000</td></tr>
              <tr><td><span class="cell-primary">D 5678 XYZ</span></td><td>LippoMalls</td><td>45m</td><td><span class="badge b-blue">● Masuk</span></td><td class="cell-primary">Rp 5.000</td></tr>
              <tr><td><span class="cell-primary">F 9012 DEF</span></td><td>KotakuMall</td><td>3j 30m</td><td><span class="badge b-amber">● Reservasi</span></td><td class="cell-primary">Rp 20.000</td></tr>
              <tr><td><span class="cell-primary">B 3456 GHI</span></td><td>ROVES123</td><td>1j 05m</td><td><span class="badge b-gray">● Selesai</span></td><td class="cell-primary">Rp 8.000</td></tr>
              <tr><td><span class="cell-primary">T 7890 JKL</span></td><td>Grand Mall</td><td>55m</td><td><span class="badge b-green">● Aktif</span></td><td class="cell-primary">Rp 6.000</td></tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="card">
        <div class="card-header">
          <span class="card-title">Aktivitas Sistem</span>
          <span class="card-action">Semua Log →</span>
        </div>
        <div>
          <div class="activity-item">
            <div class="act-icon" style="background:var(--green-soft)"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="var(--green)" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></div>
            <div><div class="act-main">Slot A-12 dibebaskan — ROVES123</div><div class="act-sub">2 menit lalu</div></div>
          </div>
          <div class="activity-item">
            <div class="act-icon" style="background:var(--blue-soft)"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="var(--blue-main)" stroke-width="2.5"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg></div>
            <div><div class="act-main">3 pengguna baru terdaftar</div><div class="act-sub">8 menit lalu</div></div>
          </div>
          <div class="activity-item">
            <div class="act-icon" style="background:var(--amber-soft)"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="var(--amber)" stroke-width="2.5"><path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/></svg></div>
            <div><div class="act-main">Sensor B-07 offline — LippoMalls</div><div class="act-sub">15 menit lalu</div></div>
          </div>
          <div class="activity-item">
            <div class="act-icon" style="background:var(--green-soft)"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="var(--green)" stroke-width="2.5"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/></svg></div>
            <div><div class="act-main">Pembayaran berhasil — Rp 45.000</div><div class="act-sub">22 menit lalu</div></div>
          </div>
          <div class="activity-item">
            <div class="act-icon" style="background:var(--purple-soft)"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="var(--purple)" stroke-width="2.5"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg></div>
            <div><div class="act-main">Reservasi baru — Slot C-24 KotakuMall</div><div class="act-sub">31 menit lalu</div></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ══════════════ MONITOR PARKIR ══════════════ -->
  <div class="page" id="page-monitor">
    <div class="page-header">
      <div>
        <div class="page-title">Monitor Parkir</div>
        <div class="page-sub">Pantau kondisi parkir secara real-time</div>
      </div>
      <div class="live-pill"><div class="live-dot"></div>Diperbarui setiap 5 detik</div>
    </div>

    <div class="m-stats">
      <div class="m-stat">
        <div class="m-val" style="color:var(--blue-main)">58%</div>
        <div class="m-lbl">Tingkat Hunian</div>
        <div class="prog-bar" style="margin-top:8px"><div class="prog-fill" style="width:58%;background:var(--blue-main)"></div></div>
      </div>
      <div class="m-stat">
        <div class="m-val" style="color:var(--green)">1,193</div>
        <div class="m-lbl">Slot Tersedia</div>
      </div>
      <div class="m-stat">
        <div class="m-val" style="color:var(--amber)">248</div>
        <div class="m-lbl">Dipesan</div>
      </div>
      <div class="m-stat">
        <div class="m-val" style="color:var(--red)">7</div>
        <div class="m-lbl">Sensor Error</div>
      </div>
    </div>

    <div class="monitor-grid">
      <div class="card">
        <div class="card-header">
          <span class="card-title">Peta Slot — ROVES123</span>
          <div style="display:flex;gap:8px;align-items:center;flex-wrap:wrap">
            <span class="badge b-green">● Tersedia</span>
            <span class="badge b-blue">● Terisi</span>
            <span class="badge b-amber">● Dipesan</span>
          </div>
        </div>
        <div class="floor-tabs">
          <div class="floor-tab active" onclick="setFloor(this)">Lantai 1</div>
          <div class="floor-tab" onclick="setFloor(this)">Lantai 2</div>
          <div class="floor-tab" onclick="setFloor(this)">Lantai 3</div>
          <div class="floor-tab" onclick="setFloor(this)">Lantai B1</div>
        </div>
        <div class="parking-map" id="parkingMap"></div>
        <div style="margin-top:11px;display:flex;justify-content:space-between;font-size:11.5px;color:var(--text-muted);flex-wrap:wrap;gap:4px">
          <span>Baris A–E · 10 slot/baris</span>
          <span>Klik slot untuk detail</span>
        </div>
      </div>

      <div class="card">
        <div class="card-header">
          <span class="card-title">Log Kejadian</span>
          <span class="card-action">Filter ↓</span>
        </div>
        <div id="eventLog" style="overflow-x:hidden"></div>
      </div>
    </div>
  </div>

  <!-- ══════════════ KELOLA LOKASI ══════════════ -->
  <div class="page" id="page-lokasi">
    <div class="page-header">
      <div>
        <div class="page-title">Kelola Lokasi</div>
        <div class="page-sub">52 lokasi parkir aktif di seluruh jaringan</div>
      </div>
      <button class="btn-primary">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Tambah Lokasi
      </button>
    </div>

    <div class="filter-bar">
      <div class="filter-input">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="var(--text-muted)" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        <input placeholder="Cari nama atau alamat lokasi..." />
      </div>
      <select class="filter-select"><option>Semua Status</option><option>Aktif</option><option>Tidak Aktif</option><option>Perawatan</option></select>
      <select class="filter-select"><option>Semua Kota</option><option>Jakarta</option><option>Bogor</option><option>Tangerang</option></select>
    </div>

    <div class="loc-grid" id="locGrid"></div>

    <div class="card">
      <div class="card-header">
        <span class="card-title">Semua Lokasi</span>
        <span class="card-action">Export CSV</span>
      </div>
      <div class="table-wrap">
        <table class="data-table">
          <thead><tr><th>Nama Lokasi</th><th>Alamat</th><th>Kapasitas</th><th>Hunian</th><th>Pendapatan/Hari</th><th>Status</th><th>Aksi</th></tr></thead>
          <tbody id="lokasi-tbody"></tbody>
        </table>
      </div>
      <div class="pagination" id="lok-pg"></div>
    </div>
  </div>

  <!-- ══════════════ KELOLA PENGGUNA ══════════════ -->
  <div class="page" id="page-pengguna">
    <div class="page-header">
      <div>
        <div class="page-title">Kelola Pengguna</div>
        <div class="page-sub">103.482 pengguna terdaftar — 1.247 aktif hari ini</div>
      </div>
      <button class="btn-primary">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Tambah Pengguna
      </button>
    </div>

    <div class="filter-bar">
      <div class="filter-input">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="var(--text-muted)" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        <input placeholder="Cari nama, email, atau nomor telepon..." />
      </div>
      <select class="filter-select"><option>Semua Role</option><option>Admin</option><option>Operator</option><option>Pengguna</option></select>
      <select class="filter-select"><option>Semua Status</option><option>Aktif</option><option>Tidak Aktif</option><option>Diblokir</option></select>
      <button class="btn-ghost">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="4" y1="6" x2="20" y2="6"/><line x1="8" y1="12" x2="16" y2="12"/><line x1="11" y1="18" x2="13" y2="18"/></svg>
        Filter
      </button>
    </div>

    <div class="card">
      <div class="table-wrap">
        <table class="data-table">
          <thead><tr><th>Pengguna</th><th>Kontak</th><th>Role</th><th>Transaksi</th><th>Bergabung</th><th>Status</th><th>Aksi</th></tr></thead>
          <tbody id="user-tbody"></tbody>
        </table>
      </div>
      <div class="pagination" id="usr-pg"></div>
    </div>
  </div>

  </div><!-- /content -->
</div><!-- /main-area -->
</div><!-- /app-shell -->

<!-- ════════════ BOTTOM NAV (mobile) ════════════ -->
<nav class="bottom-nav" id="bottomNav">
  <div class="bottom-nav-inner">
    <div class="bn-item active" id="bn-dashboard" onclick="showPage('dashboard')">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
      Dashboard
    </div>
    <div class="bn-item" id="bn-monitor" onclick="showPage('monitor')">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><circle cx="12" cy="12" r="9"/><line x1="12" y1="2" x2="12" y2="5"/><line x1="12" y1="19" x2="12" y2="22"/><line x1="2" y1="12" x2="5" y2="12"/><line x1="19" y1="12" x2="22" y2="12"/></svg>
      Monitor
      <span class="bn-badge">Live</span>
    </div>
    <div class="bn-item" id="bn-lokasi" onclick="showPage('lokasi')">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/><circle cx="12" cy="9" r="2.5"/></svg>
      Lokasi
    </div>
    <div class="bn-item" id="bn-pengguna" onclick="showPage('pengguna')">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
      Pengguna
    </div>
  </div>
</nav>

<script>
/* ── THEME ── */
function toggleTheme() {
  const html = document.documentElement;
  const next = html.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
  html.setAttribute('data-theme', next);
  document.getElementById('theme-label').textContent = next === 'dark' ? 'Dark' : 'Light';
  localStorage.setItem('parkify-theme', next);
  updateChartColors();
}
const saved = localStorage.getItem('parkify-theme');
if (saved) {
  document.documentElement.setAttribute('data-theme', saved);
  document.getElementById('theme-label').textContent = saved === 'dark' ? 'Dark' : 'Light';
}

/* ── NAV ── */
const pageNames = { dashboard:'Dashboard', monitor:'Monitor Parkir', lokasi:'Kelola Lokasi', pengguna:'Kelola Pengguna' };
const pages = ['dashboard','monitor','lokasi','pengguna'];

function showPage(id) {
  pages.forEach(p => {
    document.getElementById('page-' + p).classList.toggle('active', p === id);
    // sidebar items
    document.querySelectorAll('.nav-item').forEach(n => {
      if (n.getAttribute('onclick') === `showPage('${p}')`) n.classList.toggle('active', p === id);
    });
    // bottom nav items
    const bn = document.getElementById('bn-' + p);
    if (bn) bn.classList.toggle('active', p === id);
  });
  document.getElementById('topbar-title').textContent = pageNames[id] || 'Parkify';
  if (window.innerWidth <= 860) closeSidebar();
  window.scrollTo({ top: 0, behavior: 'smooth' });
}

function toggleSidebar() {
  document.getElementById('sidebar').classList.toggle('open');
  document.getElementById('overlay').classList.toggle('show');
}
function closeSidebar() {
  document.getElementById('sidebar').classList.remove('open');
  document.getElementById('overlay').classList.remove('show');
}

/* ── CHART UTILS ── */
function getCSSVar(v) { return getComputedStyle(document.documentElement).getPropertyValue(v).trim(); }

let usageChartInst, donutChartInst;

function buildCharts() {
  const textMuted = getCSSVar('--text-muted');
  const borderCol = getCSSVar('--border');
  const bluemain  = getCSSVar('--blue-main');
  const greenCol  = getCSSVar('--green');
  const amberCol  = getCSSVar('--amber');
  const cardBg    = getCSSVar('--bg-card');
  const textPrime = getCSSVar('--text-primary');

  const days = ['Sen','Sel','Rab','Kam','Jum','Sab','Min'];

  const uctx = document.getElementById('usageChart').getContext('2d');
  const grad = uctx.createLinearGradient(0,0,0,215);
  grad.addColorStop(0,'rgba(37,99,235,0.18)');
  grad.addColorStop(1,'rgba(37,99,235,0)');

  usageChartInst = new Chart(uctx, {
    type:'line',
    data:{
      labels: days,
      datasets:[
        { label:'Kendaraan Masuk', data:[820,932,901,1134,1290,1530,1320], borderColor:bluemain, backgroundColor:grad, fill:true, tension:0.42, pointBackgroundColor:bluemain, pointRadius:4, pointHoverRadius:6, borderWidth:2.5 },
        { label:'Kendaraan Keluar', data:[760,890,870,1050,1200,1410,1250], borderColor:greenCol, backgroundColor:'transparent', fill:false, tension:0.42, pointBackgroundColor:greenCol, pointRadius:4, pointHoverRadius:6, borderWidth:2, borderDash:[5,4] }
      ]
    },
    options:{
      responsive:true, maintainAspectRatio:false,
      interaction:{intersect:false, mode:'index'},
      plugins:{
        legend:{ position:'top', labels:{ padding:16, usePointStyle:true, pointStyleWidth:10, boxHeight:2, font:{size:11,family:'Poppins'}, color:textMuted } },
        tooltip:{ backgroundColor:cardBg, borderColor:borderCol, borderWidth:1, padding:10, titleColor:textPrime, bodyColor:textMuted, titleFont:{weight:'700',family:'Space Grotesk'}, bodyFont:{family:'Poppins'} }
      },
      scales:{
        x:{ grid:{color:borderCol,drawTicks:false}, border:{display:false}, ticks:{padding:8,color:textMuted,font:{family:'Poppins',size:11}} },
        y:{ grid:{color:borderCol,drawTicks:false}, border:{display:false}, ticks:{padding:8,color:textMuted,font:{family:'Poppins',size:11}} }
      }
    }
  });

  const dctx = document.getElementById('donutChart').getContext('2d');
  donutChartInst = new Chart(dctx, {
    type:'doughnut',
    data:{
      labels:['Terisi','Tersedia','Dipesan'],
      datasets:[{ data:[58,33,9], backgroundColor:[bluemain,greenCol,amberCol], borderWidth:0, hoverOffset:4 }]
    },
    options:{
      responsive:true, maintainAspectRatio:false, cutout:'72%',
      plugins:{
        legend:{display:false},
        tooltip:{ backgroundColor:cardBg, borderColor:borderCol, borderWidth:1, titleColor:textPrime, bodyColor:textMuted, callbacks:{label:ctx=>` ${ctx.label}: ${ctx.raw}%`} }
      }
    }
  });
}

function updateChartColors() {
  if (usageChartInst) { usageChartInst.destroy(); donutChartInst.destroy(); }
  requestAnimationFrame(() => requestAnimationFrame(buildCharts));
}

buildCharts();

/* ── PARKING MAP ── */
const slotTypes = ['av','oc','oc','oc','rs','av','oc','av','oc','av','oc','av','oc','oc','av','oc','rs','oc','av','av','av','oc','av','oc','av','av','oc','av','rs','oc','oc','av','oc','rs','oc','av','oc','oc','av','oc','di','di','rs','oc','av','oc','av','oc','oc','oc'];
const rows = ['A','B','C','D','E'];

function buildMap() {
  const map = document.getElementById('parkingMap');
  if (!map) return;
  map.innerHTML = '';
  slotTypes.forEach((t,i) => {
    const row = rows[Math.floor(i/10)];
    const col = (i%10)+1;
    const d = document.createElement('div');
    d.className = `pm-slot pm-${t}`;
    d.textContent = `${row}${col}`;
    if (t !== 'di') d.title = `${row}${col} — ${t==='av'?'Tersedia':t==='oc'?'Terisi':'Dipesan'}`;
    map.appendChild(d);
  });
}
buildMap();

function setFloor(el) {
  document.querySelectorAll('.floor-tab').forEach(t => t.classList.remove('active'));
  el.classList.add('active');
  slotTypes.forEach((_,i) => { const r=Math.random(); slotTypes[i]=r<.35?'av':r<.75?'oc':'rs'; if(r<.04) slotTypes[i]='di'; });
  buildMap();
}

/* ── EVENT LOG ── */
const logs = [
  {time:'07:48',plate:'B 1234 ABC',desc:'Masuk — Slot A-07',type:'in'},
  {time:'07:45',plate:'D 9988 XY',desc:'Keluar — Slot B-12',type:'out'},
  {time:'07:43',plate:'F 5566 DE',desc:'Reservasi dibatalkan C-03',type:'warn'},
  {time:'07:40',plate:'B 2233 GH',desc:'Masuk — Slot A-15',type:'in'},
  {time:'07:37',plate:'T 7781 JK',desc:'Pembayaran Rp 12.000',type:'pay'},
  {time:'07:33',plate:'B 4455 MN',desc:'Keluar — Slot D-08',type:'out'},
  {time:'07:30',plate:'F 6677 OP',desc:'Masuk — Slot E-01',type:'in'},
  {time:'07:27',plate:'D 1122 QR',desc:'Sensor error B-07',type:'warn'},
];

const logIcon = {
  in:`<svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M5 12h14"/><polyline points="12 5 19 12 12 19"/></svg>`,
  out:`<svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M19 12H5"/><polyline points="12 19 5 12 12 5"/></svg>`,
  warn:`<svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/></svg>`,
  pay:`<svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>`,
};
const logColor = {in:'var(--blue-main)',out:'var(--green)',warn:'var(--amber)',pay:'var(--green)'};
const logBg    = {in:'var(--blue-soft)',out:'var(--green-soft)',warn:'var(--amber-soft)',pay:'var(--green-soft)'};

const logEl = document.getElementById('eventLog');
if (logEl) logs.forEach(l => {
  const r = document.createElement('div'); r.className = 'log-row';
  r.innerHTML = `<div class="log-time">${l.time}</div>
    <div style="width:22px;height:22px;border-radius:6px;background:${logBg[l.type]};display:flex;align-items:center;justify-content:center;color:${logColor[l.type]};flex-shrink:0">${logIcon[l.type]}</div>
    <div class="log-plate">${l.plate}</div>
    <div class="log-desc">${l.desc}</div>`;
  logEl.appendChild(r);
});

/* ── LOKASI DATA ── */
const lokasi = [
  {name:'ROVES123',addr:'Jl. Ahmad Yani, Jakarta Timur',cap:240,occ:78,rev:'Rp 1.2jt',status:'Aktif'},
  {name:'LippoMalls BSD',addr:'Jl. Pahlawan Seribu, Tangerang',cap:560,occ:62,rev:'Rp 2.8jt',status:'Aktif'},
  {name:'KotakuMall',addr:'Jl. Margonda Raya, Depok',cap:320,occ:45,rev:'Rp 0.9jt',status:'Aktif'},
  {name:'Grand Mall Bogor',addr:'Jl. Pajajaran No.1, Bogor',cap:180,occ:88,rev:'Rp 0.6jt',status:'Penuh'},
  {name:'Alam Sutera Park',addr:'Jl. Alam Sutera, Tangerang',cap:400,occ:30,rev:'Rp 1.1jt',status:'Aktif'},
  {name:'Central Park',addr:'Jl. Letjen S. Parman, Jakarta',cap:720,occ:71,rev:'Rp 3.2jt',status:'Aktif'},
];

const barCol = p => p>80?'var(--red)':p>60?'var(--amber)':'var(--green)';
const statBadge = s => s==='Aktif'?'b-green':s==='Penuh'?'b-red':'b-amber';

const locGrid = document.getElementById('locGrid');
if (locGrid) lokasi.slice(0,3).forEach(l => {
  locGrid.innerHTML += `<div class="loc-card">
    <div class="loc-head">
      <div><div class="loc-name">${l.name}</div><div class="loc-addr">${l.addr}</div></div>
      <span class="badge ${statBadge(l.status)}">● ${l.status}</span>
    </div>
    <div class="loc-stats">
      <div><div class="ls-label">Kapasitas</div><div class="ls-val">${l.cap}</div></div>
      <div><div class="ls-label">Pendapatan</div><div class="ls-val" style="font-size:16px">${l.rev}</div></div>
    </div>
    <div class="loc-bar-row"><span>Hunian</span><span style="font-weight:700;color:${barCol(l.occ)}">${l.occ}%</span></div>
    <div class="prog-bar"><div class="prog-fill" style="width:${l.occ}%;background:${barCol(l.occ)}"></div></div>
  </div>`;
});

const lTbody = document.getElementById('lokasi-tbody');
if (lTbody) lokasi.forEach(l => {
  lTbody.innerHTML += `<tr>
    <td><span class="cell-primary">${l.name}</span></td>
    <td>${l.addr}</td>
    <td>${l.cap} slot</td>
    <td>
      <div style="display:flex;align-items:center;gap:8px;min-width:110px">
        <div style="flex:1"><div class="prog-bar"><div class="prog-fill" style="width:${l.occ}%;background:${barCol(l.occ)}"></div></div></div>
        <span style="font-size:12px;font-weight:700;color:${barCol(l.occ)};width:32px;text-align:right">${l.occ}%</span>
      </div>
    </td>
    <td>${l.rev}</td>
    <td><span class="badge ${statBadge(l.status)}">● ${l.status}</span></td>
    <td><div style="display:flex;gap:6px">
      <button class="btn-ghost" style="padding:5px 9px;font-size:11.5px">Edit</button>
      <button class="btn-ghost" style="padding:5px 9px;font-size:11.5px;color:var(--red)">Nonaktif</button>
    </div></td>
  </tr>`;
});
buildPagination('lok-pg', ['←','1','2','3','…','6','→']);

/* ── USER DATA ── */
const avatarBg = ['#2563eb','#7c3aed','#0891b2','#059669','#d97706','#dc2626','#9333ea','#0d9488'];
const users = [
  {name:'Budi Santoso',email:'budi.s@gmail.com',phone:'+62 812 3456 7890',role:'Admin',trx:142,joined:'12 Jan 2024',status:'Aktif'},
  {name:'Sari Dewi',email:'sari.dewi@yahoo.com',phone:'+62 877 9988 1234',role:'Operator',trx:87,joined:'3 Mar 2024',status:'Aktif'},
  {name:'Ahmad Fauzi',email:'fauzi.a@gmail.com',phone:'+62 856 1122 3344',role:'Pengguna',trx:23,joined:'19 Apr 2024',status:'Aktif'},
  {name:'Rina Kusuma',email:'rina.k@outlook.com',phone:'+62 821 5566 7788',role:'Pengguna',trx:6,joined:'2 Mei 2024',status:'Tidak Aktif'},
  {name:'Doni Prasetyo',email:'doni.p@gmail.com',phone:'+62 818 3344 5566',role:'Operator',trx:55,joined:'28 Feb 2024',status:'Aktif'},
  {name:'Maya Indah',email:'maya.i@gmail.com',phone:'+62 813 7788 9900',role:'Pengguna',trx:12,joined:'15 Jun 2024',status:'Diblokir'},
];

const roleBadge  = r => r==='Admin'?'b-red':r==='Operator'?'b-blue':'b-gray';
const statBadge2 = s => s==='Aktif'?'b-green':s==='Diblokir'?'b-red':'b-gray';

const uTbody = document.getElementById('user-tbody');
if (uTbody) users.forEach((u,i) => {
  const initials = u.name.split(' ').map(x=>x[0]).join('').slice(0,2);
  uTbody.innerHTML += `<tr>
    <td><div style="display:flex;align-items:center;gap:10px">
      <div class="uav" style="background:${avatarBg[i%avatarBg.length]}">${initials}</div>
      <span class="cell-primary">${u.name}</span>
    </div></td>
    <td><div style="font-size:12px">${u.email}</div><div style="font-size:11px;color:var(--text-muted)">${u.phone}</div></td>
    <td><span class="badge ${roleBadge(u.role)}">${u.role}</span></td>
    <td>${u.trx} transaksi</td>
    <td>${u.joined}</td>
    <td><span class="badge ${statBadge2(u.status)}">● ${u.status}</span></td>
    <td><div style="display:flex;gap:6px">
      <button class="btn-ghost" style="padding:5px 9px;font-size:11.5px">Edit</button>
      <button class="btn-ghost" style="padding:5px 9px;font-size:11.5px">Detail</button>
    </div></td>
  </tr>`;
});
buildPagination('usr-pg', ['←','1','2','3','…','48','→']);

function buildPagination(id, items) {
  const el = document.getElementById(id);
  if (!el) return;
  items.forEach(p => {
    const b = document.createElement('div');
    b.className = 'pg-btn' + (p==='1' ? ' active' : '');
    b.textContent = p;
    el.appendChild(b);
    b.onclick = () => { el.querySelectorAll('.pg-btn').forEach(x=>x.classList.remove('active')); b.classList.add('active'); };
  });
}
</script>
</body>
</html>