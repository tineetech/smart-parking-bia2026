@extends('layouts.admin')

@section('styles')

    <meta name="storage-url" content="{{ rtrim(Storage::url('/'), '/') }}">
    <meta name="lokasi-url"  content="{{ url('/lokasi') }}">
    <style>
        /* ══════════════════════════════════════════
       PARKIFY — LOKASI PAGE CSS
       Hanya dipakai di halaman kelola lokasi
    ══════════════════════════════════════════ */

        /* ── BUTTONS ───────────────────────────────────── */
        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: var(--blue-main);
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 9px 16px;
            font-size: 12.5px;
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
            transition: background 0.16s, transform 0.15s;
            white-space: nowrap;
        }

        .btn-primary:hover {
            background: var(--blue-bright);
            transform: translateY(-1px);
        }

        .btn-ghost {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: transparent;
            color: var(--text-secondary);
            border: 1px solid var(--border);
            border-radius: 9px;
            padding: 6px 11px;
            font-size: 11.5px;
            font-weight: 500;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
            transition: all 0.16s;
            white-space: nowrap;
            text-decoration: none;
        }

        .btn-ghost:hover {
            border-color: var(--border-focus);
            color: var(--text-primary);
            background: var(--bg-hover);
        }

        .btn-danger {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: transparent;
            color: var(--red);
            border: 1px solid rgba(239, 68, 68, 0.3);
            border-radius: 9px;
            padding: 6px 11px;
            font-size: 11.5px;
            font-weight: 500;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
            transition: all 0.16s;
            white-space: nowrap;
        }

        .btn-danger:hover {
            background: var(--red-soft);
            border-color: var(--red);
        }

        /* ── FILTER BAR ────────────────────────────────── */
        .filter-bar {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 18px;
            flex-wrap: wrap;
        }

        .filter-input {
            display: flex;
            align-items: center;
            gap: 8px;
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 8px 13px;
            flex: 1;
            min-width: 160px;
            box-shadow: var(--shadow-sm);
            transition: border-color 0.16s, box-shadow 0.16s;
        }

        .filter-input:focus-within {
            border-color: var(--border-focus);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .filter-input input {
            background: none;
            border: none;
            outline: none;
            color: var(--text-primary);
            font-size: 12.5px;
            font-family: 'Poppins', sans-serif;
            width: 100%;
        }

        .filter-input input::placeholder {
            color: var(--text-muted);
        }

        .filter-select {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 8px 13px;
            color: var(--text-secondary);
            font-size: 12.5px;
            font-family: 'Poppins', sans-serif;
            outline: none;
            cursor: pointer;
            box-shadow: var(--shadow-sm);
            transition: border-color 0.16s;
        }

        .filter-select:focus {
            border-color: var(--border-focus);
        }

        /* ── LOCATION CARD GRID ────────────────────────── */
        .loc-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 14px;
            margin-bottom: 22px;
        }

        .loc-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 18px 20px;
            box-shadow: var(--shadow-sm);
            transition: border-color 0.2s, box-shadow 0.2s, transform 0.2s, background 0.25s;
        }

        .loc-card:hover {
            border-color: var(--blue-main);
            box-shadow: var(--shadow-md);
            transform: translateY(-2px);
        }

        .loc-head {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 14px;
            gap: 8px;
        }

        .loc-name {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 14.5px;
            font-weight: 700;
        }

        .loc-addr {
            font-size: 11.5px;
            color: var(--text-muted);
            margin-top: 3px;
        }

        .loc-stats {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-top: 12px;
        }

        .ls-label {
            font-size: 10.5px;
            color: var(--text-muted);
        }

        .ls-val {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 19px;
            font-weight: 800;
            margin-top: 2px;
        }

        .loc-bar-row {
            display: flex;
            justify-content: space-between;
            font-size: 11px;
            color: var(--text-secondary);
            margin-bottom: 5px;
            margin-top: 12px;
        }

        /* ── PROGRESS BAR ──────────────────────────────── */
        .prog-bar {
            height: 5px;
            background: var(--bg-input);
            border-radius: 999px;
            overflow: hidden;
        }

        .prog-fill {
            height: 100%;
            border-radius: 999px;
            transition: width 0.5s ease;
        }

        /* ── PAGINATION ────────────────────────────────── */
        .pagination-wrap {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 16px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .pg-info {
            font-size: 12px;
            color: var(--text-muted);
        }

        .pagination {
            display: flex;
            align-items: center;
            gap: 4px;
            flex-wrap: wrap;
        }

        .pg-btn {
            min-width: 31px;
            height: 31px;
            padding: 0 6px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--bg-input);
            border: 1px solid var(--border);
            color: var(--text-secondary);
            font-size: 12.5px;
            cursor: pointer;
            transition: all 0.15s;
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 600;
            text-decoration: none;
        }

        .pg-btn:hover {
            border-color: var(--blue-main);
            color: var(--blue-main);
        }

        .pg-btn.active {
            background: var(--blue-main);
            border-color: var(--blue-main);
            color: #fff;
        }

        .pg-btn.disabled {
            opacity: 0.4;
            pointer-events: none;
        }

        /* ── FLASH ALERT ───────────────────────────────── */
        .flash {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 16px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 16px;
            animation: slideDown 0.25s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .flash-success {
            background: var(--green-soft);
            color: var(--green);
            border: 1px solid rgba(16, 185, 129, 0.3);
        }

        .flash-error {
            background: var(--red-soft);
            color: var(--red);
            border: 1px solid rgba(239, 68, 68, 0.3);
        }

        /* ── MODAL ─────────────────────────────────────── */
        .modal-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(5, 10, 20, 0.55);
            backdrop-filter: blur(4px);
            z-index: 100;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 16px;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.22s;
        }

        .modal-backdrop.open {
            opacity: 1;
            pointer-events: all;
        }

        .modal {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 18px;
            width: 100%;
            max-width: 600px;
            max-height: 92vh;
            overflow-y: auto;
            box-shadow: var(--shadow-lg);
            transform: scale(0.95) translateY(12px);
            transition: transform 0.22s cubic-bezier(.4, 0, .2, 1);
        }

        .modal-backdrop.open .modal {
            transform: scale(1) translateY(0);
        }

        .modal-sm {
            max-width: 380px;
        }

        .modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 24px 0;
            margin-bottom: 16px;
        }

        .modal-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 16px;
            font-weight: 800;
        }

        .modal-close {
            width: 32px;
            height: 32px;
            border-radius: 9px;
            border: 1px solid var(--border);
            background: var(--bg-input);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: var(--text-muted);
            transition: all 0.15s;
            flex-shrink: 0;
        }

        .modal-close:hover {
            border-color: var(--red);
            color: var(--red);
        }

        .modal-body {
            padding: 0 24px 24px;
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            padding-top: 16px;
            border-top: 1px solid var(--border);
            margin-top: 6px;
        }

        /* ── FORM ELEMENTS ─────────────────────────────── */
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }

        .form-group {
            margin-bottom: 14px;
        }

        .form-label {
            display: block;
            font-size: 11.5px;
            font-weight: 600;
            color: var(--text-secondary);
            margin-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .form-control {
            width: 100%;
            background: var(--bg-input);
            border: 1px solid var(--border);
            border-radius: 9px;
            padding: 9px 13px;
            color: var(--text-primary);
            font-size: 13px;
            font-family: 'Poppins', sans-serif;
            outline: none;
            transition: border-color 0.16s, box-shadow 0.16s;
        }

        .form-control:focus {
            border-color: var(--border-focus);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .form-control::placeholder {
            color: var(--text-muted);
        }

        textarea.form-control {
            resize: vertical;
            min-height: 72px;
        }

        .form-hint {
            font-size: 11px;
            color: var(--text-muted);
            margin-top: 4px;
        }

        .form-check {
            display: flex;
            align-items: center;
            gap: 9px;
            cursor: pointer;
        }

        .form-check input[type="checkbox"] {
            width: 16px;
            height: 16px;
            accent-color: var(--blue-main);
            cursor: pointer;
        }

        .form-check-label {
            font-size: 13px;
            color: var(--text-secondary);
        }

        /* ── SECTION DIVIDER ───────────────────────────── */
        .section-divider {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 6px 0 14px;
        }

        .section-divider span {
            font-size: 10.5px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--text-muted);
            white-space: nowrap;
        }

        .section-divider::before,
        .section-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--border);
        }

        /* ── UPLOAD ZONE ───────────────────────────────── */
        .upload-zone {
            border: 2px dashed var(--border);
            border-radius: 11px;
            padding: 18px 16px;
            cursor: pointer;
            transition: border-color 0.18s, background 0.18s;
            text-align: center;
            position: relative;
            background: var(--bg-input);
        }

        .upload-zone:hover,
        .upload-zone.drag-over {
            border-color: var(--blue-main);
            background: var(--blue-soft);
        }

        .upload-zone input[type="file"] {
            position: absolute;
            inset: 0;
            opacity: 0;
            cursor: pointer;
            width: 100%;
            height: 100%;
        }

        .upload-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: var(--blue-soft);
            border: 1px solid var(--blue-pale);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 8px;
            color: var(--blue-main);
        }

        .upload-label {
            font-size: 12.5px;
            font-weight: 600;
            color: var(--text-primary);
        }

        .upload-sub {
            font-size: 11px;
            color: var(--text-muted);
            margin-top: 3px;
        }

        /* ── FOTO PREVIEW ──────────────────────────────── */
        .foto-preview {
            margin-top: 10px;
            display: none;
            position: relative;
        }

        .foto-preview.show {
            display: block;
        }

        .foto-preview img {
            width: 100%;
            height: 130px;
            object-fit: cover;
            border-radius: 9px;
            border: 1px solid var(--border);
            display: block;
        }

        .foto-preview-label {
            position: absolute;
            top: 7px;
            left: 7px;
            background: rgba(0, 0, 0, 0.55);
            color: #fff;
            font-size: 10px;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 5px;
            pointer-events: none;
        }

        .foto-remove-btn {
            position: absolute;
            top: 7px;
            right: 7px;
            width: 26px;
            height: 26px;
            background: rgba(239, 68, 68, 0.85);
            color: #fff;
            border: none;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background 0.15s;
            z-index: 2;
        }

        .foto-remove-btn:hover {
            background: var(--red);
        }

        /* ── DELETE CONFIRM MODAL ──────────────────────── */
        .del-icon {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            background: var(--red-soft);
            color: var(--red);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 14px;
        }

        .del-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 15px;
            font-weight: 800;
            text-align: center;
            margin-bottom: 8px;
        }

        .del-sub {
            font-size: 12.5px;
            color: var(--text-muted);
            text-align: center;
            line-height: 1.6;
        }

        /* ── LIGHTBOX ──────────────────────────────────── */
        #lightbox {
            display: none;
            position: fixed;
            inset: 0;
            z-index: 200;
            background: rgba(0, 0, 0, .82);
            backdrop-filter: blur(6px);
            align-items: center;
            justify-content: center;
            flex-direction: column;
            gap: 12px;
        }

        /* ── RESPONSIVE (lokasi-specific) ──────────────── */
        @media (max-width: 1180px) {
            .loc-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 860px) {
            .loc-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 640px) {
            .filter-bar {
                gap: 8px;
            }

            .filter-select {
                width: 100%;
            }

            .form-row {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endsection

@section('content')

    <div class="content">

        @if (session('success'))
            <div class="flash flash-success">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <polyline points="20 6 9 17 4 12" />
                </svg>
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="flash flash-error">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2.5">
                    <circle cx="12" cy="12" r="10" />
                    <line x1="15" y1="9" x2="9" y2="15" />
                    <line x1="9" y1="9" x2="15" y2="15" />
                </svg>
                {{ session('error') }}
            </div>
        @endif

        <div class="page-header">
            <div>
                <div class="page-title">Kelola Lokasi</div>
                <div class="page-sub">{{ $totalAktif }} dari {{ $totalLokasi }} lokasi aktif di seluruh jaringan</div>
            </div>
            <button class="btn-primary" onclick="openModal('modalTambah')">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2.5">
                    <line x1="12" y1="5" x2="12" y2="19" />
                    <line x1="5" y1="12" x2="19" y2="12" />
                </svg>
                Tambah Lokasi
            </button>
        </div>

        {{-- ── FILTER ── --}}
        <div class="filter-bar">
            <form method="GET" action="{{ route('admin.lokasi.index') }}" id="filterForm" style="display:contents">
                <div class="filter-input">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="var(--text-muted)"
                        stroke-width="2">
                        <circle cx="11" cy="11" r="8" />
                        <line x1="21" y1="21" x2="16.65" y2="16.65" />
                    </svg>
                    <input name="search" placeholder="Cari nama atau alamat lokasi..." value="{{ request('search') }}"
                        id="filterSearch" />
                </div>
                <select name="status" class="filter-select" onchange="this.form.submit()">
                    <option value="">Semua Status</option>
                    <option value="aktif" {{ request('status') === 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="nonaktif" {{ request('status') === 'nonaktif' ? 'selected' : '' }}>Tidak Aktif</option>
                </select>
                <button type="submit" class="btn-ghost">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.5">
                        <circle cx="11" cy="11" r="8" />
                        <line x1="21" y1="21" x2="16.65" y2="16.65" />
                    </svg>
                    Cari
                </button>
                @if (request('search') || request('status'))
                    <a href="{{ route('admin.lokasi.index') }}" class="btn-ghost" style="color:var(--red)">Reset</a>
                @endif
            </form>
        </div>

        {{-- ── TOP 3 CARDS ── --}}
        @if ($topLokasi->count())
            <div class="loc-grid">
                @foreach ($topLokasi as $lok)
                    @php
                        $hunian =
                            $lok->slot_parkir_count > 0
                                ? round(($lok->slot_terisi_count / $lok->slot_parkir_count) * 100)
                                : 0;
                        $barColor = $hunian >= 80 ? 'var(--red)' : ($hunian >= 60 ? 'var(--amber)' : 'var(--green)');
                        $pendapatan = $pendapatanHariIni[$lok->id] ?? 0;
                        $pendapatanLabel =
                            $pendapatan >= 1000000
                                ? round($pendapatan / 1000000, 1) . 'jt'
                                : ($pendapatan >= 1000
                                    ? round($pendapatan / 1000) . 'rb'
                                    : number_format($pendapatan));
                    @endphp
                    <div class="loc-card">
                        <div class="loc-head">
                            <div>
                                <div class="loc-name">{{ $lok->nama }}</div>
                                <div class="loc-addr">{{ Str::limit($lok->alamat, 45) }}</div>
                            </div>
                            <span class="badge {{ $lok->aktif ? 'b-green' : 'b-gray' }}">
                                ● {{ $lok->aktif ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </div>
                        <div class="loc-stats">
                            <div>
                                <div class="ls-label">Kapasitas</div>
                                <div class="ls-val">{{ $lok->total_slot }}</div>
                            </div>
                            <div>
                                <div class="ls-label">Pendapatan/Hari</div>
                                <div class="ls-val" style="font-size:16px">Rp {{ $pendapatanLabel }}</div>
                            </div>
                        </div>
                        <div class="loc-bar-row">
                            <span>Hunian</span>
                            <span style="font-weight:700;color:{{ $barColor }}">{{ $hunian }}%</span>
                        </div>
                        <div class="prog-bar">
                            <div class="prog-fill" style="width:{{ $hunian }}%;background:{{ $barColor }}">
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- ── TABLE ── --}}
        <div class="card">
            <div class="card-header">
                <span class="card-title">Semua Lokasi</span>
                <a href="{{ route('admin.lokasi.index') }}?export=csv" class="card-action">Export CSV</a>
            </div>
            <div class="table-wrap">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Nama Lokasi</th>
                            <th>Kode</th>
                            <th>Alamat</th>
                            <th>Kapasitas</th>
                            <th>Hunian</th>
                            <th>Harga/Jam</th>
                            <th>Jam Operasi</th>
                            <th>Foto</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($lokasis as $lok)
                            @php
                                $hunian =
                                    $lok->slot_parkir_count > 0
                                        ? round(($lok->slot_terisi_count / $lok->slot_parkir_count) * 100)
                                        : 0;
                                $barColor =
                                    $hunian >= 80 ? 'var(--red)' : ($hunian >= 60 ? 'var(--amber)' : 'var(--green)');
                            @endphp
                            <tr>
                                <td><span class="cell-primary">{{ $lok->nama }}</span></td>
                                <td><code
                                        style="font-size:11px;background:var(--bg-input);padding:2px 6px;border-radius:5px;color:var(--text-muted)">{{ $lok->kode_unik }}</code>
                                </td>
                                <td style="max-width:180px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">
                                    {{ $lok->alamat }}</td>
                                <td>{{ number_format($lok->total_slot) }} slot</td>
                                <td>
                                    <div style="display:flex;align-items:center;gap:8px;min-width:100px">
                                        <div style="flex:1">
                                            <div class="prog-bar">
                                                <div class="prog-fill"
                                                    style="width:{{ $hunian }}%;background:{{ $barColor }}">
                                                </div>
                                            </div>
                                        </div>
                                        <span
                                            style="font-size:12px;font-weight:700;color:{{ $barColor }};width:32px;text-align:right">{{ $hunian }}%</span>
                                    </div>
                                </td>
                                <td>Rp {{ number_format($lok->harga_per_jam, 0, ',', '.') }}</td>
                                <td style="white-space:nowrap;font-size:12px">{{ substr($lok->jam_buka, 0, 5) }} –
                                    {{ substr($lok->jam_tutup, 0, 5) }}</td>
                                {{-- Foto thumbnail column --}}
                                <td>
                                    <div style="display:flex;gap:5px;align-items:center">
                                        @if ($lok->foto)
                                            <img src="{{ Storage::url($lok->foto) }}" alt="Foto"
                                                style="width:38px;height:38px;object-fit:cover;border-radius:7px;border:1px solid var(--border);cursor:pointer"
                                                onclick="openLightbox('{{ Storage::url($lok->foto) }}','Foto Lokasi')"
                                                title="Foto Lokasi" />
                                        @else
                                            <div style="width:38px;height:38px;border-radius:7px;background:var(--bg-input);border:1px dashed var(--border);display:flex;align-items:center;justify-content:center"
                                                title="Belum ada foto">
                                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                                    stroke="var(--text-muted)" stroke-width="2">
                                                    <rect x="3" y="3" width="18" height="18" rx="2" />
                                                    <circle cx="8.5" cy="8.5" r="1.5" />
                                                    <polyline points="21 15 16 10 5 21" />
                                                </svg>
                                            </div>
                                        @endif
                                        @if ($lok->foto_360)
                                            <img src="{{ Storage::url($lok->foto_360) }}" alt="360°"
                                                style="width:38px;height:38px;object-fit:cover;border-radius:7px;border:1px solid var(--blue-pale);cursor:pointer"
                                                onclick="openLightbox('{{ Storage::url($lok->foto_360) }}','Foto 360°')"
                                                title="Foto 360°" />
                                        @else
                                            <div style="width:38px;height:38px;border-radius:7px;background:var(--bg-input);border:1px dashed var(--border);display:flex;align-items:center;justify-content:center"
                                                title="Belum ada foto 360°">
                                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                                    stroke="var(--text-muted)" stroke-width="2">
                                                    <circle cx="12" cy="12" r="9" />
                                                    <path
                                                        d="M12 3a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z" />
                                                    <line x1="3" y1="12" x2="21" y2="12" />
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <span class="badge {{ $lok->aktif ? 'b-green' : 'b-gray' }}">
                                        ● {{ $lok->aktif ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </td>
                                <td>
                                    <div style="display:flex;gap:6px;align-items:center">
                                        <button class="btn-ghost" onclick="openEdit({{ json_encode($lok) }})">
                                            <svg width="11" height="11" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2.5">
                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                                            </svg>
                                            Edit
                                        </button>
                                        <button class="btn-danger"
                                            onclick="openDelete({{ $lok->id }}, '{{ addslashes($lok->nama) }}')">
                                            <svg width="11" height="11" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2.5">
                                                <polyline points="3 6 5 6 21 6" />
                                                <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6" />
                                                <path d="M10 11v6" />
                                                <path d="M14 11v6" />
                                            </svg>
                                            Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" style="text-align:center;padding:28px;color:var(--text-muted)">
                                    Tidak ada lokasi yang ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($lokasis->hasPages())
                <div class="pagination-wrap">
                    <div class="pg-info">
                        Menampilkan {{ $lokasis->firstItem() }}–{{ $lokasis->lastItem() }} dari {{ $lokasis->total() }}
                        lokasi
                    </div>
                    <div class="pagination">
                        @if ($lokasis->onFirstPage())
                            <span class="pg-btn disabled">←</span>
                        @else
                            <a href="{{ $lokasis->previousPageUrl() }}" class="pg-btn">←</a>
                        @endif
                        @foreach ($lokasis->getUrlRange(1, $lokasis->lastPage()) as $page => $url)
                            @if (abs($page - $lokasis->currentPage()) <= 2 || $page === 1 || $page === $lokasis->lastPage())
                                <a href="{{ $url }}"
                                    class="pg-btn {{ $page == $lokasis->currentPage() ? 'active' : '' }}">{{ $page }}</a>
                            @elseif(abs($page - $lokasis->currentPage()) === 3)
                                <span class="pg-btn disabled" style="pointer-events:none">…</span>
                            @endif
                        @endforeach
                        @if ($lokasis->hasMorePages())
                            <a href="{{ $lokasis->nextPageUrl() }}" class="pg-btn">→</a>
                        @else
                            <span class="pg-btn disabled">→</span>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>


    {{-- ═══════════════════════════════════════════════════
     LIGHTBOX
════════════════════════════════════════════════════ --}}
    <div id="lightbox"
        style="display:none;position:fixed;inset:0;z-index:200;background:rgba(0,0,0,.82);backdrop-filter:blur(6px);align-items:center;justify-content:center;flex-direction:column;gap:12px"
        onclick="closeLightbox()">
        <div style="font-size:12px;font-weight:600;color:rgba(255,255,255,.65);letter-spacing:.06em;text-transform:uppercase"
            id="lightboxLabel"></div>
        <img id="lightboxImg" src="" alt=""
            style="max-width:90vw;max-height:80vh;border-radius:12px;box-shadow:0 20px 60px rgba(0,0,0,.6);object-fit:contain" />
        <div style="font-size:11.5px;color:rgba(255,255,255,.4)">Klik di mana saja untuk menutup</div>
    </div>

    {{-- ═══════════════════════════════════════════════════
     MODAL: TAMBAH LOKASI
════════════════════════════════════════════════════ --}}
    <div class="modal-backdrop" id="modalTambah" onclick="backdropClose(event,'modalTambah')">
        <div class="modal" role="dialog" aria-modal="true">
            <div class="modal-header">
                <div class="modal-title">Tambah Lokasi Baru</div>
                <div class="modal-close" onclick="closeModal('modalTambah')">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.5">
                        <line x1="18" y1="6" x2="6" y2="18" />
                        <line x1="6" y1="6" x2="18" y2="18" />
                    </svg>
                </div>
            </div>
            <div class="modal-body">
                {{-- enctype wajib untuk upload file --}}
                <form method="POST" action="{{ route('admin.lokasi.store') }}" id="formTambah"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label class="form-label">Nama Lokasi <span style="color:var(--red)">*</span></label>
                        <input type="text" name="nama" class="form-control" placeholder="cth: Grand Mall Jakarta"
                            required />
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Latitude <span style="color:var(--red)">*</span></label>
                            <input type="number" name="latitude" step="any" class="form-control"
                                placeholder="-6.200000" required />
                        </div>
                        <div class="form-group">
                            <label class="form-label">Longitude <span style="color:var(--red)">*</span></label>
                            <input type="number" name="longitude" step="any" class="form-control"
                                placeholder="106.816666" required />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Alamat <span style="color:var(--red)">*</span></label>
                        <textarea name="alamat" class="form-control" placeholder="Jl. Nama Jalan No.1, Kota" required></textarea>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">No. Telepon</label>
                            <input type="text" name="kontak_no_telepon" class="form-control"
                                placeholder="021-XXXXXXXX" />
                        </div>
                        <div class="form-group">
                            <label class="form-label">Total Slot <span style="color:var(--red)">*</span></label>
                            <input type="number" name="total_slot" class="form-control" placeholder="100"
                                min="1" required />
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Harga per Jam (Rp) <span style="color:var(--red)">*</span></label>
                            <input type="number" name="harga_per_jam" class="form-control" placeholder="5000"
                                min="0" required />
                        </div>
                        <div class="form-group" style="display:flex;gap:10px">
                            <div style="flex:1">
                                <label class="form-label">Jam Buka <span style="color:var(--red)">*</span></label>
                                <input type="time" name="jam_buka" class="form-control" value="07:00" required />
                            </div>
                            <div style="flex:1">
                                <label class="form-label">Jam Tutup <span style="color:var(--red)">*</span></label>
                                <input type="time" name="jam_tutup" class="form-control" value="22:00" required />
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" placeholder="Deskripsi singkat lokasi parkir..."></textarea>
                    </div>

                    {{-- ── FOTO SECTION ── --}}
                    <div class="section-divider"><span>Foto Lokasi (Opsional)</span></div>

                    <div class="form-row">
                        {{-- Foto Utama --}}
                        <div class="form-group" style="margin-bottom:0">
                            <label class="form-label">Foto Utama</label>
                            <div class="upload-zone" id="tambah_fotoZone" ondragover="zoneOver(event,this)"
                                ondragleave="zoneLeave(this)"
                                ondrop="zoneDrop(event,this,'tambah_foto','tambah_fotoPreview','tambah_fotoImg')">
                                <input type="file" name="foto" id="tambah_foto"
                                    accept="image/jpeg,image/jpg,image/png,image/webp"
                                    onchange="previewFoto(this,'tambah_fotoPreview','tambah_fotoImg')" />
                                <div class="upload-icon">
                                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <rect x="3" y="3" width="18" height="18" rx="2" />
                                        <circle cx="8.5" cy="8.5" r="1.5" />
                                        <polyline points="21 15 16 10 5 21" />
                                    </svg>
                                </div>
                                <div class="upload-label">Pilih atau seret foto</div>
                                <div class="upload-sub">JPG, PNG, WebP · Maks. 4 MB</div>
                            </div>
                            <div class="foto-preview" id="tambah_fotoPreview">
                                <img id="tambah_fotoImg" src="" alt="Preview" />
                                <span class="foto-preview-label">Foto Utama</span>
                                <button type="button" class="foto-remove-btn"
                                    onclick="removeFoto('tambah_foto','tambah_fotoPreview')">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2.5">
                                        <line x1="18" y1="6" x2="6" y2="18" />
                                        <line x1="6" y1="6" x2="18" y2="18" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        {{-- Foto 360° --}}
                        <div class="form-group" style="margin-bottom:0">
                            <label class="form-label">Foto 360°</label>
                            <div class="upload-zone" id="tambah_foto360Zone" ondragover="zoneOver(event,this)"
                                ondragleave="zoneLeave(this)"
                                ondrop="zoneDrop(event,this,'tambah_foto360','tambah_foto360Preview','tambah_foto360Img')">
                                <input type="file" name="foto_360" id="tambah_foto360"
                                    accept="image/jpeg,image/jpg,image/png,image/webp"
                                    onchange="previewFoto(this,'tambah_foto360Preview','tambah_foto360Img')" />
                                <div class="upload-icon"
                                    style="background:var(--purple-soft);border-color:rgba(139,92,246,.2);color:var(--purple)">
                                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <circle cx="12" cy="12" r="9" />
                                        <path
                                            d="M12 3a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z" />
                                        <line x1="3" y1="12" x2="21" y2="12" />
                                    </svg>
                                </div>
                                <div class="upload-label">Pilih atau seret foto 360°</div>
                                <div class="upload-sub">JPG, PNG, WebP · Maks. 8 MB</div>
                            </div>
                            <div class="foto-preview" id="tambah_foto360Preview">
                                <img id="tambah_foto360Img" src="" alt="Preview 360°" />
                                <span class="foto-preview-label">Foto 360°</span>
                                <button type="button" class="foto-remove-btn"
                                    onclick="removeFoto('tambah_foto360','tambah_foto360Preview')">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2.5">
                                        <line x1="18" y1="6" x2="6" y2="18" />
                                        <line x1="6" y1="6" x2="18" y2="18" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div style="margin-top:14px" class="form-group">
                        <label class="form-check">
                            <input type="checkbox" name="aktif" value="1" checked />
                            <span class="form-check-label">Aktifkan lokasi ini sekarang</span>
                        </label>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn-ghost" onclick="closeModal('modalTambah')">Batal</button>
                        <button type="submit" class="btn-primary">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2.5">
                                <line x1="12" y1="5" x2="12" y2="19" />
                                <line x1="5" y1="12" x2="19" y2="12" />
                            </svg>
                            Simpan Lokasi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════════
     MODAL: EDIT LOKASI
════════════════════════════════════════════════════ --}}
    <div class="modal-backdrop" id="modalEdit" onclick="backdropClose(event,'modalEdit')">
        <div class="modal" role="dialog" aria-modal="true">
            <div class="modal-header">
                <div class="modal-title">Edit Lokasi</div>
                <div class="modal-close" onclick="closeModal('modalEdit')">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.5">
                        <line x1="18" y1="6" x2="6" y2="18" />
                        <line x1="6" y1="6" x2="18" y2="18" />
                    </svg>
                </div>
            </div>
            <div class="modal-body">
                <form method="POST" id="formEdit" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label class="form-label">Nama Lokasi <span style="color:var(--red)">*</span></label>
                        <input type="text" name="nama" id="edit_nama" class="form-control" required />
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Latitude <span style="color:var(--red)">*</span></label>
                            <input type="number" name="latitude" id="edit_latitude" step="any"
                                class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label class="form-label">Longitude <span style="color:var(--red)">*</span></label>
                            <input type="number" name="longitude" id="edit_longitude" step="any"
                                class="form-control" required />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Alamat <span style="color:var(--red)">*</span></label>
                        <textarea name="alamat" id="edit_alamat" class="form-control" required></textarea>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">No. Telepon</label>
                            <input type="text" name="kontak_no_telepon" id="edit_kontak" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label class="form-label">Total Slot <span style="color:var(--red)">*</span></label>
                            <input type="number" name="total_slot" id="edit_total_slot" class="form-control"
                                min="1" required />
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Harga per Jam (Rp) <span style="color:var(--red)">*</span></label>
                            <input type="number" name="harga_per_jam" id="edit_harga" class="form-control"
                                min="0" required />
                        </div>
                        <div class="form-group" style="display:flex;gap:10px">
                            <div style="flex:1">
                                <label class="form-label">Jam Buka <span style="color:var(--red)">*</span></label>
                                <input type="time" name="jam_buka" id="edit_jam_buka" class="form-control"
                                    required />
                            </div>
                            <div style="flex:1">
                                <label class="form-label">Jam Tutup <span style="color:var(--red)">*</span></label>
                                <input type="time" name="jam_tutup" id="edit_jam_tutup" class="form-control"
                                    required />
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" id="edit_deskripsi" class="form-control"></textarea>
                    </div>

                    {{-- ── FOTO SECTION (EDIT) ── --}}
                    <div class="section-divider"><span>Foto Lokasi (Opsional)</span></div>

                    <div class="form-row">
                        {{-- Foto Utama --}}
                        <div class="form-group" style="margin-bottom:0">
                            <label class="form-label">Foto Utama</label>
                            <div class="upload-zone" id="edit_fotoZone" ondragover="zoneOver(event,this)"
                                ondragleave="zoneLeave(this)"
                                ondrop="zoneDrop(event,this,'edit_foto','edit_fotoPreview','edit_fotoImg')">
                                <input type="file" name="foto" id="edit_foto"
                                    accept="image/jpeg,image/jpg,image/png,image/webp"
                                    onchange="previewFoto(this,'edit_fotoPreview','edit_fotoImg')" />
                                <div class="upload-icon">
                                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <rect x="3" y="3" width="18" height="18" rx="2" />
                                        <circle cx="8.5" cy="8.5" r="1.5" />
                                        <polyline points="21 15 16 10 5 21" />
                                    </svg>
                                </div>
                                <div class="upload-label" id="edit_fotoLabel">Ganti foto atau biarkan</div>
                                <div class="upload-sub">JPG, PNG, WebP · Maks. 4 MB</div>
                            </div>
                            {{-- Preview foto existing / baru --}}
                            <div class="foto-preview" id="edit_fotoPreview">
                                <img id="edit_fotoImg" src="" alt="Preview" />
                                <span class="foto-preview-label">Foto Utama</span>
                                <button type="button" class="foto-remove-btn"
                                    onclick="removeEditFoto('edit_foto','edit_fotoPreview','hapus_foto')">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2.5">
                                        <line x1="18" y1="6" x2="6" y2="18" />
                                        <line x1="6" y1="6" x2="18" y2="18" />
                                    </svg>
                                </button>
                            </div>
                            {{-- Hidden flag hapus foto --}}
                            <input type="hidden" name="hapus_foto" id="hapus_foto" value="0" />
                        </div>

                        {{-- Foto 360° --}}
                        <div class="form-group" style="margin-bottom:0">
                            <label class="form-label">Foto 360°</label>
                            <div class="upload-zone" id="edit_foto360Zone" ondragover="zoneOver(event,this)"
                                ondragleave="zoneLeave(this)"
                                ondrop="zoneDrop(event,this,'edit_foto360','edit_foto360Preview','edit_foto360Img')">
                                <input type="file" name="foto_360" id="edit_foto360"
                                    accept="image/jpeg,image/jpg,image/png,image/webp"
                                    onchange="previewFoto(this,'edit_foto360Preview','edit_foto360Img')" />
                                <div class="upload-icon"
                                    style="background:var(--purple-soft);border-color:rgba(139,92,246,.2);color:var(--purple)">
                                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <circle cx="12" cy="12" r="9" />
                                        <path
                                            d="M12 3a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z" />
                                        <line x1="3" y1="12" x2="21" y2="12" />
                                    </svg>
                                </div>
                                <div class="upload-label" id="edit_foto360Label">Ganti foto 360° atau biarkan</div>
                                <div class="upload-sub">JPG, PNG, WebP · Maks. 8 MB</div>
                            </div>
                            <div class="foto-preview" id="edit_foto360Preview">
                                <img id="edit_foto360Img" src="" alt="Preview 360°" />
                                <span class="foto-preview-label">Foto 360°</span>
                                <button type="button" class="foto-remove-btn"
                                    onclick="removeEditFoto('edit_foto360','edit_foto360Preview','hapus_foto_360')">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2.5">
                                        <line x1="18" y1="6" x2="6" y2="18" />
                                        <line x1="6" y1="6" x2="18" y2="18" />
                                    </svg>
                                </button>
                            </div>
                            <input type="hidden" name="hapus_foto_360" id="hapus_foto_360" value="0" />
                        </div>
                    </div>

                    <div style="margin-top:14px" class="form-group">
                        <label class="form-check">
                            <input type="checkbox" name="aktif" id="edit_aktif" value="1" />
                            <span class="form-check-label">Lokasi aktif</span>
                        </label>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn-ghost" onclick="closeModal('modalEdit')">Batal</button>
                        <button type="submit" class="btn-primary">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2.5">
                                <polyline points="20 6 9 17 4 12" />
                            </svg>
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════════
     MODAL: CONFIRM DELETE
════════════════════════════════════════════════════ --}}
    <div class="modal-backdrop" id="modalDelete" onclick="backdropClose(event,'modalDelete')">
        <div class="modal modal-sm" role="dialog" aria-modal="true">
            <div class="modal-header" style="padding-bottom:0;margin-bottom:0;border:none">
                <div></div>
                <div class="modal-close" onclick="closeModal('modalDelete')">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.5">
                        <line x1="18" y1="6" x2="6" y2="18" />
                        <line x1="6" y1="6" x2="18" y2="18" />
                    </svg>
                </div>
            </div>
            <div class="modal-body" style="padding-top:10px">
                <div class="del-icon">
                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2">
                        <polyline points="3 6 5 6 21 6" />
                        <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6" />
                        <path d="M10 11v6" />
                        <path d="M14 11v6" />
                        <path d="M9 6V4h6v2" />
                    </svg>
                </div>
                <div class="del-title">Hapus Lokasi?</div>
                <div class="del-sub">
                    Kamu akan menghapus lokasi <strong id="deleteName"></strong>. Tindakan ini akan menghapus semua slot,
                    foto, dan data terkait — tidak bisa dibatalkan.
                </div>
                <form method="POST" id="formDelete" style="margin-top:20px">
                    @csrf
                    @method('DELETE')
                    <div class="modal-footer" style="border:none;padding-top:0;justify-content:center;gap:10px">
                        <button type="button" class="btn-ghost" onclick="closeModal('modalDelete')"
                            style="min-width:100px">Batal</button>
                        <button type="submit" class="btn-primary" style="background:var(--red);min-width:100px">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2.5">
                                <polyline points="3 6 5 6 21 6" />
                                <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6" />
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
        // PARKIFY — LOKASI PAGE JS
        // Hanya dipakai di halaman kelola lokasi
        // Depends on: global JS (toggleTheme, toggleSidebar, closeSidebar)
        // ══════════════════════════════════════════

        // ── MODAL HELPERS ────────────────────────────────
        function openModal(id) {
            document.getElementById(id).classList.add('open');
            document.body.style.overflow = 'hidden';
        }

        function closeModal(id) {
            document.getElementById(id).classList.remove('open');
            document.body.style.overflow = '';
        }

        function backdropClose(e, id) {
            if (e.target === document.getElementById(id)) closeModal(id);
        }
        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') {
                ['modalTambah', 'modalEdit', 'modalDelete'].forEach(closeModal);
                closeLightbox();
            }
        });

        // ── FOTO PREVIEW ─────────────────────────────────
        function previewFoto(input, previewId, imgId) {
            const file = input.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = e => {
                document.getElementById(imgId).src = e.target.result;
                document.getElementById(previewId).classList.add('show');
            };
            reader.readAsDataURL(file);
        }

        // Remove foto — modal Tambah
        function removeFoto(inputId, previewId) {
            document.getElementById(inputId).value = '';
            document.getElementById(previewId).classList.remove('show');
            document.getElementById(previewId).querySelector('img').src = '';
        }

        // Remove foto — modal Edit (set hapus flag)
        function removeEditFoto(inputId, previewId, flagId) {
            document.getElementById(inputId).value = '';
            document.getElementById(previewId).classList.remove('show');
            document.getElementById(previewId).querySelector('img').src = '';
            document.getElementById(flagId).value = '1';
        }

        // ── DRAG & DROP ──────────────────────────────────
        function zoneOver(e, zone) {
            e.preventDefault();
            zone.classList.add('drag-over');
        }

        function zoneLeave(zone) {
            zone.classList.remove('drag-over');
        }

        function zoneDrop(e, zone, inputId, previewId, imgId) {
            e.preventDefault();
            zone.classList.remove('drag-over');
            const file = e.dataTransfer.files[0];
            if (!file || !file.type.startsWith('image/')) return;
            const dt = new DataTransfer();
            dt.items.add(file);
            const input = document.getElementById(inputId);
            input.files = dt.files;
            previewFoto(input, previewId, imgId);
        }

        // ── OPEN EDIT ────────────────────────────────────
        function openEdit(lok) {
            // Reset hapus flags
            document.getElementById('hapus_foto').value = '0';
            document.getElementById('hapus_foto_360').value = '0';

            // Fill text fields
            document.getElementById('edit_nama').value = lok.nama ?? '';
            document.getElementById('edit_alamat').value = lok.alamat ?? '';
            document.getElementById('edit_latitude').value = lok.latitude ?? '';
            document.getElementById('edit_longitude').value = lok.longitude ?? '';
            document.getElementById('edit_kontak').value = lok.kontak_no_telepon ?? '';
            document.getElementById('edit_total_slot').value = lok.total_slot ?? '';
            document.getElementById('edit_harga').value = lok.harga_per_jam ?? '';
            document.getElementById('edit_jam_buka').value = lok.jam_buka ? lok.jam_buka.substring(0, 5) : '';
            document.getElementById('edit_jam_tutup').value = lok.jam_tutup ? lok.jam_tutup.substring(0, 5) : '';
            document.getElementById('edit_deskripsi').value = lok.deskripsi ?? '';
            document.getElementById('edit_aktif').checked = !!lok.aktif;

            // Reset file inputs
            document.getElementById('edit_foto').value = '';
            document.getElementById('edit_foto360').value = '';

            // Show existing foto previews
            const baseUrl = document.querySelector('meta[name="storage-url"]')?.content ?? '';
            const fotoPreview = document.getElementById('edit_fotoPreview');
            const foto360Preview = document.getElementById('edit_foto360Preview');

            if (lok.foto) {
                document.getElementById('edit_fotoImg').src = baseUrl + '/' + lok.foto;
                fotoPreview.classList.add('show');
            } else {
                fotoPreview.classList.remove('show');
                document.getElementById('edit_fotoImg').src = '';
            }

            if (lok.foto_360) {
                document.getElementById('edit_foto360Img').src = baseUrl + '/' + lok.foto_360;
                foto360Preview.classList.add('show');
            } else {
                foto360Preview.classList.remove('show');
                document.getElementById('edit_foto360Img').src = '';
            }

            // Set form action
            const baseRoute = document.querySelector('meta[name="lokasi-url"]')?.content ?? '';
            document.getElementById('formEdit').action = `${baseRoute}/${lok.id}`;

            openModal('modalEdit');
        }

        // ── OPEN DELETE ──────────────────────────────────
        function openDelete(id, nama) {
            document.getElementById('deleteName').textContent = nama;
            const baseRoute = document.querySelector('meta[name="lokasi-url"]')?.content ?? '';
            document.getElementById('formDelete').action = `${baseRoute}/${id}`;
            openModal('modalDelete');
        }

        // ── TOPBAR SEARCH ─────────────────────────────────
        const topSearch = document.getElementById('topbarSearch');
        const filterSearch = document.getElementById('filterSearch');
        if (topSearch && filterSearch) {
            topSearch.addEventListener('keydown', e => {
                if (e.key === 'Enter') {
                    filterSearch.value = topSearch.value;
                    document.getElementById('filterForm').submit();
                }
            });
        }

        // ── AUTO-DISMISS FLASH ────────────────────────────
        document.querySelectorAll('.flash').forEach(el => {
            setTimeout(() => {
                el.style.transition = 'opacity 0.4s';
                el.style.opacity = '0';
                setTimeout(() => el.remove(), 400);
            }, 4000);
        });

        // ── LIGHTBOX ─────────────────────────────────────
        function openLightbox(src, label) {
            const lb = document.getElementById('lightbox');
            document.getElementById('lightboxImg').src = src;
            document.getElementById('lightboxLabel').textContent = label;
            lb.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }

        function closeLightbox() {
            document.getElementById('lightbox').style.display = 'none';
            document.body.style.overflow = '';
        }
    </script>
@endsection
