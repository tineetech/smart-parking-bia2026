@extends('layouts.main')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/tentangkami.css') }}">
@endsection

@section('content')

    @include('components.nav-landing')
    <!-- ══ HERO ══ -->
    <div class="about-hero-wrapper">
        <section class="about-hero">
            <div class="about-pin"></div>
            <div class="about-pin"></div>
            <div class="about-pin"></div>
            <div class="about-pin"></div>
            <div class="about-hero-content">
                <span class="hero-tag">Tentang Kami</span>
                <h1>Orang-orang di Balik<br>Park<span>ify</span></h1>
                <p>Kami adalah tim yang bersemangat menciptakan solusi parkir digital yang lebih cerdas, efisien, dan
                    menyenangkan untuk semua.</p>
                <div class="about-hero-stats">
                    <div class="ahs-item">
                        <div class="ahs-val">2026</div>
                        <div class="ahs-label">Direncanakan</div>
                    </div>
                    <div class="ahs-divider"></div>
                    <div class="ahs-item">
                        <div class="ahs-val">5</div>
                        <div class="ahs-label">Anggota Tim</div>
                    </div>
                    <div class="ahs-divider"></div>
                    <div class="ahs-item">
                        <div class="ahs-val">50+</div>
                        <div class="ahs-label">Gedung Mitra</div>
                    </div>
                    <div class="ahs-divider"></div>
                    <div class="ahs-item">
                        <div class="ahs-val">100K+</div>
                        <div class="ahs-label">Pengguna</div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- ══ MISSION & VALUES ══ -->
    <section class="mission-section">
        <div style="text-align:center; margin-bottom: 0;">
            <span class="section-tag reveal">Misi & Nilai</span>
            <h2 class="section-title reveal" style="margin-top:8px">Mengapa Kami Ada &<br>Apa yang Kami Perjuangkan</h2>
        </div>

        <div class="mission-grid">
            <div class="mission-text-col reveal">
                <h3>Kami percaya parkir<br>yang <span>cerdas</span> mengubah kota.</h3>
                <p>Parkify lahir dari frustrasi nyata — terlalu banyak waktu terbuang mencari tempat parkir. Kami membangun
                    teknologi yang membuat pengalaman ini menjadi mulus, transparan, dan bahkan menyenangkan.</p>
                <p>Setiap fitur yang kami bangun dimulai dari pertanyaan sederhana: <em>"Bagaimana ini membuat hidup
                        pengguna lebih mudah?"</em></p>
                <div class="mission-values">
                    <div class="mv-item">
                        <div class="mv-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#2563EB"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                            </svg>
                        </div>
                        <div class="mv-text">
                            <h4>Kepercayaan & Transparansi</h4>
                            <p>Data real-time yang akurat, harga yang jelas, tanpa biaya tersembunyi.</p>
                        </div>
                    </div>
                    <div class="mv-item">
                        <div class="mv-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#2563EB"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2" />
                            </svg>
                        </div>
                        <div class="mv-text">
                            <h4>Inovasi Tanpa Henti</h4>
                            <p>Kami terus bereksplorasi dengan teknologi IoT, AI, dan data untuk pengalaman terbaik.</p>
                        </div>
                    </div>
                    <div class="mv-item">
                        <div class="mv-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#2563EB"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                                <circle cx="9" cy="7" r="4" />
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                            </svg>
                        </div>
                        <div class="mv-text">
                            <h4>Komunitas & Dampak Nyata</h4>
                            <p>Kami membangun untuk masyarakat urban yang lebih produktif dan ramah lingkungan.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mission-visual-col reveal reveal-d2">
                <div class="mission-card-main">
                    <div class="mcm-inner">
                        <div class="mcm-eyebrow">✦ Visi Kami</div>
                        <div class="mcm-quote">
                            "Menjadi platform parkir #1 di Indonesia dengan <span>ekosistem digital</span> yang terintegrasi
                            penuh."
                        </div>
                        <div class="mcm-chips">
                            <span class="mcm-chip">IoT Sensor</span>
                            <span class="mcm-chip">AI Analytics</span>
                            <span class="mcm-chip">Real-Time Data</span>
                            <span class="mcm-chip">Smart City</span>
                            <span class="mcm-chip">Green Mobility</span>
                        </div>
                    </div>
                </div>
                <div class="mission-float-card">
                    <div class="mfc-label">Tingkat Kepuasan</div>
                    <div class="mfc-val">4.9 ★</div>
                    <div class="mfc-sub">▲ Rating pengguna</div>
                </div>
            </div>
        </div>
    </section>

    <!-- ══ TEAM SLIDER ══ -->
    <section class="team-section">
        <div class="team-header">
            <div class="team-header-left reveal">
                <span class="section-tag">Tim Kami</span>
                <h2 class="section-title" style="margin-top:8px">Kenali Team <span>Parkify</span></h2>
                <p style="font-size:.9rem; color:var(--gray); margin-top:8px; max-width:380px">Temukan orang-orang hebat di
                    balik sistem Parkify yang kamu gunakan setiap hari.</p>
            </div>
            <div class="team-nav-btns reveal reveal-d1">
                <button class="tnb" id="teamPrev" aria-label="Previous">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke-width="2.5"
                        stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="15 18 9 12 15 6" />
                    </svg>
                </button>
                <button class="tnb" id="teamNext" aria-label="Next">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke-width="2.5"
                        stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="9 18 15 12 9 6" />
                    </svg>
                </button>
            </div>
        </div>

        <div class="team-slider-outer reveal">
            <div class="team-slider-track py-10" id="teamTrack">

                <!-- Card 1 -->
                <div class="team-card" data-index="0" data-name="Justine" data-role="System Architect & IoT Developer"
                    data-bio="Berperan dalam perancangan arsitektur sistem Parkify mulai dari pengembangan website, integrasi IoT, hingga implementasi smart parking secara end-to-end. Fokus pada pengembangan alur sistem, business concept, komunikasi perangkat, automasi gerbang parkir, serta integrasi dashboard monitoring berbasis web dan perangkat pintar."
                    data-skills="System Architecture,IoT Development,Full Stack Web,MQTT Integration,Smart Parking,System Flow,API Development,Embedded Systems"
                    data-initials="JU">
                    <div class="tc-photo">
                        <div class="tc-photo-placeholder">
                            <img src="{{ asset('assets/img/team/justin.jpeg') }}"
                                style="transform: scale(1.3) translateY(20px)" class="" alt="">
                            <div class="initials">
                                <div class="tc-initials-badge">JU</div>
                            </div>
                        </div>
                        <span class="tc-role-badge">System Architect</span>
                    </div>
                    <div class="tc-body">
                        <div class="tc-name">Justine</div>
                        <div class="tc-role">System Architect & IoT Developer</div>
                        <div class="tc-bio">
                            Bertanggung jawab dalam pengembangan flow system, integrasi IoT, backend API, dashboard web,
                            serta implementasi sistem smart parking Parkify secara menyeluruh.
                        </div>
                        <div class="tc-socials">
                            <a href="#" class="tc-social-btn"><svg xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path
                                        d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z" />
                                    <rect x="2" y="9" width="4" height="12" />
                                    <circle cx="4" cy="4" r="2" />
                                </svg></a>
                            <a href="#" class="tc-social-btn"><svg xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <rect x="2" y="2" width="20" height="20" rx="5" ry="5" />
                                    <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z" />
                                    <line x1="17.5" y1="6.5" x2="17.51" y2="6.5" />
                                </svg></a>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="team-card" data-index="1" data-name="Rizky Febriansyah Pratama" data-role="UI/UX Designer"
                    data-bio="Berperan dalam perancangan antarmuka dan pengalaman pengguna Parkify, mulai dari penyusunan system design, alur navigasi aplikasi, hingga pembuatan mockup design smart parking yang modern, intuitif, dan mudah digunakan."
                    data-skills="UI Design,UX Research,Wireframing,Prototype Design,System Design,Figma,Website Mockup,User Experience"
                    data-initials="RP">
                    <div class="tc-photo">
                        <div class="tc-photo-placeholder">
                            <img src="{{ asset('assets/img/team/riski.jpeg') }}"
                                style="transform: scale(1.3) translateY(10px)" class="" alt="">
                            <div class="initials">
                                <div class="tc-initials-badge">RP</div>
                            </div>
                        </div>
                        <span class="tc-role-badge">UI/UX Designer</span>
                    </div>
                    <div class="tc-body">
                        <div class="tc-name">Rizky Febriansyah Pratama</div>
                        <div class="tc-role">UI/UX Designer</div>
                        <div class="tc-bio">
                            Bertanggung jawab dalam desain UI/UX, perancangan system flow interface, serta pembuatan mockup
                            dan prototype website Parkify agar lebih modern dan user-friendly.
                        </div>
                        <div class="tc-socials">
                            <a href="#" class="tc-social-btn"><svg xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path
                                        d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z" />
                                    <rect x="2" y="9" width="4" height="12" />
                                    <circle cx="4" cy="4" r="2" />
                                </svg></a>
                            <a href="#" class="tc-social-btn"><svg xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path
                                        d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22" />
                                </svg></a>
                        </div>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="team-card" data-index="2" data-name="Muhamad Bardan Sulaiman" data-role="Mockup Designer"
                    data-bio="Berperan dalam perancangan mockup dan prototype produk Parkify, termasuk implementasi visual prototype fisik serta membantu pengembangan konsep sistem bersama tim. Turut mendukung proses brainstorming, penataan prototype, dan solusi implementasi agar sistem smart parking dapat direalisasikan secara efektif."
                    data-skills="Mockup Design,Prototype Development,Product Concept,Prototype Implementation,Creative Support,System Concept,Layout Planning"
                    data-initials="BS">
                    <div class="tc-photo">
                        <div class="tc-photo-placeholder">
                            <img src="{{ asset('assets/img/team/bardan.jpeg') }}"
                                style="transform: scale(1.3) translateY(10px)" class="" alt="">
                            <div class="initials">
                                <div class="tc-initials-badge">BS</div>
                            </div>
                        </div>
                        <span class="tc-role-badge">Mockup Designer</span>
                    </div>
                    <div class="tc-body">
                        <div class="tc-name">Muhamad Bardan Sulaiman</div>
                        <div class="tc-role">Mockup Designer</div>
                        <div class="tc-bio">
                            Membantu perancangan mockup, prototype produk, implementasi visual sistem, serta mendukung
                            pengembangan konsep dan solusi smart parking Parkify.sdifdsjfojsddsfs
                        </div>
                        <div class="tc-socials">
                            <a href="#" class="tc-social-btn"><svg xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path
                                        d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z" />
                                    <rect x="2" y="9" width="4" height="12" />
                                    <circle cx="4" cy="4" r="2" />
                                </svg></a>
                            <a href="#" class="tc-social-btn"><svg xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <rect x="2" y="2" width="20" height="20" rx="5" ry="5" />
                                    <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z" />
                                    <line x1="17.5" y1="6.5" x2="17.51" y2="6.5" />
                                </svg></a>
                        </div>
                    </div>
                </div>
                <div class="team-card" data-index="3" data-name="Ginda Adistyo" data-role="Wiring Developer"
                    data-bio="Bertanggung jawab dalam penyusunan jalur wiring dan instalasi perangkat Smart Parking, termasuk pemasangan sensor, modul kontrol, catu daya, serta pengujian koneksi antar perangkat. Mendukung proses implementasi hardware dan memastikan sistem elektronik bekerja secara stabil untuk menunjang operasional Smart Parking berbasis IoT."
                    data-skills="Electrical Wiring,Electronic Assembly,Sensor Installation,Circuit Wiring,Power Management,Hardware Maintenance,Hardware Troubleshooting,IoT Devices,PCB Assembly,Technical Support"
                    data-initials="GA">
                    <div class="tc-photo">
                        <div class="tc-photo-placeholder">
                            
                            <div class="tc-photo-grid">
                                <img src="{{ asset('assets/img/team/ginda.jpeg') }}"
                                    style="transform: scale(1.3) translateY(-40px)" class="" alt="">
                            </div>
                            <div class="initials">
                                <div class="tc-initials-badge">GA</div>
                            </div>
                        </div>
                        <span class="tc-role-badge">Wiring Developer</span>
                    </div>
                    <div class="tc-body">
                        <div class="tc-name">Ginda Adistyo</div>
                        <div class="tc-role">Wiring Developer</div>
                        <div class="tc-bio">
                            Bertanggung jawab dalam penyusunan jalur wiring dan instalasi perangkat Smart Parking, termasuk pemasangan sensor, modul kontrol, catu daya, serta pengujian koneksi
                        </div>
                        <div class="tc-socials">
                            <a href="#" class="tc-social-btn"><svg xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path
                                        d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z" />
                                    <rect x="2" y="9" width="4" height="12" />
                                    <circle cx="4" cy="4" r="2" />
                                </svg></a>
                            <a href="#" class="tc-social-btn"><svg xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <rect x="2" y="2" width="20" height="20" rx="5" ry="5" />
                                    <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z" />
                                    <line x1="17.5" y1="6.5" x2="17.51" y2="6.5" />
                                </svg></a>
                        </div>
                    </div>
                </div>
                <!-- Card 4 -->
                <div class="team-card" data-index="4" data-name="Ahmad Nur Khaliq" data-role="Prototype Development Support"
                    data-bio="Berperan dalam mendukung pengembangan prototype Parkify melalui penyusunan komponen, penataan tata letak mockup, serta perakitan elemen fisik sistem smart parking. Membantu memastikan prototype dapat menggambarkan alur dan konsep sistem secara efektif sehingga mendukung proses demonstrasi dan presentasi produk."
                    data-skills="Prototype Development,Mockup Assembly,Layout Planning,Component Placement,Physical Prototype,Material Management,Creative Support,Visual Representation,Teamwork,Smart Parking Concept"
                    data-initials="AK">
                    <div class="tc-photo">
                        <div class="tc-photo-placeholder">
                            
                            <div class="tc-photo-grid">
                                <img src="{{ asset('assets/img/team/kolik.jpeg') }}"
                                    style="transform: scale(1.3) translateY(-40px)" class="" alt="">
                            </div>
                            <div class="initials">
                                <div class="tc-initials-badge">AK</div>
                            </div>
                        </div>
                        <span class="tc-role-badge">Mockup Developer & Assistant Mockup Designer</span>
                    </div>
                    <div class="tc-body">
                        <div class="tc-name">Ahmad Nur Khaliq</div>
                        <div class="tc-role">Mockup Developer</div>
                        <div class="tc-bio">
                            Berperan dalam mendukung pengembangan prototype Parkify melalui penyusunan komponen, penataan tata letak mockup, serta perakitan elemen fisik sistem smart parking.
                        </div>
                        <div class="tc-socials">
                            <a href="#" class="tc-social-btn"><svg xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path
                                        d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z" />
                                    <rect x="2" y="9" width="4" height="12" />
                                    <circle cx="4" cy="4" r="2" />
                                </svg></a>
                            <a href="#" class="tc-social-btn"><svg xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path
                                        d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22" />
                                </svg></a>
                        </div>
                    </div>
                </div>
            </div><!-- end track -->
        </div><!-- end outer -->

        <!-- Dots -->
        <div class="team-dots" id="teamDots"></div>

        <!-- Detail Panel -->
        <div class="team-detail-panel" id="teamDetailPanel">
            <div class="tdp-visual">
                <div class="tdp-visual-glow"></div>
                <div class="tdp-avatar" id="tdpAvatar">RA</div>
            </div>
            <div class="tdp-info">
                <button class="tdp-close-btn" id="tdpClose">✕</button>
                <div class="tdp-eyebrow" id="tdpEyebrow">Tim Parkify</div>
                <div class="tdp-name" id="tdpName">Rizky Aditya</div>
                <div class="tdp-role" id="tdpRole">Co-founder & CEO</div>
                <div class="tdp-bio" id="tdpBio">Bio teks.</div>
                <div class="tdp-skills" id="tdpSkills"></div>
                <div class="tdp-socials">
                    <a href="#" class="tdp-social"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z" />
                            <rect x="2" y="9" width="4" height="12" />
                            <circle cx="4" cy="4" r="2" />
                        </svg></a>
                    <a href="#" class="tdp-social"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path
                                d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z" />
                        </svg></a>
                    <a href="#" class="tdp-social"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path
                                d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22" />
                        </svg></a>
                </div>
            </div>
        </div>

    </section>

    <!-- ══ CONTACT CTA ══ -->
    <section class="about-contact" id="kontak">
        <div class="about-contact-inner reveal">
            <div class="ac-text">
                <span class="section-tag">Hubungi Tim Kami</span>
                <h2>Punya pertanyaan?<br><span>Kami siap membantu.</span></h2>
                <p>Sampaikan pertanyaanmu seputar sistem manajemen parkir, integrasi sistem, atau kolaborasi platform. Tim
                    kami akan merespons dalam waktu 1×24 jam.</p>

                <div style="display:flex; gap:16px; margin-top:28px; flex-wrap:wrap;">
                    <div
                        style="display:flex;align-items:center;gap:10px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:10px;padding:12px 16px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                            fill="none" stroke="#60A5FA" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path
                                d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.99 12a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.92 1h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 8.91a16 16 0 0 0 5.99 5.99l1.07-1.07a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z" />
                        </svg>
                        <div>
                            <div
                                style="font-size:.58rem;color:rgba(255,255,255,.3);letter-spacing:.8px;text-transform:uppercase;">
                                Telepon</div>
                            <div style="font-size:.78rem;color:rgba(255,255,255,.75);font-weight:600;">+62 895 2633 3265
                            </div>
                        </div>
                    </div>
                    <div
                        style="display:flex;align-items:center;gap:10px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:10px;padding:12px 16px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                            fill="none" stroke="#60A5FA" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                            <polyline points="22,6 12,13 2,6" />
                        </svg>
                        <div>
                            <div
                                style="font-size:.58rem;color:rgba(255,255,255,.3);letter-spacing:.8px;text-transform:uppercase;">
                                Email</div>
                            <div style="font-size:.78rem;color:rgba(255,255,255,.75);font-weight:600;">parkify@gmail.com
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="ac-form">
                <div class="ac-input-row">
                    <div class="ac-form-group">
                        <input type="text" class="ac-input" placeholder="Nama lengkap" id="acName">
                    </div>
                    <div class="ac-form-group">
                        <input type="email" class="ac-input" placeholder="Alamat email" id="acEmail">
                    </div>
                </div>
                <div class="ac-form-group">
                    <input type="text" class="ac-input" placeholder="Subjek" id="acSubject">
                </div>
                <div class="ac-form-group">
                    <textarea class="ac-input" placeholder="Tulis pesanmu di sini..." id="acMessage"></textarea>
                </div>
                <button class="ac-submit" id="acSubmit">
                    Kirim Pesan
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="22" y1="2" x2="11" y2="13" />
                        <polygon points="22 2 15 22 11 13 2 9 22 2" />
                    </svg>
                </button>
                <div class="ac-toast" id="acToast">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                        stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12" />
                    </svg>
                    Pesan terkirim! Kami akan merespons dalam 1×24 jam.
                </div>
            </div>
        </div>
    </section>

    
    @include('components.footer-landing')

    <div class="back-top">
        <a href="#">
            Kembali Ke Halaman Paling Atas
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="18 15 12 9 6 15" />
            </svg>
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
        const overlay = document.getElementById('overlay');
        const closeMenu = document.getElementById('closeMenu');

        function openMenu() {
            mobileMenu.classList.add('open');
            overlay.classList.add('show');
            document.body.style.overflow = 'hidden';
        }

        function closeMenuFn() {
            mobileMenu.classList.remove('open');
            overlay.classList.remove('show');
            document.body.style.overflow = '';
        }
        hamburger.addEventListener('click', openMenu);
        overlay.addEventListener('click', closeMenuFn);
        closeMenu.addEventListener('click', closeMenuFn);
        mobileMenu.querySelectorAll('a').forEach(a => a.addEventListener('click', closeMenuFn));

        // ── Scroll reveal
        const reveals = document.querySelectorAll('.reveal');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    e.target.classList.add('visible');
                    observer.unobserve(e.target);
                }
            });
        }, {
            threshold: 0.12
        });
        reveals.forEach(el => observer.observe(el));

        // ══════════════════════════════════
        //  TEAM SLIDER
        // ══════════════════════════════════
        const track = document.getElementById('teamTrack');
        const cards = Array.from(track.querySelectorAll('.team-card'));
        const dotsContainer = document.getElementById('teamDots');
        const detailPanel = document.getElementById('teamDetailPanel');
        const tdpName = document.getElementById('tdpName');
        const tdpRole = document.getElementById('tdpRole');
        const tdpBio = document.getElementById('tdpBio');
        const tdpSkills = document.getElementById('tdpSkills');
        const tdpAvatar = document.getElementById('tdpAvatar');
        const tdpClose = document.getElementById('tdpClose');

        let currentSlide = 0;
        let visibleCount = 4;
        let activeCard = null;

        function getVisibleCount() {
            if (window.innerWidth <= 768) return 1;
            if (window.innerWidth <= 1024) return 2;
            return 4;
        }

        function totalSlides() {
            return Math.ceil(cards.length / visibleCount);
        }

        function buildDots() {
            dotsContainer.innerHTML = '';
            const n = totalSlides();
            for (let i = 0; i < n; i++) {
                const dot = document.createElement('button');
                dot.className = 'tdot' + (i === currentSlide ? ' active' : '');
                dot.addEventListener('click', () => goTo(i));
                dotsContainer.appendChild(dot);
            }
        }

        function goTo(idx) {
            visibleCount = getVisibleCount();
            const max = totalSlides() - 1;
            currentSlide = Math.max(0, Math.min(idx, max));
            const cardWidth = cards[0].offsetWidth + 24;
            track.style.transform = `translateX(-${currentSlide * visibleCount * cardWidth}px)`;
            document.querySelectorAll('.tdot').forEach((d, i) => d.classList.toggle('active', i === currentSlide));
        }

        function prev() {
            goTo(currentSlide - 1);
        }

        function next() {
            goTo(currentSlide + 1);
        }

        document.getElementById('teamPrev').addEventListener('click', prev);
        document.getElementById('teamNext').addEventListener('click', next);

        // Swipe
        let touchStartX = 0;
        track.addEventListener('touchstart', e => {
            touchStartX = e.touches[0].clientX;
        });
        track.addEventListener('touchend', e => {
            const diff = touchStartX - e.changedTouches[0].clientX;
            if (Math.abs(diff) > 40) diff > 0 ? next() : prev();
        });

        // ── Show detail on card click
        function showDetail(card) {
            cards.forEach(c => c.classList.remove('active-card'));
            card.classList.add('active-card');
            activeCard = card;

            const name = card.dataset.name;
            const role = card.dataset.role;
            const bio = card.dataset.bio;
            const skills = card.dataset.skills.split(',');
            const initials = card.dataset.initials;

            tdpName.textContent = name;
            tdpRole.textContent = role;
            tdpBio.textContent = bio;
            tdpAvatar.textContent = initials;

            tdpSkills.innerHTML = '';
            skills.forEach(s => {
                const span = document.createElement('span');
                span.className = 'tdp-skill';
                span.textContent = s.trim();
                tdpSkills.appendChild(span);
            });

            detailPanel.classList.add('visible');
            setTimeout(() => detailPanel.scrollIntoView({
                behavior: 'smooth',
                block: 'nearest'
            }), 100);
        }

        function closeDetail() {
            detailPanel.classList.remove('visible');
            cards.forEach(c => c.classList.remove('active-card'));
            activeCard = null;
        }

        cards.forEach(card => {
            card.addEventListener('click', () => {
                if (card.classList.contains('active-card')) {
                    closeDetail();
                } else {
                    showDetail(card);
                }
            });
        });

        tdpClose.addEventListener('click', closeDetail);

        // ── Init
        function init() {
            visibleCount = getVisibleCount();
            buildDots();
            goTo(0);
        }

        window.addEventListener('resize', init);
        init();

        // ══════════════════════════════════
        //  CONTACT FORM
        // ══════════════════════════════════
        const acSubmit = document.getElementById('acSubmit');
        const acToast = document.getElementById('acToast');

        acSubmit.addEventListener('click', function() {

            const name = document.getElementById('acName').value;
            const email = document.getElementById('acEmail').value;
            const subject = document.getElementById('acSubject').value;
            const message = document.getElementById('acMessage').value;

            // GANTI DENGAN NOMOR WA KAMU
            const phone = '6289526333265';

            const text =
                `Halo Parkify 👋

Nama: ${name}
Email: ${email}
Subjek: ${subject}

Pesan:
${message}`;

            const encodedText = encodeURIComponent(text);

            const whatsappURL = `https://wa.me/${phone}?text=${encodedText}`;

            acToast.classList.add('show');

            setTimeout(() => {
                window.open(whatsappURL, '_blank');
                acToast.classList.remove('show');
            }, 500);
        });
    </script>
@endsection
