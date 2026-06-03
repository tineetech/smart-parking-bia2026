<!DOCTYPE html>
<html lang="id" data-theme="light">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    
    <link rel="shortcut icon" href="{{ asset('assets/img/logo-round.png') }}" type="image/x-icon">
    
    <link rel="stylesheet" href="{{ asset('assets/css/user-global.css') }}">
    @yield('styles')
</head>

<body>

    @include('components.user-topbar')

    @yield('content')

    @include('components.user-bottomnav')
    @include('components.chatbot')

    @yield('scripts')
</body>

</html>
