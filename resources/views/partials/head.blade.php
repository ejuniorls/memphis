<title>{{ filled($title ?? null) ? $title.' - '.config('app.name', 'Laravel') : config('app.name', 'Laravel') }}</title>

<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

<link rel="icon" href="/favicon.ico" sizes="any">
<link rel="icon" href="/favicon.svg" type="image/svg+xml">
<link rel="apple-touch-icon" href="/apple-touch-icon.png">

<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet"/>

{{-- theme metronic --}}
<meta charset="utf-8"/>
<meta content="follow, index" name="robots"/>
<link href="{{ url(request()->path()) }}" rel="canonical"/>
<meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport"/>
<meta content="" name="description"/>
<meta content="@keenthemes" name="twitter:site"/>
<meta content="@keenthemes" name="twitter:creator"/>
<meta content="summary_large_image" name="twitter:card"/>
<meta content="Metronic - Tailwind CSS " name="twitter:title"/>
<meta content="" name="twitter:description"/>
<meta content="{{ asset('assets/media/app/og-image.png') }}" name="twitter:image"/>
<meta content="{{ url(request()->path()) }}" property="og:url"/>
<meta content="en_US" property="og:locale"/>
<meta content="website" property="og:type"/>
<meta content="@keenthemes" property="og:site_name"/>
<meta content="Metronic - Tailwind CSS " property="og:title"/>
<meta content="" property="og:description"/>
<meta content="{{ asset('assets/media/app/og-image.png') }}" property="og:image"/>
<link href="{{ asset('assets/media/app/apple-touch-icon.png') }}" rel="apple-touch-icon" sizes="180x180"/>
<link href="{{ asset('assets/media/app/favicon-32x32.png') }}" rel="icon" sizes="32x32" type="image/png"/>
<link href="{{ asset('assets/media/app/favicon-16x16.png') }}" rel="icon" sizes="16x16" type="image/png"/>
<link href="{{ asset('assets/media/app/favicon.ico') }}" rel="shortcut icon"/>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>
<link href="{{ asset('assets/vendors/apexcharts/apexcharts.css') }}" rel="stylesheet"/>
<link href="{{ asset('assets/vendors/keenicons/styles.bundle.css') }}" rel="stylesheet"/>
<link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet"/>

@vite(['resources/css/app.css', 'resources/js/app.js'])
@fluxAppearance

@auth
    {{-- ============================================================
         CSS override: vem DEPOIS do styles.css, portanto tem
         precedência sem precisar de !important em @layer.
         Anula exatamente as regras que o KTui define no @media lg.
         ============================================================ --}}
    <style id="__appearance-layout">
        @media (width >= 80rem) {
            html.layout-fluid .kt-container-fixed {
                max-width: 100%;
                margin-inline: 0;
            }
        }
    </style>

    <script data-navigate-once>
        (function () {
            var prefs = @json(auth()->user()->appearancePreferences());

            // ── Tema ──────────────────────────────────────────────────────
            var themeMode = prefs.theme_mode || 'system';
            if (themeMode === 'system') {
                themeMode = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
            }
            localStorage.setItem('kt-theme', themeMode);
            document.documentElement.classList.remove('light', 'dark');
            document.documentElement.classList.add(themeMode);

            // ── Layout Width ──────────────────────────────────────────────
            if (prefs.layout_width === 'fluid') {
                document.documentElement.classList.add('layout-fluid');
            } else {
                document.documentElement.classList.remove('layout-fluid');
            }

            // ── Sidebar ───────────────────────────────────────────────────
            if (prefs.sidebar_default === 'collapsed' || prefs.sidebar_default === 'hidden') {
                document.addEventListener('DOMContentLoaded', function () {
                    document.body.classList.add('kt-sidebar-collapse');
                });
            }

            // ── Animações ─────────────────────────────────────────────────
            if (prefs.animations === false) {
                var style = document.createElement('style');
                style.id = '__no-animations';
                style.textContent = '*, *::before, *::after { transition: none !important; animation: none !important; }';
                document.head.appendChild(style);
            }

            // ── Densidade ─────────────────────────────────────────────────
            var densityMap = { compact: 'density-compact', comfortable: 'density-comfortable', spacious: 'density-spacious' };
            document.documentElement.classList.add(densityMap[prefs.density] || 'density-comfortable');

            // ── Font Size ─────────────────────────────────────────────────
            var fontSizeMap = { sm: 'font-size-sm', md: 'font-size-md', lg: 'font-size-lg' };
            document.documentElement.classList.add(fontSizeMap[prefs.font_size] || 'font-size-md');

            // ── Font Family ───────────────────────────────────────────────
            var fontFamilyMap = { inter: 'font-inter', system: 'font-system', mono: 'font-mono-custom' };
            document.documentElement.classList.add(fontFamilyMap[prefs.font_family] || 'font-inter');
        })();
    </script>
@endauth
