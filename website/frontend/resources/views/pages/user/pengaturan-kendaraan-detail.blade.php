{{--
    View  : pages.user.pengaturan-kendaraan-detail
    Route : user.kendaraan.show   GET  /kendaraan/{id}
    Route : user.kendaraan.update PUT  /kendaraan/{id}
    Route : user.kendaraan.destroy DELETE /kendaraan/{id}
    Data  : $kendaraan  (App\Models\Kendaraan)
            $totalParkir (int)
            $totalBayar  (int)
--}}
<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
<title>Parkify — {{ $kendaraan->merek }} {{ $kendaraan->model }}</title>
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
<style>
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
  --shadow-sm: 0 1px 4px rgba(15,30,54,0.07), 0 1px 2px rgba(15,30,54,0.04);
  --shadow-md: 0 4px 16px rgba(15,30,54,0.10), 0 2px 4px rgba(15,30,54,0.05);
  --bottom-nav-h: 72px;
  --max-content: 1100px;
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

/* TOP HEADER */
.top-header { background: var(--bg-surface); border-bottom: 1px solid var(--border); position: sticky; top: 0; z-index: 100; width: 100%; }
.top-header-inner { max-width: var(--max-content); margin: 0 auto; padding: 0 24px; height: 64px; display: flex; align-items: center; justify-content: space-between; gap: 16px; width: 100%; }
.header-logo { display: flex; align-items: center; gap: 9px; flex-shrink: 0; text-decoration: none; }
.logo-icon { width: 36px; height: 36px; background: var(--blue-main); border-radius: 10px; display: flex; align-items: center; justify-content: center; }
.logo-icon svg { color: #fff; }
.logo-text { font-family: 'Space Grotesk', sans-serif; font-size: 20px; font-weight: 800; color: var(--text-primary); letter-spacing: -0.5px; }
.logo-text span { color: var(--blue-main); }
.desktop-nav { display: flex; align-items: center; gap: 4px; }
.desktop-nav a { display: flex; align-items: center; gap: 6px; padding: 7px 14px; border-radius: 10px; font-size: 13px; font-weight: 500; color: var(--text-secondary); text-decoration: none; transition: all 0.16s; cursor: pointer; }
.desktop-nav a:hover { background: var(--bg-hover); color: var(--text-primary); }
.desktop-nav a.active { background: var(--blue-soft); color: var(--blue-main); font-weight: 600; border: 1px solid var(--blue-pale); }
.header-user { display: flex; align-items: center; gap: 10px; padding: 6px 12px 6px 6px; border-radius: 12px; background: var(--bg-input); border: 1px solid var(--border); cursor: pointer; transition: border-color 0.16s; flex-shrink: 0; }
.header-user:hover { border-color: var(--border-focus); }
.user-avatar { width: 32px; height: 32px; border-radius: 50%; background: linear-gradient(135deg, #f59e0b, #ef4444); display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 13px; color: #fff; font-family: 'Space Grotesk', sans-serif; flex-shrink: 0; }
.user-name-text { font-size: 13px; font-weight: 600; color: var(--text-primary); white-space: nowrap; }
.icon-btn { width: 36px; height: 36px; background: var(--bg-input); border: 1px solid var(--border); border-radius: 10px; display: flex; align-items: center; justify-content: center; cursor: pointer; color: var(--text-secondary); transition: all 0.15s; flex-shrink: 0; }
.icon-btn:hover { border-color: var(--border-focus); color: var(--text-primary); }

/* MAIN */
.main-wrap { width: 100%; padding-bottom: calc(var(--bottom-nav-h) + 24px + env(safe-area-inset-bottom)); }
.content-inner { max-width: 680px; margin: 0 auto; padding: 0 24px; width: 100%; }

/* PAGE TOP BAR */
.page-topbar { max-width: 680px; margin: 0 auto; padding: 24px 24px 0; display: flex; align-items: center; gap: 12px; }
.back-btn { width: 38px; height: 38px; background: var(--bg-surface); border: 1px solid var(--border); border-radius: 12px; display: flex; align-items: center; justify-content: center; cursor: pointer; color: var(--text-secondary); transition: border-color 0.15s, color 0.15s; box-shadow: var(--shadow-sm); flex-shrink: 0; text-decoration: none; }
.back-btn:hover { border-color: var(--border-focus); color: var(--text-primary); }
.page-topbar-title { font-family: 'Space Grotesk', sans-serif; font-size: 20px; font-weight: 800; color: var(--text-primary); flex: 1; letter-spacing: -0.3px; }

/* HERO */
.vehicle-hero { border-radius: 24px; margin-top: 20px; padding: 28px 24px 22px; display: flex; flex-direction: column; align-items: center; position: relative; overflow: hidden; border: 1.5px solid var(--border); box-shadow: var(--shadow-sm); transition: background 0.5s ease; }
.hero-bg-circle { position: absolute; top: -40px; right: -40px; width: 180px; height: 180px; border-radius: 50%; pointer-events: none; transition: background 0.5s ease; }
.hero-badge { position: absolute; top: 14px; display: inline-flex; align-items: center; gap: 5px; font-size: 11px; font-weight: 700; padding: 5px 12px; border-radius: 999px; font-family: 'Poppins', sans-serif; }
.hero-badge.left { left: 14px; background: var(--blue-soft); color: var(--blue-main); border: 1px solid var(--blue-pale); }
.hero-badge.right { right: 14px; }
.hero-badge.right.active { background: var(--green-soft); color: var(--green); border: 1px solid rgba(16,185,129,0.2); }
.hero-badge.right.inactive { background: var(--red-soft); color: var(--red); border: 1px solid rgba(239,68,68,0.2); }
.hero-badge.right.utama { background: var(--amber-soft); color: var(--amber); border: 1px solid rgba(245,158,11,0.2); }

.hero-car-wrap { width: 100%; max-width: 300px; height: 160px; margin: 8px 0 16px; display: flex; align-items: center; justify-content: center; animation: floatCar 3s ease-in-out infinite; position: relative; z-index: 1; }
@keyframes floatCar { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-7px); } }
#car-body { transition: fill 0.4s ease; }
#car-roof { transition: fill 0.4s ease; }
#car-shadow { transition: fill 0.4s ease; }
#motor-body { transition: fill 0.4s ease; }

.hero-vehicle-name { font-family: 'Space Grotesk', sans-serif; font-size: 26px; font-weight: 800; color: var(--text-primary); letter-spacing: -0.5px; text-align: center; transition: color 0.3s; position: relative; z-index: 1; }
.hero-vehicle-sub { font-size: 12.5px; color: var(--text-muted); margin-top: 3px; font-weight: 500; text-align: center; position: relative; z-index: 1; }
.hero-plate-chip { display: inline-flex; align-items: center; gap: 7px; margin-top: 12px; background: var(--bg-surface); border: 1.5px solid var(--border); border-radius: 10px; padding: 7px 16px; font-family: 'Space Grotesk', sans-serif; font-size: 15px; font-weight: 800; color: var(--text-primary); letter-spacing: 0.08em; box-shadow: var(--shadow-sm); position: relative; z-index: 1; transition: all 0.3s; }

/* STATS */
.stats-row { display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px; margin-top: 16px; }
.stat-card { background: var(--bg-card); border: 1.5px solid var(--border); border-radius: 16px; padding: 14px 12px; display: flex; flex-direction: column; align-items: center; gap: 4px; box-shadow: var(--shadow-sm); }
.stat-icon { width: 34px; height: 34px; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-bottom: 2px; }
.stat-icon.blue  { background: var(--blue-soft);  color: var(--blue-main); }
.stat-icon.green { background: var(--green-soft); color: var(--green); }
.stat-icon.amber { background: var(--amber-soft); color: var(--amber); }
.stat-label { font-size: 10.5px; color: var(--text-muted); font-weight: 500; text-align: center; }
.stat-value { font-family: 'Space Grotesk', sans-serif; font-size: 14px; font-weight: 800; color: var(--text-primary); text-align: center; }

/* SECTION LABEL */
.section-label { font-size: 11px; font-weight: 700; color: var(--text-muted); letter-spacing: 0.08em; text-transform: uppercase; margin: 24px 0 10px; display: flex; align-items: center; gap: 8px; }
.section-label-line { flex: 1; height: 1px; background: var(--border); }

/* ALERT */
.alert-error { background: var(--red-soft); border: 1.5px solid rgba(239,68,68,0.25); border-radius: 14px; padding: 12px 16px; display: flex; align-items: flex-start; gap: 10px; margin-bottom: 16px; margin-top: 16px; }
.alert-error-icon { color: var(--red); flex-shrink: 0; margin-top: 1px; }
.alert-error-text { font-size: 12px; color: #b91c1c; line-height: 1.6; }
.alert-error-text ul { padding-left: 16px; margin-top: 4px; }
.alert-error-text li { margin-bottom: 2px; }

/* FORM */
.form-group { display: flex; flex-direction: column; gap: 6px; margin-bottom: 12px; }
.form-label { font-size: 12px; font-weight: 600; color: var(--text-secondary); padding-left: 4px; display: flex; align-items: center; gap: 5px; }
.form-field { background: var(--bg-card); border: 1.5px solid var(--border); border-radius: 16px; padding: 14px 18px; font-family: 'Poppins', sans-serif; font-size: 14px; font-weight: 500; color: var(--text-primary); outline: none; width: 100%; transition: border-color 0.18s, box-shadow 0.18s; box-shadow: var(--shadow-sm); }
.form-field:focus { border-color: var(--blue-main); box-shadow: 0 0 0 3.5px rgba(37,99,235,0.10); }
.form-field::placeholder { color: var(--text-muted); font-weight: 400; }
.form-field.is-invalid { border-color: var(--red); box-shadow: 0 0 0 3px rgba(239,68,68,0.08); }
.field-error { font-size: 11px; color: var(--red); padding-left: 4px; margin-top: 2px; }
.form-select { background: var(--bg-card); border: 1.5px solid var(--border); border-radius: 16px; padding: 14px 44px 14px 18px; font-family: 'Poppins', sans-serif; font-size: 14px; font-weight: 500; color: var(--text-primary); outline: none; width: 100%; transition: border-color 0.18s; box-shadow: var(--shadow-sm); cursor: pointer; appearance: none; background-image: url("data:image/svg+xml,%3Csvg width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%2394a3b8' stroke-width='2' xmlns='http://www.w3.org/2000/svg'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 16px center; }
.form-select:focus { border-color: var(--blue-main); box-shadow: 0 0 0 3.5px rgba(37,99,235,0.10); }
.form-select.is-invalid { border-color: var(--red); }

/* JENIS SELECTOR */
.jenis-selector { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }
.jenis-option { background: var(--bg-card); border: 1.5px solid var(--border); border-radius: 16px; padding: 14px 16px; display: flex; align-items: center; gap: 12px; cursor: pointer; transition: all 0.2s; box-shadow: var(--shadow-sm); }
.jenis-option:hover { border-color: var(--blue-pale); background: var(--bg-hover); }
.jenis-option.selected { border-color: var(--blue-main); background: var(--blue-soft); }
.jenis-icon { width: 40px; height: 40px; border-radius: 12px; display: flex; align-items: center; justify-content: center; background: var(--bg-input); color: var(--text-muted); flex-shrink: 0; transition: all 0.2s; }
.jenis-option.selected .jenis-icon { background: var(--blue-pale); color: var(--blue-main); }
.jenis-text-wrap { flex: 1; min-width: 0; }
.jenis-title { font-size: 13px; font-weight: 700; color: var(--text-primary); }
.jenis-option.selected .jenis-title { color: var(--blue-main); }
.jenis-sub { font-size: 10.5px; color: var(--text-muted); margin-top: 1px; }
.jenis-check { width: 20px; height: 20px; border-radius: 50%; border: 2px solid var(--border); background: var(--bg-input); display: flex; align-items: center; justify-content: center; flex-shrink: 0; transition: all 0.2s; }
.jenis-option.selected .jenis-check { background: var(--blue-main); border-color: var(--blue-main); }
.jenis-check svg { display: none; }
.jenis-option.selected .jenis-check svg { display: block; }

/* COLOR PICKER */
.color-row { display: flex; gap: 8px; flex-wrap: wrap; padding: 4px 0 6px; }
.color-dot { width: 32px; height: 32px; border-radius: 50%; cursor: pointer; border: 2.5px solid transparent; transition: transform 0.18s, border-color 0.18s, box-shadow 0.18s; flex-shrink: 0; position: relative; }
.color-dot:hover { transform: scale(1.15); }
.color-dot.selected { border-color: var(--blue-main); transform: scale(1.18); box-shadow: 0 0 0 3px rgba(37,99,235,0.18); }
.color-dot.selected::after { content: ''; position: absolute; inset: 0; border-radius: 50%; background: rgba(255,255,255,0.28); }
.color-hint { font-size: 12px; color: var(--text-muted); margin-top: 6px; padding-left: 4px; }
.color-hint strong { color: var(--text-primary); }

/* CHECKBOX (kendaraan utama) */
.checkbox-card { background: var(--bg-card); border: 1.5px solid var(--border); border-radius: 16px; padding: 14px 18px; display: flex; align-items: center; gap: 14px; box-shadow: var(--shadow-sm); cursor: pointer; transition: border-color 0.2s, background 0.2s; margin-bottom: 12px; user-select: none; }
.checkbox-card:hover { border-color: var(--blue-pale); background: var(--bg-hover); }
.checkbox-card.checked { border-color: var(--blue-main); background: var(--blue-soft); }
.checkbox-box { width: 22px; height: 22px; border-radius: 7px; border: 2px solid var(--border); background: var(--bg-input); display: flex; align-items: center; justify-content: center; flex-shrink: 0; transition: all 0.2s; }
.checkbox-card.checked .checkbox-box { background: var(--blue-main); border-color: var(--blue-main); }
.checkbox-box svg { display: none; }
.checkbox-card.checked .checkbox-box svg { display: block; }
.checkbox-info { flex: 1; }
.checkbox-title { font-size: 14px; font-weight: 600; color: var(--text-primary); }
.checkbox-card.checked .checkbox-title { color: var(--blue-main); }
.checkbox-sub { font-size: 12px; color: var(--text-muted); margin-top: 2px; }
.star-badge { display: inline-flex; align-items: center; gap: 4px; background: var(--amber-soft); color: var(--amber); font-size: 10.5px; font-weight: 700; padding: 3px 10px; border-radius: 999px; border: 1px solid rgba(245,158,11,0.2); opacity: 0; transition: opacity 0.2s; }
.checkbox-card.checked .star-badge { opacity: 1; }

/* TOGGLE */
.toggle-row { background: var(--bg-card); border: 1.5px solid var(--border); border-radius: 16px; padding: 14px 18px; display: flex; align-items: center; justify-content: space-between; box-shadow: var(--shadow-sm); margin-bottom: 12px; }
.toggle-title { font-size: 14px; font-weight: 600; color: var(--text-primary); }
.toggle-sub { font-size: 12px; color: var(--text-muted); margin-top: 2px; }
.toggle-switch { width: 46px; height: 26px; background: var(--green); border-radius: 999px; position: relative; cursor: pointer; transition: background 0.2s; flex-shrink: 0; }
.toggle-switch.off { background: var(--border); }
.toggle-switch::after { content: ''; position: absolute; width: 20px; height: 20px; background: #fff; border-radius: 50%; top: 3px; left: 23px; transition: left 0.2s; box-shadow: 0 1px 4px rgba(0,0,0,0.18); }
.toggle-switch.off::after { left: 3px; }

/* ACTION BUTTONS */
.action-row { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-top: 4px; }
.action-btn-sec { display: flex; align-items: center; justify-content: center; gap: 7px; background: var(--bg-card); border: 1.5px solid var(--border); border-radius: 16px; padding: 14px; font-size: 13px; font-weight: 600; font-family: 'Poppins', sans-serif; color: var(--text-secondary); cursor: pointer; transition: all 0.16s; box-shadow: var(--shadow-sm); text-decoration: none; }
.action-btn-sec:hover { border-color: var(--border-focus); color: var(--text-primary); background: var(--bg-hover); }
.action-btn-danger { display: flex; align-items: center; justify-content: center; gap: 7px; background: var(--red-soft); border: 1.5px solid rgba(239,68,68,0.2); border-radius: 16px; padding: 14px; font-size: 13px; font-weight: 600; font-family: 'Poppins', sans-serif; color: var(--red); cursor: pointer; transition: all 0.16s; }
.action-btn-danger:hover { background: #fee2e2; border-color: var(--red); }

/* SAVE BUTTON */
.save-btn { width: 100%; display: flex; align-items: center; justify-content: center; gap: 10px; background: var(--blue-main); color: #fff; border: none; border-radius: 18px; padding: 17px 24px; font-size: 15px; font-weight: 700; font-family: 'Poppins', sans-serif; cursor: pointer; transition: background 0.16s, transform 0.15s; box-shadow: 0 4px 16px rgba(37,99,235,0.30); margin-top: 20px; letter-spacing: 0.01em; }
.save-btn:hover { background: var(--blue-bright); transform: translateY(-2px); box-shadow: 0 6px 20px rgba(37,99,235,0.35); }
.save-btn:active { transform: scale(0.98); }

/* DELETE MODAL */
.modal-backdrop { position: fixed; inset: 0; background: rgba(15,30,54,0.5); z-index: 9998; display: none; align-items: center; justify-content: center; padding: 24px; backdrop-filter: blur(4px); }
.modal-backdrop.open { display: flex; }
.modal-box { background: var(--bg-surface); border-radius: 24px; padding: 28px 24px; max-width: 400px; width: 100%; box-shadow: 0 24px 64px rgba(15,30,54,0.25); animation: modalIn 0.25s ease; }
@keyframes modalIn { from { opacity:0; transform:translateY(16px) scale(0.97); } to { opacity:1; transform:translateY(0) scale(1); } }
.modal-icon { width: 52px; height: 52px; background: var(--red-soft); border-radius: 16px; display: flex; align-items: center; justify-content: center; color: var(--red); margin-bottom: 16px; }
.modal-title { font-family: 'Space Grotesk', sans-serif; font-size: 18px; font-weight: 800; color: var(--text-primary); margin-bottom: 6px; }
.modal-desc { font-size: 13px; color: var(--text-secondary); line-height: 1.6; margin-bottom: 20px; }
.modal-actions { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }
.modal-cancel { background: var(--bg-input); border: 1.5px solid var(--border); border-radius: 14px; padding: 13px; font-size: 14px; font-weight: 600; font-family: 'Poppins', sans-serif; color: var(--text-secondary); cursor: pointer; transition: all 0.15s; }
.modal-cancel:hover { border-color: var(--border-focus); color: var(--text-primary); }
.modal-confirm-delete { background: var(--red); border: none; border-radius: 14px; padding: 13px; font-size: 14px; font-weight: 700; font-family: 'Poppins', sans-serif; color: #fff; cursor: pointer; transition: background 0.15s; }
.modal-confirm-delete:hover { background: #dc2626; }

/* TOAST */
.toast { position: fixed; bottom: 100px; left: 50%; transform: translateX(-50%) translateY(20px); background: #0f1e36; color: #fff; padding: 11px 20px; border-radius: 14px; font-size: 13px; font-weight: 500; font-family: 'Poppins', sans-serif; opacity: 0; transition: all 0.3s; pointer-events: none; white-space: nowrap; z-index: 9999; box-shadow: 0 8px 24px rgba(0,0,0,0.25); display: flex; align-items: center; gap: 8px; }
.toast.show { opacity: 1; transform: translateX(-50%) translateY(0); }

/* BOTTOM NAV */
.bottom-nav { position: fixed; bottom: 0; left: 0; right: 0; width: 100%; z-index: 9999; display: flex; align-items: flex-end; justify-content: center; background: transparent; pointer-events: none; padding-bottom: calc(12px + env(safe-area-inset-bottom)); }
.bottom-nav-inner { display: flex; align-items: center; background: var(--bg-surface); border: 1px solid var(--border); border-radius: 999px; box-shadow: 0 4px 24px rgba(15,30,54,0.13), 0 1px 4px rgba(15,30,54,0.06); padding: 6px 8px; gap: 6px; pointer-events: all; width: auto; max-width: calc(100vw - 32px); }
.bn-item { display: flex; flex-direction: row; align-items: center; justify-content: center; gap: 7px; padding: 10px 12px; border-radius: 999px; cursor: pointer; color: var(--text-secondary); font-size: 13px; font-weight: 600; font-family: 'Poppins', sans-serif; transition: all 0.22s cubic-bezier(0.34, 1.56, 0.64, 1); -webkit-tap-highlight-color: transparent; white-space: nowrap; background: transparent; text-decoration: none; }
.bn-item:not(.active) { background: #f3f4f6; border-radius: 50%; width: 46px; height: 46px; padding: 0; }
.bn-item:not(.active) span { display: none; }
.bn-item svg { width: 22px; height: 22px; flex-shrink: 0; }
.bn-item.active { background: var(--blue-main); color: #fff; padding: 12px 20px; border-radius: 999px; width: auto; height: auto; }
.bn-item.active span { display: inline; color: #fff; }
.bn-item:not(.active):hover { background: #e9eaf0; border-radius: 50%; }

@media (min-width: 860px) { .bottom-nav { display: none; } .main-wrap { padding-bottom: 48px; } }
@media (max-width: 859px) { .desktop-nav { display: none; } .header-user .user-name-text { display: none; } .top-header-inner { padding: 0 16px; } .page-topbar { padding: 20px 16px 0; } .content-inner { padding: 0 16px; } }
@media (max-width: 420px) { .hero-vehicle-name { font-size: 22px; } .stats-row { gap: 8px; } .stat-card { padding: 12px 8px; } .stat-value { font-size: 12px; } .stat-label { font-size: 10px; } .action-row { grid-template-columns: 1fr; } .jenis-title { font-size: 12px; } .jenis-sub { display: none; } }
</style>
</head>
<body>

<!-- TOP HEADER -->
<header class="top-header">
  <div class="top-header-inner">
    <a class="header-logo" href="{{ route('home') }}">
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
      <a href="{{ route('home') }}">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
        Home
      </a>
      <a class="active" href="{{ route('user.kendaraan') }}">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="3" width="15" height="13" rx="2"/><path d="M16 8h4a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2h-4"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
        Kendaraan
      </a>
      <a href="#">
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
        <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 2)) }}</div>
        <span class="user-name-text">{{ Auth::user()->name }}</span>
      </div>
    </div>
  </div>
</header>

<!-- MAIN -->
<main class="main-wrap">
  <div class="page-topbar">
    <a class="back-btn" href="{{ route('user.kendaraan') }}" title="Kembali">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"/></svg>
    </a>
    <div class="page-topbar-title">Detail Kendaraan</div>
    <div class="icon-btn" title="Opsi">
      <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="5" r="1"/><circle cx="12" cy="12" r="1"/><circle cx="12" cy="19" r="1"/></svg>
    </div>
  </div>

  <div class="content-inner">

    {{-- ── LARAVEL VALIDATION ERRORS ── --}}
    @if ($errors->any())
    <div class="alert-error">
      <div class="alert-error-icon">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
      </div>
      <div class="alert-error-text">
        <strong>Terdapat kesalahan pada data yang dimasukkan:</strong>
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    </div>
    @endif

    {{-- ── HERO PREVIEW ── --}}
    <div class="vehicle-hero" id="vehicleHero">
      <div class="hero-bg-circle" id="heroBgCircle"></div>

      <div class="hero-badge left">
        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="1" y="3" width="15" height="13" rx="2"/><path d="M16 8h4a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2h-4"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
        {{ ucfirst($kendaraan->jenis) }}
      </div>

      {{-- Badge kanan: utama > aktif/nonaktif --}}
      @if($kendaraan->utama)
        <div class="hero-badge right utama">
          <svg width="9" height="9" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
          Utama
        </div>
      @else
        <div class="hero-badge right active" id="heroBadgeStatus">
          <span style="width:7px;height:7px;background:var(--green);border-radius:50%;display:inline-block"></span>
          Aktif
        </div>
      @endif

      {{-- CAR/MOTOR SVG --}}
      <div class="hero-car-wrap" id="heroCarWrap">
        {{-- Mobil SVG --}}
        <svg id="carSvgMobil" width="280" height="140" viewBox="0 0 300 150" fill="none" xmlns="http://www.w3.org/2000/svg"
             style="{{ $kendaraan->jenis === 'motor' ? 'display:none' : '' }}">
          <ellipse id="car-shadow" cx="150" cy="130" rx="120" ry="10" fill="rgba(37,99,235,0.08)"/>
          <path id="car-body" d="M30 95 L30 78 Q30 68 42 65 L72 45 Q85 36 110 34 L190 34 Q215 34 228 45 L258 65 Q270 68 270 78 L270 95 Q270 102 263 102 L37 102 Q30 102 30 95Z" fill="#e8ecf2" stroke="#c8d4e8" stroke-width="1.5"/>
          <path id="car-roof" d="M72 45 Q85 30 112 28 L190 28 Q218 28 228 45Z" fill="#f0f4fa" stroke="#c8d4e8" stroke-width="1.5"/>
          <path d="M176 45 L176 30 L192 30 Q214 30 225 45Z" fill="#bfdbfe" stroke="#93c5fd" stroke-width="1" opacity="0.85"/>
          <path d="M75 45 L88 29 L172 29 L172 45Z" fill="#bfdbfe" stroke="#93c5fd" stroke-width="1" opacity="0.85"/>
          <line x1="172" y1="28" x2="174" y2="102" stroke="#c8d4e8" stroke-width="1.5"/>
          <circle cx="82"  cy="103" r="22" fill="#475569" stroke="#334155" stroke-width="2"/>
          <circle cx="82"  cy="103" r="13" fill="#64748b"/><circle cx="82"  cy="103" r="6"  fill="#94a3b8"/><circle cx="82"  cy="103" r="3"  fill="#cbd5e1"/>
          <circle cx="218" cy="103" r="22" fill="#475569" stroke="#334155" stroke-width="2"/>
          <circle cx="218" cy="103" r="13" fill="#64748b"/><circle cx="218" cy="103" r="6"  fill="#94a3b8"/><circle cx="218" cy="103" r="3"  fill="#cbd5e1"/>
          <ellipse cx="265" cy="80" rx="7"  ry="5"   fill="#fef9c3" stroke="#fde047" stroke-width="1.5" opacity="0.9"/>
          <ellipse cx="265" cy="80" rx="4"  ry="3"   fill="#fef08a" opacity="0.7"/>
          <ellipse cx="35"  cy="80" rx="6"  ry="4.5" fill="#fca5a5" stroke="#ef4444" stroke-width="1.5" opacity="0.85"/>
          <rect x="253" y="86" width="14" height="3" rx="1.5" fill="#94a3b8" opacity="0.7"/>
          <rect x="253" y="91" width="14" height="2" rx="1"   fill="#94a3b8" opacity="0.5"/>
          <rect x="115" y="70" width="14"  height="4" rx="2" fill="#94a3b8"/>
          <rect x="178" y="70" width="14"  height="4" rx="2" fill="#94a3b8"/>
          <path d="M42 90 L258 90" stroke="#c8d4e8" stroke-width="1" opacity="0.5"/>
        </svg>

        {{-- Motor SVG --}}
        <svg id="carSvgMotor" width="240" height="140" viewBox="0 0 280 150" fill="none" xmlns="http://www.w3.org/2000/svg"
             style="{{ $kendaraan->jenis === 'mobil' ? 'display:none' : '' }}">
          <ellipse cx="140" cy="136" rx="110" ry="9" fill="rgba(37,99,235,0.08)"/>
          <circle cx="68"  cy="110" r="32" fill="#475569" stroke="#334155" stroke-width="2.5"/>
          <circle cx="68"  cy="110" r="20" fill="#64748b"/><circle cx="68"  cy="110" r="10" fill="#94a3b8"/><circle cx="68"  cy="110" r="5"  fill="#cbd5e1"/>
          <circle cx="212" cy="110" r="32" fill="#475569" stroke="#334155" stroke-width="2.5"/>
          <circle cx="212" cy="110" r="20" fill="#64748b"/><circle cx="212" cy="110" r="10" fill="#94a3b8"/><circle cx="212" cy="110" r="5"  fill="#cbd5e1"/>
          <path id="motor-body" d="M68 80 L100 50 L160 50 L220 78 L212 80 L160 68 L100 68 Z" fill="#e8ecf2" stroke="#c8d4e8" stroke-width="1.5"/>
          <path d="M100 50 L106 38 L170 38 L160 50 Z" fill="#94a3b8" stroke="#64748b" stroke-width="1.5"/>
          <path d="M185 54 L220 78 L220 90 L200 90 L185 68 Z" fill="#cbd5e1" stroke="#94a3b8" stroke-width="1.2"/>
          <rect x="198" y="50" width="26" height="5" rx="2.5" fill="#64748b"/>
          <ellipse cx="224" cy="66" rx="7" ry="5" fill="#fef9c3" stroke="#fde047" stroke-width="1.5" opacity="0.9"/>
          <ellipse cx="60"  cy="80" rx="5" ry="4" fill="#fca5a5" stroke="#ef4444" stroke-width="1.5" opacity="0.85"/>
          <path d="M75 100 L55 105 L50 108" stroke="#94a3b8" stroke-width="3" stroke-linecap="round"/>
          <rect x="105" y="68" width="55" height="32" rx="8" fill="#94a3b8" stroke="#64748b" stroke-width="1.2"/>
          <rect x="112" y="75" width="40" height="18" rx="5" fill="#b2bfcf"/>
        </svg>
      </div>

      <div class="hero-vehicle-name" id="heroName">{{ $kendaraan->merek }} {{ $kendaraan->model }}</div>
      <div class="hero-vehicle-sub">{{ ucfirst($kendaraan->jenis) }} &bull; {{ $kendaraan->warna ?? 'Warna tidak diatur' }}</div>
      <div class="hero-plate-chip" id="heroPlate">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 3h-8v4h8z"/></svg>
        <span id="heroPlateText">{{ $kendaraan->plat_nomor }}</span>
      </div>
    </div>

    {{-- ── STATS ── --}}
    <div class="stats-row">
      <div class="stat-card">
        <div class="stat-icon blue">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
        </div>
        <div class="stat-value">{{ $kendaraan->created_at->format('Y') }}</div>
        <div class="stat-label">Terdaftar</div>
      </div>
      <div class="stat-card">
        <div class="stat-icon green">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
        </div>
        <div class="stat-value">{{ $totalParkir }}×</div>
        <div class="stat-label">Total Parkir</div>
      </div>
      <div class="stat-card">
        <div class="stat-icon amber">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
        </div>
        <div class="stat-value">
          @if($totalBayar >= 1000000)
            Rp {{ number_format($totalBayar/1000000, 1) }}Jt
          @elseif($totalBayar >= 1000)
            Rp {{ number_format($totalBayar/1000, 0) }}K
          @else
            Rp {{ number_format($totalBayar) }}
          @endif
        </div>
        <div class="stat-label">Total Bayar</div>
      </div>
    </div>

    {{-- ════════════════════════════════
         FORM UPDATE — PUT ke user.kendaraan.update
    ════════════════════════════════ --}}
    <form action="{{ route('user.kendaraan.update', $kendaraan->id) }}" method="POST" id="formKendaraan">
      @csrf
      @method('PUT')

      {{-- Hidden inputs diisi JS --}}
      <input type="hidden" name="jenis"  id="inputJenis" value="{{ old('jenis',  $kendaraan->jenis) }}">
      <input type="hidden" name="warna"  id="inputWarna" value="{{ old('warna',  $kendaraan->warna ?? 'Putih') }}">
      <input type="hidden" name="utama"  id="inputUtama" value="{{ old('utama',  $kendaraan->utama ? '1' : '0') }}">

      {{-- ════ JENIS ════ --}}
      <div class="section-label">
        Jenis Kendaraan
        <div class="section-label-line"></div>
      </div>

      <div class="jenis-selector">
        <div class="jenis-option {{ old('jenis', $kendaraan->jenis) === 'mobil' ? 'selected' : '' }}"
             id="jenisOptionMobil" onclick="selectJenis('mobil')">
          <div class="jenis-icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="3" width="15" height="13" rx="2"/><path d="M16 8h4a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2h-4"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
          </div>
          <div class="jenis-text-wrap">
            <div class="jenis-title">Mobil</div>
            <div class="jenis-sub">Sedan, SUV, MPV, dll</div>
          </div>
          <div class="jenis-check">
            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
          </div>
        </div>
        <div class="jenis-option {{ old('jenis', $kendaraan->jenis) === 'motor' ? 'selected' : '' }}"
             id="jenisOptionMotor" onclick="selectJenis('motor')">
          <div class="jenis-icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 17H3a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v5"/><circle cx="16" cy="17" r="3"/><circle cx="8" cy="17" r="3"/></svg>
          </div>
          <div class="jenis-text-wrap">
            <div class="jenis-title">Motor</div>
            <div class="jenis-sub">Matic, sport, bebek</div>
          </div>
          <div class="jenis-check">
            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
          </div>
        </div>
      </div>

      {{-- ════ IDENTITAS ════ --}}
      <div class="section-label" style="margin-top:24px">
        Informasi Kendaraan
        <div class="section-label-line"></div>
      </div>

      {{-- Merek --}}
      <div class="form-group">
        <div class="form-label">Merek <span style="color:var(--red);font-size:11px">*</span></div>
        <select class="form-select {{ $errors->has('merek') ? 'is-invalid' : '' }}"
                id="merekKendaraan" name="merek" onchange="onMerekChange()">
          <option value="">-- Pilih Merek --</option>
          <optgroup label="Mobil" id="groupMobil">
            @foreach(['BMW','Toyota','Honda','Suzuki','Mitsubishi','Daihatsu','Mercedes-Benz','Audi','Hyundai','Kia','Wuling','MG'] as $b)
              <option value="{{ $b }}" {{ old('merek', $kendaraan->merek) === $b ? 'selected' : '' }}>{{ $b }}</option>
            @endforeach
          </optgroup>
          <optgroup label="Motor" id="groupMotor">
            @foreach(['Yamaha','Kawasaki','Vespa'] as $b)
              <option value="{{ $b }}" {{ old('merek', $kendaraan->merek) === $b ? 'selected' : '' }}>{{ $b }}</option>
            @endforeach
          </optgroup>
          <option value="Lainnya" {{ old('merek', $kendaraan->merek) === 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
        </select>
        @error('merek')<div class="field-error">{{ $message }}</div>@enderror
      </div>

      {{-- Model --}}
      <div class="form-group">
        <div class="form-label">Model / Varian <span style="color:var(--red);font-size:11px">*</span></div>
        <input class="form-field {{ $errors->has('model') ? 'is-invalid' : '' }}"
               type="text" id="modelKendaraan" name="model"
               placeholder="Contoh: Avanza G, NMAX 155..."
               value="{{ old('model', $kendaraan->model) }}"
               list="modelSuggestions"
               autocomplete="off"
               oninput="onModelChange()" />
        <datalist id="modelSuggestions"></datalist>
        @error('model')<div class="field-error">{{ $message }}</div>@enderror
      </div>

      {{-- Plat Nomor --}}
      <div class="form-group">
        <div class="form-label">Plat Nomor <span style="color:var(--red);font-size:11px">*</span></div>
        <input class="form-field {{ $errors->has('plat_nomor') ? 'is-invalid' : '' }}"
               type="text" id="platNomor" name="plat_nomor"
               placeholder="Contoh: B 1234 AB"
               value="{{ old('plat_nomor', $kendaraan->plat_nomor) }}"
               style="font-family:'Space Grotesk',sans-serif;font-weight:700;letter-spacing:0.08em;text-transform:uppercase"
               oninput="onPlatInput(this)" maxlength="12" />
        @error('plat_nomor')<div class="field-error">{{ $message }}</div>@enderror
      </div>

      {{-- ════ WARNA ════ --}}
      <div class="section-label" style="margin-top:24px">
        Detail Kendaraan
        <div class="section-label-line"></div>
      </div>

      <div class="form-group">
        <div class="form-label">Warna Kendaraan <span style="font-size:10px;color:var(--text-muted);font-weight:500;background:var(--bg-input);padding:1px 7px;border-radius:999px;">Opsional</span></div>
        <div class="color-row" id="colorPicker"></div>
        <div class="color-hint">Warna dipilih: <strong id="colorName">{{ $kendaraan->warna ?? 'Putih' }}</strong></div>
      </div>

      {{-- ════ PREFERENSI ════ --}}
      <div class="section-label" style="margin-top:24px">
        Preferensi
        <div class="section-label-line"></div>
      </div>

      <div class="checkbox-card {{ old('utama', $kendaraan->utama) ? 'checked' : '' }}"
           id="checkboxCard" onclick="toggleCheckbox()">
        <div class="checkbox-box" id="checkboxBox">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
        </div>
        <div class="checkbox-info">
          <div class="checkbox-title">Jadikan Kendaraan Utama</div>
          <div class="checkbox-sub">Kendaraan ini digunakan sebagai default saat parkir</div>
        </div>
        <div class="star-badge">
          <svg width="10" height="10" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
          Utama
        </div>
      </div>

      {{-- ════ ACTIONS ════ --}}
      <div class="section-label" style="margin-top:24px">
        Tindakan
        <div class="section-label-line"></div>
      </div>

      <div class="action-row">
        <button type="button" class="action-btn-sec" onclick="handleShare()">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><line x1="8.59" y1="13.51" x2="15.42" y2="17.49"/><line x1="15.41" y1="6.51" x2="8.59" y2="10.49"/></svg>
          Bagikan
        </button>
        <button type="button" class="action-btn-danger" onclick="openDeleteModal()">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
          Hapus Kendaraan
        </button>
      </div>

      <button type="submit" class="save-btn" id="saveBtn">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
        Simpan Perubahan
      </button>
    </form>

  </div>
</main>

{{-- ── DELETE MODAL ── --}}
<div class="modal-backdrop" id="deleteModal">
  <div class="modal-box">
    <div class="modal-icon">
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
    </div>
    <div class="modal-title">Hapus Kendaraan?</div>
    <div class="modal-desc">
      Kendaraan <strong>{{ $kendaraan->merek }} {{ $kendaraan->model }}</strong>
      dengan plat <strong>{{ $kendaraan->plat_nomor }}</strong> akan dihapus permanen.
      Riwayat parkir yang terkait tetap tersimpan.
    </div>
    <div class="modal-actions">
      <button class="modal-cancel" onclick="closeDeleteModal()">Batal</button>
      <button class="modal-confirm-delete" onclick="submitDelete()">Ya, Hapus</button>
    </div>
  </div>
</div>

{{-- Hidden form DELETE --}}
<form id="formDelete" action="{{ route('user.kendaraan.destroy', $kendaraan->id) }}" method="POST" style="display:none">
  @csrf
  @method('DELETE')
</form>

<!-- BOTTOM NAV -->
<nav class="bottom-nav">
  <div class="bottom-nav-inner">
    <a class="bn-item" href="{{ route('home') }}">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
      <span>Home</span>
    </a>
    <a class="bn-item active" href="{{ route('user.kendaraan') }}">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="3" width="15" height="13" rx="2"/><path d="M16 8h4a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2h-4"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
      <span>Kendaraan</span>
    </a>
    <a class="bn-item" href="#">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
      <span>Riwayat</span>
    </a>
    <a class="bn-item" href="#">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.07 4.93l-1.41 1.41M4.93 4.93l1.41 1.41M12 2v2m0 16v2m7.07 1.07l-1.41-1.41M4.93 19.07l1.41-1.41M22 12h-2M4 12H2"/></svg>
      <span>Pengaturan</span>
    </a>
  </div>
</nav>

<!-- TOAST -->
<div class="toast" id="toast">
  <span id="toastIcon"></span>
  <span id="toastMsg"></span>
</div>

<script>
/* ═══════════════════════════════════════
   DATA
═══════════════════════════════════════ */
const modelsByBrand = {
  'BMW':          ['M4 CS/CSL','M3 Competition','X5 xDrive40i','320i Sport','118i','Z4 sDrive30i','X3 xDrive30i','iX3'],
  'Toyota':       ['Avanza G','Avanza Veloz','Innova Reborn','Fortuner VRZ','Camry Hybrid','Yaris GR Sport','Hilux','Rush','Raize'],
  'Honda':        ['Jazz RS','Brio Satya','Brio RS','HR-V Turbo','CR-V Prestige','Civic RS','WR-V','BR-V','City Hatchback'],
  'Suzuki':       ['Ertiga GX','Ertiga Hybrid','Baleno','XL7 Alpha','Ignis GX','S-Presso','Carry Pick Up','Address 125'],
  'Mitsubishi':   ['Xpander','Xpander Cross','Pajero Sport','Outlander PHEV','Eclipse Cross','L300'],
  'Daihatsu':     ['Sigra R','Ayla X','Ayla R','Terios R','Gran Max','Rocky'],
  'Yamaha':       ['NMAX 155','Aerox 155','R15','MT-15','Lexi','Mio M3','XMAX 250','Freego'],
  'Kawasaki':     ['Ninja 250','Ninja ZX-25R','Z250','KLX 230','Versys 650','W175','Z650'],
  'Mercedes-Benz':['C 300 AMG','E 300','GLC 300','A 200','CLA 200','GLE 450'],
  'Audi':         ['A4 Quattro','Q5 TFSI','Q3 S Line','A6 Progressive','TT Roadster','e-tron'],
  'Hyundai':      ['Creta Prime','Ioniq 5','Ioniq 6','Stargazer','Palisade','Tucson'],
  'Kia':          ['Sportage','Sonet','EV6','Carnival','Seltos','Picanto'],
  'Wuling':       ['Almaz RS','Air EV','Confero S','Cortez CT'],
  'MG':           ['MG 5','ZS EV','RX5','VS HEV','MG4 EV'],
  'Vespa':        ['GTS 300','Sprint 150','Primavera 150','946','Elettrica'],
  'Lainnya':      ['Lainnya / Tidak ada dalam daftar'],
};

const motorBrands = ['Yamaha','Kawasaki','Vespa','Honda','Suzuki','Lainnya'];
const mobilBrands = ['BMW','Toyota','Honda','Suzuki','Mitsubishi','Daihatsu','Mercedes-Benz','Audi','Hyundai','Kia','Wuling','MG','Lainnya'];

const colors = [
  { name:'Putih',   hex:'#f8fafc', bodyFill:'#e8ecf2', roofFill:'#f0f4fa', heroBg:'linear-gradient(160deg,#e8f0fc 0%,#d4e4f7 100%)', circleBg:'rgba(37,99,235,0.06)',  stroke:'#c8d4e8' },
  { name:'Hitam',   hex:'#1e293b', bodyFill:'#1e293b', roofFill:'#0f172a', heroBg:'linear-gradient(160deg,#1e293b 0%,#0f172a 100%)', circleBg:'rgba(255,255,255,0.06)',stroke:'#334155' },
  { name:'Silver',  hex:'#94a3b8', bodyFill:'#94a3b8', roofFill:'#b2bfcf', heroBg:'linear-gradient(160deg,#e2e8f0 0%,#cbd5e1 100%)', circleBg:'rgba(148,163,184,0.12)',stroke:'#64748b' },
  { name:'Merah',   hex:'#ef4444', bodyFill:'#ef4444', roofFill:'#dc2626', heroBg:'linear-gradient(160deg,#fee2e2 0%,#fecaca 100%)', circleBg:'rgba(239,68,68,0.08)',  stroke:'#dc2626' },
  { name:'Biru',    hex:'#3b82f6', bodyFill:'#3b82f6', roofFill:'#2563eb', heroBg:'linear-gradient(160deg,#dbeafe 0%,#bfdbfe 100%)', circleBg:'rgba(59,130,246,0.1)',  stroke:'#2563eb' },
  { name:'Kuning',  hex:'#f59e0b', bodyFill:'#f59e0b', roofFill:'#d97706', heroBg:'linear-gradient(160deg,#fef3c7 0%,#fde68a 100%)', circleBg:'rgba(245,158,11,0.1)',  stroke:'#d97706' },
  { name:'Hijau',   hex:'#10b981', bodyFill:'#10b981', roofFill:'#059669', heroBg:'linear-gradient(160deg,#d1fae5 0%,#a7f3d0 100%)', circleBg:'rgba(16,185,129,0.1)',  stroke:'#059669' },
  { name:'Abu-abu', hex:'#64748b', bodyFill:'#64748b', roofFill:'#475569', heroBg:'linear-gradient(160deg,#f1f5f9 0%,#e2e8f0 100%)', circleBg:'rgba(100,116,139,0.1)', stroke:'#475569' },
  { name:'Oranye',  hex:'#f97316', bodyFill:'#f97316', roofFill:'#ea580c', heroBg:'linear-gradient(160deg,#ffedd5 0%,#fed7aa 100%)', circleBg:'rgba(249,115,22,0.1)',  stroke:'#ea580c' },
  { name:'Ungu',    hex:'#8b5cf6', bodyFill:'#8b5cf6', roofFill:'#7c3aed', heroBg:'linear-gradient(160deg,#ede9fe 0%,#ddd6fe 100%)', circleBg:'rgba(139,92,246,0.1)',  stroke:'#7c3aed' },
];

/* ═══════════════════════════════════════
   STATE — diinisialisasi dari nilai DB via PHP
═══════════════════════════════════════ */
let selectedJenis = '{{ old('jenis', $kendaraan->jenis) }}';
let isUtama       = {{ old('utama', $kendaraan->utama) ? 'true' : 'false' }};
let selectedColorIndex = 0;

/* ═══════════════════════════════════════
   JENIS
═══════════════════════════════════════ */
function selectJenis(jenis) {
  selectedJenis = jenis;
  document.getElementById('inputJenis').value = jenis;
  document.getElementById('jenisOptionMobil').classList.toggle('selected', jenis === 'mobil');
  document.getElementById('jenisOptionMotor').classList.toggle('selected', jenis === 'motor');
  document.getElementById('carSvgMobil').style.display = jenis === 'mobil' ? '' : 'none';
  document.getElementById('carSvgMotor').style.display = jenis === 'motor' ? '' : 'none';
  applyColorToSvg(colors[selectedColorIndex]);
  filterMerekByJenis(jenis);
}

function filterMerekByJenis(jenis) {
  document.getElementById('groupMobil').hidden = (jenis === 'motor');
  document.getElementById('groupMotor').hidden = (jenis === 'mobil');
  const allowed = jenis === 'motor' ? motorBrands : mobilBrands;
  const sel = document.getElementById('merekKendaraan');
  if (sel.value && !allowed.includes(sel.value)) {
    sel.value = '';
    updateHeroName();
  }
}

/* ═══════════════════════════════════════
   MEREK & MODEL
═══════════════════════════════════════ */
function onMerekChange() {
  updateModelSuggestions(document.getElementById('merekKendaraan').value);
  updateHeroName();
}

function updateModelSuggestions(merek) {
  const dl = document.getElementById('modelSuggestions');
  dl.innerHTML = '';
  (modelsByBrand[merek] || []).forEach(m => {
    const opt = document.createElement('option');
    opt.value = m;
    dl.appendChild(opt);
  });
}

function onModelChange() { updateHeroName(); }

function updateHeroName() {
  const merek = document.getElementById('merekKendaraan').value;
  const model = document.getElementById('modelKendaraan').value.trim();
  document.getElementById('heroName').textContent = merek && model ? merek + ' ' + model : merek || 'Nama Kendaraan';
}

/* ═══════════════════════════════════════
   PLAT
═══════════════════════════════════════ */
function onPlatInput(input) {
  const pos = input.selectionStart;
  input.value = input.value.toUpperCase();
  input.setSelectionRange(pos, pos);
  const val = input.value.trim();
  document.getElementById('heroPlateText').textContent = val || '— — —';
}

/* ═══════════════════════════════════════
   COLOR PICKER
═══════════════════════════════════════ */
function buildColorPicker() {
  const savedWarna = document.getElementById('inputWarna').value;
  const picker = document.getElementById('colorPicker');
  picker.innerHTML = '';
  let matchIdx = 0;
  colors.forEach((c, i) => {
    const dot = document.createElement('div');
    dot.className = 'color-dot';
    dot.style.background = c.hex;
    if (c.name === 'Putih') dot.style.border = '2.5px solid #cbd5e1';
    dot.title = c.name;
    dot.addEventListener('click', () => selectColor(i));
    picker.appendChild(dot);
    if (c.name === savedWarna) matchIdx = i;
  });
  selectColor(matchIdx);
}

function selectColor(index) {
  selectedColorIndex = index;
  const c = colors[index];
  document.getElementById('inputWarna').value = c.name;
  document.querySelectorAll('.color-dot').forEach((d, i) => d.classList.toggle('selected', i === index));
  document.getElementById('colorName').textContent = c.name;
  document.getElementById('vehicleHero').style.background = c.heroBg;
  document.getElementById('heroBgCircle').style.background = c.circleBg;
  applyColorToSvg(c);
  if (c.name === 'Hitam') {
    document.getElementById('heroName').style.color = '#f1f5f9';
    document.querySelector('.hero-vehicle-sub').style.color = '#94a3b8';
    document.getElementById('heroPlate').style.background = '#1e293b';
    document.getElementById('heroPlate').style.borderColor = '#334155';
    document.getElementById('heroPlate').style.color = '#f1f5f9';
  } else {
    document.getElementById('heroName').style.color = 'var(--text-primary)';
    document.querySelector('.hero-vehicle-sub').style.color = 'var(--text-muted)';
    document.getElementById('heroPlate').style.background = 'var(--bg-surface)';
    document.getElementById('heroPlate').style.borderColor = 'var(--border)';
    document.getElementById('heroPlate').style.color = 'var(--text-primary)';
  }
}

function applyColorToSvg(c) {
  const body = document.getElementById('car-body');
  const roof = document.getElementById('car-roof');
  if (body) { body.style.fill = c.bodyFill; body.style.stroke = c.stroke; }
  if (roof) { roof.style.fill = c.roofFill; roof.style.stroke = c.stroke; }
  const motorBody = document.getElementById('motor-body');
  if (motorBody) { motorBody.style.fill = c.bodyFill; motorBody.style.stroke = c.stroke; }
}

/* ═══════════════════════════════════════
   CHECKBOX
═══════════════════════════════════════ */
function toggleCheckbox() {
  isUtama = !isUtama;
  document.getElementById('checkboxCard').classList.toggle('checked', isUtama);
  document.getElementById('inputUtama').value = isUtama ? '1' : '0';
}

/* ═══════════════════════════════════════
   DELETE MODAL
═══════════════════════════════════════ */
function openDeleteModal()  { document.getElementById('deleteModal').classList.add('open'); }
function closeDeleteModal() { document.getElementById('deleteModal').classList.remove('open'); }
function submitDelete()     { document.getElementById('formDelete').submit(); }

// Close on backdrop click
document.getElementById('deleteModal').addEventListener('click', function(e) {
  if (e.target === this) closeDeleteModal();
});

/* ═══════════════════════════════════════
   SUBMIT — loading state
═══════════════════════════════════════ */
document.getElementById('formKendaraan').addEventListener('submit', function() {
  const btn = document.getElementById('saveBtn');
  btn.disabled = true;
  btn.innerHTML = `
    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
         style="animation:spin 0.8s linear infinite">
      <circle cx="12" cy="12" r="10" stroke-dasharray="30" stroke-dashoffset="10"/>
    </svg>
    Menyimpan...`;
});

/* ═══════════════════════════════════════
   SHARE
═══════════════════════════════════════ */
function handleShare() {
  const url = window.location.href;
  if (navigator.clipboard && navigator.clipboard.writeText) {
    navigator.clipboard.writeText(url).then(() => showToast('🔗', 'Link disalin ke clipboard!'))
      .catch(() => showToast('⚠️', 'Gagal menyalin link'));
  } else {
    showToast('⚠️', 'Clipboard tidak tersedia');
  }
}

/* ═══════════════════════════════════════
   TOAST
═══════════════════════════════════════ */
let toastTimer;
function showToast(icon, msg) {
  const t = document.getElementById('toast');
  document.getElementById('toastIcon').textContent = icon;
  document.getElementById('toastMsg').textContent  = msg;
  t.classList.add('show');
  clearTimeout(toastTimer);
  toastTimer = setTimeout(() => t.classList.remove('show'), 2800);
}

@if(session('success'))
  showToast('✅', '{{ session('success') }}');
@endif
@if(session('error'))
  showToast('⚠️', '{{ session('error') }}');
@endif

/* ═══════════════════════════════════════
   INIT
═══════════════════════════════════════ */
buildColorPicker();

// Init jenis (tampilkan SVG yang benar, filter merek)
selectJenis(selectedJenis);

// Init model suggestions berdasarkan merek tersimpan
updateModelSuggestions('{{ old('merek', $kendaraan->merek) }}');

// Sync plat ke hero
(function() {
  const platEl = document.getElementById('platNomor');
  if (platEl.value) onPlatInput(platEl);
})();
</script>
</body>
</html>