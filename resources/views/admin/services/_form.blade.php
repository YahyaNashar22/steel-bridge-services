@csrf

<div class="grid gap-4 md:grid-cols-2">
    <div>
        <label for="service_category_id" class="mb-1 block text-sm font-medium">Category</label>
        <select id="service_category_id" name="service_category_id" class="w-full rounded border border-slate-300 px-3 py-2" required>
            <option value="">Select category</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected((int) old('service_category_id', $service->service_category_id ?? 0) === $category->id)>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="title" class="mb-1 block text-sm font-medium">Title</label>
        <input id="title" name="title" type="text" value="{{ old('title', $service->title ?? '') }}" class="w-full rounded border border-slate-300 px-3 py-2" required>
    </div>
</div>

<div class="mt-4">
    <label for="slug" class="mb-1 block text-sm font-medium">Slug (optional)</label>
    <input id="slug" name="slug" type="text" value="{{ old('slug', $service->slug ?? '') }}" class="w-full rounded border border-slate-300 px-3 py-2">
</div>

<div class="mt-4">
    <label for="short_description" class="mb-1 block text-sm font-medium">Short Description</label>
    <textarea id="short_description" name="short_description" rows="3" class="w-full rounded border border-slate-300 px-3 py-2" required>{{ old('short_description', $service->short_description ?? '') }}</textarea>
</div>

<div class="mt-4">
    <label for="long_description" class="mb-1 block text-sm font-medium">Long Description</label>
    <textarea id="long_description" name="long_description" rows="6" class="w-full rounded border border-slate-300 px-3 py-2" required>{{ old('long_description', $service->long_description ?? '') }}</textarea>
</div>

<div class="mt-6 grid gap-4 md:grid-cols-2">
    <div>
        <label for="meta_title" class="mb-1 block text-sm font-medium">Meta Title</label>
        <input id="meta_title" name="meta_title" type="text" value="{{ old('meta_title', $service->meta_title ?? '') }}" class="w-full rounded border border-slate-300 px-3 py-2">
    </div>
    <div class="flex items-end">
        <label class="inline-flex items-center gap-2 rounded border border-slate-300 px-3 py-2">
            <input type="hidden" name="is_published" value="0">
            <input type="checkbox" name="is_published" value="1" @checked((bool) old('is_published', $service->is_published ?? true))>
            <span class="text-sm">Published</span>
        </label>
    </div>
</div>

<div class="mt-4">
    <label for="meta_description" class="mb-1 block text-sm font-medium">Meta Description</label>
    <textarea id="meta_description" name="meta_description" rows="3" class="w-full rounded border border-slate-300 px-3 py-2">{{ old('meta_description', $service->meta_description ?? '') }}</textarea>
</div>

<div class="mt-6 grid gap-4 md:grid-cols-2">
    <div>
        <label for="featured_image" class="mb-1 block text-sm font-medium">Featured Image</label>
        <input id="featured_image" name="featured_image" type="file" class="w-full rounded border border-slate-300 px-3 py-2">
        @if (!empty($service?->featured_image))
            <p class="mt-1 text-xs text-slate-500">Current: {{ $service->featured_image }}</p>
        @endif
    </div>

    <div>
        <label for="og_image" class="mb-1 block text-sm font-medium">OG Image</label>
        <input id="og_image" name="og_image" type="file" class="w-full rounded border border-slate-300 px-3 py-2">
        @if (!empty($service?->og_image))
            <p class="mt-1 text-xs text-slate-500">Current: {{ $service->og_image }}</p>
        @endif
    </div>
</div>

<div class="mt-6 rounded border border-slate-200 p-4">
    <h3 class="mb-3 text-sm font-semibold uppercase tracking-wide text-slate-600">Service Gallery Images</h3>

    @if (!empty($service?->images) && $service->images->isNotEmpty())
        <div class="mb-4 space-y-2">
            @foreach ($service->images as $image)
                <label class="flex items-center justify-between rounded border border-slate-200 px-3 py-2">
                    <span class="text-sm">{{ $image->path }}</span>
                    <span class="inline-flex items-center gap-2 text-sm text-red-600">
                        <input type="checkbox" name="remove_image_ids[]" value="{{ $image->id }}">
                        Remove
                    </span>
                </label>
            @endforeach
        </div>
    @endif

    @for ($i = 0; $i < 3; $i++)
        <div class="mb-3 grid gap-3 md:grid-cols-2">
            <input name="extra_images[]" type="file" class="w-full rounded border border-slate-300 px-3 py-2">
            <input name="extra_image_alts[]" type="text" placeholder="Image alt text (optional)" class="w-full rounded border border-slate-300 px-3 py-2">
        </div>
    @endfor
</div>

<div class="mt-6">
    <label for="video_lines" class="mb-1 block text-sm font-medium">YouTube URLs (one per line)</label>
    <textarea id="video_lines" name="video_lines" rows="4" class="w-full rounded border border-slate-300 px-3 py-2">{{ old('video_lines', $videoLines ?? '') }}</textarea>
</div>

<div class="mt-6 flex items-center gap-3">
    <button type="submit" class="rounded bg-orange-500 px-4 py-2 font-medium text-white hover:bg-orange-600">Save</button>
    <a href="{{ route('admin.services.index') }}" class="text-sm text-slate-600 hover:text-slate-900">Cancel</a>
</div>
