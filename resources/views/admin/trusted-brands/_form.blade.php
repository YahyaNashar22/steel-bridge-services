@csrf

<div class="space-y-4">
    <div>
        <label for="name" class="mb-1 block text-sm font-medium">Brand Name</label>
        <input id="name" name="name" type="text" value="{{ old('name', $trustedBrand->name ?? '') }}" class="w-full rounded border border-slate-300 px-3 py-2" required>
    </div>

    <div>
        <label for="website_url" class="mb-1 block text-sm font-medium">Website URL (optional)</label>
        <input id="website_url" name="website_url" type="url" value="{{ old('website_url', $trustedBrand->website_url ?? '') }}" class="w-full rounded border border-slate-300 px-3 py-2">
    </div>

    <div class="grid gap-4 md:grid-cols-2">
        <div>
            <label for="sort_order" class="mb-1 block text-sm font-medium">Sort Order</label>
            <input id="sort_order" name="sort_order" type="number" min="0" value="{{ old('sort_order', $trustedBrand->sort_order ?? 0) }}" class="w-full rounded border border-slate-300 px-3 py-2">
        </div>
        <div class="flex items-end">
            <label class="inline-flex items-center gap-2 rounded border border-slate-300 px-3 py-2">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" value="1" @checked((bool) old('is_active', $trustedBrand->is_active ?? true))>
                <span class="text-sm">Active</span>
            </label>
        </div>
    </div>

    <div>
        <label for="logo" class="mb-1 block text-sm font-medium">Logo Image</label>
        <input id="logo" name="logo" type="file" class="w-full rounded border border-slate-300 px-3 py-2" {{ isset($trustedBrand) ? '' : 'required' }}>
        @if (!empty($trustedBrand?->logo))
            <p class="mt-1 text-xs text-slate-500">Current: {{ $trustedBrand->logo }}</p>
            <label class="mt-2 inline-flex items-center gap-2 text-sm text-red-600">
                <input type="checkbox" name="remove_logo" value="1">
                Remove current logo
            </label>
        @endif
    </div>
</div>

<div class="mt-6 flex items-center gap-3">
    <button type="submit" class="rounded bg-orange-500 px-4 py-2 font-medium text-white hover:bg-orange-600">Save</button>
    <a href="{{ route('admin.trusted-brands.index') }}" class="text-sm text-slate-600 hover:text-slate-900">Cancel</a>
</div>
