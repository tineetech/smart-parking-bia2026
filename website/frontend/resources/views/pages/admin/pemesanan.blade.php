@extends('layouts.admin')

@section('styles')
<style>
    /* ══════════════════════════════════════════
       PARKIFY — PEMESANAN PAGE CSS
    ══════════════════════════════════════════ */

    /* ── BUTTONS ───────────────────────────────── */
    .btn-primary {
        display: inline-flex; align-items: center; gap: 7px;
        background: var(--blue-main); color: #fff; border: none;
        border-radius: 10px; padding: 9px 16px; font-size: 12.5px;
        font-weight: 600; font-family: 'Poppins', sans-serif;
        cursor: pointer; transition: background 0.16s, transform 0.15s;
        white-space: nowrap; text-decoration: none;
    }
    .btn-primary:hover { background: var(--blue-bright); transform: translateY(-1px); }

    .btn-ghost {
        display: inline-flex; align-items: center; gap: 6px;
        background: transparent; color: var(--text-secondary);
        border: 1px solid var(--border); border-radius: 9px;
        padding: 6px 11px; font-size: 11.5px; font-weight: 500;
        font-family: 'Poppins', sans-serif; cursor: pointer;
        transition: all 0.16s; white-space: nowrap; text-decoration: none;
    }
    .btn-ghost:hover { border-color: var(--border-focus); color: var(--text-primary); background: var(--bg-hover); }

    .btn-danger {
        display: inline-flex; align-items: center; gap: 6px;
        background: transparent; color: var(--red);
        border: 1px solid rgba(239,68,68,.3); border-radius: 9px;
        padding: 6px 11px; font-size: 11.5px; font-weight: 500;
        font-family: 'Poppins', sans-serif; cursor: pointer;
        transition: all 0.16s; white-space: nowrap;
    }
    .btn-danger:hover { background: var(--red-soft); border-color: var(--red); }

    /* ── STAT CARDS ────────────────────────────── */
    .stat-row {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 12px;
        margin-bottom: 20px;
    }
    .stat-card {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: 14px;
        padding: 16px 18px;
        box-shadow: var(--shadow-sm);
        transition: border-color 0.2s, transform 0.2s;
    }
    .stat-card:hover { border-color: var(--blue-main); transform: translateY(-2px); }
    .stat-card-label { font-size: 10.5px; color: var(--text-muted); text-transform: uppercase; letter-spacing: .05em; margin-bottom: 6px; }
    .stat-card-val {
        font-family: 'Space Grotesk', sans-serif;
        font-size: 22px; font-weight: 800;
    }
    .stat-card-sub { font-size: 11px; color: var(--text-muted); margin-top: 3px; }

    /* ── FILTER BAR ────────────────────────────── */
    .filter-bar {
        display: flex; align-items: center;
        gap: 10px; margin-bottom: 18px; flex-wrap: wrap;
    }
    .filter-input {
        display: flex; align-items: center; gap: 8px;
        background: var(--bg-card); border: 1px solid var(--border);
        border-radius: 10px; padding: 8px 13px; flex: 1; min-width: 180px;
        box-shadow: var(--shadow-sm); transition: border-color .16s, box-shadow .16s;
    }
    .filter-input:focus-within { border-color: var(--border-focus); box-shadow: 0 0 0 3px rgba(59,130,246,.1); }
    .filter-input input {
        background: none; border: none; outline: none;
        color: var(--text-primary); font-size: 12.5px;
        font-family: 'Poppins', sans-serif; width: 100%;
    }
    .filter-input input::placeholder { color: var(--text-muted); }
    .filter-select {
        background: var(--bg-card); border: 1px solid var(--border);
        border-radius: 10px; padding: 8px 13px; color: var(--text-secondary);
        font-size: 12.5px; font-family: 'Poppins', sans-serif;
        outline: none; cursor: pointer; box-shadow: var(--shadow-sm);
        transition: border-color .16s;
    }
    .filter-select:focus { border-color: var(--border-focus); }

    /* ── STATUS BADGES ─────────────────────────── */
    .status-badge {
        display: inline-flex; align-items: center; gap: 5px;
        padding: 3px 9px; border-radius: 20px;
        font-size: 11px; font-weight: 600; white-space: nowrap;
    }
    .status-menunggu  { background: rgba(245,158,11,.12);  color: var(--amber);      border: 1px solid rgba(245,158,11,.25); }
    .status-aktif     { background: rgba(16,185,129,.12);  color: var(--green);      border: 1px solid rgba(16,185,129,.25); }
    .status-running   { background: rgba(59,130,246,.12);  color: var(--blue-main);  border: 1px solid rgba(59,130,246,.25); }
    .status-selesai   { background: rgba(107,114,128,.12); color: var(--text-muted); border: 1px solid rgba(107,114,128,.25); }
    .status-dibatalkan{ background: rgba(239,68,68,.12);   color: var(--red);        border: 1px solid rgba(239,68,68,.25); }

    /* ── PAGINATION ────────────────────────────── */
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

    /* ── FLASH ─────────────────────────────────── */
    .flash {
        display: flex; align-items: center; gap: 10px;
        padding: 12px 16px; border-radius: 10px; font-size: 13px;
        font-weight: 500; margin-bottom: 16px; animation: slideDown .25s ease;
    }
    @keyframes slideDown { from { opacity:0; transform:translateY(-8px); } to { opacity:1; transform:translateY(0); } }
    .flash-success { background: var(--green-soft); color: var(--green); border: 1px solid rgba(16,185,129,.3); }
    .flash-error   { background: var(--red-soft);   color: var(--red);   border: 1px solid rgba(239,68,68,.3); }

    /* ── MODAL ─────────────────────────────────── */
    .modal-backdrop {
        position: fixed; inset: 0; background: rgba(5,10,20,.55);
        backdrop-filter: blur(4px); z-index: 100;
        display: flex; align-items: center; justify-content: center;
        padding: 16px; opacity: 0; pointer-events: none; transition: opacity .22s;
    }
    .modal-backdrop.open { opacity: 1; pointer-events: all; }
    .modal {
        background: var(--bg-card); border: 1px solid var(--border);
        border-radius: 18px; width: 100%; max-width: 600px;
        max-height: 92vh; overflow-y: auto; box-shadow: var(--shadow-lg);
        transform: scale(.95) translateY(12px);
        transition: transform .22s cubic-bezier(.4,0,.2,1);
    }
    .modal-backdrop.open .modal { transform: scale(1) translateY(0); }
    .modal-sm  { max-width: 420px; }
    .modal-lg  { max-width: 720px; }
    .modal-header {
        display: flex; align-items: center; justify-content: space-between;
        padding: 20px 24px 0; margin-bottom: 16px;
    }
    .modal-title { font-family: 'Space Grotesk', sans-serif; font-size: 16px; font-weight: 800; }
    .modal-close {
        width: 32px; height: 32px; border-radius: 9px;
        border: 1px solid var(--border); background: var(--bg-input);
        display: flex; align-items: center; justify-content: center;
        cursor: pointer; color: var(--text-muted); transition: all .15s; flex-shrink: 0;
    }
    .modal-close:hover { border-color: var(--red); color: var(--red); }
    .modal-body { padding: 0 24px 24px; }
    .modal-footer {
        display: flex; justify-content: flex-end; gap: 10px;
        padding-top: 16px; border-top: 1px solid var(--border); margin-top: 6px;
    }

    /* ── FORM ELEMENTS ─────────────────────────── */
    .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
    .form-row-3 { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 14px; }
    .form-group { margin-bottom: 14px; }
    .form-label {
        display: block; font-size: 11.5px; font-weight: 600;
        color: var(--text-secondary); margin-bottom: 6px;
        text-transform: uppercase; letter-spacing: .05em;
    }
    .form-control {
        width: 100%; background: var(--bg-input); border: 1px solid var(--border);
        border-radius: 9px; padding: 9px 13px; color: var(--text-primary);
        font-size: 13px; font-family: 'Poppins', sans-serif; outline: none;
        transition: border-color .16s, box-shadow .16s; box-sizing: border-box;
    }
    .form-control:focus { border-color: var(--border-focus); box-shadow: 0 0 0 3px rgba(59,130,246,.1); }
    .form-control::placeholder { color: var(--text-muted); }
    textarea.form-control { resize: vertical; min-height: 72px; }

    /* ── DETAIL PANEL ──────────────────────────── */
    .detail-grid {
        display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 16px;
    }
    .detail-item { }
    .detail-item-label { font-size: 10.5px; text-transform: uppercase; letter-spacing: .06em; color: var(--text-muted); margin-bottom: 4px; }
    .detail-item-val { font-size: 13px; font-weight: 600; color: var(--text-primary); word-break: break-word; }
    .detail-divider { height: 1px; background: var(--border); margin: 14px 0; }

    /* ── DELETE MODAL ──────────────────────────── */
    .del-icon {
        width: 52px; height: 52px; border-radius: 14px;
        background: var(--red-soft); color: var(--red);
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 14px;
    }
    .del-title { font-family: 'Space Grotesk', sans-serif; font-size: 15px; font-weight: 800; text-align: center; margin-bottom: 8px; }
    .del-sub   { font-size: 12.5px; color: var(--text-muted); text-align: center; line-height: 1.6; }

    /* ── QUICK STATUS DROPDOWN ─────────────────── */
    .quick-status-form { display: inline-flex; }
    .quick-status-select {
        background: var(--bg-input); border: 1px solid var(--border);
        border-radius: 7px; padding: 4px 8px; font-size: 11px;
        font-family: 'Poppins', sans-serif; color: var(--text-secondary);
        cursor: pointer; outline: none;
    }
    .quick-status-select:focus { border-color: var(--border-focus); }

    /* ── TABLE UTIL ────────────────────────────── */
    .cell-mono {
        font-family: 'Space Grotesk', sans-serif; font-size: 11.5px;
        background: var(--bg-input); padding: 2px 7px;
        border-radius: 5px; color: var(--text-muted); white-space: nowrap;
    }
    .cell-primary { font-weight: 600; font-size: 13px; }
    .cell-sub     { font-size: 11px; color: var(--text-muted); margin-top: 1px; }

    /* ── RESPONSIVE ────────────────────────────── */
    @media (max-width: 1100px) { .stat-row { grid-template-columns: repeat(3, 1fr); } }
    @media (max-width: 760px)  { .stat-row { grid-template-columns: repeat(2, 1fr); } .form-row, .form-row-3 { grid-template-columns: 1fr; } .detail-grid { grid-template-columns: 1fr; } }
    @media (max-width: 480px)  { .stat-row { grid-template-columns: 1fr; } }
