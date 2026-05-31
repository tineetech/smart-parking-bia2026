@extends('layouts.admin')

@section('styles')
<style>
    /* ══════════════════════════════════════════
       PARKIFY — SLOT PARKIR PAGE CSS
    ══════════════════════════════════════════ */

    /* ── BULK ACTION TOOLBAR ─────────────────── */
    .bulk-toolbar {
        display: none;
        align-items: center;
        gap: 10px;
        background: var(--bg-card);
        border: 1px solid var(--blue-main);
        border-radius: 11px;
        padding: 10px 16px;
        margin-bottom: 14px;
        box-shadow: 0 0 0 3px rgba(59,130,246,.08);
        animation: slideDown .2s ease;
    }
    .bulk-toolbar.show { display: flex; }
    .bulk-count {
        font-family: 'Space Grotesk', sans-serif;
        font-size: 13px; font-weight: 700;
        color: var(--blue-main);
        flex: 1;
    }
    .btn-bulk-delete {
        display: inline-flex; align-items: center; gap: 6px;
        background: var(--red); color: #fff;
        border: none; border-radius: 9px;
        padding: 7px 14px; font-size: 12px; font-weight: 600;
        font-family: 'Poppins', sans-serif; cursor: pointer;
        transition: all .16s; white-space: nowrap;
    }
    .btn-bulk-delete:hover { background: #dc2626; transform: translateY(-1px); }
    .btn-bulk-cancel {
        display: inline-flex; align-items: center; gap: 6px;
        background: transparent; color: var(--text-secondary);
        border: 1px solid var(--border); border-radius: 9px;
        padding: 7px 12px; font-size: 12px; font-weight: 500;
        font-family: 'Poppins', sans-serif; cursor: pointer;
        transition: all .16s; white-space: nowrap;
    }
    .btn-bulk-cancel:hover { border-color: var(--border-focus); color: var(--text-primary); }

    /* ── CHECKBOX COLUMN ─────────────────────── */
    .cb-col { width: 38px; padding-right: 0 !important; }
    .row-checkbox {
        width: 15px; height: 15px;
        accent-color: var(--blue-main); cursor: pointer;
    }
    tr.selected-row { background: rgba(59,130,246,.05) !important; }
    tbody tr:hover td { background: rgba(59,130,246,.025); }

    /* ── BUTTONS ─────────────────────────────── */
    .btn-primary {
        display: inline-flex; align-items: center; gap: 7px;
        background: var(--blue-main); color: #fff; border: none;
        border-radius: 10px; padding: 9px 16px; font-size: 12.5px;
        font-weight: 600; font-family: 'Poppins', sans-serif;
        cursor: pointer; transition: background .16s, transform .15s; white-space: nowrap;
    }
    .btn-primary:hover { background: var(--blue-bright); transform: translateY(-1px); }

    .btn-ghost {
        display: inline-flex; align-items: center; gap: 6px;
        background: transparent; color: var(--text-secondary);
        border: 1px solid var(--border); border-radius: 9px;
        padding: 6px 11px; font-size: 11.5px; font-weight: 500;
        font-family: 'Poppins', sans-serif; cursor: pointer;
        transition: all .16s; white-space: nowrap; text-decoration: none;
    }
    .btn-ghost:hover { border-color: var(--border-focus); color: var(--text-primary); background: var(--bg-hover); }

    .btn-danger {
        display: inline-flex; align-items: center; gap: 6px;
        background: transparent; color: var(--red);
        border: 1px solid rgba(239,68,68,.3); border-radius: 9px;
        padding: 6px 11px; font-size: 11.5px; font-weight: 500;
        font-family: 'Poppins', sans-serif; cursor: pointer;
        transition: all .16s; white-space: nowrap;
    }
    .btn-danger:hover { background: var(--red-soft); border-color: var(--red); }

    /* ── STAT CARDS ROW ──────────────────────── */
    .stat-row {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 12px;
        margin-bottom: 20px;
    }
    .stat-card {
        background: var(--bg-card); border: 1px solid var(--border);
        border-radius: 13px; padding: 14px 16px;
        box-shadow: var(--shadow-sm); transition: border-color .2s, transform .2s;
    }
    .stat-card:hover { border-color: var(--blue-main); transform: translateY(-1px); }
    .stat-card-label { font-size: 10.5px; color: var(--text-muted); font-weight: 600; text-transform: uppercase; letter-spacing: .05em; }
    .stat-card-val {
        font-family: 'Space Grotesk', sans-serif; font-size: 26px;
        font-weight: 800; margin-top: 4px;
    }
    .stat-card-dot {
        width: 8px; height: 8px; border-radius: 50%; display: inline-block; margin-right: 5px;
    }

    /* ── TOP LOKASI CARDS ────────────────────── */
    .loc-grid {
        display: grid; grid-template-columns: repeat(3,1fr);
        gap: 14px; margin-bottom: 22px;
    }
    .loc-card {
        background: var(--bg-card); border: 1px solid var(--border);
        border-radius: 14px; padding: 16px 18px;
        box-shadow: var(--shadow-sm); transition: border-color .2s, box-shadow .2s, transform .2s;
    }
    .loc-card:hover { border-color: var(--blue-main); box-shadow: var(--shadow-md); transform: translateY(-2px); }
    .loc-head { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px; gap: 8px; }
    .loc-name { font-family: 'Space Grotesk', sans-serif; font-size: 14px; font-weight: 700; }
    .loc-addr { font-size: 11px; color: var(--text-muted); margin-top: 2px; }
    .loc-stats { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 8px; margin-top: 10px; }
    .ls-label { font-size: 10px; color: var(--text-muted); }
    .ls-val { font-family: 'Space Grotesk', sans-serif; font-size: 17px; font-weight: 800; margin-top: 2px; }
    .prog-bar { height: 5px; background: var(--bg-input); border-radius: 999px; overflow: hidden; margin-top: 10px; }
    .prog-fill { height: 100%; border-radius: 999px; transition: width .5s ease; }
    .loc-bar-row { display: flex; justify-content: space-between; font-size: 11px; color: var(--text-secondary); margin-bottom: 4px; margin-top: 10px; }

    /* ── FILTER BAR ──────────────────────────── */
    .filter-bar {
        display: flex; align-items: center; gap: 10px;
        margin-bottom: 18px; flex-wrap: wrap;
    }
    .filter-input {
        display: flex; align-items: center; gap: 8px;
        background: var(--bg-card); border: 1px solid var(--border);
        border-radius: 10px; padding: 8px 13px; flex: 1; min-width: 160px;
        box-shadow: var(--shadow-sm); transition: border-color .16s, box-shadow .16s;
    }
    .filter-input:focus-within { border-color: var(--border-focus); box-shadow: 0 0 0 3px rgba(59,130,246,.1); }
    .filter-input input {
        background: none; border: none; outline: none;
        color: var(--text-primary); font-size: 12.5px; font-family: 'Poppins', sans-serif; width: 100%;
    }
    .filter-input input::placeholder { color: var(--text-muted); }
    .filter-select {
        background: var(--bg-card); border: 1px solid var(--border);
        border-radius: 10px; padding: 8px 13px; color: var(--text-secondary);
        font-size: 12.5px; font-family: 'Poppins', sans-serif;
        outline: none; cursor: pointer; box-shadow: var(--shadow-sm); transition: border-color .16s;
    }
    .filter-select:focus { border-color: var(--border-focus); }

    /* ── STATUS BADGES ───────────────────────── */
    .status-pill {
        display: inline-flex; align-items: center; gap: 5px;
        padding: 3px 9px; border-radius: 999px; font-size: 11px; font-weight: 600;
    }
    .sp-tersedia  { background: rgba(16,185,129,.12); color: var(--green); }
    .sp-terisi    { background: rgba(239,68,68,.1);   color: var(--red); }
    .sp-dipesan   { background: rgba(245,158,11,.12); color: var(--amber); }
    .sp-nonaktif  { background: var(--bg-input);      color: var(--text-muted); }

    /* ── PAGINATION ──────────────────────────── */
    .pagination-wrap { display: flex; align-items: center; justify-content: space-between; margin-top: 16px; flex-wrap: wrap; gap: 10px; }
    .pg-info { font-size: 12px; color: var(--text-muted); }
    .pagination { display: flex; align-items: center; gap: 4px; flex-wrap: wrap; }
    .pg-btn {
        min-width: 31px; height: 31px; padding: 0 6px; border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        background: var(--bg-input); border: 1px solid var(--border);
        color: var(--text-secondary); font-size: 12.5px; cursor: pointer;
        transition: all .15s; font-family: 'Space Grotesk', sans-serif;
        font-weight: 600; text-decoration: none;
    }
    .pg-btn:hover { border-color: var(--blue-main); color: var(--blue-main); }
    .pg-btn.active { background: var(--blue-main); border-color: var(--blue-main); color: #fff; }
    .pg-btn.disabled { opacity: .4; pointer-events: none; }

    /* ── FLASH ───────────────────────────────── */
    .flash {
        display: flex; align-items: center; gap: 10px;
        padding: 12px 16px; border-radius: 10px; font-size: 13px;
        font-weight: 500; margin-bottom: 16px; animation: slideDown .25s ease;
    }
    @keyframes slideDown { from { opacity:0; transform:translateY(-8px); } to { opacity:1; transform:translateY(0); } }
    .flash-success { background: var(--green-soft); color: var(--green); border: 1px solid rgba(16,185,129,.3); }
    .flash-error   { background: var(--red-soft);   color: var(--red);   border: 1px solid rgba(239,68,68,.3); }

    /* ── MODAL ───────────────────────────────── */
    .modal-backdrop {
        position: fixed; inset: 0; background: rgba(5,10,20,.55);
        backdrop-filter: blur(4px); z-index: 100;
        display: flex; align-items: center; justify-content: center;
        padding: 16px; opacity: 0; pointer-events: none; transition: opacity .22s;
    }
    .modal-backdrop.open { opacity: 1; pointer-events: all; }
    .modal {
        background: var(--bg-card); border: 1px solid var(--border);
        border-radius: 18px; width: 100%; max-width: 560px;
        max-height: 92vh; overflow-y: auto; box-shadow: var(--shadow-lg);
        transform: scale(.95) translateY(12px);
        transition: transform .22s cubic-bezier(.4,0,.2,1);
    }
    .modal-backdrop.open .modal { transform: scale(1) translateY(0); }
    .modal-sm { max-width: 380px; }
    .modal-header { display: flex; align-items: center; justify-content: space-between; padding: 20px 24px 0; margin-bottom: 16px; }
    .modal-title  { font-family: 'Space Grotesk', sans-serif; font-size: 16px; font-weight: 800; }
    .modal-close  {
        width: 32px; height: 32px; border-radius: 9px; border: 1px solid var(--border);
        background: var(--bg-input); display: flex; align-items: center; justify-content: center;
        cursor: pointer; color: var(--text-muted); transition: all .15s; flex-shrink: 0;
    }
    .modal-close:hover { border-color: var(--red); color: var(--red); }
    .modal-body   { padding: 0 24px 24px; }
    .modal-footer { display: flex; justify-content: flex-end; gap: 10px; padding-top: 16px; border-top: 1px solid var(--border); margin-top: 6px; }

    /* ── FORM ────────────────────────────────── */
    .form-row    { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
    .form-group  { margin-bottom: 14px; }
    .form-label  { display: block; font-size: 11.5px; font-weight: 600; color: var(--text-secondary); margin-bottom: 6px; text-transform: uppercase; letter-spacing: .05em; }
    .form-control {
        width: 100%; background: var(--bg-input); border: 1px solid var(--border);
        border-radius: 9px; padding: 9px 13px; color: var(--text-primary);
        font-size: 13px; font-family: 'Poppins', sans-serif; outline: none;
        transition: border-color .16s, box-shadow .16s; box-sizing: border-box;
    }
    .form-control:focus { border-color: var(--border-focus); box-shadow: 0 0 0 3px rgba(59,130,246,.1); }
    .form-control::placeholder { color: var(--text-muted); }
    .form-hint { font-size: 11px; color: var(--text-muted); margin-top: 4px; }

    /* ── SECTION DIVIDER ─────────────────────── */
    .section-divider { display: flex; align-items: center; gap: 10px; margin: 6px 0 14px; }
    .section-divider span { font-size: 10.5px; font-weight: 700; text-transform: uppercase; letter-spacing: .1em; color: var(--text-muted); white-space: nowrap; }
    .section-divider::before, .section-divider::after { content: ''; flex: 1; height: 1px; background: var(--border); }

    /* ── BULK TOGGLE ─────────────────────────── */
    .bulk-panel {
        background: var(--bg-input); border: 1px solid var(--border);
        border-radius: 11px; padding: 14px 16px; margin-bottom: 14px;
        display: none;
    }
    .bulk-panel.show { display: block; }
    .toggle-bulk-btn {
        display: inline-flex; align-items: center; gap: 6px;
        font-size: 12px; font-weight: 600; color: var(--blue-main);
        background: var(--blue-soft); border: 1px solid var(--blue-pale);
        border-radius: 8px; padding: 5px 11px; cursor: pointer;
        transition: all .15s; margin-bottom: 14px;
    }
    .toggle-bulk-btn:hover { background: var(--blue-pale); }

    /* ── DELETE CONFIRM ──────────────────────── */
    .del-icon  { width: 52px; height: 52px; border-radius: 14px; background: var(--red-soft); color: var(--red); display: flex; align-items: center; justify-content: center; margin: 0 auto 14px; }
    .del-title { font-family: 'Space Grotesk', sans-serif; font-size: 15px; font-weight: 800; text-align: center; margin-bottom: 8px; }
    .del-sub   { font-size: 12.5px; color: var(--text-muted); text-align: center; line-height: 1.6; }

    /* ── RESPONSIVE ──────────────────────────── */
    @media (max-width: 1200px) { .stat-row { grid-template-columns: repeat(3,1fr); } .loc-grid { grid-template-columns: repeat(2,1fr); } }
    @media (max-width: 860px)  { .stat-row { grid-template-columns: repeat(2,1fr); } .loc-grid { grid-template-columns: 1fr; } }
    @media (max-width: 640px)  { .form-row { grid-template-columns: 1fr; } .filter-select { width: 100%; } }
</style>
@endsection

@section('content')
<div class="content">

    @if(session('success'))
    <div class="flash flash-success">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
        {{ session('success') }}
    </div>
    @endif
    @if(session('error'))
    <div class="flash flash-error">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
        {{ session('error') }}
    </div>
    @endif
    @if($errors->any())
    <div class="flash flash-error">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
        <div>
            @foreach($errors->all() as $e)
                <div>{{ $e }}</div>
            @endforeach
        </div>
    </div>
    @endif

    <div class="page-header">
        <div>
            <div class="page-title">Kelola Slot Parkir</div>
            <div class="page-sub">{{ $totalTersedia }} tersedia · {{ $totalTerisi }} terisi · {{ $totalDipesan }} dipesan dari {{ $totalSlot }} total slot</div>
        </div>
        <button class="btn-primary" onclick="openModal('modalTambah')">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Tambah Slot
        </button>
    </div>

    {{-- ── STAT CARDS ── --}}
    <div class="stat-row">
        <div class="stat-card">
            <div class="stat-card-label">Total Slot</div>
            <div class="stat-card-val">{{ number_format($totalSlot) }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-card-label"><span class="stat-card-dot" style="background:var(--green)"></span>Tersedia</div>
            <div class="stat-card-val" style="color:var(--green)">{{ number_format($totalTersedia) }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-card-label"><span class="stat-card-dot" style="background:var(--red)"></span>Terisi</div>
            <div class="stat-card-val" style="color:var(--red)">{{ number_format($totalTerisi) }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-card-label"><span class="stat-card-dot" style="background:var(--amber)"></span>Dipesan</div>
            <div class="stat-card-val" style="color:var(--amber)">{{ number_format($totalDipesan) }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-card-label"><span class="stat-card-dot" style="background:var(--text-muted)"></span>Nonaktif</div>
            <div class="stat-card-val" style="color:var(--text-muted)">{{ number_format($totalNonaktif) }}</div>
        </div>
    </div>

    {{-- ── TOP LOKASI CARDS ── --}}
    @if($topLokasi->count())
    <div class="loc-grid">
        @foreach($topLokasi as $lok)
        @php
            $total     = $lok->slot_parkir_count ?? 0;
            $terisi    = $lok->slot_terisi_count  ?? 0;
            $tersedia  = $lok->slot_tersedia_count ?? 0;
            $hunian    = $total > 0 ? round(($terisi / $total) * 100) : 0;
            $barColor  = $hunian >= 80 ? 'var(--red)' : ($hunian >= 60 ? 'var(--amber)' : 'var(--green)');
        @endphp
        <div class="loc-card">
            <div class="loc-head">
                <div>
                    <div class="loc-name">{{ $lok->nama }}</div>
                    <div class="loc-addr">{{ Str::limit($lok->alamat, 40) }}</div>
                </div>
                <span class="badge {{ $lok->aktif ? 'b-green' : 'b-gray' }}">● {{ $lok->aktif ? 'Aktif' : 'Nonaktif' }}</span>
            </div>
            <div class="loc-stats">
                <div>
                    <div class="ls-label">Total Slot</div>
                    <div class="ls-val">{{ $total }}</div>
                </div>
                <div>
                    <div class="ls-label">Tersedia</div>
                    <div class="ls-val" style="color:var(--green)">{{ $tersedia }}</div>
                </div>
                <div>
                    <div class="ls-label">Terisi</div>
                    <div class="ls-val" style="color:var(--red)">{{ $terisi }}</div>
                </div>
            </div>
            <div class="loc-bar-row">
                <span>Hunian</span>
                <span style="font-weight:700;color:{{ $barColor }}">{{ $hunian }}%</span>
            </div>
            <div class="prog-bar"><div class="prog-fill" style="width:{{ $hunian }}%;background:{{ $barColor }}"></div></div>
        </div>
        @endforeach
    </div>
    @endif

    {{-- ── FILTER BAR ── --}}
    <div class="filter-bar">
        <form method="GET" action="{{ route('admin.slot.index') }}" id="filterForm" style="display:contents">
            <div class="filter-input">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="var(--text-muted)" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                <input name="search" placeholder="Cari kode slot atau nama lokasi..." value="{{ request('search') }}" id="filterSearch" />
            </div>
            <select name="lokasi_id" class="filter-select" onchange="this.form.submit()">
                <option value="">Semua Lokasi</option>
                @foreach($lokasiList as $l)
                <option value="{{ $l->id }}" {{ request('lokasi_id') == $l->id ? 'selected' : '' }}>{{ $l->nama }}</option>
                @endforeach
            </select>
            <select name="status" class="filter-select" onchange="this.form.submit()">
                <option value="">Semua Status</option>
                <option value="tersedia" {{ request('status') === 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                <option value="terisi"   {{ request('status') === 'terisi'   ? 'selected' : '' }}>Terisi</option>
                <option value="dipesan"  {{ request('status') === 'dipesan'  ? 'selected' : '' }}>Dipesan</option>
                <option value="nonaktif" {{ request('status') === 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
            </select>
            <select name="jenis_slot" class="filter-select" onchange="this.form.submit()">
                <option value="">Semua Jenis</option>
                <option value="reguler" {{ request('jenis_slot') === 'reguler' ? 'selected' : '' }}>Reguler</option>
                <option value="vip"     {{ request('jenis_slot') === 'vip'     ? 'selected' : '' }}>VIP</option>
            </select>
            <select name="kendaraan_type" class="filter-select" onchange="this.form.submit()">
                <option value="">Semua Kendaraan</option>
                <option value="mobil" {{ request('kendaraan_type') === 'mobil' ? 'selected' : '' }}>Mobil</option>
                <option value="motor" {{ request('kendaraan_type') === 'motor' ? 'selected' : '' }}>Motor</option>
            </select>
            <button type="submit" class="btn-ghost">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                Cari
            </button>
            @if(request('search') || request('lokasi_id') || request('status') || request('jenis_slot') || request('kendaraan_type'))
            <a href="{{ route('admin.slot.index') }}" class="btn-ghost" style="color:var(--red)">Reset</a>
            @endif
        </form>
    </div>

    {{-- ── TABLE ── --}}
    <div class="card">
        <div class="card-header">
            <span class="card-title">Semua Slot Parkir</span>
        </div>

        {{-- Bulk Action Toolbar --}}
        <div class="bulk-toolbar" id="bulkToolbar">
            <span class="bulk-count" id="bulkCount">0 slot dipilih</span>
            <button type="button" class="btn-bulk-cancel" onclick="clearSelection()">
                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                Batal
            </button>
            <button type="button" class="btn-bulk-delete" onclick="openBulkDelete()">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/></svg>
                Hapus yang Dipilih
            </button>
        </div>

        <div class="table-wrap">
            <table class="data-table">
                <thead>
                    <tr>
                        <th class="cb-col">
                            <input type="checkbox" class="row-checkbox" id="checkAll" onchange="toggleAll(this)" title="Pilih semua" />
                        </th>
                        <th>Kode Slot</th>
                        <th>Lokasi</th>
                        <th>Lantai / Zona</th>
                        <th>Jenis</th>
                        <th>Kendaraan</th>
                        <th>Status</th>
                        <th>Sensor ID</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($slots as $slot)
                    <tr id="row-{{ $slot->id }}" onclick="rowClick(event, {{ $slot->id }})" style="cursor:pointer">
                        <td class="cb-col" onclick="event.stopPropagation()">
                            <input type="checkbox" class="row-checkbox slot-cb" value="{{ $slot->id }}" onchange="onRowCheck(this)" />
                        </td>
                        <td>
                            <code style="font-size:12px;background:var(--bg-input);padding:3px 8px;border-radius:5px;color:var(--text-primary);font-weight:700">{{ $slot->kode_slot }}</code>
                        </td>
                        <td>
                            <span class="cell-primary">{{ $slot->lokasiParkir->nama ?? '—' }}</span>
                        </td>
                        <td style="font-size:12px">
                            @if($slot->lantai || $slot->zona)
                                {{ $slot->lantai ? 'Lt. '.$slot->lantai : '' }}
                                {{ $slot->lantai && $slot->zona ? ' · ' : '' }}
                                {{ $slot->zona ? 'Zona '.$slot->zona : '' }}
                            @else
                                <span style="color:var(--text-muted)">—</span>
                            @endif
                        </td>
                        <td>
                            @if($slot->jenis_slot === 'vip')
                                <span style="display:inline-flex;align-items:center;gap:4px;font-size:11.5px;font-weight:700;color:#a78bfa;background:rgba(139,92,246,.1);padding:3px 9px;border-radius:999px">
                                    ★ VIP
                                </span>
                            @else
                                <span style="font-size:12px;color:var(--text-secondary)">Reguler</span>
                            @endif
                        </td>
                        <td>
                            @if($slot->kendaraan_type === 'mobil')
                                <span style="display:inline-flex;align-items:center;gap:5px;font-size:12px;color:var(--text-secondary)">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="3" width="15" height="13" rx="2"/><path d="M16 8h4a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2h-4"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
                                    Mobil
                                </span>
                            @else
                                <span style="display:inline-flex;align-items:center;gap:5px;font-size:12px;color:var(--text-secondary)">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="5.5" cy="17.5" r="3.5"/><circle cx="18.5" cy="17.5" r="3.5"/><path d="M15 6h-5L8 10H4m11-4l2 4m-5-4V3"/></svg>
                                    Motor
                                </span>
                            @endif
                        </td>
                        <td>
                            @php
                                $pillClass = match($slot->status) {
                                    'tersedia' => 'sp-tersedia',
                                    'terisi'   => 'sp-terisi',
                                    'dipesan'  => 'sp-dipesan',
                                    default    => 'sp-nonaktif',
                                };
                                $pillDot = match($slot->status) {
                                    'tersedia' => '●',
                                    'terisi'   => '●',
                                    'dipesan'  => '●',
                                    default    => '○',
                                };
                            @endphp
                            <span class="status-pill {{ $pillClass }}">{{ $pillDot }} {{ ucfirst($slot->status) }}</span>
                        </td>
                        <td>
                            @if($slot->id_sensor)
                                <code style="font-size:10.5px;background:var(--bg-input);padding:2px 6px;border-radius:5px;color:var(--text-muted)">{{ $slot->id_sensor }}</code>
                            @else
                                <span style="color:var(--text-muted);font-size:12px">—</span>
                            @endif
                        </td>
                        <td onclick="event.stopPropagation()">
                            <div style="display:flex;gap:6px;align-items:center">
                                <button class="btn-ghost" onclick="openEdit({{ json_encode($slot) }})">
                                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                    Edit
                                </button>
                                <button class="btn-danger" onclick="openDelete({{ $slot->id }}, '{{ addslashes($slot->kode_slot) }}')">
                                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/></svg>
                                    Hapus
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" style="text-align:center;padding:28px;color:var(--text-muted)">
                            Tidak ada slot parkir yang ditemukan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($slots->hasPages())
        <div class="pagination-wrap">
            <div class="pg-info">Menampilkan {{ $slots->firstItem() }}–{{ $slots->lastItem() }} dari {{ $slots->total() }} slot</div>
            <div class="pagination">
                @if($slots->onFirstPage())
                    <span class="pg-btn disabled">←</span>
                @else
                    <a href="{{ $slots->previousPageUrl() }}" class="pg-btn">←</a>
                @endif
                @foreach($slots->getUrlRange(1, $slots->lastPage()) as $page => $url)
                    @if(abs($page - $slots->currentPage()) <= 2 || $page === 1 || $page === $slots->lastPage())
                        <a href="{{ $url }}" class="pg-btn {{ $page == $slots->currentPage() ? 'active' : '' }}">{{ $page }}</a>
                    @elseif(abs($page - $slots->currentPage()) === 3)
                        <span class="pg-btn disabled" style="pointer-events:none">…</span>
                    @endif
                @endforeach
                @if($slots->hasMorePages())
                    <a href="{{ $slots->nextPageUrl() }}" class="pg-btn">→</a>
                @else
                    <span class="pg-btn disabled">→</span>
                @endif
            </div>
        </div>
        @endif
    </div>

</div>

{{-- ═══════════════════════════════════════════════
 MODAL: TAMBAH SLOT
════════════════════════════════════════════════ --}}
<div class="modal-backdrop" id="modalTambah" onclick="backdropClose(event,'modalTambah')">
    <div class="modal" role="dialog" aria-modal="true">
        <div class="modal-header">
            <div class="modal-title">Tambah Slot Parkir</div>
            <div class="modal-close" onclick="closeModal('modalTambah')">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </div>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('admin.slot.store') }}" id="formTambah">
                @csrf

                {{-- Bulk Generate Toggle --}}
                <button type="button" class="toggle-bulk-btn" id="toggleBulkBtn" onclick="toggleBulk()">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
                    <span id="toggleBulkText">Mode Bulk Generate</span>
                </button>

                {{-- Hidden flag — MUST be outside the hidden panel so it always submits --}}
                <input type="hidden" name="bulk_generate" id="bulk_generate" value="0" />

                {{-- Bulk Panel --}}
                <div class="bulk-panel" id="bulkPanel">
                    <div class="form-row">
                        <div class="form-group" style="margin-bottom:0">
                            <label class="form-label">Prefix Kode</label>
                            <input type="text" name="bulk_prefix" id="bulk_prefix" class="form-control" placeholder="cth: A, B1, VIP" maxlength="5" />
                            <div class="form-hint">Akan menjadi A01, A02, ...</div>
                        </div>
                        <div class="form-group" style="margin-bottom:0">
                            <label class="form-label">Jumlah Slot</label>
                            <input type="number" name="bulk_jumlah" id="bulk_jumlah" class="form-control" placeholder="cth: 20" min="1" max="100" />
                            <div class="form-hint">Maksimum 100 slot sekaligus</div>
                        </div>
                    </div>
                </div>

                <div class="form-group" id="kodeSlotGroup">
                    <label class="form-label">Kode Slot <span style="color:var(--red)">*</span></label>
                    <input type="text" name="kode_slot" id="tambah_kode_slot" class="form-control" placeholder="cth: A01, B-12" maxlength="10" required />
                    <div class="form-hint" id="kodeSlotHint">Unik per lokasi</div>
                </div>

                <div class="form-group">
                    <label class="form-label">Lokasi Parkir <span style="color:var(--red)">*</span></label>
                    <select name="lokasi_parkir_id" class="form-control" required>
                        <option value="">— Pilih Lokasi —</option>
                        @foreach($lokasiList as $l)
                        <option value="{{ $l->id }}">{{ $l->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Lantai</label>
                        <input type="text" name="lantai" class="form-control" placeholder="cth: 1, B2, Roof" maxlength="10" />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Zona</label>
                        <input type="text" name="zona" class="form-control" placeholder="cth: A, B, VIP" maxlength="10" />
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Jenis Slot <span style="color:var(--red)">*</span></label>
                        <select name="jenis_slot" class="form-control" required>
                            <option value="reguler">Reguler</option>
                            <option value="vip">VIP</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Jenis Kendaraan <span style="color:var(--red)">*</span></label>
                        <select name="kendaraan_type" class="form-control" required>
                            <option value="mobil">Mobil</option>
                            <option value="motor">Motor</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Status <span style="color:var(--red)">*</span></label>
                        <select name="status" class="form-control" required>
                            <option value="tersedia">Tersedia</option>
                            <option value="nonaktif">Nonaktif</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">ID Sensor</label>
                        <input type="number" name="id_sensor" class="form-control" placeholder="Opsional" />
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-ghost" onclick="closeModal('modalTambah')">Batal</button>
                    <button type="submit" class="btn-primary" id="tambahSubmitBtn">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                        Simpan Slot
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ═══════════════════════════════════════════════
 MODAL: EDIT SLOT
════════════════════════════════════════════════ --}}
<div class="modal-backdrop" id="modalEdit" onclick="backdropClose(event,'modalEdit')">
    <div class="modal" role="dialog" aria-modal="true">
        <div class="modal-header">
            <div class="modal-title">Edit Slot Parkir</div>
            <div class="modal-close" onclick="closeModal('modalEdit')">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </div>
        </div>
        <div class="modal-body">
            <form method="POST" id="formEdit">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label class="form-label">Kode Slot <span style="color:var(--red)">*</span></label>
                    <input type="text" name="kode_slot" id="edit_kode_slot" class="form-control" maxlength="10" required />
                </div>

                <div class="form-group">
                    <label class="form-label">Lokasi Parkir <span style="color:var(--red)">*</span></label>
                    <select name="lokasi_parkir_id" id="edit_lokasi_parkir_id" class="form-control" required>
                        @foreach($lokasiList as $l)
                        <option value="{{ $l->id }}">{{ $l->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Lantai</label>
                        <input type="text" name="lantai" id="edit_lantai" class="form-control" maxlength="10" />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Zona</label>
                        <input type="text" name="zona" id="edit_zona" class="form-control" maxlength="10" />
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Jenis Slot <span style="color:var(--red)">*</span></label>
                        <select name="jenis_slot" id="edit_jenis_slot" class="form-control" required>
                            <option value="reguler">Reguler</option>
                            <option value="vip">VIP</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Jenis Kendaraan <span style="color:var(--red)">*</span></label>
                        <select name="kendaraan_type" id="edit_kendaraan_type" class="form-control" required>
                            <option value="mobil">Mobil</option>
                            <option value="motor">Motor</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Status <span style="color:var(--red)">*</span></label>
                        <select name="status" id="edit_status" class="form-control" required>
                            <option value="tersedia">Tersedia</option>
                            <option value="terisi">Terisi</option>
                            <option value="dipesan">Dipesan</option>
                            <option value="nonaktif">Nonaktif</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">ID Sensor</label>
                        <input type="number" name="id_sensor" id="edit_id_sensor" class="form-control" />
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-ghost" onclick="closeModal('modalEdit')">Batal</button>
                    <button type="submit" class="btn-primary">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ═══════════════════════════════════════════════
 MODAL: CONFIRM DELETE
════════════════════════════════════════════════ --}}
<div class="modal-backdrop" id="modalDelete" onclick="backdropClose(event,'modalDelete')">
    <div class="modal modal-sm" role="dialog" aria-modal="true">
        <div class="modal-header" style="padding-bottom:0;margin-bottom:0;border:none">
            <div></div>
            <div class="modal-close" onclick="closeModal('modalDelete')">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </div>
        </div>
        <div class="modal-body" style="padding-top:10px">
            <div class="del-icon">
                <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4h6v2"/></svg>
            </div>
            <div class="del-title">Hapus Slot Parkir?</div>
            <div class="del-sub">
                Kamu akan menghapus slot <strong id="deleteName"></strong>. Semua data pemesanan terkait akan terpengaruh — tindakan ini tidak bisa dibatalkan.
            </div>
            <form method="POST" id="formDelete" style="margin-top:20px">
                @csrf
                @method('DELETE')
                <div class="modal-footer" style="border:none;padding-top:0;justify-content:center;gap:10px">
                    <button type="button" class="btn-ghost" onclick="closeModal('modalDelete')" style="min-width:100px">Batal</button>
                    <button type="submit" class="btn-primary" style="background:var(--red);min-width:100px">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/></svg>
                        Ya, Hapus
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ═══════════════════════════════════════════════
 MODAL: BULK DELETE CONFIRM
════════════════════════════════════════════════ --}}
<div class="modal-backdrop" id="modalBulkDelete" onclick="backdropClose(event,'modalBulkDelete')">
    <div class="modal modal-sm" role="dialog" aria-modal="true">
        <div class="modal-header" style="padding-bottom:0;margin-bottom:0;border:none">
            <div></div>
            <div class="modal-close" onclick="closeModal('modalBulkDelete')">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </div>
        </div>
        <div class="modal-body" style="padding-top:10px">
            <div class="del-icon">
                <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4h6v2"/></svg>
            </div>
            <div class="del-title">Hapus Slot Terpilih?</div>
            <div class="del-sub">
                Kamu akan menghapus <strong id="bulkDeleteCount">0</strong> slot parkir sekaligus.
                Semua data pemesanan terkait akan terpengaruh — tindakan ini tidak bisa dibatalkan.
            </div>
            <form method="POST" id="formBulkDelete" action="{{ route('admin.slot.bulk-destroy') }}" style="margin-top:20px">
                @csrf
                @method('DELETE')
                <div id="bulkDeleteInputs"></div>
                <div class="modal-footer" style="border:none;padding-top:0;justify-content:center;gap:10px">
                    <button type="button" class="btn-ghost" onclick="closeModal('modalBulkDelete')" style="min-width:100px">Batal</button>
                    <button type="submit" class="btn-primary" style="background:var(--red);min-width:130px">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/></svg>
                        Ya, Hapus Semua
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // ══════════════════════════════════════════
    // PARKIFY — SLOT PARKIR PAGE JS
    // ══════════════════════════════════════════

    const SLOT_BASE_URL = '{{ url("/slot") }}';

    // ── MODAL HELPERS ────────────────────────
    function openModal(id)  { document.getElementById(id).classList.add('open');    document.body.style.overflow = 'hidden'; }
    function closeModal(id) { document.getElementById(id).classList.remove('open'); document.body.style.overflow = ''; }
    function backdropClose(e, id) { if (e.target === document.getElementById(id)) closeModal(id); }

    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') ['modalTambah','modalEdit','modalDelete','modalBulkDelete'].forEach(closeModal);
    });

    // ── BULK SELECT ───────────────────────────
    const selectedIds = new Set();

    // Called when a single row checkbox changes
    function onRowCheck(cb) {
        const id  = parseInt(cb.value);
        const row = document.getElementById('row-' + id);
        if (cb.checked) {
            selectedIds.add(id);
            row.classList.add('selected-row');
        } else {
            selectedIds.delete(id);
            row.classList.remove('selected-row');
        }
        syncCheckAll();
        syncBulkToolbar();
    }

    // Called when the header "check all" checkbox changes
    function toggleAll(masterCb) {
        const check = masterCb.checked;
        document.querySelectorAll('.slot-cb').forEach(cb => {
            cb.checked = check;
            const id  = parseInt(cb.value);
            const row = document.getElementById('row-' + id);
            if (check) {
                selectedIds.add(id);
                row.classList.add('selected-row');
            } else {
                selectedIds.delete(id);
                row.classList.remove('selected-row');
            }
        });
        // Explicitly reset indeterminate after toggling
        masterCb.indeterminate = false;
        syncBulkToolbar();
    }

    // Sync the header checkbox state (checked / indeterminate / unchecked)
    function syncCheckAll() {
        const masterCb    = document.getElementById('checkAll');
        const allCbs      = document.querySelectorAll('.slot-cb');
        const total       = allCbs.length;
        const checkedCount = selectedIds.size;

        if (checkedCount === 0) {
            masterCb.checked       = false;
            masterCb.indeterminate = false;
        } else if (checkedCount === total) {
            masterCb.checked       = true;
            masterCb.indeterminate = false;
        } else {
            masterCb.checked       = false;
            masterCb.indeterminate = true;
        }
    }

    // Show/hide the bulk toolbar and update count label
    function syncBulkToolbar() {
        const n = selectedIds.size;
        document.getElementById('bulkCount').textContent = n + ' slot dipilih';
        document.getElementById('bulkToolbar').classList.toggle('show', n > 0);
    }

    // Clicking anywhere on the row (except buttons/inputs) toggles its checkbox
    function rowClick(e, id) {
        if (e.target.closest('button, a, input, select, label')) return;
        const cb = document.querySelector(`.slot-cb[value="${id}"]`);
        if (!cb) return;
        cb.checked = !cb.checked;
        onRowCheck(cb);
    }

    // Deselect everything — called by the "Batal" button in the toolbar
    function clearSelection() {
        document.querySelectorAll('.slot-cb').forEach(cb => {
            cb.checked = false;
            document.getElementById('row-' + cb.value)?.classList.remove('selected-row');
        });
        selectedIds.clear();
        const masterCb         = document.getElementById('checkAll');
        masterCb.checked       = false;
        masterCb.indeterminate = false;
        syncBulkToolbar();
    }

    function openBulkDelete() {
        if (selectedIds.size === 0) return;

        // Update count label
        document.getElementById('bulkDeleteCount').textContent = selectedIds.size;

        // Inject hidden inputs for each selected id
        const container = document.getElementById('bulkDeleteInputs');
        container.innerHTML = '';
        selectedIds.forEach(id => {
            const inp = document.createElement('input');
            inp.type  = 'hidden';
            inp.name  = 'ids[]';
            inp.value = id;
            container.appendChild(inp);
        });

        openModal('modalBulkDelete');
    }

    // ── BULK GENERATE TOGGLE ─────────────────
    let bulkMode = false;
    function toggleBulk() {
        bulkMode = !bulkMode;
        const panel   = document.getElementById('bulkPanel');
        const flag    = document.getElementById('bulk_generate');
        const kodeGrp = document.getElementById('kodeSlotGroup');
        const kodeInp = document.getElementById('tambah_kode_slot');
        const hint    = document.getElementById('kodeSlotHint');
        const btnTxt  = document.getElementById('toggleBulkText');
        const submitBtn = document.getElementById('tambahSubmitBtn');

        if (bulkMode) {
            panel.classList.add('show');
            flag.value = '1';
            kodeInp.required = false;
            kodeInp.placeholder = 'Tidak diperlukan saat bulk';
            hint.textContent = 'Gunakan prefix di atas untuk bulk';
            btnTxt.textContent = 'Mode Satu Slot';
            submitBtn.innerHTML = `<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg> Generate Slot`;
        } else {
            panel.classList.remove('show');
            flag.value = '0';
            kodeInp.required = true;
            kodeInp.placeholder = 'cth: A01, B-12';
            hint.textContent = 'Unik per lokasi';
            btnTxt.textContent = 'Mode Bulk Generate';
            submitBtn.innerHTML = `<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg> Simpan Slot`;
        }
    }

    // ── OPEN EDIT ────────────────────────────
    function openEdit(slot) {
        document.getElementById('edit_kode_slot').value       = slot.kode_slot ?? '';
        document.getElementById('edit_lokasi_parkir_id').value = slot.lokasi_parkir_id ?? '';
        document.getElementById('edit_lantai').value          = slot.lantai ?? '';
        document.getElementById('edit_zona').value            = slot.zona ?? '';
        document.getElementById('edit_jenis_slot').value      = slot.jenis_slot ?? 'reguler';
        document.getElementById('edit_kendaraan_type').value  = slot.kendaraan_type ?? 'mobil';
        document.getElementById('edit_status').value          = slot.status ?? 'tersedia';
        document.getElementById('edit_id_sensor').value       = slot.id_sensor ?? '';

        document.getElementById('formEdit').action = `${SLOT_BASE_URL}/${slot.id}`;
        openModal('modalEdit');
    }

    // ── OPEN DELETE ──────────────────────────
    function openDelete(id, kode) {
        document.getElementById('deleteName').textContent = kode;
        document.getElementById('formDelete').action = `${SLOT_BASE_URL}/${id}`;
        openModal('modalDelete');
    }

    // ── AUTO-DISMISS FLASH ────────────────────
    document.querySelectorAll('.flash').forEach(el => {
        setTimeout(() => {
            el.style.transition = 'opacity 0.4s';
            el.style.opacity = '0';
            setTimeout(() => el.remove(), 400);
        }, 4000);
    });

    // Re-open modal Tambah jika ada validation errors (form was submitted)
    @if($errors->any())
        openModal('modalTambah');
        // Restore bulk mode state if it was active
        @if(old('bulk_generate') == '1')
            toggleBulk();
            document.getElementById('bulk_prefix').value  = '{{ old('bulk_prefix') }}';
            document.getElementById('bulk_jumlah').value  = '{{ old('bulk_jumlah') }}';
        @endif
    @endif
</script>
@endsection