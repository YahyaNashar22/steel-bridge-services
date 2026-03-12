<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ServiceCategoryController extends Controller
{
    public function index()
    {
        $categories = ServiceCategory::query()
            ->withCount('services')
            ->latest()
            ->paginate(15);

        return view('admin.service-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.service-categories.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('service_categories', 'slug')],
        ]);

        $data['slug'] = $data['slug'] ?: Str::slug($data['name']);

        ServiceCategory::create($data);

        return redirect()
            ->route('admin.service-categories.index')
            ->with('status', 'Service category created.');
    }

    public function edit(ServiceCategory $serviceCategory)
    {
        return view('admin.service-categories.edit', compact('serviceCategory'));
    }

    public function update(Request $request, ServiceCategory $serviceCategory)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('service_categories', 'slug')->ignore($serviceCategory->id)],
        ]);

        $data['slug'] = $data['slug'] ?: Str::slug($data['name']);

        $serviceCategory->update($data);

        return redirect()
            ->route('admin.service-categories.index')
            ->with('status', 'Service category updated.');
    }

    public function destroy(ServiceCategory $serviceCategory)
    {
        $serviceCategory->delete();

        return redirect()
            ->route('admin.service-categories.index')
            ->with('status', 'Service category deleted.');
    }
}
