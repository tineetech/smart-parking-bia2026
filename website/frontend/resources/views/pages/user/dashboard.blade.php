<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
<title>Parkify — Home</title>
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
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
  --blue-glow:   #60a5fa;
  --blue-pale:   #dbeafe;
  --blue-soft:   #eff6ff;

  --green:       #10b981;
  --green-soft:  #ecfdf5;
  --red:         #ef4444;
  --red-soft:    #fef2f2;
  --amber:       #f59e0b;
  --amber-soft:  #fffbeb;

  --shadow-sm: 0 1px 4px rgba(15,30,54,0.07), 0 1px 2px rgba(15,30,54,0.04);
  --shadow-md: 0 4px 16px rgba(15,30,54,0.10), 0 2px 4px rgba(15,30,54,0.05);
  --shadow-lg: 0 10px 32px rgba(15,30,54,0.13);
  --shadow-card: 0 2px 12px rgba(37,99,235,0.08);

  --bottom-nav-h: 72px;
  --max-content: 1100px;
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
  position: sticky;
  top: 0;
  z-index: 100;
  width: 100%;
}

.top-header-inner {
  max-width: var(--max-content);
  margin: 0 auto;
  padding: 0 24px;
  height: 64px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 16px;
  width: 100%;
}

.header-logo {
  display: flex;
  align-items: center;
  gap: 9px;
  flex-shrink: 0;
  text-decoration: none;
}

