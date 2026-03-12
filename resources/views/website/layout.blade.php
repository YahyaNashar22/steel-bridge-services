<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $metaTitle ?? config('app.name') }}</title>
    @if (!empty($metaDescription))
        <meta name="description" content="{{ $metaDescription }}">
    @endif
    <script>
        (function () {
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
                <img src="{{ asset('steel bridge logo/svg/steel bridge svg_1.svg') }}" alt="Steel Bridge Logo" class="brand-logo-dark h-9 w-9">
                <img src="{{ asset('steel bridge logo/svg/steel bridge svg_2.svg') }}" alt="Steel Bridge Logo" class="brand-logo-light h-9 w-9">
                <span class="text-lg font-semibold tracking-[0.18em]">STEEL BRIDGE SERVICES</span>
            </a>
            <nav class="flex items-center gap-5 text-sm">
                <a href="{{ route('home') }}" class="site-nav-link">Home</a>
                <a href="{{ route('services.index') }}" class="site-nav-link">Services</a>
                <button id="theme-toggle" type="button" class="theme-toggle" aria-label="Toggle theme">
                    <span id="theme-toggle-label">Light Mode</span>
                </button>
                @auth
                    @if (auth()->user()?->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="site-nav-link">Admin</a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="site-nav-link">Login</a>
                @endauth
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
                    <img src="{{ asset('steel bridge logo/svg/steel bridge svg_1.svg') }}" alt="Steel Bridge Logo" class="brand-logo-dark h-8 w-8">
                    <img src="{{ asset('steel bridge logo/svg/steel bridge svg_2.svg') }}" alt="Steel Bridge Logo" class="brand-logo-light h-8 w-8">
                    <h3 class="font-semibold">Steel Bridge Services</h3>
                </div>
                <p class="mt-2 text-sm">Integrated facilities and maintenance solutions for modern operations.</p>
            </div>
            <div>
                <h3 class="font-semibold">Contact</h3>
                <p class="mt-2 text-sm">Phone: {{ $settings['company_phone'] ?? 'N/A' }}</p>
                <p class="text-sm">Email: {{ $settings['company_email'] ?? 'N/A' }}</p>
            </div>
            <div>
                <h3 class="font-semibold">Social</h3>
                @if (!empty($settings['facebook_url'])) <a class="mt-2 block text-sm hover:text-[var(--nfd-accent-soft)]" href="{{ $settings['facebook_url'] }}" target="_blank" rel="noopener noreferrer">Facebook</a> @endif
                @if (!empty($settings['instagram_url'])) <a class="mt-2 block text-sm hover:text-[var(--nfd-accent-soft)]" href="{{ $settings['instagram_url'] }}" target="_blank" rel="noopener noreferrer">Instagram</a> @endif
                @if (!empty($settings['linkedin_url'])) <a class="mt-2 block text-sm hover:text-[var(--nfd-accent-soft)]" href="{{ $settings['linkedin_url'] }}" target="_blank" rel="noopener noreferrer">LinkedIn</a> @endif
                @if (!empty($settings['youtube_url'])) <a class="mt-2 block text-sm hover:text-[var(--nfd-accent-soft)]" href="{{ $settings['youtube_url'] }}" target="_blank" rel="noopener noreferrer">YouTube</a> @endif
                <a class="mt-2 block text-sm hover:text-[var(--nfd-accent-soft)]" href="{{ route('terms.show') }}">Terms and Copyrights</a>
            </div>
        </div>
    </footer>
    <script>
        (function () {
            const root = document.documentElement;
            const button = document.getElementById('theme-toggle');
            const label = document.getElementById('theme-toggle-label');

            if (!button || !label) return;

            const updateLabel = () => {
                const current = root.getAttribute('data-theme') || 'dark';
                label.textContent = current === 'dark' ? 'Light Mode' : 'Dark Mode';
            };

            updateLabel();

            button.addEventListener('click', function () {
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