</style>
@endsection

@section('content')
<div class="content">

    {{-- ── FLASH ── --}}
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

    {{-- ── PAGE HEADER ── --}}
    <div class="page-header">
        <div>
            <div class="page-title">Kelola Pemesanan</div>
            <div class="page-sub">{{ $totalHariIni }} pemesanan masuk hari ini · {{ $totalAktif }} sedang aktif</div>
        </div>
        <button class="btn-primary" onclick="openModal('modalTambah')">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
            </svg>
            Tambah Pemesanan
        </button>
    </div>

    {{-- ── STAT CARDS ── --}}
    <div class="stat-row">
        <div class="stat-card">
            <div class="stat-card-label">Hari Ini</div>
            <div class="stat-card-val">{{ $totalHariIni }}</div>
            <div class="stat-card-sub">total pemesanan</div>
        </div>
        <div class="stat-card">
            <div class="stat-card-label">Menunggu</div>
            <div class="stat-card-val" style="color:var(--amber)">{{ $totalMenunggu }}</div>
            <div class="stat-card-sub">belum konfirmasi</div>
        </div>
        <div class="stat-card">
            <div class="stat-card-label">Aktif</div>
            <div class="stat-card-val" style="color:var(--green)">{{ $totalAktif }}</div>
            <div class="stat-card-sub">sedang berjalan</div>
        </div>
        <div class="stat-card">
            <div class="stat-card-label">Running</div>
            <div class="stat-card-val" style="color:var(--blue-main)">{{ $totalRunning }}</div>
            <div class="stat-card-sub">kendaraan di slot</div>
        </div>
        <div class="stat-card">
            <div class="stat-card-label">Pendapatan Hari Ini</div>
            <div class="stat-card-val" style="font-size:17px">
                Rp {{ $pendapatanHariIni >= 1000000 ? number_format($pendapatanHariIni/1000000,1).'jt' : number_format($pendapatanHariIni,0,',','.') }}
            </div>
            <div class="stat-card-sub">dari pemesanan selesai</div>
        </div>
    </div>

    {{-- ── FILTER BAR ── --}}
    <div class="filter-bar">
        <form method="GET" action="{{ route('admin.pemesanan.index') }}" id="filterForm" style="display:contents">
            <div class="filter-input">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="var(--text-muted)" stroke-width="2">
                    <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
                <input name="search" id="filterSearch" placeholder="Cari kode, nama pengguna, plat nomor..."
                    value="{{ request('search') }}" />
            </div>

            <select name="status" class="filter-select" onchange="this.form.submit()">
                <option value="">Semua Status</option>
                <option value="menunggu"   {{ request('status')==='menunggu'   ? 'selected':'' }}>Menunggu</option>
                <option value="aktif"      {{ request('status')==='aktif'      ? 'selected':'' }}>Aktif</option>
                <option value="running"    {{ request('status')==='running'    ? 'selected':'' }}>Running</option>
                <option value="selesai"    {{ request('status')==='selesai'    ? 'selected':'' }}>Selesai</option>
                <option value="dibatalkan" {{ request('status')==='dibatalkan' ? 'selected':'' }}>Dibatalkan</option>
            </select>

            <select name="lokasi_id" class="filter-select" onchange="this.form.submit()">
                <option value="">Semua Lokasi</option>
                @foreach($lokasis as $lok)
                <option value="{{ $lok->id }}" {{ request('lokasi_id')==$lok->id ? 'selected':'' }}>{{ $lok->nama }}</option>
                @endforeach
            </select>

            <input type="date" name="tanggal" class="filter-select" value="{{ request('tanggal') }}"
                onchange="this.form.submit()" style="cursor:pointer" />

            <button type="submit" class="btn-ghost">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
                Cari
            </button>

            @if(request('search') || request('status') || request('tanggal') || request('lokasi_id'))
            <a href="{{ route('admin.pemesanan.index') }}" class="btn-ghost" style="color:var(--red)">Reset</a>
            @endif

            <a href="{{ route('admin.pemesanan.exportPdf') }}?status={{ request('status') }}&tanggal={{ request('tanggal') }}&lokasi_id={{ request('lokasi_id') }}"
                target="_blank" class="btn-ghost" style="margin-left:auto">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                        <polyline points="14 2 14 8 20 8"/>
                        <line x1="16" y1="13" x2="8" y2="13"/>
                        <line x1="16" y1="17" x2="8" y2="17"/>
                    </svg>
                    Export PDF
                </a>
        </form>
    </div>

    {{-- ── TABLE ── --}}
    <div class="card">
        <div class="card-header">
            <span class="card-title">Daftar Pemesanan</span>
            <span style="font-size:12px;color:var(--text-muted)">{{ $pemesanans->total() }} total</span>
        </div>
        <div class="table-wrap">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Pengguna</th>
                        <th>Slot & Lokasi</th>
                        <th>Kendaraan</th>
                        <th>Waktu Mulai</th>
                        <th>Durasi</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pemesanans as $p)
                    <tr>
                        {{-- Kode --}}
                        <td>
                            <code class="cell-mono">{{ $p->kode_pemesanan }}</code>
                        </td>

                        {{-- Pengguna --}}
                        <td>
                            <div class="cell-primary">{{ $p->user?->name ?? '–' }}</div>
                            <div class="cell-sub">{{ $p->user?->email }}</div>
                        </td>

                        {{-- Slot & Lokasi --}}
                        <td>
                            <div class="cell-primary">{{ $p->slotParkir?->kode_slot ?? '–' }}</div>
                            <div class="cell-sub">{{ Str::limit($p->slotParkir?->lokasiParkir?->nama, 28) }}</div>
                        </td>

                        {{-- Kendaraan --}}
                        <td>
                            <div class="cell-primary">{{ $p->kendaraan?->plat_nomor ?? '–' }}</div>
                            <div class="cell-sub">{{ $p->kendaraan?->merek }} {{ $p->kendaraan?->model }}</div>
                        </td>

                        {{-- Waktu Mulai --}}
                        <td style="white-space:nowrap;font-size:12px">
                            {{ \Carbon\Carbon::parse($p->waktu_mulai)->format('d M Y') }}<br>
                            <span style="color:var(--text-muted)">{{ \Carbon\Carbon::parse($p->waktu_mulai)->format('H:i') }}</span>
                        </td>

                        {{-- Durasi --}}
                        <td style="font-size:12px;text-align:center">
                            @if($p->durasi_parkir)
                                <span style="font-family:'Space Grotesk',sans-serif;font-weight:700">{{ $p->durasi_parkir }}</span>
                                <span style="color:var(--text-muted)">jam</span>
                            @else
                                <span style="color:var(--text-muted)">–</span>
                            @endif
                        </td>

                        {{-- Total Harga --}}
                        <td style="font-family:'Space Grotesk',sans-serif;font-size:13px;font-weight:700;white-space:nowrap">
                            @if($p->total_harga > 0)
                                Rp {{ number_format($p->total_harga,0,',','.') }}
                            @else
                                <span style="color:var(--text-muted);font-weight:400">–</span>
                            @endif
                        </td>

                        {{-- Status --}}
                        <td>
                            <span class="status-badge status-{{ $p->status }}">
                                ●&nbsp;{{ ucfirst($p->status) }}
                            </span>
                        </td>

                        {{-- Aksi --}}
                        <td>
                            <div style="display:flex;gap:5px;align-items:center;flex-wrap:wrap">
                                <button class="btn-ghost"
                                    onclick="openDetail({{ json_encode($p->load(['user','slotParkir.lokasiParkir','kendaraan','pembayaran'])) }})">
                                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                        <circle cx="12" cy="12" r="9"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
                                    </svg>
                                    Detail
                                </button>
                                <button class="btn-ghost"
                                    onclick="openEdit({{ json_encode($p) }})">
                                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                    </svg>
                                    Edit
                                </button>
                                <button class="btn-danger"
                                    onclick="openDelete({{ $p->id }}, '{{ addslashes($p->kode_pemesanan) }}')">
                                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                        <polyline points="3 6 5 6 21 6"/>
                                        <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
                                    </svg>
                                    Hapus
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" style="text-align:center;padding:32px;color:var(--text-muted)">
                            Tidak ada pemesanan yang ditemukan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- ── PAGINATION ── --}}
        @if($pemesanans->hasPages())
        <div class="pagination-wrap">
            <div class="pg-info">
                Menampilkan {{ $pemesanans->firstItem() }}–{{ $pemesanans->lastItem() }} dari {{ $pemesanans->total() }} pemesanan
            </div>
            <div class="pagination">
                @if($pemesanans->onFirstPage())
                    <span class="pg-btn disabled">←</span>
                @else
                    <a href="{{ $pemesanans->previousPageUrl() }}" class="pg-btn">←</a>
                @endif
                @foreach($pemesanans->getUrlRange(1, $pemesanans->lastPage()) as $page => $url)
                    @if(abs($page - $pemesanans->currentPage()) <= 2 || $page === 1 || $page === $pemesanans->lastPage())
                        <a href="{{ $url }}" class="pg-btn {{ $page == $pemesanans->currentPage() ? 'active':'' }}">{{ $page }}</a>
                    @elseif(abs($page - $pemesanans->currentPage()) === 3)
                        <span class="pg-btn disabled" style="pointer-events:none">…</span>
                    @endif
                @endforeach
                @if($pemesanans->hasMorePages())
                    <a href="{{ $pemesanans->nextPageUrl() }}" class="pg-btn">→</a>
                @else
                    <span class="pg-btn disabled">→</span>
                @endif
            </div>
        </div>
        @endif
    </div>
