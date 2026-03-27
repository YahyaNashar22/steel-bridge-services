@extends('website.layout', ['metaTitle' => ($sections['hero']->title ?? config('app.name')), 'settings' => $settings])

@php
    $heroChips = collect([
        $sections['hero_chip_1']->title ?? 'Nationwide Coverage',
        $sections['hero_chip_2']->title ?? 'Rapid Response Teams',
        $sections['hero_chip_3']->title ?? 'Compliance-Ready Workflows',
    ])->filter(fn ($chip) => filled($chip))->values();

    $heroHighlights = collect([
        [
            'kicker' => $sections['hero_highlight_1']->subtitle ?? 'Service Speed',
            'value' => $sections['hero_highlight_1']->title ?? '2h',
            'description' => $sections['hero_highlight_1']->content ?? 'Priority dispatch response target.',
        ],
        [
            'kicker' => $sections['hero_highlight_2']->subtitle ?? 'Client Retention',
            'value' => $sections['hero_highlight_2']->title ?? '92%',
            'description' => $sections['hero_highlight_2']->content ?? 'Partnerships renewed year-on-year.',
        ],
    ])->filter(fn ($card) => filled($card['kicker']) || filled($card['value']) || filled($card['description']))->values();

    $showTrustedBrands = filter_var($sections['trusted_brands']->content ?? false, FILTER_VALIDATE_BOOLEAN);

    $stats = [
        ['value' => $sections['stats_1']->title ?? '24/7', 'label' => $sections['stats_1']->subtitle ?? 'Support Availability'],
        ['value' => $sections['stats_2']->title ?? '98%', 'label' => $sections['stats_2']->subtitle ?? 'First-Visit Resolution'],
        ['value' => $sections['stats_3']->title ?? '450+', 'label' => $sections['stats_3']->subtitle ?? 'Facilities Supported'],
        ['value' => $sections['stats_4']->title ?? '5+', 'label' => $sections['stats_4']->subtitle ?? 'Years Experience'],
    ];

    $industries = collect(preg_split('/\r\n|\r|\n/', (string) ($sections['industries']->content ?? 'Healthcare
Retail
Corporate Offices
Warehouses
Hospitality
Education')))
        ->map(fn ($line) => trim($line))
        ->filter()
        ->values();

    $processSteps = collect([
        [
            'eyebrow' => $sections['process_step_1']->title ?? '01 Diagnose',
            'description' => $sections['process_step_1']->content ?? 'On-site or remote assessment with scope clarity and risk mapping.',
        ],
        [
            'eyebrow' => $sections['process_step_2']->title ?? '02 Deliver',
            'description' => $sections['process_step_2']->content ?? 'Planned execution with live progress updates and quality checks.',
        ],
        [
            'eyebrow' => $sections['process_step_3']->title ?? '03 Optimize',
            'description' => $sections['process_step_3']->content ?? 'Preventive recommendations and performance reporting.',
        ],
    ])->filter(fn ($step) => filled($step['eyebrow']) || filled($step['description']))->values();

    $testimonials = collect(preg_split('/\r\n|\r|\n/', (string) ($sections['testimonials']->content ?? '"We reduced downtime massively after switching providers." | Operations Director
"Fast response, clear communication, and very strong execution." | Facilities Manager
"The reporting quality and follow-up are on another level." | Property Lead')))
        ->map(fn ($line) => trim($line))
        ->filter()
        ->map(function ($line) {
            [$quote, $author] = array_pad(explode('|', $line, 2), 2, '');
            return ['quote' => trim($quote, " \t\n\r\0\x0B\""), 'author' => trim($author)];
        })
        ->values();
@endphp

@section('content')
    <section class="video-hero">
        @if (!empty($sections['video_hero']->video))
            <video autoplay muted loop playsinline class="video-fallback">
                <source src="{{ asset('storage/'.$sections['video_hero']->video) }}" type="video/mp4">
            </video>
        @elseif (!empty($sections['video_hero']->image))
            <img src="{{ asset('storage/'.$sections['video_hero']->image) }}" alt="{{ $sections['video_hero']->title ?? 'Steel Bridge' }}" class="video-fallback">
        @else
            <div class="video-fallback bg-[var(--nfd-soft)]"></div>
        @endif

        <div class="video-hero-content scroll-reveal is-visible" data-animate="zoom">
            <p class="nfd-kicker">{{ $sections['video_hero']->subtitle ?? 'Self-Performing Nationwide 24/7/365 Service' }}</p>
            <h1 class="mt-4 text-4xl font-extrabold leading-tight md:text-6xl">
                {{ $sections['video_hero']->title ?? 'Your National Integrated Facility Management Partner' }}
            </h1>
            <p class="mx-auto mt-5 max-w-3xl text-base md:text-lg" style="color: inherit;">
                {{ $sections['video_hero']->content ?? 'Steel Bridge delivers scalable, high-standard facilities services with nationwide support and rapid response teams.' }}
            </p>
            <div class="mt-8 flex flex-wrap items-center justify-center gap-3">
                <a href="{{ route('services.index') }}" class="nfd-btn-primary">Our Services</a>
                <a href="#request-form" class="nfd-btn-outline">Contact Us</a>
            </div>
        </div>
    </section>

    <section class="relative overflow-hidden border-b border-white/10 py-24">
        <div class="pointer-events-none absolute left-0 top-10 h-64 w-64 rounded-full bg-[var(--nfd-accent)]/20 blur-3xl"></div>
        <div class="pointer-events-none absolute right-10 top-28 h-56 w-56 rounded-full bg-blue-400/10 blur-3xl float-slower"></div>

        <div class="nfd-container grid gap-10 lg:grid-cols-2 lg:items-center">
            <div class="scroll-reveal" data-animate="left">
                <p class="nfd-kicker animate-reveal">{{ $sections['hero_kicker']->title ?? 'Steel Bridge Facilities' }}</p>
                <h1 class="animate-reveal animate-delay-1 mt-4 text-4xl font-extrabold leading-tight md:text-6xl">
                    {{ $sections['hero']->title ?? 'Complete Facilities Services' }}
                </h1>
                <p class="animate-reveal animate-delay-2 mt-6 max-w-2xl text-lg text-slate-300">
                    {{ $sections['hero']->content ?? 'Steel Bridge delivers professional facility support, repairs, and maintenance for commercial and industrial spaces.' }}
                </p>
                <div class="animate-reveal animate-delay-3 mt-8 flex flex-wrap gap-3">
                    <a href="{{ $sections['hero_primary_cta']->content ?? route('services.index') }}" class="nfd-btn-primary">{{ $sections['hero_primary_cta']->title ?? 'Explore Services' }}</a>
                    <a href="{{ $sections['hero_secondary_cta']->content ?? '#request-form' }}" class="nfd-btn-ghost">{{ $sections['hero_secondary_cta']->title ?? 'Request a Callback' }}</a>
                </div>
                @if ($heroChips->isNotEmpty())
                    <div class="animate-reveal animate-delay-4 mt-8 flex flex-wrap gap-2">
                        @foreach ($heroChips as $chip)
                            <span class="nfd-pill">{{ $chip }}</span>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="grid gap-4 scroll-reveal" data-animate="right">
                <article class="nfd-glow-card animate-reveal animate-delay-2">
                    <p class="nfd-kicker">{{ $sections['about']->subtitle ?? 'Experienced Operations Team' }}</p>
                    <h2 class="mt-3 text-2xl font-bold">{{ $sections['about']->title ?? 'About Steel Bridge' }}</h2>
                    <p class="mt-4 whitespace-pre-line text-slate-300">{{ $sections['about']->content ?? 'Our specialists provide reliable service delivery with transparent communication and measurable performance.' }}</p>
                </article>
                @if ($heroHighlights->isNotEmpty())
                    <div class="grid gap-4 sm:grid-cols-2">
                        @foreach ($heroHighlights as $index => $card)
                            <article class="nfd-card {{ $index === 0 ? 'float-slow' : 'float-slower' }}">
                                <p class="text-sm uppercase tracking-[0.2em] text-[var(--nfd-accent-soft)]">{{ $card['kicker'] }}</p>
                                <p class="mt-2 text-4xl font-black">{{ $card['value'] }}</p>
                                <p class="mt-1 text-sm text-slate-300">{{ $card['description'] }}</p>
                            </article>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </section>

    <section class="py-10">
        <div class="nfd-container stats-track">
            @foreach ($stats as $index => $stat)
                <article class="stats-tile animate-reveal animate-delay-{{ min($index + 1, 5) }} scroll-reveal" data-animate="zoom">
                    <p class="text-4xl font-black" style="color: var(--nfd-text)">{{ $stat['value'] }}</p>
                    <p class="mt-2 text-sm" style="color: var(--nfd-muted)">{{ $stat['label'] }}</p>
                </article>
            @endforeach
        </div>
    </section>

    @if ($showTrustedBrands)
        <section class="py-10">
            <div class="nfd-container">
                <p class="nfd-kicker text-center">{{ $sections['trusted_brands']->title ?? 'Trusted By' }}</p>
                <div class="mt-6 overflow-hidden rounded-2xl border border-white/10 bg-white/5 px-3 py-4">
                    @if ($trustedBrands->isNotEmpty())
                        <div class="logo-track flex items-center scroll-reveal" data-animate="zoom">
                            @for ($repeatIndex = 0; $repeatIndex < 2; $repeatIndex++)
                                @php $isClone = $repeatIndex === 1; @endphp
                                <div class="logo-group" @if($isClone) aria-hidden="true" @endif>
                                    @foreach ($trustedBrands as $brand)
                                        <div class="flex min-w-[180px] items-center justify-center rounded-xl border border-white/10 bg-white px-6 py-4">
                                            @if ($brand->website_url)
                                                <a href="{{ $brand->website_url }}" target="_blank" rel="noopener noreferrer">
                                                    <img src="{{ asset('storage/'.$brand->logo) }}" alt="{{ $brand->name }}" class="h-10 w-auto object-contain">
                                                </a>
                                            @else
                                                <img src="{{ asset('storage/'.$brand->logo) }}" alt="{{ $brand->name }}" class="h-10 w-auto object-contain">
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @endfor
                        </div>
                    @else
                        <p class="text-center text-sm text-slate-300">No trusted logos added yet.</p>
                    @endif
                </div>
            </div>
        </section>
    @endif

    @php
        $valueCards = collect([
            ['section' => $sections['why_us'] ?? null, 'classes' => 'nfd-glow-card animate-reveal scroll-reveal', 'animate' => 'left'],
            ['section' => $sections['value_one'] ?? null, 'classes' => 'nfd-card animate-reveal animate-delay-1 scroll-reveal', 'animate' => 'zoom'],
            ['section' => $sections['value_two'] ?? null, 'classes' => 'nfd-card animate-reveal animate-delay-2 scroll-reveal', 'animate' => 'right'],
        ]);
    @endphp

    <section class="py-10">
        <div class="nfd-container grid gap-5 md:grid-cols-3">
            @foreach ($valueCards as $card)
                @php
                    $section = $card['section'];
                    $backgroundStyle = !empty($section?->image)
                        ? "background-image: linear-gradient(rgba(15, 23, 42, 0.88), rgba(15, 23, 42, 0.92)), url('".asset('storage/'.$section->image)."'); background-size: cover; background-position: center;"
                        : '';
                @endphp
                <article class="{{ $card['classes'] }}" data-animate="{{ $card['animate'] }}" @if($backgroundStyle) style="{{ $backgroundStyle }}" @endif>
                    <p class="nfd-kicker">{{ $section?->subtitle ?? 'Core Value' }}</p>
                    <h3 class="mt-2 text-xl font-bold">{{ $section?->title ?? 'Section Title' }}</h3>
                    <p class="mt-3 text-slate-300">{{ $section?->content ?? 'Section description.' }}</p>
                </article>
            @endforeach
        </div>
    </section>

    <section class="py-14">
        <div class="nfd-container grid gap-8 lg:grid-cols-2 lg:items-center">
            <article class="nfd-card scroll-reveal" data-animate="left">
                <p class="nfd-kicker">Customer-Centric</p>
                <h2 class="mt-2 text-4xl font-extrabold">{{ $sections['customer_centric']->title ?? 'Customer-Centric' }}</h2>
                <p class="mt-3 text-lg font-semibold text-[var(--nfd-accent-soft)]">
                    {{ $sections['customer_centric']->subtitle ?? 'Dynamic, Flexible, and Eager to Please.' }}
                </p>
                <p class="mt-5 whitespace-pre-line text-slate-300">
                    {{ $sections['customer_centric']->content ?? 'We understand our customers situations, perceptions, and expectations. We put their needs first through clear and consistent communication.' }}
                </p>
                <div class="mt-6">
                    <a href="#request-form" class="nfd-btn-primary">Get Started</a>
                </div>
            </article>
            <div class="nfd-glow-card scroll-reveal" data-animate="right">
                @if (!empty($sections['customer_centric']->image))
                    <div class="hover-zoom rounded-2xl">
                        <img src="{{ asset('storage/'.$sections['customer_centric']->image) }}" alt="{{ $sections['customer_centric']->title ?? 'Customer Centric' }}" class="w-full rounded-2xl object-cover">
                    </div>
                @else
                    <div class="flex h-[320px] items-center justify-center rounded-2xl border border-white/10 bg-white/5 text-slate-300">
                        Upload `customer_centric` section image from Admin -> Homepage Sections.
                    </div>
                @endif
            </div>
        </div>
    </section>

    {{-- <section class="py-14">
        <div class="nfd-container rounded-3xl border border-white/10 bg-white/5 p-6 md:p-10">
            <h2 class="text-4xl font-extrabold">What we <span class="text-[var(--nfd-accent-soft)]">offer</span></h2>
            <div class="mt-8 grid gap-8 xl:grid-cols-[2fr_1fr]">
                <div class="grid gap-6 sm:grid-cols-3">
                    @forelse ($hardFacilityItems->take(3) as $item)
                        <article class="text-center scroll-reveal" data-animate="zoom">
                            <div class="hover-zoom mx-auto h-44 w-44 overflow-hidden rounded-full border border-white/10 bg-[var(--nfd-soft)] shadow-lg sm:h-56 sm:w-56">
                                <img src="{{ asset('storage/'.$item->image) }}" alt="{{ $item->title }}" class="h-full w-full object-cover">
                            </div>
                            <h3 class="mt-4 text-lg font-semibold">{{ $item->title }}</h3>
                        </article>
                    @empty
                        <p class="col-span-3 text-slate-300">Add Hard Facility items from Admin -> Homepage Items.</p>
                    @endforelse
                </div>
                <article class="nfd-card scroll-reveal" data-animate="right">
                    <h3 class="text-3xl font-bold">{{ $sections['hard_facility']->title ?? 'Hard Facility Management' }}</h3>
                    <p class="mt-4 whitespace-pre-line text-slate-300">
                        {{ $sections['hard_facility']->content ?? 'MEP engineering includes planning, designing, and managing core systems of a facility.' }}
                    </p>
                    <div class="mt-6">
                        <a href="{{ route('services.index') }}" class="nfd-btn-primary">Learn More</a>
                    </div>
                </article>
            </div>
        </div>
    </section> --}}

    {{-- <section class="py-14"> --}}
        {{-- <div class="nfd-container rounded-3xl border border-white/10 bg-white/5 p-6 md:p-10">
            <div class="grid gap-8 xl:grid-cols-[1fr_2fr]">
                <article class="nfd-card order-2 xl:order-1 scroll-reveal" data-animate="left">
                    <h3 class="text-3xl font-bold">{{ $sections['soft_facility']->title ?? 'Soft Facility Management' }}</h3>
                    <p class="mt-4 whitespace-pre-line text-slate-300">
                        {{ $sections['soft_facility']->content ?? 'Soft services maintain your revenue-generating assets and reduce failure and downtime.' }}
                    </p>
                    <div class="mt-6">
                        <a href="{{ route('services.index') }}" class="nfd-btn-primary">Learn More</a>
                    </div>
                </article>
                <div class="order-1 grid gap-6 sm:grid-cols-3 xl:order-2">
                    @forelse ($softFacilityItems->take(3) as $item)
                        <article class="text-center scroll-reveal" data-animate="zoom">
                            <div class="hover-zoom mx-auto h-44 w-44 overflow-hidden rounded-full border border-white/10 bg-[var(--nfd-soft)] shadow-lg sm:h-56 sm:w-56">
                                <img src="{{ asset('storage/'.$item->image) }}" alt="{{ $item->title }}" class="h-full w-full object-cover">
                            </div>
                            <h3 class="mt-4 text-lg font-semibold">{{ $item->title }}</h3>
                        </article>
                    @empty
                        <p class="col-span-3 text-slate-300">Add Soft Facility items from Admin -> Homepage Items.</p>
                    @endforelse
                </div>
            </div>
        </div> --}}
    {{-- </section> --}}

    <section class="py-12">
        <div class="nfd-container">
            <div class="mb-6 flex items-end justify-between">
                <div>
                    <p class="nfd-kicker">{{ $sections['services_preview']->subtitle ?? 'Our Offerings' }}</p>
                    <h2 class="mt-2 text-3xl font-bold">{{ $sections['services_preview']->title ?? 'Integrated Facilities Services' }}</h2>
                </div>
                <a href="{{ route('services.index') }}" class="text-sm font-semibold text-[var(--nfd-accent-soft)] hover:text-white">View all services</a>
            </div>

            <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-3">
                @forelse ($services as $service)
                    @php
                        $servicePreview = $service->images->first()?->path ?: $service->featured_image;
                    @endphp
                    <article class="nfd-card group relative overflow-hidden pr-28 transition hover:-translate-y-1 hover:border-[var(--nfd-accent)] scroll-reveal" data-animate="zoom">
                        <p class="text-xs uppercase tracking-[0.22em] text-[var(--nfd-accent-soft)]">{{ $service->category?->name }}</p>
                        <h3 class="mt-2 text-xl font-semibold">{{ $service->title }}</h3>
                        <p class="mt-3 max-w-[22rem] text-sm text-slate-300">{{ $service->short_description }}</p>
                        <a href="{{ route('services.show', $service->slug) }}" class="mt-5 inline-flex text-sm font-semibold text-[var(--nfd-accent-soft)]">Learn More</a>

                        @if ($servicePreview)
                            <div class="pointer-events-none absolute bottom-4 right-4 h-20 w-20 overflow-hidden rounded-2xl border border-white/10 bg-white/5 shadow-xl md:h-24 md:w-24">
                                <img src="{{ asset('storage/'.$servicePreview) }}" alt="{{ $service->title }} preview" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                            </div>
                        @endif
                    </article>
                @empty
                    <p class="text-slate-400">No published services yet.</p>
                @endforelse
            </div>
        </div>
    </section>

    @if ($homepageTabs->isNotEmpty())
        <section class="py-14">
            <div class="nfd-container">
                <div class="nfd-glow-card" x-data="{ activeTab: 0 }">
                    <div class="mb-6 flex flex-wrap gap-2">
                        @foreach ($homepageTabs as $index => $tab)
                            <button
                                type="button"
                                @click="activeTab = {{ $index }}"
                                :class="activeTab === {{ $index }} ? 'bg-[var(--nfd-accent)] text-white border-[var(--nfd-accent)]' : 'bg-white/5 text-[var(--nfd-text)] border-[var(--nfd-stroke)]'"
                                class="rounded-full border px-4 py-2 text-sm font-semibold transition hover:-translate-y-0.5"
                            >
                                {{ $tab->title }}
                            </button>
                        @endforeach
                    </div>

                    @foreach ($homepageTabs as $index => $tab)
                        <div x-cloak x-show="activeTab === {{ $index }}" x-transition:enter="transition ease-out duration-400" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="grid gap-8 lg:grid-cols-2 lg:items-center">
                            <article class="scroll-reveal is-visible" data-animate="left">
                                <p class="nfd-kicker">{{ $tab->subtitle ?: 'Service Detail' }}</p>
                                <h3 class="mt-3 text-3xl font-bold">{{ $tab->title }}</h3>
                                @if (!empty($tab->content))
                                    <p class="mt-4 whitespace-pre-line text-slate-300">{{ $tab->content }}</p>
                                @endif
                                @if (!empty($tab->button_text) && !empty($tab->button_link))
                                    <div class="mt-6">
                                        <a href="{{ $tab->button_link }}" class="nfd-btn-primary">{{ $tab->button_text }}</a>
                                    </div>
                                @endif
                            </article>

                            <div class="scroll-reveal is-visible hover-zoom rounded-2xl border border-white/10 bg-[var(--nfd-soft)] p-3" data-animate="right">
                                @if (!empty($tab->image))
                                    <img src="{{ asset('storage/'.$tab->image) }}" alt="{{ $tab->title }}" class="h-[280px] w-full rounded-xl object-cover sm:h-[360px]">
                                @else
                                    <div class="flex h-[280px] w-full items-center justify-center rounded-xl bg-white/5 text-sm text-slate-300 sm:h-[360px]">
                                        Upload a tab image from Admin -> Homepage Tabs.
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <section class="py-14">
        <div class="nfd-container grid gap-6 lg:grid-cols-2">
            <article class="nfd-glow-card scroll-reveal" data-animate="left">
                <p class="nfd-kicker">{{ $sections['process']->content ?? 'How We Work' }}</p>
                <h2 class="mt-2 text-3xl font-bold">{{ $sections['process']->title ?? 'A delivery model built for uptime and control' }}</h2>
                <p class="mt-3 text-slate-300">{{ $sections['process']->subtitle ?? 'Three clear phases from intake to optimization.' }}</p>
                <div class="mt-6 space-y-4">
                    @foreach ($processSteps as $step)
                        <div class="rounded-xl border border-white/10 bg-[var(--nfd-soft)] p-4">
                            <p class="text-xs uppercase tracking-[0.2em] text-[var(--nfd-accent-soft)]">{{ $step['eyebrow'] }}</p>
                            <p class="mt-2 text-sm text-slate-300">{{ $step['description'] }}</p>
                        </div>
                    @endforeach
                </div>
            </article>

            <article class="nfd-card scroll-reveal" data-animate="right">
                <p class="nfd-kicker">{{ $sections['industries']->subtitle ?? 'Industries We Support' }}</p>
                <h3 class="mt-2 text-2xl font-bold">{{ $sections['industries']->title ?? 'Operational support across high-demand sectors' }}</h3>
                <div class="mt-6 grid grid-cols-2 gap-3">
                    @foreach ($industries as $industry)
                        <div class="rounded-xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-slate-200">{{ $industry }}</div>
                    @endforeach
                </div>
            </article>
        </div>
    </section>

    <section class="py-10">
        <div class="nfd-container overflow-hidden rounded-2xl border border-white/10 bg-white/5 p-5">
            <div class="logo-track flex items-center gap-5">
                @for ($i = 0; $i < 2; $i++)
                    <div class="logo-group" @if($i === 1) aria-hidden="true" @endif>
                        @foreach ($testimonials as $testimonial)
                            <article class="mx-2 w-[320px] rounded-xl border border-white/10 bg-[var(--nfd-panel)] p-5">
                                <p class="text-sm text-slate-200">"{{ $testimonial['quote'] }}"</p>
                                <p class="mt-4 text-xs uppercase tracking-[0.15em] text-[var(--nfd-accent-soft)]">{{ $testimonial['author'] ?: 'Client' }}</p>
                            </article>
                        @endforeach
                    </div>
                @endfor
            </div>
        </div>
    </section>

    <section id="request-form" class="py-14">
        <div class="nfd-container grid gap-6 lg:grid-cols-2">
            <div class="nfd-glow-card overflow-hidden p-0">
                @if (!empty($sections['request_cta']->image))
                    <img src="{{ asset('storage/'.$sections['request_cta']->image) }}" alt="{{ $sections['request_cta']->title ?? 'Request a visit' }}" class="h-full min-h-[420px] w-full object-cover">
                @else
                    <div class="flex h-full min-h-[420px] items-center justify-center rounded-3xl border border-white/10 bg-[var(--nfd-soft)] p-8 text-center text-sm text-slate-300">
                        Upload an image for the <code class="mx-1">request_cta</code> homepage section from admin to show it here.
                    </div>
                @endif
            </div>

            <div class="nfd-card relative overflow-hidden">
                <div class="pointer-events-none absolute -right-8 -top-8 h-36 w-36 rounded-full bg-[var(--nfd-accent)]/25 blur-2xl"></div>
                <p class="nfd-kicker">{{ $sections['walkthrough_cta']->subtitle ?? 'Contact' }}</p>
                <h2 class="mt-2 text-3xl font-bold">{{ $sections['walkthrough_cta']->title ?? 'Schedule A Walkthrough' }}</h2>
                <p class="mt-3 text-slate-300">{{ $sections['walkthrough_cta']->content ?? 'Fast response, clear next steps, and a team that understands mission-critical facilities.' }}</p>

                        <form method="POST" action="{{ route('contact-messages.store') }}" class="mt-6 space-y-3">
                    @csrf
                    <div class="grid gap-3 sm:grid-cols-2">
                        <input type="text" name="full_name" placeholder="Full name" class="w-full rounded-xl border border-white/10 bg-[var(--nfd-soft)] px-3 py-3 text-sm" required>
                        <input type="text" name="phone" placeholder="Phone" class="w-full rounded-xl border border-white/10 bg-[var(--nfd-soft)] px-3 py-3 text-sm" required>
                    </div>
                    <input type="email" name="email" placeholder="Email" class="w-full rounded-xl border border-white/10 bg-[var(--nfd-soft)] px-3 py-3 text-sm" required>
                    <textarea name="message" rows="5" placeholder="Tell us what you need help with" class="w-full rounded-xl border border-white/10 bg-[var(--nfd-soft)] px-3 py-3 text-sm" required></textarea>
                    <button type="submit" class="nfd-btn-outline w-full">Send Message</button>
                </form>
            </div>
        </div>
    </section>
@endsection
