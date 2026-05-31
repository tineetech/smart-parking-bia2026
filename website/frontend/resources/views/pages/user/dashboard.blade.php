@extends('layouts.user')

@section('styles')
    <style>
        /* ══ HERO / SEARCH ══ */
        .hero-banner {
            background: transparent;
            padding: 32px 0 0;
            position: relative;
            overflow: hidden;
            width: 100%;
        }

        .hero-inner {
            max-width: var(--max-content);
            margin: 0 auto;
            padding: 0 24px 28px;
            position: relative;
            z-index: 1;
        }

        .hero-greeting {
            font-size: 12.5px;
            color: var(--text-muted);
            font-weight: 400;
            margin-bottom: 3px;
        }

        .hero-name {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 24px;
            font-weight: 800;
            color: var(--text-primary);
            margin-bottom: 20px;
            letter-spacing: -0.3px;
        }

        .search-bar {
            display: flex;
            align-items: center;
            gap: 10px;
            background: #fff;
            border-radius: 14px;
            padding: 12px 16px;
            margin-bottom: 16px;
            position: relative;
            transition: box-shadow 0.2s;
            width: 100%;
        }

        .search-bar:focus-within {
            box-shadow: 0 8px 32px rgba(37, 99, 235, 0.22);
        }

        .search-bar input {
            flex: 1;
            border: none;
            outline: none;
            font-family: 'Poppins', sans-serif;
            font-size: 13.5px;
            border: .8px solid rgba(255, 255, 255, 0.9);
            padding-block: 10px;
            color: var(--text-primary);
            background: transparent;
        }

        .search-bar input::placeholder {
            color: var(--text-muted);
        }

        .search-icon {
            color: var(--text-muted);
            flex-shrink: 0;
        }

        .search-loc-btn {
            position: absolute;
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: var(--blue-soft);
            border: none;
            right: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: var(--blue-main);
            flex-shrink: 0;
            transition: background 0.16s;
        }

        .search-loc-btn:hover {
            background: var(--blue-pale);
        }

        .filter-pills {
            display: flex;
            gap: 8px;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
            padding-bottom: 4px;
        }

        .filter-pills::-webkit-scrollbar {
            display: none;
        }

        .pill {
            display: flex;
            align-items: center;
            gap: 5px;
            padding: 7px 14px;
            border-radius: 999px;
            font-size: 12.5px;
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
            white-space: nowrap;
            transition: all 0.16s;
            flex-shrink: 0;
            border: 1.5px solid var(--border);
            color: var(--text-secondary);
            background: var(--bg-surface);
        }

        .pill.active,
        .pill:hover {
            background: var(--blue-main);
            border-color: var(--blue-main);
            color: #fff;
        }

        /* ══ MAP ══ */
        .map-section {
            position: relative;
            display: flex;
            justify-content: center;
            padding: 0 !important;
            align-items: center;
            width: 100%;
        }

        #parkingMap {
            width: 100%;
            height: 340px;
            background: white;
            border-radius: 20px;
        }

        .leaflet-popup-content-wrapper {
            border-radius: 12px !important;
            box-shadow: var(--shadow-lg) !important;
            padding: 0 !important;
            overflow: hidden;
        }

        .leaflet-popup-content {
            margin: 0 !important;
            width: auto !important;
        }

        .custom-popup {
            padding: 12px 14px;
            min-width: 180px;
        }

        .popup-name {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 13px;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 4px;
        }

        .popup-meta {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .popup-badge {
            font-size: 11px;
            font-weight: 600;
            padding: 2px 8px;
            border-radius: 999px;
            font-family: 'Poppins', sans-serif;
        }

        .popup-avail {
            background: var(--green-soft);
            color: var(--green);
        }

        .popup-busy {
            background: var(--amber-soft);
            color: var(--amber);
        }

        .popup-full {
            background: var(--red-soft);
            color: var(--red);
        }

        .popup-price {
            font-size: 11.5px;
            color: var(--blue-main);
            font-weight: 600;
        }

        .popup-btn {
            display: block;
            width: 100%;
            margin-top: 8px;
            background: var(--blue-main);
            color: #fff !important;
            border: none;
            border-radius: 8px;
            padding: 7px;
            font-size: 12px;
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            transition: background 0.15s;
        }

        .popup-btn:hover {
            background: var(--blue-bright);
        }

        .map-controls {
            position: absolute;
            bottom: 16px;
            right: 12px;
            display: flex;
            flex-direction: column;
            gap: 6px;
            z-index: 999;
        }

        .map-ctrl-btn-map {
            width: 36px;
            height: 36px;
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: var(--shadow-md);
            color: var(--text-secondary);
            transition: border-color 0.15s;
        }

        .map-ctrl-btn-map:hover {
            border-color: var(--blue-main);
            color: var(--blue-main);
        }

        /* ══ SECTIONS ══ */
        .section {
            padding: 26px 0 0;
        }

        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
            flex-wrap: wrap;
            gap: 8px;
        }

        .section-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 16px;
            font-weight: 800;
            color: var(--text-primary);
            letter-spacing: -0.2px;
        }

        .section-action {
            font-size: 12.5px;
            font-weight: 600;
            color: var(--blue-main);
            cursor: pointer;
            text-decoration: none;
            transition: opacity 0.15s;
        }

        .section-action:hover {
            opacity: 0.7;
        }

        /* ══ QUICK STATS ══ */
        .quick-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
        }

        .qs-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 16px;
            text-align: center;
            box-shadow: var(--shadow-sm);
            transition: border-color 0.2s, transform 0.2s;
            cursor: default;
        }

        .qs-card:hover {
            border-color: var(--blue-pale);
            transform: translateY(-2px);
        }

        .qs-icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
        }

        .qs-val {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 20px;
            font-weight: 800;
            color: var(--text-primary);
            line-height: 1;
            margin-bottom: 4px;
        }

        .qs-label {
            font-size: 11px;
            color: var(--text-muted);
            font-weight: 500;
        }

        /* ══ LOCATION CARDS (horizontal scroll) ══ */
        .loc-scroll {
            display: flex;
            gap: 14px;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
            padding-bottom: 6px;
        }

        .loc-scroll::-webkit-scrollbar {
            display: none;
        }

        .loc-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: var(--shadow-card);
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s, border-color 0.2s;
            flex-shrink: 0;
            width: 220px;
            text-decoration: none;
            color: inherit;
            display: block;
        }

        .loc-card:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-md);
            border-color: var(--blue-pale);
        }

        .loc-img-placeholder {
            width: 100%;
            height: 120px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            overflow: hidden;
        }

        .loc-img-placeholder img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .loc-body {
            padding: 12px 14px 14px;
        }

        .loc-name {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 13.5px;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 3px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .loc-addr {
            font-size: 11.5px;
            color: var(--text-muted);
            margin-bottom: 10px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .loc-meta {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 6px;
        }

        .loc-price {
            font-size: 12px;
            font-weight: 700;
            color: var(--blue-main);
            display: flex;
            align-items: center;
            gap: 4px;
            font-family: 'Space Grotesk', sans-serif;
        }

        .loc-rating {
            display: flex;
            align-items: center;
            gap: 3px;
            font-size: 11.5px;
            font-weight: 600;
            color: var(--amber);
            font-family: 'Space Grotesk', sans-serif;
        }

        /* ══ ALL LOCATIONS GRID ══ */
        .all-loc-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 14px;
        }

        .all-loc-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 16px;
            display: flex;
            align-items: center;
            gap: 12px;
            box-shadow: var(--shadow-sm);
            cursor: pointer;
            transition: border-color 0.2s, transform 0.2s, box-shadow 0.2s;
            text-decoration: none;
            color: inherit;
        }

        .all-loc-card:hover {
            border-color: var(--blue-pale);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .alc-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
        }

        .alc-name {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 3px;
        }

        .alc-meta {
            font-size: 11.5px;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 6px;
            flex-wrap: wrap;
        }

        .alc-dot {
            width: 4px;
            height: 4px;
            border-radius: 50%;
            background: var(--border);
        }

        .avail-text {
            color: var(--green);
            font-weight: 600;
        }

        .busy-text {
            color: var(--amber);
            font-weight: 600;
        }

        .full-text {
            color: var(--red);
            font-weight: 600;
        }

        /* ══ ACTIVE PARKING CARD ══ */
        .active-parking-card {
            background: linear-gradient(135deg, #1d4ed8 0%, #2563eb 100%);
            border-radius: 18px;
            padding: 20px 22px;
            display: flex;
            align-items: center;
            gap: 16px;
            position: relative;
            overflow: hidden;
            width: 100%;
        }

        .active-parking-card::after {
            content: '';
            position: absolute;
            bottom: -40px;
            right: -40px;
            width: 160px;
            height: 160px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.07);
        }

        .apc-icon {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            background: rgba(255, 255, 255, 0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            color: #fff;
        }

        .apc-body {
            flex: 1;
            min-width: 0;
        }

        .apc-label {
            font-size: 11.5px;
            color: rgba(255, 255, 255, 0.7);
            margin-bottom: 4px;
        }

        .apc-name {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 16px;
            font-weight: 800;
            color: #fff;
            margin-bottom: 5px;
        }

        .apc-meta {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .apc-meta-item {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.8);
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .apc-action {
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.25);
            border-radius: 10px;
            padding: 8px 14px;
            font-size: 12.5px;
            font-weight: 600;
            color: #fff;
            cursor: pointer;
            white-space: nowrap;
            font-family: 'Poppins', sans-serif;
            transition: background 0.15s;
            flex-shrink: 0;
            text-decoration: none;
            display: inline-block;
        }

        .apc-action:hover {
            background: rgba(255, 255, 255, 0.22);
        }

        /* ══ HISTORY ══ */
        .history-list {
            display: flex;
            flex-direction: column;
            gap: 0;
        }

        .hist-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 13px 0;
            border-bottom: 1px solid var(--border);
            cursor: pointer;
            transition: background 0.15s;
        }

        .hist-item:last-child {
            border-bottom: none;
        }

        .hist-item:hover {
            background: var(--bg-hover);
            margin: 0 -16px;
            padding-left: 16px;
            padding-right: 16px;
            border-radius: 10px;
        }

        .hist-icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .hist-body {
            flex: 1;
            min-width: 0;
        }

        .hist-name {
            font-size: 13px;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 2px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .hist-sub {
            font-size: 11.5px;
            color: var(--text-muted);
        }

        .hist-right {
            text-align: right;
            flex-shrink: 0;
        }

        .hist-price {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 13px;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 2px;
        }

        .hist-date {
            font-size: 11px;
            color: var(--text-muted);
        }

        /* ══ PROMO ══ */
        .promo-scroll {
            display: flex;
            gap: 12px;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
            padding-bottom: 4px;
        }

        .promo-scroll::-webkit-scrollbar {
            display: none;
        }

        .promo-card {
            flex-shrink: 0;
            border-radius: 16px;
            padding: 18px 22px;
            min-width: 260px;
            position: relative;
            overflow: hidden;
            cursor: pointer;
        }

        .promo-card::after {
            content: '';
            position: absolute;
            top: -30px;
            right: -30px;
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
        }

        .promo-tag {
            display: inline-block;
            background: rgba(255, 255, 255, 0.22);
            color: #fff;
            font-size: 10.5px;
            font-weight: 700;
            padding: 3px 10px;
            border-radius: 999px;
            margin-bottom: 8px;
            letter-spacing: 0.04em;
        }

        .promo-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 17px;
            font-weight: 800;
            color: #fff;
            margin-bottom: 5px;
            letter-spacing: -0.2px;
        }

        .promo-desc {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.8);
        }

        /* ══ HELPERS (dipakai di konten dashboard) ══ */
        .card-wrap {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 18px;
            box-shadow: var(--shadow-sm);
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 3px;
            padding: 3px 9px;
            border-radius: 999px;
            font-size: 10.5px;
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
            white-space: nowrap;
        }

        .b-green {
            background: var(--green-soft);
            color: var(--green);
        }

        .b-amber {
            background: var(--amber-soft);
            color: var(--amber);
        }

        .b-red {
            background: var(--red-soft);
            color: var(--red);
        }

        .scroll-fade-wrap {
            position: relative;
        }

        /* ══ RESPONSIVE (CONTENT) ══ */
        @media (max-width: 859px) {
            .hero-name {
                font-size: 20px;
            }

            .all-loc-grid {
                grid-template-columns: 1fr 1fr;
            }

            .hero-inner {
                padding: 0 16px 24px;
            }
        }

        @media (max-width: 620px) {
            .all-loc-grid {
                grid-template-columns: 1fr;
            }

            .active-parking-card {
                flex-wrap: wrap;
            }

            .apc-action {
                width: 100%;
                text-align: center;
            }

            #parkingMap {
                height: 260px;
            }
        }

        @media (max-width: 400px) {
            .quick-stats {
                gap: 8px;
            }

            .qs-card {
                padding: 12px 10px;
            }

            .qs-val {
                font-size: 18px;
            }
        }
    </style>
