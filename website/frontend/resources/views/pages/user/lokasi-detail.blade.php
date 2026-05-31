@extends('layouts.user')

@section('styles')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <style>
        /* ══ PAGE TOP BAR ══ */
        .page-topbar {
            max-width: 680px;
            margin: 0 auto;
            padding: 20px 24px 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .back-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            border-radius: 12px;
            background: var(--bg-surface);
            border: 1px solid var(--border);
            cursor: pointer;
            color: var(--text-primary);
            text-decoration: none;
            transition: all 0.15s;
            flex-shrink: 0;
        }

        .back-btn:hover {
            border-color: var(--border-focus);
            background: var(--bg-hover);
        }

        .page-topbar-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 18px;
            font-weight: 700;
            color: var(--text-primary);
        }

        /* ══ CONTENT INNER (override lebar khusus halaman ini) ══ */
        .content-inner {
            max-width: 680px;
            margin: 0 auto;
            padding: 0 24px;
            width: 100%;
        }

        /* ══ HERO IMAGE ══ */
        .hero-wrap {
            max-width: 680px;
            margin: 16px auto 0;
            padding: 0 24px;
        }

        .hero-img {
            width: 100%;
            height: 220px;
            border-radius: 20px;
            overflow: hidden;
            position: relative;
            background: #1a2e4a;
        }

        .hero-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.4s ease;
        }

        .hero-img:hover img {
            transform: scale(1.03);
        }

        .hero-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 80px;
            background: linear-gradient(to top, rgba(15, 30, 54, 0.55), transparent);
            border-radius: 0 0 20px 20px;
        }

        .hero-status-badge {
            position: absolute;
            top: 14px;
            right: 14px;
            font-size: 11px;
            font-weight: 700;
            padding: 4px 12px;
            border-radius: 999px;
            font-family: 'Space Grotesk', sans-serif;
            display: flex;
            align-items: center;
            gap: 5px;
            backdrop-filter: blur(4px);
            color: #fff;
        }

        .hero-status-badge.open {
            background: rgba(16, 185, 129, 0.92);
        }

        .hero-status-badge.closed {
            background: rgba(239, 68, 68, 0.88);
        }

        .hero-status-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #fff;
        }

        .hero-status-badge.open .hero-status-dot {
            animation: pulse-dot 1.5s infinite;
        }

        @keyframes pulse-dot {

            0%,
            100% {
                opacity: 1
            }

            50% {
                opacity: 0.4
            }
        }

        /* ══ LOKASI HEADER CARD ══ */
        .lokasi-header-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 20px;
            margin-top: 16px;
            box-shadow: var(--shadow-sm);
        }

        .lokasi-name {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 22px;
            font-weight: 800;
            color: var(--text-primary);
            letter-spacing: -0.4px;
            margin-bottom: 4px;
        }

        .lokasi-type {
            font-size: 12.5px;
            color: var(--text-muted);
            font-weight: 500;
            margin-bottom: 14px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .lokasi-desc {
            font-size: 13px;
            color: var(--text-secondary);
            line-height: 1.75;
        }

        /* ══ QUICK STATS ══ */
        .quick-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            margin-top: 16px;
        }

        .qs-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 14px 10px;
            text-align: center;
            box-shadow: var(--shadow-sm);
            transition: border-color 0.15s, box-shadow 0.15s;
        }

        .qs-card:hover {
            border-color: var(--border-focus);
            box-shadow: var(--shadow-md);
        }

        .qs-icon {
            width: 34px;
            height: 34px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 8px;
        }

        .qs-value {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 16px;
            font-weight: 800;
            line-height: 1;
            margin-bottom: 4px;
        }

        .qs-label {
            font-size: 10.5px;
            color: var(--text-muted);
            font-weight: 500;
        }

        /* ══ SECTION LABEL ══ */
        .section-label {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.09em;
            text-transform: uppercase;
            color: var(--text-muted);
            margin-bottom: 10px;
            padding-left: 2px;
        }

        /* ══ INFO GROUP ══ */
        .info-group {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 18px;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
        }

        .info-row {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 14px 18px;
            border-bottom: 1px solid var(--border);
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-icon {
            width: 38px;
            height: 38px;
            border-radius: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .info-body {
            flex: 1;
            min-width: 0;
        }

        .info-label {
            font-size: 11.5px;
            color: var(--text-muted);
            font-weight: 500;
            margin-bottom: 2px;
        }

        .info-value {
            font-size: 13.5px;
            font-weight: 600;
            color: var(--text-primary);
        }

        .info-action {
            font-size: 12px;
            font-weight: 600;
            color: var(--blue-main);
            background: var(--blue-soft);
            border: 1px solid var(--blue-pale);
            padding: 5px 12px;
            border-radius: 999px;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.15s;
            white-space: nowrap;
        }

        .info-action:hover {
            background: var(--blue-pale);
        }

        /* ══ SLOT GRID ══ */
        .slot-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
        }

        .slot-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 16px;
            box-shadow: var(--shadow-sm);
            transition: all 0.15s;
        }

        .slot-card:hover {
            border-color: var(--border-focus);
            box-shadow: var(--shadow-md);
        }

        .slot-type {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            color: var(--text-muted);
            margin-bottom: 6px;
        }

        .slot-count {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 28px;
            font-weight: 800;
            line-height: 1;
            margin-bottom: 4px;
        }

        .slot-avail {
            font-size: 11.5px;
            font-weight: 500;
        }

        .slot-bar-wrap {
            margin-top: 10px;
            background: var(--border);
            border-radius: 999px;
            height: 5px;
            overflow: hidden;
        }

        .slot-bar {
            height: 100%;
            border-radius: 999px;
            transition: width 0.5s ease;
        }

        /* ══ TARIF ══ */
        .tarif-group {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 18px;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
        }

        .tarif-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 18px;
            border-bottom: 1px solid var(--border);
        }

        .tarif-row:last-child {
            border-bottom: none;
        }

        .tarif-left {
            display: flex;
            align-items: center;
            gap: 11px;
        }

        .tarif-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .tarif-name {
            font-size: 13.5px;
            font-weight: 600;
            color: var(--text-primary);
        }

        .tarif-note {
            font-size: 11.5px;
            color: var(--text-muted);
        }

        .tarif-price {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 15px;
            font-weight: 800;
            color: var(--blue-main);
        }

        /* ══ MAP PLACEHOLDER ══ */
        .map-placeholder {
            background: #e8f0f8;
            border: 1px solid var(--border);
            border-radius: 18px;
            height: 160px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 8px;
            cursor: pointer;
            transition: all 0.15s;
            overflow: hidden;
            position: relative;
            text-decoration: none;
        }

        .map-placeholder:hover {
            border-color: var(--border-focus);
        }

        .map-grid {
            position: absolute;
            inset: 0;
            opacity: 0.12;
            background-image: linear-gradient(var(--blue-main) 1px, transparent 1px),
                linear-gradient(90deg, var(--blue-main) 1px, transparent 1px);
            background-size: 30px 30px;
        }

        .map-pin {
            position: absolute;
            top: 44%;
            left: 50%;
            width: 32px;
            height: 32px;
            background: var(--blue-main);
            border-radius: 50% 50% 50% 0;
            transform: translate(-50%, -50%) rotate(-45deg);
            box-shadow: 0 2px 8px rgba(37, 99, 235, 0.4);
        }

        .map-pin::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 13px;
            height: 13px;
            background: #fff;
            border-radius: 50%;
        }

        .map-text-wrap {
            margin-top: 26px;
            z-index: 1;
            text-align: center;
        }

        .map-placeholder-text {
            font-size: 13px;
            font-weight: 600;
            color: var(--text-secondary);
        }

        .map-placeholder-sub {
            font-size: 11.5px;
            color: var(--text-muted);
        }

        /* ══ CTA BUTTONS ══ */
        .btn-book {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            padding: 16px 24px;
            border-radius: 16px;
            background: linear-gradient(135deg, #1d4ed8 0%, #2563eb 100%);
            color: #fff;
            font-family: 'Space Grotesk', sans-serif;
            font-size: 15px;
            font-weight: 700;
            letter-spacing: -0.2px;
            border: none;
            cursor: pointer;
            text-decoration: none;
            transition: opacity 0.15s, transform 0.12s;
            box-shadow: 0 4px 16px rgba(37, 99, 235, 0.30);
        }

        .btn-book:hover {
            opacity: 0.92;
        }

        .btn-book:active {
            transform: scale(0.99);
        }

        .btn-secondary {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            padding: 13px 24px;
            border-radius: 14px;
            margin-top: 10px;
            background: var(--bg-surface);
            border: 1.5px solid var(--border);
            color: var(--text-secondary);
            font-size: 13.5px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.15s;
        }

        .btn-secondary:hover {
            border-color: var(--border-focus);
            color: var(--blue-main);
            background: var(--blue-soft);
        }

        /* ══ TOAST ══ */
        .toast {
            position: fixed;
            bottom: calc(var(--bottom-nav-h) + 20px + env(safe-area-inset-bottom));
            left: 50%;
            transform: translateX(-50%) translateY(20px);
            background: #0f1e36;
            color: #fff;
            font-size: 13px;
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
            padding: 10px 20px;
            border-radius: 999px;
            display: flex;
            align-items: center;
            gap: 8px;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.25s, transform 0.25s;
            z-index: 9998;
            white-space: nowrap;
            box-shadow: 0 4px 20px rgba(15, 30, 54, 0.25);
        }

        .toast.show {
            opacity: 1;
            transform: translateX(-50%) translateY(0);
        }

        .toast svg {
            color: var(--green);
            flex-shrink: 0;
        }

        /* ══ ICON BTN (tambahan di header halaman ini) ══ */
        .icon-btn {
            width: 36px;
            height: 36px;
            background: var(--bg-input);
            border: 1px solid var(--border);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: var(--text-secondary);
            transition: all 0.15s;
            flex-shrink: 0;
            text-decoration: none;
            background: none;
            outline: none;
        }

        .icon-btn:hover {
            border-color: var(--border-focus);
            color: var(--text-primary);
        }

        /* ══ RESPONSIVE ══ */
        @media (max-width: 859px) {

            .top-header-inner,
            .page-topbar {
                padding-left: 16px;
                padding-right: 16px;
            }

            .content-inner {
                padding: 0 16px;
            }

            .hero-wrap {
                padding: 0 16px;
            }
        }

        @media (max-width: 400px) {
            .lokasi-name {
                font-size: 18px;
            }

            .slot-count {
                font-size: 22px;
            }
        }
    </style>
@endsection

@section('content')
    {{-- ════════════ MAIN ════════════ --}}
    <main class="main-wrap">

        {{-- ── Page Top Bar ── --}}
        <div class="page-topbar">
            <a href="{{ url()->previous() }}" class="back-btn">
                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <polyline points="15 18 9 12 15 6" />
                </svg>
            </a>
            <div class="page-topbar-title">Detail Lokasi</div>
            {{-- Share / Copy URL button --}}
            <button class="icon-btn" onclick="copyUrl()" title="Salin tautan halaman ini"
                style="background:var(--bg-input);border:1px solid var(--border);">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2">
                    <circle cx="18" cy="5" r="3" />
                    <circle cx="6" cy="12" r="3" />
                    <circle cx="18" cy="19" r="3" />
                    <line x1="8.59" y1="13.51" x2="15.42" y2="17.49" />
                    <line x1="15.41" y1="6.51" x2="8.59" y2="10.49" />
                </svg>
            </button>
        </div>

        {{-- ── Hero Image ── --}}
        <div class="hero-wrap">
            <div class="hero-img">
                @if ($lokasi->foto)
                    <img src="{{ Storage::url($lokasi->foto) }}" alt="{{ $lokasi->nama }}">
                @else
                    <div
                        style="width:100%;height:100%;background:linear-gradient(135deg,#1e3a5f 0%,#2563eb 60%,#1d4ed8 100%);display:flex;align-items:center;justify-content:center;">
                        <svg width="56" height="56" viewBox="0 0 24 24" fill="none"
                            stroke="rgba(255,255,255,0.25)" stroke-width="1.5">
                            <rect x="1" y="3" width="15" height="13" rx="2" />
                            <path d="M16 8h4a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2h-4" />
                            <circle cx="5.5" cy="18.5" r="2.5" />
                            <circle cx="18.5" cy="18.5" r="2.5" />
                        </svg>
                    </div>
                @endif
                <div class="hero-overlay"></div>

                {{-- Status buka / tutup --}}
                @if ($lokasi->aktif)
                    <div class="hero-status-badge {{ $sedangBuka ? 'open' : 'closed' }}">
                        <div class="hero-status-dot"></div>
                        {{ $sedangBuka ? 'Buka Sekarang' : 'Sedang Tutup' }}
                    </div>
                @else
                    <div class="hero-status-badge closed">
                        <div class="hero-status-dot"></div>
                        Tidak Aktif
                    </div>
                @endif
            </div>
        </div>

        <div class="content-inner">

            {{-- ── Lokasi Header Card ── --}}
            <div class="lokasi-header-card">
                <div class="lokasi-name">{{ $lokasi->nama }}</div>
                <div class="lokasi-type">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2">
                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z" />
                        <circle cx="12" cy="9" r="2.5" />
                    </svg>
                    Lokasi tempat parkir
                </div>
                @if ($lokasi->deskripsi)
                    <div class="lokasi-desc">{{ $lokasi->deskripsi }}</div>
                @else
                    <div class="lokasi-desc" style="color:var(--text-muted);font-style:italic">Deskripsi belum tersedia.
                    </div>
                @endif
            </div>

            {{-- ── Quick Stats ── --}}
            <div class="quick-stats">
                <div class="qs-card">
                    <div class="qs-icon" style="background:var(--blue-soft)">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--blue-main)"
                            stroke-width="2">
                            <rect x="1" y="3" width="15" height="13" rx="2" />
                            <path d="M16 8h4a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2h-4" />
                            <circle cx="5.5" cy="18.5" r="2.5" />
                            <circle cx="18.5" cy="18.5" r="2.5" />
                        </svg>
                    </div>
                    <div class="qs-value" style="color:var(--blue-main)">{{ $totalSlot }}</div>
                    <div class="qs-label">Total Slot</div>
                </div>
                <div class="qs-card">
                    <div class="qs-icon" style="background:var(--green-soft)">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--green)"
                            stroke-width="2">
                            <polyline points="20 6 9 17 4 12" />
                        </svg>
                    </div>
                    <div class="qs-value" style="color:var(--green)">{{ $totalTersedia }}</div>
                    <div class="qs-label">Tersedia</div>
                </div>
                <div class="qs-card">
                    <div class="qs-icon" style="background:var(--amber-soft)">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--amber)"
                            stroke-width="2">
                            <circle cx="12" cy="12" r="10" />
                            <polyline points="12 6 12 12 16 14" />
                        </svg>
                    </div>
                    <div class="qs-value" style="color:var(--amber)">{{ $jamOperasional }}</div>
                    <div class="qs-label">Operasional</div>
                </div>
            </div>

            {{-- ── Informasi Lokasi ── --}}
            <div style="margin-top:26px">
                <div class="section-label">Informasi Lokasi</div>
                <div class="info-group">

                    {{-- Alamat --}}
                    <div class="info-row">
                        <div class="info-icon" style="background:var(--blue-soft)">
                            <svg width="17" height="17" viewBox="0 0 24 24" fill="none"
                                stroke="var(--blue-main)" stroke-width="2">
                                <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z" />
                                <circle cx="12" cy="9" r="2.5" />
                            </svg>
                        </div>
                        <div class="info-body">
                            <div class="info-label">Alamat</div>
                            <div class="info-value">{{ $lokasi->alamat }}</div>
                        </div>
                        <a href="https://maps.google.com/?q={{ $lokasi->latitude }},{{ $lokasi->longitude }}"
                            target="_blank" class="info-action">Peta</a>
                    </div>

                    {{-- Jam Operasional --}}
                    <div class="info-row">
                        <div class="info-icon" style="background:var(--green-soft)">
                            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="var(--green)"
                                stroke-width="2">
                                <circle cx="12" cy="12" r="10" />
                                <polyline points="12 6 12 12 16 14" />
                            </svg>
                        </div>
                        <div class="info-body">
                            <div class="info-label">Jam Operasional</div>
                            <div class="info-value">
                                Setiap hari, {{ \Carbon\Carbon::createFromTimeString($lokasi->jam_buka)->format('H.i') }} –
                                {{ \Carbon\Carbon::createFromTimeString($lokasi->jam_tutup)->format('H.i') }} WIB
                            </div>
                        </div>
                        @if ($lokasi->aktif)
                            <span
                                style="font-size:11px;font-weight:700;padding:4px 10px;border-radius:999px;
              {{ $sedangBuka ? 'background:var(--green-soft);color:var(--green);border:1px solid #a7f3d0' : 'background:var(--red-soft);color:var(--red);border:1px solid #fca5a5' }}">
                                {{ $sedangBuka ? 'Buka' : 'Tutup' }}
                            </span>
                        @endif
                    </div>

                    {{-- Kontak --}}
                    @if ($lokasi->kontak_no_telepon)
                        <div class="info-row">
                            <div class="info-icon" style="background:var(--amber-soft)">
                                <svg width="17" height="17" viewBox="0 0 24 24" fill="none"
                                    stroke="var(--amber)" stroke-width="2">
                                    <path
                                        d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 11.1a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8 9.91a16 16 0 0 0 6 6l.86-.86a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
                                </svg>
                            </div>
                            <div class="info-body">
                                <div class="info-label">Kontak</div>
                                <div class="info-value">{{ $lokasi->kontak_no_telepon }}</div>
                            </div>
                            <a href="tel:{{ $lokasi->kontak_no_telepon }}" class="info-action">Hubungi</a>
                        </div>
                    @endif

                    {{-- Pembayaran --}}
                    <div class="info-row">
                        <div class="info-icon" style="background:#f5f3ff">
                            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="#8b5cf6"
                                stroke-width="2">
                                <rect x="1" y="4" width="22" height="16" rx="2" />
                                <line x1="1" y1="10" x2="23" y2="10" />
                            </svg>
                        </div>
                        <div class="info-body">
                            <div class="info-label">Metode Pembayaran</div>
                            <div class="info-value">QRIS, Transfer Bank, E-Wallet</div>
                        </div>
                    </div>

                </div>
            </div>

            {{-- ── Ketersediaan Slot ── --}}
            <div style="margin-top:22px">
                <div class="section-label">Ketersediaan Slot</div>
                <div class="slot-grid">

                    {{-- Motor --}}
                    <div class="slot-card">
                        <div class="slot-type">Motor</div>
                        <div class="slot-count" style="color:var(--blue-main)">{{ $tersediaMotor }}</div>
                        <div class="slot-avail" style="color:var(--blue-main)">dari {{ $totalMotor }} slot</div>
                        <div class="slot-bar-wrap">
                            <div class="slot-bar" style="width:{{ $pctMotor }}%;background:var(--blue-main)"></div>
                        </div>
                    </div>

                    {{-- Mobil --}}
                    <div class="slot-card">
                        <div class="slot-type">Mobil</div>
                        <div class="slot-count" style="color:var(--green)">{{ $tersediaMobil }}</div>
                        <div class="slot-avail" style="color:var(--green)">dari {{ $totalMobil }} slot</div>
                        <div class="slot-bar-wrap">
                            <div class="slot-bar" style="width:{{ $pctMobil }}%;background:var(--green)"></div>
                        </div>
                    </div>

                </div>
            </div>

            {{-- ── Tarif Parkir ── --}}
            <div style="margin-top:22px">
                <div class="section-label">Tarif Parkir</div>
                <div class="tarif-group">

                    {{-- Motor --}}
                    <div class="tarif-row">
                        <div class="tarif-left">
                            <div class="tarif-icon" style="background:var(--blue-soft)">
                                <svg width="17" height="17" viewBox="0 0 24 24" fill="none"
                                    stroke="var(--blue-main)" stroke-width="2">
                                    <path d="M5 17H3a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11a2 2 0 0 1 2 2v3" />
                                    <rect x="9" y="11" width="14" height="10" rx="1" />
                                    <circle cx="12" cy="21" r="1" />
                                    <circle cx="20" cy="21" r="1" />
                                </svg>
                            </div>
                            <div>
                                <div class="tarif-name">Motor</div>
                                <div class="tarif-note">Per jam</div>
                            </div>
                        </div>
                        <div class="tarif-price">Rp {{ number_format($lokasi->harga_per_jam, 0, ',', '.') }}/Jam</div>
                    </div>

                    {{-- Mobil --}}
                    <div class="tarif-row">
                        <div class="tarif-left">
                            <div class="tarif-icon" style="background:var(--green-soft)">
                                <svg width="17" height="17" viewBox="0 0 24 24" fill="none"
                                    stroke="var(--green)" stroke-width="2">
                                    <rect x="1" y="3" width="15" height="13" rx="2" />
                                    <path d="M16 8h4a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2h-4" />
                                    <circle cx="5.5" cy="18.5" r="2.5" />
                                    <circle cx="18.5" cy="18.5" r="2.5" />
                                </svg>
                            </div>
                            <div>
                                <div class="tarif-name">Mobil</div>
                                <div class="tarif-note">Per jam</div>
                            </div>
                        </div>
                        <div class="tarif-price">Rp {{ number_format($lokasi->harga_per_jam, 0, ',', '.') }}/Jam</div>
                    </div>

                </div>
                <div style="font-size:11.5px;color:var(--text-muted);margin-top:8px;padding-left:4px">
                    * Tarif mobil dihitung 2× tarif dasar. Biaya dihitung per jam penuh.
                </div>
            </div>

            {{-- ── Lokasi di Peta ── --}}
            <div style="margin-top:22px">
                <div class="section-label">Lokasi di Peta</div>
                <a href="https://maps.google.com/?q={{ $lokasi->latitude }},{{ $lokasi->longitude }}" target="_blank"
                    class="map-placeholder">
                    <div class="map-grid"></div>
                    <div class="map-pin"></div>
                    <div class="map-text-wrap">
                        <div class="map-placeholder-text">{{ $lokasi->nama }}</div>
                        <div class="map-placeholder-sub">Ketuk untuk buka di Google Maps</div>
                    </div>
                </a>
            </div>

            @include('components.vr-modal', [
                'lokasi' => $lokasi,
                'slots' => $slotAll, // atau $slots sesuai nama variable controller
                'totalMotor' => $totalMotor,
                'tersediaMotor' => $tersediaMotor,
                'foto360Url'   => $foto360Url,
                'totalMobil' => $totalMobil,
                'tersediaMobil' => $tersediaMobil,
            ])
            {{-- ── CTA ── --}}
            <div style="margin-top:22px">
                <a href="{{ route('user.lokasi.booking.create', $lokasi->id) }}" class="btn-book">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.5">
                        <rect x="1" y="3" width="15" height="13" rx="2" />
                        <path d="M16 8h4a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2h-4" />
                        <circle cx="5.5" cy="18.5" r="2.5" />
                        <circle cx="18.5" cy="18.5" r="2.5" />
                    </svg>
                    Booking Parkir Sekarang
                </a>
                <a href="{{ url()->previous() }}" class="btn-secondary">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2">
                        <polyline points="15 18 9 12 15 6" />
                    </svg>
                    Kembali ke Daftar Lokasi
                </a>
            </div>

            <div style="height:8px"></div>
        </div>{{-- /content-inner --}}
    </main>

    {{-- ════════════ TOAST ════════════ --}}
    <div class="toast" id="toast">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="2.5">
            <polyline points="20 6 9 17 4 12" />
        </svg>
        Link disalin!
    </div>
@endsection

@section('scripts')
    <script>
        function copyUrl() {
            const url = window.location.href;
            if (navigator.clipboard && window.isSecureContext) {
                navigator.clipboard.writeText(url).then(showToast);
            } else {
                // Fallback untuk HTTP
                const ta = document.createElement('textarea');
                ta.value = url;
                ta.style.position = 'fixed';
                ta.style.opacity = '0';
                document.body.appendChild(ta);
                ta.select();
                document.execCommand('copy');
                document.body.removeChild(ta);
                showToast();
            }
        }

        function showToast() {
            const t = document.getElementById('toast');
            t.classList.add('show');
            setTimeout(() => t.classList.remove('show'), 2400);
        }
    </script>
@endsection