.logo-icon {
  width: 36px;
  height: 36px;
  background: var(--blue-main);
  border-radius: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
}
.logo-icon svg { color: #fff; }

.logo-text {
  font-family: 'Space Grotesk', sans-serif;
  font-size: 20px;
  font-weight: 800;
  color: var(--text-primary);
  letter-spacing: -0.5px;
}
.logo-text span { color: var(--blue-main); }

/* Desktop Nav */
.desktop-nav {
  display: flex;
  align-items: center;
  gap: 4px;
}

.desktop-nav a {
  display: flex;
  align-items: center;
  gap: 6px;
  padding: 7px 14px;
  border-radius: 10px;
  font-size: 13px;
  font-weight: 500;
  color: var(--text-secondary);
  text-decoration: none;
  transition: all 0.16s;
  cursor: pointer;
}

.desktop-nav a:hover { background: var(--bg-hover); color: var(--text-primary); }
.desktop-nav a.active {
  background: var(--blue-soft);
  color: var(--blue-main);
  font-weight: 600;
  border: 1px solid var(--blue-pale);
}

/* User Chip */
.header-user {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 6px 12px 6px 6px;
  border-radius: 12px;
  background: var(--bg-input);
  border: 1px solid var(--border);
  cursor: pointer;
  transition: border-color 0.16s;
  flex-shrink: 0;
}
.header-user:hover { border-color: var(--border-focus); }

.user-avatar {
  width: 32px;
  height: 32px;
  border-radius: 50%;
  overflow: hidden;
  background: linear-gradient(135deg, #f59e0b, #ef4444);
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 700;
  font-size: 13px;
  color: #fff;
  font-family: 'Space Grotesk', sans-serif;
  flex-shrink: 0;
}

.user-avatar img { width: 100%; height: 100%; object-fit: cover; }

.user-name-text {
  font-size: 13px;
  font-weight: 600;
  color: var(--text-primary);
  white-space: nowrap;
}

/* Hamburger for mobile */
.hamburger-btn {
  display: none;
  width: 36px; height: 36px;
  align-items: center; justify-content: center;
  background: var(--bg-input);
  border: 1px solid var(--border);
  border-radius: 10px;
  cursor: pointer;
  flex-shrink: 0;
}
.hamburger-btn svg { color: var(--text-secondary); }

/* ═══════════════════════════════════════
   MAIN CONTENT
═══════════════════════════════════════ */
.main-wrap {
  width: 100%;
  padding-bottom: calc(var(--bottom-nav-h) + 20px + env(safe-area-inset-bottom));
}

.content-inner {
  max-width: var(--max-content);
  margin: 0 auto;
  padding: 0 24px;
  width: 100%;
}

/* ═══════════════════════════════════════
   HERO BANNER
═══════════════════════════════════════ */
.hero-banner {
  background: transparent;
  padding: 32px 0 0;
  position: relative;
  overflow: hidden;
  width: 100%;
}

.hero-banner::before {
  display: none;
}

.hero-banner::after {
  display: none;
}

.hero-inner {
  max-width: var(--max-content);
  margin: 0 auto;
  padding: 0 24px 28px;
  position: relative;
  z-index: 1;
}

.hero-greeting {
  font-size: 12.5px;
  color: var(--text-muted);
  font-weight: 400;
  margin-bottom: 3px;
}

.hero-name {
  font-family: 'Space Grotesk', sans-serif;
  font-size: 24px;
  font-weight: 800;
  color: var(--text-primary);
  margin-bottom: 20px;
  letter-spacing: -0.3px;
}

/* Search Box */
.search-bar {
  display: flex;
  align-items: center;
  gap: 10px;
  background: #fff;
  border-radius: 14px;
  padding: 12px 16px;
  /* box-shadow: 0 8px 32px rgba(0,0,0,0.18); */
  margin-bottom: 16px;
  position: relative;
  transition: box-shadow 0.2s;
  width: 100%;
}
.search-bar:focus-within { box-shadow: 0 8px 32px rgba(37,99,235,0.22); }

.search-bar input {
  flex: 1;
  border: none;
  outline: none;
  font-family: 'Poppins', sans-serif;
  font-size: 13.5px;
  border: .8px solid rgba(255,255,255,0.9);
  padding-block: 10px;

  color: var(--text-primary);
  background: transparent;
}
.search-bar input::placeholder { color: var(--text-muted); }

.search-icon { color: var(--text-muted); flex-shrink: 0; }
.search-loc-btn {
  position: absolute;
  width: 36px; height: 36px;
  border-radius: 10px;
  background: var(--blue-soft);
  border: none;
  right: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  color: var(--blue-main);
  flex-shrink: 0;
  transition: background 0.16s;
}
.search-loc-btn:hover { background: var(--blue-pale); }

/* Filter Pills */
.filter-pills {
  display: flex;
  gap: 8px;
  overflow-x: auto;
  -webkit-overflow-scrolling: touch;
  scrollbar-width: none;
  padding-bottom: 4px;
}
.filter-pills::-webkit-scrollbar { display: none; }

.pill {
  display: flex;
  align-items: center;
  gap: 5px;
  padding: 7px 14px;
  border-radius: 999px;
  font-size: 12.5px;
  font-weight: 600;
  font-family: 'Poppins', sans-serif;
  cursor: pointer;
  white-space: nowrap;
  transition: all 0.16s;
  flex-shrink: 0;
  border: 1.5px solid var(--border);
  color: var(--text-secondary);
  background: var(--bg-surface);
}

.pill.active, .pill:hover {
  background: var(--blue-main);
  border-color: var(--blue-main);
  color: #fff;
}

/* ═══════════════════════════════════════
   MAP SECTION
═══════════════════════════════════════ */
.map-section {
  position: relative;
  display: flex;
  justify-content: center;
  padding: 0 !important;
  align-items: center;
  width: 100%;
}

.map-section::before,
.map-section::after {
  content: '';
  position: absolute;
  left: 0; right: 0;
  height: 64px;
  z-index: 10;
  pointer-events: none;
}

#parkingMap {
  width: 100%;
  height: 340px;
  background: white;
  border-radius: 20px;
}

/* Leaflet popup override */
.leaflet-popup-content-wrapper {
  border-radius: 12px !important;
  box-shadow: var(--shadow-lg) !important;
  padding: 0 !important;
  overflow: hidden;
}
.leaflet-popup-content {
  margin: 0 !important;
  width: auto !important;
}
.custom-popup {
  padding: 12px 14px;
  min-width: 180px;
}
.popup-name {
  font-family: 'Space Grotesk', sans-serif;
  font-size: 13px;
  font-weight: 700;
  color: var(--text-primary);
  margin-bottom: 4px;
}
.popup-meta {
  display: flex;
  align-items: center;
  gap: 8px;
  flex-wrap: wrap;
}
.popup-badge {
  font-size: 11px;
  font-weight: 600;
  padding: 2px 8px;
  border-radius: 999px;
  font-family: 'Poppins', sans-serif;
}
.popup-avail { background: var(--green-soft); color: var(--green); }
.popup-busy  { background: var(--amber-soft); color: var(--amber); }
.popup-full  { background: var(--red-soft); color: var(--red); }
.popup-price {
  font-size: 11.5px;
  color: var(--blue-main);
  font-weight: 600;
}
.popup-btn {
  display: block;
  width: 100%;
  margin-top: 8px;
  background: var(--blue-main);
  color: #fff !important;
  border: none;
  border-radius: 8px;
  padding: 7px;
  font-size: 12px;
  font-weight: 600;
  font-family: 'Poppins', sans-serif;
  cursor: pointer;
  text-align: center;
  text-decoration: none;
  transition: background 0.15s;
}
.popup-btn:hover { background: var(--blue-bright); }

/* Custom marker */
.custom-marker {
  width: 32px; height: 32px;
  border-radius: 50% 50% 50% 0;
  transform: rotate(-45deg);
  display: flex;
  align-items: center;
  justify-content: center;
  border: 2px solid #fff;
  box-shadow: 0 2px 8px rgba(0,0,0,0.25);
}
.custom-marker svg { transform: rotate(45deg); }
.marker-avail { background: var(--green); }
.marker-busy  { background: var(--amber); }
.marker-full  { background: var(--red); }

/* Map overlay controls */
.map-controls {
  position: absolute;
  bottom: 16px;
  right: 12px;
  display: flex;
  flex-direction: column;
  gap: 6px;
  z-index: 999;
}
.map-ctrl-btn {
  width: 36px; height: 36px;
  background: #fff;
  border: 1px solid var(--border);
  border-radius: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  box-shadow: var(--shadow-md);
  color: var(--text-secondary);
  transition: border-color 0.15s;
}
.map-ctrl-btn:hover { border-color: var(--blue-main); color: var(--blue-main); }

/* ═══════════════════════════════════════
   SECTIONS INSIDE CONTENT
═══════════════════════════════════════ */
.section {
  padding: 26px 0 0;
}

.section-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 16px;
  flex-wrap: wrap;
  gap: 8px;
}

.section-title {
  font-family: 'Space Grotesk', sans-serif;
  font-size: 16px;
  font-weight: 800;
  color: var(--text-primary);
  letter-spacing: -0.2px;
}

.section-action {
  font-size: 12.5px;
  font-weight: 600;
  color: var(--blue-main);
  cursor: pointer;
  text-decoration: none;
  transition: opacity 0.15s;
}
.section-action:hover { opacity: 0.7; }

/* ═══════════════════════════════════════
   QUICK STATS
═══════════════════════════════════════ */
.quick-stats {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 10px;
}

