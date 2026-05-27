@extends('layouts.main')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/kontak.css') }}">
@endsection

@section('content')

    @include('components.nav-landing')

    <!-- ══ HERO ══ -->
    <div class="contact-hero-wrapper">
        <section class="contact-hero">
            <div class="ch-pin"></div>
            <div class="ch-pin"></div>
            <div class="ch-pin"></div>
            <div class="ch-pin"></div>
            <div class="ch-ring"></div>
            <div class="ch-ring ch-ring-2"></div>
            <div class="contact-hero-content">
                <span class="hero-tag">Hubungi Kami</span>
                <h1>Kami Siap<br>Membantu <span>Kamu</span></h1>
                <p>Sampaikan pertanyaan, masukan, atau ajakan kolaborasi. Tim Parkify akan merespons dalam waktu 1×24 jam.</p>
                <div class="ch-stats">
                    <div class="ch-stat">
                        <div class="ch-stat-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.99 12a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.92 1h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 8.91a16 16 0 0 0 5.99 5.99l1.07-1.07a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                        </div>
                        <div class="ch-stat-text">
                            <div class="ch-stat-val">1×24 Jam</div>
                            <div class="ch-stat-label">Waktu Respons</div>
                        </div>
                    </div>
                    <div class="ch-stat-divider"></div>
                    <div class="ch-stat">
                        <div class="ch-stat-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        </div>
                        <div class="ch-stat-text">
                            <div class="ch-stat-val">Bogor</div>
                            <div class="ch-stat-label">Lokasi Kami</div>
                        </div>
                    </div>
                    <div class="ch-stat-divider"></div>
                    <div class="ch-stat">
                        <div class="ch-stat-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                        </div>
                        <div class="ch-stat-text">
                            <div class="ch-stat-val">24/7</div>
                            <div class="ch-stat-label">Support Online</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- ══ CONTACT INFO CARDS ══ -->
    <section class="contact-info-section">
        <div class="contact-info-header">
            <span class="section-tag reveal">Informasi Kontak</span>
            <h2 class="section-title reveal" style="margin-top:8px">Berbagai Cara untuk<br>Terhubung dengan <span>Parkify</span></h2>
        </div>

        <div class="contact-cards-grid">
            <!-- Card: Phone -->
            <div class="contact-info-card reveal">
                <div class="cic-icon-wrap cic-blue">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.99 12a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.92 1h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 8.91a16 16 0 0 0 5.99 5.99l1.07-1.07a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                </div>
                <div class="cic-label">Telepon / WhatsApp</div>
                <div class="cic-value">+62 895 2633 3265</div>
                <div class="cic-value cic-value-sm">+62 857 7025 3106</div>
                <div class="cic-desc">Senin – Jumat, 08.00 – 17.00 WIB</div>
                <a href="https://wa.me/6289526333265" target="_blank" class="cic-action">
                    Chat WhatsApp
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="7" y1="17" x2="17" y2="7"/><polyline points="7 7 17 7 17 17"/></svg>
                </a>
            </div>

            <!-- Card: Email -->
            <div class="contact-info-card reveal reveal-d1">
                <div class="cic-icon-wrap cic-indigo">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                </div>
                <div class="cic-label">Email</div>
                <div class="cic-value">parkify@gmail.com</div>
                <div class="cic-desc">Respons dalam 1×24 jam kerja. Pastikan subjek email jelas agar tim kami bisa membantu lebih cepat.</div>
                <a href="mailto:parkify@gmail.com" class="cic-action">
                    Kirim Email
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="7" y1="17" x2="17" y2="7"/><polyline points="7 7 17 7 17 17"/></svg>
                </a>
            </div>

            <!-- Card: Location -->
            <div class="contact-info-card reveal reveal-d2">
                <div class="cic-icon-wrap cic-green">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                </div>
                <div class="cic-label">Alamat Kantor</div>
                <div class="cic-value" style="font-size:.9rem; line-height:1.5;">Jl. Raya Tajur, Kp. Buntar</div>
                <div class="cic-desc">Kel. Muara Sari, Kec. Bogor Selatan, Kota Bogor, Jawa Barat</div>
                <a href="https://maps.google.com/?q=Jl+Raya+Tajur+Bogor+Selatan" target="_blank" class="cic-action">
                    Lihat di Maps
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="7" y1="17" x2="17" y2="7"/><polyline points="7 7 17 7 17 17"/></svg>
                </a>
            </div>

            <!-- Card: Social -->
            <div class="contact-info-card reveal reveal-d3">
                <div class="cic-icon-wrap cic-purple">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                </div>
                <div class="cic-label">Media Sosial</div>
                <div class="cic-value">@parkify.id</div>
                <div class="cic-desc">Ikuti kami untuk update terbaru, promo, dan info seputar smart parking di Indonesia.</div>
                <div class="cic-socials">
                    <a href="#" class="cic-social-btn" title="Instagram">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                    </a>
                    <a href="#" class="cic-social-btn" title="LinkedIn">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/></svg>
                    </a>
                    <a href="#" class="cic-social-btn" title="Twitter/X">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"/></svg>
                    </a>
                    <a href="#" class="cic-social-btn" title="Facebook">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- ══ MAP + FORM ══ -->
    <section class="map-form-section">
        <div class="mf-grid">

            <!-- LEFT: Map -->
            <div class="mf-map-col reveal">
                <div class="mf-map-header">
                    <span class="section-tag" style="margin-bottom:10px;">Lokasi Kami</span>
                    <h2 class="section-title" style="font-size:1.6rem; margin-bottom:6px;">Temukan <span>Parkify</span></h2>
                    <p class="mf-map-desc">Jl. Raya Tajur, Kp. Buntar, Kel. Muara Sari, Kec. Bogor Selatan, Kota Bogor.</p>
                </div>

                <div class="mf-map-frame">
                    <div class="mf-map-badge">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        Parkify HQ
                    </div>
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.1!2d106.8100!3d-6.6300!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c5e4d4b5f1b5%3A0x0!2sJl.+Raya+Tajur%2C+Bogor+Selatan!5e0!3m2!1sid!2sid!4v1699000000000!5m2!1sid!2sid"
                        width="100%"
                        height="100%"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        title="Lokasi Parkify">
                    </iframe>
                </div>

                <div class="mf-map-info-row">
                    <div class="mf-map-info-item">
                        <div class="mfi-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        </div>
                        <div>
                            <div class="mfi-label">Jam Operasional</div>
                            <div class="mfi-val">Senin – Jumat, 08.00 – 17.00</div>
                        </div>
                    </div>
                    <div class="mf-map-info-item">
                        <div class="mfi-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
                        </div>
                        <div>
                            <div class="mfi-label">Parkir Tersedia</div>
                            <div class="mfi-val">Area parkir gratis untuk tamu</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RIGHT: Form -->
            <div class="mf-form-col reveal reveal-d2">
                <div class="mf-form-card">
                    <div class="mf-form-header-inner">
                        <div class="mf-form-eyebrow">✦ Kirim Pesan</div>
                        <h3 class="mf-form-title">Ada yang bisa kami bantu?</h3>
                        <p class="mf-form-sub">Isi formulir di bawah ini dan tim kami akan segera menghubungi kamu.</p>
                    </div>

                    <div class="mf-topic-select">
                        <div class="mf-topic-label">Topik:</div>
                        <div class="mf-topics">
                            <button class="mf-topic active" data-topic="Pertanyaan Umum">Pertanyaan Umum</button>
                            <button class="mf-topic" data-topic="Kerjasama Bisnis">Kerjasama Bisnis</button>
                            <button class="mf-topic" data-topic="Dukungan Teknis">Dukungan Teknis</button>
                            <button class="mf-topic" data-topic="Lainnya">Lainnya</button>
                        </div>
                    </div>

                    <div class="mf-form-body">
                        <div class="mf-row-2">
                            <div class="mf-group">
                                <label class="mf-label">Nama Lengkap</label>
                                <input type="text" class="mf-input" id="mfName" placeholder="Contoh: Budi Santoso">
                            </div>
                            <div class="mf-group">
                                <label class="mf-label">Nomor WhatsApp</label>
                                <input type="tel" class="mf-input" id="mfPhone" placeholder="+62 8xx xxxx xxxx">
                            </div>
                        </div>
                        <div class="mf-group">
                            <label class="mf-label">Alamat Email</label>
                            <input type="email" class="mf-input" id="mfEmail" placeholder="email@example.com">
                        </div>
                        <div class="mf-group">
                            <label class="mf-label">Subjek</label>
                            <input type="text" class="mf-input" id="mfSubject" placeholder="Tulis subjek pesanmu...">
                        </div>
                        <div class="mf-group">
                            <label class="mf-label">Pesan</label>
                            <textarea class="mf-input mf-textarea" id="mfMessage" placeholder="Ceritakan kebutuhanmu secara detail agar kami bisa membantu lebih baik..."></textarea>
                        </div>

                        <button class="mf-submit" id="mfSubmit">
                            <span class="mf-submit-text">
                                Kirim via WhatsApp
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                            </span>
                            <span class="mf-submit-loading" style="display:none;">
                                <svg class="spin" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 12a9 9 0 1 1-6.219-8.56"/></svg>
                                Mengirim...
                            </span>
                        </button>

                        <div class="mf-toast" id="mfToast">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                            Pesan berhasil dikirim! Kami akan merespons dalam 1×24 jam.
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- ══ FAQ STRIP ══ -->
    <section class="faq-section">
        <div class="faq-inner">
            <div class="faq-left reveal">
                <span class="section-tag">FAQ</span>
                <h2 class="section-title" style="margin-top:8px; font-size:clamp(1.5rem,2.5vw,2rem)">Pertanyaan yang<br>Sering Ditanyakan</h2>
                <p style="font-size:.875rem; color:var(--gray); margin-top:12px; line-height:1.7; max-width:320px">Tidak menemukan jawaban yang kamu cari? Hubungi kami langsung.</p>
            </div>
            <div class="faq-list reveal reveal-d1">
                <div class="faq-item">
                    <button class="faq-q" onclick="toggleFaq(this)">
                        Apakah Parkify bisa diintegrasikan dengan sistem parkir yang sudah ada?
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                    <div class="faq-a">Ya, Parkify mendukung integrasi dengan berbagai sistem parkir existing melalui API dan protokol MQTT. Tim teknis kami siap membantu proses integrasi dari awal hingga selesai.</div>
                </div>
                <div class="faq-item">
                    <button class="faq-q" onclick="toggleFaq(this)">
                        Bagaimana cara mendaftarkan gedung saya sebagai mitra Parkify?
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                    <div class="faq-a">Hubungi kami melalui formulir di atas atau langsung via WhatsApp dengan topik "Kerjasama Bisnis". Tim partnership kami akan menjelaskan prosedur onboarding dan persyaratan teknis yang dibutuhkan.</div>
                </div>
                <div class="faq-item">
                    <button class="faq-q" onclick="toggleFaq(this)">
                        Apakah ada biaya untuk menggunakan sistem Parkify?
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                    <div class="faq-a">Parkify menawarkan beberapa paket layanan yang disesuaikan dengan kebutuhan. Untuk informasi harga dan paket berlangganan, silakan hubungi tim sales kami untuk mendapatkan penawaran yang tepat.</div>
                </div>
                <div class="faq-item">
                    <button class="faq-q" onclick="toggleFaq(this)">
                        Berapa lama proses instalasi perangkat IoT Parkify?
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                    <div class="faq-a">Proses instalasi biasanya membutuhkan waktu 3–7 hari kerja tergantung skala area parkir. Ini mencakup pemasangan sensor IoT, konfigurasi gateway, dan pengujian sistem secara menyeluruh.</div>
                </div>
            </div>
        </div>
    </section>

    
    @include('components.footer-landing')

    <div class="back-top">
        <a href="#">
            Kembali Ke Halaman Paling Atas
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="18 15 12 9 6 15"/></svg>
        </a>
    </div>
