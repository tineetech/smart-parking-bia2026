<!-- ════════ BOTTOM NAV ════════ -->
<nav class="bottom-nav">
  <div class="bottom-nav-inner">

    <a class="bn-item {{ Route::is('user.dashboard') ? 'active' : '' }}"
       href="{{ route('user.dashboard') }}">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
        <polyline points="9 22 9 12 15 12 15 22"/>
      </svg>
      <span>Home</span>
    </a>

    <a class="bn-item {{ Route::is('user.lokasi') ? 'active' : '' }}"
       href="{{ route('user.lokasi') }}">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <circle cx="11" cy="11" r="8"/>
        <line x1="21" y1="21" x2="16.65" y2="16.65"/>
      </svg>
      <span>Cari</span>
    </a>

    <a class="bn-item {{ Route::is('user.kendaraan') ? 'active' : '' }}"
       href="{{ route('user.kendaraan') }}">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <rect x="1" y="3" width="15" height="13" rx="2"/>
        <path d="M16 8h4a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2h-4"/>
        <circle cx="5.5" cy="18.5" r="2.5"/>
        <circle cx="18.5" cy="18.5" r="2.5"/>
      </svg>
      <span>Kendaraan</span>
    </a>

    <a class="bn-item {{ Route::is('user.riwayat') ? 'active' : '' }}"
       href="{{ route('user.riwayat') }}">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
        <polyline points="14 2 14 8 20 8"/>
        <line x1="16" y1="13" x2="8" y2="13"/>
        <line x1="16" y1="17" x2="8" y2="17"/>
      </svg>
      <span>Riwayat</span>
    </a>

  </div>
</nav>