.qs-card {
  background: var(--bg-card);
  border: 1px solid var(--border);
  border-radius: 14px;
  padding: 16px;
  text-align: center;
  box-shadow: var(--shadow-sm);
  transition: border-color 0.2s, transform 0.2s;
  cursor: default;
}
.qs-card:hover { border-color: var(--blue-pale); transform: translateY(-2px); }

.qs-icon {
  width: 38px; height: 38px;
  border-radius: 10px;
  display: flex; align-items: center; justify-content: center;
  margin: 0 auto 10px;
}
.qs-val {
  font-family: 'Space Grotesk', sans-serif;
  font-size: 20px;
  font-weight: 800;
  color: var(--text-primary);
  line-height: 1;
  margin-bottom: 4px;
}
.qs-label {
  font-size: 11px;
  color: var(--text-muted);
  font-weight: 500;
}

/* ═══════════════════════════════════════
   LOCATION CARDS (Recommended)
═══════════════════════════════════════ */
.loc-scroll {
  display: flex;
  gap: 14px;
  overflow-x: auto;
  -webkit-overflow-scrolling: touch;
  scrollbar-width: none;
  padding-bottom: 6px;
}
.loc-scroll::-webkit-scrollbar { display: none; }

.loc-card {
  background: var(--bg-card);
  border: 1px solid var(--border);
  border-radius: 16px;
  overflow: hidden;
  box-shadow: var(--shadow-card);
  cursor: pointer;
  transition: transform 0.2s, box-shadow 0.2s, border-color 0.2s;
  flex-shrink: 0;
  width: 220px;
  text-decoration: none;
  color: inherit;
  display: block;
}

.loc-card:hover {
  transform: translateY(-3px);
  box-shadow: var(--shadow-md);
  border-color: var(--blue-pale);
}

