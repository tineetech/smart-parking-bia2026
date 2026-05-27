<!-- ══ FOOTER ══ -->
<footer id="kontak">
    <div class="footer-top">
        <div class="footer-brand">
            <div class="flex gap-2">
                <div>
                    <img src="{{ asset('assets/img/logo-light.png') }}" style="width: 50px" alt="">
                </div>
                <div class="logo">Parki<span>fy</span></div>
            </div>
            <p>Parkify: Solusi Digital Booking parkiran Mu. Kelola parkir lebih cerdas, hemat waktu, dan bebas ribet.
            </p>
        </div>
        <div class="footer-col">
            <h5>Navigasi</h5>
            <ul>
                <li><a href="{{ route('home') }}">Beranda</a></li>
                <li><a href="{{ Route::is('home') ? '#fitur' : route('home') }}">Detail Layanan</a></li>
                <li><a href="{{ route('tentang') }}">Tentang Kami</a></li>
                <li><a href="{{ route('hubungi') }}">Hubungi Kami</a></li>
            </ul>
        </div>
        <div class="footer-col footer-contact">
            <h5>Lokasi</h5>
            <p>Jl. Raya Tajur, Kp. Buntar, Kel. Muara Sari, Kec. Bogor Selatan</p>
            <br>
            <h5 style="margin-top:4px">Kontak</h5>
            <p><a href="tel:+62838796300647">+62 838 7963 0647</a></p>
            <p><a href="tel:+628577025310">+62 857 7025 3106</a></p>
            <br>
            <h5 style="margin-top:4px">Email</h5>
            <p><a href="mailto:parkify@gmail.com">parkify@gmail.com</a></p>
            <div class="social-links">
                <a href="#" title="Facebook">
                    <svg viewBox="0 0 24 24">
                        <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z" />
                    </svg>
                </a>
                <a href="#" title="Twitter">
                    <svg viewBox="0 0 24 24">
                        <path
                            d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z" />
                    </svg>
                </a>
                <a href="#" title="Instagram">
                    <svg viewBox="0 0 24 24">
                        <rect x="2" y="2" width="20" height="20" rx="5" ry="5" />
                        <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z" />
                        <line x1="17.5" y1="6.5" x2="17.51" y2="6.5" />
                    </svg>
                </a>
                <a href="#" title="LinkedIn">
                    <svg viewBox="0 0 24 24">
                        <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z" />
                        <rect x="2" y="9" width="4" height="12" />
                        <circle cx="4" cy="4" r="2" />
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <p class="footer-copyright">© 2026 Parkify. Semua hak dilindungi.</p>
    </div>

    <div class="footer-wordmark">
        <span>Parki<b>fy</b></span>
    </div>
</footer>
