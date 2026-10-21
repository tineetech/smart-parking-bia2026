<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @php
        $seoTitle = trim($__env->yieldContent('title', 'Parkify — Smart Parking SMKN 4 Bogor | Parkir Otomatis Real-Time'));
        $seoDescription = trim($__env->yieldContent('meta_description', 'Parkify adalah sistem smart parking karya Justine dan tim SMKN 4 Bogor. Cek ketersediaan slot parkir secara real-time, booking parkir online, dan bayar cashless dengan Parkify Smart Parking.'));
        $seoKeywords = trim($__env->yieldContent('meta_keywords', 'parkify, parkify smkn 4 bogor, parkify justine, parkify bogor, parkify smart, smart parking, parkify bogor id, parkir otomatis, parkir online, booking parkir, smart parking bogor, parkir real-time'));
        $seoImage = trim($__env->yieldContent('meta_image', 'assets/img/mockup2.png'));
        $seoImageUrl = \Illuminate\Support\Str::startsWith($seoImage, ['http://', 'https://']) ? $seoImage : asset($seoImage);
        $seoUrl = url()->current();
        $seoSiteName = 'Parkify';
        $seoStructuredData = [
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => 'Parkify',
            'alternateName' => [
                'Parkify',
                'Parkify SMKN 4 Bogor',
                'Parkify Justine',
                'Parkify Bogor',
                'Parkify Smart',
                'Smart Parking',
                'Parkify Bogor ID',
            ],
            'url' => url('/'),
            'logo' => asset('assets/img/logo-round.png'),
            'description' => $seoDescription,
            'keywords' => $seoKeywords,
            'areaServed' => [
                '@type' => 'Place',
                'name' => 'Bogor, Jawa Barat, Indonesia',
            ],
        ];
    @endphp

    <title>{{ $seoTitle }}</title>

    {{-- SEO Dasar --}}
    <meta name="description" content="{{ $seoDescription }}">
    <meta name="keywords" content="{{ $seoKeywords }}">
    <meta name="author" content="Parkify">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="theme-color" content="#2563eb">
    <link rel="canonical" href="{{ $seoUrl }}">

    {{-- Open Graph (Facebook, WhatsApp, LinkedIn) --}}
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ $seoSiteName }}">
    <meta property="og:locale" content="id_ID">
    <meta property="og:title" content="{{ $seoTitle }}">
    <meta property="og:description" content="{{ $seoDescription }}">
    <meta property="og:url" content="{{ $seoUrl }}">
    <meta property="og:image" content="{{ $seoImageUrl }}">
    <meta property="og:image:alt" content="Parkify — Smart Parking SMKN 4 Bogor">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $seoTitle }}">
    <meta name="twitter:description" content="{{ $seoDescription }}">
    <meta name="twitter:image" content="{{ $seoImageUrl }}">
    <meta name="twitter:image:alt" content="Parkify — Smart Parking SMKN 4 Bogor">

    {{-- Structured Data (JSON-LD): menautkan seluruh variasi keyword ke entitas Parkify --}}
    <script type="application/ld+json">{!! json_encode($seoStructuredData, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}</script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />

    <link
        href="https://fonts.googleapis.com/css2?family=Space Grotesk:wght@400;600;700;800&family=DM+Sans:wght@300;400;500;600&display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Poppins:wght@400;600;700;800&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=Space+Grotesk:wght@400;500;700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="shortcut icon" href="{{ asset('assets/img/logo-round.png') }}" type="image/x-icon">
    
    <link rel="stylesheet" href="{{ asset('assets/css/global.css') }}">
    @yield('styles')
</head>

<body>

    @yield('content')

    @yield('scripts')

</body>

</html>
