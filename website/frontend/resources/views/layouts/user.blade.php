<!DOCTYPE html>
<html lang="id" data-theme="light">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="shortcut icon" href="{{ asset('assets/img/logo-round.png') }}" type="image/x-icon">
    
    <link rel="stylesheet" href="{{ asset('assets/css/user-global.css') }}">
    @yield('styles')
</head>

<body>

    @include('components.user-topbar')

    @yield('content')

    @include('components.user-bottomnav')
    @include('components.chatbot')

    {{-- Notif Popup (body level agar position:fixed tidak terpengaruh parent) --}}
    <div id="notifPopup" style="display:none;position:fixed;right:24px;top:68px;width:340px;background:#fff;border-radius:14px;border:1px solid #e2e8f2;box-shadow:0 10px 40px rgba(15,30,54,0.15);z-index:99999;overflow:hidden;max-height:400px">
      <div style="display:flex;align-items:center;justify-content:space-between;padding:12px 14px;border-bottom:1px solid #e2e8f2">
        <span style="font-family:'Space Grotesk',sans-serif;font-size:13px;font-weight:700;color:#0f1e36">Notifikasi</span>
        <button onclick="markAllReadNotif()" style="background:none;border:none;font-size:11px;font-weight:600;color:#2563eb;cursor:pointer;font-family:'Poppins',sans-serif">Tandai Semua Dibaca</button>
      </div>
      <div id="notifList" style="overflow-y:auto;max-height:340px">
        <div style="padding:24px;text-align:center;font-size:12px;color:#94a3b8">Memuat notifikasi...</div>
      </div>
    </div>

    @yield('scripts')
</body>

</html>
