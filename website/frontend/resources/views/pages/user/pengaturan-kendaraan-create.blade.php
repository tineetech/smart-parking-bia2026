@extends('layouts.user')

@section('styles')
    <style>
        /* ══ MAIN WRAPPER & CONTENT ══ */
        .main-wrap {
            width: 100%;
            padding-bottom: calc(var(--bottom-nav-h) + 24px + env(safe-area-inset-bottom));
        }

        .content-inner {
            max-width: 680px;
            margin: 0 auto;
            padding: 0 24px;
            width: 100%;
        }

        /* ══ PAGE TOP BAR ══ */
        .page-topbar {
            max-width: 680px;
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

        /* ══ VEHICLE HERO ══ */
        .vehicle-hero {
            border-radius: 24px;
            margin-top: 20px;
            padding: 28px 24px 22px;
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            overflow: hidden;
            border: 1.5px solid var(--border);
            box-shadow: var(--shadow-sm);
            background: linear-gradient(160deg, #e8f0fc 0%, #d4e4f7 100%);
            transition: background 0.5s ease;
        }

        .hero-bg-circle {
            position: absolute;
            top: -40px;
            right: -40px;
            width: 180px;
            height: 180px;
            border-radius: 50%;
            pointer-events: none;
            background: rgba(37, 99, 235, 0.06);
            transition: background 0.5s ease;
        }

        /* Badge "Kendaraan Baru" — berbeda dari detail (tidak pakai .hero-badge left/right) */
        .hero-badge-new {
            position: absolute;
            top: 14px;
            left: 14px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 11px;
            font-weight: 700;
            padding: 5px 12px;
            border-radius: 999px;
            font-family: 'Poppins', sans-serif;
            background: var(--blue-soft);
            color: var(--blue-main);
            border: 1px solid var(--blue-pale);
        }

        .hero-car-wrap {
            width: 100%;
            max-width: 300px;
            height: 160px;
            margin: 8px 0 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: floatCar 3s ease-in-out infinite;
            position: relative;
            z-index: 1;
        }

        @keyframes floatCar {

            0%,
            100% {
                transform: translateY(0)
            }

            50% {
                transform: translateY(-7px)
            }
        }

        #car-body,
        #car-roof,
        #car-shadow,
        #motor-body {
            transition: fill 0.4s ease;
        }

        .hero-vehicle-name {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 22px;
            font-weight: 800;
            color: var(--text-primary);
            letter-spacing: -0.5px;
            text-align: center;
            transition: color 0.3s;
            position: relative;
            z-index: 1;
        }

        .hero-vehicle-sub {
            font-size: 12px;
            color: var(--text-muted);
            margin-top: 3px;
            font-weight: 500;
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .hero-plate-chip {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            margin-top: 12px;
            background: var(--bg-surface);
            border: 1.5px solid var(--border);
            border-radius: 10px;
            padding: 7px 16px;
            font-family: 'Space Grotesk', sans-serif;
            font-size: 15px;
            font-weight: 800;
            color: var(--text-primary);
            letter-spacing: 0.08em;
            box-shadow: var(--shadow-sm);
            position: relative;
            z-index: 1;
        }

        .hero-plate-chip.placeholder {
            color: var(--text-muted);
            font-weight: 600;
            font-size: 13px;
            letter-spacing: 0;
        }

        /* ══ STEP INDICATOR ══ */
        .step-indicator {
            display: flex;
            align-items: center;
            gap: 0;
            margin-top: 20px;
            margin-bottom: 4px;
            background: var(--bg-card);
            border: 1.5px solid var(--border);
            border-radius: 16px;
            padding: 12px 16px;
            box-shadow: var(--shadow-sm);
            overflow: hidden;
        }

        .step-item {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 4px;
            position: relative;
        }

        .step-item:not(:last-child)::after {
            content: '';
            position: absolute;
            top: 13px;
            left: calc(50% + 14px);
            width: calc(100% - 28px);
            height: 2px;
            background: var(--border);
            border-radius: 999px;
            transition: background 0.3s;
        }

        .step-item.done:not(:last-child)::after {
            background: var(--blue-main);
        }

        .step-num {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: 700;
            font-family: 'Space Grotesk', sans-serif;
            background: var(--bg-input);
            color: var(--text-muted);
            border: 2px solid var(--border);
            transition: all 0.25s;
            position: relative;
            z-index: 1;
        }

        .step-item.active .step-num {
            background: var(--blue-main);
            color: #fff;
            border-color: var(--blue-main);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
        }

        .step-item.done .step-num {
            background: var(--green);
            color: #fff;
            border-color: var(--green);
        }

        .step-label {
            font-size: 10px;
            font-weight: 600;
            color: var(--text-muted);
            white-space: nowrap;
        }

        .step-item.active .step-label {
            color: var(--blue-main);
        }

        .step-item.done .step-label {
            color: var(--green);
        }

        /* ══ ALERT ERROR ══ */
        .alert-error {
            background: var(--red-soft);
            border: 1.5px solid rgba(239, 68, 68, 0.25);
            border-radius: 14px;
            padding: 12px 16px;
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 16px;
            margin-top: 16px;
        }

        .alert-error-icon {
            color: var(--red);
            flex-shrink: 0;
            margin-top: 1px;
        }

        .alert-error-text {
            font-size: 12px;
            color: #b91c1c;
            line-height: 1.6;
        }

        .alert-error-text ul {
            padding-left: 16px;
            margin-top: 4px;
        }

        .alert-error-text li {
            margin-bottom: 2px;
        }

        /* ══ SECTION LABEL ══ */
        .section-label {
            font-size: 11px;
            font-weight: 700;
            color: var(--text-muted);
            letter-spacing: 0.08em;
            text-transform: uppercase;
            margin: 24px 0 10px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .section-label-line {
            flex: 1;
            height: 1px;
            background: var(--border);
        }

        /* ══ FORM ══ */
        .form-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
            margin-bottom: 12px;
        }

        .form-label {
            font-size: 12px;
            font-weight: 600;
            color: var(--text-secondary);
            padding-left: 4px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .form-label .required {
            color: var(--red);
            font-size: 11px;
        }

        .form-label .optional {
            color: var(--text-muted);
            font-size: 10px;
            font-weight: 500;
            background: var(--bg-input);
            padding: 1px 7px;
            border-radius: 999px;
        }

        .form-field {
            background: var(--bg-card);
            border: 1.5px solid var(--border);
            border-radius: 16px;
            padding: 14px 18px;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            font-weight: 500;
            color: var(--text-primary);
            outline: none;
            width: 100%;
            transition: border-color 0.18s, box-shadow 0.18s;
            box-shadow: var(--shadow-sm);
        }

        .form-field:focus {
            border-color: var(--blue-main);
            box-shadow: 0 0 0 3.5px rgba(37, 99, 235, 0.10);
        }

        .form-field::placeholder {
            color: var(--text-muted);
            font-weight: 400;
        }

        .form-field.is-invalid {
            border-color: var(--red);
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.08);
        }

        .field-error {
            font-size: 11px;
            color: var(--red);
            padding-left: 4px;
            margin-top: 2px;
        }

        .form-select {
            background: var(--bg-card);
            border: 1.5px solid var(--border);
            border-radius: 16px;
            padding: 14px 44px 14px 18px;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            font-weight: 500;
            color: var(--text-primary);
            outline: none;
            width: 100%;
            transition: border-color 0.18s;
            box-shadow: var(--shadow-sm);
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%2394a3b8' stroke-width='2' xmlns='http://www.w3.org/2000/svg'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 16px center;
        }

        .form-select:focus {
            border-color: var(--blue-main);
            box-shadow: 0 0 0 3.5px rgba(37, 99, 235, 0.10);
        }

        .form-select.is-invalid {
            border-color: var(--red);
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.08);
        }

        /* ══ JENIS SELECTOR ══ */
        .jenis-selector {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        .jenis-option {
            background: var(--bg-card);
            border: 1.5px solid var(--border);
            border-radius: 16px;
            padding: 14px 16px;
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            transition: all 0.2s;
            box-shadow: var(--shadow-sm);
        }

        .jenis-option:hover {
            border-color: var(--blue-pale);
            background: var(--bg-hover);
        }

        .jenis-option.selected {
            border-color: var(--blue-main);
            background: var(--blue-soft);
        }

        .jenis-icon {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--bg-input);
            color: var(--text-muted);
            flex-shrink: 0;
            transition: all 0.2s;
        }

        .jenis-option.selected .jenis-icon {
            background: var(--blue-pale);
            color: var(--blue-main);
        }

        .jenis-text-wrap {
            flex: 1;
            min-width: 0;
        }

        .jenis-title {
            font-size: 13px;
            font-weight: 700;
            color: var(--text-primary);
        }

        .jenis-option.selected .jenis-title {
            color: var(--blue-main);
        }

        .jenis-sub {
            font-size: 10.5px;
            color: var(--text-muted);
            margin-top: 1px;
        }

        .jenis-check {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            border: 2px solid var(--border);
            background: var(--bg-input);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: all 0.2s;
        }

        .jenis-option.selected .jenis-check {
            background: var(--blue-main);
            border-color: var(--blue-main);
        }

        .jenis-check svg {
            display: none;
        }

        .jenis-option.selected .jenis-check svg {
            display: block;
        }

        /* ══ COLOR PICKER ══ */
        .color-row {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            padding: 4px 0 6px;
        }

        .color-dot {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            cursor: pointer;
            border: 2.5px solid transparent;
            transition: transform 0.18s, border-color 0.18s, box-shadow 0.18s;
            flex-shrink: 0;
            position: relative;
        }

        .color-dot:hover {
            transform: scale(1.15);
        }

        .color-dot.selected {
            border-color: var(--blue-main);
            transform: scale(1.18);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.18);
        }

        .color-dot.selected::after {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.28);
        }

        .color-hint {
            font-size: 12px;
            color: var(--text-muted);
            margin-top: 6px;
            padding-left: 4px;
        }

        .color-hint strong {
            color: var(--text-primary);
        }

        /* ══ CHECKBOX CARD ══ */
        .checkbox-card {
            background: var(--bg-card);
            border: 1.5px solid var(--border);
            border-radius: 16px;
            padding: 14px 18px;
            display: flex;
            align-items: center;
            gap: 14px;
            box-shadow: var(--shadow-sm);
            cursor: pointer;
            transition: border-color 0.2s, background 0.2s;
            margin-bottom: 12px;
            user-select: none;
        }

        .checkbox-card:hover {
            border-color: var(--blue-pale);
            background: var(--bg-hover);
        }

        .checkbox-card.checked {
            border-color: var(--blue-main);
            background: var(--blue-soft);
        }

        .checkbox-box {
            width: 22px;
            height: 22px;
            border-radius: 7px;
            border: 2px solid var(--border);
            background: var(--bg-input);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: all 0.2s;
        }

        .checkbox-card.checked .checkbox-box {
            background: var(--blue-main);
            border-color: var(--blue-main);
        }

        .checkbox-box svg {
            display: none;
        }

        .checkbox-card.checked .checkbox-box svg {
            display: block;
        }

        .checkbox-info {
            flex: 1;
        }

        .checkbox-title {
            font-size: 14px;
            font-weight: 600;
            color: var(--text-primary);
        }

        .checkbox-card.checked .checkbox-title {
            color: var(--blue-main);
        }

        .checkbox-sub {
            font-size: 12px;
            color: var(--text-muted);
            margin-top: 2px;
        }

        .star-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            background: var(--amber-soft);
            color: var(--amber);
            font-size: 10.5px;
            font-weight: 700;
            padding: 3px 10px;
            border-radius: 999px;
            border: 1px solid rgba(245, 158, 11, 0.2);
            opacity: 0;
            transition: opacity 0.2s;
        }

        .checkbox-card.checked .star-badge {
            opacity: 1;
        }

        /* ══ INFO BOX ══ */
        .info-box {
            background: var(--blue-soft);
            border: 1.5px solid var(--blue-pale);
            border-radius: 14px;
            padding: 12px 16px;
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 12px;
        }

        .info-box-icon {
            color: var(--blue-main);
            flex-shrink: 0;
            margin-top: 1px;
        }

        .info-box-text {
            font-size: 12px;
            color: var(--text-secondary);
            line-height: 1.6;
        }

        .info-box-text strong {
            color: var(--blue-main);
        }

        /* ══ SUBMIT / CANCEL BUTTONS ══ */
        .submit-btn {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            background: var(--blue-main);
            color: #fff;
            border: none;
            border-radius: 18px;
            padding: 17px 24px;
            font-size: 15px;
            font-weight: 700;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
            transition: background 0.16s, transform 0.15s;
            box-shadow: 0 4px 16px rgba(37, 99, 235, 0.30);
            margin-top: 20px;
            letter-spacing: 0.01em;
        }

        .submit-btn:hover {
            background: var(--blue-bright);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(37, 99, 235, 0.35);
        }

        .submit-btn:active {
            transform: scale(0.98);
        }

        .cancel-btn {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: transparent;
            color: var(--text-muted);
            border: none;
            border-radius: 18px;
            padding: 13px 24px;
            font-size: 13px;
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
            transition: color 0.15s;
            margin-top: 6px;
            text-decoration: none;
        }

        .cancel-btn:hover {
            color: var(--text-secondary);
        }

        /* ══ TOAST ══ */
        .toast {
            position: fixed;
            bottom: 100px;
            left: 50%;
            transform: translateX(-50%) translateY(20px);
            background: #0f1e36;
            color: #fff;
            padding: 11px 20px;
            border-radius: 14px;
            font-size: 13px;
            font-weight: 500;
            font-family: 'Poppins', sans-serif;
            opacity: 0;
            transition: all 0.3s;
            pointer-events: none;
            white-space: nowrap;
            z-index: 9999;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.25);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .toast.show {
            opacity: 1;
            transform: translateX(-50%) translateY(0);
        }

        /* ══ RESPONSIVE ══ */
        @media (max-width: 859px) {
            .page-topbar {
                padding: 20px 16px 0;
            }

            .content-inner {
                padding: 0 16px;
            }
        }

        @media (max-width: 420px) {
            .hero-vehicle-name {
                font-size: 18px;
            }

            .jenis-title {
                font-size: 12px;
            }

            .jenis-sub {
                display: none;
            }
        }
    </style>
