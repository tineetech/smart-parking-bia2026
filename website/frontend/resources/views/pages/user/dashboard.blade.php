@extends('layouts.user')

@section('styles')
    {{-- Font Awesome CDN (tambahkan di layouts/user.blade.php jika belum ada) --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"> --}}

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
            font-size: 15px;
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
            font-size: 15px;
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
            font-size: 14px;
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
            font-size: 16px;
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
            background: #1d4ed8;
            border-radius: 18px;
            padding: 20px 22px;
            display: flex;
            align-items: center;
            gap: 16px;
            position: relative;
            overflow: hidden;
            width: 100%;
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
            font-size: 22px;
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
            background: white;
            border: 1px solid rgba(255, 255, 255, 0.25);
            border-radius: 10px;
            padding: 8px 14px;
            font-size: 12.5px;
            font-weight: 600;
            color: var(--blue-main);
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
            font-size: 15px;
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

        /* ══ HELPERS ══ */
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

        /* ══ FILTER ANIMATIONS ══ */
@keyframes cardFadeIn {
    from {
        opacity: 0;
        transform: translateY(12px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.loc-card, .all-loc-card {
    animation: cardFadeIn 0.3s ease both;
}

/* Stagger delay untuk setiap card */
.loc-card:nth-child(1), .all-loc-card:nth-child(1) { animation-delay: 0ms; }
.loc-card:nth-child(2), .all-loc-card:nth-child(2) { animation-delay: 50ms; }
.loc-card:nth-child(3), .all-loc-card:nth-child(3) { animation-delay: 100ms; }
.loc-card:nth-child(4), .all-loc-card:nth-child(4) { animation-delay: 150ms; }
.loc-card:nth-child(5), .all-loc-card:nth-child(5) { animation-delay: 200ms; }
.loc-card:nth-child(6), .all-loc-card:nth-child(6) { animation-delay: 250ms; }

/* ══ REKOMENDASI BANNER ══ */
.reko-banner {
    display: flex;
    align-items: center;
    gap: 10px;
    background: linear-gradient(135deg, #1d4ed8 0%, #2563eb 100%);
    border-radius: 14px;
    padding: 14px 16px;
    margin-bottom: 14px;
    animation: cardFadeIn 0.35s ease both;
    position: relative;
    overflow: hidden;
}

.reko-banner::after {
    content: '';
    position: absolute;
    right: -20px;
    top: -20px;
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: rgba(255,255,255,0.08);
}

.reko-icon {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    background: rgba(255,255,255,0.15);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 16px;
    flex-shrink: 0;
}

.reko-body {
    flex: 1;
    min-width: 0;
}

.reko-label {
    font-size: 10.5px;
    color: rgba(255,255,255,0.7);
    font-weight: 500;
    margin-bottom: 2px;
}

.reko-name {
    font-family: 'Space Grotesk', sans-serif;
    font-size: 14px;
    font-weight: 800;
    color: #fff;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.reko-sub {
    font-size: 11px;
    color: rgba(255,255,255,0.7);
    margin-top: 2px;
}

.reko-btn {
    background: rgba(255,255,255,0.2);
    border: 1px solid rgba(255,255,255,0.3);
    border-radius: 8px;
    padding: 6px 12px;
    font-size: 11.5px;
    font-weight: 600;
    color: #fff;
    text-decoration: none;
    white-space: nowrap;
    transition: background 0.15s;
}

.reko-btn:hover {
    background: rgba(255,255,255,0.3);
    color: #fff;
}

/* ══ LOC SCROLL fade out saat ganti ══ */
.cards-exiting .loc-card,
.cards-exiting .all-loc-card {
    animation: cardFadeOut 0.15s ease both;
}

@keyframes cardFadeOut {
    to {
        opacity: 0;
        transform: translateY(-8px);
    }
}

/* Highlight ring on map for recommended marker */
.marker-recommended {
    animation: markerPulse 1.5s ease-in-out infinite;
}

@keyframes markerPulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.15); }
}

        /* ══ RESPONSIVE ══ */
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

        $biayaFormatted =
            $totalBiaya >= 1000000
                ? number_format($totalBiaya / 1000000, 1) . 'jt'
                : number_format($totalBiaya / 1000, 0) . 'k';

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

        $ap = $pemesananAktif ?? null;
        $apLokasi = $ap?->slotParkir?->lokasiParkir;
        $apSelesai = $ap ? \Carbon\Carbon::parse($ap->waktu_selesai) : null;
        $apSisaStr = null;
        if ($ap && $apSelesai) {
            $diff = now()->diff($apSelesai);
            $apSisaStr = now()->lt($apSelesai) ? $diff->h . 'j ' . $diff->i . 'm tersisa' : 'Waktu habis';
        }

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
                    {{-- Search icon: fa-magnifying-glass --}}
                    <i class="fa-solid fa-magnifying-glass search-icon"></i>
                    <input id="searchInput" placeholder="Cari lokasi parkir..." />
                    {{-- Location crosshair icon: fa-crosshairs --}}
                    <button class="search-loc-btn" title="Lokasi saya" onclick="centerMap()">
                        <i class="fa-solid fa-crosshairs"></i>
                    </button>
                </div>

                
                {{-- Filter Pills --}}
<div class="filter-pills">
    <div class="pill active" data-filter="Semua" onclick="filterPill(this)">
        <i class="fa-solid fa-sliders" style="font-size:11px"></i> Semua
    </div>
    <div class="pill" data-filter="Terdekat" onclick="filterPill(this)">Terdekat</div>
    <div class="pill" data-filter="Tersedia" onclick="filterPill(this)">Tersedia</div>
    <div class="pill" data-filter="Termurah" onclick="filterPill(this)">Termurah</div>
    <div class="pill" data-filter="Terpopuler" onclick="filterPill(this)">Terpopuler</div>
</div>
            </div>
        </section>

        <!-- MAP -->
        <div class="content-inner">
            <div class="map-section section">
                <div id="parkingMap"></div>
                <div class="map-controls">
                    {{-- Zoom in: fa-plus --}}
                    <div class="map-ctrl-btn-map" onclick="map.zoomIn()" title="Zoom in">
                        <i class="fa-solid fa-plus"></i>
                    </div>
                    {{-- Zoom out: fa-minus --}}
                    <div class="map-ctrl-btn-map" onclick="map.zoomOut()" title="Zoom out">
                        <i class="fa-solid fa-minus"></i>
                    </div>
                    {{-- My location: fa-location-crosshairs --}}
                    <div class="map-ctrl-btn-map" onclick="centerMap()" title="Lokasi saya">
                        <i class="fa-solid fa-location-crosshairs"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-inner">

            <!-- ── ACTIVE PARKING ── -->
            @if ($ap)
                <div class="section">
                    <div class="active-parking-card">
                        {{-- Truck/car icon: fa-truck-front --}}
                        <div class="apc-icon">
                            <i class="fa-solid fa-square-parking"></i>
                        </div>
                        <div class="apc-body">
                            <div class="apc-label">Parkir Aktif Sekarang</div>
                            <div class="apc-name">{{ $apLokasi?->nama ?? '-' }}</div>
                            <div class="apc-meta">
                                {{-- Clock icon: fa-clock --}}
                                <div class="apc-meta-item">
                                    <i class="fa-regular fa-clock"></i>
                                    {{ $apSisaStr }}
                                </div>
                                {{-- Location pin: fa-location-dot --}}
                                <div class="apc-meta-item">
                                    <i class="fa-solid fa-location-dot"></i>
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

    <div id="rekoBannerWrap"></div> 
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
                    {{-- Total Parkir: fa-car --}}
                    <div class="qs-card">
                        <div class="qs-icon" style="background:var(--blue-soft); color:var(--blue-main)">
                            <i class="fa-solid fa-car"></i>
                        </div>
                        <div class="qs-val">{{ $totalParkir }}</div>
                        <div class="qs-label">Total Parkir</div>
                    </div>
                    {{-- Total Biaya: fa-money-bill-wave --}}
                    <div class="qs-card">
                        <div class="qs-icon" style="background:var(--green-soft); color:var(--green)">
                            <i class="fa-solid fa-money-bill-wave"></i>
                        </div>
                        <div class="qs-val">{{ $biayaFormatted }}</div>
                        <div class="qs-label">Total Biaya</div>
                    </div>
                    {{-- Kendaraan: fa-motorcycle / fa-truck --}}
                    <div class="qs-card">
                        <div class="qs-icon" style="background:var(--amber-soft); color:var(--amber)">
                            <i class="fa-solid fa-car"></i>
                        </div>
                        <div class="qs-val">{{ $totalKendaraan }}</div>
                        <div class="qs-label">Kendaraan</div>
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
                                {{-- History car icon: fa-car-side --}}
                                <div class="hist-icon"
                                    style="background:{{ $histColors[$ci] }}; color:{{ $histIconColors[$ci] }}">
                                    <i class="fa-solid fa-car-side"></i>
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
        let userLat = null;
        let userLng = null;
        let activeFilter = 'Semua';
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

let mapMarkers = []; // simpan semua marker Leaflet

/* ══ FILTER PILLS ══ */
function filterPill(el) {
    document.querySelectorAll('.pill').forEach(p => p.classList.remove('active'));
    el.classList.add('active');
    activeFilter = el.dataset.filter;

    if (activeFilter === 'Terdekat' && userLat === null) {
        requestUserLocation();
    } else {
        renderWithTransition();
    }
}

/* ══ ANIMASI TRANSISI CARDS ══ */
function renderWithTransition() {
    const locScroll = document.getElementById('locScroll');
    const allLocGrid = document.getElementById('allLocGrid');

    // Fade out dulu
    [locScroll, allLocGrid].forEach(el => {
        if (el) {
            el.style.opacity = '0';
            el.style.transform = 'translateY(6px)';
            el.style.transition = 'opacity 0.15s ease, transform 0.15s ease';
        }
    });

    setTimeout(() => {
        renderCards();
        // Fade in
        [locScroll, allLocGrid].forEach(el => {
            if (el) {
                el.style.opacity = '1';
                el.style.transform = 'translateY(0)';
            }
        });
    }, 150);
}

/* ══ HAVERSINE ══ */
function hitungJarak(lat1, lng1, lat2, lng2) {
    const R = 6371;
    const dLat = (lat2 - lat1) * Math.PI / 180;
    const dLng = (lng2 - lng1) * Math.PI / 180;
    const a = Math.sin(dLat/2)**2 +
              Math.cos(lat1 * Math.PI/180) * Math.cos(lat2 * Math.PI/180) *
              Math.sin(dLng/2)**2;
    return R * 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
}

function jarakStr(km) {
    return km < 1 ? (km * 1000).toFixed(0) + ' m' : km.toFixed(1) + ' km';
}

/* ══ FILTER & SORT ══ */
function getFilteredLocs() {
    let locs = parkingLocations.map(l => ({...l}));

    if (userLat !== null) {
        locs = locs.map(l => ({
            ...l,
            jarak: hitungJarak(userLat, userLng, l.lat, l.lng)
        }));
    }

    switch (activeFilter) {
        case 'Terdekat':
            locs = locs.sort((a, b) => (a.jarak ?? 9999) - (b.jarak ?? 9999));
            break;
        case 'Tersedia':
            locs = locs.filter(l => l.status !== 'full').sort((a, b) => b.slots - a.slots);
            break;
        case 'Termurah':
            locs = locs.sort((a, b) => a.harga - b.harga);
            break;
        case 'Terpopuler':
            locs = locs.sort((a, b) => b.rating - a.rating);
            break;
    }
    return locs;
}

/* ══ REKOMENDASI BANNER CONFIG ══ */
const rekoConfig = {
    'Terdekat':   { icon: 'fa-location-dot', label: 'Paling Dekat dari Lokasimu', sub: loc => jarakStr(loc.jarak) + ' dari kamu' },
    'Tersedia':   { icon: 'fa-circle-check', label: 'Slot Paling Banyak Tersedia', sub: loc => loc.slots + ' slot tersedia' },
    'Termurah':   { icon: 'fa-tag',          label: 'Harga Paling Murah',          sub: loc => loc.price },
    'Terpopuler': { icon: 'fa-star',         label: 'Rating Tertinggi',            sub: loc => '⭐ ' + loc.rating + ' / 5.0' },
};

/* ══ FOKUS MAP KE LOKASI ══ */
function focusMapTo(loc) {
    if (!map || !loc) return;

    // Hapus highlight sebelumnya
    mapMarkers.forEach(m => {
        const el = m._icon;
        if (el) el.style.filter = '';
    });

    // Pan & zoom ke lokasi terbaik
    map.flyTo([loc.lat, loc.lng], 16, { animate: true, duration: 1.2 });

    // Buka popup marker yang sesuai
    const target = mapMarkers.find(m =>
        Math.abs(m.getLatLng().lat - loc.lat) < 0.0001 &&
        Math.abs(m.getLatLng().lng - loc.lng) < 0.0001
    );
    if (target) {
        setTimeout(() => target.openPopup(), 700);
        // Tambah efek glow pada marker
        if (target._icon) {
            target._icon.style.filter = 'drop-shadow(0 0 8px rgba(37,99,235,0.8))';
        }
    }
}

/* ══ RENDER CARDS ══ */
function renderCards() {
    const filtered = getFilteredLocs();
    const topLoc = filtered[0] ?? null;
    const reko = activeFilter !== 'Semua' ? rekoConfig[activeFilter] : null;

    // ── Rekomendasi Banner (di atas loc-scroll) ──
    const rekoContainer = document.getElementById('rekoBannerWrap');
    if (rekoContainer) {
        if (reko && topLoc) {
            rekoContainer.innerHTML = `
                <div class="reko-banner">
                    <div class="reko-icon"><i class="fa-solid ${reko.icon}"></i></div>
                    <div class="reko-body">
                        <div class="reko-label">${reko.label}</div>
                        <div class="reko-name">${topLoc.name}</div>
                        <div class="reko-sub">${reko.sub(topLoc)}</div>
                    </div>
                    <a class="reko-btn" href="${topLoc.url}">Lihat →</a>
                </div>`;
            // Fokus map ke rekomendasi terbaik
            focusMapTo(topLoc);
        } else {
            rekoContainer.innerHTML = '';
            // Kembali ke view semua marker
            if (map && parkingLocations.length) {
                const bounds = parkingLocations
                    .filter(l => l.lat && l.lng)
                    .map(l => [l.lat, l.lng]);
                if (bounds.length) map.flyToBounds(bounds, { padding: [40, 40], animate: true, duration: 1 });
            }
        }
    }

    // ── Loc Scroll ──
    const locScroll = document.getElementById('locScroll');
    if (locScroll) {
        if (!filtered.length) {
            locScroll.innerHTML = `<div style="color:var(--text-muted);font-size:13px;padding:20px 0">Tidak ada lokasi sesuai filter.</div>`;
        } else {
            locScroll.innerHTML = '';
            filtered.forEach((loc) => {
                const slotBadge = loc.status === 'full'
                    ? `<span style="color:var(--red);font-weight:600;font-size:11px">Penuh</span>`
                    : `<span style="color:${loc.status === 'busy' ? 'var(--amber)' : 'var(--green)'};font-weight:600;font-size:11px">${loc.slots} slot</span>`;
                const imgHtml = loc.foto
                    ? `<img src="${loc.foto}" style="width:100%;height:100%;object-fit:cover" alt="">`
                    : `<span style="font-size:32px">🏬</span>`;
                const jarakHtml = loc.jarak !== undefined
                    ? `<div style="font-size:11px;color:var(--text-muted);margin-top:4px"><i class="fa-solid fa-location-dot" style="font-size:10px;margin-right:3px"></i>${jarakStr(loc.jarak)}</div>`
                    : '';

                locScroll.innerHTML += `
                    <a class="loc-card" href="${loc.url}">
                        <div class="loc-img-placeholder">${imgHtml}</div>
                        <div class="loc-body">
                            <div class="loc-name">${loc.name}</div>
                            <div class="loc-addr">${loc.addr}</div>
                            <div class="loc-meta">
                                <div class="loc-price"><i class="fa-solid fa-tag" style="font-size:10px"></i> ${loc.price}</div>
                                <div class="loc-rating"><i class="fa-solid fa-star" style="font-size:11px"></i> ${loc.rating}</div>
                            </div>
                            ${jarakHtml}
                            <div style="margin-top:8px;display:flex;align-items:center;justify-content:space-between">
                                <span class="badge ${loc.status === 'avail' ? 'b-green' : loc.status === 'busy' ? 'b-amber' : 'b-red'}">● ${statusLabel[loc.status]}</span>
                                ${slotBadge}
                            </div>
                        </div>
                    </a>`;
            });
        }
    }

    // ── All Loc Grid ──
    const allLocGrid = document.getElementById('allLocGrid');
    if (allLocGrid) {
        if (!filtered.length) {
            allLocGrid.innerHTML = `<div style="color:var(--text-muted);font-size:13px;padding:20px 0;grid-column:1/-1">Tidak ada lokasi sesuai filter.</div>`;
        } else {
            allLocGrid.innerHTML = '';
            filtered.forEach((loc, i) => {
                const statusCls = loc.status === 'avail' ? 'avail-text' : loc.status === 'busy' ? 'busy-text' : 'full-text';
                const jarakInfo = loc.jarak !== undefined ? ` · ${jarakStr(loc.jarak)}` : '';
                allLocGrid.innerHTML += `
                    <a class="all-loc-card" href="${loc.url}">
                        <div class="alc-icon" style="background:${cardBgs[i % cardBgs.length]}">${emojis[i % emojis.length]}</div>
                        <div style="min-width:0;flex:1">
                            <div class="alc-name">${loc.name}</div>
                            <div class="alc-meta">
                                <span>${loc.price}</span>
                                <span class="alc-dot"></span>
                                <span class="${statusCls}">${statusLabel[loc.status]}${jarakInfo}</span>
                            </div>
                        </div>
                        <i class="fa-solid fa-chevron-right" style="color:var(--text-muted);font-size:13px;flex-shrink:0"></i>
                    </a>`;
            });
        }
    }
}

/* ══ REQUEST LOKASI USER ══ */
function requestUserLocation() {
    if (!navigator.geolocation) return;
    navigator.geolocation.getCurrentPosition(
        (pos) => {
            userLat = pos.coords.latitude;
            userLng = pos.coords.longitude;
            renderWithTransition();
        },
        () => alert('Tidak dapat mengakses lokasi. Pastikan izin diberikan.'),
        { enableHighAccuracy: true, timeout: 10000, maximumAge: 0 }
    );
}

/* ══ LEAFLET MAP ══ */
let map;
let userMarker;

function initMap() {
    const defaultLat = parkingLocations.length
        ? parkingLocations.reduce((s, l) => s + l.lat, 0) / parkingLocations.length : -6.5944;
    const defaultLng = parkingLocations.length
        ? parkingLocations.reduce((s, l) => s + l.lng, 0) / parkingLocations.length : 106.7892;

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

    // Simpan semua marker ke mapMarkers[]
    parkingLocations.forEach(loc => {
        if (!loc.lat || !loc.lng) return;
        const color = statusColor[loc.status];

        const icon = L.divIcon({
            className: '',
            html: `<div style="width:36px;height:36px;border-radius:50% 50% 50% 0;background:${color};transform:rotate(-45deg);border:3px solid #fff;box-shadow:0 3px 10px rgba(0,0,0,0.3);display:flex;align-items:center;justify-content:center;transition:filter 0.3s;">
                <i class="fa-solid fa-square-parking" style="transform:rotate(45deg);color:#fff;font-size:14px;"></i>
            </div>`,
            iconSize: [36, 36],
            iconAnchor: [18, 36],
            popupAnchor: [0, -38]
        });

        const marker = L.marker([loc.lat, loc.lng], { icon }).addTo(map);
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
        `, { maxWidth: 220 });

        mapMarkers.push(marker); // ← simpan marker
    });

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            (pos) => {
                userLat = pos.coords.latitude;
                userLng = pos.coords.longitude;
                userMarker = L.circleMarker([userLat, userLng], {
                    radius: 8, color: '#2563eb', fillColor: '#2563eb',
                    fillOpacity: 0.9, weight: 3
                }).addTo(map).bindPopup('<b style="font-family:Space Grotesk">Lokasi Anda</b>');
                map.setView([userLat, userLng], 15);
                if (activeFilter === 'Terdekat') renderWithTransition();
            },
            () => {}, { enableHighAccuracy: true, timeout: 10000, maximumAge: 0 }
        );
    }
}

function centerMap() {
    if (!navigator.geolocation) return;
    navigator.geolocation.getCurrentPosition((pos) => {
        map.flyTo([pos.coords.latitude, pos.coords.longitude], 15, { animate: true });
    });
}

document.addEventListener('DOMContentLoaded', () => {
    setTimeout(initMap, 100);
    renderCards();
});
    </script>
@endsection