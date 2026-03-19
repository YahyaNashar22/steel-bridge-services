<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $metaTitle ?? config('app.name') }}</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('steel bridge logo/svg/steel bridge svg_1.svg') }}">
    <link rel="icon" type="image/png" sizes="512x512" href="{{ asset('steel bridge logo/png/steel bridge amber png.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('steel bridge logo/png/steel bridge amber png.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    @if (!empty($metaDescription))
        <meta name="description" content="{{ $metaDescription }}">
    @endif
    <script>
        (function() {
            const stored = localStorage.getItem('theme');
            const preferred = window.matchMedia('(prefers-color-scheme: light)').matches ? 'light' : 'dark';
            document.documentElement.setAttribute('data-theme', stored || preferred);
        })();
    </script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="nfd-shell">
    <header class="site-header sticky top-0 z-50">
        <div class="nfd-container flex items-center justify-between py-4">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <img src="{{ asset('steel bridge logo/svg/steel bridge svg_1.svg') }}" alt="Steel Bridge Logo"
                    class="brand-logo-dark h-9 w-9">
                <img src="{{ asset('steel bridge logo/svg/steel bridge svg_2.svg') }}" alt="Steel Bridge Logo"
                    class="brand-logo-light h-9 w-9">
                <span class="text-lg font-semibold tracking-[0.18em]">STEEL BRIDGE SERVICES</span>
            </a>
            <div class="hidden flex-1 justify-center xl:flex">
                <div class="flex items-center gap-5 text-sm text-slate-200">
                @if (!empty($settings['company_phone']))
                    <div class="flex items-center gap-2">
                        <span class="flex h-8 w-8 items-center justify-center rounded-full border border-white/10 bg-white/5 text-[var(--nfd-accent-soft)]">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-4 w-4 fill-current" aria-hidden="true">
                                <path d="M6.62 10.79a15.05 15.05 0 0 0 6.59 6.59l2.2-2.2a1 1 0 0 1 1-.24 11.36 11.36 0 0 0 3.57.57 1 1 0 0 1 1 1V20a1 1 0 0 1-1 1A17 17 0 0 1 3 4a1 1 0 0 1 1-1h3.49a1 1 0 0 1 1 1 11.36 11.36 0 0 0 .57 3.57 1 1 0 0 1-.25 1.01z"/>
                            </svg>
                        </span>
                        <span>{{ $settings['company_phone'] }}</span>
                    </div>
                @endif
                <div class="flex items-center gap-2">
                    <span class="flex h-8 w-8 items-center justify-center rounded-full border border-white/10 bg-white/5 text-[var(--nfd-accent-soft)]">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-4 w-4 fill-current" aria-hidden="true">
                            <path d="M12 2a10 10 0 1 0 10 10A10.01 10.01 0 0 0 12 2m1 11h5a6.98 6.98 0 0 1-6 6v-5h1zm-1-9a8 8 0 0 1 8 8h-8zm-1 0v9H4a8 8 0 0 1 7-9zm0 16a8 8 0 0 1-7-7h7z"/>
                        </svg>
                    </span>
                    <span>24h Availability</span>
                </div>
                @if (!empty($settings['company_email']))
                    <div class="flex items-center gap-2">
                        <span class="flex h-8 w-8 items-center justify-center rounded-full border border-white/10 bg-white/5 text-[var(--nfd-accent-soft)]">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-4 w-4 fill-current" aria-hidden="true">
                                <path d="M20 4H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2m0 4-8 5-8-5V6l8 5 8-5z"/>
                            </svg>
                        </span>
                        <span>{{ $settings['company_email'] }}</span>
                    </div>
                @endif
                </div>
            </div>
            <nav class="flex items-center gap-5 text-sm">
                <a href="{{ route('home') }}" class="site-nav-link">Home</a>
                <a href="{{ route('services.index') }}" class="site-nav-link">Services</a>
                <button id="theme-toggle" type="button" class="theme-toggle" aria-label="Toggle theme">
                    <span id="theme-toggle-label">Light Mode</span>
                </button>
            </nav>
        </div>
    </header>

    <main>
        @if (session('status'))
            <div class="nfd-container mt-4 rounded border border-green-800/60 bg-green-900/30 px-4 py-3 text-green-200">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="nfd-container mt-4 rounded border border-red-800/70 bg-red-950/40 px-4 py-3 text-red-200">
                <ul class="list-disc space-y-1 pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="site-footer mt-16 py-10">
        <div class="nfd-container grid gap-4 md:grid-cols-3">
            <div>
                <div class="flex items-center gap-3">
                    <img src="{{ asset('steel bridge logo/svg/steel bridge svg_1.svg') }}" alt="Steel Bridge Logo"
                        class="brand-logo-dark h-8 w-8">
                    <img src="{{ asset('steel bridge logo/svg/steel bridge svg_2.svg') }}" alt="Steel Bridge Logo"
                        class="brand-logo-light h-8 w-8">
                    <h3 class="font-semibold">Steel Bridge Services</h3>
                </div>
                <p class="mt-2 text-sm">California's premier self performing facility partner</p>
            </div>
            <div>
                <h3 class="font-semibold">Contact</h3>
                @if (!empty($settings['company_phone']))
                    <p class="mt-2 text-sm">Phone: {{ $settings['company_phone'] }}</p>
                @endif
                @if (!empty($settings['company_email']))
                    <p class="text-sm">Email: {{ $settings['company_email'] }}</p>
                @endif
                @if (!empty($settings['company_address']))
                    <p class="text-sm whitespace-pre-line">Address: {{ $settings['company_address'] }}</p>
                @endif
            </div>
            <div>
                <h3 class="font-semibold">Social</h3>
                @if (!empty($settings['facebook_url']))
                    <a class="mt-2 block text-sm hover:text-[var(--nfd-accent-soft)]"
                        href="{{ $settings['facebook_url'] }}" target="_blank" rel="noopener noreferrer">Facebook</a>
                @endif
                @if (!empty($settings['instagram_url']))
                    <a class="mt-2 block text-sm hover:text-[var(--nfd-accent-soft)]"
                        href="{{ $settings['instagram_url'] }}" target="_blank" rel="noopener noreferrer">Instagram</a>
                @endif
                @if (!empty($settings['linkedin_url']))
                    <a class="mt-2 block text-sm hover:text-[var(--nfd-accent-soft)]"
                        href="{{ $settings['linkedin_url'] }}" target="_blank" rel="noopener noreferrer">LinkedIn</a>
                @endif
                @if (!empty($settings['youtube_url']))
                    <a class="mt-2 block text-sm hover:text-[var(--nfd-accent-soft)]"
                        href="{{ $settings['youtube_url'] }}" target="_blank" rel="noopener noreferrer">YouTube</a>
                @endif
                <a class="mt-2 block text-sm hover:text-[var(--nfd-accent-soft)]"
                    href="{{ route('terms.show') }}">Terms and Copyrights</a>
            </div>
        </div>
    </footer>
    <script>
        (function() {
            const root = document.documentElement;
            const button = document.getElementById('theme-toggle');
            const label = document.getElementById('theme-toggle-label');

            if (!button || !label) return;

            const updateLabel = () => {
                const current = root.getAttribute('data-theme') || 'dark';
                label.textContent = current === 'dark' ? 'Light Mode' : 'Dark Mode';
            };

            updateLabel();

            button.addEventListener('click', function() {
                const current = root.getAttribute('data-theme') || 'dark';
                const next = current === 'dark' ? 'light' : 'dark';
                root.setAttribute('data-theme', next);
                localStorage.setItem('theme', next);
                updateLabel();
            });
        })();
    </script>
</body>

</html>
