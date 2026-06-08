@extends('layouts.user')

@section('styles')
    <style>
        /* ══ PAGE TOPBAR ══ */
        .page-topbar {
            max-width: 640px;
            margin: 0 auto;
            padding: 24px 24px 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .back-btn {
            width: 38px;
            height: 38px;
            background: var(--bg-surface);
            border: 1px solid var(--border);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: var(--text-secondary);
            transition: border-color 0.15s, color 0.15s;
            box-shadow: var(--shadow-sm);
            flex-shrink: 0;
            text-decoration: none;
        }

        .back-btn:hover {
            border-color: var(--border-focus);
            color: var(--text-primary);
        }

        .page-topbar-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 20px;
            font-weight: 800;
            color: var(--text-primary);
            flex: 1;
            letter-spacing: -0.3px;
        }

        /* ══ CONTENT INNER (override max-width khusus halaman ini) ══ */
        .content-inner {
            max-width: 640px;
        }

        /* ══ FORM CARD ══ */
        .form-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 24px;
            padding: 28px 24px 24px;
            box-shadow: var(--shadow-md);
            margin-top: 20px;
        }

        /* ══ AVATAR ══ */
        .avatar-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 30px;
        }

        .avatar-wrap {
            position: relative;
            width: 96px;
            height: 96px;
            margin-bottom: 12px;
        }

        .avatar-circle {
            width: 96px;
            height: 96px;
            border-radius: 50%;
            background: linear-gradient(135deg, #dde8f7, #c5d8f5);
            border: 3px solid #fff;
            box-shadow: 0 4px 16px rgba(37, 99, 235, 0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .avatar-circle img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .avatar-circle svg {
            color: #8fafd8;
        }

        .avatar-edit-btn {
            position: absolute;
            bottom: 2px;
            right: 2px;
            width: 28px;
            height: 28px;
            background: var(--blue-main);
            border: 2.5px solid #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: #fff;
            box-shadow: 0 2px 6px rgba(37, 99, 235, 0.35);
            transition: background 0.15s, transform 0.15s;
        }

        .avatar-edit-btn:hover {
            background: var(--blue-bright);
            transform: scale(1.08);
        }

        .avatar-name {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 16px;
            font-weight: 800;
            color: var(--text-primary);
            margin-bottom: 2px;
        }

        .avatar-role {
            font-size: 12px;
            color: var(--text-muted);
        }

        /* ══ ALERT ══ */
        .alert {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            padding: 12px 16px;
            border-radius: 14px;
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 20px;
            animation: slide-down 0.3s ease;
        }

        @keyframes slide-down {
            from {
                opacity: 0;
                transform: translateY(-8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-success {
            background: var(--green-soft);
            color: var(--green);
            border: 1px solid #a7f3d0;
        }

        .alert-error {
            background: var(--red-soft);
            color: var(--red);
            border: 1px solid #fca5a5;
        }

        .alert ul {
            margin: 4px 0 0 16px;
        }

        .alert li {
            font-size: 12px;
        }

        /* ══ FIELDS ══ */
        .fields-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .field-wrap {
            position: relative;
        }

        .field-label {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 11.5px;
            font-weight: 600;
            color: var(--text-muted);
            margin-bottom: 6px;
            padding-left: 2px;
        }

        .field-label svg {
            flex-shrink: 0;
        }

        .field-input {
            width: 100%;
            background: var(--bg-input);
            border: 1.5px solid var(--border);
            border-radius: 14px;
            padding: 13px 16px;
            font-family: 'Poppins', sans-serif;
            font-size: 13.5px;
            font-weight: 500;
            color: var(--text-primary);
            outline: none;
            transition: border-color 0.18s, box-shadow 0.18s, background 0.18s;
            appearance: none;
            -webkit-appearance: none;
        }

        .field-input::placeholder {
            color: var(--text-muted);
            font-weight: 400;
        }

        .field-input:focus {
            border-color: var(--blue-main);
            background: #fff;
            box-shadow: 0 0 0 3.5px rgba(37, 99, 235, 0.10);
        }

        .field-input:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            background: #f8fafc;
        }

        select.field-input {
            cursor: pointer;
            padding-right: 40px;
            background-image: url("data:image/svg+xml,%3Csvg width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%2394a3b8' stroke-width='2.5' xmlns='http://www.w3.org/2000/svg'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 14px center;
            background-color: var(--bg-input);
        }

        select.field-input:focus {
            background-color: #fff;
        }

        input[type="date"].field-input::-webkit-calendar-picker-indicator {
            opacity: 0.4;
            cursor: pointer;
        }

        .field-wrap.has-error .field-input {
            border-color: var(--red);
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.10);
        }

        .field-wrap.has-error .field-label {
            color: var(--red);
        }

        .field-error-msg {
            font-size: 11px;
            color: var(--red);
            margin-top: 5px;
            padding-left: 4px;
            display: none;
        }

        .field-wrap.has-error .field-error-msg {
            display: block;
        }

        .field-wrap.is-valid .field-input {
            border-color: var(--green);
        }

        /* ══ ACTIONS ══ */
        .action-row {
            display: flex;
            gap: 12px;
            margin-top: 28px;
        }

        .btn {
            flex: 1;
            padding: 14px 20px;
            border-radius: 14px;
            border: none;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.18s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-secondary {
            background: #4a6080;
            color: #fff;
            box-shadow: 0 2px 8px rgba(74, 96, 128, 0.22);
            text-decoration: none;
        }

        .btn-secondary:hover {
            background: #3a4f6a;
            transform: translateY(-1px);
        }

        .btn-primary {
            background: var(--blue-main);
            color: #fff;
            box-shadow: 0 4px 14px rgba(37, 99, 235, 0.30);
        }

        .btn-primary:hover {
            background: var(--blue-bright);
            transform: translateY(-1px);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .btn:disabled {
            opacity: 0.55;
            cursor: not-allowed;
            transform: none !important;
        }

        /* ══ SPINNER ══ */
        .spinner {
            width: 16px;
            height: 16px;
            border-radius: 50%;
            border: 2.5px solid rgba(255, 255, 255, 0.3);
            border-top-color: #fff;
            animation: spin 0.7s linear infinite;
            flex-shrink: 0;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* ══ TOAST ══ */
        .toast {
            position: fixed;
            top: 80px;
            left: 50%;
            transform: translateX(-50%) translateY(-20px);
            background: var(--text-primary);
            color: #fff;
            padding: 12px 20px;
            border-radius: 12px;
            font-size: 13px;
            font-weight: 500;
            box-shadow: var(--shadow-lg);
            z-index: 9999;
            pointer-events: none;
            opacity: 0;
            transition: all 0.28s cubic-bezier(0.34, 1.56, 0.64, 1);
            white-space: nowrap;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .toast.show {
            opacity: 1;
            transform: translateX(-50%) translateY(0);
        }

        .toast.success {
            background: var(--green);
        }

        .toast.error {
            background: var(--red);
        }

        /* ══ RESPONSIVE ══ */
        @media (max-width: 859px) {
            .page-topbar {
                padding: 20px 16px 0;
            }
        }

        @media (max-width: 400px) {
            .form-card {
                padding: 22px 16px 18px;
                border-radius: 20px;
            }

            .btn {
                font-size: 13.5px;
                padding: 13px 16px;
            }
        }
    </style>
@endsection

@section('content')
    {{-- Toast --}}
    <div class="toast" id="toast">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
            id="toastIcon">
            <polyline points="20 6 9 17 4 12" />
        </svg>
        <span id="toastMsg">Profil berhasil disimpan</span>
    </div>

    {{-- ════════════ MAIN ════════════ --}}
    <main class="main-wrap">

        <div class="page-topbar">
            <a class="back-btn" href="{{ route('user.pengaturan') }}" title="Kembali">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2.5">
                    <polyline points="15 18 9 12 15 6" />
                </svg>
            </a>
            <div class="page-topbar-title">Ubah Profil</div>
            <div class="icon-btn">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2">
                    <circle cx="12" cy="5" r="1" />
                    <circle cx="12" cy="12" r="1" />
                    <circle cx="12" cy="19" r="1" />
                </svg>
            </div>
        </div>

        <div class="content-inner">
            <div class="form-card">

                {{-- Flash messages --}}
                @if (session('success'))
                    <div class="alert alert-success">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.5" style="flex-shrink:0;margin-top:1px">
                            <polyline points="20 6 9 17 4 12" />
                        </svg>
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-error">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" style="flex-shrink:0;margin-top:1px">
                            <circle cx="12" cy="12" r="10" />
                            <line x1="12" y1="8" x2="12" y2="12" />
                            <line x1="12" y1="16" x2="12.01" y2="16" />
                        </svg>
                        <div>
                            Periksa kembali data yang diisi:
                            <ul>
                                @foreach ($errors->all() as $err)
                                    <li>{{ $err }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                {{-- Form --}}
                <form id="profileForm" action="{{ route('user.pengaturan.user-edit.update') }}" method="POST"
                    enctype="multipart/form-data" onsubmit="handleSave(event)" novalidate>
                    @csrf
                    @method('PUT')

                    {{-- ── Avatar ── --}}
                    <div class="avatar-section">
                        <div class="avatar-wrap">
                            <div class="avatar-circle" id="avatarCircle">
                                @if ($user->foto_profil)
                                    <img src="{{ Storage::url($user->foto_profil) }}" alt="{{ $user->name }}"
                                        id="avatarImg">
                                @else
                                    <svg width="44" height="44" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="1.5" id="avatarPlaceholder">
                                        <circle cx="12" cy="8" r="4" />
                                        <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7" />
                                    </svg>
                                @endif
                            </div>
                            <div class="avatar-edit-btn" onclick="document.getElementById('foto_profil').click()"
                                title="Ganti foto">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2.5">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                                </svg>
                            </div>
                            {{-- Input file tersembunyi, nama sesuai controller --}}
                            <input type="file" id="foto_profil" name="foto_profil"
                                accept="image/jpeg,image/png,image/webp" style="display:none"
                                onchange="previewAvatar(this)" />
                        </div>
                        <div class="avatar-name" id="displayName">{{ $user->name }}</div>
                        <div class="avatar-role">Pengguna Parkify</div>
                        {{-- Info ukuran file --}}
                        <div id="fotoInfo" style="font-size:11px;color:var(--text-muted);margin-top:4px;display:none">
                        </div>
                    </div>

                    {{-- ── Fields ── --}}
                    <div class="fields-list">

                        {{-- Nama --}}
                        <div class="field-wrap {{ $errors->has('name') ? 'has-error' : '' }}" id="wrap-name">
                            <div class="field-label">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="8" r="4" />
                                    <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7" />
                                </svg>
                                Nama Pengguna
                            </div>
                            <input id="inputName" name="name" class="field-input" type="text"
                                placeholder="Masukkan nama lengkap" value="{{ old('name', $user->name) }}"
                                oninput="syncName(this.value); liveValidate('wrap-name', this, 'Nama tidak boleh kosong')"
                                required />
                            <div class="field-error-msg">{{ $errors->first('name') ?: 'Nama tidak boleh kosong' }}</div>
                        </div>

                        {{-- Email (disabled — ubah via halaman keamanan) --}}
                        <div class="field-wrap">
                            <div class="field-label">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                                    <polyline points="22,6 12,13 2,6" />
                                </svg>
                                Email
                                <span
                                    style="margin-left:auto;font-size:10px;color:var(--blue-main);font-weight:600;background:var(--blue-soft);padding:1px 7px;border-radius:999px">Tidak
                                    dapat diubah di sini</span>
                            </div>
                            <input class="field-input" type="email" value="{{ $user->email }}" disabled />
                        </div>

                        {{-- No Telepon --}}
                        <div class="field-wrap {{ $errors->has('no_telepon') ? 'has-error' : '' }}" id="wrap-no_telepon">
                            <div class="field-label">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <path
                                        d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.61 3.38 2 2 0 0 1 3.6 1.21h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.86a16 16 0 0 0 6.29 6.29l.95-.96a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z" />
                                </svg>
                                No Telepon
                            </div>
                            <input id="inputTelp" name="no_telepon" class="field-input" type="tel"
                                placeholder="08xxxxxxxxxx" value="{{ old('no_telepon', $user->no_telepon) }}"
                                oninput="liveValidateTelp(this)" />
                            <div class="field-error-msg">{{ $errors->first('no_telepon') ?: 'Nomor telepon tidak valid' }}
                            </div>
                        </div>

                        {{-- Jenis Kelamin (jika ada kolom jenis_kelamin di tabel users) --}}
                        @if (isset($user->jenis_kelamin) || true)
                            <div class="field-wrap {{ $errors->has('jenis_kelamin') ? 'has-error' : '' }}"
                                id="wrap-jenis_kelamin">
                                <div class="field-label">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <circle cx="12" cy="12" r="4" />
                                        <line x1="12" y1="2" x2="12" y2="6" />
                                        <line x1="12" y1="18" x2="12" y2="22" />
                                        <line x1="2" y1="12" x2="6" y2="12" />
                                        <line x1="18" y1="12" x2="22" y2="12" />
                                    </svg>
                                    Jenis Kelamin
                                </div>
                                <select id="inputGender" name="jenis_kelamin" class="field-input">
                                    <option value="">Pilih jenis kelamin</option>
                                    <option value="laki"
                                        {{ old('jenis_kelamin', $user->jenis_kelamin ?? '') === 'laki' ? 'selected' : '' }}>
                                        Laki-Laki</option>
                                    <option value="perempuan"
                                        {{ old('jenis_kelamin', $user->jenis_kelamin ?? '') === 'perempuan' ? 'selected' : '' }}>
                                        Perempuan</option>
                                </select>
                                <div class="field-error-msg">{{ $errors->first('jenis_kelamin') }}</div>
                            </div>
                        @endif

                        {{-- Tanggal Lahir --}}
                        @if (isset($user->tanggal_lahir) || true)
                            <div class="field-wrap {{ $errors->has('tanggal_lahir') ? 'has-error' : '' }}"
                                id="wrap-tanggal_lahir">
                                <div class="field-label">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <rect x="3" y="4" width="18" height="18" rx="2" />
                                        <line x1="16" y1="2" x2="16" y2="6" />
                                        <line x1="8" y1="2" x2="8" y2="6" />
                                        <line x1="3" y1="10" x2="21" y2="10" />
                                    </svg>
                                    Tanggal Lahir
                                </div>
                                <input id="inputDob" name="tanggal_lahir" class="field-input" type="date"
                                    value="{{ old('tanggal_lahir', isset($user->tanggal_lahir) ? \Carbon\Carbon::parse($user->tanggal_lahir)->format('Y-m-d') : '') }}"
                                    max="{{ now()->subYears(10)->format('Y-m-d') }}" />
                                <div class="field-error-msg">{{ $errors->first('tanggal_lahir') }}</div>
                            </div>
                        @endif

                        {{-- Alamat --}}
                        @if (isset($user->alamat) || true)
                            <div class="field-wrap {{ $errors->has('alamat') ? 'has-error' : '' }}" id="wrap-alamat">
                                <div class="field-label">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z" />
                                        <circle cx="12" cy="9" r="2.5" />
                                    </svg>
                                    Alamat
                                </div>
                                <textarea id="inputAlamat" name="alamat" class="field-input" placeholder="Masukkan alamat lengkap" rows="2"
                                    style="resize:none;line-height:1.5">{{ old('alamat', $user->alamat ?? '') }}</textarea>
                                <div class="field-error-msg">{{ $errors->first('alamat') }}</div>
                            </div>
                        @endif

                    </div>{{-- /fields-list --}}

                    {{-- Action Buttons --}}
                    <div class="action-row">
                        <a href="{{ route('user.pengaturan') }}" class="btn btn-secondary">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2.5">
                                <polyline points="15 18 9 12 15 6" />
                            </svg>
                            Kembali
                        </a>
                        <button type="submit" class="btn btn-primary" id="saveBtn">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2.5" id="saveIcon">
                                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z" />
                                <polyline points="17 21 17 13 7 13 7 21" />
                                <polyline points="7 3 7 8 15 8" />
                            </svg>
                            Simpan Perubahan
                        </button>
                    </div>

                </form>{{-- /form --}}

            </div>{{-- /form-card --}}
        </div>
    </main>
@endsection

@section('scripts')
    <script>
        /* ─── SYNC DISPLAY NAME ───────────── */
        function syncName(val) {
            document.getElementById('displayName').textContent = val.trim() || 'Nama Pengguna';
        }

        /* ─── AVATAR PREVIEW ─────────────── */
        function previewAvatar(input) {
            if (!input.files || !input.files[0]) return;
            const file = input.files[0];

            // Validasi ukuran (max 2MB)
            if (file.size > 2 * 1024 * 1024) {
                showToast('Ukuran foto maks 2MB', 'error');
                input.value = '';
                return;
            }

            // Tampilkan info ukuran
            const info = document.getElementById('fotoInfo');
            info.textContent = file.name + ' (' + (file.size / 1024).toFixed(0) + ' KB)';
            info.style.display = 'block';

            const reader = new FileReader();
            reader.onload = e => {
                const circle = document.getElementById('avatarCircle');
                circle.innerHTML =
                    `<img src="${e.target.result}" style="width:100%;height:100%;object-fit:cover" alt="Preview">`;
            };
            reader.readAsDataURL(file);
        }

        /* ─── LIVE VALIDATION ────────────── */
        function liveValidate(wrapId, input, msg) {
            const wrap = document.getElementById(wrapId);
            if (!wrap) return true;
            const ok = input.value.trim().length > 0;
            wrap.classList.toggle('has-error', !ok);
            wrap.classList.toggle('is-valid', ok);
            if (!ok) {
                const errEl = wrap.querySelector('.field-error-msg');
                if (errEl && !errEl.dataset.server) errEl.textContent = msg;
            }
            return ok;
        }

        function liveValidateTelp(input) {
            const wrap = document.getElementById('wrap-no_telepon');
            if (!wrap) return true;
            const val = input.value.trim();
            const ok = val === '' || /^[0-9+\-\s]{8,20}$/.test(val);
            wrap.classList.toggle('has-error', !ok);
            wrap.classList.toggle('is-valid', ok && val !== '');
            return ok;
        }

        /* ─── HANDLE SAVE (client-side guard) ── */
        function handleSave(e) {
            const nameOk = liveValidate(
                'wrap-name',
                document.getElementById('inputName'),
                'Nama tidak boleh kosong'
            );
            const telpOk = liveValidateTelp(document.getElementById('inputTelp'));

            if (!nameOk || !telpOk) {
                e.preventDefault();
                showToast('Periksa kembali data yang diisi', 'error');
                return;
            }

            // Loading state pada tombol
            const btn = document.getElementById('saveBtn');
            btn.disabled = true;
            btn.innerHTML = '<div class="spinner"></div> Menyimpan...';
            // Form lanjut submit normal ke server
        }

        /* ─── TOAST ──────────────────────── */
        function showToast(msg, type = '') {
            const t = document.getElementById('toast');
            const m = document.getElementById('toastMsg');
            const i = document.getElementById('toastIcon');
            m.textContent = msg;
            t.className = 'toast ' + type;
            if (type === 'success')
                i.innerHTML = '<polyline points="20 6 9 17 4 12"/>';
            else if (type === 'error')
                i.innerHTML = '<line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>';
            requestAnimationFrame(() => requestAnimationFrame(() => t.classList.add('show')));
            setTimeout(() => t.classList.remove('show'), 3200);
        }

        /* ─── AUTO SHOW TOAST FROM SESSION ── */
        @if (session('success'))
            window.addEventListener('DOMContentLoaded', () => showToast('{{ session('success') }}', 'success'));
        @endif
        @if ($errors->any())
            window.addEventListener('DOMContentLoaded', () => showToast('Periksa kembali data yang diisi', 'error'));
        @endif
    </script>
@endsection