</div>


{{-- ═══════════════════════════════════════════════
     MODAL: DETAIL PEMESANAN
════════════════════════════════════════════════ --}}
<div class="modal-backdrop" id="modalDetail" onclick="backdropClose(event,'modalDetail')">
    <div class="modal modal-lg" role="dialog" aria-modal="true">
        <div class="modal-header">
            <div>
                <div class="modal-title">Detail Pemesanan</div>
                <code class="cell-mono" id="detail_kode" style="font-size:12px;margin-top:4px;display:inline-block"></code>
            </div>
            <div class="modal-close" onclick="closeModal('modalDetail')">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </div>
        </div>
        <div class="modal-body">
            <div style="display:flex;align-items:center;gap:10px;margin-bottom:18px">
                <span id="detail_status_badge" class="status-badge"></span>
            </div>

            {{-- Pengguna & Kendaraan --}}
            <div class="detail-grid">
                <div class="detail-item">
                    <div class="detail-item-label">Pengguna</div>
                    <div class="detail-item-val" id="detail_user_name">–</div>
                </div>
                <div class="detail-item">
                    <div class="detail-item-label">Email</div>
                    <div class="detail-item-val" id="detail_user_email">–</div>
                </div>
                <div class="detail-item">
                    <div class="detail-item-label">Plat Nomor</div>
                    <div class="detail-item-val" id="detail_plat">–</div>
                </div>
                <div class="detail-item">
                    <div class="detail-item-label">Kendaraan</div>
                    <div class="detail-item-val" id="detail_kendaraan">–</div>
                </div>
            </div>

            <div class="detail-divider"></div>

            {{-- Slot & Lokasi --}}
            <div class="detail-grid">
                <div class="detail-item">
                    <div class="detail-item-label">Slot</div>
                    <div class="detail-item-val" id="detail_slot">–</div>
                </div>
                <div class="detail-item">
                    <div class="detail-item-label">Lokasi</div>
                    <div class="detail-item-val" id="detail_lokasi">–</div>
                </div>
                <div class="detail-item">
                    <div class="detail-item-label">Lantai / Zona</div>
                    <div class="detail-item-val" id="detail_lantai_zona">–</div>
                </div>
                <div class="detail-item">
                    <div class="detail-item-label">Jenis Slot</div>
                    <div class="detail-item-val" id="detail_jenis_slot">–</div>
                </div>
            </div>

            <div class="detail-divider"></div>

            {{-- Waktu & Harga --}}
            <div class="detail-grid">
                <div class="detail-item">
                    <div class="detail-item-label">Waktu Mulai</div>
                    <div class="detail-item-val" id="detail_waktu_mulai">–</div>
                </div>
                <div class="detail-item">
                    <div class="detail-item-label">Waktu Selesai</div>
                    <div class="detail-item-val" id="detail_waktu_selesai">–</div>
                </div>
                <div class="detail-item">
                    <div class="detail-item-label">Durasi</div>
                    <div class="detail-item-val" id="detail_durasi">–</div>
                </div>
                <div class="detail-item">
                    <div class="detail-item-label">Total Harga</div>
                    <div class="detail-item-val" id="detail_total" style="font-family:'Space Grotesk',sans-serif;font-size:16px;font-weight:800">–</div>
                </div>
            </div>

            {{-- Catatan --}}
            <div id="detail_catatan_wrap" style="display:none">
                <div class="detail-divider"></div>
                <div class="detail-item-label">Catatan</div>
                <div class="detail-item-val" id="detail_catatan" style="font-weight:400;color:var(--text-secondary)"></div>
            </div>

            {{-- Quick status change --}}
            <div class="detail-divider"></div>
            <div style="display:flex;align-items:center;gap:10px;flex-wrap:wrap">
                <span style="font-size:12px;font-weight:600;color:var(--text-secondary)">Ubah Status Cepat:</span>
                <form id="quickStatusForm" method="POST" style="display:flex;gap:8px;align-items:center">
                    @csrf @method('PATCH')
                    <select name="status" class="quick-status-select" id="quickStatusSelect">
                        <option value="menunggu">Menunggu</option>
                        <option value="aktif">Aktif</option>
                        <option value="running">Running</option>
                        <option value="selesai">Selesai</option>
                        <option value="dibatalkan">Dibatalkan</option>
                    </select>
                    <button type="submit" class="btn-primary" style="padding:6px 12px;font-size:12px">Simpan</button>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn-ghost" onclick="closeModal('modalDetail')">Tutup</button>
            </div>
        </div>
    </div>
