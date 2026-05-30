@extends('layouts.user')

@section('styles')
    <style>
        /* ══ MAP ══ */
        #parkingMap {
            width: 100%;
            height: 400px;
            position: relative;
            z-index: 1;
        }

        .map-wrapper {
            position: relative;
            width: 100%;
            max-width: var(--max-content);
            margin: 0 auto;
        }

        .map-wrapper::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 80px;
            background: linear-gradient(to bottom, transparent, #D9E5F8);
            z-index: 10;
            pointer-events: none;
        }

        .map-controls {
            position: absolute;
            bottom: 88px;
            right: 14px;
            display: flex;
            flex-direction: column;
            gap: 6px;
            z-index: 50;
        }

        .map-ctrl-btn {
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

        .map-ctrl-btn:hover {
            border-color: var(--blue-main);
            color: var(--blue-main);
        }

        /* Leaflet popup */
        .leaflet-popup-content-wrapper {
            border-radius: 14px !important;
            box-shadow: var(--shadow-lg) !important;
            padding: 0 !important;
            overflow: hidden;
            border: 1px solid var(--border);
        }

        .leaflet-popup-content {
            margin: 0 !important;
            width: auto !important;
        }

        .custom-popup {
            padding: 12px 14px;
            min-width: 190px;
        }

        .popup-name {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 13px;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 3px;
        }

        .popup-addr {
            font-size: 11px;
            color: var(--text-muted);
            margin-bottom: 8px;
        }

        .popup-meta {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
            margin-bottom: 8px;
        }

        .popup-badge {
            font-size: 11px;
            font-weight: 600;
            padding: 2px 9px;
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
            font-size: 12px;
            color: var(--blue-main);
            font-weight: 700;
        }

        .popup-btn {
            display: block;
            width: 100%;
            background: var(--blue-main);
            color: #fff;
            border: none;
            border-radius: 9px;
            padding: 8px;
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

        /* ══ CONTENT PANEL ══ */
        .content-panel {
            position: relative;
            z-index: 20;
            max-width: var(--max-content);
            margin: -32px auto 0;
            background: #ffffff;
            border-radius: 24px 24px 0 0;
            box-shadow: 0 -4px 24px rgba(15, 30, 54, 0.08);
            padding: 0 0 calc(var(--bottom-nav-h) + 24px + env(safe-area-inset-bottom));
            min-height: 60vh;
        }

        /* ══ SEARCH ══ */
        .search-section {
            padding: 20px 20px 0;
        }

        .search-bar {
            display: flex;
            align-items: center;
            gap: 10px;
            background: var(--bg-input);
            border-radius: 14px;
            padding: 10px 14px;
            border: 1.5px solid var(--border);
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .search-bar:focus-within {
            border-color: var(--blue-pale);
            box-shadow: 0 6px 24px rgba(37, 99, 235, 0.12);
            background: #fff;
        }

        .search-icon {
            color: var(--text-muted);
            flex-shrink: 0;
        }

        .search-bar input {
            flex: 1;
            border: none;
            outline: none;
            font-family: 'Poppins', sans-serif;
            font-size: 13.5px;
            color: var(--text-primary);
            background: transparent;
        }

        .search-bar input::placeholder {
            color: var(--text-muted);
        }

        .search-loc-btn {
            width: 34px;
            height: 34px;
            border-radius: 10px;
            background: var(--blue-soft);
            border: none;
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

        /* Filter Pills */
        .filter-row {
            padding: 12px 20px 0;
            display: flex;
            gap: 8px;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
        }

        .filter-row::-webkit-scrollbar {
            display: none;
        }

        .pill {
            display: flex;
            align-items: center;
            gap: 5px;
            padding: 7px 14px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
            white-space: nowrap;
            transition: all 0.16s;
            flex-shrink: 0;
            border: 1.5px solid var(--border);
            color: var(--text-secondary);
            background: var(--bg-surface);
            text-decoration: none;
        }

        .pill:hover,
        .pill.active {
            background: var(--blue-main);
            border-color: var(--blue-main);
            color: #fff;
        }

        /* Results Header */
        .results-header {
            padding: 20px 20px 12px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .results-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 15px;
            font-weight: 800;
            color: var(--text-primary);
        }

        .results-count {
            font-size: 12px;
            font-weight: 500;
            color: var(--text-muted);
            background: var(--bg-input);
            padding: 4px 10px;
            border-radius: 999px;
            border: 1px solid var(--border);
        }

        /* ══ LOCATION CARDS ══ */
        .loc-list {
            padding: 0 20px;
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .loc-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 18px;
            overflow: hidden;
            box-shadow: var(--shadow-card);
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s, border-color 0.2s;
            text-decoration: none;
            color: inherit;
            display: block;
        }

        .loc-card:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-md);
            border-color: var(--blue-pale);
        }

        .loc-img-wrap {
            width: 100%;
            height: 160px;
            position: relative;
            overflow: hidden;
            background: #f8fafc;
        }

        .loc-img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.3s;
        }

        .loc-card:hover .loc-img-wrap img {
            transform: scale(1.03);
        }

        .loc-img-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 52px;
            background: #f8fafc;
        }

        .img-badge {
            position: absolute;
            top: 10px;
            left: 10px;
            font-size: 11px;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 999px;
            font-family: 'Poppins', sans-serif;
            backdrop-filter: blur(6px);
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .img-badge.avail {
            background: rgba(236, 253, 245, 0.92);
            color: var(--green);
        }

        .img-badge.busy {
            background: rgba(255, 251, 235, 0.92);
            color: var(--amber);
        }

        .img-badge.full {
            background: rgba(254, 242, 242, 0.92);
            color: var(--red);
        }

        .img-dist {
            position: absolute;
            top: 10px;
            right: 10px;
            background: rgba(0, 0, 0, 0.45);
            backdrop-filter: blur(6px);
            color: #fff;
            font-size: 11px;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 999px;
            font-family: 'Poppins', sans-serif;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .loc-body {
            padding: 14px 16px 16px;
        }

        .loc-name {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 15px;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 4px;
        }

        .loc-addr {
            font-size: 12px;
            color: var(--text-muted);
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .loc-tags {
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
            margin-bottom: 12px;
        }

        .loc-tag {
            font-size: 10.5px;
            color: var(--text-muted);
            background: var(--bg-input);
            border: 1px solid var(--border);
            border-radius: 6px;
            padding: 2px 7px;
            white-space: nowrap;
        }

        .loc-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
        }

        .loc-price-wrap {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .price-tag {
            display: flex;
            align-items: center;
            gap: 5px;
            background: var(--blue-soft);
            border: 1px solid var(--blue-pale);
            color: var(--blue-main);
            border-radius: 9px;
            padding: 5px 10px;
            font-size: 12px;
            font-weight: 700;
            font-family: 'Space Grotesk', sans-serif;
        }

        .slot-tag {
            display: flex;
            align-items: center;
            gap: 4px;
            background: var(--bg-input);
            border: 1px solid var(--border);
            border-radius: 9px;
            padding: 5px 10px;
            font-size: 12px;
            font-weight: 600;
            color: var(--text-secondary);
        }

        .slot-tag.has-slot {
            background: var(--green-soft);
            border-color: #a7f3d0;
            color: var(--green);
        }

        .slot-tag.few-slot {
            background: var(--amber-soft);
            border-color: #fde68a;
            color: var(--amber);
        }

        .slot-tag.no-slot {
            background: var(--red-soft);
            border-color: #fecaca;
            color: var(--red);
        }

        .loc-rating {
            display: flex;
            align-items: center;
            gap: 4px;
            font-size: 12.5px;
            font-weight: 700;
            color: var(--amber);
            font-family: 'Space Grotesk', sans-serif;
            margin-left: auto;
        }

        /* ══ EMPTY STATE ══ */
        .empty-state {
            text-align: center;
            padding: 56px 24px;
        }

        .empty-state svg {
            color: var(--text-muted);
            margin-bottom: 14px;
        }

        .empty-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 15px;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 6px;
        }

        .empty-sub {
            font-size: 12.5px;
            color: var(--text-muted);
        }

        /* ══ PAGE WRAP ══ */
        .page-wrap {
            max-width: var(--max-content);
            margin: 0 auto;
            position: relative;
        }

        /* ══ RESPONSIVE ══ */
        @media (min-width: 860px) {
            :root {
                --max-content: 1100px;
            }

            #parkingMap {
                height: 480px;
            }

            .loc-list {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 16px;
            }

            .loc-img-wrap {
                height: 180px;
            }

            .map-wrapper::after {
                display: none;
            }

            .content-panel {
                margin-top: 0;
                border-radius: 0;
            }

            .search-section {
                padding: 28px 24px 0;
            }

            .filter-row {
                padding: 14px 24px 0;
            }

            .results-header {
                padding: 24px 24px 12px;
            }

            .loc-list {
                padding: 0 24px;
            }
        }
    </style>
@endsection


@section('content')
    <!-- ════════════ MAP ════════════ -->
    <div class="page-wrap">
        <div class="map-wrapper">
            <div id="parkingMap"></div>
            <div class="map-controls">
                <div class="map-ctrl-btn" onclick="mapObj.zoomIn()" title="Zoom in">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.5">
                        <line x1="12" y1="5" x2="12" y2="19" />
                        <line x1="5" y1="12" x2="19" y2="12" />
                    </svg>
                </div>
                <div class="map-ctrl-btn" onclick="mapObj.zoomOut()" title="Zoom out">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.5">
                        <line x1="5" y1="12" x2="19" y2="12" />
                    </svg>
                </div>
                <div class="map-ctrl-btn" onclick="centerMap()" title="Lokasi saya">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.5">
                        <circle cx="12" cy="12" r="3" />
                        <path d="M12 1v4M12 19v4M1 12h4M19 12h4" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- ════════════ CONTENT PANEL ════════════ -->
        <div class="content-panel">

            {{-- Search — submit ke route yang sama dengan query param --}}
            <div class="search-section">
                <form action="{{ route('user.lokasi') }}" method="GET" id="searchForm">
                    <input type="hidden" name="filter" id="filterInput" value="{{ request('filter', 'all') }}">
                    <div class="search-bar">
                        <svg class="search-icon" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="8" />
                            <line x1="21" y1="21" x2="16.65" y2="16.65" />
                        </svg>
                        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari lokasi parkir..."
                            id="searchInput" autocomplete="off" />
                        <button type="button" class="search-loc-btn" title="Lokasi saya" onclick="centerMap()">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2.5">
                                <circle cx="12" cy="12" r="3" />
                                <path d="M12 1v4M12 19v4M1 12h4M19 12h4" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>

            {{-- Filter Pills — link ke route dengan query param --}}
            <div class="filter-row">
                @php
                    $pills = [
                        'all' => [
                            'icon' =>
                                '<line x1="4" y1="6" x2="20" y2="6"/><line x1="8" y1="12" x2="16" y2="12"/><line x1="11" y1="18" x2="13" y2="18"/>',
                            'label' => 'Semua',
                        ],
                        'avail' => ['icon' => '<polyline points="20 6 9 17 4 12"/>', 'label' => 'Tersedia'],
                        'nearest' => [
                            'icon' =>
                                '<path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/>',
                            'label' => 'Terdekat',
                        ],
                        'popular' => [
                            'icon' =>
                                '<polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>',
                            'label' => 'Populer',
                        ],
                        'cheapest' => [
                            'icon' =>
                                '<line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/>',
                            'label' => 'Termurah',
                        ],
                    ];
                    $currentFilter = request('filter', 'all');
                    $currentQ = request('q', '');
                @endphp

                @foreach ($pills as $key => $pill)
                    <a href="{{ route('user.lokasi', array_filter(['filter' => $key, 'q' => $currentQ])) }}"
                        class="pill {{ $currentFilter === $key ? 'active' : '' }}">
                        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.5">{!! $pill['icon'] !!}</svg>
                        {{ $pill['label'] }}
                    </a>
                @endforeach
            </div>

            {{-- Results Header --}}
            <div class="results-header">
                <span class="results-title">
                    @if ($currentQ)
                        Hasil "{{ $currentQ }}"
                    @else
                        Lokasi Parkir
                    @endif
                </span>
                <span class="results-count">{{ $lokasis->count() }} lokasi</span>
            </div>

            {{-- Location Cards --}}
            <div class="loc-list">
                @forelse($lokasis as $lokasi)
                    @php
                        $status = $lokasi->status_slot; // avail | busy | full
                        $statusMap = ['avail' => 'Tersedia', 'busy' => 'Hampir Penuh', 'full' => 'Penuh'];
                        $slotText = $status === 'full' ? 'Penuh' : $lokasi->slot_tersedia . ' Slot Free';
                        $slotClass = $status === 'avail' ? 'has-slot' : ($status === 'busy' ? 'few-slot' : 'no-slot');
                        $harga = 'Rp ' . number_format($lokasi->harga_per_jam, 0, ',', '.') . '/jam';
                    @endphp

                    <a class="loc-card" href="{{ route('user.lokasi.show', $lokasi->id) }}">

                        {{-- Image --}}
                        <div class="loc-img-wrap">
                            @if ($lokasi->foto)
                                <img src="{{ asset('storage/' . $lokasi->foto) }}" alt="{{ $lokasi->nama }}"
                                    loading="lazy">
                            @else
                                <div class="loc-img-placeholder">🏬</div>
                            @endif

                            {{-- Status Badge --}}
                            <div class="img-badge {{ $status }}">
                                <span
                                    style="width:6px;height:6px;border-radius:50%;background:currentColor;display:inline-block"></span>
                                {{ $statusMap[$status] }}
                            </div>

                            {{-- Jam operasional --}}
                            @if ($lokasi->jam_buka && $lokasi->jam_tutup)
                                <div class="img-dist">
                                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2.5">
                                        <circle cx="12" cy="12" r="10" />
                                        <polyline points="12 6 12 12 16 14" />
                                    </svg>
                                    {{ \Carbon\Carbon::parse($lokasi->jam_buka)->format('H:i') }} -
                                    {{ \Carbon\Carbon::parse($lokasi->jam_tutup)->format('H:i') }}
                                </div>
                            @endif
                        </div>

                        <div class="loc-body">
                            <div class="loc-name">{{ $lokasi->nama }}</div>
                            <div class="loc-addr">
                                <svg width="11" height="11" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                                    <circle cx="12" cy="10" r="3" />
                                </svg>
                                {{ $lokasi->alamat }}
                            </div>

                            {{-- Tags: total slot & kode unik --}}
                            <div class="loc-tags">
                                <span class="loc-tag">{{ $lokasi->total_slot_aktif }} slot total</span>
                                @if ($lokasi->kode_unik)
                                    <span class="loc-tag"># {{ $lokasi->kode_unik }}</span>
                                @endif
                            </div>

                            <div class="loc-footer">
                                <div class="loc-price-wrap">
                                    <div class="price-tag">
                                        <svg width="11" height="11" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2.5">
                                            <line x1="12" y1="1" x2="12" y2="23" />
                                            <path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6" />
                                        </svg>
                                        {{ $harga }}
                                    </div>
                                    <div class="slot-tag {{ $slotClass }}">
                                        <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2.5">
                                            <rect x="1" y="3" width="15" height="13" rx="2" />
                                            <circle cx="5.5" cy="18.5" r="2.5" />
                                        </svg>
                                        {{ $slotText }}
                                    </div>
                                </div>
                                {{-- Rating placeholder (tambahkan kolom rating di model jika ada) --}}
                                {{-- <div class="loc-rating">★ {{ $lokasi->rating ?? '—' }}</div> --}}
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="empty-state">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.5">
                            <circle cx="11" cy="11" r="8" />
                            <line x1="21" y1="21" x2="16.65" y2="16.65" />
                        </svg>
                        <div class="empty-title">Lokasi tidak ditemukan</div>
                        <div class="empty-sub">
                            @if ($currentQ)
                                Tidak ada hasil untuk "{{ $currentQ }}", coba kata kunci lain.
                            @else
                                Belum ada lokasi parkir yang tersedia.
                            @endif
                        </div>
                    </div>
                @endforelse
            </div>

            <div style="height:12px"></div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Data dari PHP → JS (hanya untuk markers peta)
        const mapLokasi = @json($allLokasi);

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
        const statusBadge = {
            avail: 'popup-avail',
            busy: 'popup-busy',
            full: 'popup-full'
        };

        let mapObj;

        function initMap() {
            // Tentukan center dari rata-rata koordinat lokasi, fallback Bogor
            let centerLat = -6.605,
                centerLng = 106.803;
            if (mapLokasi.length) {
                centerLat = mapLokasi.reduce((s, l) => s + l.lat, 0) / mapLokasi.length;
                centerLng = mapLokasi.reduce((s, l) => s + l.lng, 0) / mapLokasi.length;
            }

            mapObj = L.map('parkingMap', {
                center: [centerLat, centerLng],
                zoom: 14,
                zoomControl: false,
                scrollWheelZoom: true,
            });

            L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
                attribution: '© OpenStreetMap © CARTO',
                subdomains: 'abcd',
                maxZoom: 20,
            }).addTo(mapObj);

            mapLokasi.forEach(loc => {
                const color = statusColor[loc.status];
                const icon = L.divIcon({
                    className: '',
                    html: `<div style="
        width:38px;height:38px;border-radius:50% 50% 50% 0;
        background:${color};transform:rotate(-45deg);
        border:3px solid #fff;box-shadow:0 3px 12px rgba(0,0,0,0.28);
        display:flex;align-items:center;justify-content:center;">
        <svg style="transform:rotate(45deg)" width="16" height="16" viewBox="0 0 24 24"
          fill="none" stroke="white" stroke-width="2.5">
          <rect x="1" y="3" width="15" height="13" rx="2"/>
          <circle cx="5.5" cy="18.5" r="2.5"/>
        </svg>
      </div>`,
                    iconSize: [38, 38],
                    iconAnchor: [19, 38],
                    popupAnchor: [0, -40],
                });

                const fotoHtml = loc.foto ?
                    `<img src="${loc.foto}" alt="${loc.nama}" style="width:100%;height:80px;object-fit:cover;display:block;margin-bottom:0">` :
                    '';

                const slotInfo = loc.status !== 'full' ?
                    `<div style="font-size:11px;color:#64748b;margin-top:4px">${loc.slots} slot tersedia</div>` :
                    '';

                L.marker([loc.lat, loc.lng], {
                    icon
                }).addTo(mapObj).bindPopup(`
      <div>
        ${fotoHtml}
        <div class="custom-popup">
          <div class="popup-name">${loc.nama}</div>
          <div class="popup-addr">${loc.alamat}</div>
          <div class="popup-meta">
            <span class="popup-badge ${statusBadge[loc.status]}">● ${statusLabel[loc.status]}</span>
            <span class="popup-price">${loc.harga}</span>
          </div>
          ${slotInfo}
          <a class="popup-btn" href="/user/lokasi/${loc.id}">Lihat Detail →</a>
        </div>
      </div>
    `, {
                    maxWidth: 220
                });
            });

            // Geolocation user
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(pos => {
                    const {
                        latitude: lat,
                        longitude: lng
                    } = pos.coords;
                    L.circleMarker([lat, lng], {
                        radius: 8,
                        color: '#2563eb',
                        fillColor: '#2563eb',
                        fillOpacity: 0.9,
                        weight: 3,
                    }).addTo(mapObj).bindPopup('<b style="font-family:Space Grotesk">Lokasi Anda</b>');
                    mapObj.setView([lat, lng], 15);
                }, () => {});
            }
        }

        function centerMap() {
            if (!navigator.geolocation) return;
            navigator.geolocation.getCurrentPosition(pos => {
                mapObj.setView([pos.coords.latitude, pos.coords.longitude], 15);
            });
        }

        // Debounce search — submit form otomatis setelah berhenti mengetik
        let searchTimer;
        document.getElementById('searchInput').addEventListener('input', function() {
            clearTimeout(searchTimer);
            searchTimer = setTimeout(() => {
                document.getElementById('searchForm').submit();
            }, 500);
        });

        document.addEventListener('DOMContentLoaded', () => {
            setTimeout(initMap, 100);
        });
    </script>
@endsection
