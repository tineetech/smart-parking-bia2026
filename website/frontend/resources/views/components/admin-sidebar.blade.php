@php
    $totalLokasi = \App\Models\LokasiParkir::aktif()->count();
    $totalSlotTersedia = \App\Models\SlotParkir::where('status', 'tersedia')->count();
    $totalSlot = \App\Models\SlotParkir::count();
    $currentRoute = Route::currentRouteName();
@endphp

<aside class="sidebar" id="sidebar">
    <div class="sidebar-logo">
        <div class="logo-icon">
            <img src="{{ asset('assets/img/logo-round.png') }}" style="width: 50px" alt="">
        </div>
        <div>
            <div class="logo-text">Parki<span>fy</span></div>
            <div class="logo-sub">Smart Parking System</div>
        </div>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-label">Menu Utama</div>

        <a class="nav-item {{ $currentRoute === 'admin.dashboard' ? 'active' : '' }}"
           href="{{ route('admin.dashboard') }}">
            <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="3" width="7" height="7" rx="1" />
                <rect x="14" y="3" width="7" height="7" rx="1" />
                <rect x="3" y="14" width="7" height="7" rx="1" />
                <rect x="14" y="14" width="7" height="7" rx="1" />
            </svg>
            Dashboard
        </a>

        <a class="nav-item {{ $currentRoute === 'admin.monitor' ? 'active' : '' }}"
           href="{{ route('admin.monitor') }}">
            <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="3" />
                <circle cx="12" cy="12" r="9" />
                <line x1="12" y1="2" x2="12" y2="5" />
                <line x1="12" y1="19" x2="12" y2="22" />
                <line x1="2" y1="12" x2="5" y2="12" />
                <line x1="19" y1="12" x2="22" y2="12" />
            </svg>
            Monitor Parkir
            <span class="nav-badge green">Live</span>
        </a>

        <a class="nav-item {{ Str::startsWith($currentRoute, 'admin.pemesanan.') ? 'active' : '' }}"
            href="{{ route('admin.pemesanan.index') }}">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2"/>
                    <rect x="9" y="3" width="6" height="4" rx="1"/>
                    <line x1="9" y1="12" x2="15" y2="12"/>
                    <line x1="9" y1="16" x2="13" y2="16"/>
                </svg>
                Kelola Pemesanan
                <span class="nav-badge">{{ \App\Models\Pemesanan::whereIn('status', ['menunggu','aktif','running'])->count() }}</span>
            </a>

        <a class="nav-item {{ Str::startsWith($currentRoute, 'admin.lokasi.') ? 'active' : '' }}"
           href="{{ route('admin.lokasi.index') }}">
            <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z" />
                <circle cx="12" cy="9" r="2.5" />
            </svg>
            Kelola Lokasi
            <span class="nav-badge">{{ $totalLokasi }}</span>
        </a>

        <a class="nav-item nav-item--expandable {{ Str::startsWith($currentRoute, 'admin.slot.') ? 'active' : '' }}"
            href="{{ route('admin.slot.index') }}"
            onclick="toggleSlotMenu(event)">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="2" y="4" width="9" height="6" rx="1" />
                    <rect x="13" y="4" width="9" height="6" rx="1" />
                    <rect x="2" y="14" width="9" height="6" rx="1" />
                    <rect x="13" y="14" width="9" height="6" rx="1" />
                </svg>
                Slot Parkir
                <span class="nav-badge {{ $totalSlotTersedia > 0 ? 'green' : 'red' }}">
                    {{ $totalSlotTersedia }}/{{ $totalSlot }}
                </span>
            </a>

        <a class="nav-item {{ Str::startsWith($currentRoute, 'admin.pengguna.') ? 'active' : '' }}"
           href="{{ route('admin.pengguna.index') }}">
            <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                <circle cx="9" cy="7" r="4" />
                <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
            </svg>
            Kelola Pengguna
        </a>

        {{-- <div class="nav-label">Laporan</div>

        <a class="nav-item {{ $currentRoute === 'admin.pemesanan.index' ? 'active' : '' }}"
           href="#">
            <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                <polyline points="14 2 14 8 20 8" />
                <line x1="16" y1="13" x2="8" y2="13" />
                <line x1="16" y1="17" x2="8" y2="17" />
            </svg>
            Laporan Harian
        </a>

        <a class="nav-item" href="#">
            <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="22 12 18 12 15 21 9 3 6 12 2 12" />
            </svg>
            Analitik
        </a> --}}

        <div class="nav-label">Sistem</div>

        <a class="nav-item {{ Str::startsWith($currentRoute, 'admin.profile.') ? 'active' : '' }}" href="{{ route('admin.profile.edit') }}">
            <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="3" />
                <path d="M19.07 4.93l-1.41 1.41M4.93 4.93l1.41 1.41M12 2v2m0 16v2m7.07 1.07l-1.41-1.41M4.93 19.07l1.41-1.41M22 12h-2M4 12H2" />
            </svg>
            Pengaturan
        </a>
    </nav>

    <div class="sidebar-footer" onclick="window.location.href = '{{ route('admin.profile.edit') }}'">
        <div class="user-chip">
            <div class="avatar">{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 2)) }}</div>
            <div class="user-info">
                <div class="user-name">{{ auth()->user()->name ?? 'Admin Parkify' }}</div>
                <div class="user-role">Super Admin</div>
            </div>
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="var(--text-muted)" stroke-width="2">
                <polyline points="9 18 15 12 9 6" />
            </svg>
        </div>
    </div>
</aside>