</div>


{{-- ═══════════════════════════════════════════════
     MODAL: TAMBAH PEMESANAN
════════════════════════════════════════════════ --}}
<div class="modal-backdrop" id="modalTambah" onclick="backdropClose(event,'modalTambah')">
    <div class="modal" role="dialog" aria-modal="true">
        <div class="modal-header">
            <div class="modal-title">Tambah Pemesanan</div>
            <div class="modal-close" onclick="closeModal('modalTambah')">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </div>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('admin.pemesanan.store') }}" id="formTambah">
                @csrf

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Pengguna <span style="color:var(--red)">*</span></label>
                        <select name="user_id" class="form-control" required>
                            <option value="">-- Pilih Pengguna --</option>
                            @foreach(\App\Models\User::orderBy('name')->get() as $u)
                            <option value="{{ $u->id }}">{{ $u->name }} ({{ $u->email }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Kendaraan <span style="color:var(--red)">*</span></label>
                        <select name="kendaraan_id" class="form-control" required>
                            <option value="">-- Pilih Kendaraan --</option>
                            @foreach(\App\Models\Kendaraan::with('user')->orderBy('plat_nomor')->get() as $k)
                            <option value="{{ $k->id }}">{{ $k->plat_nomor }} – {{ $k->user?->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Slot Parkir <span style="color:var(--red)">*</span></label>
                    <select name="slot_id" class="form-control" required>
                        <option value="">-- Pilih Slot --</option>
                        @foreach(\App\Models\SlotParkir::with('lokasiParkir')->orderBy('kode_slot')->get() as $sl)
                        <option value="{{ $sl->id }}">
                            {{ $sl->kode_slot }} – {{ $sl->lokasiParkir?->nama }}
                            ({{ $sl->status }})
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Waktu Mulai <span style="color:var(--red)">*</span></label>
                        <input type="datetime-local" name="waktu_mulai" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Waktu Selesai</label>
                        <input type="datetime-local" name="waktu_selesai" class="form-control" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Status <span style="color:var(--red)">*</span></label>
                    <select name="status" class="form-control" required>
                        <option value="menunggu">Menunggu</option>
                        <option value="aktif">Aktif</option>
                        <option value="running">Running</option>
                        <option value="selesai">Selesai</option>
                        <option value="dibatalkan">Dibatalkan</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Catatan</label>
                    <textarea name="catatan" class="form-control" placeholder="Catatan opsional..."></textarea>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-ghost" onclick="closeModal('modalTambah')">Batal</button>
                    <button type="submit" class="btn-primary">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
                        </svg>
                        Simpan Pemesanan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


{{-- ═══════════════════════════════════════════════
     MODAL: EDIT PEMESANAN
════════════════════════════════════════════════ --}}
<div class="modal-backdrop" id="modalEdit" onclick="backdropClose(event,'modalEdit')">
    <div class="modal" role="dialog" aria-modal="true">
        <div class="modal-header">
            <div class="modal-title">Edit Pemesanan</div>
            <div class="modal-close" onclick="closeModal('modalEdit')">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </div>
        </div>
        <div class="modal-body">
            <form method="POST" id="formEdit">
                @csrf @method('PUT')

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Waktu Mulai <span style="color:var(--red)">*</span></label>
                        <input type="datetime-local" name="waktu_mulai" id="edit_waktu_mulai" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Waktu Selesai</label>
                        <input type="datetime-local" name="waktu_selesai" id="edit_waktu_selesai" class="form-control" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Status <span style="color:var(--red)">*</span></label>
                    <select name="status" id="edit_status" class="form-control" required>
                        <option value="menunggu">Menunggu</option>
                        <option value="aktif">Aktif</option>
                        <option value="running">Running</option>
                        <option value="selesai">Selesai</option>
                        <option value="dibatalkan">Dibatalkan</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Catatan</label>
                    <textarea name="catatan" id="edit_catatan" class="form-control" placeholder="Catatan opsional..."></textarea>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-ghost" onclick="closeModal('modalEdit')">Batal</button>
                    <button type="submit" class="btn-primary">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <polyline points="20 6 9 17 4 12"/>
                        </svg>
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
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </div>
        </div>
        <div class="modal-body" style="padding-top:10px">
            <div class="del-icon">
                <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="3 6 5 6 21 6"/>
                    <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
                    <path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4h6v2"/>
                </svg>
            </div>
            <div class="del-title">Hapus Pemesanan?</div>
            <div class="del-sub">
                Kamu akan menghapus pemesanan <strong id="deleteName"></strong>. Tindakan ini tidak bisa dibatalkan.
            </div>
            <form method="POST" id="formDelete" style="margin-top:20px">
                @csrf @method('DELETE')
                <div class="modal-footer" style="border:none;padding-top:0;justify-content:center;gap:10px">
                    <button type="button" class="btn-ghost" onclick="closeModal('modalDelete')" style="min-width:100px">Batal</button>
                    <button type="submit" class="btn-primary" style="background:var(--red);min-width:100px">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <polyline points="3 6 5 6 21 6"/>
                            <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
                        </svg>
                        Ya, Hapus
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
// PARKIFY — PEMESANAN PAGE JS
// ══════════════════════════════════════════

// ── MODAL HELPERS ────────────────────────
function openModal(id)  { document.getElementById(id).classList.add('open');    document.body.style.overflow = 'hidden'; }
function closeModal(id) { document.getElementById(id).classList.remove('open'); document.body.style.overflow = ''; }
function backdropClose(e, id) { if (e.target === document.getElementById(id)) closeModal(id); }

document.addEventListener('keydown', e => {
    if (e.key === 'Escape') ['modalDetail','modalTambah','modalEdit','modalDelete'].forEach(closeModal);
});

// ── STATUS HELPERS ───────────────────────
const STATUS_LABELS = {
    menunggu:   'Menunggu',
    aktif:      'Aktif',
    running:    'Running',
    selesai:    'Selesai',
    dibatalkan: 'Dibatalkan',
};

function makeBadgeHtml(status) {
    return `<span class="status-badge status-${status}">● ${STATUS_LABELS[status] ?? status}</span>`;
}

function formatDatetime(dt) {
    if (!dt) return '–';
    const d = new Date(dt);
    return d.toLocaleDateString('id-ID', { day:'2-digit', month:'short', year:'numeric' })
         + ' ' + d.toLocaleTimeString('id-ID', { hour:'2-digit', minute:'2-digit' });
}

function formatRupiah(n) {
    if (!n || n == 0) return '–';
    if (n >= 1000000) return 'Rp ' + (n/1000000).toFixed(1) + ' jt';
    return 'Rp ' + Number(n).toLocaleString('id-ID');
}

// ── OPEN DETAIL ──────────────────────────
function openDetail(p) {
    document.getElementById('detail_kode').textContent    = p.kode_pemesanan;
    document.getElementById('detail_status_badge').outerHTML =
        `<span id="detail_status_badge" class="status-badge status-${p.status}">● ${STATUS_LABELS[p.status]}</span>`;

    document.getElementById('detail_user_name').textContent  = p.user?.name    ?? '–';
    document.getElementById('detail_user_email').textContent = p.user?.email   ?? '–';
    document.getElementById('detail_plat').textContent       = p.kendaraan?.plat_nomor ?? '–';
    document.getElementById('detail_kendaraan').textContent  = [p.kendaraan?.merek, p.kendaraan?.model, p.kendaraan?.warna].filter(Boolean).join(' ') || '–';

    document.getElementById('detail_slot').textContent       = p.slot_parkir?.kode_slot ?? '–';
    document.getElementById('detail_lokasi').textContent     = p.slot_parkir?.lokasi_parkir?.nama ?? '–';
    document.getElementById('detail_lantai_zona').textContent = [p.slot_parkir?.lantai ? 'Lt.' + p.slot_parkir.lantai : null, p.slot_parkir?.zona ? 'Zona ' + p.slot_parkir.zona : null].filter(Boolean).join(' / ') || '–';
    document.getElementById('detail_jenis_slot').textContent  = p.slot_parkir?.jenis_slot ?? '–';

    document.getElementById('detail_waktu_mulai').textContent  = formatDatetime(p.waktu_mulai);
    document.getElementById('detail_waktu_selesai').textContent = p.waktu_selesai ? formatDatetime(p.waktu_selesai) : 'Belum selesai';
    document.getElementById('detail_durasi').textContent        = p.durasi_parkir ? p.durasi_parkir + ' jam' : '–';
    document.getElementById('detail_total').textContent         = formatRupiah(p.total_harga);

    const catatanWrap = document.getElementById('detail_catatan_wrap');
    if (p.catatan) {
        document.getElementById('detail_catatan').textContent = p.catatan;
        catatanWrap.style.display = 'block';
    } else {
        catatanWrap.style.display = 'none';
    }

    // Quick status form
    const route = `/pemesanan/${p.id}/status`;
    document.getElementById('quickStatusForm').action = route;
    document.getElementById('quickStatusSelect').value = p.status;

    openModal('modalDetail');
}

// ── OPEN EDIT ────────────────────────────
function openEdit(p) {
    // Format datetime-local value: "YYYY-MM-DDTHH:MM"
    function toInputDt(dt) {
        if (!dt) return '';
        return dt.replace(' ', 'T').substring(0, 16);
    }
    document.getElementById('edit_waktu_mulai').value  = toInputDt(p.waktu_mulai);
    document.getElementById('edit_waktu_selesai').value = toInputDt(p.waktu_selesai);
    document.getElementById('edit_status').value        = p.status;
    document.getElementById('edit_catatan').value       = p.catatan ?? '';

    document.getElementById('formEdit').action = `/pemesanan/${p.id}`;
    openModal('modalEdit');
}

// ── OPEN DELETE ──────────────────────────
function openDelete(id, kode) {
    document.getElementById('deleteName').textContent = kode;
    document.getElementById('formDelete').action = `/pemesanan/${id}`;
    openModal('modalDelete');
}

// ── AUTO-DISMISS FLASH ───────────────────
document.querySelectorAll('.flash').forEach(el => {
    setTimeout(() => {
        el.style.transition = 'opacity .4s';
        el.style.opacity    = '0';
        setTimeout(() => el.remove(), 400);
    }, 4000);
});

// ── TOPBAR SEARCH SYNC ───────────────────
const topSearch    = document.getElementById('topbarSearch');
const filterSearch = document.getElementById('filterSearch');
if (topSearch && filterSearch) {
    topSearch.addEventListener('keydown', e => {
        if (e.key === 'Enter') {
            filterSearch.value = topSearch.value;
            document.getElementById('filterForm').submit();
        }
    });
}
</script>
@endsection 