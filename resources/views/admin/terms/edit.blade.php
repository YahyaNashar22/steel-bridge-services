@extends('admin.layout')

@section('content')
    <h1 class="mb-6 text-2xl font-bold">Terms and Copyrights Page</h1>

    <div class="rounded-lg bg-white p-6 shadow">
        <form method="POST" action="{{ route('admin.terms.update') }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="terms_page_title" class="mb-1 block text-sm font-medium">Page Title</label>
                <input
                    id="terms_page_title"
                    name="terms_page_title"
                    type="text"
                    value="{{ old('terms_page_title', $settings['terms_page_title'] ?? 'Terms and Conditions') }}"
                    class="w-full rounded border border-slate-300 px-3 py-2"
                >
            </div>

            <div>
                <label for="terms_page_intro" class="mb-1 block text-sm font-medium">Intro Text</label>
                <textarea
                    id="terms_page_intro"
                    name="terms_page_intro"
                    rows="3"
                    class="w-full rounded border border-slate-300 px-3 py-2"
                >{{ old('terms_page_intro', $settings['terms_page_intro'] ?? 'Review the terms governing the use of Steel Bridge Services.') }}</textarea>
            </div>

            <div>
                <label for="terms_page_content" class="mb-1 block text-sm font-medium">Terms Content</label>
                <textarea
                    id="terms_page_content"
                    name="terms_page_content"
                    rows="14"
                    class="w-full rounded border border-slate-300 px-3 py-2"
                >{{ old('terms_page_content', $settings['terms_page_content'] ?? '') }}</textarea>
            </div>

            <div>
                <label for="copyright_title" class="mb-1 block text-sm font-medium">Copyright Section Title</label>
                <input
                    id="copyright_title"
                    name="copyright_title"
                    type="text"
                    value="{{ old('copyright_title', $settings['copyright_title'] ?? 'Copyright Notice') }}"
                    class="w-full rounded border border-slate-300 px-3 py-2"
                >
            </div>

            <div>
                <label for="copyright_content" class="mb-1 block text-sm font-medium">Copyright Content</label>
                <textarea
                    id="copyright_content"
                    name="copyright_content"
                    rows="8"
                    class="w-full rounded border border-slate-300 px-3 py-2"
                >{{ old('copyright_content', $settings['copyright_content'] ?? '') }}</textarea>
            </div>

            <button type="submit" class="rounded bg-orange-500 px-4 py-2 font-medium text-white hover:bg-orange-600">
                Save Terms Page
            </button>
        </form>
    </div>
@endsection
