@extends('layouts.user')

@section('styles')
    <style>
        /* ══ PAGE LAYOUT ══ */
        .page-wrap {
            max-width: var(--max-w);
            margin: 0 auto;
            padding-bottom: calc(var(--bottom-nav-h) + 120px + env(safe-area-inset-bottom));
            padding-top: 8px;
        }

        /* ══ SUCCESS HERO ══ */
        .success-hero {
            margin: 20px 20px 0;
            background: var(--bg-surface);
            border-radius: var(--r-xl);
            border: 1px solid var(--border);
            box-shadow: var(--shadow-md);
            padding: 32px 24px 28px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .success-hero::before {
            content: '';
            position: absolute;
            top: -60px;
            left: 50%;
            transform: translateX(-50%);
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(16, 185, 129, .10) 0%, transparent 70%);
            pointer-events: none;
        }

        .success-icon-wrap {
            width: 68px;
            height: 68px;
            border-radius: 50%;
            background: linear-gradient(135deg, #10b981, #059669);
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 6px 24px rgba(16, 185, 129, .35), 0 0 0 10px rgba(16, 185, 129, .08), 0 0 0 20px rgba(16, 185, 129, .04);
            animation: success-pop .5s cubic-bezier(.34, 1.56, .64, 1) both;
        }

        @keyframes success-pop {
            from {
                transform: scale(0);
                opacity: 0
            }

            to {
                transform: scale(1);
                opacity: 1
            }
        }

        .success-icon-wrap svg {
            width: 32px;
            height: 32px;
            stroke: #fff;
            stroke-width: 3;
            animation: check-draw .4s ease .3s both;
        }

        @keyframes check-draw {
            from {
                stroke-dasharray: 0 100;
                opacity: 0
            }

            to {
                stroke-dasharray: 100 0;
                opacity: 1
            }
        }

        .success-label {
            font-size: 13px;
            font-weight: 700;
            color: var(--text-muted);
            letter-spacing: .3px;
            margin-bottom: 6px;
            animation: fade-up .4s ease .2s both;
        }

        .success-amount {
            font-size: 34px;
            font-weight: 800;
            color: var(--text-primary);
            letter-spacing: -1.5px;
            font-variant-numeric: tabular-nums;
            animation: fade-up .4s ease .3s both;
        }

        @keyframes fade-up {
            from {
                opacity: 0;
                transform: translateY(10px)
            }

            to {
                opacity: 1;
                transform: translateY(0)
            }
        }

        /* ══ BOOKING INFO CARD ══ */
        .booking-info-card {
            margin: 12px 20px 0;
            background: var(--blue-soft);
            border-radius: var(--r-lg);
            border: 1px solid var(--blue-pale);
            padding: 14px 16px;
            display: flex;
            align-items: center;
            gap: 12px;
            animation: fade-up .4s ease .45s both;
        }

        .bic-icon {
            width: 40px;
            height: 40px;
            border-radius: var(--r-md);
            background: var(--blue-main);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .bic-icon svg {
            width: 20px;
            height: 20px;
            stroke: #fff;
        }

        .bic-info {
            flex: 1;
            min-width: 0;
        }

        .bic-label {
            font-size: 10.5px;
            font-weight: 700;
            color: var(--blue-bright);
            text-transform: uppercase;
            letter-spacing: .4px;
            margin-bottom: 3px;
        }

        .bic-val {
            font-size: 14px;
            font-weight: 800;
            color: var(--text-primary);
        }

        .bic-sub {
            font-size: 11.5px;
            color: var(--text-secondary);
            font-weight: 500;
            margin-top: 2px;
        }

        /* ══ DETAIL CARD (collapsible) ══ */
        .detail-card {
            margin: 12px 20px 0;
            background: var(--bg-surface);
            border-radius: var(--r-xl);
            border: 1px solid var(--border);
            box-shadow: var(--shadow-md);
            overflow: hidden;
            animation: fade-up .4s ease .35s both;
        }

        .detail-card-header {
            padding: 16px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            cursor: pointer;
            user-select: none;
            -webkit-tap-highlight-color: transparent;
        }

        .detail-card-title {
            font-size: 15px;
            font-weight: 800;
            color: var(--text-primary);
            letter-spacing: -.2px;
        }

        .detail-toggle {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: var(--bg-input);
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform .25s, background .15s;
        }

        .detail-toggle.open {
            transform: rotate(180deg);
            background: var(--blue-soft);
            border-color: var(--blue-pale);
        }

        .detail-toggle svg {
            width: 14px;
            height: 14px;
            color: var(--text-secondary);
        }

        .detail-toggle.open svg {
            color: var(--blue-main);
        }

        .detail-body {
            border-top: 1px solid var(--border);
            overflow: hidden;
            max-height: 0;
            transition: max-height .35s cubic-bezier(.4, 0, .2, 1);
        }

        .detail-body.open {
            max-height: 400px;
        }

        .detail-rows {
            padding: 14px 20px 6px;
            display: flex;
            flex-direction: column;
            gap: 0;
        }

        .drow {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid var(--bg-input);
        }

        .drow:last-child {
            border-bottom: none;
        }

        .drow-label {
            font-size: 12.5px;
            color: var(--text-muted);
            font-weight: 600;
        }

        .drow-val {
            font-size: 12.5px;
            color: var(--text-primary);
            font-weight: 700;
            text-align: right;
            max-width: 60%;
        }

        .drow-val.green {
            display: flex;
            align-items: center;
            gap: 5px;
            color: var(--green);
        }

        .drow-val.green svg {
            width: 13px;
            height: 13px;
            flex-shrink: 0;
        }

        .detail-total-row {
            padding: 14px 20px 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-top: 1px solid var(--border);
            margin-top: 4px;
        }

        .detail-total-label {
            font-size: 13px;
            font-weight: 800;
            color: var(--text-primary);
        }

        .detail-total-val {
            font-size: 18px;
            font-weight: 800;
            color: var(--text-primary);
            letter-spacing: -.5px;
        }

        /* ══ QR BUTTON (fixed floating) ══ */
        .qr-btn-wrap {
            position: fixed;
            bottom: calc(var(--bottom-nav-h) + 12px + env(safe-area-inset-bottom));
            left: 50%;
            transform: translateX(-50%);
            width: calc(min(var(--max-w), 100vw) - 40px);
            z-index: 500;
            animation: slide-up-btn .5s cubic-bezier(.34, 1.20, .64, 1) .6s both;
        }

        @keyframes slide-up-btn {
            from {
                transform: translateX(-50%) translateY(40px);
                opacity: 0;
            }

            to {
                transform: translateX(-50%) translateY(0);
                opacity: 1;
            }
        }

        .btn-qr {
            width: 100%;
            padding: 17px 24px;
            background: var(--blue-main);
            color: #fff;
            border: none;
            border-radius: 999px;
            font-family: inherit;
            font-size: 15px;
            font-weight: 800;
            letter-spacing: .1px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            box-shadow: 0 6px 28px rgba(37, 99, 235, .40), 0 2px 8px rgba(37, 99, 235, .20);
            transition: all .2s;
            text-decoration: none;
        }

        .btn-qr:hover {
            background: var(--blue-bright);
            transform: translateY(-2px);
            box-shadow: 0 10px 36px rgba(37, 99, 235, .50);
        }

        .btn-qr svg {
            width: 20px;
            height: 20px;
            opacity: .9;
            flex-shrink: 0;
        }

        /* ══ CONFETTI ══ */
        .confetti-wrap {
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: 9999;
            overflow: hidden;
        }

        .confetti-dot {
            position: absolute;
            top: -10px;
            border-radius: 50%;
            animation: confetti-fall linear both;
        }

        @keyframes confetti-fall {
            0% {
                transform: translateY(0) rotate(0deg);
                opacity: 1;
            }

            100% {
                transform: translateY(110vh) rotate(720deg);
                opacity: 0;
            }
        }

        /* ══ RESPONSIVE ══ */
        @media (min-width: 860px) {
            .qr-btn-wrap {
                bottom: 24px;
            }

            .page-wrap {
                padding-bottom: 80px;
            }
        }

        @media (max-width: 479px) {
            .success-amount {
                font-size: 28px;
            }
        }
    </style>
@endsection

@section('content')
    {{-- Confetti container --}}
    <div class="confetti-wrap" id="confetti-wrap"></div>
    {{-- ══ PAGE DATA ══ --}}

    @php
        $pemesanan = $pembayaran->pemesanan;
        $slot = $pemesanan->slotParkir;
        $lokasi = $slot->lokasiParkir;
        $kendaraan = $pemesanan->kendaraan;

        $totalHarga = $pembayaran->jumlah;
        $refNumber = $pembayaran->referensi_pembayaran ?? '-';
        $dibayarPada = $pembayaran->dibayar_pada
            ? \Carbon\Carbon::parse($pembayaran->dibayar_pada)
            : \Carbon\Carbon::now();
        $metode = $pembayaran->metode;
        $metodeLabel = [
            'bca' => 'Transfer BCA',
            'qris' => 'QRIS',
            'gopay' => 'GoPay',
            'ovo' => 'OVO',
            'dana' => 'DANA',
        ];
        $kodePemesanan = $pemesanan->kode_pemesanan;
        $pemesananId = $pemesanan->id;

        $slotKode = $slot->kode_slot;
        $lokasiNama = $lokasi->nama;
        $kendaraanPlat = $kendaraan->plat_nomor;

        $waktuMulai = \Carbon\Carbon::parse($pemesanan->waktu_mulai);
        $waktuSelesai = \Carbon\Carbon::parse($pemesanan->waktu_selesai);
        $durasi = $pemesanan->durasi_parkir;
        $hargaPerJam = $lokasi->harga_per_jam;
        $subtotal = $hargaPerJam * $durasi;
        $ppn = (int) round($subtotal * 0.1);
    @endphp

    <div class="page-wrap">

        {{-- ── Success Hero ── --}}
        <div class="success-hero">
            <div class="success-icon-wrap">
                <svg viewBox="0 0 24 24" fill="none">
                    <polyline points="20 6 9 17 4 12" />
                </svg>
            </div>
            <div class="success-label">Pembayaran berhasil !</div>
            <div class="success-amount">Rp {{ number_format($totalHarga, 0, ',', '.') }}</div>
        </div>

        {{-- ── Booking Info Strip ── --}}
        <div class="booking-info-card">
            <div class="bic-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5">
                    <rect x="1" y="3" width="15" height="13" rx="2" />
                    <circle cx="5.5" cy="18.5" r="2.5" />
                    <circle cx="12.5" cy="18.5" r="2.5" />
                </svg>
            </div>
            <div class="bic-info">
                <div class="bic-label">Slot Parkir</div>
                <div class="bic-val">{{ $slotKode }} — {{ $lokasiNama }}</div>
                <div class="bic-sub">{{ $waktuMulai->format('H:i') }} – {{ $waktuSelesai->format('H:i') }} WIB ·
                    {{ $durasi }} jam · {{ $kendaraanPlat }}</div>
            </div>
        </div>

        {{-- ── Detail Card (collapsible) ── --}}
        <div class="detail-card">
            <div class="detail-card-header" onclick="toggleDetail()" id="detail-header">
                <span class="detail-card-title">Detail Pembayaran</span>
                <div class="detail-toggle open" id="detail-toggle">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <polyline points="18 15 12 9 6 15" />
                    </svg>
                </div>
            </div>
            <div class="detail-body open" id="detail-body">
                <div class="detail-rows">
                    <div class="drow">
                        <span class="drow-label">Ref Number</span>
                        <span class="drow-val">{{ $refNumber }}</span>
                    </div>
                    <div class="drow">
                        <span class="drow-label">Kode Booking</span>
                        <span class="drow-val">{{ $kodePemesanan }}</span>
                    </div>
                    <div class="drow">
                        <span class="drow-label">Payment Status</span>
                        <span class="drow-val green">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                                <polyline points="22 4 12 14.01 9 11.01" />
                            </svg>
                            Berhasil
                        </span>
                    </div>
                    <div class="drow">
                        <span class="drow-label">Payment Time</span>
                        <span class="drow-val">{{ $dibayarPada->format('d-m-Y H:i:s') }}</span>
                    </div>
                    <div class="drow">
                        <span class="drow-label">Metode</span>
                        <span class="drow-val">{{ $metodeLabel[$metode] ?? $metode }}</span>
                    </div>
                    <div class="drow">
                        <span class="drow-label">Harga/Jam</span>
                        <span class="drow-val">Rp {{ number_format($hargaPerJam, 0, ',', '.') }}</span>
                    </div>
                    <div class="drow">
                        <span class="drow-label">Durasi</span>
                        <span class="drow-val">{{ $durasi }} jam</span>
                    </div>
                    <div class="drow">
                        <span class="drow-label">Subtotal</span>
                        <span class="drow-val">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>
                    <div class="drow">
                        <span class="drow-label">PPN (10%)</span>
                        <span class="drow-val">Rp {{ number_format($ppn, 0, ',', '.') }}</span>
                    </div>
                </div>
                <div class="detail-total-row">
                    <span class="detail-total-label">Total Payment</span>
                    <span class="detail-total-val">Rp {{ number_format($totalHarga, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

    </div>{{-- end page-wrap --}}

    {{-- ══ QR CODE BUTTON (fixed) ══ --}}
    <div class="qr-btn-wrap">
        <a class="btn-qr" href="{{ route('user.booking.qr', $pemesananId) }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <rect x="3" y="3" width="7" height="7" />
                <rect x="14" y="3" width="7" height="7" />
                <rect x="3" y="14" width="7" height="7" />
                <rect x="14" y="14" width="3" height="3" />
                <rect x="19" y="14" width="2" height="2" />
                <rect x="14" y="19" width="2" height="2" />
                <rect x="18" y="19" width="3" height="2" />
            </svg>
            Lihat QR Code Tiket
        </a>
    </div>
@endsection

@section('scripts')
    <script>
        // ── Collapsible detail ──
        function toggleDetail() {
            const body = document.getElementById('detail-body');
            const toggle = document.getElementById('detail-toggle');
            const isOpen = body.classList.contains('open');
            body.classList.toggle('open', !isOpen);
            toggle.classList.toggle('open', !isOpen);
        }

        // ── Confetti burst ──
        (function spawnConfetti() {
            const wrap = document.getElementById('confetti-wrap');
            const colors = ['#10b981', '#2563eb', '#f59e0b', '#3b82f6', '#a7f3d0', '#dbeafe'];
            const sizes = [6, 8, 10, 7, 9];
            for (let i = 0; i < 48; i++) {
                const dot = document.createElement('div');
                dot.className = 'confetti-dot';
                const size = sizes[Math.floor(Math.random() * sizes.length)];
                const color = colors[Math.floor(Math.random() * colors.length)];
                const left = Math.random() * 100;
                const delay = Math.random() * 1.2;
                const dur = 2.2 + Math.random() * 1.8;
                dot.style.cssText = `
      width:${size}px;height:${size}px;
      background:${color};
      left:${left}%;
      animation-name:confetti-fall;
      animation-duration:${dur}s;
      animation-delay:${delay}s;
      animation-fill-mode:both;
    `;
                wrap.appendChild(dot);
            }
            // Remove after animation done
            setTimeout(() => {
                wrap.innerHTML = '';
            }, 4500);
        })();
    </script>
@endsection
