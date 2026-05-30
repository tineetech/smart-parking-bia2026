@extends('layouts.user')

@section('styles')
{{-- Midtrans Snap.js --}}
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
    <style>
        /* ══ PAGE LAYOUT ══ */
        .page-wrap {
            max-width: var(--max-w);
            margin: 0 auto;
            padding-bottom: calc(var(--bottom-nav-h) + 100px + env(safe-area-inset-bottom));
        }

        /* ══ PAGE TITLE ══ */
        .page-title-bar {
            padding: 22px 20px 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .page-title-bar h1 {
            font-size: 20px;
            font-weight: 800;
            color: var(--text-primary);
            letter-spacing: -.4px;
        }

        /* ══ STATUS BADGE ══ */
        .status-section {
            margin: 12px 20px 0;
        }

        .status-badge {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            border-radius: var(--r-md);
            font-size: 12.5px;
            font-weight: 700;
        }

        .status-badge.menunggu {
            background: #fffbeb;
            border: 1px solid #fde68a;
            color: #92400e;
        }

        .status-badge.sukses {
            background: var(--green-soft);
            border: 1px solid #a7f3d0;
            color: #065f46;
        }

        .status-badge.gagal {
            background: #fef2f2;
            border: 1px solid #fca5a5;
            color: #991b1b;
        }

        .status-badge .sdot {
            width: 8px;
            height: 8px;
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
                opacity: .4
            }
        }

        /* ══ MAIN CARD ══ */
        .main-card {
            margin: 16px 20px 0;
            background: var(--bg-surface);
            border-radius: var(--r-xl);
            border: 1px solid var(--border);
            box-shadow: var(--shadow-md);
            overflow: hidden;
        }

        /* ── Location Strip ── */
        .loc-strip {
            padding: 16px 20px 14px;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 12px;
            border-bottom: 1px solid var(--border);
        }

        .loc-info {
            flex: 1;
            min-width: 0;
        }

        .loc-name {
            font-size: 11.5px;
            font-weight: 700;
            color: var(--blue-main);
            margin-bottom: 4px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .loc-name svg {
            width: 11px;
            height: 11px;
            flex-shrink: 0;
        }

        .slot-code {
            font-size: 36px;
            font-weight: 800;
            color: var(--text-primary);
            letter-spacing: -1.5px;
            line-height: 1;
            font-variant-numeric: tabular-nums;
        }

        .map-thumb {
            width: 72px;
            height: 72px;
            border-radius: var(--r-md);
            background: var(--bg-input);
            border: 1px solid var(--border);
            overflow: hidden;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .map-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .map-thumb-placeholder {
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #dbeafe, #bfdbfe);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .map-pin {
            width: 22px;
            height: 22px;
            background: var(--blue-main);
            border-radius: 50% 50% 50% 0;
            transform: rotate(-45deg);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 8px rgba(37, 99, 235, .4);
        }

        .map-pin::after {
            content: '';
            width: 8px;
            height: 8px;
            background: #fff;
            border-radius: 50%;
        }

        /* ── Vehicle Strip ── */
        .vehicle-strip {
            padding: 14px 20px;
            border-bottom: 1px solid var(--border);
        }

        .vehicle-name {
            font-size: 18px;
            font-weight: 800;
            color: var(--blue-main);
            line-height: 1.2;
            letter-spacing: -.3px;
        }

        .vehicle-plate {
            font-size: 16px;
            font-weight: 700;
            color: var(--blue-bright);
            margin-top: 2px;
        }

        /* ── Activity / Timeline ── */
        .activity-strip {
            padding: 14px 20px;
            border-bottom: 1px solid var(--border);
        }

        .activity-label {
            font-size: 11px;
            font-weight: 700;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: .5px;
            margin-bottom: 12px;
        }

        .timeline {
            display: flex;
            flex-direction: column;
            gap: 0;
        }

        .timeline-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            position: relative;
        }

        .timeline-item:not(:last-child)::after {
            content: '';
            position: absolute;
            left: 7px;
            top: 18px;
            bottom: -18px;
            width: 1.5px;
            background: repeating-linear-gradient(180deg, var(--green) 0, var(--green) 4px, transparent 4px, transparent 8px);
        }

        .tl-dot {
            width: 15px;
            height: 15px;
            border-radius: 50%;
            background: var(--green);
            flex-shrink: 0;
            margin-top: 2px;
            border: 2px solid #fff;
            box-shadow: 0 0 0 2px var(--green);
        }

        .tl-content {
            flex: 1;
            padding-bottom: 18px;
        }

        .tl-time {
            font-size: 15px;
            font-weight: 800;
            color: var(--text-primary);
        }

        .tl-date {
            font-size: 12px;
            color: var(--text-muted);
            font-weight: 500;
            margin-left: 4px;
        }

        .tl-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            font-size: 10px;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 99px;
            margin-top: 3px;
        }

        .tl-badge.start {
            background: var(--green-soft);
            color: var(--green);
        }

        .tl-badge.end {
            background: #fff7ed;
            color: #f59e0b;
        }

        /* ── Payment Method Strip ── */
        .pay-strip {
            padding: 14px 20px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .bca-logo {
            width: 52px;
            height: 52px;
            border-radius: 50%;
            border: 1.5px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
            flex-shrink: 0;
            overflow: hidden;
        }

        .bca-logo img {
            width: 36px;
            height: auto;
            object-fit: contain;
        }

        .bca-logo-placeholder {
            font-size: 11px;
            font-weight: 800;
            color: #004A9F;
            letter-spacing: .5px;
        }

        .pay-info {
            flex: 1;
            min-width: 0;
        }

        .pay-account {
            font-size: 15px;
            font-weight: 800;
            color: var(--text-primary);
            letter-spacing: .5px;
        }

        .pay-holder {
            font-size: 11.5px;
            color: var(--text-muted);
            font-weight: 500;
            margin-top: 2px;
        }

        .pay-method-badge {
            font-size: 10.5px;
            font-weight: 700;
            padding: 3px 9px;
            border-radius: 99px;
            background: var(--blue-soft);
            color: var(--blue-main);
            border: 1px solid var(--blue-pale);
            white-space: nowrap;
        }

        /* ── Total Strip ── */
        .total-strip {
            padding: 16px 20px 18px;
        }

        .total-label {
            font-size: 12px;
            font-weight: 600;
            color: var(--text-muted);
            margin-bottom: 4px;
        }

        .total-amount {
            font-size: 26px;
            font-weight: 800;
            color: var(--text-primary);
            letter-spacing: -.8px;
        }

        .total-note {
            font-size: 11px;
            color: var(--text-muted);
            font-weight: 500;
            margin-top: 3px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        /* ══ BREAKDOWN CARD ══ */
        .breakdown-card {
            margin: 12px 20px 0;
            background: var(--bg-surface);
            border-radius: var(--r-lg);
            border: 1px solid var(--border);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
        }

        .breakdown-header {
            padding: 12px 16px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .breakdown-header svg {
            width: 13px;
            height: 13px;
            color: var(--text-muted);
        }

        .breakdown-header span {
            font-size: 11px;
            font-weight: 700;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: .4px;
        }

        .breakdown-rows {
            padding: 10px 16px 4px;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .brow {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .brow-label {
            font-size: 12px;
            color: var(--text-secondary);
            font-weight: 600;
        }

        .brow-val {
            font-size: 12px;
            color: var(--text-primary);
            font-weight: 700;
        }

        .bdivider {
            height: 1px;
            background: var(--border);
            margin: 6px 16px;
        }

        .btotal {
            padding: 10px 16px 14px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .btotal-label {
            font-size: 13px;
            font-weight: 800;
            color: var(--text-primary);
        }

        .btotal-val {
            font-size: 16px;
            font-weight: 800;
            color: var(--blue-main);
        }

        /* ══ CTA BUTTON ══ */
        .cta-wrap {
            margin: 16px 20px 0;
        }

        .btn-primary {
            width: 100%;
            padding: 16px;
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

        .btn-primary.success {
            background: var(--green);
        }

        .btn-primary svg {
            width: 17px;
            height: 17px;
            opacity: .85;
        }

        /* ══ BCA OVERLAY ══ */
        .overlay {
            position: fixed;
            inset: 0;
            z-index: 9000;
            background: rgba(15, 30, 54, .55);
            backdrop-filter: blur(6px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            opacity: 0;
            visibility: hidden;
            transition: opacity .28s, visibility 0s linear .28s;
        }

        .overlay.show {
            opacity: 1;
            visibility: visible;
            transition: opacity .22s, visibility 0s;
        }

        .overlay-box {
            background: var(--bg-surface);
            border-radius: var(--r-xl);
            padding: 28px 24px;
            max-width: 340px;
            width: 100%;
            box-shadow: var(--shadow-lg);
            text-align: center;
        }

        .overlay-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            margin: 0 auto 16px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .overlay-icon.loading {
            background: var(--blue-soft);
            border: 2px solid var(--blue-pale);
            animation: spin-pulse 1.6s ease-in-out infinite;
        }

        @keyframes spin-pulse {

            0%,
            100% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(37, 99, 235, .3)
            }

            50% {
                transform: scale(1.06);
                box-shadow: 0 0 0 10px rgba(37, 99, 235, 0)
            }
        }

        .overlay-icon.success {
            background: var(--green-soft);
            border: 2px solid #a7f3d0;
        }

        .overlay-icon.error {
            background: #fef2f2;
            border: 2px solid #fca5a5;
        }

        .overlay-title {
            font-size: 17px;
            font-weight: 800;
            color: var(--text-primary);
            margin-bottom: 6px;
        }

        .overlay-desc {
            font-size: 13px;
            color: var(--text-secondary);
            font-weight: 500;
            line-height: 1.6;
            margin-bottom: 8px;
        }

        .bca-va-box {
            background: var(--bg-input);
            border: 1.5px solid var(--border);
            border-radius: var(--r-md);
            padding: 12px 16px;
            margin: 14px 0;
        }

        .bca-va-label {
            font-size: 10.5px;
            font-weight: 700;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: .4px;
            margin-bottom: 4px;
        }

        .bca-va-num {
            font-size: 22px;
            font-weight: 800;
            color: var(--blue-main);
            letter-spacing: 2px;
            font-variant-numeric: tabular-nums;
        }

        .bca-va-exp {
            font-size: 11px;
            color: var(--text-muted);
            font-weight: 500;
            margin-top: 4px;
        }

        .copy-btn {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 7px 14px;
            border: 1.5px solid var(--border);
            border-radius: var(--r-md);
            background: var(--bg-surface);
            color: var(--text-secondary);
            font-family: inherit;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            transition: all .15s;
            margin-top: 4px;
        }

        .copy-btn:hover {
            border-color: var(--blue-main);
            color: var(--blue-main);
        }

        .copy-btn.copied {
            border-color: var(--green);
            color: var(--green);
            background: var(--green-soft);
        }

        .status-check-row {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 12px;
            font-size: 12px;
            color: var(--text-muted);
            font-weight: 600;
        }

        .spin {
            width: 14px;
            height: 14px;
            border: 2px solid var(--border);
            border-top-color: var(--blue-main);
            border-radius: 50%;
            animation: spin 1s linear infinite;
            flex-shrink: 0;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg)
            }
        }

        .overlay-actions {
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-top: 16px;
        }

        .ob-btn {
            width: 100%;
            padding: 13px;
            border-radius: var(--r-md);
            font-family: inherit;
            font-size: 13px;
            font-weight: 800;
            cursor: pointer;
            transition: all .18s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        .ob-btn.primary {
            background: var(--blue-main);
            color: #fff;
            border: none;
            box-shadow: 0 3px 14px rgba(37, 99, 235, .28);
        }

        .ob-btn.primary:hover {
            background: var(--blue-bright);
        }

        .ob-btn.ghost {
            background: var(--bg-input);
            color: var(--text-secondary);
            border: 1.5px solid var(--border);
        }

        .ob-btn.ghost:hover {
            background: var(--bg-surface);
            color: var(--text-primary);
        }

        /* ══ RESPONSIVE ══ */
        @media (max-width: 479px) {
            .slot-code {
                font-size: 28px;
            }
        }
    </style>
@endsection

@section('content')
    {{-- ══ PAGE CONTENT ══ --}}
    @php
        $pemesanan = $pemesanan ?? null;
        $pembayaran = $pemesanan?->pembayaran ?? null;
        $slot = $pemesanan?->slotParkir ?? null;
        $lokasi = $slot?->lokasiParkir ?? null;
        $kendaraan = $pemesanan?->kendaraan ?? null;

        // Demo fallback data
        $lokasiNama = $lokasi?->nama ?? 'Botani Square Mall';
        $slotKode = $slot?->kode_slot ?? 'A-013';
        $zonaNama = $slot?->zona ?? 'A';
        $kendaraanNama = $kendaraan?->nama ?? 'BMW M4 CS/CSL';
        $kendaraanPlat = $kendaraan?->plat ?? 'F 922 XX';
        $waktuMulai = $pemesanan?->waktu_mulai ? \Carbon\Carbon::parse($pemesanan->waktu_mulai) : \Carbon\Carbon::now();
        $waktuSelesai = $pemesanan?->waktu_selesai
            ? \Carbon\Carbon::parse($pemesanan->waktu_selesai)
            : \Carbon\Carbon::now()->addHours(2);
        $durasi = $pemesanan?->durasi_parkir ?? 2;
        $totalHarga = $pemesanan?->total_harga ?? 6600;
        $metodeBayar = $pembayaran?->metode ?? 'bca';
        $statusBayar = $pembayaran?->status ?? 'menunggu';
        $kodePemesanan = $pemesanan?->kode_pemesanan ?? 'PRK-' . strtoupper(substr(md5(time()), 0, 8));

        $hargaPerJam = $lokasi?->harga_per_jam ?? 3000;
        $subtotal = $hargaPerJam * $durasi;
        $ppn = round($subtotal * 0.1);

        $metodeLabel = [
            'bca' => 'Transfer BCA',
            'qris' => 'QRIS',
            'gopay' => 'GoPay',
            'ovo' => 'OVO',
            'dana' => 'DANA',
        ];
        $isTransferBca = $metodeBayar === 'bca';
        $isQris = $metodeBayar === 'qris';
        $isEwallet = in_array($metodeBayar, ['gopay', 'ovo', 'dana']);
        $sudahBayar = $statusBayar === 'sukses';

        // Midtrans snap token dari controller
        $snapToken = $snapToken ?? null;
    @endphp

    <div class="page-wrap">

        <div class="page-title-bar">
            <h1>Detail Pembayaran</h1>
        </div>

        {{-- Status Badge --}}
        <div class="status-section">
            @if ($statusBayar === 'sukses')
                <div class="status-badge sukses">
                    <span class="sdot" style="animation:none;opacity:1"></span>
                    Pembayaran Berhasil
                </div>
            @elseif($statusBayar === 'menunggu')
                <div class="status-badge menunggu">
                    <span class="sdot"></span>
                    Menunggu Pembayaran
                </div>
            @else
                <div class="status-badge gagal">
                    <span class="sdot" style="animation:none"></span>
                    Pembayaran Gagal
                </div>
            @endif
        </div>

        {{-- ── MAIN CARD ── --}}
        <div class="main-card">

            {{-- Location + Slot --}}
            <div class="loc-strip">
                <div class="loc-info">
                    <div class="loc-name">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                            <circle cx="12" cy="10" r="3" />
                        </svg>
                        {{ $lokasiNama }}
                    </div>
                    <div class="slot-code">{{ $slotKode }}</div>
                </div>
                <div class="map-thumb">
                    @if ($lokasi?->foto)
                        <img src="{{ asset('storage/' . $lokasi->foto) }}" alt="{{ $lokasiNama }}">
                    @else
                        <div class="map-thumb-placeholder">
                            <div class="map-pin"></div>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Vehicle --}}
            <div class="vehicle-strip">
                <div class="vehicle-name">{{ $kendaraanNama }}</div>
                <div class="vehicle-plate">{{ $kendaraanPlat }}</div>
            </div>

            {{-- Activity Log --}}
            <div class="activity-strip">
                <div class="activity-label">Log Activities</div>
                <div class="timeline">
                    <div class="timeline-item">
                        <div class="tl-dot"></div>
                        <div class="tl-content">
                            <div>
                                <span class="tl-time">{{ $waktuMulai->format('H:i') }}</span>
                                <span class="tl-date">{{ $waktuMulai->format('d/m/Y') }}</span>
                            </div>
                            <div class="tl-badge start">Mulai Parkir</div>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="tl-dot"></div>
                        <div class="tl-content">
                            <div>
                                <span class="tl-time">{{ $waktuSelesai->format('H:i') }}</span>
                                <span class="tl-date">{{ $waktuSelesai->format('d/m/Y') }}</span>
                            </div>
                            <div class="tl-badge end">Selesai Parkir</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Payment Method --}}
            <div class="pay-strip">
                <div class="bca-logo">
                    @if ($isTransferBca)
                        {{-- BCA logo SVG approximation --}}
                        <span class="bca-logo-placeholder">BCA</span>
                    @elseif($isQris)
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#1a1a1a"
                            stroke-width="2">
                            <rect x="3" y="3" width="7" height="7" />
                            <rect x="14" y="3" width="7" height="7" />
                            <rect x="3" y="14" width="7" height="7" />
                            <rect x="14" y="14" width="3" height="3" />
                            <rect x="19" y="14" width="2" height="2" />
                            <rect x="14" y="19" width="2" height="2" />
                            <rect x="18" y="19" width="3" height="2" />
                        </svg>
                    @elseif($metodeBayar === 'gopay')
                        <span style="font-size:22px">💚</span>
                    @elseif($metodeBayar === 'ovo')
                        <span style="font-size:22px">💜</span>
                    @elseif($metodeBayar === 'dana')
                        <span style="font-size:22px">🔵</span>
                    @endif
                </div>
                <div class="pay-info">
                    @if ($isTransferBca)
                        <div class="pay-account">{{ $pembayaran?->referensi_pembayaran ?? '3056****5904' }}</div>
                        <div class="pay-holder">{{ auth()->user()->name }} · {{ $waktuSelesai->format('m/y') }}</div>
                    @else
                        <div class="pay-account">{{ $metodeLabel[$metodeBayar] ?? $metodeBayar }}</div>
                        <div class="pay-holder">Kode: {{ $kodePemesanan }}</div>
                    @endif
                </div>
                <span class="pay-method-badge">{{ $metodeLabel[$metodeBayar] ?? $metodeBayar }}</span>
            </div>

            {{-- Total --}}
            <div class="total-strip">
                <div class="total-label">Total Pembayaran</div>
                <div class="total-amount">IDR {{ number_format($totalHarga, 0, ',', '.') }}</div>
                <div class="total-note">
                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.5">
                        <circle cx="12" cy="12" r="10" />
                        <line x1="12" y1="8" x2="12" y2="12" />
                        <line x1="12" y1="16" x2="12.01" y2="16" />
                    </svg>
                    Sudah termasuk PPN 10%
                </div>
            </div>

        </div>{{-- end main-card --}}

        {{-- ── Breakdown ── --}}
        <div class="breakdown-card">
            <div class="breakdown-header">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <line x1="12" y1="1" x2="12" y2="23" />
                    <path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6" />
                </svg>
                <span>Rincian Biaya</span>
            </div>
            <div class="breakdown-rows">
                <div class="brow">
                    <span class="brow-label">Harga per Jam</span>
                    <span class="brow-val">Rp {{ number_format($hargaPerJam, 0, ',', '.') }}</span>
                </div>
                <div class="brow">
                    <span class="brow-label">Durasi</span>
                    <span class="brow-val">{{ $durasi }} jam</span>
                </div>
                <div class="brow">
                    <span class="brow-label">Subtotal</span>
                    <span class="brow-val">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                </div>
                <div class="brow">
                    <span class="brow-label">PPN (10%)</span>
                    <span class="brow-val">Rp {{ number_format($ppn, 0, ',', '.') }}</span>
                </div>
            </div>
            <div class="bdivider"></div>
            <div class="btotal">
                <span class="btotal-label">Total</span>
                <span class="btotal-val">Rp {{ number_format($totalHarga, 0, ',', '.') }}</span>
            </div>
        </div>

        {{-- ── CTA Button ── --}}
        @if (!$sudahBayar)
            <div class="cta-wrap">
                <button class="btn-primary" id="btn-bayar" onclick="handlePayment()" data-method="{{ $metodeBayar }}"
                    data-snap="{{ $snapToken }}" data-total="{{ $totalHarga }}"
                    data-pemesanan="{{ $pemesanan?->id }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <rect x="2" y="5" width="20" height="14" rx="2" />
                        <line x1="2" y1="10" x2="22" y2="10" />
                    </svg>
                    Konfirmasi & Bayar — Rp {{ number_format($totalHarga, 0, ',', '.') }}
                </button>
            </div>
        @else
            <div class="cta-wrap">
                <button class="btn-primary success" disabled>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                        <polyline points="22 4 12 14.01 9 11.01" />
                    </svg>
                    Pembayaran Lunas
                </button>
            </div>
        @endif

    </div>{{-- end page-wrap --}}

    {{-- ══ BCA OVERLAY ══ --}}
    <div class="overlay" id="bca-overlay">
        <div class="overlay-box" id="bca-box">
            {{-- State: loading --}}
            <div id="bca-loading-state">
                <div class="overlay-icon loading">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#2563eb"
                        stroke-width="2.5">
                        <line x1="12" y1="1" x2="12" y2="23" />
                        <path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6" />
                    </svg>
                </div>
                <div class="overlay-title">Membuat Virtual Account</div>
                <div class="overlay-desc">Sedang menyiapkan nomor rekening virtual BCA kamu…</div>
                <div class="status-check-row">
                    <div class="spin"></div>
                    <span>Menghubungi bank…</span>
                </div>
            </div>

            {{-- State: VA ready --}}
            <div id="bca-va-state" style="display:none">
                <div class="overlay-icon" style="background:var(--blue-soft);border:2px solid var(--blue-pale)">
                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#2563eb"
                        stroke-width="2.5">
                        <rect x="3" y="4" width="18" height="16" rx="2" />
                        <line x1="8" y1="2" x2="8" y2="6" />
                        <line x1="16" y1="2" x2="16" y2="6" />
                        <line x1="3" y1="10" x2="21" y2="10" />
                    </svg>
                </div>
                <div class="overlay-title">Virtual Account BCA</div>
                <div class="overlay-desc">Transfer tepat ke nomor di bawah sebelum batas waktu</div>
                <div class="bca-va-box">
                    <div class="bca-va-label">Nomor Virtual Account</div>
                    <div class="bca-va-num" id="bca-va-num">— — — — — — —</div>
                    <div class="bca-va-exp" id="bca-va-exp">Berlaku hingga: —</div>
                </div>
                <button class="copy-btn" id="copy-va-btn" onclick="copyVA()">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.5">
                        <rect x="9" y="9" width="13" height="13" rx="2" />
                        <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1" />
                    </svg>
                    Salin Nomor VA
                </button>
                <div class="status-check-row" id="bca-poll-row">
                    <div class="spin"></div>
                    <span>Menunggu konfirmasi transfer…</span>
                </div>
                <div class="overlay-actions">
                    <button class="ob-btn ghost" onclick="closeBcaOverlay()">Tutup — Saya akan transfer nanti</button>
                </div>
            </div>

            {{-- State: success --}}
            <div id="bca-success-state" style="display:none">
                <div class="overlay-icon success">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#10b981"
                        stroke-width="2.5">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                        <polyline points="22 4 12 14.01 9 11.01" />
                    </svg>
                </div>
                <div class="overlay-title">Pembayaran Berhasil! 🎉</div>
                <div class="overlay-desc">Transfer kamu sudah dikonfirmasi. Slot parkirmu sudah aktif.</div>
                <div class="overlay-actions">
                    <button class="ob-btn primary" onclick="onPaymentSuccess()">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.5">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                        </svg>
                        Ke Beranda
                    </button>
                </div>
            </div>

            {{-- State: error --}}
            <div id="bca-error-state" style="display:none">
                <div class="overlay-icon error">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#ef4444"
                        stroke-width="2.5">
                        <circle cx="12" cy="12" r="10" />
                        <line x1="15" y1="9" x2="9" y2="15" />
                        <line x1="9" y1="9" x2="15" y2="15" />
                    </svg>
                </div>
                <div class="overlay-title">Gagal Membuat VA</div>
                <div class="overlay-desc">Terjadi kesalahan saat menghubungi bank. Silakan coba lagi.</div>
                <div class="overlay-actions">
                    <button class="ob-btn primary" onclick="retryBca()">Coba Lagi</button>
                    <button class="ob-btn ghost" onclick="closeBcaOverlay()">Batal</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const BTN = document.getElementById('btn-bayar');
        const METHOD = BTN?.dataset.method;
        const SNAP_TOKEN = BTN?.dataset.snap;
        const PEMESANAN_ID = BTN?.dataset.pemesanan;

        // ── ROUTER: decide which flow based on payment method ──
        function handlePayment() {
            if (!METHOD) return;
            if (METHOD === 'bca') {
                startBcaFlow();
            } else if (METHOD === 'qris' || ['gopay', 'ovo', 'dana'].includes(METHOD)) {
                startMidtransFlow();
            }
        }

        // ════════════════════════════════
        // ── MIDTRANS FLOW (QRIS + e-wallet)
        // ════════════════════════════════
        function startMidtransFlow() {
            if (!SNAP_TOKEN) {
                alert('Token pembayaran tidak ditemukan. Silakan muat ulang halaman.');
                return;
            }
            snap.pay(SNAP_TOKEN, {
                onSuccess: function(result) {
                    // POST ke backend untuk update status
                    fetch('{{ route('user.pembayaran.callback') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            pemesanan_id: PEMESANAN_ID,
                            transaction_id: result.transaction_id,
                            payment_type: result.payment_type,
                            status: 'sukses'
                        })
                    }).then(() => {
                        onPaymentSuccess();
                    });
                },
                onPending: function(result) {
                    console.log('Pending', result);
                },
                onError: function(result) {
                    console.error('Error', result);
                },
                onClose: function() {
                    console.log('Midtrans popup ditutup');
                }
            });
        }

        // ════════════════════════════════
        // ── BCA VIRTUAL ACCOUNT FLOW
        // ════════════════════════════════
        let bcaPollInterval = null;

        function startBcaFlow() {
            showOverlay('bca-overlay');
            setState('loading');

            // Hit backend untuk create BCA VA (via Midtrans)
            fetch('{{ route('user.pembayaran.bca-va') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        pemesanan_id: PEMESANAN_ID
                    })
                })
                .then(r => r.json())
                .then(data => {
                    if (data.success && data.va_number) {
                        document.getElementById('bca-va-num').textContent = formatVA(data.va_number);
                        document.getElementById('bca-va-exp').textContent = 'Berlaku hingga: ' + (data.expired_at ??
                            '24 jam');
                        setState('va-ready');
                        startPolling();
                    } else {
                        setState('error');
                    }
                })
                .catch(() => setState('error'));
        }

        function startPolling() {
            let attempts = 0;
            const MAX = 120; // 10 menit (tiap 5 detik)
            bcaPollInterval = setInterval(() => {
                attempts++;
                if (attempts > MAX) {
                    clearInterval(bcaPollInterval);
                    return;
                }

                fetch('{{ route('user.pembayaran.check-status') }}?pemesanan_id=' + PEMESANAN_ID, {
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(r => r.json())
                    .then(data => {
                        if (data.status === 'sukses') {
                            clearInterval(bcaPollInterval);
                            setState('success');
                        }
                    })
                    .catch(() => {
                        /* tetap polling */ });
            }, 5000);
        }

        function retryBca() {
            startBcaFlow();
        }

        function closeBcaOverlay() {
            clearInterval(bcaPollInterval);
            hideOverlay('bca-overlay');
        }

        function copyVA() {
            const num = document.getElementById('bca-va-num').textContent.replace(/\s/g, '');
            navigator.clipboard?.writeText(num).then(() => {
                const btn = document.getElementById('copy-va-btn');
                btn.classList.add('copied');
                btn.innerHTML =
                    '<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg> Tersalin!';
                setTimeout(() => {
                    btn.classList.remove('copied');
                    btn.innerHTML =
                        '<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="9" y="9" width="13" height="13" rx="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg> Salin Nomor VA';
                }, 2500);
            });
        }

        function formatVA(num) {
            return String(num).replace(/(\d{4})(?=\d)/g, '$1 ');
        }

        // ── State machine ──
        function setState(state) {
            document.getElementById('bca-loading-state').style.display = state === 'loading' ? 'block' : 'none';
            document.getElementById('bca-va-state').style.display = state === 'va-ready' ? 'block' : 'none';
            document.getElementById('bca-success-state').style.display = state === 'success' ? 'block' : 'none';
            document.getElementById('bca-error-state').style.display = state === 'error' ? 'block' : 'none';
        }

        // ── Overlay helpers ──
        function showOverlay(id) {
            document.getElementById(id).classList.add('show');
        }

        function hideOverlay(id) {
            document.getElementById(id).classList.remove('show');
        }

        // ── On success (any method) ──
        function onPaymentSuccess() {
            // Redirect ke halaman sukses / beranda
            window.location.href = '{{ route('user.pembayaran.sukses', $pembayaran?->id) }}';
        }
    </script>
@endsection
