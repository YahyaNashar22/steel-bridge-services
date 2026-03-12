<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomepageSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class HomepageSectionController extends Controller
{
    public function index()
    {
        $sections = HomepageSection::query()->orderBy('key')->paginate(20);

        return view('admin.homepage-sections.index', compact('sections'));
    }

    public function create()
    {
        return view('admin.homepage-sections.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'key' => ['required', 'string', 'max:255', Rule::unique('homepage_sections', 'key')],
            'title' => ['nullable', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'content' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:4096'],
            'video' => ['nullable', 'file', 'mimetypes:video/mp4,video/webm,video/ogg', 'max:51200'],
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('homepage', 'public');
        }

        if ($request->hasFile('video')) {
            $data['video'] = $request->file('video')->store('homepage/videos', 'public');
        }

        HomepageSection::create($data);

        return redirect()
            ->route('admin.homepage-sections.index')
            ->with('status', 'Homepage section created.');
    }

    public function edit(HomepageSection $homepageSection)
    {
        return view('admin.homepage-sections.edit', compact('homepageSection'));
    }

    public function update(Request $request, HomepageSection $homepageSection)
    {
        $data = $request->validate([
            'key' => ['required', 'string', 'max:255', Rule::unique('homepage_sections', 'key')->ignore($homepageSection->id)],
            'title' => ['nullable', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'content' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:4096'],
            'video' => ['nullable', 'file', 'mimetypes:video/mp4,video/webm,video/ogg', 'max:51200'],
            'remove_image' => ['nullable', 'boolean'],
            'remove_video' => ['nullable', 'boolean'],
        ]);

        if ((bool) ($data['remove_image'] ?? false) && $homepageSection->image) {
            Storage::disk('public')->delete($homepageSection->image);
            $data['image'] = null;
        }

        if ($request->hasFile('image')) {
            if ($homepageSection->image) {
                Storage::disk('public')->delete($homepageSection->image);
            }

            $data['image'] = $request->file('image')->store('homepage', 'public');
        }

        if ((bool) ($data['remove_video'] ?? false) && $homepageSection->video) {
            Storage::disk('public')->delete($homepageSection->video);
            $data['video'] = null;
        }

        if ($request->hasFile('video')) {
            if ($homepageSection->video) {
                Storage::disk('public')->delete($homepageSection->video);
            }

            $data['video'] = $request->file('video')->store('homepage/videos', 'public');
        }

        unset($data['remove_image'], $data['remove_video']);

        $homepageSection->update($data);

        return redirect()
            ->route('admin.homepage-sections.index')
            ->with('status', 'Homepage section updated.');
    }

    public function destroy(HomepageSection $homepageSection)
    {
        if ($homepageSection->image) {
            Storage::disk('public')->delete($homepageSection->image);
        }

        if ($homepageSection->video) {
            Storage::disk('public')->delete($homepageSection->video);
        }

        $homepageSection->delete();

        return redirect()
            ->route('admin.homepage-sections.index')
            ->with('status', 'Homepage section deleted.');
    }
}
