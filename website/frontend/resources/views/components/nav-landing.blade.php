<!-- NAVBAR -->
<nav id="navbar">
    <a class="nav-logo" href="{{ route('home') }}"><img src="{{ asset('assets/img/logo-nav.png') }}" class="w-[80px]" alt=""></a>
    <ul class="nav-links items-center flex">
        <li><a href="{{ route('home') }}" {{ Route::is('home') ? 'class=active' : ''}}>Beranda</a></li>
        <li><a href="{{ Route::is('home') ? '#fitur' : route('home') }}" {{ Route::is('home') ? '' : ''}}>Detail Layanan</a></li>
        <li><a href="{{ route('tentang') }}" {{ Route::is('tentang') ? 'class=active' : ''}}>Tentang Kami</a></li>
        <li><a href="{{ route('hubungi') }}" {{ Route::is('hubungi') ? 'class=active' : ''}}>Hubungi Kami</a></li>
    </ul>
    <a class="nav-cta" href="{{ route('user.login') }}">Mulai Sekarang</a>
    <div class="hamburger" id="hamburger"><span></span><span></span><span></span></div>
</nav>

<!-- Mobile menu -->
<!-- Mobile menu -->
<div class="overlay" id="overlay"></div>

<div class="mobile-menu" id="mobileMenu">
    <button class="close-btn" id="closeMenu">✕</button>

    <a href="{{ route('home') }}"
       {{ Route::is('home') ? 'class=active' : '' }}>
        Beranda
    </a>

    <a href="{{ Route::is('home') ? '#fitur' : route('home') . '#fitur' }}">
        Detail Layanan
    </a>

    <a href="{{ route('tentang') }}"
       {{ Route::is('tentang') ? 'class=active' : '' }}>
        Tentang Kami
    </a>

    <a href="{{ route('hubungi') }}"
       {{ Route::is('hubungi') ? 'class=active' : '' }}>
        Hubungi Kami
    </a>

    <a class="nav-cta" href="{{ route('user.login') }}">
        Mulai Sekarang
    </a>
</div>