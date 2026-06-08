
  <header class="topbar">
    <div class="hamburger" onclick="toggleSidebar()"><span></span><span></span><span></span></div>
    <div class="topbar-title">Dashboard</div>
    <div class="search-box">
      <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="var(--text-muted)" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
      <input placeholder="Cari lokasi, pengguna, plat..." />
    </div>
    <div style="margin-left:auto;display:flex;align-items:center;gap:8px">
      <span style="font-size:11px;color:var(--text-muted);font-weight:500" id="theme-label">Light</span>
      <div class="theme-toggle" onclick="toggleTheme()">
        <div class="toggle-thumb">
          <svg class="icon-sun" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/></svg>
          <svg class="icon-moon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
        </div>
      </div>
    </div>
    {{-- <div class="topbar-btn">
      <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
      <span class="notif-dot"></span>
    </div> --}}
    <div class="topbar-btn" onclick="window.location.href ='{{ route('admin.profile.edit') }}'">
      <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M20 21a8 8 0 1 0-16 0"/></svg>
    </div>
  </header>
