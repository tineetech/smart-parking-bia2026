@extends('layouts.user')

@section('styles')
    <style>
        /* ══ PAGE TOPBAR ══ */
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

        /* ══ SEGMENTED CONTROL ══ */
        .seg-control {
            flex: 1;
            display: flex;
            background: var(--bg-input);
            border: 1.5px solid var(--border);
            border-radius: 14px;
            padding: 4px;
            gap: 4px;
            position: relative;
        }

        .seg-btn {
            flex: 1;
            padding: 8px 0;
            border: none;
            background: transparent;
            border-radius: 10px;
            font-family: 'Poppins', sans-serif;
            font-size: 13px;
            font-weight: 600;
            color: var(--text-muted);
            cursor: pointer;
            transition: color 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            position: relative;
            z-index: 1;
            white-space: nowrap;
        }

        .seg-btn.active {
            color: #fff;
        }

        .seg-slider {
            position: absolute;
            top: 4px;
            left: 4px;
            height: calc(100% - 8px);
            width: calc(50% - 4px);
            background: var(--blue-main);
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(37, 99, 235, 0.3);
            transition: transform 0.25s cubic-bezier(0.34, 1.2, 0.64, 1);
            z-index: 0;
        }

        .seg-slider.slide-right {
            transform: translateX(calc(100% + 4px));
        }

        /* ══ CONTENT INNER ══ */
        .content-inner {
            max-width: 680px;
        }

        /* ══ PANEL ══ */
        .tab-panel {
            display: none;
        }

        .tab-panel.active {
            display: block;
        }

        /* ══ FILTER TABS ══ */
        .filter-tabs {
            display: flex;
            gap: 8px;
            margin-top: 20px;
            margin-bottom: 16px;
            overflow-x: auto;
            padding-bottom: 2px;
            scrollbar-width: none;
        }

        .filter-tabs::-webkit-scrollbar {
            display: none;
        }

        .filter-tab {
            flex-shrink: 0;
            padding: 7px 16px;
            border-radius: 999px;
            font-size: 12.5px;
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
            border: 1.5px solid var(--border);
            background: var(--bg-card);
            color: var(--text-secondary);
            transition: all 0.18s;
            white-space: nowrap;
        }

        .filter-tab:hover {
            border-color: var(--blue-pale);
            color: var(--blue-main);
        }

        .filter-tab.active {
            background: var(--blue-main);
            color: #fff;
            border-color: var(--blue-main);
            box-shadow: 0 3px 10px rgba(37, 99, 235, 0.25);
        }

        /* ══ SUMMARY ══ */
        .summary-strip {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 14px;
            flex-wrap: wrap;
            gap: 8px;
        }

        .summary-count {
            font-size: 13px;
            color: var(--text-muted);
            font-weight: 500;
        }

        .summary-count span {
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 800;
            color: var(--text-primary);
            font-size: 14px;
        }

        /* ══ MONTH LABEL ══ */
        .month-label {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 11.5px;
            font-weight: 700;
            color: var(--text-muted);
            letter-spacing: 0.06em;
            text-transform: uppercase;
            margin: 18px 0 10px;
        }

        .month-label:first-child {
            margin-top: 0;
        }

        /* ══ BOOKING CARD ══ */
        .booking-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .booking-card {
            background: var(--bg-card);
            border: 1.5px solid var(--border);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: border-color 0.2s, box-shadow 0.2s, transform 0.18s;
            cursor: pointer;
            text-decoration: none;
            color: inherit;
            display: block;
        }

        .booking-card:hover {
            border-color: var(--blue-pale);
            box-shadow: var(--shadow-md);
            transform: translateY(-2px);
        }

        .booking-card:active {
            transform: scale(0.985);
        }

        .booking-card.status-selesai { border-top: 3px solid var(--green); }
        .booking-card.status-aktif   { border-top: 3px solid var(--blue-main); }
        .booking-card.status-batal   { border-top: 3px solid var(--red); }
        .booking-card.status-menunggu{ border-top: 3px solid var(--amber); }

        .card-head {
            padding: 14px 16px 10px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .card-loc-wrap { flex: 1; min-width: 0; }

        .card-loc-name {
            font-size: 11px;
            font-weight: 600;
            color: var(--blue-main);
            margin-bottom: 2px;
            letter-spacing: 0.02em;
        }

        .card-slot {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 28px;
            font-weight: 800;
            color: var(--text-primary);
            letter-spacing: -1px;
            line-height: 1.1;
        }

        .card-map-thumb {
            width: 68px;
            height: 54px;
            border-radius: 12px;
            background: #e8eef8;
            border: 1px solid var(--border);
            overflow: hidden;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .map-bg {
            width: 100%;
            height: 100%;
            background:
                repeating-linear-gradient(0deg, transparent, transparent 9px, rgba(37,99,235,.06) 9px, rgba(37,99,235,.06) 10px),
                repeating-linear-gradient(90deg, transparent, transparent 9px, rgba(37,99,235,.06) 9px, rgba(37,99,235,.06) 10px),
                linear-gradient(135deg, #dce8f8, #eaf1fb);
        }

        .card-divider {
            height: 1px;
            background: var(--border);
            margin: 0 16px;
        }

        .card-vehicle-row {
            padding: 9px 16px;
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .card-vehicle-plate {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-family: 'Space Grotesk', sans-serif;
            font-size: 11.5px;
            font-weight: 700;
            color: var(--text-secondary);
            background: var(--bg-input);
            border: 1px solid var(--border);
            padding: 3px 10px;
            border-radius: 6px;
            letter-spacing: 0.04em;
        }

        .card-vehicle-name {
            font-size: 12px;
            font-weight: 500;
            color: var(--text-muted);
        }

        .card-log-row { padding: 4px 16px 12px; }

        .card-log-title {
            font-size: 11px;
            font-weight: 600;
            color: var(--text-muted);
            margin-bottom: 8px;
            letter-spacing: 0.03em;
        }

        .log-timeline { display: flex; flex-direction: column; gap: 0; position: relative; }

        .log-item { display: flex; align-items: center; gap: 10px; position: relative; }

        .log-dot-wrap {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 14px;
            flex-shrink: 0;
            position: relative;
        }

        .log-dot {
            width: 11px;
            height: 11px;
            border-radius: 50%;
            flex-shrink: 0;
            z-index: 1;
            border: 2px solid currentColor;
        }

        .log-dot.dot-in  { color: var(--green); background: var(--green-soft); }
        .log-dot.dot-out { color: var(--green); background: var(--green); }

        .log-line {
            width: 2px;
            height: 16px;
            background: repeating-linear-gradient(to bottom, var(--green) 0px, var(--green) 4px, transparent 4px, transparent 7px);
            margin: 1px 0;
        }

        .log-time {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 14px;
            font-weight: 700;
            color: var(--text-primary);
            min-width: 44px;
        }

        .log-date { font-size: 11.5px; color: var(--text-muted); font-weight: 400; }

        .card-footer {
            padding: 10px 16px 14px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
            border-top: 1px solid var(--border);
        }

        .footer-total-label { font-size: 11px; color: var(--text-muted); font-weight: 500; margin-bottom: 1px; }

        .footer-total-val {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 17px;
            font-weight: 800;
            color: var(--text-primary);
        }

        .footer-duration { font-size: 11px; color: var(--text-muted); font-weight: 500; }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 5px 12px;
            border-radius: 999px;
            font-size: 11.5px;
            font-weight: 700;
            font-family: 'Poppins', sans-serif;
            white-space: nowrap;
        }

        .badge-selesai { background: var(--green-soft); color: var(--green); }
        .badge-aktif   { background: var(--blue-soft);  color: var(--blue-main); }
        .badge-batal   { background: var(--red-soft);   color: var(--red); }
        .badge-menunggu{ background: var(--amber-soft); color: var(--amber); }

        .check-icon { animation: pop-in 0.35s cubic-bezier(0.34, 1.56, 0.64, 1) both; }

        @keyframes pop-in {
            from { transform: scale(0); opacity: 0; }
            to   { transform: scale(1); opacity: 1; }
        }

        /* ══ PAYMENT LIST ══ */
        .payment-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-top: 20px;
        }

        .payment-card {
            background: var(--bg-card);
            border: 1.5px solid var(--border);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: border-color 0.2s, box-shadow 0.2s, transform 0.18s;
            text-decoration: none;
            color: inherit;
            display: block;
            cursor: pointer;
        }

        .payment-card:hover {
            border-color: var(--blue-pale);
            box-shadow: var(--shadow-md);
            transform: translateY(-2px);
        }

        .payment-card:active { transform: scale(0.985); }

        /* Accent bar kiri berdasarkan status */
        .payment-card.pay-lunas   { border-left: 4px solid var(--green); }
        .payment-card.pay-pending { border-left: 4px solid var(--amber); }
        .payment-card.pay-gagal   { border-left: 4px solid var(--red); }
        .payment-card.pay-refund  { border-left: 4px solid #8b5cf6; }

        .pay-top {
            padding: 14px 16px 10px;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 12px;
        }

        .pay-kode {
            font-size: 10.5px;
            font-weight: 600;
            color: var(--text-muted);
            letter-spacing: 0.05em;
            margin-bottom: 4px;
        }

        .pay-nominal {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 24px;
            font-weight: 800;
            color: var(--text-primary);
            letter-spacing: -0.5px;
            line-height: 1.1;
        }

        .pay-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 5px 12px;
            border-radius: 999px;
            font-size: 11.5px;
            font-weight: 700;
            font-family: 'Poppins', sans-serif;
            white-space: nowrap;
            flex-shrink: 0;
        }

        .pbadge-lunas   { background: var(--green-soft); color: var(--green); }
        .pbadge-pending { background: var(--amber-soft); color: var(--amber); }
        .pbadge-gagal   { background: var(--red-soft);   color: var(--red); }
        .pbadge-refund  { background: #ede9fe; color: #7c3aed; }

        .pay-divider { height: 1px; background: var(--border); margin: 0 16px; }

        .pay-meta {
            padding: 10px 16px 14px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
            flex-wrap: wrap;
        }

        .pay-meta-item {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .pay-meta-label {
            font-size: 10.5px;
            color: var(--text-muted);
            font-weight: 500;
        }

        .pay-meta-val {
            font-size: 12.5px;
            font-weight: 700;
            color: var(--text-secondary);
            font-family: 'Space Grotesk', sans-serif;
        }

        .pay-method-icon {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: var(--bg-input);
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--blue-main);
            flex-shrink: 0;
        }

        .pay-action-btn {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 6px 14px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
            font-family: 'Poppins', sans-serif;
            background: var(--blue-main);
            color: #fff;
            border: none;
            cursor: pointer;
            box-shadow: 0 3px 10px rgba(37,99,235,.25);
            transition: opacity 0.18s;
            white-space: nowrap;
        }

        .pay-action-btn:hover { opacity: 0.88; }

        /* ══ EMPTY STATE ══ */
        .empty-state {
            text-align: center;
            padding: 60px 20px 40px;
        }

        .empty-icon {
            width: 72px;
            height: 72px;
            border-radius: 20px;
            background: var(--blue-soft);
            border: 1px solid var(--blue-pale);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
            color: var(--blue-main);
        }

        .empty-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 16px;
            font-weight: 800;
            color: var(--text-primary);
            margin-bottom: 8px;
        }

        .empty-desc {
            font-size: 13px;
            color: var(--text-muted);
            line-height: 1.6;
        }

        /* ══ RESPONSIVE ══ */
        @media (max-width: 859px) {
            .page-topbar { padding: 20px 16px 0; }
            .card-slot   { font-size: 24px; }
        }

        @media (max-width: 400px) {
            .card-slot       { font-size: 21px; }
            .card-map-thumb  { width: 56px; height: 46px; }
            .seg-btn         { font-size: 12px; }
        }
    </style>
@endsection

@section('content')
    @php
        $statusMap = [
            'selesai'  => 'selesai',
            'aktif'    => 'aktif',
            'batal'    => 'batal',
            'menunggu' => 'menunggu',
        ];

        $jsBookings = $pemesanan
            ->map(function ($p) use ($statusMap) {
                $slot   = $p->slotParkir;
                $lokasi = $slot?->lokasiParkir;
                $kend   = $p->kendaraan;
                $status = $statusMap[$p->status] ?? $p->status;

                return [
                    'id'               => $p->id,
                    'kode'             => $p->kode_pemesanan,
                    'lokasi'           => $lokasi?->nama ?? '-',
                    'slot'             => $slot?->kode_slot ?? '-',
                    'plat'             => $kend?->plat_nomor ?? '-',
                    'pembayaran_status'=> $p->pembayaran?->status ?? null,
                    'pembayaran_url'   => route('user.pembayaran.show', $p->id),
                    'kendaraan'        => trim(($kend?->merek ?? '') . ' ' . ($kend?->model ?? '')),
                    'check_in'         => \Carbon\Carbon::parse($p->waktu_mulai)->format('H:i'),
                    'check_in_d'       => \Carbon\Carbon::parse($p->waktu_mulai)->format('d/m/Y'),
                    'check_out'        => $p->waktu_selesai ? \Carbon\Carbon::parse($p->waktu_selesai)->format('H:i') : null,
                    'check_out_d'      => $p->waktu_selesai ? \Carbon\Carbon::parse($p->waktu_selesai)->format('d/m/Y') : null,
                    'durasi'           => $p->durasi_parkir . ' jam',
                    'total'            => 'Rp ' . number_format($p->total_harga, 0, ',', '.'),
                    'status'           => $status,
                    'month'            => \Carbon\Carbon::parse($p->waktu_mulai)->translatedFormat('F Y'),
                    'qr_url'           => route('user.booking.qr', $p->id),
                ];
            })
            ->values()
            ->toJson();

        /* ── Data Pembayaran ── */
        $jsPembayaran = $pembayaranList
            ->map(function ($pay) {
                $p      = $pay->pemesanan;
                $slot   = $p?->slotParkir;
                $lokasi = $slot?->lokasiParkir;

                // normalise status → key
                $rawStatus = strtolower($pay->status ?? 'pending');
                $statusKey = match(true) {
                    $rawStatus === 'sukses'                       => 'lunas',
                    $rawStatus === 'menunggu'                     => 'pending',
                    str_contains($rawStatus, 'lunas')             => 'lunas',
                    str_contains($rawStatus, 'gagal') || $rawStatus === 'failed' => 'gagal',
                    str_contains($rawStatus, 'refund') || $rawStatus === 'refunded' => 'refund',
                    default                                       => 'pending',
                };

                return [
                    'id'          => $pay->id,
                    'kode'        => $p?->kode_pemesanan ?? '-',
                    'lokasi'      => $lokasi?->nama ?? '-',
                    'slot'        => $slot?->kode_slot ?? '-',
                    'nominal'     => 'Rp ' . number_format($pay->jumlah ?? $p?->total_harga ?? 0, 0, ',', '.'),
                    'metode'      => $pay->metode_pembayaran ?? ($pay->metode ?? '-'),
                    'status'      => $statusKey,
                    'status_raw'  => $pay->status ?? '-',
                    'tanggal'     => \Carbon\Carbon::parse($pay->created_at)->format('d/m/Y'),
                    'jam'         => \Carbon\Carbon::parse($pay->created_at)->format('H:i'),
                    'month'       => \Carbon\Carbon::parse($pay->created_at)->translatedFormat('F Y'),
                    'url'         => route('user.pembayaran.riwayat-detail', $p?->id ?? 0),
                ];
            })
            ->values()
            ->toJson();
    @endphp

    <main class="main-wrap">

        <!-- ══ TOPBAR ══ -->
        <div class="page-topbar">
            <a class="back-btn" href="{{ route('user.dashboard') }}" title="Kembali">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <polyline points="15 18 9 12 15 6"/>
                </svg>
            </a>

            <!-- Segmented Control -->
            <div class="seg-control" id="segControl">
                <div class="seg-slider" id="segSlider"></div>
                <button class="seg-btn active" id="segBooking" data-tab="booking">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                        <rect x="3" y="4" width="18" height="18" rx="3"/>
                        <path d="M16 2v4M8 2v4M3 10h18"/>
                    </svg>
                    Booking
                </button>
                <button class="seg-btn" id="segPembayaran" data-tab="pembayaran">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                        <rect x="2" y="5" width="20" height="14" rx="3"/>
                        <path d="M2 10h20"/>
                    </svg>
                    Pembayaran
                </button>
            </div>
        </div>

        <!-- ══ CONTENT ══ -->
        <div class="content-inner">

            <!-- ── PANEL: BOOKING ── -->
            <div class="tab-panel active" id="panelBooking">
                <!-- Filter Tabs -->
                <div class="filter-tabs" id="filterTabs">
                    <button class="filter-tab active" data-filter="all">Semua</button>
                    <button class="filter-tab" data-filter="selesai">Selesai</button>
                    <button class="filter-tab" data-filter="aktif">Aktif</button>
                    <button class="filter-tab" data-filter="menunggu">Menunggu</button>
                    <button class="filter-tab" data-filter="batal">Dibatalkan</button>
                </div>

                <div class="summary-strip">
                    <div class="summary-count"><span id="bookingCount">0</span> riwayat booking</div>
                </div>

                <div class="booking-list" id="bookingList"></div>
            </div>

            <!-- ── PANEL: PEMBAYARAN ── -->
            <div class="tab-panel" id="panelPembayaran">
                <div class="summary-strip" style="margin-top:20px">
                    <div class="summary-count"><span id="payCount">0</span> riwayat pembayaran</div>
                </div>
                <div class="payment-list" id="paymentList"></div>
            </div>

        </div>
    </main>
@endsection

@section('scripts')
<script>
/* ════════════════════════════════
   DATA
════════════════════════════════ */
const bookings    = {!! $jsBookings !!};
const payments    = {!! $jsPembayaran !!};

/* ════════════════════════════════
   BOOKING RENDER
════════════════════════════════ */
let currentFilter = 'all';

const badgeMap = {
    selesai : { badge:'badge-selesai',  label:'✓ Selesai',     card:'status-selesai'  },
    aktif   : { badge:'badge-aktif',    label:'● Aktif',        card:'status-aktif'    },
    batal   : { badge:'badge-batal',    label:'✕ Dibatalkan',   card:'status-batal'    },
    menunggu: { badge:'badge-menunggu', label:'◷ Menunggu',     card:'status-menunggu' },
};

function renderBookings() {
    const list = currentFilter === 'all'
        ? bookings
        : bookings.filter(b => b.status === currentFilter);

    document.getElementById('bookingCount').textContent = list.length;
    const container = document.getElementById('bookingList');

    if (list.length === 0) {
        container.innerHTML = emptyState('Tidak ada riwayat', 'Belum ada booking dengan status ini.<br>Mulai parkir sekarang!');
        return;
    }

    const groups = {};
    list.forEach(b => { if (!groups[b.month]) groups[b.month] = []; groups[b.month].push(b); });

    let html = '';
    Object.entries(groups).forEach(([month, items]) => {
        html += `<div class="month-label">${month}</div>`;
        items.forEach(b => {
            const sm = badgeMap[b.status] ?? badgeMap['menunggu'];

            const checkOutRow = b.check_out
                ? `<div class="log-item">
                     <div class="log-dot-wrap"><div class="log-dot dot-out"></div></div>
                     <span class="log-time">${b.check_out}</span>
                     <span class="log-date">${b.check_out_d}</span>
                   </div>`
                : `<div class="log-item">
                     <div class="log-dot-wrap"><div class="log-dot dot-in" style="border-style:dashed;opacity:0.45"></div></div>
                     <span class="log-time" style="color:var(--text-muted)">--:--</span>
                     <span class="log-date" style="font-style:italic">Belum checkout</span>
                   </div>`;

            const footerRight = b.status === 'selesai'
                ? `<svg class="check-icon" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="var(--green)" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>`
                : b.status === 'menunggu'
                ? `<span onclick="event.stopPropagation();window.location.href='${b.pembayaran_url}'" class="status-badge ${sm.badge}" style="cursor:pointer">&gt; Bayar Sekarang</span>`
                : `<span class="status-badge ${sm.badge}">${sm.label}</span>`;

            html += `
            <div class="booking-card ${sm.card}">
              <div class="card-head" onclick="window.location.href='${b.qr_url}'">
                <div class="card-loc-wrap">
                  <div class="card-loc-name">${b.lokasi}</div>
                  <div class="card-slot">${b.slot}</div>
                </div>
                <div class="card-map-thumb">
                  <div class="map-bg"></div>
                  <svg class="map-pin" width="22" height="28" viewBox="0 0 22 28" fill="none">
                    <path d="M11 0C6.03 0 2 4.03 2 9c0 6.5 9 19 9 19s9-12.5 9-19c0-4.97-4.03-9-9-9z" fill="#1d4ed8"/>
                    <circle cx="11" cy="9" r="4" fill="white"/>
                  </svg>
                </div>
              </div>
              <div class="card-divider"></div>
              <div class="card-vehicle-row">
                <span class="card-vehicle-plate">
                  <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 3h-8v4h8z"/></svg>
                  ${b.plat}
                </span>
                <span class="card-vehicle-name">${b.kendaraan || b.plat}</span>
              </div>
              <div class="card-divider"></div>
              <div class="card-log-row">
                <div class="card-log-title">Log activities</div>
                <div class="log-timeline">
                  <div class="log-item">
                    <div class="log-dot-wrap">
                      <div class="log-dot dot-in"></div>
                      <div class="log-line"></div>
                    </div>
                    <span class="log-time">${b.check_in}</span>
                    <span class="log-date">${b.check_in_d}</span>
                  </div>
                  ${checkOutRow}
                </div>
              </div>
              <div class="card-footer">
                <div>
                  <div class="footer-total-label">Total</div>
                  <div class="footer-total-val">${b.total}</div>
                </div>
                <div style="display:flex;align-items:center;gap:8px">
                  <span class="footer-duration">${b.durasi}</span>
                  ${footerRight}
                </div>
              </div>
            </div>`;
        });
    });

    container.innerHTML = html;
}

/* ════════════════════════════════
   PAYMENT RENDER
════════════════════════════════ */
const payBadgeMap = {
    lunas  : { cls:'pbadge-lunas',   card:'pay-lunas',   label:'✓ Lunas',   icon:'💳' },
    pending: { cls:'pbadge-pending', card:'pay-pending', label:'◷ Pending', icon:'⏳' },
    gagal  : { cls:'pbadge-gagal',   card:'pay-gagal',   label:'✕ Gagal',   icon:'❌' },
    refund : { cls:'pbadge-refund',  card:'pay-refund',  label:'↩ Refund',  icon:'🔄' },
};

function renderPayments() {
    document.getElementById('payCount').textContent = payments.length;
    const container = document.getElementById('paymentList');

    if (payments.length === 0) {
        container.innerHTML = emptyState('Belum ada pembayaran', 'Riwayat pembayaran kamu akan muncul di sini setelah melakukan transaksi.');
        return;
    }

    const groups = {};
    payments.forEach(p => { if (!groups[p.month]) groups[p.month] = []; groups[p.month].push(p); });

    let html = '';
    Object.entries(groups).forEach(([month, items]) => {
        html += `<div class="month-label">${month}</div>`;
        items.forEach(p => {
            const pm = payBadgeMap[p.status] ?? payBadgeMap['pending'];

            const actionBtn = p.status === 'pending'
                ? `<button class="pay-action-btn" onclick="event.stopPropagation();window.location.href='${p.url}'">
                     › Bayar Sekarang
                   </button>`
                : '';

            html += `
            <div class="payment-card ${pm.card}" onclick="window.location.href='${p.url}'">
              <div class="pay-top">
                <div>
                  <div class="pay-kode">${p.kode} · ${p.lokasi} · Slot ${p.slot}</div>
                  <div class="pay-nominal">${p.nominal}</div>
                </div>
                <span class="pay-badge ${pm.cls}">${pm.label}</span>
              </div>

              <div class="pay-divider"></div>

              <div class="pay-meta">
                <div class="pay-meta-item">
                  <span class="pay-meta-label">Metode</span>
                  <span class="pay-meta-val">${p.metode}</span>
                </div>
                <div class="pay-meta-item">
                  <span class="pay-meta-label">Tanggal</span>
                  <span class="pay-meta-val">${p.tanggal} · ${p.jam}</span>
                </div>
                ${actionBtn
                    ? `<div class="pay-meta-item">${actionBtn}</div>`
                    : `<div class="pay-method-icon">
                         <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                           <rect x="2" y="5" width="20" height="14" rx="3"/>
                           <path d="M2 10h20"/>
                         </svg>
                       </div>`
                }
              </div>
            </div>`;
        });
    });

    container.innerHTML = html;
}

/* ════════════════════════════════
   EMPTY STATE HELPER
════════════════════════════════ */
function emptyState(title, desc) {
    return `
    <div class="empty-state">
      <div class="empty-icon">
        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
          <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
          <polyline points="14 2 14 8 20 8"/>
          <line x1="16" y1="13" x2="8" y2="13"/>
          <line x1="16" y1="17" x2="8" y2="17"/>
        </svg>
      </div>
      <div class="empty-title">${title}</div>
      <div class="empty-desc">${desc}</div>
    </div>`;
}

/* ════════════════════════════════
   SEGMENTED CONTROL
════════════════════════════════ */
const segSlider     = document.getElementById('segSlider');
const panelBooking  = document.getElementById('panelBooking');
const panelPembayaran = document.getElementById('panelPembayaran');

document.getElementById('segControl').addEventListener('click', e => {
    const btn = e.target.closest('.seg-btn');
    if (!btn) return;

    document.querySelectorAll('.seg-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');

    if (btn.dataset.tab === 'pembayaran') {
        segSlider.classList.add('slide-right');
        panelBooking.classList.remove('active');
        panelPembayaran.classList.add('active');
    } else {
        segSlider.classList.remove('slide-right');
        panelPembayaran.classList.remove('active');
        panelBooking.classList.add('active');
    }
});

/* ════════════════════════════════
   BOOKING FILTER TABS
════════════════════════════════ */
document.getElementById('filterTabs').addEventListener('click', e => {
    const tab = e.target.closest('.filter-tab');
    if (!tab) return;
    document.querySelectorAll('.filter-tab').forEach(t => t.classList.remove('active'));
    tab.classList.add('active');
    currentFilter = tab.dataset.filter;
    renderBookings();
});

/* ════════════════════════════════
   INIT
════════════════════════════════ */
renderBookings();
renderPayments();
</script>
@endsection