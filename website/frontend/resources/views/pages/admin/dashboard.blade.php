@extends('layouts.admin')

@section('styles')
    <style>
        /* ══════════════════════════════════════════
           PARKIFY — DASHBOARD PAGE CSS
           Hanya dipakai di halaman dashboard
        ══════════════════════════════════════════ */

        /* ── LAYOUT GRID ───────────────────────────────── */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
            margin-bottom: 22px;
        }

        .grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
            margin-bottom: 22px;
        }

        .grid-3-1 {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 14px;
            margin-bottom: 22px;
        }

        /* ── STAT CARDS ────────────────────────────────── */
        .stat-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 16px 18px;
            transition: border-color 0.2s, background 0.25s;
            cursor: default;
        }

        .stat-card:hover {
            border-color: var(--border-focus);
        }

        .stat-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .stat-icon {
            width: 36px;
            height: 36px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .si-blue {
            background: var(--blue-soft);
            color: var(--blue-main);
        }

        .si-green {
            background: var(--green-soft);
            color: var(--green);
        }

        .si-amber {
            background: var(--amber-soft);
            color: var(--amber);
        }

        .si-purple {
            background: var(--purple-soft);
            color: var(--purple);
        }

        .stat-trend {
            font-size: 11px;
            font-weight: 600;
            padding: 3px 7px;
            border-radius: 6px;
        }

        .t-up {
            background: var(--green-soft);
            color: var(--green);
        }

        .t-down {
            background: var(--red-soft);
            color: var(--red);
        }

        .t-warn {
            background: var(--amber-soft);
            color: var(--amber);
        }

        .stat-label {
            font-size: 11.5px;
            color: var(--text-muted);
            font-weight: 500;
            margin-bottom: 4px;
        }

        .stat-value {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 26px;
            font-weight: 800;
            color: var(--text-primary);
            line-height: 1;
        }

        .stat-footer {
            font-size: 11px;
            color: var(--text-muted);
            margin-top: 5px;
        }

        /* ── CHART ─────────────────────────────────────── */
        .chart-wrap {
            position: relative;
            height: 215px;
            width: 100%;
        }

        /* ── DONUT LEGEND ──────────────────────────────── */
        .donut-legend {
            display: flex;
            flex-direction: column;
            gap: 9px;
            margin-top: 4px;
        }

        .dl-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .dl-label {
            display: flex;
            align-items: center;
            gap: 7px;
            font-size: 12px;
            color: var(--text-secondary);
        }

        .dl-dot {
            width: 9px;
            height: 9px;
            border-radius: 3px;
        }

        .dl-val {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 13px;
            font-weight: 700;
        }

        /* ── ACTIVITY FEED ─────────────────────────────── */
        .activity-item {
            display: flex;
            align-items: flex-start;
            gap: 11px;
            padding: 10px 0;
            border-bottom: 1px solid var(--border);
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .act-icon {
            width: 30px;
            height: 30px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            margin-top: 1px;
        }

        .act-main {
            font-size: 12.5px;
            color: var(--text-primary);
            font-weight: 500;
            line-height: 1.4;
        }

        .act-sub {
            font-size: 11px;
            color: var(--text-muted);
            margin-top: 1px;
        }

        /* ── RESPONSIVE (dashboard-specific) ──────────── */
        @media (max-width: 1180px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .grid-3-1 {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 860px) {
            .grid-2 {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 640px) {
            .stats-grid {
                grid-template-columns: 1fr 1fr;
                gap: 10px;
            }

            .stat-value {
                font-size: 22px;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }
        }

        @media (max-width: 400px) {
            .stats-grid {
                grid-template-columns: 1fr 1fr;
                gap: 8px;
            }

            .stat-value {
                font-size: 20px;
            }

            .stat-card {
                padding: 12px 14px;
            }
        }
    </style>
@endsection

@section('content')
    <div class="content">
        <div class="page-header">
            <div>
                <div class="page-title">Selamat Datang, {{ explode(' ', auth()->user()->name ?? 'Admin')[0] }} 👋</div>
                <div class="page-sub">{{ $now->locale('id')->isoFormat('dddd, D MMMM YYYY') }} — Data diperbarui real-time
                </div>
            </div>
            <div class="live-pill">
                <div class="live-dot"></div>Live Update
            </div>
        </div>

        {{-- ── STAT CARDS ─────────────────────────────────────────── --}}
        <div class="stats-grid">

            {{-- Total Slot --}}
            <div class="stat-card">
                <div class="stat-top">
                    <div class="stat-icon si-blue">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <rect x="1" y="3" width="15" height="13" rx="2" />
                            <path d="M16 8h4a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2h-4" />
                            <circle cx="5.5" cy="18.5" r="2.5" />
                            <circle cx="18.5" cy="18.5" r="2.5" />
                        </svg>
                    </div>
                    <span class="stat-trend t-up">{{ $totalLokasi }} lokasi</span>
                </div>
                <div class="stat-label">Total Slot Parkir</div>
                <div class="stat-value">{{ number_format($totalSlot) }}</div>
                <div class="stat-footer">Di {{ $totalLokasi }} lokasi aktif</div>
            </div>

            {{-- Slot Terisi --}}
            <div class="stat-card">
                <div class="stat-top">
                    <div class="stat-icon si-green">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <polyline points="22 12 18 12 15 21 9 3 6 12 2 12" />
                        </svg>
                    </div>
                    <span
                        class="stat-trend {{ $persenTerisi >= 90 ? 't-down' : ($persenTerisi >= 70 ? 't-warn' : 't-up') }}">
                        {{ $persenTerisi }}%
                    </span>
                </div>
                <div class="stat-label">Slot Terisi Aktif</div>
                <div class="stat-value">{{ number_format($slotTerisi) }}</div>
                <div class="stat-footer">{{ $persenTerisi }}% dari kapasitas</div>
            </div>

            {{-- Lokasi Aktif --}}
            <div class="stat-card">
                <div class="stat-top">
                    <div class="stat-icon si-amber">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z" />
                            <circle cx="12" cy="9" r="2.5" />
                        </svg>
                    </div>
                    @if ($lokasiAlert > 0)
                        <span class="stat-trend t-warn">{{ $lokasiAlert }} alert</span>
                    @else
                        <span class="stat-trend t-up">✓ Normal</span>
                    @endif
                </div>
                <div class="stat-label">Lokasi Aktif</div>
                <div class="stat-value">{{ $totalLokasi }}</div>
                <div class="stat-footer">
                    @if ($lokasiAlert > 0)
                        {{ $lokasiAlert }} perlu perhatian
                    @else
                        Semua lokasi normal
                    @endif
                </div>
            </div>

            {{-- Pendapatan Hari Ini --}}
            <div class="stat-card">
                <div class="stat-top">
                    <div class="stat-icon si-purple">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <line x1="12" y1="1" x2="12" y2="23" />
                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6" />
                        </svg>
                    </div>
                    <span class="stat-trend {{ $trendPendapatan >= 0 ? 't-up' : 't-down' }}">
                        {{ $trendPendapatan >= 0 ? '↑' : '↓' }} {{ abs($trendPendapatan) }}%
                    </span>
                </div>
                <div class="stat-label">Pendapatan Hari Ini</div>
                <div class="stat-value">
                    @php
                        $nom = $pendapatanHariIni;
                        if ($nom >= 1000000) {
                            echo round($nom / 1000000, 1) . 'jt';
                        } elseif ($nom >= 1000) {
                            echo round($nom / 1000) . 'rb';
                        } else {
                            echo number_format($nom);
                        }
                    @endphp
                </div>
                <div class="stat-footer">
                    vs kemarin Rp {{ number_format($pendapatanKemarin, 0, ',', '.') }}
                </div>
            </div>

        </div>

        {{-- ── CHARTS ──────────────────────────────────────────────── --}}
        <div class="grid-3-1">
            <div class="card">
                <div class="card-header">
                    <span class="card-title">Tren Penggunaan Parkir</span>
                    <span class="card-action">7 Hari Terakhir</span>
                </div>
                <div class="chart-wrap"><canvas id="usageChart"></canvas></div>
            </div>
            <div class="card">
                <div class="card-header"><span class="card-title">Distribusi Slot</span></div>
                <div style="position:relative;height:175px;margin-bottom:14px"><canvas id="donutChart"></canvas></div>
                <div class="donut-legend">
                    <div class="dl-item">
                        <div class="dl-label"><span class="dl-dot" style="background:var(--blue-main)"></span>Terisi</div>
                        <span class="dl-val" style="color:var(--blue-main)">{{ $distribusiSlot['terisi'] }}%</span>
                    </div>
                    <div class="dl-item">
                        <div class="dl-label"><span class="dl-dot" style="background:var(--green)"></span>Tersedia</div>
                        <span class="dl-val" style="color:var(--green)">{{ $distribusiSlot['tersedia'] }}%</span>
                    </div>
                    <div class="dl-item">
                        <div class="dl-label"><span class="dl-dot" style="background:var(--amber)"></span>Dipesan</div>
                        <span class="dl-val" style="color:var(--amber)">{{ $distribusiSlot['dipesan'] }}%</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- ── TRANSAKSI + AKTIVITAS ───────────────────────────────── --}}
        <div class="grid-2">

            {{-- Transaksi Terbaru --}}
            <div class="card">
                <div class="card-header">
                    <span class="card-title">Transaksi Terbaru</span>
                    <a href="{{ route('admin.pemesanan.index') }}" class="card-action">Lihat Semua →</a>
                </div>
                <div class="table-wrap">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Kendaraan</th>
                                <th>Lokasi</th>
                                <th>Durasi</th>
                                <th>Status</th>
                                <th>Biaya</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transaksiTerbaru as $t)
                                @php
                                    $mulai = \Carbon\Carbon::parse($t->waktu_mulai);
                                    $selesai = $t->waktu_selesai ? \Carbon\Carbon::parse($t->waktu_selesai) : now();
                                    $diff = $mulai->diff($selesai);
                                    $durasi = ($diff->h > 0 ? $diff->h . 'j ' : '') . $diff->i . 'm';

                                    $badgeMap = [
                                        'aktif' => 'b-green',
                                        'running' => 'b-green',
                                        'menunggu' => 'b-blue',
                                        'dipesan' => 'b-amber',
                                        'selesai' => 'b-gray',
                                        'dibatalkan' => 'b-red',
                                    ];
                                    $labelMap = [
                                        'aktif' => '● Aktif',
                                        'running' => '● Berjalan',
                                        'menunggu' => '● Menunggu',
                                        'dipesan' => '● Reservasi',
                                        'selesai' => '● Selesai',
                                        'dibatalkan' => '● Batal',
                                    ];
                                    $badgeClass = $badgeMap[$t->status] ?? 'b-gray';
                                    $badgeLabel = $labelMap[$t->status] ?? ucfirst($t->status);
                                @endphp
                                <tr>
                                    <td><span class="cell-primary">{{ $t->kendaraan->plat_nomor ?? '-' }}</span></td>
                                    <td>{{ $t->slotParkir->lokasiParkir->nama ?? '-' }}</td>
                                    <td>{{ $durasi }}</td>
                                    <td><span class="badge {{ $badgeClass }}">{{ $badgeLabel }}</span></td>
                                    <td class="cell-primary">Rp {{ number_format($t->total_harga, 0, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" style="text-align:center;color:var(--text-muted);padding:20px">
                                        Belum ada transaksi hari ini
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Aktivitas Sistem --}}
            <div class="card">
                <div class="card-header">
                    <span class="card-title">Aktivitas Sistem</span>
                    <span class="card-action">Semua Log →</span>
                </div>
                <div>
                    @forelse($activities as $act)
                        @php
                            $iconMap = [
                                'selesai' => [
                                    'bg' => 'var(--green-soft)',
                                    'stroke' => 'var(--green)',
                                    'path' => '<polyline points="20 6 9 17 4 12"/>',
                                ],
                                'masuk' => [
                                    'bg' => 'var(--purple-soft)',
                                    'stroke' => 'var(--purple)',
                                    'path' =>
                                        '<rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>',
                                ],
                                'user' => [
                                    'bg' => 'var(--blue-soft)',
                                    'stroke' => 'var(--blue-main)',
                                    'path' =>
                                        '<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/>',
                                ],
                            ];
                            $icon = $iconMap[$act['type']] ?? $iconMap['user'];
                            $timeAgo = \Carbon\Carbon::parse($act['time'])->diffForHumans();
                        @endphp
                        <div class="activity-item">
                            <div class="act-icon" style="background:{{ $icon['bg'] }}">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none"
                                    stroke="{{ $icon['stroke'] }}" stroke-width="2.5">
                                    {!! $icon['path'] !!}
                                </svg>
                            </div>
                            <div>
                                <div class="act-main">{{ $act['text'] }}</div>
                                <div class="act-sub">{{ $timeAgo }}</div>
                            </div>
                        </div>
                    @empty
                        <div style="text-align:center;padding:20px;color:var(--text-muted);font-size:12px">
                            Belum ada aktivitas
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const CHART_DATA = {
            labels: {!! $chartLabels->toJson() !!},
            masuk: {!! $chartMasuk->toJson() !!},
            keluar: {!! $chartKeluar->toJson() !!},
            donut: [
                {{ $distribusiSlot['terisi'] }},
                {{ $distribusiSlot['tersedia'] }},
                {{ $distribusiSlot['dipesan'] }}
            ]
        };
    </script>
    <script>
        // ══════════════════════════════════════════
        // PARKIFY — DASHBOARD PAGE JS
        // Hanya dipakai di halaman dashboard
        // ══════════════════════════════════════════

        // Depends on: Chart.js, CHART_DATA (injected by Blade)

        function getCSSVar(v) {
            return getComputedStyle(document.documentElement).getPropertyValue(v).trim();
        }

        let usageChartInstance, donutChartInstance;

        function buildCharts() {
            const tm = getCSSVar('--text-muted'),
                bc = getCSSVar('--border'),
                bm = getCSSVar('--blue-main'),
                gc = getCSSVar('--green'),
                ac = getCSSVar('--amber'),
                cb = getCSSVar('--bg-card'),
                tp = getCSSVar('--text-primary');

            // ── Line Chart ─────────────────────────────────
            const uc = document.getElementById('usageChart').getContext('2d');
            const gradient = uc.createLinearGradient(0, 0, 0, 215);
            gradient.addColorStop(0, 'rgba(37,99,235,0.18)');
            gradient.addColorStop(1, 'rgba(37,99,235,0)');

            usageChartInstance = new Chart(uc, {
                type: 'line',
                data: {
                    labels: CHART_DATA.labels,
                    datasets: [{
                            label: 'Kendaraan Masuk',
                            data: CHART_DATA.masuk,
                            borderColor: bm,
                            backgroundColor: gradient,
                            fill: true,
                            tension: 0.42,
                            pointBackgroundColor: bm,
                            pointRadius: 4,
                            pointHoverRadius: 6,
                            borderWidth: 2.5
                        },
                        {
                            label: 'Kendaraan Keluar',
                            data: CHART_DATA.keluar,
                            borderColor: gc,
                            backgroundColor: 'transparent',
                            fill: false,
                            tension: 0.42,
                            pointBackgroundColor: gc,
                            pointRadius: 4,
                            pointHoverRadius: 6,
                            borderWidth: 2,
                            borderDash: [5, 4]
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: {
                        intersect: false,
                        mode: 'index'
                    },
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                padding: 16,
                                usePointStyle: true,
                                pointStyleWidth: 10,
                                boxHeight: 2,
                                font: {
                                    size: 11,
                                    family: 'Poppins'
                                },
                                color: tm
                            }
                        },
                        tooltip: {
                            backgroundColor: cb,
                            borderColor: bc,
                            borderWidth: 1,
                            padding: 10,
                            titleColor: tp,
                            bodyColor: tm,
                            titleFont: {
                                weight: '700',
                                family: 'Space Grotesk'
                            },
                            bodyFont: {
                                family: 'Poppins'
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                color: bc,
                                drawTicks: false
                            },
                            border: {
                                display: false
                            },
                            ticks: {
                                padding: 8,
                                color: tm,
                                font: {
                                    family: 'Poppins',
                                    size: 11
                                }
                            }
                        },
                        y: {
                            grid: {
                                color: bc,
                                drawTicks: false
                            },
                            border: {
                                display: false
                            },
                            ticks: {
                                padding: 8,
                                color: tm,
                                font: {
                                    family: 'Poppins',
                                    size: 11
                                }
                            }
                        }
                    }
                }
            });

            // ── Donut Chart ─────────────────────────────────
            const dc = document.getElementById('donutChart').getContext('2d');
            donutChartInstance = new Chart(dc, {
                type: 'doughnut',
                data: {
                    labels: ['Terisi', 'Tersedia', 'Dipesan'],
                    datasets: [{
                        data: CHART_DATA.donut,
                        backgroundColor: [bm, gc, ac],
                        borderWidth: 0,
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '72%',
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: cb,
                            borderColor: bc,
                            borderWidth: 1,
                            titleColor: tp,
                            bodyColor: tm,
                            callbacks: {
                                label: ctx => ` ${ctx.label}: ${ctx.raw}%`
                            }
                        }
                    }
                }
            });
        }

        function updateCharts() {
            if (usageChartInstance) {
                usageChartInstance.destroy();
                donutChartInstance.destroy();
            }
            requestAnimationFrame(() => requestAnimationFrame(buildCharts));
        }

        // Subscribe ke theme change dari global JS
        document.addEventListener('parkify:theme-changed', updateCharts);

        buildCharts();
    </script>
@endsection
