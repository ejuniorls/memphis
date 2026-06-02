<title>{{ filled($title ?? null) ? $title.' - '.config('app.name', 'Laravel') : config('app.name', 'Laravel') }}</title>

<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
<meta content="follow, index" name="robots"/>
<link href="{{ url(request()->path()) }}" rel="canonical"/>
<meta content="" name="description"/>

{{-- Open Graph / Twitter --}}
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

{{-- Favicon --}}
<link href="{{ asset('assets/media/app/favicon.ico') }}" rel="icon" sizes="any"/>
<link href="{{ asset('assets/media/app/favicon.svg') }}" rel="icon" type="image/svg+xml"/>
<link href="{{ asset('assets/media/app/apple-touch-icon.png') }}" rel="apple-touch-icon" sizes="180x180"/>

{{-- Fonts --}}
<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>

{{-- Vendor CSS --}}
<link href="{{ asset('assets/vendors/apexcharts/apexcharts.css') }}" rel="stylesheet"/>
<link href="{{ asset('assets/vendors/keenicons/styles.bundle.css') }}" rel="stylesheet"/>
<link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet"/>

@vite(['resources/css/app.css', 'resources/js/app.js'])
@fluxAppearance

@auth
    {{--
        CSS override: carregado após styles.css para ter precedência natural.
        Anula as regras de largura que o KTui define dentro do @media lg,
        sem precisar de !important.
    --}}
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