@endsection

@section('content')
    {{-- ══ PAGE DATA ══ --}}
    @php
        $user = auth()->user();

        // Format total biaya
        $biayaFormatted =
            $totalBiaya >= 1000000
                ? number_format($totalBiaya / 1000000, 1) . 'jt'
                : number_format($totalBiaya / 1000, 0) . 'k';

        // Parking locations untuk JS
        $jsLokasi = $lokasiParkir
            ->map(function ($l) {
                $tersedia = $l->slot_tersedia ?? 0;
                $total = $l->total_slot ?? 0;
                $status = $tersedia == 0 ? 'full' : ($tersedia <= 5 ? 'busy' : 'avail');
                return [
                    'id' => $l->id,
                    'name' => $l->nama,
                    'addr' => $l->alamat,
                    'lat' => (float) $l->latitude,
                    'lng' => (float) $l->longitude,
                    'slots' => $tersedia,
                    'status' => $status,
                    'price' => 'Rp ' . number_format($l->harga_per_jam, 0, ',', '.') . '/jam',
                    'harga' => $l->harga_per_jam,
                    'rating' => 4.5,
                    'foto' => $l->foto ? asset('storage/' . $l->foto) : null,
                    'url' => route('user.lokasi.show', $l->id),
                ];
            })
            ->values();

        // Active parking
        $ap = $pemesananAktif ?? null;
        $apLokasi = $ap?->slotParkir?->lokasiParkir;
        $apSelesai = $ap ? \Carbon\Carbon::parse($ap->waktu_selesai) : null;
        $apSisaStr = null;
        if ($ap && $apSelesai) {
            $diff = now()->diff($apSelesai);
            $apSisaStr = now()->lt($apSelesai) ? $diff->h . 'j ' . $diff->i . 'm tersisa' : 'Waktu habis';
        }

        // Icon colors for history
        $histColors = ['var(--blue-soft)', 'var(--green-soft)', 'var(--amber-soft)', 'var(--blue-soft)'];
        $histIconColors = ['var(--blue-main)', 'var(--green)', 'var(--amber)', 'var(--blue-main)'];
    @endphp

    <!-- ════════ MAIN ════════ -->
    <main class="main-wrap">

        <!-- HERO -->
        <section class="hero-banner">
            <div class="hero-inner">
                <div class="hero-greeting">Selamat Datang,</div>
                <div class="hero-name">{{ $user->name }} 👋</div>

                <div class="search-bar">
                    <svg class="search-icon" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8" />
                        <line x1="21" y1="21" x2="16.65" y2="16.65" />
                    </svg>
                    <input id="searchInput" placeholder="Cari lokasi parkir..." />
                    <button class="search-loc-btn" title="Lokasi saya" onclick="centerMap()">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.5">
                            <circle cx="12" cy="12" r="3" />
                            <path d="M12 1v4M12 19v4M1 12h4M19 12h4" />
                        </svg>
                    </button>
                </div>

                <div class="filter-pills">
                    <div class="pill active" onclick="filterPill(this)">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.5">
                            <line x1="4" y1="6" x2="20" y2="6" />
                            <line x1="8" y1="12" x2="16" y2="12" />
                            <line x1="11" y1="18" x2="13" y2="18" />
                        </svg>
                        Semua
                    </div>
                    <div class="pill" onclick="filterPill(this)">Terdekat</div>
                    <div class="pill" onclick="filterPill(this)">Tersedia</div>
                    <div class="pill" onclick="filterPill(this)">Termurah</div>
                    <div class="pill" onclick="filterPill(this)">Terpopuler</div>
                </div>
            </div>
        </section>

        <!-- MAP -->
        <div class="content-inner">
            <div class="map-section section">
                <div id="parkingMap"></div>
                <div class="map-controls">
                    <div class="map-ctrl-btn-map" onclick="map.zoomIn()" title="Zoom in">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.5">
                            <line x1="12" y1="5" x2="12" y2="19" />
                            <line x1="5" y1="12" x2="19" y2="12" />
                        </svg>
                    </div>
                    <div class="map-ctrl-btn-map" onclick="map.zoomOut()" title="Zoom out">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.5">
                            <line x1="5" y1="12" x2="19" y2="12" />
                        </svg>
                    </div>
                    <div class="map-ctrl-btn-map" onclick="centerMap()" title="Lokasi saya">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.5">
                            <circle cx="12" cy="12" r="3" />
                            <path d="M12 1v4M12 19v4M1 12h4M19 12h4" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-inner">

            <!-- ── ACTIVE PARKING ── -->
            @if ($ap)
                <div class="section">
                    <div class="active-parking-card">
                        <div class="apc-icon">
                            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <rect x="1" y="3" width="15" height="13" rx="2" />
                                <path d="M16 8h4a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2h-4" />
                                <circle cx="5.5" cy="18.5" r="2.5" />
                                <circle cx="18.5" cy="18.5" r="2.5" />
                            </svg>
                        </div>
                        <div class="apc-body">
                            <div class="apc-label">Parkir Aktif Sekarang</div>
                            <div class="apc-name">{{ $apLokasi?->nama ?? '-' }}</div>
                            <div class="apc-meta">
                                <div class="apc-meta-item">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <circle cx="12" cy="12" r="10" />
                                        <polyline points="12 6 12 12 16 14" />
                                    </svg>
                                    {{ $apSisaStr }}
                                </div>
                                <div class="apc-meta-item">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                                    </svg>
                                    Slot {{ $ap->slotParkir?->kode_slot ?? '-' }}
                                </div>
                            </div>
                        </div>
                        <a class="apc-action" href="{{ route('user.booking.qr', $ap->id) }}">Detail →</a>
                    </div>
                </div>
            @endif

            <!-- ── RECOMMENDED LOCATIONS ── -->
            <div class="section">
                <div class="section-header">
                    <span class="section-title">Lokasi Parkir</span>
                    <a class="section-action" href="{{ route('user.lokasi') }}">Lihat Semua →</a>
                </div>
                <div class="scroll-fade-wrap">
                    <div class="loc-scroll" id="locScroll"></div>
                </div>
            </div>

            <!-- ── QUICK STATS ── -->
            <div class="section">
                <div class="section-header">
                    <span class="section-title">Ringkasan Saya</span>
                </div>
                <div class="quick-stats">
                    <div class="qs-card">
                        <div class="qs-icon" style="background:var(--blue-soft)">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                                stroke="var(--blue-main)" stroke-width="2">
                                <rect x="1" y="3" width="15" height="13" rx="2" />
                                <circle cx="5.5" cy="18.5" r="2.5" />
                            </svg>
                        </div>
                        <div class="qs-val">{{ $totalParkir }}</div>
                        <div class="qs-label">Total Parkir</div>
                    </div>
                    <div class="qs-card">
                        <div class="qs-icon" style="background:var(--green-soft)">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--green)"
                                stroke-width="2">
                                <line x1="12" y1="1" x2="12" y2="23" />
                                <path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6" />
                            </svg>
                        </div>
                        <div class="qs-val">{{ $biayaFormatted }}</div>
                        <div class="qs-label">Total Biaya</div>
                    </div>
                    <div class="qs-card">
                        <div class="qs-icon" style="background:var(--amber-soft)">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--amber)"
                                stroke-width="2">
                                <rect x="1" y="3" width="15" height="13" rx="2" />
                                <path d="M16 8h4a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2h-4" />
                                <circle cx="5.5" cy="18.5" r="2.5" />
                                <circle cx="18.5" cy="18.5" r="2.5" />
                            </svg>
                        </div>
                        <div class="qs-val">{{ $totalKendaraan }}</div>
                        <div class="qs-label">Kendaraan</div>
                    </div>
                </div>
            </div>

            <!-- ── PROMO ── -->
            <div class="section">
                <div class="section-header">
                    <span class="section-title">Promo & Penawaran</span>
                </div>
                <div class="scroll-fade-wrap">
                    <div class="promo-scroll">
                        <div class="promo-card" style="background:linear-gradient(135deg,#2563eb,#7c3aed)">
                            <div class="promo-tag">WEEKEND DEAL</div>
                            <div class="promo-title">50% Off<br>Sabtu & Minggu</div>
                            <div class="promo-desc">Berlaku di 12 lokasi terpilih</div>
                        </div>
                        <div class="promo-card" style="background:linear-gradient(135deg,#059669,#10b981)">
                            <div class="promo-tag">MEMBER BENEFIT</div>
                            <div class="promo-title">Parkir Gratis<br>Jam Pertama</div>
                            <div class="promo-desc">Khusus member Parkify Premium</div>
                        </div>
                        <div class="promo-card" style="background:linear-gradient(135deg,#d97706,#f59e0b)">
                            <div class="promo-tag">CASHBACK</div>
                            <div class="promo-title">Cashback<br>Rp 10.000</div>
                            <div class="promo-desc">Min. transaksi Rp 20.000</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ── ALL LOCATIONS GRID ── -->
            <div class="section">
                <div class="section-header">
                    <span class="section-title">Semua Lokasi</span>
                    <a class="section-action" href="{{ route('user.lokasi') }}">Lihat Peta →</a>
                </div>
                <div class="all-loc-grid" id="allLocGrid"></div>
            </div>

            <!-- ── RECENT HISTORY ── -->
            <div class="section">
                <div class="section-header">
                    <span class="section-title">Riwayat Parkir</span>
                    <a class="section-action" href="{{ route('user.riwayat') }}">Lihat Semua →</a>
                </div>
                <div class="card-wrap">
                    <div class="history-list">
                        @forelse($riwayat as $r)
                            @php
                                $rLokasi = $r->slotParkir?->lokasiParkir;
                                $ci = $loop->index % 4;
                            @endphp
                            <div class="hist-item">
                                <div class="hist-icon" style="background:{{ $histColors[$ci] }}">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                        stroke="{{ $histIconColors[$ci] }}" stroke-width="2.5">
                                        <rect x="1" y="3" width="15" height="13" rx="2" />
                                        <circle cx="5.5" cy="18.5" r="2.5" />
                                    </svg>
                                </div>
                                <div class="hist-body">
                                    <div class="hist-name">{{ $rLokasi?->nama ?? '-' }}</div>
                                    <div class="hist-sub">Slot {{ $r->slotParkir?->kode_slot ?? '-' }} ·
                                        {{ $r->durasi_parkir }} jam</div>
                                </div>
                                <div class="hist-right">
                                    <div class="hist-price">Rp {{ number_format($r->total_harga, 0, ',', '.') }}</div>
                                    <div class="hist-date">{{ \Carbon\Carbon::parse($r->waktu_mulai)->diffForHumans() }}
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div style="text-align:center;padding:24px 0;color:var(--text-muted);font-size:13px">
                                Belum ada riwayat parkir
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <div style="height:12px"></div>
        </div>
    </main>
