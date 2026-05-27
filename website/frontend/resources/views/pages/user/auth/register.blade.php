@extends('layouts.main')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/auth.css') }}">
@endsection

@section('content')
    <div class="page-wrap">

        <!-- FORM SIDE -->
        <div class="form-side">


            <div class="tab-row">
                <button class="tab-btn " onclick="window.location.href = '{{ route('user.login') }}'">Masuk</button>
                <button class="tab-btn active" onclick="window.location.href = '{{ route('user.register') }}'">Daftar</button>
            </div>

            <!-- LOGIN PANEL -->
            <div id="panel-login" class="panel">
                <p class="heading">Selamat datang kembali!</p>
                <p class="subtext">Masukkan kredensial Anda untuk mengakses akun</p>

                <div class="field-group">
                    <label class="field-label">Alamat email</label>
                    <input required class="field-input" type="email" placeholder="Masukkan email Anda" />
                </div>

                <div class="field-group">
                    <div class="row-inline">
                        <label class="field-label" style="margin-bottom:0">Kata sandi</label>
                        <a class="forgot-link" href="#">Lupa kata sandi?</a>
                    </div>
                    <input required class="field-input" type="password" placeholder="Masukkan kata sandi" style="margin-top:7px" />
                </div>

                <label class="remember-row">
                    <input type="checkbox" /> Ingat saya selama 30 hari
                </label>

                <button class="btn-primary">Masuk</button>

                <div class="divider">
                    <div class="divider-line"></div>
                    <span class="divider-text">atau</span>
                    <div class="divider-line"></div>
                </div>

                <div class="social-row">
                    <button class="btn-social">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                            <path
                                d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"
                                fill="#4285F4" />
                            <path
                                d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"
                                fill="#34A853" />
                            <path
                                d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z"
                                fill="#FBBC05" />
                            <path
                                d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"
                                fill="#EA4335" />
                        </svg>
                        Masuk dengan Google
                    </button>
                    <button class="btn-social">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="#111827">
                            <path
                                d="M17.05 20.28c-.98.95-2.05.8-3.08.35-1.09-.46-2.09-.48-3.24 0-1.44.62-2.2.44-3.06-.35C2.79 15.25 3.51 7.7 9.05 7.42c1.3.07 2.21.74 2.98.8 1.14-.23 2.24-.93 3.44-.84 1.46.12 2.56.66 3.28 1.67-3.01 1.82-2.29 5.79.28 6.91-.57 1.55-1.3 3.08-2 4.32zM12.03 7.25c-.15-2.23 1.66-4.07 3.74-4.25.29 2.58-2.34 4.5-3.74 4.25z" />
                        </svg>
                        Masuk dengan Apple
                    </button>
                </div>

                <p class="footer-text">Belum punya akun? <a class="footer-link" onclick="switchTab('register')">Buat
                        sekarang</a></p>
            </div>

            <!-- REGISTER PANEL -->
            <div id="panel-register" class="panel active">
                <p class="heading">Buat akun baru</p>
                <p class="subtext">Isi data diri Anda untuk mulai menggunakan layanan</p>

                <form action="{{ route('user.register.store') }}" method="POST">
                    @csrf

                    <div class="name-row">
                        <div class="field-group">
                            <label class="field-label">Nama depan</label>
                            <input required class="field-input" type="text" name="nama_depan" placeholder="Nama depan" />
                            @error('nama_depan')
                                <span style="color:red; font-size:12px;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="field-group">
                            <label class="field-label">Nama belakang</label>
                            <input required class="field-input" type="text" name="nama_belakang" placeholder="Nama belakang" />
                            @error('nama_belakang')
                                <span style="color:red; font-size:12px;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="field-group">
                        <label class="field-label">Alamat email</label>
                        <input required class="field-input" type="email" name="email" placeholder="Masukkan email Anda" />
                        @error('email')
                            <span style="color:red; font-size:12px;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="field-group">
                        <label class="field-label">Kata sandi</label>
                        <input required class="field-input" type="password" name="password"
                            placeholder="Buat kata sandi (min. 8 karakter)" />
                        @error('password')
                            <span style="color:red; font-size:12px;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="field-group" style="margin-bottom:20px">
                        <label class="field-label">Konfirmasi kata sandi</label>
                        <input required class="field-input" type="password" name="password_confirmation"
                            placeholder="Ulangi kata sandi" />
                    </div>

                    <p class="terms-text">
                        Dengan mendaftar, Anda menyetujui <a href="#">Syarat &amp; Ketentuan</a> dan <a
                            href="#">Kebijakan Privasi</a> kami
                    </p>
                    <button class="btn-primary" type="submit">Buat Akun</button>

                </form>


                <div class="divider">
                    <div class="divider-line"></div>
                    <span class="divider-text">atau</span>
                    <div class="divider-line"></div>
                </div>

                <div class="social-row">
                    <button class="btn-social">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                            <path
                                d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"
                                fill="#4285F4" />
                            <path
                                d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"
                                fill="#34A853" />
                            <path
                                d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z"
                                fill="#FBBC05" />
                            <path
                                d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"
                                fill="#EA4335" />
                        </svg>
                        Daftar dengan Google
                    </button>
                    <button class="btn-social">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="#111827">
                            <path
                                d="M17.05 20.28c-.98.95-2.05.8-3.08.35-1.09-.46-2.09-.48-3.24 0-1.44.62-2.2.44-3.06-.35C2.79 15.25 3.51 7.7 9.05 7.42c1.3.07 2.21.74 2.98.8 1.14-.23 2.24-.93 3.44-.84 1.46.12 2.56.66 3.28 1.67-3.01 1.82-2.29 5.79.28 6.91-.57 1.55-1.3 3.08-2 4.32zM12.03 7.25c-.15-2.23 1.66-4.07 3.74-4.25.29 2.58-2.34 4.5-3.74 4.25z" />
                        </svg>
                        Daftar dengan Apple
                    </button>
                </div>

                <p class="footer-text">Sudah punya akun? <a class="footer-link" onclick="switchTab('login')">Masuk di
                        sini</a></p>
            </div>
        </div>

        <!-- MAP SIDE -->
        <div class="map-side">
            <svg class="map-bg" viewBox="0 0 640 900" xmlns="http://www.w3.org/2000/svg"
                preserveAspectRatio="xMidYMid slice">
                <rect width="640" height="900" fill="#1c1c1e" />
                <g stroke="#252530" stroke-width="1" fill="none">
                    <line x1="0" y1="80" x2="640" y2="80" />
                    <line x1="0" y1="160" x2="640" y2="160" />
                    <line x1="0" y1="240" x2="640" y2="240" />
                    <line x1="0" y1="320" x2="640" y2="320" />
                    <line x1="0" y1="400" x2="640" y2="400" />
                    <line x1="0" y1="480" x2="640" y2="480" />
                    <line x1="0" y1="560" x2="640" y2="560" />
                    <line x1="0" y1="640" x2="640" y2="640" />
                    <line x1="0" y1="720" x2="640" y2="720" />
                    <line x1="0" y1="800" x2="640" y2="800" />
                    <line x1="80" y1="0" x2="80" y2="900" />
                    <line x1="160" y1="0" x2="160" y2="900" />
                    <line x1="240" y1="0" x2="240" y2="900" />
                    <line x1="320" y1="0" x2="320" y2="900" />
                    <line x1="400" y1="0" x2="400" y2="900" />
                    <line x1="480" y1="0" x2="480" y2="900" />
                    <line x1="560" y1="0" x2="560" y2="900" />
                </g>
                <g stroke="#333340" stroke-width="7" fill="none" stroke-linecap="round">
                    <path d="M0,210 Q100,195 220,200 Q340,205 460,190 Q560,178 640,185" />
                    <path d="M0,360 Q120,348 250,355 Q380,362 500,350 Q580,342 640,348" />
                    <path d="M0,520 Q100,510 220,517 Q360,524 500,512 Q580,506 640,514" />
                    <path d="M155,0 Q160,150 158,330 Q156,510 160,700 Q163,820 160,900" />
                    <path d="M400,0 Q405,130 402,300 Q399,480 403,660 Q406,790 403,900" />
                    <path d="M540,0 Q545,160 542,350 Q539,540 543,720 Q546,820 543,900" />
                </g>
                <g stroke="#2e2e3c" stroke-width="3" fill="none" stroke-linecap="round">
                    <path d="M0,130 Q160,124 320,130 Q480,136 640,128" />
                    <path d="M0,280 Q140,273 280,280 Q420,287 560,278 Q610,274 640,280" />
                    <path d="M0,440 Q120,433 240,440 Q380,447 520,438 Q590,433 640,440" />
                    <path d="M0,600 Q200,593 400,600 Q540,606 640,598" />
                    <path d="M0,680 Q200,673 400,680 Q540,686 640,678" />
                    <path d="M70,0 Q75,225 72,450 Q69,675 73,900" />
                    <path d="M270,0 Q275,200 272,400 Q269,600 273,800 Q275,860 272,900" />
                    <path d="M470,0 Q475,200 472,420 Q469,640 473,850 Q475,876 472,900" />
                </g>
                <g stroke="#272733" stroke-width="1.5" fill="none">
                    <path d="M0,55 Q320,50 640,55" />
                    <path d="M0,100 Q320,96 640,102" />
                    <path d="M0,175 Q320,170 640,176" />
                    <path d="M0,250 Q320,245 640,251" />
                    <path d="M0,305 Q320,300 640,306" />
                    <path d="M0,390 Q320,385 640,391" />
                    <path d="M0,460 Q320,455 640,461" />
                    <path d="M0,560 Q320,555 640,561" />
                    <path d="M30,0 Q33,450 30,900" />
                    <path d="M110,0 Q113,450 110,900" />
                    <path d="M205,0 Q208,450 205,900" />
                    <path d="M340,0 Q343,450 340,900" />
                    <path d="M440,0 Q443,450 440,900" />
                    <path d="M510,0 Q513,450 510,900" />
                    <path d="M575,0 Q578,450 575,900" />
                    <path d="M625,0 Q628,450 625,900" />
                </g>
                <g fill="#252530">
                    <rect x="35" y="100" width="28" height="20" rx="2" />
                    <rect x="70" y="108" width="40" height="14" rx="2" />
                    <rect x="118" y="100" width="24" height="22" rx="2" />
                    <rect x="175" y="106" width="50" height="16" rx="2" />
                    <rect x="235" y="100" width="30" height="22" rx="2" />
                    <rect x="280" y="107" width="55" height="15" rx="2" />
                    <rect x="360" y="102" width="28" height="20" rx="2" />
                    <rect x="418" y="108" width="60" height="14" rx="2" />
                    <rect x="502" y="100" width="30" height="22" rx="2" />
                    <rect x="565" y="105" width="48" height="17" rx="2" />
                    <rect x="35" y="265" width="22" height="28" rx="2" />
                    <rect x="80" y="270" width="55" height="22" rx="2" />
                    <rect x="188" y="262" width="36" height="30" rx="2" />
                    <rect x="244" y="268" width="50" height="24" rx="2" />
                    <rect x="370" y="265" width="18" height="28" rx="2" />
                    <rect x="420" y="270" width="60" height="22" rx="2" />
                    <rect x="515" y="262" width="40" height="30" rx="2" />
                    <rect x="578" y="268" width="38" height="24" rx="2" />
                    <rect x="35" y="420" width="50" height="22" rx="2" />
                    <rect x="100" y="428" width="32" height="14" rx="2" />
                    <rect x="178" y="415" width="55" height="26" rx="2" />
                    <rect x="310" y="420" width="62" height="22" rx="2" />
                    <rect x="415" y="416" width="42" height="26" rx="2" />
                    <rect x="470" y="422" width="54" height="20" rx="2" />
                    <rect x="548" y="415" width="60" height="27" rx="2" />
                    <rect x="35" y="580" width="45" height="14" rx="2" />
                    <rect x="220" y="578" width="32" height="18" rx="2" />
                    <rect x="350" y="580" width="60" height="14" rx="2" />
                    <rect x="500" y="576" width="42" height="20" rx="2" />
                    <rect x="35" y="660" width="65" height="18" rx="2" />
                    <rect x="200" y="655" width="45" height="24" rx="2" />
                    <rect x="370" y="660" width="55" height="18" rx="2" />
                    <rect x="510" y="654" width="40" height="26" rx="2" />
                </g>
                <g fill="#5a5a72" font-family="system-ui,sans-serif" font-size="9.5" letter-spacing="1.8"
                    font-weight="500">
                    <text x="42" y="72">TANAH SAREAL</text>
                    <text x="295" y="152">SEMPUR</text>
                    <text x="430" y="72">CIBOGOR</text>
                    <text x="88" y="238">PALEDANG</text>
                    <text x="340" y="232">GUDANG</text>
                    <text x="42" y="318">BABAKAN</text>
                    <text x="440" y="322">TEGALLEGA</text>
                    <text x="175" y="393">PABATON</text>
                    <text x="418" y="393">KEBON KELAPA</text>
                    <text x="88" y="462">KEDUNGHALANG</text>
                    <text x="390" y="464">BONDONGAN</text>
                    <text x="200" y="548">EMPANG</text>
                    <text x="80" y="628">BATUTULIS</text>
                    <text x="360" y="625">SUKASARI</text>
                </g>
                <g fill="#8080a0" font-family="system-ui,sans-serif" font-size="20" font-weight="600"
                    letter-spacing="0.5">
                    <text x="240" y="450">Bogor</text>
                </g>
                <circle cx="320" cy="440" r="28" fill="#2563EB" opacity="0.07" />
                <circle cx="320" cy="440" r="16" fill="#2563EB" opacity="0.15" />
                <circle cx="320" cy="440" r="6" fill="#2563EB" />
                <circle cx="320" cy="440" r="2.5" fill="#ffffff" />
            </svg>

            <div class="app-badge"><img src="{{ asset('assets/img/logo-round.png') }}" class="w-[100px]" alt="">
            </div>
        </div>

    </div>

    <script>
        function switchTab(tab) {
            if (tab === 'login') window.location.href = `{{ route('user.login') }}`
            if (tab === 'register') window.location.href = `{{ route('user.register') }}`
        }
    </script>
@endsection
