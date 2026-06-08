@extends('layouts.user')

@section('styles')
    <style>
        /* ══ HERO ══ */
        .page-wrap {
            max-width: var(--max-w);
            margin: 0 auto;
            position: relative;
        }

        .hero {
            position: relative;
            overflow: hidden;
            height: var(--hero-h);
            background: linear-gradient(135deg, #b8d0f0, #7aaee8);
        }

        .hero-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform .4s ease;
        }

        .hero:hover .hero-img {
            transform: scale(1.02);
        }

        .hero-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(10, 20, 44, .10) 0%, rgba(10, 20, 44, .08) 35%, rgba(10, 20, 44, .55) 70%, rgba(10, 20, 44, .80) 100%);
        }

        .hero-top-badge {
            position: absolute;
            top: 14px;
            right: 14px;
            display: flex;
            align-items: center;
            gap: 5px;
            padding: 5px 11px;
            border-radius: 99px;
            font-size: 11.5px;
            font-weight: 700;
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.25);
        }

        .hero-top-badge.avail {
            background: rgba(16, 185, 129, .18);
            color: #d1fae5;
        }

        .hero-top-badge.busy {
            background: rgba(245, 158, 11, .20);
            color: #fef3c7;
        }

        .hero-top-badge.full {
            background: rgba(239, 68, 68, .20);
            color: #fee2e2;
        }

        .hero-top-badge .dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: currentColor;
            flex-shrink: 0;
            animation: pulse-dot 2s infinite;
        }

        @keyframes pulse-dot {

            0%,
            100% {
                opacity: 1
            }

            50% {
                opacity: .45
            }
        }

        .hero-bottom {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 20px 20px 28px;
        }

        .hero-location-name {
            font-size: 22px;
            font-weight: 800;
            color: #fff;
            line-height: 1.2;
            text-shadow: 0 2px 12px rgba(0, 0, 0, .35);
            letter-spacing: -.4px;
            margin-bottom: 6px;
        }

        .hero-address {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 12px;
            color: rgba(255, 255, 255, .82);
            font-weight: 500;
            min-width: 0;
        }

        .hero-address span {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .hero-pills {
            display: flex;
            gap: 6px;
            margin-top: 10px;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
            padding-bottom: 2px;
        }

        .hero-pills::-webkit-scrollbar {
            display: none;
        }

        .hero-pill {
            display: flex;
            align-items: center;
            gap: 5px;
            padding: 5px 11px;
            border-radius: 99px;
            font-size: 11.5px;
            font-weight: 600;
            white-space: nowrap;
            flex-shrink: 0;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, .22);
            background: rgba(255, 255, 255, .14);
            color: rgba(255, 255, 255, .95);
        }

        .hero-pill.hl {
            background: rgba(37, 99, 235, .55);
            border-color: rgba(99, 157, 255, .45);
            color: #fff;
        }

        .hero-pill svg {
            width: 12px;
            height: 12px;
            flex-shrink: 0;
            opacity: .85;
        }

        /* ══ CONTENT PANEL ══ */
        .content-panel {
            position: relative;
            z-index: 20;
            background: var(--bg-surface);
            border-radius: var(--r-xl) var(--r-xl) 0 0;
            margin-top: -22px;
            box-shadow: 0 -6px 32px rgba(15, 30, 54, .10);
            padding-bottom: calc(var(--bottom-nav-h) + 80px + env(safe-area-inset-bottom));
            min-height: 60vh;
            transition: padding-bottom .38s cubic-bezier(.34, 1.20, .64, 1);
        }

        .content-panel.bar-open {
            padding-bottom: calc(var(--bottom-nav-h) + var(--bar-h, 220px) + 28px + env(safe-area-inset-bottom));
        }

        .drag-handle {
            width: 36px;
            height: 4px;
            border-radius: 99px;
            background: var(--border);
            margin: 12px auto 0;
        }

        /* ══ STEP BAR ══ */
        .step-bar {
            padding: 16px 20px 4px;
            display: flex;
            align-items: center;
        }

        .step-item {
            display: flex;
            align-items: center;
            gap: 7px;
            flex-shrink: 0;
        }

        .step-num {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: 800;
            transition: all .25s;
        }

        .step-num.active {
            background: var(--blue-main);
            color: #fff;
            box-shadow: 0 3px 10px rgba(37, 99, 235, .35);
        }

        .step-num.done {
            background: var(--green);
            color: #fff;
        }

        .step-num.idle {
            background: var(--bg-input);
            color: var(--text-muted);
            border: 1.5px solid var(--border);
        }

        .step-txt {
            font-size: 11.5px;
            font-weight: 700;
            transition: color .25s;
            white-space: nowrap;
        }

        .step-txt.active {
            color: var(--blue-main);
        }

        .step-txt.done {
            color: var(--green);
        }

        .step-txt.idle {
            color: var(--text-muted);
        }

        .step-line {
            flex: 1;
            height: 2px;
            border-radius: 99px;
            background: var(--border);
            margin: 0 8px;
            transition: background .3s;
            min-width: 16px;
            max-width: 36px;
        }

        .step-line.done {
            background: var(--green);
        }

        /* ══ SECTION ══ */
        .sec-title {
            padding: 18px 20px 3px;
            font-size: 15px;
            font-weight: 800;
            color: var(--text-primary);
            letter-spacing: -.3px;
        }

        .sec-sub {
            padding: 0 20px 14px;
            font-size: 11.5px;
            color: var(--text-muted);
            font-weight: 500;
        }

        /* ══ ZONA GRID ══ */
        .zona-grid {
            padding: 0 20px;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            gap: 10px;
        }

        .zona-card {
            border: 2px solid var(--border);
            border-radius: var(--r-lg);
            padding: 16px 10px 14px;
            background: var(--bg-surface);
            cursor: pointer;
            transition: all .2s cubic-bezier(.34, 1.26, .64, 1);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            position: relative;
            overflow: hidden;
            text-align: center;
        }

        .zona-card:hover {
            border-color: var(--blue-pale);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .zona-card.selected {
            border-color: var(--blue-main);
            background: var(--blue-soft);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, .12), var(--shadow-md);
            transform: translateY(-2px);
        }

        .zona-card.selected::after {
            content: '';
            position: absolute;
            top: 8px;
            right: 8px;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: var(--blue-main) url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='10' viewBox='0 0 24 24' fill='none' stroke='white' stroke-width='3'%3E%3Cpolyline points='20 6 9 17 4 12'/%3E%3C/svg%3E") no-repeat center/10px;
        }

        .zona-icon {
            width: 46px;
            height: 46px;
            border-radius: var(--r-md);
            background: var(--bg-input);
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            transition: all .2s;
        }

        .zona-card.selected .zona-icon,
        .zona-card:hover .zona-icon {
            background: var(--blue-pale);
            border-color: var(--blue-pale);
        }

        .zona-name {
            font-size: 13px;
            font-weight: 800;
            color: var(--text-primary);
        }

        .zona-card.selected .zona-name {
            color: var(--blue-main);
        }

        .zona-count {
            font-size: 11px;
            font-weight: 600;
        }

        /* ══ SLOT GRID ══ */
        .slot-legend {
            padding: 0 20px 12px;
            display: flex;
            gap: 14px;
            flex-wrap: wrap;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 11px;
            color: var(--text-muted);
            font-weight: 600;
        }

        .legend-dot {
            width: 10px;
            height: 10px;
            border-radius: 4px;
        }

        .legend-dot.avail {
            background: var(--bg-input);
            border: 1.5px solid var(--border);
        }

        .legend-dot.sel {
            background: var(--blue-main);
        }

        .legend-dot.occ {
            background: #e2e8f2;
        }

        .slot-grid {
            padding: 0 20px;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
        }

        .slot-btn {
            border: 2px solid var(--border);
            border-radius: var(--r-lg);
            padding: 14px 6px;
            background: var(--bg-surface);
            cursor: pointer;
            transition: all .18s cubic-bezier(.34, 1.26, .64, 1);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 5px;
            position: relative;
            min-height: 76px;
            overflow: hidden;
        }

        /* .slot-btn:not(.occupied):hover {
                    border-color: var(--blue-pale);
                    background: var(--blue-soft);
                    transform: translateY(-2px);
                    box-shadow: var(--shadow-sm);
                } */

        .slot-btn.selected {
            border-color: var(--blue-main);
            background: var(--blue-main);
            box-shadow: 0 5px 18px rgba(37, 99, 235, .40);
            transform: translateY(-2px) scale(1.04);
        }

        .slot-btn.occupied {
            background: var(--bg-input);
            border-color: #e8ecf2;
            cursor: not-allowed;
            opacity: .5;
        }

        .slot-kode {
            font-size: 13px;
            font-weight: 800;
            color: var(--text-primary);
            transition: color .15s;
        }

        .slot-btn.selected .slot-kode {
            color: #fff;
        }

        .slot-btn.occupied .slot-kode {
            color: var(--text-muted);
        }

        .slot-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: var(--green);
        }

        .slot-btn.occupied .slot-dot {
            background: var(--text-muted);
        }

        .slot-btn.selected .slot-dot {
            display: none;
        }

        .slot-car {
            display: none;
            position: absolute;
            top: 6px;
            right: 7px;
        }

        .slot-btn.selected .slot-car {
            display: block;
        }

        /* ══ FORM BOOKING ══ */
        .form-section {
            padding: 0 20px;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .slot-summary-card {
            background: var(--blue-soft);
            border: 1.5px solid var(--blue-pale);
            border-radius: var(--r-lg);
            padding: 14px 16px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .slot-summary-icon {
            width: 40px;
            height: 40px;
            border-radius: var(--r-md);
            background: var(--blue-main);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .slot-summary-icon svg {
            width: 20px;
            height: 20px;
            color: #fff;
        }

        .slot-summary-info {
            flex: 1;
        }

        .slot-summary-label {
            font-size: 10.5px;
            font-weight: 700;
            color: var(--blue-bright);
            text-transform: uppercase;
            letter-spacing: .4px;
            margin-bottom: 3px;
        }

        .slot-summary-val {
            font-size: 15px;
            font-weight: 800;
            color: var(--text-primary);
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .slot-badge-sm {
            background: #fff;
            border: 1px solid var(--blue-pale);
            color: var(--blue-main);
            border-radius: 6px;
            padding: 1px 8px;
            font-size: 12px;
            font-weight: 700;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .form-label {
            font-size: 12px;
            font-weight: 700;
            color: var(--text-secondary);
        }

        .form-input {
            width: 100%;
            padding: 13px 14px;
            border: 1.5px solid var(--border);
            border-radius: var(--r-md);
            background: var(--bg-input);
            font-family: inherit;
            font-size: 14px;
            font-weight: 600;
            color: var(--text-primary);
            outline: none;
            transition: border-color .15s, box-shadow .15s;
            appearance: none;
            -webkit-appearance: none;
        }

        .form-input:focus {
            border-color: var(--blue-main);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, .10);
            background: #fff;
        }

        .form-input::placeholder {
            color: var(--text-muted);
            font-weight: 500;
        }

        .durasi-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            background: var(--bg-input);
            border: 1.5px solid var(--border);
            border-radius: var(--r-md);
            padding: 10px 14px;
            transition: border-color .15s;
        }

        .durasi-row:focus-within {
            border-color: var(--blue-main);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, .10);
        }

        .durasi-label-wrap {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .durasi-main-label {
            font-size: 13px;
            font-weight: 700;
            color: var(--text-primary);
        }

        .durasi-hint {
            font-size: 11px;
            color: var(--text-muted);
            font-weight: 500;
        }

        .durasi-counter {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .dur-btn {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            border: 1.5px solid var(--border);
            background: var(--bg-surface);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-secondary);
            transition: all .15s;
            flex-shrink: 0;
        }

        .dur-btn:hover {
            border-color: var(--blue-main);
            color: var(--blue-main);
            background: var(--blue-soft);
        }

        .dur-btn:disabled {
            opacity: .35;
            cursor: not-allowed;
        }

        .dur-btn svg {
            width: 14px;
            height: 14px;
        }

        .dur-val {
            font-size: 18px;
            font-weight: 800;
            color: var(--text-primary);
            min-width: 28px;
            text-align: center;
        }

        .dur-unit {
            font-size: 11px;
            color: var(--text-muted);
            font-weight: 600;
        }

        .price-card {
            background: var(--bg-input);
            border: 1.5px solid var(--border);
            border-radius: var(--r-lg);
            overflow: hidden;
        }

        .price-card-header {
            padding: 12px 16px 8px;
            display: flex;
            align-items: center;
            gap: 6px;
            border-bottom: 1px solid var(--border);
        }

        .price-card-header svg {
            width: 14px;
            height: 14px;
            color: var(--text-muted);
        }

        .price-card-header span {
            font-size: 11.5px;
            font-weight: 700;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: .4px;
        }

        .price-rows {
            padding: 10px 16px 4px;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .price-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .price-row-label {
            font-size: 12.5px;
            color: var(--text-secondary);
            font-weight: 600;
        }

        .price-row-val {
            font-size: 12.5px;
            color: var(--text-primary);
            font-weight: 700;
        }

        .price-divider {
            height: 1px;
            background: var(--border);
            margin: 6px 16px;
        }

        .price-total-row {
            padding: 10px 16px 14px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .price-total-label {
            font-size: 13px;
            font-weight: 800;
            color: var(--text-primary);
        }

        .price-total-val {
            font-size: 16px;
            font-weight: 800;
            color: var(--blue-main);
        }

        /* ══ PAYMENT METHODS ══ */
        .pay-grid {
            padding: 0 20px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .pay-card {
            border: 2px solid var(--border);
            border-radius: var(--r-lg);
            padding: 16px;
            background: var(--bg-surface);
            cursor: pointer;
            transition: all .18s cubic-bezier(.34, 1.26, .64, 1);
            display: flex;
            align-items: center;
            gap: 14px;
            position: relative;
        }

        .pay-card:hover {
            border-color: var(--blue-pale);
            background: var(--blue-soft);
            transform: translateY(-1px);
            box-shadow: var(--shadow-sm);
        }

        .pay-card.selected {
            border-color: var(--blue-main);
            background: var(--blue-soft);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, .10);
        }

        .pay-card-icon {
            width: 48px;
            height: 48px;
            border-radius: var(--r-md);
            background: var(--bg-input);
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 22px;
            transition: all .18s;
        }

        .pay-card.selected .pay-card-icon {
            background: var(--blue-pale);
            border-color: var(--blue-pale);
        }

        .pay-card-info {
            flex: 1;
            min-width: 0;
        }

        .pay-card-name {
            font-size: 14px;
            font-weight: 800;
            color: var(--text-primary);
        }

        .pay-card.selected .pay-card-name {
            color: var(--blue-main);
        }

        .pay-card-desc {
            font-size: 11.5px;
            color: var(--text-muted);
            font-weight: 500;
            margin-top: 2px;
        }

        .pay-card-badge {
            font-size: 10px;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 99px;
            background: var(--green-soft);
            color: var(--green);
            white-space: nowrap;
            flex-shrink: 0;
        }

        .pay-radio {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            border: 2px solid var(--border);
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all .18s;
            margin-left: auto;
        }

        .pay-card.selected .pay-radio {
            border-color: var(--blue-main);
            background: var(--blue-main);
        }

        .pay-radio::after {
            content: '';
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #fff;
            display: none;
        }

        .pay-card.selected .pay-radio::after {
            display: block;
        }

        /* ══ BUTTONS ══ */
        .btn-wrap {
            padding: 20px 20px 0;
        }

        .btn-primary {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: var(--r-lg);
            background: var(--blue-main);
            color: #fff;
            font-family: inherit;
            font-size: 14px;
            font-weight: 800;
            letter-spacing: .1px;
            cursor: pointer;
            transition: all .2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            box-shadow: 0 4px 20px rgba(37, 99, 235, .30);
        }

        .btn-primary:hover:not(:disabled) {
            background: var(--blue-bright);
            box-shadow: 0 6px 28px rgba(37, 99, 235, .42);
            transform: translateY(-1px);
        }

        .btn-primary:disabled {
            background: var(--bg-input);
            color: var(--text-muted);
            box-shadow: none;
            cursor: not-allowed;
            border: 1.5px solid var(--border);
        }

        .btn-ghost {
            width: 100%;
            padding: 14px;
            border: 1.5px solid var(--border);
            border-radius: var(--r-lg);
            background: var(--bg-input);
            color: var(--text-secondary);
            font-family: inherit;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: all .18s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-bottom: 10px;
        }

        .btn-ghost:hover {
            background: var(--bg-surface);
            color: var(--text-primary);
        }

        /* ══ BOOKING BAR ══ */
        .booking-bar {
            position: fixed;
            bottom: calc(var(--bottom-nav-h) + 12px + env(safe-area-inset-bottom));
            left: 50%;
            transform: translateX(-50%) translateY(calc(100% + 120px));
            width: calc(min(var(--max-w), 100vw) - 32px);
            z-index: 500;
            visibility: hidden;
            opacity: 0;
            pointer-events: none;
            background: var(--bg-surface);
            border: 1px solid var(--border);
            border-radius: 20px;
            box-shadow: 0 -2px 0 0 var(--blue-pale), var(--shadow-lg);
            overflow: hidden;
            transition: transform .40s cubic-bezier(.34, 1.20, .64, 1), opacity .28s ease, visibility 0s linear .40s;
        }

        .booking-bar.visible {
            transform: translateX(-50%) translateY(0);
            visibility: visible;
            opacity: 1;
            pointer-events: all;
            transition: transform .40s cubic-bezier(.34, 1.20, .64, 1), opacity .22s ease, visibility 0s linear 0s;
        }

        .booking-bar::before {
            content: '';
            display: block;
            height: 3px;
            background: linear-gradient(90deg, var(--blue-main), var(--blue-bright));
        }

        .bar-inner {
            padding: 14px 16px 16px;
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .bar-info {
            flex: 1;
            min-width: 0;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .bar-header {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .bar-header-icon {
            width: 28px;
            height: 28px;
            border-radius: 8px;
            background: var(--blue-soft);
            border: 1px solid var(--blue-pale);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .bar-header-icon svg {
            width: 14px;
            height: 14px;
            color: var(--blue-main);
        }

        .bar-header-text {
            font-size: 11px;
            font-weight: 700;
            color: var(--text-muted);
            letter-spacing: .4px;
            text-transform: uppercase;
        }

        .bar-details {
            display: flex;
            flex-direction: column;
            gap: 7px;
        }

        .bar-row {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .bar-row-icon {
            width: 14px;
            height: 14px;
            flex-shrink: 0;
            color: var(--text-muted);
        }

        .bar-row-label {
            font-size: 11px;
            color: var(--text-muted);
            font-weight: 600;
            min-width: 52px;
        }

        .bar-row-val {
            font-size: 12.5px;
            font-weight: 800;
            color: var(--text-primary);
        }

        .bar-row-val.blue {
            color: var(--blue-main);
        }

        .bar-slot-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            background: var(--blue-soft);
            border: 1px solid var(--blue-pale);
            color: var(--blue-main);
            border-radius: 7px;
            padding: 2px 9px;
            font-size: 12.5px;
            font-weight: 800;
        }

        .bar-zone-tag {
            background: var(--bg-input);
            border: 1px solid var(--border);
            color: var(--text-secondary);
            border-radius: 6px;
            padding: 1px 7px;
            font-size: 11px;
            font-weight: 700;
        }

        .bar-divider {
            height: 1px;
            background: var(--border);
        }

        .bar-action {
            display: flex;
            align-items: stretch;
        }

        .btn-confirm {
            width: 100%;
            padding: 14px 20px;
            background: var(--blue-main);
            color: #fff;
            border: none;
            border-radius: 13px;
            font-family: inherit;
            font-size: 14px;
            font-weight: 800;
            cursor: pointer;
            white-space: nowrap;
            box-shadow: 0 3px 14px rgba(37, 99, 235, .28);
            transition: all .18s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            letter-spacing: .1px;
        }

        .btn-confirm svg {
            width: 18px;
            height: 18px;
            opacity: .85;
        }

        .btn-confirm:hover {
            background: var(--blue-bright);
            box-shadow: 0 5px 22px rgba(37, 99, 235, .42);
            transform: translateY(-1px);
        }

        /* ══ ANIMATION ══ */
        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(16px)
            }

            to {
                opacity: 1;
                transform: translateY(0)
            }
        }

        .animate-up {
            animation: slideUp .26s ease both;
        }

        /* ══ RESPONSIVE ══ */
        @media (min-width: 520px) {
            .bar-inner {
                flex-direction: row;
                align-items: stretch;
                gap: 12px;
            }

            .bar-action {
                align-items: center;
                flex-shrink: 0;
            }

            .btn-confirm {
                width: auto;
                padding: 0 22px;
                min-height: 80px;
                flex-direction: column;
                gap: 4px;
                font-size: 13px;
            }
        }

        @media (min-width: 860px) {
            .content-panel {
                padding-bottom: 60px;
            }

            .slot-grid {
                grid-template-columns: repeat(4, 1fr);
            }

            .booking-bar {
                bottom: 24px;
            }

            .hero-location-name {
                font-size: 26px;
            }
        }

        @media (max-width: 479px) {
            .hero-location-name {
                font-size: 20px;
            }
        }
    </style>
@endsection

@section('content')
    <div class="page-wrap">
        <div class="hero">
            @if ($lokasi->foto)
                <img class="hero-img" src="{{ asset('storage/' . $lokasi->foto) }}" alt="{{ $lokasi->nama }}">
            @else
                <div
                    style="width:100%;height:100%;background:linear-gradient(135deg,#bbd4f5,#7aaee8);display:flex;align-items:center;justify-content:center;font-size:72px;">
                    🏬</div>
            @endif
            <div class="hero-overlay"></div>
            @php
                $slotTersedia = $lokasi->slotParkir()->where('status', 'tersedia')->count();
                $totalSlot = $lokasi->slotParkir()->count();
                $ratio = $totalSlot > 0 ? $slotTersedia / $totalSlot : 0;
                $hs = $ratio > 0.4 ? 'avail' : ($ratio > 0 ? 'busy' : 'full');
                $hl = ['avail' => 'Tersedia', 'busy' => 'Hampir Penuh', 'full' => 'Penuh'];
            @endphp
            <div class="hero-top-badge {{ $hs }}"><span class="dot"></span>{{ $hl[$hs] }}</div>
            <div class="hero-bottom">
                <div class="hero-location-name">{{ $lokasi->nama }}</div>
                <div class="hero-address">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.5" style="flex-shrink:0;color:rgba(255,255,255,.7)">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                        <circle cx="12" cy="10" r="3" />
                    </svg>
                    <span>{{ $lokasi->alamat }}</span>
                </div>
                <div class="hero-pills">
                    @if ($lokasi->jam_buka && $lokasi->jam_tutup)
                        <div class="hero-pill">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <circle cx="12" cy="12" r="10" />
                                <polyline points="12 6 12 12 16 14" />
                            </svg>
                            {{ \Carbon\Carbon::parse($lokasi->jam_buka)->format('H:i') }} –
                            {{ \Carbon\Carbon::parse($lokasi->jam_tutup)->format('H:i') }} WIB
                        </div>
                    @endif
                    <div class="hero-pill hl">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <line x1="12" y1="1" x2="12" y2="23" />
                            <path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6" />
                        </svg>
                        Rp {{ number_format($lokasi->harga_per_jam, 0, ',', '.') }}/jam
                    </div>
                    <div class="hero-pill">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <rect x="1" y="3" width="15" height="13" rx="2" />
                            <circle cx="5.5" cy="18.5" r="2.5" />
                        </svg>
                        {{ $slotTersedia }}/{{ $totalSlot }} slot
                    </div>
                </div>
            </div>
        </div>

        <div class="content-panel" id="contentPanel">
            <div class="drag-handle"></div>
            @if (session('error'))
                <div
                    style="margin:12px 20px 0;padding:12px 16px;background:#fef2f2;border:1px solid #fca5a5;border-radius:12px;font-size:13px;font-weight:600;color:#991b1b;display:flex;align-items:flex-start;gap:8px;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.5" style="flex-shrink:0;margin-top:1px">
                        <circle cx="12" cy="12" r="10" />
                        <line x1="12" y1="8" x2="12" y2="12" />
                        <line x1="12" y1="16" x2="12.01" y2="16" />
                    </svg>
                    {{ session('error') }}
                </div>
            @endif

            {{-- STEP BAR (3 steps) --}}
            <div class="step-bar">
                <div class="step-item">
                    <div class="step-num active" id="dot1">1</div>
                    <span class="step-txt active" id="lbl1">Pilih Slot</span>
                </div>
                <div class="step-line" id="line1"></div>
                <div class="step-item">
                    <div class="step-num idle" id="dot2">2</div>
                    <span class="step-txt idle" id="lbl2">Formulir</span>
                </div>
                <div class="step-line" id="line2"></div>
                <div class="step-item">
                    <div class="step-num idle" id="dot3">3</div>
                    <span class="step-txt idle" id="lbl3">Pembayaran</span>
                </div>
            </div>

            {{-- ══ STEP 1: ZONA + SLOT ══ --}}
            <div id="step-zona">
                <div class="sec-title">Pilih Zona Parkir</div>
                <div class="sec-sub">Pilih zona yang kamu inginkan terlebih dahulu</div>
                @php
                    $zonaGroups = $lokasi
                        ->slotParkir()
                        ->selectRaw('zona,COUNT(*) as total,SUM(status="tersedia") as tersedia')
                        ->groupBy('zona')
                        ->get();
                    $zonaEmoji = [
                        'A' => '🅰️',
                        'B' => '🅱️',
                        'C' => '🅾️',
                        'D' => '🇩',
                        'E' => '🇪',
                        'F' => '🅵',
                        'G' => '🇬',
                        'H' => '🇭',
                    ];
                @endphp
                <div class="zona-grid">
                    @forelse($zonaGroups as $zona)
                        @php
                            $rZ = $zona->total > 0 ? $zona->tersedia / $zona->total : 0;
                            $cZ = $rZ > 0.4 ? '#10b981' : ($rZ > 0 ? '#f59e0b' : '#ef4444');
                        @endphp
                        <div class="zona-card{{ $zona->tersedia == 0 ? ' occupied' : '' }}"
                            data-zona="{{ $zona->zona }}"
                            onclick="{{ $zona->tersedia > 0 ? 'selectZona(this)' : '' }}"
                            {{ $zona->tersedia == 0 ? 'style=opacity:.45;cursor:not-allowed' : '' }}>
                            <div class="zona-icon">{{ $zonaEmoji[$zona->zona] ?? '🏢' }}</div>
                            <div class="zona-name">Zona {{ $zona->zona }}</div>
                            <div class="zona-count" style="color:{{ $cZ }}">{{ $zona->tersedia }} slot bebas
                            </div>
                        </div>
                    @empty
                        <div
                            style="grid-column:1/-1;text-align:center;padding:32px 0;color:var(--text-muted);font-size:13px;">
                            Tidak ada zona tersedia</div>
                    @endforelse
                </div>
                <div class="btn-wrap">
                    <button class="btn-primary" id="btn-next-zona" disabled onclick="goToSlot()">
                        Pilih Slot
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.5">
                            <line x1="5" y1="12" x2="19" y2="12" />
                            <polyline points="12 5 19 12 12 19" />
                        </svg>
                    </button>
                </div>
            </div>

            <div id="step-slot" style="display:none">
                <div class="sec-title">Pilih Slot — Zona <span id="slot-zona-label">A</span></div>
                <div class="sec-sub">Ketuk slot untuk memilih · Ketuk lagi untuk batal</div>
                <div class="slot-legend">
                    <div class="legend-item">
                        <div class="legend-dot avail"></div> Tersedia
                    </div>
                    <div class="legend-item">
                        <div class="legend-dot sel"></div> Dipilih
                    </div>
                    <div class="legend-item">
                        <div class="legend-dot occ"></div> Terisi
                    </div>
                </div>
                <div class="slot-grid animate-up" id="slot-grid"></div>
                <div class="btn-wrap" style="margin-top:10px">
                    <button class="btn-primary" id="btn-next-slot" disabled onclick="goToForm()">
                        Lanjut Isi Formulir
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.5">
                            <line x1="5" y1="12" x2="19" y2="12" />
                            <polyline points="12 5 19 12 12 19" />
                        </svg>
                    </button>
                    <button class="btn-ghost" onclick="backToZona()">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.5">
                            <polyline points="15 18 9 12 15 6" />
                        </svg>
                        Ganti Zona
                    </button>
                </div>
            </div>

            {{-- ══ STEP 2: FORM BOOKING ══ --}}
            <div id="step-form" style="display:none">
                <div class="sec-title">Formulir Booking</div>
                <div class="sec-sub">Isi detail parkir kamu</div>
                <div class="form-section">

                    {{-- Slot terpilih --}}
                    <div class="slot-summary-card">
                        <div class="slot-summary-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <rect x="1" y="3" width="15" height="13" rx="2" />
                                <circle cx="5.5" cy="18.5" r="2.5" />
                                <circle cx="12.5" cy="18.5" r="2.5" />
                            </svg>
                        </div>
                        <div class="slot-summary-info">
                            <div class="slot-summary-label">Slot Terpilih</div>
                            <div class="slot-summary-val">
                                <span id="form-slot-display">—</span>
                                <span class="slot-badge-sm" id="form-zona-display">—</span>
                            </div>
                        </div>
                    </div>

                    {{-- Kendaraan (read-only from user data) --}}
                    <div class="form-group">
                        <label class="form-label">Kendaraan</label>
                        <select class="form-input" id="field-kendaraan">
                            @foreach (Auth::user()->kendaraan ?? [] as $k)
                                <option value="{{ $k->id }}">{{ trim($k->merek . ' ' . $k->model) }} ·
                                    {{ $k->plat_nomor }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Jam awal --}}
                    <div class="form-group">
                        <label class="form-label">Jam Awal Parkir</label>
                        <input type="time" class="form-input" id="field-jam" placeholder="--:--"
                            oninput="updatePrice()">
                    </div>

                    {{-- Durasi --}}
                    <div class="form-group">
                        <label class="form-label">Durasi Parkir</label>
                        <div class="durasi-row">
                            <div class="durasi-label-wrap">
                                <span class="durasi-main-label" id="dur-label">1 Jam</span>
                                <span class="durasi-hint" id="dur-range">—</span>
                            </div>
                            <div class="durasi-counter">
                                <button class="dur-btn" id="dur-minus" onclick="changeDur(-1)" disabled>
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                        <line x1="5" y1="12" x2="19" y2="12" />
                                    </svg>
                                </button>
                                <span class="dur-val" id="dur-val">1</span>
                                <span class="dur-unit">jam</span>
                                <button class="dur-btn" id="dur-plus" onclick="changeDur(1)">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                        <line x1="12" y1="5" x2="12" y2="19" />
                                        <line x1="5" y1="12" x2="19" y2="12" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- Price breakdown --}}
                    <div class="price-card" id="price-card">
                        <div class="price-card-header">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <line x1="12" y1="1" x2="12" y2="23" />
                                <path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6" />
                            </svg>
                            <span>Rincian Biaya</span>
                        </div>
                        <div class="price-rows">
                            <div class="price-row">
                                <span class="price-row-label">Durasi Parkir</span>
                                <span class="price-row-val" id="pr-durasi">—</span>
                            </div>
                            <div class="price-row">
                                <span class="price-row-label">Total Durasi</span>
                                <span class="price-row-val" id="pr-total-dur">—</span>
                            </div>
                            <div class="price-row">
                                <span class="price-row-label">Harga per Jam</span>
                                <span class="price-row-val">Rp
                                    {{ number_format($lokasi->harga_per_jam, 0, ',', '.') }}</span>
                            </div>
                            <div class="price-row">
                                <span class="price-row-label">PPN / Pajak (10%)</span>
                                <span class="price-row-val" id="pr-ppn">—</span>
                            </div>
                        </div>
                        <div class="price-divider"></div>
                        <div class="price-total-row">
                            <span class="price-total-label">Total</span>
                            <span class="price-total-val" id="pr-total">—</span>
                        </div>
                    </div>

                </div>
                <div class="btn-wrap" style="margin-top:4px">
                    <button class="btn-primary" id="btn-next-form" onclick="goToPayment()">
                        Pilih Metode Pembayaran
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.5">
                            <line x1="5" y1="12" x2="19" y2="12" />
                            <polyline points="12 5 19 12 12 19" />
                        </svg>
                    </button>
                    <button class="btn-ghost" onclick="backToSlot()">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.5">
                            <polyline points="15 18 9 12 15 6" />
                        </svg>
                        Ganti Slot
                    </button>
                </div>
            </div>

            {{-- ══ STEP 3: PAYMENT ══ --}}
            {{-- ══ STEP 3: PAYMENT ══ --}}
            <div id="step-payment" style="display:none">
                <div class="sec-title">Metode Pembayaran</div>
                <div class="sec-sub">Selesaikan pembayaran melalui Midtrans</div>
                <div class="pay-grid">
                    <div class="pay-card selected" data-method="qris" onclick="selectPay(this)">
                        <div class="pay-card-icon">🏦</div>
                        <div class="pay-card-info">
                            <div class="pay-card-name">Midtrans Payment Gateway</div>
                            <div class="pay-card-desc">Transfer BCA · QRIS · GoPay · OVO · DANA · dan lainnya</div>
                        </div>
                        <span class="pay-card-badge">Rekomendasi</span>
                        <div class="pay-radio"></div>
                    </div>
                </div>
                <div class="btn-wrap" style="margin-top:4px">
                    <button class="btn-ghost" onclick="backToForm()">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.5">
                            <polyline points="15 18 9 12 15 6" />
                        </svg>
                        Kembali
                    </button>
                </div>
            </div>

        </div>{{-- end content-panel --}}
    </div>{{-- end page-wrap --}}

    {{-- BOOKING BAR (only shown at step 3 after selecting payment) --}}
    <div class="booking-bar" id="bookingBar" aria-live="polite">
        <div class="bar-inner">
            <div class="bar-info">
                <div class="bar-header">
                    <div class="bar-header-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                            style="color:var(--blue-main)">
                            <path d="M9 11l3 3L22 4" />
                            <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11" />
                        </svg>
                    </div>
                    <span class="bar-header-text">Konfirmasi Pesanan</span>
                </div>
                <div class="bar-details">
                    <div class="bar-row">
                        <svg class="bar-row-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.5">
                            <rect x="1" y="3" width="15" height="13" rx="2" />
                            <circle cx="5.5" cy="18.5" r="2.5" />
                            <circle cx="12.5" cy="18.5" r="2.5" />
                        </svg>
                        <span class="bar-row-label">Slot</span>
                        <span class="bar-slot-badge" id="bar-slot-name">—</span>
                        <span class="bar-zone-tag" id="bar-zona-name">—</span>
                    </div>
                    <div class="bar-row">
                        <svg class="bar-row-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.5">
                            <circle cx="12" cy="12" r="10" />
                            <polyline points="12 6 12 12 16 14" />
                        </svg>
                        <span class="bar-row-label">Waktu</span>
                        <span class="bar-row-val" id="bar-waktu">—</span>
                    </div>
                    <div class="bar-row">
                        <svg class="bar-row-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.5">
                            <rect x="2" y="5" width="20" height="14" rx="2" />
                            <line x1="2" y1="10" x2="22" y2="10" />
                        </svg>
                        <span class="bar-row-label">Bayar via</span>
                        <span class="bar-row-val" id="bar-pay-method">—</span>
                    </div>
                    <div class="bar-divider"></div>
                    <div class="bar-row">
                        <svg class="bar-row-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.5">
                            <line x1="12" y1="1" x2="12" y2="23" />
                            <path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6" />
                        </svg>
                        <span class="bar-row-label">Total</span>
                        <span class="bar-row-val blue" id="bar-total">—</span>
                    </div>
                </div>
            </div>
            <div class="bar-action">
                <form id="bookingForm" style="width:100%" method="POST"
                    action="{{ route('user.lokasi.booking.store') }}">
                    @csrf

                    <input type="hidden" name="kendaraan_id" id="form-kendaraan-id" value="">
                    <input type="hidden" name="lokasi_parkir_id" value="{{ $lokasi->id }}">
                    <input type="hidden" name="slot_id" id="form-slot-id" value="">
                    <input type="hidden" name="jam_mulai" id="form-jam" value="">
                    <input type="hidden" name="durasi" id="form-durasi" value="">
                    <input type="hidden" name="metode_bayar" id="form-metode" value="">
                    <button type="submit" class="btn-confirm">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <path d="M5 12h14" />
                            <path d="M12 5l7 7-7 7" />
                        </svg>
                        Bayar Sekarang
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const HARGA = {{ $lokasi->harga_per_jam }};
        const PPN_RATE = 0.10;
        const PAY_LABELS = {
            qris: 'Midtrans Payment Gateway',
        };

        const allSlots = {!! json_encode(
            $lokasi->slotParkir()->get(['id', 'kode_slot', 'zona', 'status'])->groupBy('zona')->toArray(),
        ) !!};

        let selectedZona = null,
            selectedSlotId = null,
            selectedSlotKode = null,
            durasi = 1,
            selectedPay = null;

        /* ── helpers ── */
        function fmt(n) {
            return 'Rp ' + n.toLocaleString('id-ID');
        }

        function setStep(active) {
            [1, 2, 3].forEach(i => {
                const d = document.getElementById('dot' + i),
                    l = document.getElementById('lbl' + i);
                d.className = 'step-num ' + (i < active ? 'done' : i === active ? 'active' : 'idle');
                d.textContent = i < active ? '✓' : i;
                l.className = 'step-txt ' + (i < active ? 'done' : i === active ? 'active' : 'idle');
                if (i < 3) {
                    const ln = document.getElementById('line' + i);
                    ln.className = 'step-line' + (i < active ? ' done' : '');
                }
            });
        }

        function showOnly(id) {
            ['step-zona', 'step-slot', 'step-form', 'step-payment'].forEach(s => {
                document.getElementById(s).style.display = s === id ? 'block' : 'none';
            });
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        /* ── ZONA ── */
        function selectZona(el) {
            document.querySelectorAll('.zona-card').forEach(c => c.classList.remove('selected'));
            el.classList.add('selected');
            selectedZona = el.dataset.zona;
            document.getElementById('btn-next-zona').disabled = false;
        }

        function goToSlot() {
            if (!selectedZona) return;
            setStep(1);
            document.getElementById('slot-zona-label').textContent = selectedZona;
            renderSlots(selectedZona);
            showOnly('step-slot');
        }

        function backToZona() {
            selectedSlotId = null;
            selectedSlotKode = null;
            document.getElementById('btn-next-slot').disabled = true;
            showOnly('step-zona');
            setStep(1);
        }

        /* ── SLOT ── */
        function renderSlots(zona) {
            const grid = document.getElementById('slot-grid');
            grid.innerHTML = '';
            (allSlots[zona] || []).forEach(slot => {
                const occ = slot.status !== 'tersedia';
                const btn = document.createElement('div');
                btn.className = 'slot-btn' + (occ ? ' occupied' : '');
                btn.dataset.id = slot.id;
                btn.dataset.kode = slot.kode_slot;
                btn.innerHTML =
                    `<svg class="slot-car" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5"><rect x="1" y="3" width="15" height="13" rx="2"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="12.5" cy="18.5" r="2.5"/></svg><div class="slot-dot"></div><div class="slot-kode">${slot.kode_slot}</div>`;
                if (!occ) btn.addEventListener('click', () => selectSlot(btn, slot.id, slot.kode_slot));
                grid.appendChild(btn);
            });
        }

        function selectSlot(el, id, kode) {
            const already = el.classList.contains('selected');
            document.querySelectorAll('.slot-btn').forEach(b => b.classList.remove('selected'));
            if (already) {
                selectedSlotId = null;
                selectedSlotKode = null;
                document.getElementById('btn-next-slot').disabled = true;
            } else {
                el.classList.add('selected');
                selectedSlotId = id;
                selectedSlotKode = kode;
                document.getElementById('btn-next-slot').disabled = false;
            }
        }

        function goToForm() {
            if (!selectedSlotId) return;
            setStep(2);
            document.getElementById('form-slot-display').textContent = selectedSlotKode;
            document.getElementById('form-zona-display').textContent = 'Zona ' + selectedZona;
            updatePrice();
            showOnly('step-form');
        }

        function backToSlot() {
            showOnly('step-slot');
            setStep(1);
        }

        /* ── DURASI ── */
        function changeDur(d) {
            durasi = Math.max(1, Math.min(24, durasi + d));
            document.getElementById('dur-val').textContent = durasi;
            document.getElementById('dur-minus').disabled = durasi <= 1;
            document.getElementById('dur-plus').disabled = durasi >= 24;
            updatePrice();
        }

        function updatePrice() {
            const jam = document.getElementById('field-jam').value;
            const subtotal = HARGA * durasi;
            const ppn = Math.round(subtotal * PPN_RATE);
            const total = subtotal + ppn;
            let endTime = '—';
            if (jam) {
                const [h, m] = jam.split(':').map(Number);
                const end = new Date(0, 0, 0, h + durasi, m);
                endTime = `${String(end.getHours()).padStart(2,'0')}:${String(end.getMinutes()).padStart(2,'0')} WIB`;
            }
            const startLabel = jam ? jam + ' WIB' : '—';
            document.getElementById('dur-label').textContent = durasi + (durasi === 1 ? ' Jam' : ' Jam');
            document.getElementById('dur-range').textContent = jam ? `${jam} WIB → ${endTime}` : 'Pilih jam dahulu';
            document.getElementById('pr-durasi').textContent = jam ? `${startLabel} – ${endTime}` : '—';
            document.getElementById('pr-total-dur').textContent = durasi + ' jam';
            document.getElementById('pr-ppn').textContent = fmt(ppn);
            document.getElementById('pr-total').textContent = fmt(total);
        }

        /* ── PAYMENT ── */
        function goToPayment() {
            const jam = document.getElementById('field-jam').value;
            if (!jam) {
                document.getElementById('field-jam').focus();
                return;
            }
            setStep(3);
            showOnly('step-payment');

            // Auto-select Midtrans (qris) langsung tampilkan bar
            selectedPay = 'qris';
            const payCard = document.querySelector('.pay-card[data-method="qris"]');
            if (payCard) selectPay(payCard);
        }

        function backToForm() {
            showOnly('step-form');
            setStep(2);
            hideBar();
        }

        function selectPay(el) {
            document.querySelectorAll('.pay-card').forEach(c => c.classList.remove('selected'));
            el.classList.add('selected');
            selectedPay = el.dataset.method;
            showBar();
        }

        /* ── BOOKING BAR ── */
        function showBar() {
            const jam = document.getElementById('field-jam').value;
            const subtotal = HARGA * durasi,
                ppn = Math.round(subtotal * PPN_RATE),
                total = subtotal + ppn;
            let endTime = '';
            if (jam) {
                const [h, m] = jam.split(':').map(Number);
                const e = new Date(0, 0, 0, h + durasi, m);
                endTime = ` → ${String(e.getHours()).padStart(2,'0')}:${String(e.getMinutes()).padStart(2,'0')} WIB`;
            }
            document.getElementById('bar-slot-name').textContent = selectedSlotKode;
            document.getElementById('bar-zona-name').textContent = 'Zona ' + selectedZona;
            document.getElementById('bar-waktu').textContent = (jam ? jam + ' WIB' : '') + endTime + ' (' + durasi +
                ' jam)';
            document.getElementById('form-kendaraan-id').value =
                document.getElementById('field-kendaraan').value;
            document.getElementById('bar-pay-method').textContent = PAY_LABELS[selectedPay] || selectedPay;
            document.getElementById('bar-total').textContent = fmt(total);
            document.getElementById('form-slot-id').value = selectedSlotId;
            document.getElementById('form-jam').value = jam;
            document.getElementById('form-durasi').value = durasi;
            document.getElementById('form-metode').value = selectedPay;
            const bar = document.getElementById('bookingBar');
            bar.classList.add('visible');
            requestAnimationFrame(() => {
                const h = bar.offsetHeight;
                const panel = document.getElementById('contentPanel');
                panel.style.setProperty('--bar-h', h + 'px');
                panel.classList.add('bar-open');
            });
        }

        function hideBar() {
            document.getElementById('bookingBar').classList.remove('visible');
            const panel = document.getElementById('contentPanel');
            panel.classList.remove('bar-open');
            selectedPay = null;
            document.querySelectorAll('.pay-card').forEach(c => c.classList.remove('selected'));
        }

        /* init price */
        updatePrice();
        // ══ REALTIME SLOT MONITORING ══
        const LOKASI_ID = {{ $lokasi->id }};
        const REALTIME_URL = '{{ route('user.lokasi.slots.realtime', $lokasi) }}';
        const POLL_INTERVAL = 3000; // 3 detik polling

        let pollingTimer = null;
        let lastUpdated = null;
        let isPolling = false;

        // ── Indikator status realtime ──
        function injectRealtimeIndicator() {
            const indicator = document.createElement('div');
            indicator.id = 'rt-indicator';
            indicator.style.cssText = `
        position: fixed;
        top: calc(env(safe-area-inset-top) + 10px);
        left: 50%;
        transform: translateX(-50%) translateY(-60px);
        z-index: 9999;
        background: var(--bg-surface);
        border: 1px solid var(--border);
        border-radius: 99px;
        padding: 6px 14px 6px 10px;
        display: flex;
        align-items: center;
        gap: 7px;
        font-size: 11.5px;
        font-weight: 700;
        color: var(--text-secondary);
        box-shadow: var(--shadow-md);
        transition: transform .4s cubic-bezier(.34,1.20,.64,1), opacity .3s;
        opacity: 0;
        pointer-events: none;
    `;
            indicator.innerHTML = `
        <span id="rt-dot" style="width:8px;height:8px;border-radius:50%;background:#94a3b8;flex-shrink:0;transition:background .3s"></span>
        <span id="rt-text">Menghubungkan…</span>
    `;
            document.body.appendChild(indicator);
        }

        function showRtIndicator(state, text) {
            const ind = document.getElementById('rt-indicator');
            const dot = document.getElementById('rt-dot');
            const txt = document.getElementById('rt-text');
            if (!ind) return;

            const colors = {
                live: '#10b981',
                syncing: '#f59e0b',
                error: '#ef4444',
                idle: '#94a3b8'
            };
            dot.style.background = colors[state] || colors.idle;
            if (state === 'live') dot.style.animation = 'pulse-dot 2s infinite';
            else dot.style.animation = 'none';
            txt.textContent = text;

            ind.style.transform = 'translateX(-50%) translateY(0)';
            ind.style.opacity = '1';

            clearTimeout(ind._hideTimer);
            if (state !== 'error') {
                ind._hideTimer = setTimeout(() => {
                    ind.style.transform = 'translateX(-50%) translateY(-60px)';
                    ind.style.opacity = '0';
                }, 2500);
            }
        }

        // ── Toast notifikasi slot berubah ──
        function showSlotToast(changes) {
            const existing = document.getElementById('slot-toast');
            if (existing) existing.remove();

            const toast = document.createElement('div');
            toast.id = 'slot-toast';
            const freed = changes.filter(c => c.to === 'tersedia').length;
            const taken = changes.filter(c => c.to !== 'tersedia').length;

            let msg = '';
            if (freed > 0 && taken > 0) msg = `${freed} slot bebas, ${taken} terisi`;
            else if (freed > 0) msg = `${freed} slot baru tersedia 🎉`;
            else msg = `${taken} slot baru terisi`;

            toast.style.cssText = `
        position: fixed;
        bottom: calc(var(--bottom-nav-h) + 80px + env(safe-area-inset-bottom));
        left: 50%;
        transform: translateX(-50%) translateY(20px);
        z-index: 9998;
        background: #1e293b;
        color: #f8fafc;
        border-radius: 13px;
        padding: 11px 18px;
        font-size: 12.5px;
        font-weight: 700;
        box-shadow: 0 8px 30px rgba(0,0,0,.25);
        display: flex;
        align-items: center;
        gap: 8px;
        opacity: 0;
        transition: all .3s cubic-bezier(.34,1.20,.64,1);
        pointer-events: none;
        white-space: nowrap;
    `;
            toast.innerHTML = `
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2.5"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
        ${msg}
    `;
            document.body.appendChild(toast);
            requestAnimationFrame(() => {
                toast.style.opacity = '1';
                toast.style.transform = 'translateX(-50%) translateY(0)';
            });
            setTimeout(() => {
                toast.style.opacity = '0';
                toast.style.transform = 'translateX(-50%) translateY(10px)';
                setTimeout(() => toast.remove(), 400);
            }, 3500);
        }

        // ── Polling engine ──

        async function pollSlots() {
            if (isPolling) return;
            isPolling = true;
            showRtIndicator('syncing', 'Memperbarui…');

            try {
                const url = selectedZona ?
                    `${REALTIME_URL}?zona=${encodeURIComponent(selectedZona)}` :
                    REALTIME_URL;

                const res = await fetch(url, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                });
                if (!res.ok) throw new Error('HTTP ' + res.status);
                const data = await res.json();

                const changes = applySlotUpdates(data); // ← wajib ada
                updateZonaSummary(data.summary); // ← wajib ada

                lastUpdated = data.updated_at;
                showRtIndicator('live', 'Live · ' + lastUpdated);

                if (changes.length > 0) showSlotToast(changes);

            } catch (err) {
                console.warn('[RT] Poll error:', err);
                showRtIndicator('error', 'Koneksi gagal · Mencoba ulang…');
            } finally {
                isPolling = false;
            }
        }
        // ── Terapkan update ke grid slot ──
        function applySlotUpdates(data) {
            const changes = [];
            if (!selectedZona) return changes;

            const freshSlots = (data.slots[selectedZona] || []);
            const grid = document.getElementById('slot-grid');
            if (!grid) return changes;

            freshSlots.forEach(fresh => {
                const btn = grid.querySelector(`[data-id="${fresh.id}"]`);
                if (!btn) return;

                const wasOcc = btn.classList.contains('occupied');
                const nowOcc = fresh.status !== 'tersedia';

                if (wasOcc !== nowOcc) {
                    changes.push({
                        id: fresh.id,
                        kode: fresh.kode_slot,
                        from: wasOcc ? 'terisi' : 'tersedia',
                        to: fresh.status
                    });

                    // Flash animation
                    btn.style.transition = 'transform .3s, box-shadow .3s, background .4s';
                    btn.style.transform = 'scale(1.08)';
                    btn.style.boxShadow = nowOcc ?
                        '0 0 0 3px rgba(239,68,68,.35)' :
                        '0 0 0 3px rgba(16,185,129,.35)';

                    setTimeout(() => {
                        // Jika slot yang berubah menjadi terisi adalah yang dipilih, reset selection
                        if (nowOcc && selectedSlotId == fresh.id) {
                            selectedSlotId = null;
                            selectedSlotKode = null;
                            document.getElementById('btn-next-slot').disabled = true;
                            showForceDeselect();
                        }

                        btn.classList.toggle('occupied', nowOcc);
                        if (nowOcc) {
                            btn.classList.remove('selected');
                            btn.style.cursor = 'not-allowed';
                            btn.onclick = null;
                        } else {
                            btn.style.cursor = 'pointer';
                            btn.onclick = () => selectSlot(btn, fresh.id, fresh.kode_slot);
                        }

                        btn.style.transform = '';
                        btn.style.boxShadow = '';
                    }, 350);
                }
            });

            return changes;
        }

        // ── Update zona summary cards ──
        function updateZonaSummary(summary) {
            if (!summary) return;
            document.querySelectorAll('.zona-card').forEach(card => {
                const zona = card.dataset.zona;
                const s = summary[zona];
                if (!s) return;

                const countEl = card.querySelector('.zona-count');
                if (countEl) {
                    const ratio = s.total > 0 ? s.tersedia / s.total : 0;
                    const color = ratio > 0.4 ? '#10b981' : (ratio > 0 ? '#f59e0b' : '#ef4444');
                    countEl.style.color = color;
                    countEl.textContent = `${s.tersedia} slot bebas`;
                }

                // Jika zona jadi penuh saat ini dipilih
                if (parseInt(s.tersedia) === 0) {
                    card.classList.add('occupied');
                    card.style.opacity = '.45';
                    card.style.cursor = 'not-allowed';
                    card.onclick = null;
                    if (selectedZona === zona) {
                        card.classList.remove('selected');
                    }
                } else {
                    card.classList.remove('occupied');
                    card.style.opacity = '';
                    card.style.cursor = 'pointer';
                    card.onclick = () => selectZona(card);
                }
            });

            // Update hero badge
            const totalTersedia = Object.values(summary).reduce((a, z) => a + parseInt(z.tersedia), 0);
            const totalSlot = Object.values(summary).reduce((a, z) => a + parseInt(z.total), 0);
            const ratioAll = totalSlot > 0 ? totalTersedia / totalSlot : 0;
            const badge = document.querySelector('.hero-top-badge');
            const pill = document.querySelector('.hero-pill:last-child');

            if (badge) {
                badge.className = 'hero-top-badge ' + (ratioAll > 0.4 ? 'avail' : ratioAll > 0 ? 'busy' : 'full');
                badge.innerHTML =
                    `<span class="dot"></span>${ratioAll > 0.4 ? 'Tersedia' : ratioAll > 0 ? 'Hampir Penuh' : 'Penuh'}`;
            }
            if (pill) {
                pill.innerHTML = `
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="width:12px;height:12px">
                <rect x="1" y="3" width="15" height="13" rx="2"/>
                <circle cx="5.5" cy="18.5" r="2.5"/>
            </svg>
            ${totalTersedia}/${totalSlot} slot
        `;
            }
        }

        // ── Force deselect toast ──
        function showForceDeselect() {
            const t = document.createElement('div');
            t.style.cssText = `
        position:fixed;bottom:calc(var(--bottom-nav-h) + 80px + env(safe-area-inset-bottom));
        left:50%;transform:translateX(-50%);z-index:9999;
        background:#fef2f2;border:1.5px solid #fca5a5;color:#991b1b;
        border-radius:13px;padding:11px 16px;font-size:12px;font-weight:700;
        box-shadow:0 8px 30px rgba(0,0,0,.15);display:flex;align-items:center;gap:8px;
        opacity:0;transition:opacity .3s;
    `;
            t.innerHTML =
                `<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>Slot yang kamu pilih baru saja terisi. Pilih slot lain.`;
            document.body.appendChild(t);
            requestAnimationFrame(() => t.style.opacity = '1');
            setTimeout(() => {
                t.style.opacity = '0';
                setTimeout(() => t.remove(), 400);
            }, 4000);
        }

        // ── Start / stop polling ──
        function startPolling() {
            stopPolling();
            pollSlots(); // immediate first call
            pollingTimer = setInterval(pollSlots, POLL_INTERVAL);
        }

        function stopPolling() {
            if (pollingTimer) {
                clearInterval(pollingTimer);
                pollingTimer = null;
            }
        }

        startPolling()


        function goToSlot() {
            if (!selectedZona) return;
            setStep(1);
            document.getElementById('slot-zona-label').textContent = selectedZona;
            renderSlots(selectedZona);
            showOnly('step-slot');
            startPolling(); // ← tambahkan di sini
        }

        function backToZona() {
            selectedSlotId = null;
            selectedSlotKode = null;
            document.getElementById('btn-next-slot').disabled = true;
            showOnly('step-zona');
            setStep(1);
            stopPolling(); // ← tambahkan di sini
        }

        function goToForm() {
            if (!selectedSlotId) return;
            setStep(2);
            document.getElementById('form-slot-display').textContent = selectedSlotKode;
            document.getElementById('form-zona-display').textContent = 'Zona ' + selectedZona;
            updatePrice();
            showOnly('step-form');
            stopPolling(); // ← tambahkan di sini
        }
        // Init
        injectRealtimeIndicator();
    </script>
@endsection