@endsection

@section('scripts')
<script>
    // ── Navbar scroll
    const nav = document.getElementById('navbar');
    window.addEventListener('scroll', () => {
        nav.classList.toggle('scrolled', window.scrollY > 20);
    });

    // ── Mobile menu
    const hamburger = document.getElementById('hamburger');
    const mobileMenu = document.getElementById('mobileMenu');
    const overlay   = document.getElementById('overlay');
    const closeMenu = document.getElementById('closeMenu');

    function openMenu()  { mobileMenu.classList.add('open'); overlay.classList.add('show'); document.body.style.overflow='hidden'; }
    function closeMenuFn(){ mobileMenu.classList.remove('open'); overlay.classList.remove('show'); document.body.style.overflow=''; }

    hamburger.addEventListener('click', openMenu);
    overlay.addEventListener('click', closeMenuFn);
    closeMenu.addEventListener('click', closeMenuFn);
    mobileMenu.querySelectorAll('a').forEach(a => a.addEventListener('click', closeMenuFn));

    // ── Scroll reveal
    const reveals = document.querySelectorAll('.reveal');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(e => {
            if (e.isIntersecting) { e.target.classList.add('visible'); observer.unobserve(e.target); }
        });
    }, { threshold: 0.12 });
    reveals.forEach(el => observer.observe(el));

    // ── Topic selector
    document.querySelectorAll('.mf-topic').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('.mf-topic').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
        });
    });

    // ── Contact form → WhatsApp
    const mfSubmit = document.getElementById('mfSubmit');
    const mfToast  = document.getElementById('mfToast');

    mfSubmit.addEventListener('click', function() {
        const name    = document.getElementById('mfName').value.trim();
        const phone   = document.getElementById('mfPhone').value.trim();
        const email   = document.getElementById('mfEmail').value.trim();
        const subject = document.getElementById('mfSubject').value.trim();
        const message = document.getElementById('mfMessage').value.trim();

        const activeTopic = document.querySelector('.mf-topic.active')?.dataset.topic || 'Pertanyaan Umum';

        if (!name || !email || !message) {
            mfSubmit.classList.add('shake');
            setTimeout(() => mfSubmit.classList.remove('shake'), 500);
            return;
        }

        // Show loading
        mfSubmit.querySelector('.mf-submit-text').style.display = 'none';
        mfSubmit.querySelector('.mf-submit-loading').style.display = 'flex';
        mfSubmit.disabled = true;

        const waPhone = '6289526333265';
        const text = `Halo Parkify 👋\n\n*Topik:* ${activeTopic}\n*Nama:* ${name}\n*No. HP:* ${phone || '-'}\n*Email:* ${email}\n*Subjek:* ${subject || '-'}\n\n*Pesan:*\n${message}`;
        const waURL = `https://wa.me/${waPhone}?text=${encodeURIComponent(text)}`;

        setTimeout(() => {
            window.open(waURL, '_blank');
            mfToast.classList.add('show');
            mfSubmit.querySelector('.mf-submit-text').style.display = 'flex';
            mfSubmit.querySelector('.mf-submit-loading').style.display = 'none';
            mfSubmit.disabled = false;
            setTimeout(() => mfToast.classList.remove('show'), 5000);
        }, 800);
    });

    // ── FAQ accordion
    function toggleFaq(btn) {
        const item   = btn.closest('.faq-item');
        const answer = item.querySelector('.faq-a');
        const isOpen = item.classList.contains('open');

        document.querySelectorAll('.faq-item.open').forEach(i => {
            i.classList.remove('open');
            i.querySelector('.faq-a').style.maxHeight = null;
        });

        if (!isOpen) {
            item.classList.add('open');
            answer.style.maxHeight = answer.scrollHeight + 'px';
        }
    }
</script>
@endsection