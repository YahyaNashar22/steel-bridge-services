@extends('website.layout', ['metaTitle' => $metaTitle, 'metaDescription' => $metaDescription, 'settings' => $settings])

@section('content')
    <section class="border-b border-white/10 py-16">
        <div class="nfd-container">
            <p class="nfd-kicker">{{ $pageKicker }}</p>
            <h1 class="mt-3 text-4xl font-extrabold md:text-5xl">{{ $pageTitle }}</h1>
            <p class="mt-4 max-w-3xl text-base text-slate-300 md:text-lg">{{ $pageIntro }}</p>
        </div>
    </section>

    <section class="py-12">
        <div class="nfd-container grid gap-6">
            <article class="nfd-card">
                <h2 class="text-2xl font-bold">{{ $contentTitle }}</h2>
                <div class="mt-4 whitespace-pre-line text-slate-300">{{ $contentBody }}</div>
            </article>
        </div>
    </section>
@endsection