@endsection

@section('content')

    <!-- ════════════ MAIN ════════════ -->
    <main class="main-wrap">

        <div class="page-topbar">
            <a class="back-btn" href="{{ route('user.kendaraan') }}" title="Kembali">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2.5">
                    <polyline points="15 18 9 12 15 6" />
                </svg>
            </a>
            <div class="page-topbar-title">Tambah Kendaraan</div>
            <div style="width:38px"></div>
        </div>

        <div class="content-inner">

            {{-- ── LARAVEL VALIDATION ERRORS ── --}}
            @if ($errors->any())
                <div class="alert-error">
                    <div class="alert-error-icon">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <circle cx="12" cy="12" r="10" />
                            <line x1="12" y1="8" x2="12" y2="12" />
                            <line x1="12" y1="16" x2="12.01" y2="16" />
                        </svg>
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

            {{-- ── PREVIEW HERO ── --}}
            <div class="vehicle-hero" id="vehicleHero">
                <div class="hero-bg-circle" id="heroBgCircle"></div>
                <div class="hero-badge-new">
                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.5">
                        <line x1="12" y1="5" x2="12" y2="19" />
                        <line x1="5" y1="12" x2="19" y2="12" />
                    </svg>
                    Kendaraan Baru
                </div>

                <div class="hero-car-wrap" id="heroCarWrap">
                    <!-- Mobil SVG (default) -->
                    <svg id="carSvgMobil" width="280" height="140" viewBox="0 0 300 150" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <ellipse id="car-shadow" cx="150" cy="130" rx="120" ry="10"
                            fill="rgba(37,99,235,0.08)" />
                        <path id="car-body"
                            d="M30 95 L30 78 Q30 68 42 65 L72 45 Q85 36 110 34 L190 34 Q215 34 228 45 L258 65 Q270 68 270 78 L270 95 Q270 102 263 102 L37 102 Q30 102 30 95Z"
                            fill="#e8ecf2" stroke="#c8d4e8" stroke-width="1.5" />
                        <path id="car-roof" d="M72 45 Q85 30 112 28 L190 28 Q218 28 228 45Z" fill="#f0f4fa"
                            stroke="#c8d4e8" stroke-width="1.5" />
                        <path d="M176 45 L176 30 L192 30 Q214 30 225 45Z" fill="#bfdbfe" stroke="#93c5fd" stroke-width="1"
                            opacity="0.85" />
                        <path d="M75 45 L88 29 L172 29 L172 45Z" fill="#bfdbfe" stroke="#93c5fd" stroke-width="1"
                            opacity="0.85" />
                        <line x1="172" y1="28" x2="174" y2="102" stroke="#c8d4e8"
                            stroke-width="1.5" />
                        <circle cx="82" cy="103" r="22" fill="#475569" stroke="#334155" stroke-width="2" />
                        <circle cx="82" cy="103" r="13" fill="#64748b" />
                        <circle cx="82" cy="103" r="6" fill="#94a3b8" />
                        <circle cx="82" cy="103" r="3" fill="#cbd5e1" />
                        <circle cx="218" cy="103" r="22" fill="#475569" stroke="#334155"
                            stroke-width="2" />
                        <circle cx="218" cy="103" r="13" fill="#64748b" />
                        <circle cx="218" cy="103" r="6" fill="#94a3b8" />
                        <circle cx="218" cy="103" r="3" fill="#cbd5e1" />
                        <ellipse cx="265" cy="80" rx="7" ry="5" fill="#fef9c3"
                            stroke="#fde047" stroke-width="1.5" opacity="0.9" />
                        <ellipse cx="265" cy="80" rx="4" ry="3" fill="#fef08a"
                            opacity="0.7" />
                        <ellipse cx="35" cy="80" rx="6" ry="4.5" fill="#fca5a5"
                            stroke="#ef4444" stroke-width="1.5" opacity="0.85" />
                        <rect x="253" y="86" width="14" height="3" rx="1.5" fill="#94a3b8"
                            opacity="0.7" />
                        <rect x="253" y="91" width="14" height="2" rx="1" fill="#94a3b8"
                            opacity="0.5" />
                        <rect x="115" y="70" width="14" height="4" rx="2" fill="#94a3b8" />
                        <rect x="178" y="70" width="14" height="4" rx="2" fill="#94a3b8" />
                        <path d="M42 90 L258 90" stroke="#c8d4e8" stroke-width="1" opacity="0.5" />
                    </svg>

                    <!-- Motor SVG (hidden by default) -->
                    <svg id="carSvgMotor" style="display:none" width="240" height="140" viewBox="0 0 280 150"
                        fill="none" xmlns="http://www.w3.org/2000/svg">
                        <ellipse cx="140" cy="136" rx="110" ry="9"
                            fill="rgba(37,99,235,0.08)" />
                        <circle cx="68" cy="110" r="32" fill="#475569" stroke="#334155"
                            stroke-width="2.5" />
                        <circle cx="68" cy="110" r="20" fill="#64748b" />
                        <circle cx="68" cy="110" r="10" fill="#94a3b8" />
                        <circle cx="68" cy="110" r="5" fill="#cbd5e1" />
                        <circle cx="212" cy="110" r="32" fill="#475569" stroke="#334155"
                            stroke-width="2.5" />
                        <circle cx="212" cy="110" r="20" fill="#64748b" />
                        <circle cx="212" cy="110" r="10" fill="#94a3b8" />
                        <circle cx="212" cy="110" r="5" fill="#cbd5e1" />
                        <path id="motor-body" d="M68 80 L100 50 L160 50 L220 78 L212 80 L160 68 L100 68 Z" fill="#e8ecf2"
                            stroke="#c8d4e8" stroke-width="1.5" />
                        <path d="M100 50 L106 38 L170 38 L160 50 Z" fill="#94a3b8" stroke="#64748b" stroke-width="1.5" />
                        <path d="M185 54 L220 78 L220 90 L200 90 L185 68 Z" fill="#cbd5e1" stroke="#94a3b8"
                            stroke-width="1.2" />
                        <rect x="198" y="50" width="26" height="5" rx="2.5" fill="#64748b" />
                        <ellipse cx="224" cy="66" rx="7" ry="5" fill="#fef9c3"
                            stroke="#fde047" stroke-width="1.5" opacity="0.9" />
                        <ellipse cx="60" cy="80" rx="5" ry="4" fill="#fca5a5"
                            stroke="#ef4444" stroke-width="1.5" opacity="0.85" />
                        <path d="M75 100 L55 105 L50 108" stroke="#94a3b8" stroke-width="3" stroke-linecap="round" />
                        <rect x="105" y="68" width="55" height="32" rx="8" fill="#94a3b8"
                            stroke="#64748b" stroke-width="1.2" />
                        <rect x="112" y="75" width="40" height="18" rx="5" fill="#b2bfcf" />
                    </svg>
                </div>

                <div class="hero-vehicle-name" id="heroName">Nama Kendaraan</div>
                <div class="hero-vehicle-sub">Preview kendaraan baru Anda</div>
                <div class="hero-plate-chip placeholder" id="heroPlate">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.5">
                        <rect x="2" y="7" width="20" height="14" rx="2" />
                        <path d="M16 3h-8v4h8z" />
                    </svg>
                    <span id="heroPlateText">Plat Nomor</span>
                </div>
            </div>

            {{-- ── STEP INDICATOR ── --}}
            <div class="step-indicator">
                <div class="step-item active" id="step1">
                    <div class="step-num">1</div>
                    <div class="step-label">Jenis</div>
                </div>
                <div class="step-item" id="step2">
                    <div class="step-num">2</div>
                    <div class="step-label">Identitas</div>
                </div>
                <div class="step-item" id="step3">
                    <div class="step-num">3</div>
                    <div class="step-label">Detail</div>
                </div>
                <div class="step-item" id="step4">
                    <div class="step-num">4</div>
                    <div class="step-label">Preferensi</div>
                </div>
            </div>

            {{-- ════════════════════════════════
         FORM — POST ke user.kendaraan.store
    ════════════════════════════════ --}}
            <form action="{{ route('user.kendaraan.store') }}" method="POST" id="formKendaraan" novalidate>
                @csrf

                {{-- Hidden input jenis & warna diisi via JS --}}
                <input type="hidden" name="jenis" id="inputJenis" value="{{ old('jenis', 'mobil') }}">
                <input type="hidden" name="warna" id="inputWarna" value="{{ old('warna', 'Putih') }}">
                {{-- Utama: value 1 jika dicentang, dikirim lewat JS --}}
                <input type="hidden" name="utama" id="inputUtama" value="{{ old('utama', '0') }}">

                {{-- ════ STEP 1: JENIS ════ --}}
                <div class="section-label" id="labelJenis">
                    Jenis Kendaraan <span style="color:var(--red);font-size:11px">*</span>
                    <div class="section-label-line"></div>
                </div>

                <div class="jenis-selector">
                    <div class="jenis-option {{ old('jenis', 'mobil') === 'mobil' ? 'selected' : '' }}"
                        id="jenisOptionMobil" onclick="selectJenis('mobil')">
                        <div class="jenis-icon">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <rect x="1" y="3" width="15" height="13" rx="2" />
                                <path d="M16 8h4a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2h-4" />
                                <circle cx="5.5" cy="18.5" r="2.5" />
                                <circle cx="18.5" cy="18.5" r="2.5" />
                            </svg>
                        </div>
                        <div class="jenis-text-wrap">
                            <div class="jenis-title">Mobil</div>
                            <div class="jenis-sub">Sedan, SUV, MPV, dll</div>
                        </div>
                        <div class="jenis-check">
                            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="#fff"
                                stroke-width="3">
                                <polyline points="20 6 9 17 4 12" />
                            </svg>
                        </div>
                    </div>

                    <div class="jenis-option {{ old('jenis') === 'motor' ? 'selected' : '' }}" id="jenisOptionMotor"
                        onclick="selectJenis('motor')">
                        <div class="jenis-icon">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <path d="M5 17H3a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v5" />
                                <circle cx="16" cy="17" r="3" />
                                <circle cx="8" cy="17" r="3" />
                            </svg>
                        </div>
                        <div class="jenis-text-wrap">
                            <div class="jenis-title">Motor</div>
                            <div class="jenis-sub">Matic, sport, bebek</div>
                        </div>
                        <div class="jenis-check">
                            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="#fff"
                                stroke-width="3">
                                <polyline points="20 6 9 17 4 12" />
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- ════ STEP 2: IDENTITAS ════ --}}
                <div class="section-label" style="margin-top:24px">
                    Identitas Kendaraan <span style="color:var(--red);font-size:11px">*</span>
                    <div class="section-label-line"></div>
                </div>

                {{-- Merek --}}
                <div class="form-group">
                    <div class="form-label">
                        Merek <span class="required">*</span>
                    </div>
                    <select class="form-select {{ $errors->has('merek') ? 'is-invalid' : '' }}" id="merekKendaraan"
                        name="merek" onchange="onMerekChange()">
                        <option value="">-- Pilih Merek --</option>
                        {{-- Mobil brands --}}
                        <optgroup label="Mobil" id="groupMobil">
                            @foreach (['BMW', 'Toyota', 'Honda', 'Suzuki', 'Mitsubishi', 'Daihatsu', 'Mercedes-Benz', 'Audi', 'Hyundai', 'Kia', 'Wuling', 'MG'] as $b)
                                <option value="{{ $b }}" {{ old('merek') === $b ? 'selected' : '' }}>
                                    {{ $b }}</option>
                            @endforeach
                        </optgroup>
                        {{-- Motor brands --}}
                        <optgroup label="Motor" id="groupMotor">
                            @foreach (['Yamaha', 'Kawasaki', 'Vespa'] as $b)
                                <option value="{{ $b }}" {{ old('merek') === $b ? 'selected' : '' }}>
                                    {{ $b }}</option>
                            @endforeach
                        </optgroup>
                        {{-- Shared --}}
                        <option value="Lainnya" {{ old('merek') === 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                    @error('merek')
                        <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Model: pilih dari datalist ATAU ketik bebas --}}
                <div class="form-group">
                    <div class="form-label">
                        Model / Varian <span class="required">*</span>
                    </div>
                    <input class="form-field {{ $errors->has('model') ? 'is-invalid' : '' }}" type="text"
                        id="modelKendaraan" name="model" placeholder="Contoh: Avanza G, NMAX 155, Civic RS..."
                        value="{{ old('model') }}" list="modelSuggestions" autocomplete="off"
                        oninput="onModelChange()" />
                    <datalist id="modelSuggestions"></datalist>
                    @error('model')
                        <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Plat Nomor --}}
                <div class="form-group">
                    <div class="form-label">
                        Plat Nomor <span class="required">*</span>
                    </div>
                    <input class="form-field {{ $errors->has('plat_nomor') ? 'is-invalid' : '' }}" type="text"
                        id="platNomor" name="plat_nomor" placeholder="Contoh: B 1234 AB"
                        value="{{ old('plat_nomor') }}"
                        style="font-family:'Space Grotesk',sans-serif;font-weight:700;letter-spacing:0.08em;text-transform:uppercase"
                        oninput="onPlatInput(this)" maxlength="12" />
                    @error('plat_nomor')
                        <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- ════ STEP 3: WARNA ════ --}}
                <div class="section-label" style="margin-top:24px">
                    Detail Kendaraan
                    <div class="section-label-line"></div>
                </div>

                <div class="form-group">
                    <div class="form-label">
                        Warna Kendaraan <span class="optional">Opsional</span>
                    </div>
                    <div class="color-row" id="colorPicker"></div>
                    <div class="color-hint">Warna dipilih: <strong id="colorName">Putih</strong></div>
                </div>

                {{-- ════ STEP 4: PREFERENSI ════ --}}
                <div class="section-label" style="margin-top:24px">
                    Preferensi
                    <div class="section-label-line"></div>
                </div>

                <div class="checkbox-card {{ old('utama') ? 'checked' : '' }}" id="checkboxCard"
                    onclick="toggleCheckbox()">
                    <div class="checkbox-box" id="checkboxBox">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#fff"
                            stroke-width="3">
                            <polyline points="20 6 9 17 4 12" />
                        </svg>
                    </div>
                    <div class="checkbox-info">
                        <div class="checkbox-title">Jadikan Kendaraan Utama</div>
                        <div class="checkbox-sub">Digunakan sebagai default saat parkir</div>
                    </div>
                    <div class="star-badge">
                        <svg width="10" height="10" viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                        </svg>
                        Utama
                    </div>
                </div>

                <div class="info-box">
                    <div class="info-box-icon">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <circle cx="12" cy="12" r="10" />
                            <line x1="12" y1="8" x2="12" y2="12" />
                            <line x1="12" y1="16" x2="12.01" y2="16" />
                        </svg>
                    </div>
                    <div class="info-box-text">
                        Data kendaraan yang kamu daftarkan akan diverifikasi oleh sistem.
                        Pastikan <strong>plat nomor sesuai dengan STNK</strong> agar proses parkir berjalan lancar.
                    </div>
                </div>

                <button type="submit" class="submit-btn" id="submitBtn">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.5">
                        <line x1="12" y1="5" x2="12" y2="19" />
                        <line x1="5" y1="12" x2="19" y2="12" />
                    </svg>
                    Tambah Kendaraan
                </button>

            </form>

            <a class="cancel-btn" href="{{ route('user.kendaraan') }}">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2">
                    <polyline points="15 18 9 12 15 6" />
                </svg>
                Batal, kembali ke daftar
            </a>

        </div>
    </main>

    <!-- TOAST -->
    <div class="toast" id="toast">
        <span id="toastIcon"></span>
        <span id="toastMsg"></span>
    </div>
