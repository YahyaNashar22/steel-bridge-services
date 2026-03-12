@csrf

<div class="space-y-4">
    <div>
        <label for="title" class="mb-1 block text-sm font-medium">Tab Title</label>
        <input id="title" name="title" type="text" value="{{ old('title', $homepageTab->title ?? '') }}" class="w-full rounded border border-slate-300 px-3 py-2" required>
    </div>

    <div>
        <label for="subtitle" class="mb-1 block text-sm font-medium">Subtitle</label>
        <input id="subtitle" name="subtitle" type="text" value="{{ old('subtitle', $homepageTab->subtitle ?? '') }}" class="w-full rounded border border-slate-300 px-3 py-2">
    </div>

    <div>
        <label for="content" class="mb-1 block text-sm font-medium">Content</label>
        <textarea id="content" name="content" rows="5" class="w-full rounded border border-slate-300 px-3 py-2">{{ old('content', $homepageTab->content ?? '') }}</textarea>
    </div>

    <div>
        <label for="image" class="mb-1 block text-sm font-medium">Image</label>
        <input id="image" name="image" type="file" class="w-full rounded border border-slate-300 px-3 py-2" {{ isset($homepageTab) ? '' : 'required' }}>
        @if (!empty($homepageTab?->image))
            <p class="mt-1 text-xs text-slate-500">Current: {{ $homepageTab->image }}</p>
            <label class="mt-2 inline-flex items-center gap-2 text-sm text-red-600">
                <input type="checkbox" name="remove_image" value="1">
                Remove current image
            </label>
        @endif
    </div>

    <div class="grid gap-4 md:grid-cols-2">
        <div>
            <label for="button_text" class="mb-1 block text-sm font-medium">Button Text (optional)</label>
            <input id="button_text" name="button_text" type="text" value="{{ old('button_text', $homepageTab->button_text ?? '') }}" class="w-full rounded border border-slate-300 px-3 py-2">
        </div>
        <div>
            <label for="button_link" class="mb-1 block text-sm font-medium">Button Link (optional)</label>
            <input id="button_link" name="button_link" type="url" value="{{ old('button_link', $homepageTab->button_link ?? '') }}" class="w-full rounded border border-slate-300 px-3 py-2">
        </div>
    </div>

    <div class="grid gap-4 md:grid-cols-2">
        <div>
            <label for="sort_order" class="mb-1 block text-sm font-medium">Sort Order</label>
            <input id="sort_order" name="sort_order" type="number" min="0" value="{{ old('sort_order', $homepageTab->sort_order ?? 0) }}" class="w-full rounded border border-slate-300 px-3 py-2">
        </div>
        <div class="flex items-end">
            <label class="inline-flex items-center gap-2 rounded border border-slate-300 px-3 py-2">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" value="1" @checked((bool) old('is_active', $homepageTab->is_active ?? true))>
                <span class="text-sm">Active</span>
            </label>
        </div>
    </div>
</div>

<div class="mt-6 flex items-center gap-3">
    <button type="submit" class="rounded bg-orange-500 px-4 py-2 font-medium text-white hover:bg-orange-600">Save</button>
    <a href="{{ route('admin.homepage-tabs.index') }}" class="text-sm text-slate-600 hover:text-slate-900">Cancel</a>
</div>
