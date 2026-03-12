@extends('website.layout', ['metaTitle' => $metaTitle, 'metaDescription' => $metaDescription, 'settings' => $settings])

@section('content')
    <section class="border-b border-white/10 py-16">
        <div class="nfd-container">
            <p class="nfd-kicker">Legal</p>
            <h1 class="mt-3 text-4xl font-extrabold md:text-5xl">
                {{ $settings['terms_page_title'] ?? 'Terms and Conditions' }}
            </h1>
            <p class="mt-4 max-w-3xl text-base text-slate-300 md:text-lg">
                {{ $settings['terms_page_intro'] ?? 'Review the terms governing the use of Steel Bridge Services and the ownership of website content.' }}
            </p>
        </div>
    </section>

    <section class="py-12">
        <div class="nfd-container grid gap-6">
            <article class="nfd-card">
                <h2 class="text-2xl font-bold">Terms and Conditions</h2>
                <div class="mt-4 whitespace-pre-line text-slate-300">
                    {{ $settings['terms_page_content'] ?? 'Terms content has not been added yet.' }}
                </div>
            </article>

            <article class="nfd-card">
                <h2 class="text-2xl font-bold">{{ $settings['copyright_title'] ?? 'Copyright Notice' }}</h2>
                <div class="mt-4 whitespace-pre-line text-slate-300">
                    {{ $settings['copyright_content'] ?? 'Copyright content has not been added yet.' }}
                </div>
            </article>
        </div>
    </section>
@endsection