@endsection


@section('scripts')
    <script>
        /* ═══════════════════════════════════════
       DATA — model suggestions per brand
    ═══════════════════════════════════════ */
        const modelsByBrand = {
            'BMW': ['M4 CS/CSL', 'M3 Competition', 'X5 xDrive40i', '320i Sport', '118i', 'Z4 sDrive30i', 'X3 xDrive30i',
                'iX3'
            ],
            'Toyota': ['Avanza G', 'Avanza Veloz', 'Innova Reborn', 'Fortuner VRZ', 'Camry Hybrid', 'Yaris GR Sport',
                'Hilux', 'Rush', 'Raize'
            ],
            'Honda': ['Jazz RS', 'Brio Satya', 'Brio RS', 'HR-V Turbo', 'CR-V Prestige', 'Civic RS', 'WR-V', 'BR-V',
                'City Hatchback'
            ],
            'Suzuki': ['Ertiga GX', 'Ertiga Hybrid', 'Baleno', 'XL7 Alpha', 'Ignis GX', 'S-Presso', 'Carry Pick Up',
                'Address 125'
            ],
            'Mitsubishi': ['Xpander', 'Xpander Cross', 'Pajero Sport', 'Outlander PHEV', 'Eclipse Cross', 'L300',
                'Colt L300'
            ],
            'Daihatsu': ['Sigra R', 'Ayla X', 'Ayla R', 'Terios R', 'Gran Max', 'Rocky'],
            'Yamaha': ['NMAX 155', 'Aerox 155', 'R15', 'MT-15', 'Lexi', 'Mio M3', 'XMAX 250', 'Freego'],
            'Kawasaki': ['Ninja 250', 'Ninja ZX-25R', 'Z250', 'KLX 230', 'Versys 650', 'W175', 'Z650'],
            'Mercedes-Benz': ['C 300 AMG', 'E 300', 'GLC 300', 'A 200', 'CLA 200', 'GLE 450'],
            'Audi': ['A4 Quattro', 'Q5 TFSI', 'Q3 S Line', 'A6 Progressive', 'TT Roadster', 'e-tron'],
            'Hyundai': ['Creta Prime', 'Ioniq 5', 'Ioniq 6', 'Stargazer', 'Palisade', 'Tucson'],
            'Kia': ['Sportage', 'Sonet', 'EV6', 'Carnival', 'Seltos', 'Picanto'],
            'Wuling': ['Almaz RS', 'Air EV', 'Confero S', 'Cortez CT'],
            'MG': ['MG 5', 'ZS EV', 'RX5', 'VS HEV', 'MG4 EV'],
            'Vespa': ['GTS 300', 'Sprint 150', 'Primavera 150', '946', 'Elettrica'],
            'Lainnya': ['Lainnya / Tidak ada dalam daftar'],
        };

        const motorBrands = ['Yamaha', 'Kawasaki', 'Vespa', 'Honda', 'Suzuki', 'Lainnya'];
        const mobilBrands = ['BMW', 'Toyota', 'Honda', 'Suzuki', 'Mitsubishi', 'Daihatsu', 'Mercedes-Benz', 'Audi',
            'Hyundai', 'Kia', 'Wuling', 'MG', 'Lainnya'
        ];

        const colors = [{
                name: 'Putih',
                hex: '#f8fafc',
                bodyFill: '#e8ecf2',
                roofFill: '#f0f4fa',
                heroBg: 'linear-gradient(160deg,#e8f0fc 0%,#d4e4f7 100%)',
                circleBg: 'rgba(37,99,235,0.06)',
                stroke: '#c8d4e8'
            },
            {
                name: 'Hitam',
                hex: '#1e293b',
                bodyFill: '#1e293b',
                roofFill: '#0f172a',
                heroBg: 'linear-gradient(160deg,#1e293b 0%,#0f172a 100%)',
                circleBg: 'rgba(255,255,255,0.06)',
                stroke: '#334155'
            },
            {
                name: 'Silver',
                hex: '#94a3b8',
                bodyFill: '#94a3b8',
                roofFill: '#b2bfcf',
                heroBg: 'linear-gradient(160deg,#e2e8f0 0%,#cbd5e1 100%)',
                circleBg: 'rgba(148,163,184,0.12)',
                stroke: '#64748b'
            },
            {
                name: 'Merah',
                hex: '#ef4444',
                bodyFill: '#ef4444',
                roofFill: '#dc2626',
                heroBg: 'linear-gradient(160deg,#fee2e2 0%,#fecaca 100%)',
                circleBg: 'rgba(239,68,68,0.08)',
                stroke: '#dc2626'
            },
            {
                name: 'Biru',
                hex: '#3b82f6',
                bodyFill: '#3b82f6',
                roofFill: '#2563eb',
                heroBg: 'linear-gradient(160deg,#dbeafe 0%,#bfdbfe 100%)',
                circleBg: 'rgba(59,130,246,0.1)',
                stroke: '#2563eb'
            },
            {
                name: 'Kuning',
                hex: '#f59e0b',
                bodyFill: '#f59e0b',
                roofFill: '#d97706',
                heroBg: 'linear-gradient(160deg,#fef3c7 0%,#fde68a 100%)',
                circleBg: 'rgba(245,158,11,0.1)',
                stroke: '#d97706'
            },
            {
                name: 'Hijau',
                hex: '#10b981',
                bodyFill: '#10b981',
                roofFill: '#059669',
                heroBg: 'linear-gradient(160deg,#d1fae5 0%,#a7f3d0 100%)',
                circleBg: 'rgba(16,185,129,0.1)',
                stroke: '#059669'
            },
            {
                name: 'Abu-abu',
                hex: '#64748b',
                bodyFill: '#64748b',
                roofFill: '#475569',
                heroBg: 'linear-gradient(160deg,#f1f5f9 0%,#e2e8f0 100%)',
                circleBg: 'rgba(100,116,139,0.1)',
                stroke: '#475569'
            },
            {
                name: 'Oranye',
                hex: '#f97316',
                bodyFill: '#f97316',
                roofFill: '#ea580c',
                heroBg: 'linear-gradient(160deg,#ffedd5 0%,#fed7aa 100%)',
                circleBg: 'rgba(249,115,22,0.1)',
                stroke: '#ea580c'
            },
            {
                name: 'Ungu',
                hex: '#8b5cf6',
                bodyFill: '#8b5cf6',
                roofFill: '#7c3aed',
                heroBg: 'linear-gradient(160deg,#ede9fe 0%,#ddd6fe 100%)',
                circleBg: 'rgba(139,92,246,0.1)',
                stroke: '#7c3aed'
            },
        ];

        /* ═══════════════════════════════════════
           STATE (restored from old() via PHP)
        ═══════════════════════════════════════ */
        let selectedJenis = document.getElementById('inputJenis').value || 'mobil';
        let selectedColorIndex = 0;
        let isUtama = document.getElementById('inputUtama').value === '1';

        // Restore checkbox visual state
        if (isUtama) {
            document.getElementById('checkboxCard').classList.add('checked');
        }

        /* ═══════════════════════════════════════
           JENIS SELECTOR
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
            updateStepIndicator();
        }

        function filterMerekByJenis(jenis) {
            const allowed = jenis === 'motor' ? motorBrands : mobilBrands;
            const sel = document.getElementById('merekKendaraan');

            // show/hide optgroups
            document.getElementById('groupMobil').hidden = (jenis === 'motor');
            document.getElementById('groupMotor').hidden = (jenis === 'mobil');

            // if current value not allowed reset it
            if (sel.value && !allowed.includes(sel.value)) {
                sel.value = '';
                updateHeroName();
                updateModelSuggestions('');
            }
        }

        /* ═══════════════════════════════════════
           MEREK & MODEL
        ═══════════════════════════════════════ */
        function onMerekChange() {
            const merek = document.getElementById('merekKendaraan').value;
            updateModelSuggestions(merek);
            updateHeroName();
            updateStepIndicator();
        }

        function updateModelSuggestions(merek) {
            const dl = document.getElementById('modelSuggestions');
            dl.innerHTML = '';
            const models = modelsByBrand[merek] || [];
            models.forEach(m => {
                const opt = document.createElement('option');
                opt.value = m;
                dl.appendChild(opt);
            });
        }

        function onModelChange() {
            updateHeroName();
            updateStepIndicator();
        }

        function updateHeroName() {
            const merek = document.getElementById('merekKendaraan').value;
            const model = document.getElementById('modelKendaraan').value.trim();
            const heroName = document.getElementById('heroName');
            heroName.textContent = merek && model ? merek + ' ' + model : merek || 'Nama Kendaraan';
        }

        /* ═══════════════════════════════════════
           PLAT NOMOR
        ═══════════════════════════════════════ */
        function onPlatInput(input) {
            const pos = input.selectionStart;
            input.value = input.value.toUpperCase();
            input.setSelectionRange(pos, pos);

            const val = input.value.trim();
            const plateEl = document.getElementById('heroPlate');
            const plateTextEl = document.getElementById('heroPlateText');

            if (val) {
                plateEl.classList.remove('placeholder');
                plateTextEl.textContent = val;
            } else {
                plateEl.classList.add('placeholder');
                plateTextEl.textContent = 'Plat Nomor';
            }
            updateStepIndicator();
        }

        /* ═══════════════════════════════════════
           COLOR PICKER
        ═══════════════════════════════════════ */
        function buildColorPicker() {
            const picker = document.getElementById('colorPicker');
            const oldWarna = document.getElementById('inputWarna').value;
            picker.innerHTML = '';
            colors.forEach((c, i) => {
                const dot = document.createElement('div');
                dot.className = 'color-dot';
                dot.style.background = c.hex;
                if (c.name === 'Putih') dot.style.border = '2.5px solid #cbd5e1';
                dot.title = c.name;
                dot.addEventListener('click', () => selectColor(i));
                picker.appendChild(dot);
                // restore old selection
                if (c.name === oldWarna) selectColor(i);
            });
            // default white if nothing matched
            if (!oldWarna || !colors.find(c => c.name === oldWarna)) selectColor(0);
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
            if (body) {
                body.style.fill = c.bodyFill;
                body.style.stroke = c.stroke;
            }
            if (roof) {
                roof.style.fill = c.roofFill;
                roof.style.stroke = c.stroke;
            }
            const motorBody = document.getElementById('motor-body');
            if (motorBody) {
                motorBody.style.fill = c.bodyFill;
                motorBody.style.stroke = c.stroke;
            }
        }

        /* ═══════════════════════════════════════
           CHECKBOX — tulis ke hidden input
        ═══════════════════════════════════════ */
        function toggleCheckbox() {
            isUtama = !isUtama;
            document.getElementById('checkboxCard').classList.toggle('checked', isUtama);
            document.getElementById('inputUtama').value = isUtama ? '1' : '0';
        }

        /* ═══════════════════════════════════════
           STEP INDICATOR
        ═══════════════════════════════════════ */
        function updateStepIndicator() {
            const jenisOk = !!selectedJenis;
            const merekOk = !!document.getElementById('merekKendaraan').value;
            const modelOk = !!document.getElementById('modelKendaraan').value.trim();
            const platOk = !!document.getElementById('platNomor').value.trim();

            setStep(1, jenisOk ? 'done' : 'active');
            setStep(2, !jenisOk ? '' : (merekOk && modelOk && platOk) ? 'done' : (merekOk || modelOk || platOk) ? 'active' :
                '');
            setStep(3, (merekOk && modelOk && platOk) ? 'active' : '');
            setStep(4, '');
        }

        function setStep(n, state) {
            const el = document.getElementById('step' + n);
            el.classList.remove('active', 'done');
            if (state) el.classList.add(state);
            const numEl = el.querySelector('.step-num');
            if (state === 'done') {
                numEl.innerHTML =
                    '<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>';
            } else {
                numEl.textContent = n;
            }
        }

        /* ═══════════════════════════════════════
           SUBMIT — loading state
        ═══════════════════════════════════════ */
        document.getElementById('formKendaraan').addEventListener('submit', function() {
            const btn = document.getElementById('submitBtn');
            btn.disabled = true;
            btn.innerHTML = `
    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
         style="animation:spin 0.8s linear infinite">
      <circle cx="12" cy="12" r="10" stroke-dasharray="30" stroke-dashoffset="10"/>
    </svg>
    Menyimpan...`;
        });

        /* ═══════════════════════════════════════
           TOAST (untuk session flash dari Laravel)
        ═══════════════════════════════════════ */
        let toastTimer;

        function showToast(icon, msg) {
            const t = document.getElementById('toast');
            document.getElementById('toastIcon').textContent = icon;
            document.getElementById('toastMsg').textContent = msg;
            t.classList.add('show');
            clearTimeout(toastTimer);
            toastTimer = setTimeout(() => t.classList.remove('show'), 2800);
        }

        @if (session('success'))
            showToast('✅', '{{ session('success') }}');
        @endif
        @if (session('error'))
            showToast('⚠️', '{{ session('error') }}');
        @endif

        /* ═══════════════════════════════════════
           INIT
        ═══════════════════════════════════════ */
        buildColorPicker();
        selectJenis(selectedJenis);

        // Restore model & plat preview dari old()
        const oldModel = '{{ old('model') }}';
        const oldPlat = '{{ old('plat_nomor') }}';
        if (oldModel) {
            document.getElementById('modelKendaraan').value = oldModel;
            updateHeroName();
        }
        if (oldPlat) {
            const platEl = document.getElementById('platNomor');
            platEl.value = oldPlat.toUpperCase();
            onPlatInput(platEl);
        }
        updateStepIndicator();
    </script>
@endsection
