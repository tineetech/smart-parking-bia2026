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
            max-width: 680px;
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

        .booking-card.status-selesai {
            border-top: 3px solid var(--green);
        }

        .booking-card.status-aktif {
            border-top: 3px solid var(--blue-main);
        }

        .booking-card.status-batal {
            border-top: 3px solid var(--red);
        }

        .booking-card.status-menunggu {
            border-top: 3px solid var(--amber);
        }

        .card-head {
            padding: 14px 16px 10px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .card-loc-wrap {
            flex: 1;
            min-width: 0;
        }

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

        .card-map-thumb svg.map-pin {
            position: absolute;
        }

        .map-bg {
            width: 100%;
            height: 100%;
            background: repeating-linear-gradient(0deg, transparent, transparent 9px, rgba(37, 99, 235, 0.06) 9px, rgba(37, 99, 235, 0.06) 10px), repeating-linear-gradient(90deg, transparent, transparent 9px, rgba(37, 99, 235, 0.06) 9px, rgba(37, 99, 235, 0.06) 10px), linear-gradient(135deg, #dce8f8, #eaf1fb);
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

        .card-log-row {
            padding: 4px 16px 12px;
        }

        .card-log-title {
            font-size: 11px;
            font-weight: 600;
            color: var(--text-muted);
            margin-bottom: 8px;
            letter-spacing: 0.03em;
        }

        .log-timeline {
            display: flex;
            flex-direction: column;
            gap: 0;
            position: relative;
        }

        .log-item {
            display: flex;
            align-items: center;
            gap: 10px;
            position: relative;
        }

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

        .log-dot.dot-in {
            color: var(--green);
            background: var(--green-soft);
        }

        .log-dot.dot-out {
            color: var(--green);
            background: var(--green);
        }

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

        .log-date {
            font-size: 11.5px;
            color: var(--text-muted);
            font-weight: 400;
        }

        .card-footer {
            padding: 10px 16px 14px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
            border-top: 1px solid var(--border);
        }

        .footer-total-label {
            font-size: 11px;
            color: var(--text-muted);
            font-weight: 500;
            margin-bottom: 1px;
        }

        .footer-total-val {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 17px;
            font-weight: 800;
            color: var(--text-primary);
        }

        .footer-duration {
            font-size: 11px;
            color: var(--text-muted);
            font-weight: 500;
        }

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

        .badge-selesai {
            background: var(--green-soft);
            color: var(--green);
        }

        .badge-aktif {
            background: var(--blue-soft);
            color: var(--blue-main);
        }

        .badge-batal {
            background: var(--red-soft);
            color: var(--red);
        }

        .badge-menunggu {
            background: var(--amber-soft);
            color: var(--amber);
        }

        .check-icon {
            animation: pop-in 0.35s cubic-bezier(0.34, 1.56, 0.64, 1) both;
        }

        @keyframes pop-in {
            from {
                transform: scale(0);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }

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
            .page-topbar {
                padding: 20px 16px 0;
            }

            .card-slot {
                font-size: 24px;
            }
        }

        @media (max-width: 400px) {
            .card-slot {
                font-size: 21px;
            }

            .card-map-thumb {
                width: 56px;
                height: 46px;
            }
        }
    </style>
@endsection

@section('content')
    <!-- ════════ PAGE DATA ════════ -->

    @php
        // Map status Pemesanan → key filter
        $statusMap = [
            'selesai' => 'selesai',
            'aktif' => 'aktif',
            'batal' => 'batal',
            'menunggu' => 'menunggu',
        ];

        // Encode semua data ke JS-friendly array
        $jsBookings = $pemesanan
            ->map(function ($p) use ($statusMap) {
                $slot = $p->slotParkir;
                $lokasi = $slot?->lokasiParkir;
                $kend = $p->kendaraan;
                $status = $statusMap[$p->status] ?? $p->status;

                return [
                    'id' => $p->id,
                    'kode' => $p->kode_pemesanan,
                    'lokasi' => $lokasi?->nama ?? '-',
                    'slot' => $slot?->kode_slot ?? '-',
                    'plat' => $kend?->plat_nomor ?? '-',
                    'pembayaran_status' => $p->pembayaran?->status ?? null,
                    'pembayaran_url' => route('user.pembayaran.show', $p->id),
                    'kendaraan' => trim(($kend?->merek ?? '') . ' ' . ($kend?->model ?? '')),
                    'check_in' => \Carbon\Carbon::parse($p->waktu_mulai)->format('H:i'),
                    'check_in_d' => \Carbon\Carbon::parse($p->waktu_mulai)->format('d/m/Y'),
                    'check_out' => $p->waktu_selesai ? \Carbon\Carbon::parse($p->waktu_selesai)->format('H:i') : null,
                    'check_out_d' => $p->waktu_selesai
                        ? \Carbon\Carbon::parse($p->waktu_selesai)->format('d/m/Y')
                        : null,
                    'durasi' => $p->durasi_parkir . ' jam',
                    'total' => 'Rp ' . number_format($p->total_harga, 0, ',', '.'),
                    'status' => $status,
                    'month' => \Carbon\Carbon::parse($p->waktu_mulai)->translatedFormat('F Y'),
                    'qr_url' => route('user.booking.qr', $p->id),
                ];
            })
            ->values()
            ->toJson();
    @endphp

    <!-- ════════ MAIN ════════ -->
    <main class="main-wrap">

        <div class="page-topbar">
            <a class="back-btn" href="{{ route('user.dashboard') }}" title="Kembali">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <polyline points="15 18 9 12 15 6" />
                </svg>
            </a>
            <div class="page-topbar-title">Riwayat Booking</div>
        </div>

        <div class="content-inner">

            <!-- Filter Tabs -->
            <div class="filter-tabs" id="filterTabs">
                <button class="filter-tab active" data-filter="all">Semua</button>
                <button class="filter-tab" data-filter="selesai">Selesai</button>
                <button class="filter-tab" data-filter="aktif">Aktif</button>
                <button class="filter-tab" data-filter="menunggu">Menunggu</button>
                <button class="filter-tab" data-filter="batal">Dibatalkan</button>
            </div>

            <!-- Summary -->
            <div class="summary-strip">
                <div class="summary-count"><span id="bookingCount">0</span> riwayat booking</div>
            </div>

            <!-- List -->
            <div class="booking-list" id="bookingList"></div>

        </div>
    </main>
@endsection


@section('scripts')
    <script>
        const bookings = {!! $jsBookings !!};
        let currentFilter = 'all';

        const badgeMap = {
            selesai: {
                badge: 'badge-selesai',
                label: '✓ Selesai',
                card: 'status-selesai'
            },
            aktif: {
                badge: 'badge-aktif',
                label: '● Aktif',
                card: 'status-aktif'
            },
            batal: {
                badge: 'badge-batal',
                label: '✕ Dibatalkan',
                card: 'status-batal'
            },
            menunggu: {
                badge: 'badge-menunggu',
                label: '◷ Menunggu',
                card: 'status-menunggu'
            },
        };

        function renderBookings() {
            const list = currentFilter === 'all' ?
                bookings :
                bookings.filter(b => b.status === currentFilter);

            document.getElementById('bookingCount').textContent = list.length;
            const container = document.getElementById('bookingList');

            if (list.length === 0) {
                container.innerHTML = `
      <div class="empty-state">
        <div class="empty-icon">
          <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
            <polyline points="14 2 14 8 20 8"/>
            <line x1="16" y1="13" x2="8" y2="13"/>
            <line x1="16" y1="17" x2="8" y2="17"/>
          </svg>
        </div>
        <div class="empty-title">Tidak ada riwayat</div>
        <div class="empty-desc">Belum ada booking dengan status ini.<br>Mulai parkir sekarang!</div>
      </div>`;
                return;
            }

            // Group by month
            const groups = {};
            list.forEach(b => {
                if (!groups[b.month]) groups[b.month] = [];
                groups[b.month].push(b);
            });

            let html = '';
            Object.entries(groups).forEach(([month, items]) => {
                html += `<div class="month-label">${month}</div>`;
                items.forEach(b => {
                    const sm = badgeMap[b.status] ?? badgeMap['menunggu'];

                    const checkOutRow = b.check_out ?
                        `<div class="log-item">
             <div class="log-dot-wrap"><div class="log-dot dot-out"></div></div>
             <span class="log-time">${b.check_out}</span>
             <span class="log-date">${b.check_out_d}</span>
           </div>` :
                        `<div class="log-item">
             <div class="log-dot-wrap"><div class="log-dot dot-in" style="border-style:dashed;opacity:0.45"></div></div>
             <span class="log-time" style="color:var(--text-muted)">--:--</span>
             <span class="log-date" style="font-style:italic">Belum checkout</span>
           </div>`;

                    const footerRight = b.status === 'selesai' ?
                        `<svg class="check-icon" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="var(--green)" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>` :
                        b.status === 'menunggu' ?
                        `<span onclick="window.location.href = '${b.pembayaran_url}'" style="z-index: 999;" class="status-badge ${sm.badge}">> Bayar Sekarang</span>` :
                        `<span class="status-badge ${sm.badge}">${sm.label}</span>`;

                    html += `
        <div class="booking-card ${sm.card}">
          <div class="card-head" onclick="window.location.href = '${b.qr_url}'">
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

        // Filter tabs
        document.getElementById('filterTabs').addEventListener('click', e => {
            const tab = e.target.closest('.filter-tab');
            if (!tab) return;
            document.querySelectorAll('.filter-tab').forEach(t => t.classList.remove('active'));
            tab.classList.add('active');
            currentFilter = tab.dataset.filter;
            renderBookings();
        });

        renderBookings();
    </script>
@endsection
