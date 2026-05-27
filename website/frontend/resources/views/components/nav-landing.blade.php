<!-- NAVBAR -->
<nav id="navbar">
    <a class="nav-logo" href="#">Park<span>ify</span></a>
    <ul class="nav-links">
        <li><a href="{{ route('home') }}" {{ Route::is('home') ? 'class=active' : ''}}>Beranda</a></li>
        <li><a href="{{ Route::is('home') ? '#fitur' : route('home') }}" {{ Route::is('home') ? '' : ''}}>Detail Layanan</a></li>
        <li><a href="{{ route('tentang') }}" {{ Route::is('tentang') ? 'class=active' : ''}}>Tentang Kami</a></li>
        <li><a href="{{ route('hubungi') }}" {{ Route::is('hubungi') ? 'class=active' : ''}}>Hubungi Kami</a></li>
    </ul>
    <a class="nav-cta" href="{{ route('user.login') }}">Mulai Sekarang</a>
    <div class="hamburger" id="hamburger"><span></span><span></span><span></span></div>
</nav>

<!-- Mobile menu -->
<div class="overlay" id="overlay"></div>
<div class="mobile-menu" id="mobileMenu">
    <button class="close-btn" id="closeMenu">✕</button>
    <a href="#beranda">Beranda</a>
    <a href="#fitur">Detail Layanan</a>
    <a href="#layanan">Tentang Kami</a>
    <a href="#kontak">Hubungi Kami</a>
    <a class="nav-cta" href="{{ route('user.login') }}">Mulai Sekarang</a>
</div>
