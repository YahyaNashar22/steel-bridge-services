@csrf

<div class="space-y-4">
    <div>
        <label for="section" class="mb-1 block text-sm font-medium">Section</label>
        <select id="section" name="section" class="w-full rounded border border-slate-300 px-3 py-2" required>
            <option value="">Select section</option>
            <option value="hard_facility" @selected(old('section', $homepageServiceItem->section ?? '') === 'hard_facility')>Hard Facility</option>
            <option value="soft_facility" @selected(old('section', $homepageServiceItem->section ?? '') === 'soft_facility')>Soft Facility</option>
        </select>
    </div>

    <div>
        <label for="title" class="mb-1 block text-sm font-medium">Item Title</label>
        <input id="title" name="title" type="text" value="{{ old('title', $homepageServiceItem->title ?? '') }}" class="w-full rounded border border-slate-300 px-3 py-2" required>
    </div>

    <div>
        <label for="image" class="mb-1 block text-sm font-medium">Image</label>
        <input id="image" name="image" type="file" class="w-full rounded border border-slate-300 px-3 py-2" {{ isset($homepageServiceItem) ? '' : 'required' }}>
        @if (!empty($homepageServiceItem?->image))
            <p class="mt-1 text-xs text-slate-500">Current: {{ $homepageServiceItem->image }}</p>
            <label class="mt-2 inline-flex items-center gap-2 text-sm text-red-600">
                <input type="checkbox" name="remove_image" value="1">
                Remove current image
            </label>
        @endif
    </div>

    <div class="grid gap-4 md:grid-cols-2">
        <div>
            <label for="link" class="mb-1 block text-sm font-medium">Optional Link</label>
            <input id="link" name="link" type="url" value="{{ old('link', $homepageServiceItem->link ?? '') }}" class="w-full rounded border border-slate-300 px-3 py-2">
        </div>
        <div>
            <label for="sort_order" class="mb-1 block text-sm font-medium">Sort Order</label>
            <input id="sort_order" name="sort_order" type="number" min="0" value="{{ old('sort_order', $homepageServiceItem->sort_order ?? 0) }}" class="w-full rounded border border-slate-300 px-3 py-2">
        </div>
    </div>

    <label class="inline-flex items-center gap-2 rounded border border-slate-300 px-3 py-2">
        <input type="hidden" name="is_active" value="0">
        <input type="checkbox" name="is_active" value="1" @checked((bool) old('is_active', $homepageServiceItem->is_active ?? true))>
        <span class="text-sm">Active</span>
    </label>
</div>

<div class="mt-6 flex items-center gap-3">
    <button type="submit" class="rounded bg-orange-500 px-4 py-2 font-medium text-white hover:bg-orange-600">Save</button>
    <a href="{{ route('admin.homepage-service-items.index') }}" class="text-sm text-slate-600 hover:text-slate-900">Cancel</a>
</div>
