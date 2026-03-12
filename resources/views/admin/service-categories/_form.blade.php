@csrf

<div class="space-y-4">
    <div>
        <label for="name" class="mb-1 block text-sm font-medium">Name</label>
        <input id="name" name="name" type="text" value="{{ old('name', $serviceCategory->name ?? '') }}" class="w-full rounded border border-slate-300 px-3 py-2" required>
    </div>

    <div>
        <label for="slug" class="mb-1 block text-sm font-medium">Slug (optional)</label>
        <input id="slug" name="slug" type="text" value="{{ old('slug', $serviceCategory->slug ?? '') }}" class="w-full rounded border border-slate-300 px-3 py-2">
    </div>
</div>

<div class="mt-6 flex items-center gap-3">
    <button type="submit" class="rounded bg-orange-500 px-4 py-2 font-medium text-white hover:bg-orange-600">Save</button>
    <a href="{{ route('admin.service-categories.index') }}" class="text-sm text-slate-600 hover:text-slate-900">Cancel</a>
</div>
