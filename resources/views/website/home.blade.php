@extends('website.layout', ['metaTitle' => ($sections['hero']->title ?? config('app.name')), 'settings' => $settings])

@php
    $stats = [
        ['value' => $sections['stats_1']->title ?? '24/7', 'label' => $sections['stats_1']->subtitle ?? 'Support Availability'],
        ['value' => $sections['stats_2']->title ?? '98%', 'label' => $sections['stats_2']->subtitle ?? 'First-Visit Resolution'],
        ['value' => $sections['stats_3']->title ?? '450+', 'label' => $sections['stats_3']->subtitle ?? 'Facilities Supported'],
        ['value' => $sections['stats_4']->title ?? '12+', 'label' => $sections['stats_4']->subtitle ?? 'Years Experience'],
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
                <p class="nfd-kicker animate-reveal">Steel Bridge Facilities</p>
                <h1 class="animate-reveal animate-delay-1 mt-4 text-4xl font-extrabold leading-tight md:text-6xl">
                    {{ $sections['hero']->title ?? 'Powering High-Performance Facilities With Precision Support' }}
                </h1>
                <p class="animate-reveal animate-delay-2 mt-6 max-w-2xl text-lg text-slate-300">
                    {{ $sections['hero']->content ?? 'From planned maintenance to emergency response and specialist project delivery, we keep your operations moving with speed, control, and consistency.' }}
                </p>
                <div class="animate-reveal animate-delay-3 mt-8 flex flex-wrap gap-3">
                    <a href="{{ route('services.index') }}" class="nfd-btn-primary">Explore Services</a>
                    <a href="#request-form" class="nfd-btn-ghost">Request a Callback</a>
                </div>
                <div class="animate-reveal animate-delay-4 mt-8 flex flex-wrap gap-2">
                    <span class="nfd-pill">Nationwide Coverage</span>
                    <span class="nfd-pill">Rapid Response Teams</span>
                    <span class="nfd-pill">Compliance-Ready Workflows</span>
                </div>
            </div>

            <div class="grid gap-4 scroll-reveal" data-animate="right">
                <article class="nfd-glow-card animate-reveal animate-delay-2">
                    <p class="nfd-kicker">{{ $sections['about']->subtitle ?? 'Who We Are' }}</p>
                    <h2 class="mt-3 text-2xl font-bold">{{ $sections['about']->title ?? 'A strategic partner for complete facilities support' }}</h2>
                    <p class="mt-4 whitespace-pre-line text-slate-300">{{ $sections['about']->content ?? 'Our operations team delivers planned, reactive, and compliance-focused services for facilities that cannot afford downtime.' }}</p>
                </article>
                <div class="grid gap-4 sm:grid-cols-2">
                    <article class="nfd-card float-slow">
                        <p class="text-sm uppercase tracking-[0.2em] text-[var(--nfd-accent-soft)]">Service Speed</p>
                        <p class="mt-2 text-4xl font-black">2h</p>
                        <p class="mt-1 text-sm text-slate-300">Priority dispatch response target.</p>
                    </article>
                    <article class="nfd-card float-slower">
                        <p class="text-sm uppercase tracking-[0.2em] text-[var(--nfd-accent-soft)]">Client Retention</p>
                        <p class="mt-2 text-4xl font-black">92%</p>
                        <p class="mt-1 text-sm text-slate-300">Partnerships renewed year-on-year.</p>
                    </article>
                </div>
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

    <section class="py-10">
        <div class="nfd-container">
            <p class="nfd-kicker text-center">Trusted By</p>
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

    <section class="py-10">
        <div class="nfd-container grid gap-5 md:grid-cols-3">
            <article class="nfd-glow-card animate-reveal scroll-reveal" data-animate="left">
                <p class="nfd-kicker">{{ $sections['why_us']->subtitle ?? 'The Difference' }}</p>
                <h3 class="mt-2 text-xl font-bold">{{ $sections['why_us']->title ?? 'Why clients choose our team' }}</h3>
                <p class="mt-3 text-slate-300">{{ $sections['why_us']->content ?? 'Strong governance, rapid mobilization, transparent communication, and measurable service standards.' }}</p>
            </article>
            <article class="nfd-card animate-reveal animate-delay-1 scroll-reveal" data-animate="zoom">
                <p class="nfd-kicker">Core Value</p>
                <h3 class="mt-2 text-xl font-bold">{{ $sections['value_one']->title ?? 'Customer Centric' }}</h3>
                <p class="mt-3 text-slate-300">{{ $sections['value_one']->content ?? 'Every workflow is designed around client outcomes, not internal convenience.' }}</p>
            </article>
            <article class="nfd-card animate-reveal animate-delay-2 scroll-reveal" data-animate="right">
                <p class="nfd-kicker">Core Value</p>
                <h3 class="mt-2 text-xl font-bold">{{ $sections['value_two']->title ?? 'Operational Excellence' }}</h3>
                <p class="mt-3 text-slate-300">{{ $sections['value_two']->content ?? 'Consistency, safety, and quality controls are embedded in each service operation.' }}</p>
            </article>
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

    <section class="py-14">
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
    </section>

    <section class="py-14">
        <div class="nfd-container rounded-3xl border border-white/10 bg-white/5 p-6 md:p-10">
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
        </div>
    </section>

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
                    <article class="nfd-card group transition hover:-translate-y-1 hover:border-[var(--nfd-accent)] scroll-reveal" data-animate="zoom">
                        <p class="text-xs uppercase tracking-[0.22em] text-[var(--nfd-accent-soft)]">{{ $service->category?->name }}</p>
                        <h3 class="mt-2 text-xl font-semibold">{{ $service->title }}</h3>
                        <p class="mt-3 text-sm text-slate-300">{{ $service->short_description }}</p>
                        <a href="{{ route('services.show', $service->slug) }}" class="mt-5 inline-flex text-sm font-semibold text-[var(--nfd-accent-soft)]">Learn More</a>
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
                <p class="nfd-kicker">How We Work</p>
                <h2 class="mt-2 text-3xl font-bold">{{ $sections['process']->title ?? 'A delivery model built for uptime and control' }}</h2>
                <p class="mt-3 text-slate-300">{{ $sections['process']->subtitle ?? 'Three clear phases from intake to optimization.' }}</p>
                <div class="mt-6 space-y-4">
                    <div class="rounded-xl border border-white/10 bg-[var(--nfd-soft)] p-4">
                        <p class="text-xs uppercase tracking-[0.2em] text-[var(--nfd-accent-soft)]">01 Diagnose</p>
                        <p class="mt-2 text-sm text-slate-300">On-site or remote assessment with scope clarity and risk mapping.</p>
                    </div>
                    <div class="rounded-xl border border-white/10 bg-[var(--nfd-soft)] p-4">
                        <p class="text-xs uppercase tracking-[0.2em] text-[var(--nfd-accent-soft)]">02 Deliver</p>
                        <p class="mt-2 text-sm text-slate-300">Planned execution with live progress updates and quality checks.</p>
                    </div>
                    <div class="rounded-xl border border-white/10 bg-[var(--nfd-soft)] p-4">
                        <p class="text-xs uppercase tracking-[0.2em] text-[var(--nfd-accent-soft)]">03 Optimize</p>
                        <p class="mt-2 text-sm text-slate-300">Preventive recommendations and performance reporting.</p>
                    </div>
                </div>
            </article>

            <article class="nfd-card scroll-reveal" data-animate="right">
                <p class="nfd-kicker">Industries We Support</p>
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
            <div class="nfd-glow-card">
                <p class="nfd-kicker">{{ $sections['request_cta']->subtitle ?? 'Need Support?' }}</p>
                <h2 class="mt-2 text-3xl font-bold">{{ $sections['request_cta']->title ?? 'Request Service Support' }}</h2>
                <p class="mt-4 text-slate-300">{{ $sections['request_cta']->content ?? 'Share your requirement and our operations team will contact you with the right plan.' }}</p>

                <form method="POST" action="{{ route('service-requests.store') }}" class="mt-6 space-y-3">
                    @csrf
                    <select name="service_id" class="w-full rounded-xl border border-white/10 bg-[var(--nfd-soft)] px-3 py-3 text-sm">
                        <option value="">Select service (optional)</option>
                        @foreach ($services as $service)
                            <option value="{{ $service->id }}">{{ $service->title }}</option>
                        @endforeach
                    </select>
                    <input type="text" name="full_name" placeholder="Full name" class="w-full rounded-xl border border-white/10 bg-[var(--nfd-soft)] px-3 py-3 text-sm" required>
                    <input type="text" name="phone" placeholder="Phone" class="w-full rounded-xl border border-white/10 bg-[var(--nfd-soft)] px-3 py-3 text-sm" required>
                    <input type="email" name="email" placeholder="Email" class="w-full rounded-xl border border-white/10 bg-[var(--nfd-soft)] px-3 py-3 text-sm" required>
                    <textarea name="description" rows="5" placeholder="Describe your requirement" class="w-full rounded-xl border border-white/10 bg-[var(--nfd-soft)] px-3 py-3 text-sm" required></textarea>
                    <button type="submit" class="nfd-btn-primary w-full">Submit Request</button>
                </form>
            </div>

            <div class="nfd-card relative overflow-hidden">
                <div class="pointer-events-none absolute -right-8 -top-8 h-36 w-36 rounded-full bg-[var(--nfd-accent)]/25 blur-2xl"></div>
                <p class="nfd-kicker">Contact</p>
                <h2 class="mt-2 text-3xl font-bold">Talk To Our Team Today</h2>
                <p class="mt-3 text-slate-300">Fast response, clear next steps, and a team that understands mission-critical facilities.</p>

                <div class="mt-5 grid gap-3 sm:grid-cols-2">
                    <div class="rounded-xl border border-white/10 bg-white/5 p-4">
                        <p class="text-xs uppercase tracking-[0.2em] text-[var(--nfd-accent-soft)]">Phone</p>
                        <p class="mt-2 text-sm text-white">{{ $settings['company_phone'] ?? 'Add in settings' }}</p>
                    </div>
                    <div class="rounded-xl border border-white/10 bg-white/5 p-4">
                        <p class="text-xs uppercase tracking-[0.2em] text-[var(--nfd-accent-soft)]">Email</p>
                        <p class="mt-2 text-sm text-white">{{ $settings['company_email'] ?? 'Add in settings' }}</p>
                    </div>
                </div>

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
