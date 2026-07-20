@extends('layouts.user')

@section('styles')
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
.page-topbar {
    max-width: 680px;
    margin: 0 auto;
    padding: 24px 24px 0;
    display: flex;
    align-items: center;
    gap: 12px;
}
.back-btn {
    width: 38px; height: 38px;
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
.content-inner { max-width: 680px; }

.status-badge {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 6px 14px; border-radius: 999px;
    font-size: 12px; font-weight: 700;
}
.sbadge-menunggu { background: var(--amber-soft); color: var(--amber); }
.sbadge-sukses   { background: var(--green-soft); color: var(--green); }
.sbadge-gagal    { background: var(--red-soft); color: var(--red); }

.detail-card {
    margin-top: 20px;
    background: var(--bg-card);
    border: 1.5px solid var(--border);
    border-radius: 20px;
    overflow: hidden;
    box-shadow: var(--shadow-sm);
}
.detail-section {
    padding: 16px 18px;
    border-bottom: 1px solid var(--border);
}
.detail-section:last-child { border-bottom: none; }

.sec-label {
    font-size: 10.5px; font-weight: 700; color: var(--text-muted);
    text-transform: uppercase; letter-spacing: 0.06em;
    margin-bottom: 8px;
}
.sec-label svg { display: inline; vertical-align: middle; margin-right: 4px; }

.row { display: flex; justify-content: space-between; align-items: center; padding: 3px 0; }
.row-label { font-size: 12.5px; color: var(--text-secondary); font-weight: 500; }
.row-val   { font-size: 12.5px; color: var(--text-primary); font-weight: 700; text-align: right; }

.lokasi-name { font-size: 11px; font-weight: 700; color: var(--blue-main); margin-bottom: 2px; }
.slot-code   { font-family: 'Space Grotesk', sans-serif; font-size: 26px; font-weight: 800; color: var(--text-primary); letter-spacing: -0.5px; }
.vehicle-plate { font-family: 'Space Grotesk', sans-serif; font-size: 14px; font-weight: 700; color: var(--text-secondary); }
.vehicle-name   { font-size: 12px; color: var(--text-muted); }

.amount-main {
    font-family: 'Space Grotesk', sans-serif;
    font-size: 28px; font-weight: 800; color: var(--text-primary);
    letter-spacing: -0.8px;
}
.amount-label { font-size: 11px; color: var(--text-muted); font-weight: 500; margin-bottom: 2px; }

.cta-wrap { margin-top: 16px; }
.btn-primary {
    width: 100%; padding: 16px; border: none;
    border-radius: 14px; background: var(--blue-main); color: #fff;
    font-family: inherit; font-size: 14px; font-weight: 800;
    cursor: pointer; transition: all 0.2s;
    display: flex; align-items: center; justify-content: center; gap: 8px;
    box-shadow: 0 4px 20px rgba(37,99,235,.30);
}
.btn-primary:hover:not(:disabled) { background: var(--blue-bright); transform: translateY(-1px); }
.btn-primary:disabled { background: var(--bg-input); color: var(--text-muted); box-shadow: none; cursor: not-allowed; border: 1.5px solid var(--border); }
.btn-primary.success { background: var(--green); }

@media (max-width: 859px) {
    .page-topbar { padding: 20px 16px 0; }
}
</style>
@endsection

@section('content')
@php
    $slot = $pemesanan->slotParkir;
    $lokasi = $slot?->lokasiParkir;
    $kend = $pemesanan->kendaraan;

    $statusBadgeClass = match($pembayaran->status) {
        'sukses'  => 'sbadge-sukses',
        'gagal'   => 'sbadge-gagal',
        default   => 'sbadge-menunggu',
    };
    $statusLabel = match($pembayaran->status) {
        'sukses'  => '✓ Lunas',
        'gagal'   => '✕ Gagal',
        default   => '◷ Menunggu Pembayaran',
    };

    $mulai  = Carbon\Carbon::parse($pemesanan->waktu_mulai);
    $selesai = $pemesanan->waktu_selesai ? Carbon\Carbon::parse($pemesanan->waktu_selesai) : null;

    $metodeLabel = [
        'transfer' => 'Transfer Bank',
        'qris'     => 'QRIS',
        'e-wallet' => 'E-Wallet',
        'bca'      => 'BCA Virtual Account',
    ];

    $paymentIndex = \App\Models\Pembayaran::where('pemesanan_id', $pemesanan->id)
        ->where('id', '<=', $pembayaran->id)
        ->count();
    $isOvertime = $paymentIndex > 1;
@endphp

<main class="main-wrap">
    <div class="page-topbar">
        <a class="back-btn" href="{{ route('user.riwayat') }}" title="Kembali">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <polyline points="15 18 9 12 15 6"/>
            </svg>
        </a>
        <span style="font-family:'Space Grotesk',sans-serif;font-size:20px;font-weight:800;color:var(--text-primary)">Detail Pembayaran</span>
        <span class="status-badge {{ $statusBadgeClass }}">{{ $statusLabel }}</span>
    </div>

    <div class="content-inner">

        {{-- ── Amount ── --}}
        <div class="detail-card">
            <div class="detail-section">
                <div class="amount-label">Total Pembayaran</div>
                <div class="amount-main">Rp {{ number_format($pembayaran->jumlah, 0, ',', '.') }}</div>
            </div>

            {{-- ── Booking Info ── --}}
            <div class="detail-section">
                <div class="sec-label">Booking Parkir</div>
                <div class="lokasi-name">{{ $lokasi?->nama ?? '-' }}</div>
                <div class="slot-code">{{ $slot?->kode_slot ?? '-' }}</div>
                <div style="margin-top:8px;display:flex;gap:10px;align-items:center">
                    <span class="vehicle-plate">{{ $kend?->plat_nomor ?? '-' }}</span>
                    <span class="vehicle-name">{{ $kend ? trim(($kend->merek ?? '') . ' ' . ($kend->model ?? '')) : '-' }}</span>
                </div>
            </div>

            {{-- ── Time ── --}}
            <div class="detail-section">
                <div class="sec-label">Waktu</div>
                <div class="row">
                    <span class="row-label">Mulai</span>
                    <span class="row-val">{{ $mulai->format('H:i, d/m/Y') }}</span>
                </div>
                @if ($selesai)
                <div class="row">
                    <span class="row-label">Selesai</span>
                    <span class="row-val">{{ $selesai->format('H:i, d/m/Y') }}</span>
                </div>
                @endif
                <div class="row">
                    <span class="row-label">Durasi</span>
                    <span class="row-val">{{ $pemesanan->durasi_parkir ?? '-' }} jam</span>
                </div>
                <div class="row" style="margin-top:4px;padding-top:6px;border-top:1px solid var(--border)">
                    <span class="row-label">Harga per Jam</span>
                    <span class="row-val">Rp {{ number_format($lokasi?->harga_per_jam ?? 0, 0, ',', '.') }}</span>
                </div>
            </div>

            {{-- ── Payment Info ── --}}
            <div class="detail-section">
                <div class="sec-label">Informasi Pembayaran</div>
                <div class="row">
                    <span class="row-label">Kode Booking</span>
                    <span class="row-val" style="font-family:'Space Grotesk',sans-serif;letter-spacing:0.04em">{{ $pemesanan->kode_pemesanan }}</span>
                </div>
                <div class="row">
                    <span class="row-label">Metode</span>
                    <span class="row-val">{{ $metodeLabel[$pembayaran->metode] ?? $pembayaran->metode ?? '-' }}</span>
                </div>
                @if ($pembayaran->referensi_pembayaran)
                <div class="row">
                    <span class="row-label">Referensi</span>
                    <span class="row-val" style="font-family:'Space Grotesk',sans-serif">{{ $pembayaran->referensi_pembayaran }}</span>
                </div>
                @endif
                <div class="row">
                    <span class="row-label">Status</span>
                    <span class="status-badge {{ $statusBadgeClass }}" style="font-size:11px;padding:3px 10px">{{ $statusLabel }}</span>
                </div>
            </div>

            {{-- ── Catatan ── --}}
            @if ($pemesanan->catatan)
            <div class="detail-section">
                <div class="sec-label">Catatan</div>
                <div style="font-size:12.5px;color:var(--text-secondary);font-weight:500">{{ $pemesanan->catatan }}</div>
            </div>
            @endif
        </div>

        {{-- ── CTA ── --}}
        @if ($pembayaran->status === 'menunggu')
        <div class="cta-wrap">
            <button class="btn-primary" id="btn-bayar" onclick="handlePayment()"
                data-pemesanan="{{ $pemesanan->id }}"
                data-pembayaran="{{ $pembayaran->id }}"
                data-snap="{{ $snapToken }}"
                data-method="{{ $pembayaran->metode }}"
                data-callback-url="{{ route('user.pembayaran.riwayat-callback') }}"
                data-success-url="{{ route('user.pembayaran.sukses', $pembayaran->id) }}"
                data-bca-va-url="{{ route('user.pembayaran.bca-va') }}"
                data-check-status-url="{{ route('user.pembayaran.check-status') }}"
                data-overtime="{{ $isOvertime ? '1' : '0' }}">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <rect x="2" y="5" width="20" height="14" rx="2"/>
                    <line x1="2" y1="10" x2="22" y2="10"/>
                </svg>
                Bayar Sekarang — Rp {{ number_format($pembayaran->jumlah ?? $pemesanan->total_harga, 0, ',', '.') }}
            </button>
        </div>
        @else
        <div class="cta-wrap">
            <button class="btn-primary success" disabled>
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                    <polyline points="22 4 12 14.01 9 11.01"/>
                </svg>
                Pembayaran Lunas
            </button>
        </div>
        @endif

    </div>
</main>
@endsection

@section('scripts')
<script src="{{ asset('assets/js/payment.js') }}"></script>
@endsection
