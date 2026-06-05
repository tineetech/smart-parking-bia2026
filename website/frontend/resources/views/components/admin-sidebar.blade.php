@php
    $totalLokasi = \App\Models\LokasiParkir::aktif()->count();
    $totalSlotTersedia = \App\Models\SlotParkir::where('status', 'tersedia')->count();
    $totalSlot = \App\Models\SlotParkir::count();
    $currentRoute = Route::currentRouteName();
@endphp

<aside class="sidebar" id="sidebar">

    {{-- Logo --}}
    <div class="sidebar-logo">
        <div class="sidebar-logo-left">
            <div class="logo-icon">
                <img src="{{ asset('assets/img/logo-round.png') }}" style="width: 30px !important" alt="Parkify">
            </div>
            <div>
                <div class="logo-text">Parki<span>fy</span></div>
                <div class="logo-sub">Smart Parking System</div>
            </div>
        </div>
    </div>

    {{-- Nav --}}
    <nav class="sidebar-nav">

        <a class="nav-item {{ $currentRoute === 'admin.dashboard' ? 'active' : '' }}"
           href="{{ route('admin.dashboard') }}">
            <i class="fa fa-house nav-icon"></i>
            Dashboard
        </a>

        <a class="nav-item {{ $currentRoute === 'admin.monitor' ? 'active' : '' }}"
           href="{{ route('admin.monitor') }}">
            <i class="fa fa-circle-dot nav-icon"></i>
            Monitor Parkir
            <span class="nav-badge green">Live</span>
        </a>

        <a class="nav-item {{ Str::startsWith($currentRoute, 'admin.pemesanan.') ? 'active' : '' }}"
           href="{{ route('admin.pemesanan.index') }}">
            <i class="fa fa-clipboard-list nav-icon"></i>
            Kelola Pemesanan
            <span class="nav-badge">{{ \App\Models\Pemesanan::whereIn('status', ['menunggu','aktif','running'])->count() }}</span>
        </a>

        <a class="nav-item {{ Str::startsWith($currentRoute, 'admin.lokasi.') ? 'active' : '' }}"
           href="{{ route('admin.lokasi.index') }}">
            <i class="fa fa-location-dot nav-icon"></i>
            Kelola Lokasi
            <span class="nav-badge">{{ $totalLokasi }}</span>
        </a>

        <a class="nav-item {{ Str::startsWith($currentRoute, 'admin.slot.') ? 'active' : '' }}"
           href="{{ route('admin.slot.index') }}">
            <i class="fa fa-table-cells nav-icon"></i>
            Slot Parkir
            <span class="nav-badge {{ $totalSlotTersedia > 0 ? 'green' : '' }}">
                {{ $totalSlotTersedia }}/{{ $totalSlot }}
            </span>
        </a>

        <a class="nav-item {{ Str::startsWith($currentRoute, 'admin.pengguna.') ? 'active' : '' }}"
           href="{{ route('admin.pengguna.index') }}">
            <i class="fa fa-users nav-icon"></i>
            Kelola Pengguna
        </a>

    </nav>

    {{-- Footer --}}
    <div class="sidebar-footer">
        <div class="sidebar-footer-nav">

            <a class="nav-item {{ Str::startsWith($currentRoute, 'admin.profile.') ? 'active' : '' }}"
               href="{{ route('admin.profile.edit') }}">
                <i class="fa fa-gear nav-icon"></i>
                Pengaturan
            </a>

            <form method="GET" action="{{ route('logout') }}" style="margin:0">
                @csrf
                <button type="submit" class="nav-item" style="width:100%; background:none; border:none; text-align:left; cursor:pointer;">
                    <i class="fa fa-right-from-bracket nav-icon"></i>
                    Logout
                </button>
            </form>

            <div class="sidebar-darkmode" onclick="toggleTheme()">
                <i class="fa fa-moon nav-icon"></i>
                Dark Mode
                <div class="sidebar-toggle-pill">
                    <div class="sidebar-toggle-thumb"></div>
                </div>
            </div>

        </div>

        {{-- User --}}
        <div class="user-chip" onclick="window.location.href='{{ route('admin.profile.edit') }}'">
            <div class="avatar">{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 2)) }}</div>
            <div class="user-info">
                <div class="user-name">{{ auth()->user()->name ?? 'Admin Parkify' }}</div>
                <div class="user-role">Super Admin</div>
            </div>
            <i class="fa fa-chevron-right" style="color: var(--text-muted); font-size: 11px;"></i>
        </div>
    </div>

</aside>