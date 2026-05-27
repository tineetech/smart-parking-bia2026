<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>SmartPark – Booking Slot Parkir</title>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"/>
<style>
  *{font-family:'Plus Jakarta Sans',sans-serif;}
  html,body{margin:0;padding:0;width:100%;min-height:100vh;background:#f0f2f5;}

  @keyframes floatCar{0%,100%{transform:translateY(0);}50%{transform:translateY(-14px);}}
  .car-float{animation:floatCar 4s ease-in-out infinite;}

  @keyframes fadeUp{from{opacity:0;transform:translateY(28px);}to{opacity:1;transform:translateY(0);}}
  .fade-up{opacity:0;animation:fadeUp .65s ease forwards;}
  .d1{animation-delay:.1s}.d2{animation-delay:.25s}.d3{animation-delay:.4s}.d4{animation-delay:.55s}.d5{animation-delay:.7s}

  @keyframes scrollLogos{0%{transform:translateX(0);}100%{transform:translateX(-50%);}}
  .logos-track{display:flex;gap:3rem;animation:scrollLogos 14s linear infinite;width:max-content;}

  @keyframes pulseRing{0%{box-shadow:0 0 0 0 rgba(37,99,235,.4);}70%{box-shadow:0 0 0 16px rgba(37,99,235,0);}100%{box-shadow:0 0 0 0 rgba(37,99,235,0);}}
  .cta-pulse{animation:pulseRing 2.5s ease-in-out infinite;}
  .cta-pulse:hover{animation:none;filter:brightness(1.08);}
  .cta-pulse:active{transform:scale(.97);}

  .fc{transition:transform .2s ease,box-shadow .2s ease;}
  .fc:hover{transform:translateY(-3px);box-shadow:0 10px 28px rgba(0,0,0,.1);}

  .hl{background:#2563EB;color:#fff;border-radius:10px;padding:0 10px 3px;display:inline-block;}
</style>
</head>
<body>

<!-- ======================================================
     MOBILE (< lg)
======================================================= -->
<div class="lg:hidden w-full min-h-screen flex flex-col bg-[#f0f2f5]">

  <!-- Hero area: dark bg with real car image -->
  <div class="relative w-full overflow-hidden bg-[#0d1117]" style="min-height:180px">
    <!-- Gradient fade bottom -->
    <div class="absolute inset-x-0 bottom-0 h-24 z-10" style="background:linear-gradient(to bottom,transparent,#f0f2f5)"></div>

    <!-- App logo badge -->
    <div class="fade-up absolute top-5 right-5 z-20 w-14 h-14 bg-white rounded-2xl shadow-lg flex items-center justify-center">
      <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center">
        <span class="text-white font-black text-xl">P</span>
      </div>
    </div>

    <!-- Real car image -->
    <div class="car-float w-full flex items-end justify-center pt-8 pb-6 px-4">
      <img
          src="{{ asset('assets/img/car1.png') }}"
        alt="Smart parking car"
        class="w-full max-w-[820px] object-contain drop-shadow-2xl"
        style="max-height:220px;object-position:center bottom;"
      />
    </div>
  </div>

  <!-- Content -->
  <div class="flex-1 px-6 py-6 flex flex-col gap-5">

    <!-- Heading -->
    <div class="fade-up d1">
      <p class="text-gray-400 text-xs font-semibold uppercase tracking-widest mb-2">Smart Parking Solutions</p>
      <h1 class="text-[27px] font-black text-gray-900 leading-tight">
        Mulai Rasakan<br/>Pengalaman Parkir<br/>yang <span class="hl">Menarik</span>!
      </h1>
    </div>

    <!-- Feature cards horizontal -->
    <div class="fade-up d2 flex gap-3 overflow-x-auto pb-1" style="scrollbar-width:none">
      <div class="fc min-w-[155px] bg-white rounded-2xl p-4 border border-gray-100 flex-shrink-0">
        <div class="w-9 h-9 rounded-xl bg-blue-50 flex items-center justify-center mb-3">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
        </div>
        <p class="font-bold text-gray-800 text-[13px] mb-1">Akses Cepat & Mudah</p>
        <p class="text-gray-400 text-[11px] leading-relaxed">Masuk area parkir dengan sistem <strong class="text-gray-600">digital</strong> modern & minim <strong class="text-gray-600">antrean</strong>.</p>
      </div>
      <div class="fc min-w-[155px] bg-white rounded-2xl p-4 border border-gray-100 flex-shrink-0">
        <div class="w-9 h-9 rounded-xl bg-orange-50 flex items-center justify-center mb-3">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#F97316" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
        </div>
        <p class="font-bold text-gray-800 text-[13px] mb-1">Efisiensi Waktu</p>
        <p class="text-gray-400 text-[11px] leading-relaxed">Hemat <strong class="text-gray-600">waktu</strong> dari pencarian slot parkir tanpa berkeliling.</p>
      </div>
      <div class="fc min-w-[155px] bg-white rounded-2xl p-4 border border-gray-100 flex-shrink-0">
        <div class="w-9 h-9 rounded-xl bg-green-50 flex items-center justify-center mb-3">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#16A34A" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
        </div>
        <p class="font-bold text-gray-800 text-[13px] mb-1">Parkir Aman</p>
        <p class="text-gray-400 text-[11px] leading-relaxed">Slot dipantau <strong class="text-gray-600">real-time</strong> untuk keamanan kendaraan Anda.</p>
      </div>
    </div>

    <!-- Partners -->
    <div class="fade-up d3 overflow-hidden">
      <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-2">Tersedia di</p>
      <div class="overflow-hidden">
        <div class="logos-track">
          <span class="text-sm font-black text-green-700 whitespace-nowrap">BOXIES 123</span>
          <span class="text-sm font-bold text-gray-600 whitespace-nowrap">LIPPO<span class="font-light">MALLS</span></span>
          <span class="text-sm font-bold text-orange-500 whitespace-nowrap">BOTANI SQUARE</span>
          <span class="text-sm font-bold text-blue-700 whitespace-nowrap">MALL KOTA KAS</span>
          <span class="text-sm font-black text-purple-700 whitespace-nowrap">AEON MALL</span>
          <span class="text-sm font-black text-green-700 whitespace-nowrap">BOXIES 123</span>
          <span class="text-sm font-bold text-gray-600 whitespace-nowrap">LIPPO<span class="font-light">MALLS</span></span>
          <span class="text-sm font-bold text-orange-500 whitespace-nowrap">BOTANI SQUARE</span>
          <span class="text-sm font-bold text-blue-700 whitespace-nowrap">MALL KOTA KAS</span>
          <span class="text-sm font-black text-purple-700 whitespace-nowrap">AEON MALL</span>
        </div>
      </div>
    </div>

    <!-- CTA -->
    <div class="fade-up d4 mt-auto pt-2">
      <button onclick="window.location.href = '{{ route('user.dashboard') }}" class="cta-pulse w-full bg-blue-600 text-white font-black text-lg py-4 rounded-2xl transition-all cursor-pointer">
        Mulai Sekarang
      </button>
      <p class="text-center text-xs text-gray-400 mt-3">Sudah punya akun? <span class="text-blue-600 font-bold cursor-pointer">Masuk</span></p>
    </div>
  </div>
</div>

<!-- ======================================================
     DESKTOP (>= lg) — full viewport, split layout
======================================================= -->
<div class="hidden lg:flex w-full min-h-screen">

  <!-- LEFT: dark hero panel with real car -->
  <div class="w-1/2 xl:w-[55%] relative bg-[#0d1117] flex flex-col overflow-hidden">
    <!-- Subtle radial glow -->
    <div class="absolute inset-0 opacity-30" style="background:radial-gradient(ellipse 80% 60% at 50% 70%, #1e40af 0%, transparent 70%)"></div>

    <!-- Logo top-left -->
    <div class="fade-up relative z-10 flex items-center gap-3 p-8">
      <div class="w-11 h-11 bg-blue-600 rounded-xl flex items-center justify-center shadow-lg">
        <span class="text-white font-black text-xl">P</span>
      </div>
      <span class="text-white font-bold text-base tracking-wide">SmartPark</span>
    </div>

    <!-- Car image — centered, floating -->
    <div class="flex-1 flex items-center justify-center relative z-10 px-8">
      <div class="car-float w-full max-w-[640px]">
        <img
          src="{{ asset('assets/img/car1.png') }}"
          alt="Smart parking car"
          class="w-full object-contain drop-shadow-2xl"
          style="max-height:360px"
        />
      </div>
    </div>

    <!-- Floating stat badges -->
    <div class="fade-up d2 absolute bottom-28 left-8 z-20 bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl px-4 py-3 flex items-center gap-3">
      <div class="w-10 h-10 rounded-xl bg-green-500/20 flex items-center justify-center">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#4ade80" stroke-width="2.2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
      </div>
      <div>
        <p class="font-bold text-white text-sm">50K+ Pengguna</p>
        <p class="text-xs text-white/60">Aktif bulan ini</p>
      </div>
    </div>

    <div class="fade-up d3 absolute bottom-10 right-8 z-20 bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl px-4 py-3 flex items-center gap-3">
      <div class="w-10 h-10 rounded-xl bg-blue-400/20 flex items-center justify-center">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#60a5fa" stroke-width="2.2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
      </div>
      <div>
        <p class="font-bold text-white text-sm">120+ Lokasi</p>
        <p class="text-xs text-white/60">Tersebar di Indonesia</p>
      </div>
    </div>
  </div>

  <!-- RIGHT: content panel -->
  <div class="w-1/2 xl:w-[45%] bg-[#f0f2f5] flex flex-col justify-between px-12 xl:px-16 py-12">

    <div class="flex flex-col gap-7">
      <!-- Heading -->
      <div class="fade-up d1">
        <p class="text-gray-400 text-xs font-bold uppercase tracking-widest mb-3">Smart Parking Solutions · Booking slot parkir</p>
        <h1 class="text-4xl xl:text-5xl font-black text-gray-900 leading-tight">
          Mulai Rasakan<br/>Pengalaman<br/>Parkir yang<br/><span class="hl">Menarik</span>!
        </h1>
      </div>

      <!-- Feature rows -->
      <div class="fade-up d2 flex flex-col gap-3">
        <div class="fc flex items-start gap-4 bg-white rounded-2xl p-4 border border-gray-100">
          <div class="w-11 h-11 rounded-xl bg-blue-50 flex-shrink-0 flex items-center justify-center mt-0.5">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
          </div>
          <div>
            <p class="font-bold text-gray-800 text-sm">Akses Cepat & Mudah</p>
            <p class="text-gray-500 text-xs mt-0.5 leading-relaxed">Masuk area parkir lebih efisien dengan sistem <strong>digital</strong> modern dan minim <strong>antrean</strong>.</p>
          </div>
        </div>
        <div class="fc flex items-start gap-4 bg-white rounded-2xl p-4 border border-gray-100">
          <div class="w-11 h-11 rounded-xl bg-orange-50 flex-shrink-0 flex items-center justify-center mt-0.5">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#F97316" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
          </div>
          <div>
            <p class="font-bold text-gray-800 text-sm">Efisiensi Biaya & Waktu</p>
            <p class="text-gray-500 text-xs mt-0.5 leading-relaxed">Hemat <strong>waktu</strong> dari pencarian slot parkir tanpa perlu berkeliling area.</p>
          </div>
        </div>
        <div class="fc flex items-start gap-4 bg-white rounded-2xl p-4 border border-gray-100">
          <div class="w-11 h-11 rounded-xl bg-green-50 flex-shrink-0 flex items-center justify-center mt-0.5">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#16A34A" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
          </div>
          <div>
            <p class="font-bold text-gray-800 text-sm">Parkir Aman & Terpantau</p>
            <p class="text-gray-500 text-xs mt-0.5 leading-relaxed">Slot dikonfirmasi & dipantau secara <strong>real-time</strong> untuk keamanan kendaraan Anda.</p>
          </div>
        </div>
      </div>

      <!-- Partners -->
      <div class="fade-up d3 overflow-hidden">
        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-3">Tersedia di</p>
        <div class="overflow-hidden">
          <div class="logos-track">
            <span class="text-sm font-black text-green-700 whitespace-nowrap">BOXIES 123</span>
            <span class="text-sm font-bold text-gray-600 whitespace-nowrap">LIPPO<span class="font-light">MALLS</span></span>
            <span class="text-sm font-bold text-orange-500 whitespace-nowrap">BOTANI SQUARE</span>
            <span class="text-sm font-bold text-blue-700 whitespace-nowrap">MALL KOTA KAS</span>
            <span class="text-sm font-black text-purple-700 whitespace-nowrap">AEON MALL</span>
            <span class="text-sm font-black text-green-700 whitespace-nowrap">BOXIES 123</span>
            <span class="text-sm font-bold text-gray-600 whitespace-nowrap">LIPPO<span class="font-light">MALLS</span></span>
            <span class="text-sm font-bold text-orange-500 whitespace-nowrap">BOTANI SQUARE</span>
            <span class="text-sm font-bold text-blue-700 whitespace-nowrap">MALL KOTA KAS</span>
            <span class="text-sm font-black text-purple-700 whitespace-nowrap">AEON MALL</span>
          </div>
        </div>
      </div>
    </div>

    <!-- CTA -->
    <div class="fade-up d4 mt-8 flex flex-col gap-3">
      <button onclick="window.location.href = '{{ route('user.dashboard') }}" class="cta-pulse w-full bg-blue-600 text-white font-black text-xl py-5 rounded-2xl transition-all cursor-pointer">
        Mulai Sekarang
      </button>
      <p class="text-center text-sm text-gray-400">Sudah punya akun? <span class="text-blue-600 font-bold cursor-pointer hover:underline">Masuk di sini</span></p>
    </div>
  </div>

</div>

</body>
</html>