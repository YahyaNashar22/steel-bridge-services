<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin' }} - {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 text-slate-900">
    <div class="min-h-screen">
        <header class="bg-slate-900 text-white">
            <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4">
                <a href="{{ route('admin.dashboard') }}" class="font-semibold tracking-wide">Steel Bridge Admin</a>
                <div class="flex items-center gap-4 text-sm">
                    <a href="{{ route('home') }}" class="hover:text-orange-300">View Website</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="rounded bg-orange-500 px-3 py-1 font-medium text-white hover:bg-orange-600">Logout</button>
                    </form>
                </div>
            </div>
            <nav class="border-t border-slate-700">
                <div class="mx-auto flex max-w-7xl flex-wrap gap-2 px-4 py-3 text-sm">
                    <a href="{{ route('admin.dashboard') }}" class="rounded px-3 py-1 {{ request()->routeIs('admin.dashboard') ? 'bg-slate-700 text-white' : 'text-slate-200 hover:bg-slate-700' }}">Dashboard</a>
                    <a href="{{ route('admin.manual') }}" class="rounded px-3 py-1 {{ request()->routeIs('admin.manual') ? 'bg-slate-700 text-white' : 'text-slate-200 hover:bg-slate-700' }}">Admin Manual</a>
                    <a href="{{ route('admin.service-categories.index') }}" class="rounded px-3 py-1 {{ request()->routeIs('admin.service-categories.*') ? 'bg-slate-700 text-white' : 'text-slate-200 hover:bg-slate-700' }}">Categories</a>
                    <a href="{{ route('admin.services.index') }}" class="rounded px-3 py-1 {{ request()->routeIs('admin.services.*') ? 'bg-slate-700 text-white' : 'text-slate-200 hover:bg-slate-700' }}">Services</a>
                    <a href="{{ route('admin.homepage-sections.index') }}" class="rounded px-3 py-1 {{ request()->routeIs('admin.homepage-sections.*') ? 'bg-slate-700 text-white' : 'text-slate-200 hover:bg-slate-700' }}">Homepage Sections</a>
                    <a href="{{ route('admin.homepage-service-items.index') }}" class="rounded px-3 py-1 {{ request()->routeIs('admin.homepage-service-items.*') ? 'bg-slate-700 text-white' : 'text-slate-200 hover:bg-slate-700' }}">Homepage Items</a>
                    <a href="{{ route('admin.homepage-tabs.index') }}" class="rounded px-3 py-1 {{ request()->routeIs('admin.homepage-tabs.*') ? 'bg-slate-700 text-white' : 'text-slate-200 hover:bg-slate-700' }}">Homepage Tabs</a>
                    <a href="{{ route('admin.trusted-brands.index') }}" class="rounded px-3 py-1 {{ request()->routeIs('admin.trusted-brands.*') ? 'bg-slate-700 text-white' : 'text-slate-200 hover:bg-slate-700' }}">Trusted By</a>
                    <a href="{{ route('admin.terms.edit') }}" class="rounded px-3 py-1 {{ request()->routeIs('admin.terms.*') ? 'bg-slate-700 text-white' : 'text-slate-200 hover:bg-slate-700' }}">Legal Pages</a>
                    <a href="{{ route('admin.settings.index') }}" class="rounded px-3 py-1 {{ request()->routeIs('admin.settings.*') ? 'bg-slate-700 text-white' : 'text-slate-200 hover:bg-slate-700' }}">Settings</a>
                    <a href="{{ route('admin.contact-messages.index') }}" class="rounded px-3 py-1 {{ request()->routeIs('admin.contact-messages.*') ? 'bg-slate-700 text-white' : 'text-slate-200 hover:bg-slate-700' }}">Contact Messages</a>
                    <a href="{{ route('admin.service-requests.index') }}" class="rounded px-3 py-1 {{ request()->routeIs('admin.service-requests.*') ? 'bg-slate-700 text-white' : 'text-slate-200 hover:bg-slate-700' }}">Service Requests</a>
                </div>
            </nav>
        </header>

        <main class="mx-auto max-w-7xl px-4 py-6">
            @if (session('status'))
                <div class="mb-4 rounded border border-green-200 bg-green-50 px-4 py-3 text-green-800">{{ session('status') }}</div>
            @endif

            @if ($errors->any())
                <div class="mb-4 rounded border border-red-200 bg-red-50 px-4 py-3 text-red-800">
                    <ul class="list-disc space-y-1 pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</body>
</html>
