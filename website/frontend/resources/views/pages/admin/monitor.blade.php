@extends('layouts.admin')

@section('styles')
    <style>
        /* ══════════════════════════════════════════
       PARKIFY — MONITOR PAGE CSS
       Hanya dipakai di halaman monitor
    ══════════════════════════════════════════ */

        /* ── LAYOUT GRID ───────────────────────────────── */
        .m-stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
            margin-bottom: 18px;
        }

        .monitor-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 14px;
        }

        /* ── STAT MINI CARDS ───────────────────────────── */
        .m-stat {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 16px 18px;
            transition: background 0.25s, border-color 0.25s;
        }

        .m-val {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 24px;
            font-weight: 800;
            line-height: 1;
            margin-bottom: 4px;
            transition: color 0.3s;
        }

        .m-lbl {
            font-size: 11.5px;
            color: var(--text-muted);
        }

        /* ── PROGRESS BAR ──────────────────────────────── */
        .prog-bar {
            height: 5px;
            background: var(--bg-input);
            border-radius: 999px;
            overflow: hidden;
            margin-top: 8px;
        }

        .prog-fill {
            height: 100%;
            border-radius: 999px;
            transition: width 0.6s ease;
        }

        /* ── LOKASI SELECTOR ───────────────────────────── */
        .lokasi-select {
            background: var(--bg-input);
            border: 1px solid var(--border);
            border-radius: 9px;
            padding: 7px 12px;
            font-size: 12.5px;
            font-family: 'Poppins', sans-serif;
            color: var(--text-primary);
            cursor: pointer;
            outline: none;
            transition: border-color 0.16s;
        }

        .lokasi-select:focus {
            border-color: var(--border-focus);
        }

        /* ── FLOOR TABS ────────────────────────────────── */
        .floor-tabs {
            display: flex;
            gap: 3px;
            flex-wrap: wrap;
            background: var(--bg-base);
            border-radius: 10px;
            padding: 4px;
            margin-bottom: 14px;
            width: fit-content;
            max-width: 100%;
            border: 1px solid var(--border);
        }

        .floor-tab {
            padding: 5px 12px;
            border-radius: 7px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            color: var(--text-muted);
            transition: all 0.16s;
            text-decoration: none;
            display: inline-block;
        }

        .floor-tab.active {
            background: var(--bg-card);
            color: var(--text-primary);
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border);
        }

        /* ── PARKING MAP (slot grid) ───────────────────── */
        .parking-map {
            display: grid;
            gap: 5px;
            padding: 14px;
            background: var(--bg-base);
            border-radius: 12px;
            border: 1px solid var(--border);
            overflow-x: auto;
            grid-template-columns: repeat(auto-fill, minmax(42px, 1fr));
        }

        /* ── SLOT CELLS ────────────────────────────────── */
        .pm-slot {
            aspect-ratio: 1.7;
            border-radius: 5px;
            border: 1.5px solid;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 7.5px;
            font-weight: 700;
            cursor: pointer;
            transition: transform 0.12s, opacity 0.2s;
            font-family: 'Space Grotesk', sans-serif;
            min-width: 0;
        }

        .pm-slot:hover:not(.pm-di) {
            transform: scale(1.1);
        }

        /* Slot status variants */
        .pm-av {
            background: var(--green-soft);
            border-color: rgba(16, 185, 129, .4);
            color: var(--green);
        }

        .pm-oc {
            background: var(--blue-soft);
            border-color: rgba(59, 130, 246, .4);
            color: var(--blue-main);
        }

        .pm-rs {
            background: var(--amber-soft);
            border-color: rgba(245, 158, 11, .4);
            color: var(--amber);
        }

        .pm-di {
            background: var(--bg-input);
            border-color: var(--border);
            color: var(--text-muted);
            opacity: .35;
            cursor: default;
        }

        .pm-er {
            background: var(--red-soft);
            border-color: rgba(239, 68, 68, .4);
            color: var(--red);
        }

        /* ── SLOT TOOLTIP ──────────────────────────────── */
        .slot-tooltip {
            position: fixed;
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 9px;
            padding: 9px 13px;
            font-size: 12px;
            color: var(--text-primary);
            box-shadow: var(--shadow-md);
            pointer-events: none;
            z-index: 999;
            display: none;
            min-width: 130px;
        }

        .slot-tooltip.show {
            display: block;
        }

        /* ── EVENT LOG ─────────────────────────────────── */
        .log-row {
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 8px 0;
            border-bottom: 1px solid var(--border);
            min-width: 0;
        }

        .log-row:last-child {
            border-bottom: none;
        }

        .log-time {
            font-size: 10.5px;
            color: var(--text-muted);
            width: 42px;
            flex-shrink: 0;
        }

        .log-plate {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 11.5px;
            font-weight: 700;
            color: var(--text-primary);
            width: 72px;
            flex-shrink: 0;
        }

        .log-desc {
            font-size: 12px;
            color: var(--text-secondary);
            flex: 1;
            min-width: 0;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        /* ── EMPTY STATE ───────────────────────────────── */
        .empty-state {
            text-align: center;
            padding: 32px 20px;
            color: var(--text-muted);
            font-size: 12.5px;
        }

        /* ── REFRESH INDICATOR ─────────────────────────── */
        .refresh-indicator {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 11px;
            color: var(--text-muted);
        }

        .refresh-spin {
            display: none;
        }

        .refresh-spin.active {
            display: inline-block;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        /* ── RESPONSIVE (monitor-specific) ────────────── */
        @media (max-width: 1180px) {
            .m-stats {
                grid-template-columns: repeat(2, 1fr);
            }

            .monitor-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 860px) {
            .parking-map {
                grid-template-columns: repeat(auto-fill, minmax(36px, 1fr));
            }
        }

        @media (max-width: 640px) {
            .m-stats {
                grid-template-columns: 1fr 1fr;
            }
        }
    </style>
@endsection

@section('content')


  <div class="content">
    <div class="page-header">
      <div>
        <div class="page-title">Monitor Parkir</div>
        <div class="page-sub">Pantau kondisi parkir secara real-time</div>
      </div>
      <div style="display:flex;align-items:center;gap:10px;flex-wrap:wrap">
        {{-- Selector lokasi --}}
        <select class="lokasi-select" id="lokasiSelect" onchange="switchLokasi(this.value)">
          @foreach($lokasiList as $lok)
            <option value="{{ $lok->id }}" {{ $lok->id == $selectedLokasiId ? 'selected' : '' }}>
              {{ $lok->nama }}
            </option>
          @endforeach
        </select>
        <div class="live-pill">
          <div class="live-dot"></div>
          <span id="lastUpdated">Diperbarui setiap 5 detik</span>
          <svg class="refresh-spin" id="refreshSpin" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M23 4v6h-6"/><path d="M1 20v-6h6"/><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"/></svg>
        </div>
      </div>
    </div>

    {{-- ── STAT CARDS ── --}}
    <div class="m-stats">
      <div class="m-stat">
        <div class="m-val" id="statHunian" style="color:var(--blue-main)">{{ $hunian }}%</div>
        <div class="m-lbl">Tingkat Hunian</div>
        <div class="prog-bar">
          <div class="prog-fill" id="progHunian" style="width:{{ $hunian }}%;background:var(--blue-main)"></div>
        </div>
      </div>
      <div class="m-stat">
        <div class="m-val" id="statTersedia" style="color:var(--green)">{{ number_format($totalTersedia) }}</div>
        <div class="m-lbl">Slot Tersedia</div>
      </div>
      <div class="m-stat">
        <div class="m-val" id="statDipesan" style="color:var(--amber)">{{ number_format($totalDipesan) }}</div>
        <div class="m-lbl">Dipesan</div>
      </div>
      <div class="m-stat">
        <div class="m-val" style="color:var(--red)">{{ $sensorError }}</div>
        <div class="m-lbl">Sensor Error</div>
      </div>
    </div>

    {{-- ── MONITOR GRID ── --}}
    <div class="monitor-grid">

      {{-- Peta Slot --}}
      <div class="card">
        <div class="card-header">
          <span class="card-title" id="mapTitle">
            Peta Slot — {{ $selectedLokasi?->nama ?? '-' }}
          </span>
          <div style="display:flex;gap:8px;align-items:center;flex-wrap:wrap">
            <span class="badge b-green">● Tersedia</span>
            <span class="badge b-blue">● Terisi</span>
            <span class="badge b-amber">● Dipesan</span>
            <span class="badge b-red">● Error</span>
          </div>
        </div>

        {{-- Floor tabs --}}
        @if($lantaiList->isNotEmpty())
        <div class="floor-tabs" id="floorTabs">
          @foreach($lantaiList as $lantai)
            <a class="floor-tab {{ $lantai == $selectedLantai ? 'active' : '' }}"
               href="{{ route('admin.monitor', ['lokasi_id' => $selectedLokasiId, 'lantai' => $lantai]) }}"
               data-lantai="{{ $lantai }}">
              Lantai {{ $lantai }}
            </a>
          @endforeach
        </div>
        @endif

        {{-- Slot grid --}}
        <div class="parking-map" id="parkingMap">
          @forelse($slots as $slot)
            @php
              $cls = match($slot->status) {
                'tersedia' => 'pm-av',
                'terisi'   => 'pm-oc',
                'dipesan'  => 'pm-rs',
                'nonaktif' => 'pm-di',
                default    => 'pm-er',
              };
              $statusLabel = match($slot->status) {
                'tersedia' => 'Tersedia',
                'terisi'   => 'Terisi',
                'dipesan'  => 'Dipesan',
                'nonaktif' => 'Nonaktif',
                default    => 'Error',
              };
            @endphp
            <div class="pm-slot {{ $cls }}"
                 data-slot="{{ $slot->kode_slot }}"
                 data-status="{{ $slot->status }}"
                 data-jenis="{{ $slot->jenis_slot }}"
                 data-id="{{ $slot->id }}"
                 onmouseenter="showTooltip(event, this)"
                 onmouseleave="hideTooltip()"
                 onclick="onSlotClick(this)">
              {{ $slot->kode_slot }}
            </div>
          @empty
            <div class="empty-state" style="grid-column:1/-1">
              Tidak ada slot tersedia untuk lantai ini.
            </div>
          @endforelse
        </div>

        <div style="margin-top:11px;display:flex;justify-content:space-between;font-size:11.5px;color:var(--text-muted);flex-wrap:wrap;gap:4px">
          <span>{{ $slots->count() }} slot ditemukan</span>
          <span>Hover slot untuk detail</span>
        </div>
      </div>

      {{-- Log Kejadian --}}
      <div class="card">
        <div class="card-header">
          <span class="card-title">Log Kejadian</span>
          <div class="refresh-indicator">
            <svg id="logRefreshSpin" class="refresh-spin" width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M23 4v6h-6"/><path d="M1 20v-6h6"/><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"/></svg>
            Live
          </div>
        </div>
        <div id="eventLog">
          @forelse($logs as $log)
            @php
              $typeColor = match($log['type']) {
                'in'   => ['bg' => 'var(--blue-soft)',   'fg' => 'var(--blue-main)'],
                'out'  => ['bg' => 'var(--green-soft)',  'fg' => 'var(--green)'],
                'warn' => ['bg' => 'var(--amber-soft)',  'fg' => 'var(--amber)'],
                'pay'  => ['bg' => 'var(--green-soft)',  'fg' => 'var(--green)'],
                default=> ['bg' => 'var(--bg-input)',    'fg' => 'var(--text-muted)'],
              };
              $icons = [
                'in'   => '<path d="M5 12h14"/><polyline points="12 5 19 12 12 19"/>',
                'out'  => '<path d="M19 12H5"/><polyline points="12 19 5 12 12 5"/>',
                'warn' => '<path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>',
                'pay'  => '<polyline points="20 6 9 17 4 12"/>',
              ];
            @endphp
            <div class="log-row">
              <div class="log-time">{{ $log['time'] }}</div>
              <div style="width:22px;height:22px;border-radius:6px;background:{{ $typeColor['bg'] }};display:flex;align-items:center;justify-content:center;color:{{ $typeColor['fg'] }};flex-shrink:0">
                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                  {!! $icons[$log['type']] ?? $icons['in'] !!}
                </svg>
              </div>
              <div class="log-plate">{{ $log['plate'] }}</div>
              <div class="log-desc">{{ $log['desc'] }}</div>
            </div>
          @empty
            <div class="empty-state">Belum ada aktivitas di lokasi ini.</div>
          @endforelse
        </div>
      </div>

    </div>
  </div>

@endsection

@section('scripts')
    <script>
        const MONITOR_CONFIG = {
            lokasiId: {{ $selectedLokasiId ?? 'null' }},
            lantai: '{{ $selectedLantai }}',
            slotDataUrl: '{{ route('api.monitor.slots') }}',
            csrf: '{{ csrf_token() }}',
        };
    </script>
    <script>
        // ══════════════════════════════════════════
        // PARKIFY — MONITOR PAGE JS
        // Hanya dipakai di halaman monitor
        // Depends on: MONITOR_CONFIG (injected by Blade)
        // Depends on: global JS (toggleTheme, toggleSidebar, closeSidebar)
        // ══════════════════════════════════════════

        // ── SWITCH LOKASI ────────────────────────────────
        function switchLokasi(lokasiId) {
            window.location.href = `${window.location.pathname}?lokasi_id=${lokasiId}`;
        }

        // ── SLOT TOOLTIP ─────────────────────────────────
        const tooltip = document.getElementById('slotTooltip');

        const statusText = {
            tersedia: '✓ Tersedia',
            terisi: '● Terisi',
            dipesan: '⏱ Dipesan',
            nonaktif: '✕ Nonaktif',
        };

        function showTooltip(e, el) {
            tooltip.innerHTML = `
    <div style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:13px;margin-bottom:4px">
      ${el.dataset.slot}
    </div>
    <div style="font-size:11px;color:var(--text-secondary)">
      Status: <b>${statusText[el.dataset.status] ?? el.dataset.status}</b>
    </div>
    <div style="font-size:11px;color:var(--text-muted);margin-top:2px">
      Jenis: ${el.dataset.jenis}
    </div>
  `;
            tooltip.style.left = (e.clientX + 12) + 'px';
            tooltip.style.top = (e.clientY - 10) + 'px';
            tooltip.classList.add('show');
        }

        function hideTooltip() {
            tooltip.classList.remove('show');
        }

        function onSlotClick(el) {
            if (el.classList.contains('pm-di')) return;
            // Arahkan ke detail slot jika diperlukan:
            // window.location.href = `/admin/slot/${el.dataset.id}`;
        }

        // ── LIVE POLLING ─────────────────────────────────
        const statusClass = {
            tersedia: 'pm-av',
            terisi: 'pm-oc',
            dipesan: 'pm-rs',
            nonaktif: 'pm-di',
        };

        async function pollSlots() {
            if (!MONITOR_CONFIG.lokasiId) return;

            const spin = document.getElementById('refreshSpin');
            const logSpin = document.getElementById('logRefreshSpin');
            spin?.classList.add('active');
            logSpin?.classList.add('active');

            try {
                const url =
                    `${MONITOR_CONFIG.slotDataUrl}?lokasi_id=${MONITOR_CONFIG.lokasiId}&lantai=${encodeURIComponent(MONITOR_CONFIG.lantai)}`;
                const res = await fetch(url, {
                    headers: {
                        'X-CSRF-TOKEN': MONITOR_CONFIG.csrf,
                        'Accept': 'application/json'
                    }
                });
                if (!res.ok) return;

                const data = await res.json();

                // ── Update stat cards
                
                // ── Update stat cards
                const hunian = data.hunian ?? 0;

                const elHunian    = document.getElementById('statHunian');
                const elProg      = document.getElementById('progHunian');
                const elTersedia  = document.getElementById('statTersedia');
                const elDipesan   = document.getElementById('statDipesan');

                if (elHunian)   elHunian.textContent      = hunian + '%';
                if (elProg)     elProg.style.width        = hunian + '%';
                if (elTersedia) elTersedia.textContent    = data.tersedia ?? 0;
                if (elDipesan)  elDipesan.textContent     = data.dipesan  ?? 0;

                // ── Update slot map
                const map = document.getElementById('parkingMap');
                if (map && data.slots) {
                    data.slots.forEach(s => {
                        const el = map.querySelector(`[data-id="${s.id}"]`);
                        if (!el) return;
                        el.classList.remove('pm-av', 'pm-oc', 'pm-rs', 'pm-di', 'pm-er');
                        el.classList.add(statusClass[s.status] ?? 'pm-er');
                        el.dataset.status = s.status;
                    });
                }

                // ── Update timestamp
                const now = new Date();
                const hh = String(now.getHours()).padStart(2, '0');
                const mm = String(now.getMinutes()).padStart(2, '0');
                const ss = String(now.getSeconds()).padStart(2, '0');
                
                const lu = document.getElementById('lastUpdated');
                if (lu) lu.textContent = `${hh}:${mm}:${ss}`;

            } catch (err) {
                console.warn('[Monitor] Poll error:', err);
            } finally {
                spin?.classList.remove('active');
                logSpin?.classList.remove('active');
            }
        }

        // Mulai polling setiap 5 detik
        setInterval(pollSlots, 5000);
    </script>
@endsection
