@extends('layouts.admin')

@section('styles')
    <meta name="storage-url" content="{{ rtrim(Storage::url('/'), '/') }}">
    <meta name="pengguna-url" content="{{ url('/pengguna') }}">
    <style>
        /* ══════════════════════════════════════════
       PARKIFY — PENGGUNA PAGE CSS
       Hanya dipakai di halaman kelola pengguna
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
            min-width: 180px;
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

        /* ── USER AVATAR ───────────────────────────────── */
        .uav {
            width: 34px;
            height: 34px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 700;
            font-size: 13px;
            color: #fff;
            flex-shrink: 0;
            overflow: hidden;
        }

        .uav img {
            width: 100%;
            height: 100%;
            object-fit: cover;
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
            max-width: 560px;
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

        .form-control option {
            background: var(--bg-card);
        }

        .form-control.is-invalid {
            border-color: var(--red);
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

        .form-error {
            font-size: 11px;
            color: var(--red);
            margin-top: 4px;
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

        /* ── PASSWORD TOGGLE ───────────────────────────── */
        .pass-wrap {
            position: relative;
        }

        .pass-wrap .form-control {
            padding-right: 38px;
        }

        .pass-eye {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: var(--text-muted);
            background: none;
            border: none;
            padding: 4px;
            display: flex;
            align-items: center;
            transition: color 0.15s;
        }

        .pass-eye:hover {
            color: var(--text-primary);
        }

        /* ── UPLOAD ZONE ───────────────────────────────── */
        .upload-zone {
            border: 2px dashed var(--border);
            border-radius: 11px;
            padding: 14px;
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
            width: 32px;
            height: 32px;
            border-radius: 9px;
            background: var(--blue-soft);
            border: 1px solid var(--blue-pale);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 7px;
            color: var(--blue-main);
        }

        .upload-label {
            font-size: 12px;
            font-weight: 600;
            color: var(--text-primary);
        }

        .upload-sub {
            font-size: 10.5px;
            color: var(--text-muted);
            margin-top: 2px;
        }

        /* ── FOTO PREVIEW ──────────────────────────────── */
        .foto-preview {
            margin-top: 8px;
            display: none;
            position: relative;
        }

        .foto-preview.show {
            display: block;
        }

        .foto-preview img {
            width: 100%;
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid var(--border);
            display: block;
        }

        .foto-remove-btn {
            position: absolute;
            top: 6px;
            right: 6px;
            width: 24px;
            height: 24px;
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

        /* ── RESPONSIVE (pengguna-specific) ────────────── */
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
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2.5">
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

        {{-- Re-open modal on validation error --}}
        @if ($errors->any())
            <div class="flash flash-error">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2.5">
                    <circle cx="12" cy="12" r="10" />
                    <line x1="15" y1="9" x2="9" y2="15" />
                    <line x1="9" y1="9" x2="15" y2="15" />
                </svg>
                {{ $errors->first() }}
            </div>
        @endif

        <div class="page-header">
            <div>
                <div class="page-title">Kelola Pengguna</div>
                <div class="page-sub">{{ number_format($totalPengguna) }} pengguna terdaftar — {{ $aktifHariIni }} aktivitas
                    hari ini</div>
            </div>
            <button class="btn-primary" onclick="openModal('modalTambah')">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2.5">
                    <line x1="12" y1="5" x2="12" y2="19" />
                    <line x1="5" y1="12" x2="19" y2="12" />
                </svg>
                Tambah Pengguna
            </button>
        </div>

        {{-- ── FILTER ── --}}
        <div class="filter-bar">
            <form method="GET" action="{{ route('admin.pengguna.index') }}" id="filterForm" style="display:contents">
                <div class="filter-input">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="var(--text-muted)"
                        stroke-width="2">
                        <circle cx="11" cy="11" r="8" />
                        <line x1="21" y1="21" x2="16.65" y2="16.65" />
                    </svg>
                    <input name="search" placeholder="Cari nama, email, atau nomor telepon..."
                        value="{{ request('search') }}" id="filterSearch" />
                </div>
                <select name="role" class="filter-select" onchange="this.form.submit()">
                    <option value="">Semua Role</option>
                    <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="user" {{ request('role') === 'user' ? 'selected' : '' }}>User</option>
                </select>
                <select name="status" class="filter-select" onchange="this.form.submit()">
                    <option value="">Semua Status</option>
                    <option value="aktif" {{ request('status') === 'aktif' ? 'selected' : '' }}>Terverifikasi</option>
                    <option value="nonaktif" {{ request('status') === 'nonaktif' ? 'selected' : '' }}>Belum Verifikasi
                    </option>
                </select>
                <button type="submit" class="btn-ghost">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.5">
                        <circle cx="11" cy="11" r="8" />
                        <line x1="21" y1="21" x2="16.65" y2="16.65" />
                    </svg>
                    Cari
                </button>
                @if (request('search') || request('role') || request('status'))
                    <a href="{{ route('admin.pengguna.index') }}" class="btn-ghost" style="color:var(--red)">Reset</a>
                @endif
            </form>
        </div>

        {{-- ── TABLE ── --}}
        <div class="card">
            <div class="card-header">
                <span class="card-title">Semua Pengguna</span>
                <span style="font-size:12px;color:var(--text-muted)">{{ $pengguna->total() }} pengguna ditemukan</span>
            </div>
            <div class="table-wrap">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Pengguna</th>
                            <th>Kontak</th>
                            <th>Role</th>
                            <th>Bergabung</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $avatarBg = [
                                '#2563eb',
                                '#7c3aed',
                                '#0891b2',
                                '#059669',
                                '#d97706',
                                '#dc2626',
                                '#9333ea',
                                '#0d9488',
                            ];
                        @endphp
                        @forelse($pengguna as $i => $usr)
                            @php
                                $initials = collect(explode(' ', $usr->name))
                                    ->map(fn($w) => strtoupper($w[0] ?? ''))
                                    ->take(2)
                                    ->implode('');
                                $bg = $avatarBg[$i % count($avatarBg)];
                                $roleBadge = match ($usr->role) {
                                    'admin' => 'b-red',
                                    'operator' => 'b-blue',
                                    default => 'b-gray',
                                };
                                $roleLabel = match ($usr->role) {
                                    'admin' => 'Admin',
                                    'operator' => 'Operator',
                                    default => 'Pengguna',
                                };
                                $isVerified = $usr->sudah_verifikasi;
                            @endphp
                            <tr>
                                <td>
                                    <div style="display:flex;align-items:center;gap:10px">
                                        <div class="uav" style="background:{{ $bg }}">
                                            @if ($usr->foto_profil)
                                                <img src="{{ Storage::url($usr->foto_profil) }}"
                                                    alt="{{ $usr->name }}" />
                                            @else
                                                {{ $initials }}
                                            @endif
                                        </div>
                                        <div>
                                            <div class="cell-primary">{{ $usr->name }}</div>
                                            <div style="font-size:11px;color:var(--text-muted)">ID #{{ $usr->id }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div style="font-size:12px">{{ $usr->email }}</div>
                                    @if ($usr->no_telepon)
                                        <div style="font-size:11px;color:var(--text-muted)">{{ $usr->no_telepon }}</div>
                                    @endif
                                </td>
                                <td><span class="badge {{ $roleBadge }}">{{ $roleLabel }}</span></td>
                                <td style="white-space:nowrap;font-size:12px">{{ $usr->created_at->format('d M Y') }}</td>
                                <td>
                                    @if ($isVerified)
                                        <span class="badge b-green">● Terverifikasi</span>
                                    @else
                                        <span class="badge b-gray">● Belum Verifikasi</span>
                                    @endif
                                </td>
                                <td>
                                    <div style="display:flex;gap:6px">
                                        <button class="btn-ghost"
                                            onclick="openEdit({{ json_encode([
                                                'id' => $usr->id,
                                                'name' => $usr->name,
                                                'email' => $usr->email,
                                                'role' => $usr->role,
                                                'no_telepon' => $usr->no_telepon,
                                                'sudah_verifikasi' => $isVerified,
                                                'foto_profil' => $usr->foto_profil,
                                            ]) }})">
                                            <svg width="11" height="11" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2.5">
                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                                            </svg>
                                            Edit
                                        </button>
                                        <button class="btn-danger"
                                            onclick="openDelete({{ $usr->id }}, '{{ addslashes($usr->name) }}')">
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
                                <td colspan="6" style="text-align:center;padding:32px;color:var(--text-muted)">
                                    Tidak ada pengguna yang ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($pengguna->hasPages())
                <div class="pagination-wrap">
                    <div class="pg-info">
                        Menampilkan {{ $pengguna->firstItem() }}–{{ $pengguna->lastItem() }} dari
                        {{ $pengguna->total() }} pengguna
                    </div>
                    <div class="pagination">
                        @if ($pengguna->onFirstPage())
                            <span class="pg-btn disabled">←</span>
                        @else
                            <a href="{{ $pengguna->previousPageUrl() }}" class="pg-btn">←</a>
                        @endif
                        @foreach ($pengguna->getUrlRange(1, $pengguna->lastPage()) as $page => $url)
                            @if (abs($page - $pengguna->currentPage()) <= 2 || $page === 1 || $page === $pengguna->lastPage())
                                <a href="{{ $url }}"
                                    class="pg-btn {{ $page == $pengguna->currentPage() ? 'active' : '' }}">{{ $page }}</a>
                            @elseif(abs($page - $pengguna->currentPage()) === 3)
                                <span class="pg-btn disabled" style="pointer-events:none">…</span>
                            @endif
                        @endforeach
                        @if ($pengguna->hasMorePages())
                            <a href="{{ $pengguna->nextPageUrl() }}" class="pg-btn">→</a>
                        @else
                            <span class="pg-btn disabled">→</span>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>

    {{-- ═══════════════════════
     MODAL: TAMBAH PENGGUNA
════════════════════════ --}}
    <div class="modal-backdrop" id="modalTambah" onclick="backdropClose(event,'modalTambah')">
        <div class="modal" role="dialog" aria-modal="true">
            <div class="modal-header">
                <div class="modal-title">Tambah Pengguna Baru</div>
                <div class="modal-close" onclick="closeModal('modalTambah')">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.5">
                        <line x1="18" y1="6" x2="6" y2="18" />
                        <line x1="6" y1="6" x2="18" y2="18" />
                    </svg>
                </div>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('admin.pengguna.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="section-divider"><span>Informasi Akun</span></div>

                    <div class="form-group">
                        <label class="form-label">Nama Lengkap <span style="color:var(--red)">*</span></label>
                        <input type="text" name="name" class="form-control" placeholder="cth: Budi Santoso"
                            required value="{{ old('name') }}" />
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Email <span style="color:var(--red)">*</span></label>
                            <input type="email" name="email" class="form-control" placeholder="email@domain.com"
                                required value="{{ old('email') }}" />
                        </div>
                        <div class="form-group">
                            <label class="form-label">No. Telepon</label>
                            <input type="text" name="no_telepon" class="form-control" placeholder="+62 812 ..."
                                value="{{ old('no_telepon') }}" />
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Password <span style="color:var(--red)">*</span></label>
                            <div class="pass-wrap">
                                <input type="password" name="password" id="tambah_pw" class="form-control"
                                    placeholder="Min. 8 karakter" required />
                                <button type="button" class="pass-eye" onclick="togglePw('tambah_pw',this)">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                        <circle cx="12" cy="12" r="3" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Konfirmasi Password <span style="color:var(--red)">*</span></label>
                            <div class="pass-wrap">
                                <input type="password" name="password_confirmation" id="tambah_pw2" class="form-control"
                                    placeholder="Ulangi password" required />
                                <button type="button" class="pass-eye" onclick="togglePw('tambah_pw2',this)">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                        <circle cx="12" cy="12" r="3" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Role <span style="color:var(--red)">*</span></label>
                        <select name="role" class="form-control" required>
                            <option value="user" {{ old('role') === 'user' ? 'selected' : '' }}>User</option>
                            <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                    </div>

                    <div class="section-divider"><span>Foto Profil (Opsional)</span></div>

                    <div class="form-group">
                        <div class="upload-zone" id="tambah_fotoZone" ondragover="zoneOver(event,this)"
                            ondragleave="zoneLeave(this)"
                            ondrop="zoneDrop(event,this,'tambah_foto','tambah_fotoPreview','tambah_fotoImg')">
                            <input type="file" name="foto_profil" id="tambah_foto"
                                accept="image/jpeg,image/jpg,image/png,image/webp"
                                onchange="previewFoto(this,'tambah_fotoPreview','tambah_fotoImg')" />
                            <div class="upload-icon">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="3" width="18" height="18" rx="2" />
                                    <circle cx="8.5" cy="8.5" r="1.5" />
                                    <polyline points="21 15 16 10 5 21" />
                                </svg>
                            </div>
                            <div class="upload-label">Pilih atau seret foto profil</div>
                            <div class="upload-sub">JPG, PNG, WebP · Maks. 4 MB</div>
                        </div>
                        <div class="foto-preview" id="tambah_fotoPreview">
                            <img id="tambah_fotoImg" src="" alt="Preview"
                                style="height:80px;object-fit:cover;border-radius:8px;width:80px;" />
                            <button type="button" class="foto-remove-btn"
                                onclick="removeFoto('tambah_foto','tambah_fotoPreview')" style="top:4px;right:4px">
                                <svg width="11" height="11" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2.5">
                                    <line x1="18" y1="6" x2="6" y2="18" />
                                    <line x1="6" y1="6" x2="18" y2="18" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-check">
                            <input type="checkbox" name="sudah_verifikasi" value="1"
                                {{ old('sudah_verifikasi') ? 'checked' : '' }} />
                            <span class="form-check-label">Tandai email sebagai terverifikasi</span>
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
                            Simpan Pengguna
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════
     MODAL: EDIT PENGGUNA
════════════════════════ --}}
    <div class="modal-backdrop" id="modalEdit" onclick="backdropClose(event,'modalEdit')">
        <div class="modal" role="dialog" aria-modal="true">
            <div class="modal-header">
                <div class="modal-title">Edit Pengguna</div>
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

                    <div class="section-divider"><span>Informasi Akun</span></div>

                    <div class="form-group">
                        <label class="form-label">Nama Lengkap <span style="color:var(--red)">*</span></label>
                        <input type="text" name="name" id="edit_name" class="form-control" required />
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Email <span style="color:var(--red)">*</span></label>
                            <input type="email" name="email" id="edit_email" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label class="form-label">No. Telepon</label>
                            <input type="text" name="no_telepon" id="edit_no_telepon" class="form-control"
                                placeholder="+62 812 ..." />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Role <span style="color:var(--red)">*</span></label>
                        <select name="role" id="edit_role" class="form-control" required>
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>

                    <div class="section-divider"><span>Ganti Password (Opsional)</span></div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Password Baru</label>
                            <div class="pass-wrap">
                                <input type="password" name="password" id="edit_pw" class="form-control"
                                    placeholder="Kosongkan jika tidak diganti" />
                                <button type="button" class="pass-eye" onclick="togglePw('edit_pw',this)">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                        <circle cx="12" cy="12" r="3" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Konfirmasi Password Baru</label>
                            <div class="pass-wrap">
                                <input type="password" name="password_confirmation" id="edit_pw2" class="form-control"
                                    placeholder="Ulangi password baru" />
                                <button type="button" class="pass-eye" onclick="togglePw('edit_pw2',this)">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                        <circle cx="12" cy="12" r="3" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="section-divider"><span>Foto Profil (Opsional)</span></div>

                    <div class="form-group">
                        <div class="upload-zone" id="edit_fotoZone" ondragover="zoneOver(event,this)"
                            ondragleave="zoneLeave(this)"
                            ondrop="zoneDrop(event,this,'edit_foto','edit_fotoPreview','edit_fotoImg')">
                            <input type="file" name="foto_profil" id="edit_foto"
                                accept="image/jpeg,image/jpg,image/png,image/webp"
                                onchange="previewFoto(this,'edit_fotoPreview','edit_fotoImg')" />
                            <div class="upload-icon">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="3" width="18" height="18" rx="2" />
                                    <circle cx="8.5" cy="8.5" r="1.5" />
                                    <polyline points="21 15 16 10 5 21" />
                                </svg>
                            </div>
                            <div class="upload-label">Ganti foto profil atau biarkan</div>
                            <div class="upload-sub">JPG, PNG, WebP · Maks. 4 MB</div>
                        </div>
                        <div class="foto-preview" id="edit_fotoPreview"
                            style="display:flex;align-items:center;gap:10px;margin-top:8px">
                            <img id="edit_fotoImg" src="" alt="Preview"
                                style="width:56px;height:56px;border-radius:10px;object-fit:cover;border:1px solid var(--border);display:none" />
                            <button type="button" class="foto-remove-btn" id="edit_fotoRemoveBtn"
                                onclick="removeEditFoto()" style="position:static;width:28px;height:28px;display:none">
                                <svg width="11" height="11" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2.5">
                                    <line x1="18" y1="6" x2="6" y2="18" />
                                    <line x1="6" y1="6" x2="18" y2="18" />
                                </svg>
                            </button>
                            <span id="edit_fotoName" style="font-size:12px;color:var(--text-muted)"></span>
                        </div>
                        <input type="hidden" name="hapus_foto" id="hapus_foto" value="0" />
                    </div>

                    <div class="form-group">
                        <label class="form-check">
                            <input type="checkbox" name="sudah_verifikasi" id="edit_verifikasi" value="1" />
                            <span class="form-check-label">Tandai email sebagai terverifikasi</span>
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

    {{-- ══════════════════════════
     MODAL: CONFIRM DELETE
══════════════════════════ --}}
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
                <div class="del-title">Hapus Pengguna?</div>
                <div class="del-sub">
                    Kamu akan menghapus akun <strong id="deleteName"></strong>. Semua data terkait termasuk foto profil
                    akan ikut dihapus — tindakan ini tidak bisa dibatalkan.
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
        // PARKIFY — PENGGUNA PAGE JS
        // Hanya dipakai di halaman kelola pengguna
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
            if (e.key === 'Escape')
                ['modalTambah', 'modalEdit', 'modalDelete'].forEach(closeModal);
        });

        // ── PASSWORD TOGGLE ──────────────────────────────
        function togglePw(id, btn) {
            const inp = document.getElementById(id);
            const show = inp.type === 'password';
            inp.type = show ? 'text' : 'password';
            btn.style.color = show ? 'var(--blue-main)' : 'var(--text-muted)';
        }

        // ── FOTO PREVIEW ─────────────────────────────────
        function previewFoto(input, previewId, imgId) {
            const file = input.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = e => {
                const img = document.getElementById(imgId);
                img.src = e.target.result;
                img.style.display = 'block';

                const wrap = document.getElementById(previewId);
                wrap.classList.add('show');

                // Edit modal: show remove button + filename
                const rmBtn = document.getElementById('edit_fotoRemoveBtn');
                if (rmBtn) rmBtn.style.display = 'flex';
                const nm = document.getElementById('edit_fotoName');
                if (nm) nm.textContent = file.name;
            };
            reader.readAsDataURL(file);
        }

        // Remove foto — modal Tambah
        function removeFoto(inputId, previewId) {
            document.getElementById(inputId).value = '';
            document.getElementById(previewId).classList.remove('show');
            document.getElementById(previewId).querySelector('img').src = '';
        }

        // Remove foto — modal Edit
        function removeEditFoto() {
            document.getElementById('edit_foto').value = '';

            const img = document.getElementById('edit_fotoImg');
            img.src = '';
            img.style.display = 'none';

            document.getElementById('edit_fotoRemoveBtn').style.display = 'none';
            document.getElementById('edit_fotoName').textContent = '';
            document.getElementById('hapus_foto').value = '1';
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
        function openEdit(usr) {
            // Reset state
            document.getElementById('hapus_foto').value = '0';
            document.getElementById('edit_foto').value = '';
            document.getElementById('edit_pw').value = '';
            document.getElementById('edit_pw2').value = '';

            // Fill fields
            document.getElementById('edit_name').value = usr.name ?? '';
            document.getElementById('edit_email').value = usr.email ?? '';
            document.getElementById('edit_no_telepon').value = usr.no_telepon ?? '';
            document.getElementById('edit_role').value = usr.role ?? 'pengguna';
            document.getElementById('edit_verifikasi').checked = !!usr.sudah_verifikasi;

            // Foto preview
            const img = document.getElementById('edit_fotoImg');
            const rmBtn = document.getElementById('edit_fotoRemoveBtn');
            const nm = document.getElementById('edit_fotoName');
            const baseUrl = document.querySelector('meta[name="storage-url"]')?.content ?? '';

            if (usr.foto_profil) {
                img.src = baseUrl + '/' + usr.foto_profil;
                img.style.display = 'block';
                rmBtn.style.display = 'flex';
                nm.textContent = 'Foto terpasang';
            } else {
                img.src = '';
                img.style.display = 'none';
                rmBtn.style.display = 'none';
                nm.textContent = '';
            }

            // Set form action
            const baseRoute = document.querySelector('meta[name="pengguna-url"]')?.content ?? '';
            document.getElementById('formEdit').action = `${baseRoute}/${usr.id}`;

            openModal('modalEdit');
        }

        // ── OPEN DELETE ──────────────────────────────────
        function openDelete(id, nama) {
            document.getElementById('deleteName').textContent = nama;
            const baseRoute = document.querySelector('meta[name="pengguna-url"]')?.content ?? '';
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

        // ── AUTO-OPEN MODAL ON VALIDATION ERROR ──────────
        // Blade akan inject ini jika $errors->any():
        // openModal('modalTambah');
    </script>

    @if ($errors->any())
        <script>
            openModal('modalTambah');
        </script>
    @endif
@endsection
