@extends('website.layout', ['metaTitle' => 'Services - '.config('app.name'), 'settings' => $settings])

@section('content')
    <section class="border-b border-white/10 py-16 text-white">
        <div class="nfd-container">
            <h1 class="text-4xl font-bold">Our Services</h1>
            <p class="mt-3 max-w-2xl text-slate-300">Explore Steel Bridge service offerings tailored to your facility and operations goals.</p>
        </div>
    </section>

    <section class="nfd-container mt-10">
        @if ($categories->isNotEmpty())
            <div class="mb-6 flex flex-wrap gap-2">
                @foreach ($categories as $category)
                    <span class="rounded-full border border-white/10 bg-white/5 px-3 py-1 text-sm text-slate-200">{{ $category->name }}</span>
                @endforeach
            </div>
        @endif

        <div class="grid gap-5 md:grid-cols-2 lg:grid-cols-3">
            @forelse ($services as $service)
                <article class="nfd-card">
                    <p class="text-xs uppercase tracking-[0.2em] text-[var(--nfd-accent-soft)]">{{ $service->category?->name }}</p>
                    <h2 class="mt-2 text-lg font-semibold">{{ $service->title }}</h2>
                    <p class="mt-2 text-sm text-slate-300">{{ $service->short_description }}</p>
                    <a href="{{ route('services.show', $service->slug) }}" class="mt-4 inline-block text-sm font-medium text-[var(--nfd-accent-soft)]">View details</a>
                </article>
            @empty
                <p class="text-slate-400">No published services available at the moment.</p>
            @endforelse
        </div>

        <div class="mt-6">{{ $services->links() }}</div>
    </section>
@endsection