.loc-img {
  width: 100%;
  height: 120px;
  object-fit: cover;
  display: block;
  background: linear-gradient(135deg, #dbeafe, #e0f2fe);
}

.loc-img-placeholder {
  width: 100%;
  height: 120px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 32px;
}

.loc-body { padding: 12px 14px 14px; }

.loc-name {
  font-family: 'Space Grotesk', sans-serif;
  font-size: 13.5px;
  font-weight: 700;
  color: var(--text-primary);
  margin-bottom: 3px;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.loc-addr {
  font-size: 11.5px;
  color: var(--text-muted);
  margin-bottom: 10px;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.loc-meta {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 6px;
}

.loc-price {
  font-size: 12px;
  font-weight: 700;
  color: var(--blue-main);
  display: flex;
  align-items: center;
  gap: 4px;
  font-family: 'Space Grotesk', sans-serif;
}

.loc-slots {
  font-size: 11px;
  font-weight: 600;
  display: flex;
  align-items: center;
  gap: 4px;
}

.loc-rating {
  display: flex;
  align-items: center;
  gap: 3px;
  font-size: 11.5px;
  font-weight: 600;
  color: var(--amber);
  font-family: 'Space Grotesk', sans-serif;
}

/* ═══════════════════════════════════════
   ALL LOCATIONS GRID
═══════════════════════════════════════ */
.all-loc-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 14px;
}

.all-loc-card {
  background: var(--bg-card);
  border: 1px solid var(--border);
  border-radius: 14px;
  padding: 16px;
  display: flex;
  align-items: center;
  gap: 12px;
  box-shadow: var(--shadow-sm);
  cursor: pointer;
  transition: border-color 0.2s, transform 0.2s, box-shadow 0.2s;
  text-decoration: none;
  color: inherit;
}

.all-loc-card:hover {
  border-color: var(--blue-pale);
  transform: translateY(-2px);
  box-shadow: var(--shadow-md);
}

.alc-icon {
  width: 44px; height: 44px;
  border-radius: 12px;
  display: flex; align-items: center; justify-content: center;
  font-size: 20px;
  flex-shrink: 0;
}

.alc-name {
  font-family: 'Space Grotesk', sans-serif;
  font-size: 13px;
  font-weight: 700;
  margin-bottom: 3px;
}

.alc-meta {
  font-size: 11.5px;
  color: var(--text-muted);
  display: flex;
  align-items: center;
  gap: 6px;
  flex-wrap: wrap;
}

.alc-dot { width: 4px; height: 4px; border-radius: 50%; background: var(--border); }

.avail-text { color: var(--green); font-weight: 600; }
.busy-text  { color: var(--amber); font-weight: 600; }
.full-text  { color: var(--red);   font-weight: 600; }

/* ═══════════════════════════════════════
   ACTIVE PARKING CARD
═══════════════════════════════════════ */
.active-parking-card {
  background: linear-gradient(135deg, #1d4ed8 0%, #2563eb 100%);
  border-radius: 18px;
  padding: 20px 22px;
  display: flex;
  align-items: center;
  gap: 16px;
  position: relative;
  overflow: hidden;
  width: 100%;
}

.active-parking-card::after {
  content: '';
  position: absolute;
  bottom: -40px; right: -40px;
  width: 160px; height: 160px;
  border-radius: 50%;
  background: rgba(255,255,255,0.07);
}

.apc-icon {
  width: 52px; height: 52px;
  border-radius: 14px;
  background: rgba(255,255,255,0.15);
  display: flex; align-items: center; justify-content: center;
  flex-shrink: 0;
  color: #fff;
}

.apc-body { flex: 1; min-width: 0; }
.apc-label { font-size: 11.5px; color: rgba(255,255,255,0.7); margin-bottom: 4px; }
.apc-name { font-family: 'Space Grotesk', sans-serif; font-size: 16px; font-weight: 800; color: #fff; margin-bottom: 5px; }
.apc-meta { display: flex; gap: 12px; flex-wrap: wrap; }
.apc-meta-item { font-size: 12px; color: rgba(255,255,255,0.8); display: flex; align-items: center; gap: 4px; }

.apc-action {
  background: rgba(255,255,255,0.15);
  border: 1px solid rgba(255,255,255,0.25);
  border-radius: 10px;
  padding: 8px 14px;
  font-size: 12.5px;
  font-weight: 600;
  color: #fff;
  cursor: pointer;
  white-space: nowrap;
  font-family: 'Poppins', sans-serif;
  transition: background 0.15s;
  flex-shrink: 0;
}
.apc-action:hover { background: rgba(255,255,255,0.22); }

/* ═══════════════════════════════════════
   RECENT HISTORY
═══════════════════════════════════════ */
.history-list { display: flex; flex-direction: column; gap: 0; }

.hist-item {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 13px 0;
  border-bottom: 1px solid var(--border);
  cursor: pointer;
  transition: background 0.15s;
}
.hist-item:last-child { border-bottom: none; }
.hist-item:hover { background: var(--bg-hover); margin: 0 -16px; padding-left: 16px; padding-right: 16px; border-radius: 10px; }

.hist-icon {
  width: 38px; height: 38px;
  border-radius: 10px;
  display: flex; align-items: center; justify-content: center;
  flex-shrink: 0;
}

.hist-body { flex: 1; min-width: 0; }
.hist-name { font-size: 13px; font-weight: 600; color: var(--text-primary); margin-bottom: 2px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.hist-sub { font-size: 11.5px; color: var(--text-muted); }

.hist-right { text-align: right; flex-shrink: 0; }
.hist-price { font-family: 'Space Grotesk', sans-serif; font-size: 13px; font-weight: 700; color: var(--text-primary); margin-bottom: 2px; }
.hist-date { font-size: 11px; color: var(--text-muted); }

/* ═══════════════════════════════════════
   PROMO BANNER
═══════════════════════════════════════ */
.promo-scroll {
  display: flex;
  gap: 12px;
  overflow-x: auto;
  -webkit-overflow-scrolling: touch;
  scrollbar-width: none;
  padding-bottom: 4px;
}
.promo-scroll::-webkit-scrollbar { display: none; }

.promo-card {
  flex-shrink: 0;
  border-radius: 16px;
  padding: 18px 22px;
  min-width: 260px;
  position: relative;
  overflow: hidden;
  cursor: pointer;
}

.promo-card::after {
  content: '';
  position: absolute;
  top: -30px; right: -30px;
  width: 120px; height: 120px;
  border-radius: 50%;
  background: rgba(255,255,255,0.1);
}

.promo-tag {
  display: inline-block;
  background: rgba(255,255,255,0.22);
  color: #fff;
  font-size: 10.5px;
  font-weight: 700;
  padding: 3px 10px;
  border-radius: 999px;
  margin-bottom: 8px;
  letter-spacing: 0.04em;
}

.promo-title {
  font-family: 'Space Grotesk', sans-serif;
  font-size: 17px;
  font-weight: 800;
  color: #fff;
  margin-bottom: 5px;
  letter-spacing: -0.2px;
}

.promo-desc { font-size: 12px; color: rgba(255,255,255,0.8); }

/* ═══════════════════════════════════════
   BOTTOM NAV — matches design reference
═══════════════════════════════════════ */
.bottom-nav {
  position: fixed;
  bottom: 0; left: 0; right: 0;
  width: 100%;
  z-index: 9999;
  display: flex;
  align-items: flex-end;
  justify-content: center;
  background: transparent;
  pointer-events: none;
  padding-bottom: calc(12px + env(safe-area-inset-bottom));
}

.bottom-nav-inner {
  display: flex;
  align-items: center;
  background: var(--bg-surface);
  border: 1px solid var(--border);
  border-radius: 999px;
  box-shadow: 0 4px 24px rgba(15,30,54,0.13), 0 1px 4px rgba(15,30,54,0.06);
  padding: 6px 8px;
  gap: 6px;
  pointer-events: all;
  width: auto;
  max-width: calc(100vw - 32px);
}

.bn-item {
  display: flex;
  flex-direction: row;
  align-items: center;
  justify-content: center;
  gap: 7px;
  padding: 10px 12px;
  border-radius: 999px;
  cursor: pointer;
  color: var(--text-secondary);
  font-size: 13px;
  font-weight: 600;
  font-family: 'Poppins', sans-serif;
  transition: all 0.22s cubic-bezier(0.34, 1.56, 0.64, 1);
  -webkit-tap-highlight-color: transparent;
  white-space: nowrap;
  background: transparent;
}

/* Inactive: icon sits in a soft grey circle, no label */
.bn-item:not(.active) {
  background: #f3f4f6;
  border-radius: 50%;
  width: 46px;
  height: 46px;
  padding: 0;
}

.bn-item:not(.active) span { display: none; }

.bn-item svg {
  width: 22px; height: 22px;
  flex-shrink: 0;
  transition: transform 0.22s cubic-bezier(0.34, 1.56, 0.64, 1);
}

/* Active: blue pill with icon + text label */
.bn-item.active {
  background: var(--blue-main);
  color: #fff;
  padding: 12px 20px;
  border-radius: 999px;
  width: auto;
  height: auto;
}

.bn-item.active svg { transform: scale(1.05); }
.bn-item.active span { display: inline; color: #fff; }

.bn-item:not(.active):hover {
  background: #e9eaf0;
  border-radius: 50%;
}

/* Desktop: hide bottom nav, show desktop nav */
@media (min-width: 860px) {
  .bottom-nav { display: none; }
  .hamburger-btn { display: none; }
  .main-wrap { padding-bottom: 40px; }
}

/* Mobile: hide desktop nav */
@media (max-width: 859px) {
  .desktop-nav { display: none; }
  .header-user .user-name-text { display: none; }
  .hero-name { font-size: 20px; }
  .all-loc-grid { grid-template-columns: 1fr 1fr; }
  .quick-stats { grid-template-columns: repeat(3, 1fr); }
  .top-header-inner { padding: 0 16px; }
  .hero-inner { padding: 0 16px 24px; }
  .content-inner { padding: 0 16px; }
}

@media (max-width: 620px) {
  .all-loc-grid { grid-template-columns: 1fr; }
  .quick-stats { grid-template-columns: repeat(3, 1fr); }
  .qs-val { font-size: 18px; }
  .active-parking-card { flex-wrap: wrap; }
  .apc-action { width: 100%; text-align: center; }
  #parkingMap { height: 260px; }
}

@media (max-width: 400px) {
  .quick-stats { gap: 8px; }
  .qs-card { padding: 12px 10px; }
}

/* CARD WRAPPER */
.card-wrap {
  background: var(--bg-card);
  border: 1px solid var(--border);
  border-radius: 16px;
  padding: 18px;
  box-shadow: var(--shadow-sm);
}

/* ═══════════════════════════════════════
   SCROLL FADE WRAPPER
═══════════════════════════════════════ */
.scroll-fade-wrap {
  position: relative;
}

/* .scroll-fade-wrap::before,
.scroll-fade-wrap::after {
  content: '';
  position: absolute;
  top: 0;
  bottom: 1px;
  width: 48px;
  z-index: 2;
  pointer-events: none;
  transition: opacity 0.2s;
} */

.scroll-fade-wrap::before {
  left: 0;
  background: linear-gradient(to right, rgba(217,229,248,1) 0%, rgba(217,229,248,0) 100%);
}

.scroll-fade-wrap::after {
  right: 0;
  background: linear-gradient(to left, rgba(217,229,248,1) 0%, rgba(217,229,248,0) 100%);
}

/* For sections sitting inside card-wrap (white bg) */
.scroll-fade-wrap.on-white::before {
  background: linear-gradient(to right, #ffffff 0%, transparent 100%);
}
.scroll-fade-wrap.on-white::after {
  background: linear-gradient(to left, #ffffff 0%, transparent 100%);
}

/* Scroll-snap for loc-scroll on mobile */
@media (max-width: 860px) {
  .loc-scroll { scroll-snap-type: x mandatory; }
  .loc-card { scroll-snap-align: start; }
}
.badge {
  display: inline-flex; align-items: center; gap: 3px;
  padding: 3px 9px; border-radius: 999px;
  font-size: 10.5px; font-weight: 600;
  font-family: 'Poppins', sans-serif;
  white-space: nowrap;
}
.b-green  { background: var(--green-soft);  color: var(--green); }
.b-amber  { background: var(--amber-soft);  color: var(--amber); }
.b-red    { background: var(--red-soft);    color: var(--red); }
.b-blue   { background: var(--blue-soft);   color: var(--blue-main); }
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

    <!-- Desktop Nav -->
    <nav class="desktop-nav">
      <a class="active" onclick="setNav(this,'home')">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
        Home
      </a>
      <a onclick="setNav(this,'kendaraan')">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="3" width="15" height="13" rx="2"/><path d="M16 8h4a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2h-4"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
        Kendaraan
      </a>
      <a onclick="setNav(this,'riwayat')">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
        Riwayat
      </a>
      <a onclick="setNav(this,'settings')">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.07 4.93l-1.41 1.41M4.93 4.93l1.41 1.41M12 2v2m0 16v2m7.07 1.07l-1.41-1.41M4.93 19.07l1.41-1.41M22 12h-2M4 12H2"/></svg>
        Pengaturan
      </a>
    </nav>

    <div style="display:flex;align-items:center;gap:10px;margin-left:auto">
      <!-- Notification -->
      <div style="position:relative">
        <div class="map-ctrl-btn" style="width:36px;height:36px;cursor:pointer">
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

  <!-- HERO BANNER -->
  <section class="hero-banner">
    <div class="hero-inner">
      <div class="hero-greeting">Selamat Datang,</div>
      <div class="hero-name">Adam Mustahir 👋</div>

      <!-- Search -->
      <div class="search-bar">
        <svg class="search-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        <input id="searchInput" placeholder="Cari lokasi parkir..." />
        <button class="search-loc-btn" title="Lokasi saya">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="3"/><path d="M12 1v4M12 19v4M1 12h4M19 12h4"/></svg>
        </button>
      </div>

      <!-- Filter Pills -->
      <div class="filter-pills">
        <div class="pill active" onclick="filterPill(this)">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="4" y1="6" x2="20" y2="6"/><line x1="8" y1="12" x2="16" y2="12"/><line x1="11" y1="18" x2="13" y2="18"/></svg>
          Semua
        </div>
        <div class="pill" onclick="filterPill(this)">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="1" y="3" width="15" height="13" rx="2"/><circle cx="5.5" cy="18.5" r="2.5"/></svg>
          Parkir
        </div>
        <div class="pill" onclick="filterPill(this)">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="1" y="3" width="15" height="13" rx="2"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
          Kendaraan
        </div>
        <div class="pill" onclick="filterPill(this)">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/></svg>
          Terdekat
        </div>
        <div class="pill" onclick="filterPill(this)">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
          Terpopuler
        </div>
        <div class="pill" onclick="filterPill(this)">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/></svg>
          Termurah
        </div>
      </div>
    </div>
  </section>

  <!-- MAP -->
  <div class="content-inner">


    <div class="map-section section">
      <div id="parkingMap"></div>
      <div class="map-controls">
        <div class="map-ctrl-btn" onclick="map.zoomIn()" title="Zoom in">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        </div>
        <div class="map-ctrl-btn" onclick="map.zoomOut()" title="Zoom out">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/></svg>
        </div>
        <div class="map-ctrl-btn" onclick="centerMap()" title="Lokasi saya">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="3"/><path d="M12 1v4M12 19v4M1 12h4M19 12h4"/></svg>
        </div>
      </div>
    </div>
  </div>

  <div class="content-inner">

    <!-- Active Parking Card -->
    <div class="section">
      <div class="active-parking-card">
        <div class="apc-icon">
          <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="3" width="15" height="13" rx="2"/><path d="M16 8h4a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2h-4"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
        </div>
        <div class="apc-body">
          <div class="apc-label">Parkir Aktif Sekarang</div>
          <div class="apc-name">Mall Botani Square</div>
          <div class="apc-meta">
            <div class="apc-meta-item">
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
              1j 34m tersisa
            </div>
            <div class="apc-meta-item">
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/></svg>
              Slot B-07
            </div>
          </div>
        </div>
        <button class="apc-action">Detail →</button>
      </div>
    </div>

    <!-- Recommended Locations — right after active parking -->
    <div class="section">
      <div class="section-header">
        <span class="section-title">Lokasi Terdekat</span>
        <a class="section-action" href="#">Lihat Semua →</a>
      </div>
      <div class="scroll-fade-wrap">
        <div class="loc-scroll" id="locScroll"></div>
      </div>
    </div>

    <!-- Quick Stats -->
    <div class="section">
      <div class="section-header">
        <span class="section-title">Ringkasan Saya</span>
      </div>
      <div class="quick-stats">
        <div class="qs-card">
          <div class="qs-icon" style="background:var(--blue-soft)">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--blue-main)" stroke-width="2"><rect x="1" y="3" width="15" height="13" rx="2"/><circle cx="5.5" cy="18.5" r="2.5"/></svg>
          </div>
          <div class="qs-val">24</div>
          <div class="qs-label">Total Parkir</div>
        </div>
        <div class="qs-card">
          <div class="qs-icon" style="background:var(--green-soft)">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--green)" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/></svg>
          </div>
          <div class="qs-val">178k</div>
          <div class="qs-label">Total Biaya</div>
        </div>
        <div class="qs-card">
          <div class="qs-icon" style="background:var(--amber-soft)">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--amber)" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M20 21a8 8 0 1 0-16 0"/></svg>
          </div>
          <div class="qs-val">2</div>
          <div class="qs-label">Kendaraan</div>
        </div>
      </div>
    </div>

    <!-- Promo Banners -->
    <div class="section">
      <div class="section-header">
        <span class="section-title">Promo & Penawaran</span>
        <a class="section-action">Lihat Semua →</a>
      </div>
      <div class="scroll-fade-wrap">
        <div class="promo-scroll">
          <div class="promo-card" style="background:linear-gradient(135deg,#2563eb,#7c3aed)">
            <div class="promo-tag">WEEKEND DEAL</div>
            <div class="promo-title">50% Off<br>Sabtu & Minggu</div>
            <div class="promo-desc">Berlaku di 12 lokasi terpilih</div>
          </div>
          <div class="promo-card" style="background:linear-gradient(135deg,#059669,#10b981)">
            <div class="promo-tag">MEMBER BENEFIT</div>
            <div class="promo-title">Parkir Gratis<br>Jam Pertama</div>
            <div class="promo-desc">Khusus member Parkify Premium</div>
          </div>
          <div class="promo-card" style="background:linear-gradient(135deg,#d97706,#f59e0b)">
            <div class="promo-tag">CASHBACK</div>
            <div class="promo-title">Cashback<br>Rp 10.000</div>
            <div class="promo-desc">Min. transaksi Rp 20.000</div>
          </div>
        </div>
      </div>
    </div>

    <!-- All Locations Grid -->
    <div class="section">
      <div class="section-header">
        <span class="section-title">Semua Lokasi Populer</span>
        <a class="section-action">Lihat Peta →</a>
      </div>
      <div class="all-loc-grid" id="allLocGrid"></div>
    </div>

    <!-- Recent History -->
    <div class="section">
      <div class="section-header">
        <span class="section-title">Riwayat Parkir</span>
        <a class="section-action">Lihat Semua →</a>
      </div>
      <div class="card-wrap">
        <div class="history-list" id="historyList"></div>
      </div>
    </div>

    <!-- Footer Spacer -->
    <div style="height: 12px"></div>

  </div>
</main>

<!-- ════════════ BOTTOM NAV ════════════ -->
<nav class="bottom-nav">
  <div class="bottom-nav-inner">
    <div class="bn-item active" id="bn-home" onclick="setNav(null,'home')">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
      <span>Home</span>
    </div>
    <div class="bn-item" id="bn-kendaraan" onclick="setNav(null,'kendaraan')">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="3" width="15" height="13" rx="2"/><path d="M16 8h4a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2h-4"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
      <span>Kendaraan</span>
    </div>
    <div class="bn-item" id="bn-riwayat" onclick="setNav(null,'riwayat')">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
      <span>Riwayat</span>
    </div>
    <div class="bn-item" id="bn-settings" onclick="setNav(null,'settings')">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.07 4.93l-1.41 1.41M4.93 4.93l1.41 1.41M12 2v2m0 16v2m7.07 1.07l-1.41-1.41M4.93 19.07l1.41-1.41M22 12h-2M4 12H2"/></svg>
      <span>Pengaturan</span>
    </div>
  </div>
</nav>

<script>
/* ═══════════════════════════════════════
   NAV
═══════════════════════════════════════ */
function setNav(el, id) {
  // desktop nav
  document.querySelectorAll('.desktop-nav a').forEach(a => a.classList.remove('active'));
  if (el) el.classList.add('active');

  // bottom nav
  ['home','kendaraan','riwayat','settings'].forEach(k => {
    const bn = document.getElementById('bn-'+k);
    if (bn) bn.classList.toggle('active', k === id);
  });
}

/* ═══════════════════════════════════════
   FILTER PILLS
═══════════════════════════════════════ */
function filterPill(el) {
  document.querySelectorAll('.pill').forEach(p => p.classList.remove('active'));
  el.classList.add('active');
}

/* ═══════════════════════════════════════
   LEAFLET MAP
═══════════════════════════════════════ */
const parkingLocations = [
  { id:1, name:'Mall Botani Square', addr:'Jl. Pajajaran, Bogor', lat:-6.6014292, lng:106.8053555, slots:20, status:'avail', price:'Rp 2.500/jam', rating:4.9, dist:'0.3 km' },
  { id:2, name:'Mall BTM Bogor', addr:'Jl. Siliwangi, Bogor', lat:-6.605102, lng:106.7956441, slots:5, status:'busy', price:'Rp 2.000/jam', rating:4.5, dist:'0.5 km' },
  { id:3, name:'Lippo Plaza Keboen Raya', addr:'Jl. Malabar 2, Bogor', lat:-6.5953398, lng:106.8055768, slots:0, status:'full', price:'Rp 3.000/jam', rating:4.7, dist:'1.2 km' },
  { id:4, name:'Lippo Plaza Ekalosari', addr:'Jl. Siliwangi No.123, Bogor', lat:-6.6215578, lng:106.8170248, slots:32, status:'avail', price:'Rp 2.000/jam', rating:4.3, dist:'0.8 km' },
  { id:6, name:'Parkify Office', addr:'Jl. Raya Tajur, Bogor', lat:-6.6408366, lng:106.8244098, slots:8, status:'busy', price:'Rp 2.000/jam', rating:4.0, dist:'0.6 km' },
];

const statusColor = { avail: '#10b981', busy: '#f59e0b', full: '#ef4444' };
const statusLabel = { avail: 'Tersedia', busy: 'Hampir Penuh', full: 'Penuh' };
const statusClass = { avail: 'popup-avail', busy: 'popup-busy', full: 'popup-full' };

let map;
let userMarker;

function initMap() {
  map = L.map('parkingMap', {
    center: [-6.5944, 106.7892],
    zoom: 15,
    zoomControl: false,
    scrollWheelZoom: true
  });

  L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
    attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> © <a href="https://carto.com/">CARTO</a>',
    subdomains: 'abcd',
    maxZoom: 20
  }).addTo(map);

  parkingLocations.forEach(loc => {
    const color = statusColor[loc.status];
    const icon = L.divIcon({
      className: '',
      html: `<div style="
        width:36px;height:36px;
        border-radius:50% 50% 50% 0;
        background:${color};
        transform:rotate(-45deg);
        border:3px solid #fff;
        box-shadow:0 3px 10px rgba(0,0,0,0.3);
        display:flex;align-items:center;justify-content:center;
      "><svg style="transform:rotate(45deg)" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5"><rect x="1" y="3" width="15" height="13" rx="2"/><circle cx="5.5" cy="18.5" r="2.5"/></svg></div>`,
      iconSize: [36, 36],
      iconAnchor: [18, 36],
      popupAnchor: [0, -38]
    });

    const marker = L.marker([loc.lat, loc.lng], { icon }).addTo(map);
    marker.bindPopup(`
      <div class="custom-popup">
        <div class="popup-name">${loc.name}</div>
        <div style="font-size:11px;color:#94a3b8;margin-bottom:8px">${loc.addr}</div>
        <div class="popup-meta">
          <span class="popup-badge ${statusClass[loc.status]}">● ${statusLabel[loc.status]}</span>
          <span class="popup-price">${loc.price}</span>
        </div>
        ${loc.slots > 0 ? `<div style="font-size:11px;color:#64748b;margin-top:6px">${loc.slots} slot tersedia</div>` : ''}
        <a class="popup-btn" href="/user/location/${loc.id}">Lihat Detail →</a>
      </div>
    `, { maxWidth: 220 });
  });

  // User location dot
  // L.circleMarker([-6.5944, 106.7892], {
  //   radius: 8, color: '#2563eb', fillColor: '#2563eb',
  //   fillOpacity: 0.9, weight: 3
  // }).addTo(map).bindPopup('<b style="font-family:Space Grotesk">Lokasi Anda</b>');

  // Ambil lokasi user
  navigator.geolocation.getCurrentPosition(

    (position) => {

      const lat = position.coords.latitude;
      const lng = position.coords.longitude;

      console.log("Lokasi user:", lat, lng);

      // Marker lokasi user
      userMarker = L.circleMarker([lat, lng], {
        radius: 8,
        color: '#2563eb',
        fillColor: '#2563eb',
        fillOpacity: 0.9,
        weight: 3
      })
      .addTo(map)
      .bindPopup('<b style="font-family:Space Grotesk">Lokasi Anda</b>');

      // Center map ke user
      map.setView([lat, lng], 15);

    },

    (error) => {

      console.log("Gagal ambil lokasi:", error.message);

      alert("Izinkan akses lokasi untuk menggunakan fitur peta.");

    },

    {
      enableHighAccuracy: true,
      timeout: 10000,
      maximumAge: 0
    }
  );
}



function centerMap() {

  if (!navigator.geolocation) return;

  navigator.geolocation.getCurrentPosition((position) => {

    const lat = position.coords.latitude;
    const lng = position.coords.longitude;

    map.setView([lat, lng], 15);

  });
}


// Init map after DOM ready
document.addEventListener('DOMContentLoaded', () => {
  setTimeout(initMap, 100);
});

/* ═══════════════════════════════════════
   RECOMMENDED LOCATION CARDS
═══════════════════════════════════════ */
const emojis = ['🏬','🏢','🏪','🏬','🏤','🏥'];
const cardBgs = ['#dbeafe','#dcfce7','#fef3c7','#f3e8ff','#ffe4e6','#e0f2fe'];

const locScroll = document.getElementById('locScroll');
parkingLocations.forEach((loc, i) => {
  const slotBadge = loc.status === 'full'
    ? `<span style="color:var(--red);font-weight:600;font-size:11px">Penuh</span>`
    : loc.status === 'busy'
    ? `<span style="color:var(--amber);font-weight:600;font-size:11px">${loc.slots} slot</span>`
    : `<span style="color:var(--green);font-weight:600;font-size:11px">${loc.slots} slot</span>`;

  locScroll.innerHTML += `
    <a class="loc-card" href="/user/location/${loc.id}">
      <div class="loc-img-placeholder" style="background:${cardBgs[i%cardBgs.length]}">${emojis[i%emojis.length]}</div>
      <div class="loc-body">
        <div class="loc-name">${loc.name}</div>
        <div class="loc-addr">${loc.dist} · ${loc.addr}</div>
        <div class="loc-meta">
          <div class="loc-price">
            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/></svg>
            ${loc.price}
          </div>
          <div class="loc-rating">★ ${loc.rating}</div>
        </div>
        <div style="margin-top:8px;display:flex;align-items:center;justify-content:space-between">
          <span class="badge ${loc.status === 'avail' ? 'b-green' : loc.status === 'busy' ? 'b-amber' : 'b-red'}">● ${statusLabel[loc.status]}</span>
          ${slotBadge}
        </div>
      </div>
    </a>`;
});

/* ═══════════════════════════════════════
   ALL LOCATIONS GRID
═══════════════════════════════════════ */
const allLocGrid = document.getElementById('allLocGrid');
parkingLocations.forEach((loc, i) => {
  const statusCls = loc.status === 'avail' ? 'avail-text' : loc.status === 'busy' ? 'busy-text' : 'full-text';
  allLocGrid.innerHTML += `
    <a class="all-loc-card" href="/user/location/${loc.id}">
      <div class="alc-icon" style="background:${cardBgs[i%cardBgs.length]}">${emojis[i%emojis.length]}</div>
      <div style="min-width:0;flex:1">
        <div class="alc-name">${loc.name}</div>
        <div class="alc-meta">
          <span>${loc.price}</span>
          <span class="alc-dot"></span>
          <span class="${statusCls}">${statusLabel[loc.status]}</span>
          <span class="alc-dot"></span>
          <span>${loc.dist}</span>
        </div>
      </div>
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="var(--text-muted)" stroke-width="2" style="flex-shrink:0"><polyline points="9 18 15 12 9 6"/></svg>
    </a>`;
});

/* ═══════════════════════════════════════
   HISTORY LIST
═══════════════════════════════════════ */
const histData = [
  { name:'Mall Botani Square', slot:'B-07', dur:'2j 15m', price:'Rp 5.750', date:'Hari ini', type:'in' },
  { name:'Lippo Plaza Bogor', slot:'C-12', dur:'1j 30m', price:'Rp 4.500', date:'Kemarin', type:'out' },
  { name:'Ekalokasari Plaza', slot:'A-05', dur:'45m', price:'Rp 1.500', date:'25 Mei', type:'out' },
  { name:'Bogor Trade Mall', slot:'D-03', dur:'3j 00m', price:'Rp 4.500', date:'24 Mei', type:'out' },
];

const histColors = ['var(--blue-soft)','var(--green-soft)','var(--amber-soft)','var(--blue-soft)'];
const histIconColors = ['var(--blue-main)','var(--green)','var(--amber)','var(--blue-main)'];

const histList = document.getElementById('historyList');
histData.forEach((h, i) => {
  histList.innerHTML += `
    <div class="hist-item">
      <div class="hist-icon" style="background:${histColors[i%histColors.length]}">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="${histIconColors[i%histIconColors.length]}" stroke-width="2.5">
          <rect x="1" y="3" width="15" height="13" rx="2"/><circle cx="5.5" cy="18.5" r="2.5"/>
        </svg>
      </div>
      <div class="hist-body">
        <div class="hist-name">${h.name}</div>
        <div class="hist-sub">Slot ${h.slot} · ${h.dur}</div>
      </div>
      <div class="hist-right">
        <div class="hist-price">${h.price}</div>
        <div class="hist-date">${h.date}</div>
      </div>
    </div>`;
});
</script>
</body>
</html>