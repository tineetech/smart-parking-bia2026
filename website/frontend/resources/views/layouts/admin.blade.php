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

    <link rel="stylesheet" href="{{ asset('assets/css/admin-global.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />
    @yield('styles')
</head>

<body>

    <div class="overlay" id="overlay" onclick="closeSidebar()"></div>
    <div class="app-shell">

        @include('components.admin-sidebar')

        {{-- ── MAIN ───────────────────────────────────────────────────── --}}
        <div class="main-area">
            @include('components.admin-header')
            @yield('content')
        </div>

        @include('components.admin-bottomnav')

    </div>
    </div>

    @yield('scripts')
    <script>
        function toggleSlotMenu(e) {
            // Jangan toggle saat klik badge atau chevron saja
            const submenu = document.getElementById('slot-submenu');
            const chevron = e.currentTarget.querySelector('.nav-chevron');
            const isOpen = submenu.classList.contains('open');

            if (isOpen) {
                submenu.classList.remove('open');
                chevron?.classList.remove('open');
            } else {
                submenu.classList.add('open');
                chevron?.classList.add('open');
            }
        }
        // ══════════════════════════════════════════
        // PARKIFY — GLOBAL JS
        // Dipakai di semua halaman (layout shell)
        // ══════════════════════════════════════════

        // ── THEME TOGGLE ────────────────────────────────
        function toggleTheme() {
            const h = document.documentElement;
            const next = h.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
            h.setAttribute('data-theme', next);
            document.getElementById('theme-label').textContent = next === 'dark' ? 'Dark' : 'Light';
            localStorage.setItem('parkify-theme', next);

            // Hook: halaman boleh subscribe ke event ini
            document.dispatchEvent(new CustomEvent('parkify:theme-changed', {
                detail: next
            }));
        }

        // Apply saved theme on load
        const savedTheme = localStorage.getItem('parkify-theme');
        if (savedTheme) {
            document.documentElement.setAttribute('data-theme', savedTheme);
            const label = document.getElementById('theme-label');
            if (label) label.textContent = savedTheme === 'dark' ? 'Dark' : 'Light';
        }

        // ── SIDEBAR MOBILE ──────────────────────────────
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('open');
            document.getElementById('overlay').classList.toggle('show');
        }

        function closeSidebar() {
            document.getElementById('sidebar').classList.remove('open');
            document.getElementById('overlay').classList.remove('show');
        }
    </script>
</body>

</html>
