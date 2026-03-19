@extends('website.layout', [
    'metaTitle' => $service->meta_title ?: ($service->title.' - '.config('app.name')),
    'metaDescription' => $service->meta_description,
    'settings' => $settings,
])

@section('content')
    <section class="border-b border-white/10 py-16">
        <div class="nfd-container">
            <p class="text-sm uppercase tracking-widest text-orange-300">{{ $service->category?->name }}</p>
            <h1 class="mt-3 text-4xl font-bold">{{ $service->title }}</h1>
            <p class="mt-3 max-w-3xl text-slate-300">{{ $service->short_description }}</p>
        </div>
    </section>

    <section class="nfd-container mt-10">
        <div class="grid gap-8 lg:grid-cols-3">
            <article class="lg:col-span-2">
                @if ($service->featured_image)
                    <img src="{{ asset('storage/'.$service->featured_image) }}" alt="{{ $service->title }}" class="mb-6 w-full rounded-xl object-cover">
                @endif

                <div class="prose max-w-none">
                    <p class="whitespace-pre-line text-slate-300">{{ $service->long_description }}</p>
                </div>

                @if ($service->images->isNotEmpty())
                    <h2 class="mt-10 text-2xl font-semibold">Gallery</h2>
                    <div class="mt-4 grid gap-4 md:grid-cols-2">
                        @foreach ($service->images as $image)
                            <img src="{{ asset('storage/'.$image->path) }}" alt="{{ $image->alt ?: $service->title }}" class="w-full rounded-lg object-cover">
                        @endforeach
                    </div>
                @endif

                @if ($service->videos->isNotEmpty())
                    <h2 class="mt-10 text-2xl font-semibold">Videos</h2>
                    <ul class="mt-3 space-y-2">
                        @foreach ($service->videos as $video)
                            <li>
                                <a href="{{ $video->youtube_url }}" target="_blank" rel="noopener noreferrer" class="text-[var(--nfd-accent-soft)] hover:text-white">
                                    {{ $video->youtube_url }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </article>

            <aside class="nfd-card">
                <h2 class="text-xl font-semibold">Request This Service</h2>
                <form method="POST" action="{{ route('service-requests.store') }}" class="mt-4 space-y-3">
                    @csrf
                    <input type="hidden" name="service_id" value="{{ $service->id }}">
                    <input type="text" name="full_name" placeholder="Full name" class="w-full rounded-xl border border-white/10 bg-[var(--nfd-soft)] px-3 py-2" required>
                    <input type="text" name="phone" placeholder="Phone number" class="w-full rounded-xl border border-white/10 bg-[var(--nfd-soft)] px-3 py-2" required>
                    <input type="email" name="email" placeholder="Email address" class="w-full rounded-xl border border-white/10 bg-[var(--nfd-soft)] px-3 py-2" required>
                    <textarea name="description" rows="4" placeholder="Describe your needs" class="w-full rounded-xl border border-white/10 bg-[var(--nfd-soft)] px-3 py-2" required></textarea>
                    <button type="submit" class="nfd-btn-primary w-full">Submit Request</button>
                </form>
            </aside>
        </div>
    </section>
@endsection
