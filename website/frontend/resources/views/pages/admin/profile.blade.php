@extends('layouts.admin')

@section('styles')
    <style>
        /* ══════════════════════════════════════════
       PARKIFY — PROFILE PAGE CSS
       Hanya dipakai di halaman edit profile
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

        /* ── LAYOUT ────────────────────────────────────── */
        .profile-grid {
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: 20px;
            align-items: start;
        }

        /* ── PROFILE CARD (kiri) ───────────────────────── */
        .profile-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 28px 24px;
            box-shadow: var(--shadow-sm);
            text-align: center;
            position: sticky;
            top: 80px;
        }

        .profile-avatar-wrap {
            position: relative;
            display: inline-block;
            margin-bottom: 16px;
        }

        .profile-avatar {
            width: 96px;
            height: 96px;
            border-radius: 22px;
            background: linear-gradient(135deg, var(--blue-main), #1d4ed8);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 800;
            font-size: 32px;
            color: #fff;
            overflow: hidden;
            border: 3px solid var(--bg-surface);
            box-shadow: var(--shadow-md);
        }

        .profile-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .avatar-edit-btn {
            position: absolute;
            bottom: -6px;
            right: -6px;
            width: 30px;
            height: 30px;
            border-radius: 9px;
            background: var(--blue-main);
            border: 2px solid var(--bg-surface);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: #fff;
            transition: background 0.16s, transform 0.15s;
        }

        .avatar-edit-btn:hover {
            background: var(--blue-bright);
            transform: scale(1.1);
        }

        .profile-name {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 17px;
            font-weight: 800;
            color: var(--text-primary);
            margin-bottom: 4px;
        }

        .profile-email {
            font-size: 12px;
            color: var(--text-muted);
            margin-bottom: 16px;
        }

        .profile-meta {
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-top: 16px;
            padding-top: 16px;
            border-top: 1px solid var(--border);
            text-align: left;
        }

        .meta-row {
            display: flex;
            align-items: center;
            gap: 9px;
            font-size: 12px;
            color: var(--text-secondary);
        }

        .meta-icon {
            width: 28px;
            height: 28px;
            border-radius: 7px;
            background: var(--bg-input);
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-muted);
            flex-shrink: 0;
        }

        .meta-label {
            color: var(--text-muted);
            font-size: 10.5px;
        }

        .meta-val {
            font-weight: 600;
            color: var(--text-primary);
            font-size: 12px;
            margin-top: 1px;
        }

        .profile-danger-zone {
            margin-top: 20px;
            padding-top: 16px;
            border-top: 1px solid var(--border);
        }

        /* ── FORM SECTIONS (kanan) ─────────────────────── */
        .profile-sections {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .section-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: background 0.25s, border-color 0.25s;
        }

        .section-head {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 18px 22px;
            border-bottom: 1px solid var(--border);
            cursor: pointer;
            user-select: none;
            transition: background 0.15s;
        }

        .section-head:hover {
            background: var(--bg-hover);
        }

        .section-head-icon {
            width: 34px;
            height: 34px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .shi-blue {
            background: var(--blue-soft);
            color: var(--blue-main);
        }

        .shi-green {
            background: var(--green-soft);
            color: var(--green);
        }

        .shi-amber {
            background: var(--amber-soft);
            color: var(--amber);
        }

        .shi-red {
            background: var(--red-soft);
            color: var(--red);
        }

        .section-head-text {
            flex: 1;
        }

        .section-head-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 13.5px;
            font-weight: 700;
            color: var(--text-primary);
        }

        .section-head-sub {
            font-size: 11.5px;
            color: var(--text-muted);
            margin-top: 1px;
        }

        .section-chevron {
            color: var(--text-muted);
            transition: transform 0.22s cubic-bezier(.4, 0, .2, 1);
            flex-shrink: 0;
        }

        .section-card.open .section-chevron {
            transform: rotate(90deg);
        }

        .section-body {
            padding: 0 22px;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.35s cubic-bezier(.4, 0, .2, 1), padding 0.25s;
        }

        .section-card.open .section-body {
            max-height: 900px;
            padding: 22px;
        }

        /* ── BUTTONS ───────────────────────────────────── */
        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: var(--blue-main);
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 9px 18px;
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
            padding: 8px 14px;
            font-size: 12.5px;
            font-weight: 500;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
            transition: all 0.16s;
            white-space: nowrap;
        }

        .btn-ghost:hover {
            border-color: var(--border-focus);
            color: var(--text-primary);
            background: var(--bg-hover);
        }

        .btn-danger-outline {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: transparent;
            color: var(--red);
            border: 1px solid rgba(239, 68, 68, 0.35);
            border-radius: 9px;
            padding: 8px 14px;
            font-size: 12.5px;
            font-weight: 500;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
            transition: all 0.16s;
            white-space: nowrap;
            width: 100%;
            justify-content: center;
        }

        .btn-danger-outline:hover {
            background: var(--red-soft);
            border-color: var(--red);
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

        .form-group:last-child {
            margin-bottom: 0;
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

        .form-control:disabled {
            opacity: 0.55;
            cursor: not-allowed;
        }

        .pass-wrap {
            position: relative;
        }

        .pass-wrap .form-control {
            padding-right: 40px;
        }

        .pass-eye {
            position: absolute;
            right: 11px;
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

        .form-footer {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            padding-top: 16px;
            border-top: 1px solid var(--border);
            margin-top: 6px;
        }

        /* ── UPLOAD AVATAR ZONE ────────────────────────── */
        .avatar-upload-zone {
            border: 2px dashed var(--border);
            border-radius: 11px;
            padding: 16px;
            cursor: pointer;
            transition: border-color 0.18s, background 0.18s;
            text-align: center;
            position: relative;
            background: var(--bg-input);
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .avatar-upload-zone:hover,
        .avatar-upload-zone.drag-over {
            border-color: var(--blue-main);
            background: var(--blue-soft);
        }

        .avatar-upload-zone input[type="file"] {
            position: absolute;
            inset: 0;
            opacity: 0;
            cursor: pointer;
            width: 100%;
            height: 100%;
        }

        .auz-preview {
            width: 56px;
            height: 56px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--blue-main), #1d4ed8);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 800;
            font-size: 18px;
            color: #fff;
            overflow: hidden;
            flex-shrink: 0;
            border: 2px solid var(--border);
        }

        .auz-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .auz-text {
            text-align: left;
        }

        .auz-label {
            font-size: 12.5px;
            font-weight: 600;
            color: var(--text-primary);
        }

        .auz-sub {
            font-size: 11px;
            color: var(--text-muted);
            margin-top: 2px;
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

        /* ── STRENGTH METER (password) ─────────────────── */
        .strength-bar {
            display: flex;
            gap: 4px;
            margin-top: 8px;
        }

        .sb-seg {
            flex: 1;
            height: 3px;
            border-radius: 999px;
            background: var(--border);
            transition: background 0.3s;
        }

        .sb-seg.weak {
            background: var(--red);
        }

        .sb-seg.medium {
            background: var(--amber);
        }

        .sb-seg.strong {
            background: var(--green);
        }

        .strength-label {
            font-size: 10.5px;
            margin-top: 4px;
            color: var(--text-muted);
            transition: color 0.3s;
        }

        /* ── RESPONSIVE ────────────────────────────────── */
        @media (max-width: 1024px) {
            .profile-grid {
                grid-template-columns: 1fr;
            }

            .profile-card {
                position: static;
            }
        }

        @media (max-width: 640px) {
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
                <div class="page-title">Edit Profil</div>
                <div class="page-sub">Kelola informasi akun dan keamanan Anda</div>
            </div>
        </div>

        @php
            $user = auth()->user();
            $initials = collect(explode(' ', $user->name))
                ->map(fn($w) => strtoupper($w[0] ?? ''))
                ->take(2)
                ->implode('');
        @endphp

        <div class="profile-grid">

            {{-- ── KOLOM KIRI: Profile Card ── --}}
            <div>
                <div class="profile-card">
                    <div class="profile-avatar-wrap">
                        <div class="profile-avatar" id="cardAvatar">
                            @if ($user->foto_profil)
                                <img src="{{ Storage::url($user->foto_profil) }}" id="cardAvatarImg"
                                    alt="{{ $user->name }}" />
                            @else
                                <span id="cardAvatarInitial">{{ $initials }}</span>
                            @endif
                        </div>
                        <label for="foto_quick" class="avatar-edit-btn" title="Ganti foto">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2.5">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                            </svg>
                        </label>
                    </div>

                    <div class="profile-name" id="cardName">{{ $user->name }}</div>
                    <div class="profile-email">{{ $user->email }}</div>

                    <span class="badge {{ $user->role === 'admin' ? 'b-red' : 'b-blue' }}">
                        {{ $user->role === 'admin' ? 'Admin' : 'Pengguna' }}
                    </span>

                    <div class="profile-meta">
                        <div class="meta-row">
                            <div class="meta-icon">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2">
                                    <rect x="3" y="4" width="18" height="18" rx="2" />
                                    <line x1="16" y1="2" x2="16" y2="6" />
                                    <line x1="8" y1="2" x2="8" y2="6" />
                                    <line x1="3" y1="10" x2="21" y2="10" />
                                </svg>
                            </div>
                            <div>
                                <div class="meta-label">Bergabung</div>
                                <div class="meta-val">{{ $user->created_at->format('d M Y') }}</div>
                            </div>
                        </div>
                        <div class="meta-row">
                            <div class="meta-icon">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2">
                                    <path
                                        d="M22 16.92v3a2 2 0 0 1-2.18 2A19.79 19.79 0 0 1 11.39 18a19.5 19.5 0 0 1-6-6A19.79 19.79 0 0 1 2.12 3.18 2 2 0 0 1 4.11 1h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.71 2.81a2 2 0 0 1-.45 2.11L8.09 8.91A16 16 0 0 0 14 14.91l1.27-1.27a2 2 0 0 1 2.11-.45c.91.35 1.85.58 2.81.71A2 2 0 0 1 22 16.92z" />
                                </svg>
                            </div>
                            <div>
                                <div class="meta-label">No. Telepon</div>
                                <div class="meta-val" id="cardPhone">{{ $user->no_telepon ?? '—' }}</div>
                            </div>
                        </div>
                        <div class="meta-row">
                            <div class="meta-icon">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2">
                                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                                    <polyline points="22 4 12 14.01 9 11.01" />
                                </svg>
                            </div>
                            <div>
                                <div class="meta-label">Status Email</div>
                                <div class="meta-val"
                                    style="color:{{ $user->sudah_verifikasi ? 'var(--green)' : 'var(--amber)' }}">
                                    {{ $user->sudah_verifikasi ? 'Terverifikasi' : 'Belum Verifikasi' }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="profile-danger-zone">
                        <button type="button" class="btn-danger-outline" onclick="confirmLogout()">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                                <polyline points="16 17 21 12 16 7" />
                                <line x1="21" y1="12" x2="9" y2="12" />
                            </svg>
                            Keluar dari Akun
                        </button>
                    </div>
                </div>
            </div>

            {{-- ── KOLOM KANAN: Form Sections ── --}}
            <div class="profile-sections">

                {{-- ── 1. Informasi Pribadi ── --}}
                <div class="section-card open" id="sec-info">
                    <div class="section-head" onclick="toggleSection('sec-info')">
                        <div class="section-head-icon shi-blue">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                                <circle cx="12" cy="7" r="4" />
                            </svg>
                        </div>
                        <div class="section-head-text">
                            <div class="section-head-title">Informasi Pribadi</div>
                            <div class="section-head-sub">Nama, email, dan nomor telepon</div>
                        </div>
                        <svg class="section-chevron" width="15" height="15" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2.5">
                            <polyline points="9 18 15 12 9 6" />
                        </svg>
                    </div>
                    <div class="section-body">
                        <form method="POST" action="{{ route('admin.profile.update') }}" id="formInfo">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label class="form-label">Nama Lengkap <span style="color:var(--red)">*</span></label>
                                <input type="text" name="name" class="form-control"
                                    value="{{ old('name', $user->name) }}" placeholder="Nama lengkap Anda" required
                                    oninput="syncName(this.value)" />
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Email <span style="color:var(--red)">*</span></label>
                                    <input type="email" name="email" class="form-control"
                                        value="{{ old('email', $user->email) }}" placeholder="email@domain.com"
                                        required />
                                </div>
                                <div class="form-group">
                                    <label class="form-label">No. Telepon</label>
                                    <input type="text" name="no_telepon" class="form-control"
                                        value="{{ old('no_telepon', $user->no_telepon) }}" placeholder="+62 812 ..."
                                        oninput="syncPhone(this.value)" />
                                </div>
                            </div>

                            <div class="form-footer">
                                <button type="reset" class="btn-ghost">Reset</button>
                                <button type="submit" class="btn-primary">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2.5">
                                        <polyline points="20 6 9 17 4 12" />
                                    </svg>
                                    Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- ── 2. Foto Profil ── --}}
                <div class="section-card" id="sec-foto">
                    <div class="section-head" onclick="toggleSection('sec-foto')">
                        <div class="section-head-icon shi-green">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <rect x="3" y="3" width="18" height="18" rx="2" />
                                <circle cx="8.5" cy="8.5" r="1.5" />
                                <polyline points="21 15 16 10 5 21" />
                            </svg>
                        </div>
                        <div class="section-head-text">
                            <div class="section-head-title">Foto Profil</div>
                            <div class="section-head-sub">Upload atau ganti foto profil Anda</div>
                        </div>
                        <svg class="section-chevron" width="15" height="15" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2.5">
                            <polyline points="9 18 15 12 9 6" />
                        </svg>
                    </div>
                    <div class="section-body">
                        <form method="POST" action="{{ route('admin.profile.avatar') }}" enctype="multipart/form-data"
                            id="formAvatar">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <div class="avatar-upload-zone" id="avatarZone" ondragover="zoneOver(event,this)"
                                    ondragleave="zoneLeave(this)" ondrop="zoneDrop(event,this)">
                                    <input type="file" name="foto_profil" id="foto_quick"
                                        accept="image/jpeg,image/jpg,image/png,image/webp"
                                        onchange="previewAvatar(this)" />
                                    <div class="auz-preview" id="auzPreview">
                                        @if ($user->foto_profil)
                                            <img src="{{ Storage::url($user->foto_profil) }}" id="auzImg"
                                                alt="" />
                                        @else
                                            <span id="auzInitial">{{ $initials }}</span>
                                        @endif
                                    </div>
                                    <div class="auz-text">
                                        <div class="auz-label">Pilih atau seret foto ke sini</div>
                                        <div class="auz-sub">JPG, PNG, WebP · Maks. 4 MB</div>
                                    </div>
                                </div>
                            </div>

                            @if ($user->foto_profil)
                                <div class="form-group">
                                    <label
                                        style="display:flex;align-items:center;gap:8px;cursor:pointer;font-size:12.5px;color:var(--text-secondary)">
                                        <input type="checkbox" name="hapus_foto" value="1"
                                            style="accent-color:var(--red);width:15px;height:15px" />
                                        Hapus foto profil saat ini
                                    </label>
                                </div>
                            @endif

                            <div class="form-footer">
                                <button type="submit" class="btn-primary" id="btnSaveFoto" disabled>
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2.5">
                                        <polyline points="20 6 9 17 4 12" />
                                    </svg>
                                    Simpan Foto
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- ── 3. Ganti Password ── --}}
                <div class="section-card" id="sec-password">
                    <div class="section-head" onclick="toggleSection('sec-password')">
                        <div class="section-head-icon shi-amber">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <rect x="3" y="11" width="18" height="11" rx="2" />
                                <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                            </svg>
                        </div>
                        <div class="section-head-text">
                            <div class="section-head-title">Ganti Password</div>
                            <div class="section-head-sub">Perbarui kata sandi akun Anda</div>
                        </div>
                        <svg class="section-chevron" width="15" height="15" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2.5">
                            <polyline points="9 18 15 12 9 6" />
                        </svg>
                    </div>
                    <div class="section-body">
                        <form method="POST" action="{{ route('admin.profile.password') }}" id="formPassword">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label class="form-label">Password Saat Ini <span
                                        style="color:var(--red)">*</span></label>
                                <div class="pass-wrap">
                                    <input type="password" name="current_password" id="pw_current" class="form-control"
                                        placeholder="Masukkan password saat ini" required />
                                    <button type="button" class="pass-eye" onclick="togglePw('pw_current', this)">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2">
                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                            <circle cx="12" cy="12" r="3" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Password Baru <span
                                            style="color:var(--red)">*</span></label>
                                    <div class="pass-wrap">
                                        <input type="password" name="password" id="pw_new" class="form-control"
                                            placeholder="Min. 8 karakter" required oninput="checkStrength(this.value)" />
                                        <button type="button" class="pass-eye" onclick="togglePw('pw_new', this)">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2">
                                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                                <circle cx="12" cy="12" r="3" />
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="strength-bar">
                                        <div class="sb-seg" id="sb1"></div>
                                        <div class="sb-seg" id="sb2"></div>
                                        <div class="sb-seg" id="sb3"></div>
                                        <div class="sb-seg" id="sb4"></div>
                                    </div>
                                    <div class="strength-label" id="strengthLabel">Masukkan password baru</div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Konfirmasi Password <span
                                            style="color:var(--red)">*</span></label>
                                    <div class="pass-wrap">
                                        <input type="password" name="password_confirmation" id="pw_confirm"
                                            class="form-control" placeholder="Ulangi password baru" required
                                            oninput="checkConfirm(this.value)" />
                                        <button type="button" class="pass-eye" onclick="togglePw('pw_confirm', this)">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2">
                                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                                <circle cx="12" cy="12" r="3" />
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="strength-label" id="confirmLabel"></div>
                                </div>
                            </div>

                            <div class="form-footer">
                                <button type="reset" class="btn-ghost" onclick="resetStrength()">Reset</button>
                                <button type="submit" class="btn-primary">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2.5">
                                        <rect x="3" y="11" width="18" height="11" rx="2" />
                                        <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                                    </svg>
                                    Ganti Password
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- ── 4. Sesi & Keamanan ── --}}
                <div class="section-card" id="sec-session">
                    <div class="section-head" onclick="toggleSection('sec-session')">
                        <div class="section-head-icon shi-red">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                            </svg>
                        </div>
                        <div class="section-head-text">
                            <div class="section-head-title">Sesi & Keamanan</div>
                            <div class="section-head-sub">Kelola sesi login aktif</div>
                        </div>
                        <svg class="section-chevron" width="15" height="15" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2.5">
                            <polyline points="9 18 15 12 9 6" />
                        </svg>
                    </div>
                    <div class="section-body">
                        <div
                            style="background:var(--bg-input);border:1px solid var(--border);border-radius:11px;padding:14px 16px;display:flex;align-items:center;gap:12px;margin-bottom:14px">
                            <div
                                style="width:36px;height:36px;border-radius:9px;background:var(--green-soft);display:flex;align-items:center;justify-content:center;color:var(--green);flex-shrink:0">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <rect x="2" y="3" width="20" height="14" rx="2" />
                                    <line x1="8" y1="21" x2="16" y2="21" />
                                    <line x1="12" y1="17" x2="12" y2="21" />
                                </svg>
                            </div>
                            <div style="flex:1">
                                <div style="font-size:12.5px;font-weight:600;color:var(--text-primary)">Sesi Saat Ini</div>
                                <div style="font-size:11px;color:var(--text-muted);margin-top:1px">
                                    {{ request()->ip() }} ·
                                    {{ request()->userAgent() ? Str::limit(request()->userAgent(), 50) : 'Browser tidak diketahui' }}
                                </div>
                            </div>
                            <span class="badge b-green">● Aktif</span>
                        </div>

                        <form method="POST" action="{{ route('admin.profile.logout-other') }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-ghost"
                                style="width:100%;justify-content:center;color:var(--red);border-color:rgba(239,68,68,0.3)">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                                    <polyline points="16 17 21 12 16 7" />
                                    <line x1="21" y1="12" x2="9" y2="12" />
                                </svg>
                                Logout Semua Perangkat Lain
                            </button>
                        </form>
                    </div>
                </div>

            </div>{{-- end profile-sections --}}
        </div>{{-- end profile-grid --}}
    </div>

    {{-- ── MODAL KONFIRMASI LOGOUT ── --}}
    <div class="modal-backdrop" id="modalLogout" onclick="if(event.target===this)closeModal('modalLogout')">
        <div class="modal modal-sm" role="dialog" aria-modal="true" style="max-width:360px">
            <div class="modal-header" style="padding-bottom:0;margin-bottom:0;border:none">
                <div></div>
                <div class="modal-close" onclick="closeModal('modalLogout')">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.5">
                        <line x1="18" y1="6" x2="6" y2="18" />
                        <line x1="6" y1="6" x2="18" y2="18" />
                    </svg>
                </div>
            </div>
            <div class="modal-body" style="padding-top:10px;text-align:center">
                <div
                    style="width:52px;height:52px;border-radius:14px;background:var(--red-soft);display:flex;align-items:center;justify-content:center;margin:0 auto 14px;color:var(--red)">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                        <polyline points="16 17 21 12 16 7" />
                        <line x1="21" y1="12" x2="9" y2="12" />
                    </svg>
                </div>
                <div style="font-family:'Space Grotesk',sans-serif;font-size:15px;font-weight:800;margin-bottom:8px">Keluar
                    dari Akun?</div>
                <div style="font-size:12.5px;color:var(--text-muted);line-height:1.6;margin-bottom:20px">
                    Sesi Anda akan diakhiri dan Anda perlu login kembali.
                </div>
                <form method="GET" action="{{ route('logout') }}">
                    @csrf
                    <div style="display:flex;gap:10px;justify-content:center">
                        <button type="button" class="btn-ghost" onclick="closeModal('modalLogout')"
                            style="min-width:100px">Batal</button>
                        <button type="submit" class="btn-primary" style="background:var(--red);min-width:100px">Ya,
                            Keluar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // ── ACCORDION ──────────────────────────────────────
        function toggleSection(id) {
            document.getElementById(id).classList.toggle('open');
        }

        // ── MODAL ──────────────────────────────────────────
        function openModal(id) {
            document.getElementById(id).classList.add('open');
            document.body.style.overflow = 'hidden';
        }

        function closeModal(id) {
            document.getElementById(id).classList.remove('open');
            document.body.style.overflow = '';
        }

        function confirmLogout() {
            openModal('modalLogout');
        }
        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') closeModal('modalLogout');
        });
        closeModal('modalLogout')

        // ── SYNC PROFILE CARD ──────────────────────────────
        function syncName(val) {
            const el = document.getElementById('cardName');
            if (el) el.textContent = val || '{{ $user->name }}';
        }

        function syncPhone(val) {
            const el = document.getElementById('cardPhone');
            if (el) el.textContent = val || '—';
        }

        // ── PASSWORD TOGGLE ────────────────────────────────
        function togglePw(id, btn) {
            const inp = document.getElementById(id);
            const show = inp.type === 'password';
            inp.type = show ? 'text' : 'password';
            btn.style.color = show ? 'var(--blue-main)' : 'var(--text-muted)';
        }

        // ── STRENGTH METER ─────────────────────────────────
        function checkStrength(val) {
            const segs = [1, 2, 3, 4].map(i => document.getElementById('sb' + i));
            const label = document.getElementById('strengthLabel');
            let score = 0;
            if (val.length >= 8) score++;
            if (/[A-Z]/.test(val)) score++;
            if (/[0-9]/.test(val)) score++;
            if (/[^A-Za-z0-9]/.test(val)) score++;

            const map = [{
                    cls: '',
                    text: 'Masukkan password baru',
                    color: 'var(--text-muted)'
                },
                {
                    cls: 'weak',
                    text: 'Lemah — tambahkan karakter',
                    color: 'var(--red)'
                },
                {
                    cls: 'weak',
                    text: 'Lemah',
                    color: 'var(--red)'
                },
                {
                    cls: 'medium',
                    text: 'Cukup kuat',
                    color: 'var(--amber)'
                },
                {
                    cls: 'strong',
                    text: 'Kuat ✓',
                    color: 'var(--green)'
                },
            ];

            segs.forEach((s, i) => {
                s.className = 'sb-seg';
                if (i < score && score > 0) s.classList.add(map[score].cls);
            });
            label.textContent = val.length ? map[score].text : map[0].text;
            label.style.color = val.length ? map[score].color : map[0].color;
        }

        function checkConfirm(val) {
            const pw = document.getElementById('pw_new').value;
            const label = document.getElementById('confirmLabel');
            if (!val) {
                label.textContent = '';
                return;
            }
            if (val === pw) {
                label.textContent = 'Password cocok ✓';
                label.style.color = 'var(--green)';
            } else {
                label.textContent = 'Password tidak cocok';
                label.style.color = 'var(--red)';
            }
        }

        function resetStrength() {
            [1, 2, 3, 4].forEach(i => {
                document.getElementById('sb' + i).className = 'sb-seg';
            });
            document.getElementById('strengthLabel').textContent = 'Masukkan password baru';
            document.getElementById('strengthLabel').style.color = 'var(--text-muted)';
            document.getElementById('confirmLabel').textContent = '';
        }

        // ── AVATAR PREVIEW ─────────────────────────────────
        function previewAvatar(input) {
            const file = input.files[0];
            if (!file) return;

            document.getElementById('btnSaveFoto').disabled = false;

            const reader = new FileReader();
            reader.onload = e => {
                // Update upload zone preview
                const auzPreview = document.getElementById('auzPreview');
                auzPreview.innerHTML =
                    `<img src="${e.target.result}" style="width:100%;height:100%;object-fit:cover" />`;

                // Update card avatar
                const cardAvatar = document.getElementById('cardAvatar');
                cardAvatar.innerHTML =
                    `<img src="${e.target.result}" style="width:100%;height:100%;object-fit:cover" />`;
            };
            reader.readAsDataURL(file);
        }

        // ── DRAG & DROP ────────────────────────────────────
        function zoneOver(e, zone) {
            e.preventDefault();
            zone.classList.add('drag-over');
        }

        function zoneLeave(zone) {
            zone.classList.remove('drag-over');
        }

        function zoneDrop(e, zone) {
            e.preventDefault();
            zone.classList.remove('drag-over');
            const file = e.dataTransfer.files[0];
            if (!file || !file.type.startsWith('image/')) return;
            const dt = new DataTransfer();
            dt.items.add(file);
            const input = document.getElementById('foto_quick');
            input.files = dt.files;
            previewAvatar(input);
        }

        // ── AUTO-DISMISS FLASH ─────────────────────────────
        document.querySelectorAll('.flash').forEach(el => {
            setTimeout(() => {
                el.style.transition = 'opacity 0.4s';
                el.style.opacity = '0';
                setTimeout(() => el.remove(), 400);
            }, 4000);
        });

        // ── AUTO-OPEN SECTION ON ERROR ─────────────────────
        @if ($errors->hasBag('info') || $errors->has('name') || $errors->has('email'))
            document.getElementById('sec-info').classList.add('open');
        @endif
        @if ($errors->hasBag('password') || $errors->has('current_password') || $errors->has('password'))
            document.getElementById('sec-password').classList.add('open');
        @endif
    </script>
@endsection
