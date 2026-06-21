@extends('layouts.admin')

@section('styles')
    <style>
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
        .btn-primary-outline {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: transparent;
            color: var(--blue-main);
            border: 1px solid var(--blue-pale);
            border-radius: 10px;
            padding: 9px 16px;
            font-size: 12.5px;
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
            transition: all 0.16s;
            white-space: nowrap;
        }
        .btn-primary-outline:hover {
            background: var(--blue-soft);
            border-color: var(--blue-main);
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
        .notif-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 3px 9px;
            border-radius: 999px;
            font-size: 10.5px;
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
            white-space: nowrap;
        }
        .notif-badge.belum {
            background: var(--blue-soft);
            color: var(--blue-main);
        }
        .notif-badge.dibaca {
            background: var(--bg-input);
            color: var(--text-muted);
        }
        .notif-pesan {
            max-width: 300px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            font-size: 12px;
        }
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
            from { opacity: 0; transform: translateY(-8px); }
            to   { opacity: 1; transform: translateY(0); }
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
        .jenis-label {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 2px 8px;
            border-radius: 6px;
            font-size: 10.5px;
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
        }
        .jenis-label.pemesanan  { background: var(--blue-soft);   color: var(--blue-main); }
        .jenis-label.pembayaran { background: var(--green-soft);  color: var(--green);     }
        .jenis-label.sistem     { background: var(--purple-soft); color: var(--purple);    }
        .jenis-label.promo      { background: var(--amber-soft);  color: var(--amber);     }
        .form-group { margin-bottom: 14px; }
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
        .form-control::placeholder { color: var(--text-muted); }
        .form-control option { background: var(--bg-card); }
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
        textarea.form-control { resize: vertical; }
        @media (max-width: 640px) {
            .filter-bar { gap: 8px; }
            .filter-select { width: 100%; }
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

        <div class="page-header">
            <div>
                <div class="page-title">Kelola Notifikasi</div>
                <div class="page-sub">{{ number_format($totalNotifikasi) }} notifikasi — {{ $belumDibaca }} belum dibaca</div>
            </div>
            <div style="display:flex;gap:10px;flex-wrap:wrap">
                <button class="btn-primary" onclick="openModal('modalTambah')">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.5">
                        <line x1="12" y1="5" x2="12" y2="19" />
                        <line x1="5" y1="12" x2="19" y2="12" />
                    </svg>
                    Kirim Notifikasi
                </button>
                @if ($belumDibaca > 0)
                    <form method="POST" action="{{ route('admin.notifikasi.markAllAsRead') }}" style="display:inline">
                        @csrf
                        <button type="submit" class="btn-primary-outline">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2.5">
                                <polyline points="20 6 9 17 4 12" />
                            </svg>
                            Tandai Semua Dibaca
                        </button>
                    </form>
                @endif
            </div>
        </div>

        {{-- ── FILTER ── --}}
        <div class="filter-bar">
            <form method="GET" action="{{ route('admin.notifikasi.index') }}" id="filterForm" style="display:contents">
                <div class="filter-input">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="var(--text-muted)"
                        stroke-width="2">
                        <circle cx="11" cy="11" r="8" />
                        <line x1="21" y1="21" x2="16.65" y2="16.65" />
                    </svg>
                    <input name="search" placeholder="Cari judul atau pesan notifikasi..."
                        value="{{ request('search') }}" id="filterSearch" />
                </div>
                <select name="jenis" class="filter-select" onchange="this.form.submit()">
                    <option value="">Semua Jenis</option>
                    <option value="pemesanan" {{ request('jenis') === 'pemesanan' ? 'selected' : '' }}>Pemesanan</option>
                    <option value="pembayaran" {{ request('jenis') === 'pembayaran' ? 'selected' : '' }}>Pembayaran</option>
                    <option value="sistem" {{ request('jenis') === 'sistem' ? 'selected' : '' }}>Sistem</option>
                    <option value="promo" {{ request('jenis') === 'promo' ? 'selected' : '' }}>Promo</option>
                </select>
                <select name="status" class="filter-select" onchange="this.form.submit()">
                    <option value="">Semua Status</option>
                    <option value="belum" {{ request('status') === 'belum' ? 'selected' : '' }}>Belum Dibaca</option>
                    <option value="dibaca" {{ request('status') === 'dibaca' ? 'selected' : '' }}>Sudah Dibaca</option>
                </select>
                <button type="submit" class="btn-ghost">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.5">
                        <circle cx="11" cy="11" r="8" />
                        <line x1="21" y1="21" x2="16.65" y2="16.65" />
                    </svg>
                    Cari
                </button>
                @if (request('search') || request('jenis') || request('status'))
                    <a href="{{ route('admin.notifikasi.index') }}" class="btn-ghost" style="color:var(--red)">Reset</a>
                @endif
            </form>
        </div>

        {{-- ── TABLE ── --}}
        <div class="card">
            <div class="card-header">
                <span class="card-title">Semua Notifikasi</span>
                <span style="font-size:12px;color:var(--text-muted)">{{ $notifikasi->total() }} notifikasi ditemukan</span>
            </div>
            <div class="table-wrap">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Penerima</th>
                            <th>Notifikasi</th>
                            <th>Jenis</th>
                            <th>Status</th>
                            <th>Waktu</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $avatarBg = [
                                '#2563eb', '#7c3aed', '#0891b2', '#059669',
                                '#d97706', '#dc2626', '#9333ea', '#0d9488',
                            ];
                            $jenisLabel = [
                                'pemesanan' => 'Pemesanan',
                                'pembayaran' => 'Pembayaran',
                                'sistem' => 'Sistem',
                                'promo' => 'Promo',
                            ];
                        @endphp
                        @forelse($notifikasi as $i => $notif)
                            @php
                                $user = $notif->user;
                                $initials = $user ? collect(explode(' ', $user->name))
                                    ->map(fn($w) => strtoupper($w[0] ?? ''))
                                    ->take(2)
                                    ->implode('') : '--';
                                $bg = $avatarBg[$i % count($avatarBg)];
                                $isRead = $notif->sudah_dibaca;
                            @endphp
                            <tr style="{{ !$isRead ? 'background:var(--blue-soft)' : '' }}">
                                <td>
                                    <div style="display:flex;align-items:center;gap:10px">
                                        <div class="uav" style="background:{{ $bg }}">
                                            @if ($user && $user->foto_profil_url)
                                                <img src="{{ $user->foto_profil_url }}"
                                                    alt="{{ $user->name }}" />
                                            @else
                                                {{ $initials }}
                                            @endif
                                        </div>
                                        <div>
                                            <div class="cell-primary" style="font-size:12px">{{ $user ? $user->name : 'System' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="cell-primary" style="font-size:12px;{{ !$isRead ? 'font-weight:700' : '' }}">
                                        {{ $notif->judul }}
                                    </div>
                                    <div class="notif-pesan">{{ $notif->pesan }}</div>
                                </td>
                                <td>
                                    <span class="jenis-label {{ $notif->jenis }}">
                                        {{ $jenisLabel[$notif->jenis] ?? $notif->jenis }}
                                    </span>
                                </td>
                                <td>
                                    @if ($isRead)
                                        <span class="notif-badge dibaca">Dibaca</span>
                                    @else
                                        <span class="notif-badge belum">● Belum Dibaca</span>
                                    @endif
                                </td>
                                <td style="white-space:nowrap;font-size:11px">
                                    {{ $notif->created_at->format('d M Y H:i') }}
                                </td>
                                <td>
                                    <div style="display:flex;gap:6px;flex-wrap:nowrap">
                                        <button class="btn-ghost"
                                            onclick="openEdit({{ json_encode([
                                                'id' => $notif->id,
                                                'user_id' => $notif->user_id,
                                                'judul' => $notif->judul,
                                                'pesan' => $notif->pesan,
                                                'jenis' => $notif->jenis,
                                                'sudah_dibaca' => $isRead,
                                            ]) }})" style="font-size:10.5px;padding:5px 9px">
                                            <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                                            </svg>
                                            Edit
                                        </button>
                                        @if (!$isRead)
                                            <form method="POST" action="{{ route('admin.notifikasi.markAsRead', $notif) }}" style="display:inline">
                                                @csrf
                                                <button type="submit" class="btn-ghost" style="font-size:10.5px;padding:5px 9px">
                                                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                                        <polyline points="20 6 9 17 4 12" />
                                                    </svg>
                                                    Baca
                                                </button>
                                            </form>
                                        @endif
                                        <button class="btn-danger"
                                            onclick="openDelete({{ $notif->id }})" style="font-size:10.5px;padding:5px 9px">
                                            <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2.5">
                                                <polyline points="3 6 5 6 21 6" />
                                                <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6" />
                                            </svg>
                                            Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" style="text-align:center;padding:32px;color:var(--text-muted)">
                                    Tidak ada notifikasi yang ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($notifikasi->hasPages())
                <div class="pagination-wrap">
                    <div class="pg-info">
                        Menampilkan {{ $notifikasi->firstItem() }}–{{ $notifikasi->lastItem() }} dari
                        {{ $notifikasi->total() }} notifikasi
                    </div>
                    <div class="pagination">
                        @if ($notifikasi->onFirstPage())
                            <span class="pg-btn disabled">←</span>
                        @else
                            <a href="{{ $notifikasi->previousPageUrl() }}" class="pg-btn">←</a>
                        @endif
                        @foreach ($notifikasi->getUrlRange(1, $notifikasi->lastPage()) as $page => $url)
                            @if (abs($page - $notifikasi->currentPage()) <= 2 || $page === 1 || $page === $notifikasi->lastPage())
                                <a href="{{ $url }}"
                                    class="pg-btn {{ $page == $notifikasi->currentPage() ? 'active' : '' }}">{{ $page }}</a>
                            @elseif(abs($page - $notifikasi->currentPage()) === 3)
                                <span class="pg-btn disabled" style="pointer-events:none">...</span>
                            @endif
                        @endforeach
                        @if ($notifikasi->hasMorePages())
                            <a href="{{ $notifikasi->nextPageUrl() }}" class="pg-btn">→</a>
                        @else
                            <span class="pg-btn disabled">→</span>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>

    {{-- ═══════════════════════
     MODAL: TAMBAH NOTIFIKASI
    ════════════════════════ --}}
    <div class="modal-backdrop" id="modalTambah" onclick="backdropClose(event,'modalTambah')">
        <div class="modal" role="dialog" aria-modal="true">
            <div class="modal-header">
                <div class="modal-title">Kirim Notifikasi Baru</div>
                <div class="modal-close" onclick="closeModal('modalTambah')">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.5">
                        <line x1="18" y1="6" x2="6" y2="18" />
                        <line x1="6" y1="6" x2="18" y2="18" />
                    </svg>
                </div>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('admin.notifikasi.store') }}">
                    @csrf

                    <div class="form-group">
                        <label class="form-label">Penerima <span style="color:var(--red)">*</span></label>
                        <select name="user_id" class="form-control" required>
                            <option value="">Pilih penerima...</option>
                            <option value="all" {{ old('user_id') === 'all' ? 'selected' : '' }}>Semua Pengguna</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }} ({{ $user->email }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Jenis Notifikasi <span style="color:var(--red)">*</span></label>
                        <select name="jenis" class="form-control" required>
                            <option value="">Pilih jenis...</option>
                            <option value="pemesanan" {{ old('jenis') === 'pemesanan' ? 'selected' : '' }}>Pemesanan</option>
                            <option value="pembayaran" {{ old('jenis') === 'pembayaran' ? 'selected' : '' }}>Pembayaran</option>
                            <option value="sistem" {{ old('jenis') === 'sistem' ? 'selected' : '' }}>Sistem</option>
                            <option value="promo" {{ old('jenis') === 'promo' ? 'selected' : '' }}>Promo</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Judul <span style="color:var(--red)">*</span></label>
                        <input type="text" name="judul" class="form-control" placeholder="Contoh: Slot Parkir Tersedia"
                            required value="{{ old('judul') }}" maxlength="150" />
                    </div>

                    <div class="form-group">
                        <label class="form-label">Pesan <span style="color:var(--red)">*</span></label>
                        <textarea name="pesan" class="form-control" rows="3" placeholder="Isi pesan notifikasi..."
                            required>{{ old('pesan') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-check">
                            <input type="checkbox" name="sudah_dibaca" value="1"
                                {{ old('sudah_dibaca') ? 'checked' : '' }} />
                            <span class="form-check-label">Tandai sebagai sudah dibaca</span>
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
                            Kirim Notifikasi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════
     MODAL: EDIT NOTIFIKASI
    ════════════════════════ --}}
    <div class="modal-backdrop" id="modalEdit" onclick="backdropClose(event,'modalEdit')">
        <div class="modal" role="dialog" aria-modal="true">
            <div class="modal-header">
                <div class="modal-title">Edit Notifikasi</div>
                <div class="modal-close" onclick="closeModal('modalEdit')">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.5">
                        <line x1="18" y1="6" x2="6" y2="18" />
                        <line x1="6" y1="6" x2="18" y2="18" />
                    </svg>
                </div>
            </div>
            <div class="modal-body">
                <form method="POST" id="formEdit">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label class="form-label">Penerima <span style="color:var(--red)">*</span></label>
                        <select name="user_id" id="edit_user_id" class="form-control" required>
                            <option value="all">Semua Pengguna</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Jenis Notifikasi <span style="color:var(--red)">*</span></label>
                        <select name="jenis" id="edit_jenis" class="form-control" required>
                            <option value="pemesanan">Pemesanan</option>
                            <option value="pembayaran">Pembayaran</option>
                            <option value="sistem">Sistem</option>
                            <option value="promo">Promo</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Judul <span style="color:var(--red)">*</span></label>
                        <input type="text" name="judul" id="edit_judul" class="form-control"
                            required maxlength="150" />
                    </div>

                    <div class="form-group">
                        <label class="form-label">Pesan <span style="color:var(--red)">*</span></label>
                        <textarea name="pesan" id="edit_pesan" class="form-control" rows="3" required></textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-check">
                            <input type="checkbox" name="sudah_dibaca" id="edit_sudah_dibaca" value="1" />
                            <span class="form-check-label">Tandai sebagai sudah dibaca</span>
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
                <div class="del-title">Hapus Notifikasi?</div>
                <div class="del-sub">
                    Notifikasi akan dihapus secara permanen. Tindakan ini tidak bisa dibatalkan.
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

        function openEdit(notif) {
            document.getElementById('edit_user_id').value = notif.user_id;
            document.getElementById('edit_jenis').value = notif.jenis;
            document.getElementById('edit_judul').value = notif.judul;
            document.getElementById('edit_pesan').value = notif.pesan;
            document.getElementById('edit_sudah_dibaca').checked = !!notif.sudah_dibaca;

            const baseUrl = '{{ url('/notifikasi') }}';
            document.getElementById('formEdit').action = `${baseUrl}/${notif.id}`;

            openModal('modalEdit');
        }

        function openDelete(id) {
            const baseUrl = '{{ url('/notifikasi') }}';
            document.getElementById('formDelete').action = `${baseUrl}/${id}`;
            openModal('modalDelete');
        }

        document.querySelectorAll('.flash').forEach(el => {
            setTimeout(() => {
                el.style.transition = 'opacity 0.4s';
                el.style.opacity = '0';
                setTimeout(() => el.remove(), 400);
            }, 4000);
        });
    </script>
@endsection
