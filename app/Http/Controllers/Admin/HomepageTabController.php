<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomepageTab;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomepageTabController extends Controller
{
    public function index()
    {
        $tabs = HomepageTab::query()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->paginate(20);

        return view('admin.homepage-tabs.index', compact('tabs'));
    }

    public function create()
    {
        return view('admin.homepage-tabs.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'content' => ['nullable', 'string'],
            'image' => ['required', 'image', 'max:4096'],
            'button_text' => ['nullable', 'string', 'max:255'],
            'button_link' => ['nullable', 'url', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['image'] = $request->file('image')->store('homepage/tabs', 'public');
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);
        $data['is_active'] = (bool) ($data['is_active'] ?? false);

        HomepageTab::create($data);

        return redirect()->route('admin.homepage-tabs.index')->with('status', 'Homepage tab created.');
    }

    public function edit(HomepageTab $homepageTab)
    {
        return view('admin.homepage-tabs.edit', compact('homepageTab'));
    }

    public function update(Request $request, HomepageTab $homepageTab)
    {
        $rules = [
            'title' => ['required', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'content' => ['nullable', 'string'],
            'button_text' => ['nullable', 'string', 'max:255'],
            'button_link' => ['nullable', 'url', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
            'remove_image' => ['nullable', 'boolean'],
        ];

        if ($request->hasFile('image')) {
            $rules['image'] = ['image', 'max:4096'];
        }

        $data = $request->validate($rules);

        if ((bool) ($data['remove_image'] ?? false) && $homepageTab->image) {
            Storage::disk('public')->delete($homepageTab->image);
            $homepageTab->image = '';
        }

        if ($request->hasFile('image')) {
            if ($homepageTab->image) {
                Storage::disk('public')->delete($homepageTab->image);
            }

            $homepageTab->image = $request->file('image')->store('homepage/tabs', 'public');
        }

        $homepageTab->title = $data['title'];
        $homepageTab->subtitle = $data['subtitle'] ?? null;
        $homepageTab->content = $data['content'] ?? null;
        $homepageTab->button_text = $data['button_text'] ?? null;
        $homepageTab->button_link = $data['button_link'] ?? null;
        $homepageTab->sort_order = (int) ($data['sort_order'] ?? 0);
        $homepageTab->is_active = (bool) ($data['is_active'] ?? false);
        $homepageTab->save();

        return redirect()->route('admin.homepage-tabs.index')->with('status', 'Homepage tab updated.');
    }

    public function destroy(HomepageTab $homepageTab)
    {
        if ($homepageTab->image) {
            Storage::disk('public')->delete($homepageTab->image);
        }

        $homepageTab->delete();

        return redirect()->route('admin.homepage-tabs.index')->with('status', 'Homepage tab deleted.');
    }
}
