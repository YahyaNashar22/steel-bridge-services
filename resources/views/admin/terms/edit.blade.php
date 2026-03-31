@extends('admin.layout')

@section('content')
    <h1 class="mb-6 text-2xl font-bold">Legal Pages</h1>

    <div class="rounded-lg bg-white p-6 shadow">
        <form method="POST" action="{{ route('admin.terms.update') }}" class="space-y-8">
            @csrf
            @method('PUT')

            <section class="space-y-6 rounded-xl border border-slate-200 p-5">
                <div>
                    <h2 class="text-lg font-semibold">Terms Page</h2>
                    <p class="mt-1 text-sm text-slate-500">Controls the public Terms page.</p>
                </div>

                <div>
                    <label for="terms_page_title" class="mb-1 block text-sm font-medium">Terms Title</label>
                    <input id="terms_page_title" name="terms_page_title" type="text" value="{{ old('terms_page_title', $settings['terms_page_title'] ?? 'Terms and Conditions') }}" class="w-full rounded border border-slate-300 px-3 py-2">
                </div>

                <div>
                    <label for="terms_page_intro" class="mb-1 block text-sm font-medium">Terms Intro</label>
                    <textarea id="terms_page_intro" name="terms_page_intro" rows="3" class="w-full rounded border border-slate-300 px-3 py-2">{{ old('terms_page_intro', $settings['terms_page_intro'] ?? 'Review the terms governing the use of Steel Bridge Services and this website.') }}</textarea>
                </div>

                <div>
                    <label for="terms_page_content" class="mb-1 block text-sm font-medium">Terms Content</label>
                    <textarea id="terms_page_content" name="terms_page_content" rows="12" class="w-full rounded border border-slate-300 px-3 py-2">{{ old('terms_page_content', $settings['terms_page_content'] ?? '') }}</textarea>
                </div>
            </section>

            <section class="space-y-6 rounded-xl border border-slate-200 p-5">
                <div>
                    <h2 class="text-lg font-semibold">Privacy Page</h2>
                    <p class="mt-1 text-sm text-slate-500">Controls the public Privacy page.</p>
                </div>

                <div>
                    <label for="privacy_page_title" class="mb-1 block text-sm font-medium">Privacy Title</label>
                    <input id="privacy_page_title" name="privacy_page_title" type="text" value="{{ old('privacy_page_title', $settings['privacy_page_title'] ?? 'Privacy Policy') }}" class="w-full rounded border border-slate-300 px-3 py-2">
                </div>

                <div>
                    <label for="privacy_page_intro" class="mb-1 block text-sm font-medium">Privacy Intro</label>
                    <textarea id="privacy_page_intro" name="privacy_page_intro" rows="3" class="w-full rounded border border-slate-300 px-3 py-2">{{ old('privacy_page_intro', $settings['privacy_page_intro'] ?? 'Review how Steel Bridge Services collects, uses, and protects your information.') }}</textarea>
                </div>

                <div>
                    <label for="privacy_page_content" class="mb-1 block text-sm font-medium">Privacy Content</label>
                    <textarea id="privacy_page_content" name="privacy_page_content" rows="12" class="w-full rounded border border-slate-300 px-3 py-2">{{ old('privacy_page_content', $settings['privacy_page_content'] ?? '') }}</textarea>
                </div>
            </section>

            <button type="submit" class="rounded bg-orange-500 px-4 py-2 font-medium text-white hover:bg-orange-600">Save Legal Pages</button>
        </form>
    </div>
@endsection