@endsection

@section('scripts')
    <script>
        /* ══ DATA FROM PHP ══ */
        const parkingLocations = {!! $jsLokasi->toJson() !!};

        const statusColor = {
            avail: '#10b981',
            busy: '#f59e0b',
            full: '#ef4444'
        };
        const statusLabel = {
            avail: 'Tersedia',
            busy: 'Hampir Penuh',
            full: 'Penuh'
        };
        const statusClass = {
            avail: 'popup-avail',
            busy: 'popup-busy',
            full: 'popup-full'
        };
        const cardBgs = ['#dbeafe', '#dcfce7', '#fef3c7', '#f3e8ff', '#ffe4e6', '#e0f2fe'];
        const emojis = ['🏬', '🏢', '🏪', '🏬', '🏤', '🏥'];

        /* ══ FILTER PILLS ══ */
        function filterPill(el) {
            document.querySelectorAll('.pill').forEach(p => p.classList.remove('active'));
            el.classList.add('active');
        }

        /* ══ LEAFLET MAP ══ */
        let map;
        let userMarker;

        function initMap() {
            // Default center: rata-rata koordinat lokasi, fallback Bogor
            const defaultLat = parkingLocations.length ?
                parkingLocations.reduce((s, l) => s + l.lat, 0) / parkingLocations.length :
                -6.5944;
            const defaultLng = parkingLocations.length ?
                parkingLocations.reduce((s, l) => s + l.lng, 0) / parkingLocations.length :
                106.7892;

            map = L.map('parkingMap', {
                center: [defaultLat, defaultLng],
                zoom: 14,
                zoomControl: false,
                scrollWheelZoom: true
            });

            L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
                attribution: '© OpenStreetMap © CARTO',
                subdomains: 'abcd',
                maxZoom: 20
            }).addTo(map);

            parkingLocations.forEach(loc => {
                if (!loc.lat || !loc.lng) return;
                const color = statusColor[loc.status];
                const icon = L.divIcon({
                    className: '',
                    html: `<div style="width:36px;height:36px;border-radius:50% 50% 50% 0;background:${color};transform:rotate(-45deg);border:3px solid #fff;box-shadow:0 3px 10px rgba(0,0,0,0.3);display:flex;align-items:center;justify-content:center;">
        <svg style="transform:rotate(45deg)" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5"><rect x="1" y="3" width="15" height="13" rx="2"/><circle cx="5.5" cy="18.5" r="2.5"/></svg>
      </div>`,
                    iconSize: [36, 36],
                    iconAnchor: [18, 36],
                    popupAnchor: [0, -38]
                });

                const marker = L.marker([loc.lat, loc.lng], {
                    icon
                }).addTo(map);
                marker.bindPopup(`
      <div class="custom-popup">
        <div class="popup-name">${loc.name}</div>
        <div style="font-size:11px;color:#94a3b8;margin-bottom:8px">${loc.addr}</div>
        <div class="popup-meta">
          <span class="popup-badge ${statusClass[loc.status]}">● ${statusLabel[loc.status]}</span>
          <span class="popup-price">${loc.price}</span>
        </div>
        ${loc.slots > 0 ? `<div style="font-size:11px;color:#64748b;margin-top:6px">${loc.slots} slot tersedia</div>` : ''}
        <a class="popup-btn" href="${loc.url}">Lihat Detail →</a>
      </div>
    `, {
                    maxWidth: 220
                });
            });

            // Geolocation
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    (pos) => {
                        const lat = pos.coords.latitude;
                        const lng = pos.coords.longitude;
                        userMarker = L.circleMarker([lat, lng], {
                            radius: 8,
                            color: '#2563eb',
                            fillColor: '#2563eb',
                            fillOpacity: 0.9,
                            weight: 3
                        }).addTo(map).bindPopup('<b style="font-family:Space Grotesk">Lokasi Anda</b>');
                        map.setView([lat, lng], 15);
                    },
                    () => {}, {
                        enableHighAccuracy: true,
                        timeout: 10000,
                        maximumAge: 0
                    }
                );
            }
        }

        function centerMap() {
            if (!navigator.geolocation) return;
            navigator.geolocation.getCurrentPosition((pos) => {
                map.setView([pos.coords.latitude, pos.coords.longitude], 15);
            });
        }

        document.addEventListener('DOMContentLoaded', () => {
            setTimeout(initMap, 100);
        });

        /* ══ LOC SCROLL CARDS ══ */
        const locScroll = document.getElementById('locScroll');
        if (locScroll && parkingLocations.length) {
            parkingLocations.forEach((loc) => {
                const slotBadge = loc.status === 'full' ?
                    `<span style="color:var(--red);font-weight:600;font-size:11px">Penuh</span>` :
                    `<span style="color:${loc.status === 'busy' ? 'var(--amber)' : 'var(--green)'};font-weight:600;font-size:11px">${loc.slots} slot</span>`;

                const imgHtml = loc.foto ?
                    `<img src="${loc.foto}" style="width:100%;height:100%;object-fit:cover" alt="">` :
                    `<span style="font-size:32px">🏬</span>`;

                locScroll.innerHTML += `
      <a class="loc-card" href="${loc.url}">
        <div class="loc-img-placeholder">${imgHtml}</div>
        <div class="loc-body">
          <div class="loc-name">${loc.name}</div>
          <div class="loc-addr">${loc.addr}</div>
          <div class="loc-meta">
            <div class="loc-price">
              <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/></svg>
              ${loc.price}
            </div>
            <div class="loc-rating">★ ${loc.rating}</div>
          </div>
          <div style="margin-top:8px;display:flex;align-items:center;justify-content:space-between">
            <span class="badge ${loc.status === 'avail' ? 'b-green' : loc.status === 'busy' ? 'b-amber' : 'b-red'}">● ${statusLabel[loc.status]}</span>
            ${slotBadge}
          </div>
        </div>
      </a>`;
            });
        } else if (locScroll) {
            locScroll.innerHTML =
                `<div style="color:var(--text-muted);font-size:13px;padding:20px 0">Belum ada lokasi parkir tersedia.</div>`;
        }

        /* ══ ALL LOC GRID ══ */
        const allLocGrid = document.getElementById('allLocGrid');
        if (allLocGrid && parkingLocations.length) {
            parkingLocations.forEach((loc, i) => {
                const statusCls = loc.status === 'avail' ? 'avail-text' : loc.status === 'busy' ? 'busy-text' :
                    'full-text';
                allLocGrid.innerHTML += `
      <a class="all-loc-card" href="${loc.url}">
        <div class="alc-icon" style="background:${cardBgs[i % cardBgs.length]}">${emojis[i % emojis.length]}</div>
        <div style="min-width:0;flex:1">
          <div class="alc-name">${loc.name}</div>
          <div class="alc-meta">
            <span>${loc.price}</span>
            <span class="alc-dot"></span>
            <span class="${statusCls}">${statusLabel[loc.status]}</span>
          </div>
        </div>
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="var(--text-muted)" stroke-width="2" style="flex-shrink:0"><polyline points="9 18 15 12 9 6"/></svg>
      </a>`;
            });
        } else if (allLocGrid) {
            allLocGrid.innerHTML =
                `<div style="color:var(--text-muted);font-size:13px;padding:20px 0;grid-column:1/-1">Belum ada lokasi parkir.</div>`;
        }
    </script>
@endsection
