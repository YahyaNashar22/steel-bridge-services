<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomepageServiceItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class HomepageServiceItemController extends Controller
{
    public function index()
    {
        $items = HomepageServiceItem::query()
            ->orderBy('section')
            ->orderBy('sort_order')
            ->orderBy('id')
            ->paginate(20);

        return view('admin.homepage-service-items.index', compact('items'));
    }

    public function create()
    {
        return view('admin.homepage-service-items.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'section' => ['required', Rule::in(['hard_facility', 'soft_facility'])],
            'title' => ['required', 'string', 'max:255'],
            'image' => ['required', 'image', 'max:4096'],
            'link' => ['nullable', 'url', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['image'] = $request->file('image')->store('homepage/service-items', 'public');
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);
        $data['is_active'] = (bool) ($data['is_active'] ?? false);

        HomepageServiceItem::create($data);

        return redirect()->route('admin.homepage-service-items.index')->with('status', 'Homepage item created.');
    }

    public function edit(HomepageServiceItem $homepageServiceItem)
    {
        return view('admin.homepage-service-items.edit', compact('homepageServiceItem'));
    }

    public function update(Request $request, HomepageServiceItem $homepageServiceItem)
    {
        $data = $request->validate([
            'section' => ['required', Rule::in(['hard_facility', 'soft_facility'])],
            'title' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'max:4096'],
            'link' => ['nullable', 'url', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
            'remove_image' => ['nullable', 'boolean'],
        ]);

        if ((bool) ($data['remove_image'] ?? false) && $homepageServiceItem->image) {
            Storage::disk('public')->delete($homepageServiceItem->image);
            $homepageServiceItem->image = '';
        }

        if ($request->hasFile('image')) {
            if ($homepageServiceItem->image) {
                Storage::disk('public')->delete($homepageServiceItem->image);
            }
            $homepageServiceItem->image = $request->file('image')->store('homepage/service-items', 'public');
        }

        $homepageServiceItem->section = $data['section'];
        $homepageServiceItem->title = $data['title'];
        $homepageServiceItem->link = $data['link'] ?? null;
        $homepageServiceItem->sort_order = (int) ($data['sort_order'] ?? 0);
        $homepageServiceItem->is_active = (bool) ($data['is_active'] ?? false);
        $homepageServiceItem->save();

        return redirect()->route('admin.homepage-service-items.index')->with('status', 'Homepage item updated.');
    }

    public function destroy(HomepageServiceItem $homepageServiceItem)
    {
        if ($homepageServiceItem->image) {
            Storage::disk('public')->delete($homepageServiceItem->image);
        }

        $homepageServiceItem->delete();

        return redirect()->route('admin.homepage-service-items.index')->with('status', 'Homepage item deleted.');
    }
}
