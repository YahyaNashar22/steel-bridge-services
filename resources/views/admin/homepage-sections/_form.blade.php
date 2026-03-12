@csrf

<div class="space-y-4">
    <div>
        <label for="key" class="mb-1 block text-sm font-medium">Key</label>
        <input id="key" name="key" type="text" value="{{ old('key', $homepageSection->key ?? '') }}" class="w-full rounded border border-slate-300 px-3 py-2" required>
    </div>

    <div>
        <label for="title" class="mb-1 block text-sm font-medium">Title</label>
        <input id="title" name="title" type="text" value="{{ old('title', $homepageSection->title ?? '') }}" class="w-full rounded border border-slate-300 px-3 py-2">
    </div>

    <div>
        <label for="subtitle" class="mb-1 block text-sm font-medium">Subtitle</label>
        <input id="subtitle" name="subtitle" type="text" value="{{ old('subtitle', $homepageSection->subtitle ?? '') }}" class="w-full rounded border border-slate-300 px-3 py-2">
    </div>

    <div>
        <label for="content" class="mb-1 block text-sm font-medium">Content</label>
        <textarea id="content" name="content" rows="6" class="w-full rounded border border-slate-300 px-3 py-2">{{ old('content', $homepageSection->content ?? '') }}</textarea>
    </div>

    <div>
        <label for="image" class="mb-1 block text-sm font-medium">Image</label>
        <input id="image" name="image" type="file" class="w-full rounded border border-slate-300 px-3 py-2">
        @if (!empty($homepageSection?->image))
            <p class="mt-1 text-xs text-slate-500">Current: {{ $homepageSection->image }}</p>
            <label class="mt-2 inline-flex items-center gap-2 text-sm text-red-600">
                <input type="checkbox" name="remove_image" value="1">
                Remove current image
            </label>
        @endif
    </div>

    <div>
        <label for="video" class="mb-1 block text-sm font-medium">Video (mp4/webm/ogg)</label>
        <input id="video" name="video" type="file" class="w-full rounded border border-slate-300 px-3 py-2">
        @if (!empty($homepageSection?->video))
            <p class="mt-1 text-xs text-slate-500">Current: {{ $homepageSection->video }}</p>
            <label class="mt-2 inline-flex items-center gap-2 text-sm text-red-600">
                <input type="checkbox" name="remove_video" value="1">
                Remove current video
            </label>
        @endif
    </div>
</div>

<div class="mt-6 flex items-center gap-3">
    <button type="submit" class="rounded bg-orange-500 px-4 py-2 font-medium text-white hover:bg-orange-600">Save</button>
    <a href="{{ route('admin.homepage-sections.index') }}" class="text-sm text-slate-600 hover:text-slate-900">Cancel</a>
</div>
