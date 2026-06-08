<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Pemesanan — Parkify</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: Arial, sans-serif;
            font-size: 10.5px;
            color: #0f172a;
            background: #ffffff;
        }

        /* ══════════════════════════════
           HEADER BAND
        ══════════════════════════════ */
        .header-band {
            background: #0f172a;
            padding: 0;
            margin-bottom: 0;
        }
        .header-inner {
            width: 100%;
            border-collapse: collapse;
        }
        .header-inner td {
            padding: 18px 28px;
            vertical-align: middle;
        }
        .header-left {
            width: 50%;
        }
        .header-right {
            width: 50%;
            text-align: right;
        }

        .logo-text {
            font-size: 26px;
            font-weight: 900;
            color: #ffffff;
            letter-spacing: -1px;
            line-height: 1;
        }
        .logo-accent { color: #3b82f6; }
        .logo-sub {
            font-size: 8px;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            margin-top: 4px;
        }

        .report-title {
            font-size: 15px;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 4px;
        }
        .report-meta {
            font-size: 9px;
            color: #94a3b8;
            line-height: 1.7;
        }

        /* ── BLUE ACCENT BAR ── */
        .accent-bar {
            height: 4px;
            background: #3b82f6;
            margin-bottom: 20px;
        }

        /* ══════════════════════════════
           SUMMARY TABLE
        ══════════════════════════════ */
        .section-label {
            font-size: 8.5px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: #3b82f6;
            margin: 0 28px 8px 28px;
        }

        .summary-table {
            width: calc(100% - 56px);
            margin: 0 28px 20px 28px;
            border-collapse: separate;
            border-spacing: 8px 0;
        }
        .summary-table td {
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 10px 14px;
            background: #f8fafc;
            vertical-align: top;
            width: 20%;
        }
        .s-label {
            font-size: 8px;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #94a3b8;
            margin-bottom: 5px;
        }
        .s-val {
            font-size: 20px;
            font-weight: 800;
            line-height: 1;
            color: #0f172a;
        }
        .s-val-sm {
            font-size: 13px;
            font-weight: 800;
            line-height: 1;
            color: #0f172a;
        }
        .c-green { color: #10b981; }
        .c-blue  { color: #3b82f6; }
        .c-amber { color: #f59e0b; }
        .c-red   { color: #ef4444; }

        /* ══════════════════════════════
           DATA TABLE
        ══════════════════════════════ */
        .data-wrap {
            margin: 0 28px 24px 28px;
        }
        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        /* Thead */
        .data-table thead tr {
            background: #1e3a5f;
        }
        .data-table thead th {
            padding: 9px 10px;
            text-align: left;
            font-size: 8.5px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.07em;
            color: #ffffff;
            white-space: nowrap;
            border: none;
        }
        .data-table thead th:first-child { border-radius: 6px 0 0 0; padding-left: 12px; }
        .data-table thead th:last-child  { border-radius: 0 6px 0 0; }

        /* Tbody */
        .data-table tbody tr {
            border-bottom: 1px solid #f1f5f9;
        }
        .data-table tbody tr.row-even {
            background: #f8fafc;
        }
        .data-table tbody tr.row-odd {
            background: #ffffff;
        }
        .data-table tbody td {
            padding: 8px 10px;
            font-size: 10px;
            vertical-align: top;
            color: #0f172a;
        }
        .data-table tbody td:first-child { padding-left: 12px; }

        /* Cells */
        .cell-no     { color: #94a3b8; font-size: 9.5px; }
        .cell-kode   { font-family: monospace; font-size: 9.5px; background: #eff6ff; color: #1d4ed8; padding: 2px 6px; border-radius: 4px; display: inline-block; white-space: nowrap; }
        .cell-name   { font-weight: 700; font-size: 10px; }
        .cell-sub    { font-size: 8.5px; color: #94a3b8; margin-top: 2px; }
        .cell-harga  { font-weight: 700; white-space: nowrap; color: #0f172a; }
        .cell-nowrap { white-space: nowrap; }

        /* Status chips */
        .chip {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 20px;
            font-size: 8.5px;
            font-weight: 700;
            white-space: nowrap;
        }
        .chip-menunggu   { background: #fef3c7; color: #92400e; }
        .chip-aktif      { background: #d1fae5; color: #065f46; }
        .chip-running    { background: #dbeafe; color: #1e3a8a; }
        .chip-selesai    { background: #e2e8f0; color: #475569; }
        .chip-dibatalkan { background: #fee2e2; color: #991b1b; }

        /* Empty state */
        .empty-row td {
            text-align: center;
            padding: 28px;
            color: #94a3b8;
            font-style: italic;
        }

        /* ══════════════════════════════
           FOOTER
        ══════════════════════════════ */
        .footer-band {
            border-top: 1px solid #e2e8f0;
            margin: 0 28px;
            padding-top: 10px;
        }
        .footer-table {
            width: 100%;
            border-collapse: collapse;
        }
        .footer-table td {
            font-size: 8.5px;
            color: #94a3b8;
            padding: 0;
        }
        .footer-right { text-align: right; }

        .footer-dot {
            display: inline-block;
            width: 6px;
            height: 6px;
            background: #3b82f6;
            border-radius: 50%;
            margin-right: 5px;
            vertical-align: middle;
        }

        /* ══════════════════════════════
           PAGE NUMBER
        ══════════════════════════════ */
        @page {
            margin: 0;
            size: A4 landscape;
        }
    </style>
</head>
<body>

    {{-- ══ HEADER BAND ══ --}}
    <div class="header-band">
        <table class="header-inner">
            <tr>
                <td class="header-left">
                    <div class="logo-text">Parki<span class="logo-accent">fy</span></div>
                    <div class="logo-sub">Smart Parking System</div>
                </td>
                <td class="header-right">
                    <div class="report-title">Laporan Pemesanan</div>
                    <div class="report-meta">
                        Dicetak: {{ now()->format('d M Y, H:i') }} WIB &nbsp;·&nbsp;
                        Filter: {{ $filterStatus ?: 'Semua Status' }}<br>
                        Total Data: {{ $pemesanans->count() }} pemesanan
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <div class="accent-bar"></div>

    {{-- ══ SUMMARY ══ --}}
    @php
        $countSelesai    = $pemesanans->where('status', 'selesai')->count();
        $countAktif      = $pemesanans->whereIn('status', ['aktif', 'running'])->count();
        $countDibatalkan = $pemesanans->where('status', 'dibatalkan')->count();
        $countMenunggu   = $pemesanans->where('status', 'menunggu')->count();
    @endphp

    <div class="section-label">Ringkasan</div>
    <table class="summary-table">
        <tr>
            <td>
                <div class="s-label">Total Pemesanan</div>
                <div class="s-val">{{ $pemesanans->count() }}</div>
            </td>
            <td>
                <div class="s-label">Selesai</div>
                <div class="s-val c-green">{{ $countSelesai }}</div>
            </td>
            <td>
                <div class="s-label">Aktif / Running</div>
                <div class="s-val c-blue">{{ $countAktif }}</div>
            </td>
            <td>
                <div class="s-label">Menunggu</div>
                <div class="s-val c-amber">{{ $countMenunggu }}</div>
            </td>
            <td>
                <div class="s-label">Total Pendapatan</div>
                <div class="s-val-sm">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</div>
            </td>
        </tr>
    </table>

    {{-- ══ TABLE ══ --}}
    <div class="section-label">Detail Pemesanan</div>
    <div class="data-wrap">
        <table class="data-table">
            <thead>
                <tr>
                    <th style="width:28px">#</th>
                    <th>Kode</th>
                    <th>Pengguna</th>
                    <th>Slot / Lokasi</th>
                    <th>Kendaraan</th>
                    <th>Waktu Mulai</th>
                    <th>Waktu Selesai</th>
                    <th style="text-align:center">Durasi</th>
                    <th>Total</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pemesanans as $i => $p)
                <tr class="{{ $i % 2 === 0 ? 'row-odd' : 'row-even' }}">
                    <td class="cell-no">{{ $i + 1 }}</td>
                    <td>
                        <span class="cell-kode">{{ $p->kode_pemesanan }}</span>
                    </td>
                    <td>
                        <div class="cell-name">{{ $p->user?->name ?? '–' }}</div>
                        <div class="cell-sub">{{ $p->user?->email ?? '' }}</div>
                    </td>
                    <td>
                        <div class="cell-name">{{ $p->slotParkir?->kode_slot ?? '–' }}</div>
                        <div class="cell-sub">{{ Str::limit($p->slotParkir?->lokasiParkir?->nama, 24) }}</div>
                    </td>
                    <td>
                        <div class="cell-name">{{ $p->kendaraan?->plat_nomor ?? '–' }}</div>
                        <div class="cell-sub">{{ trim(($p->kendaraan?->merek ?? '') . ' ' . ($p->kendaraan?->model ?? '')) ?: '' }}</div>
                    </td>
                    <td class="cell-nowrap">
                        {{ $p->waktu_mulai ? \Carbon\Carbon::parse($p->waktu_mulai)->format('d M Y') : '–' }}<br>
                        <span style="color:#94a3b8;font-size:9px">{{ $p->waktu_mulai ? \Carbon\Carbon::parse($p->waktu_mulai)->format('H:i') : '' }}</span>
                    </td>
                    <td class="cell-nowrap">
                        @if($p->waktu_selesai)
                            {{ \Carbon\Carbon::parse($p->waktu_selesai)->format('d M Y') }}<br>
                            <span style="color:#94a3b8;font-size:9px">{{ \Carbon\Carbon::parse($p->waktu_selesai)->format('H:i') }}</span>
                        @else
                            <span style="color:#94a3b8">–</span>
                        @endif
                    </td>
                    <td style="text-align:center">
                        @if($p->durasi_parkir)
                            <span style="font-weight:700">{{ $p->durasi_parkir }}</span>
                            <span style="color:#94a3b8;font-size:9px"> jam</span>
                        @else
                            <span style="color:#94a3b8">–</span>
                        @endif
                    </td>
                    <td class="cell-harga">
                        {{ $p->total_harga > 0 ? 'Rp ' . number_format($p->total_harga, 0, ',', '.') : '–' }}
                    </td>
                    <td>
                        <span class="chip chip-{{ $p->status }}">{{ ucfirst($p->status) }}</span>
                    </td>
                </tr>
                @empty
                <tr class="empty-row">
                    <td colspan="10">Tidak ada data pemesanan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- ══ FOOTER ══ --}}
    <div class="footer-band">
        <table class="footer-table">
            <tr>
                <td>
                    <span class="footer-dot"></span>
                    Parkify Smart Parking System &mdash; Dokumen ini dibuat secara otomatis oleh sistem
                </td>
                <td class="footer-right">
                    Dicetak {{ now()->format('d/m/Y H:i') }} &nbsp;|&nbsp; Halaman <span style="font-weight:700;color:#3b82f6">1</span>
                </td>
            </tr>
        </table>
    </div>

</body>
</html>