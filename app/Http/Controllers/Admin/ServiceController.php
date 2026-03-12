<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\ServiceImage;
use App\Models\ServiceVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::query()
            ->with('category:id,name')
            ->latest()
            ->paginate(15);

        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        $categories = ServiceCategory::query()->orderBy('name')->get();

        return view('admin.services.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $this->validatePayload($request);

        DB::transaction(function () use ($request, $data): void {
            $service = new Service();
            $this->fillService($service, $data, $request);
            $service->save();

            $this->persistMedia($service, $request, false);
        });

        return redirect()
            ->route('admin.services.index')
            ->with('status', 'Service created.');
    }

    public function edit(Service $service)
    {
        $categories = ServiceCategory::query()->orderBy('name')->get();
        $service->load(['images', 'videos']);
        $videoLines = $service->videos->pluck('youtube_url')->implode("\n");

        return view('admin.services.edit', compact('service', 'categories', 'videoLines'));
    }

    public function update(Request $request, Service $service)
    {
        $data = $this->validatePayload($request, $service);

        DB::transaction(function () use ($request, $data, $service): void {
            $this->fillService($service, $data, $request);
            $service->save();

            $this->persistMedia($service, $request, true);
        });

        return redirect()
            ->route('admin.services.index')
            ->with('status', 'Service updated.');
    }

    public function destroy(Service $service)
    {
        if ($service->featured_image) {
            Storage::disk('public')->delete($service->featured_image);
        }

        if ($service->og_image) {
            Storage::disk('public')->delete($service->og_image);
        }

        foreach ($service->images as $image) {
            Storage::disk('public')->delete($image->path);
        }

        $service->delete();

        return redirect()
            ->route('admin.services.index')
            ->with('status', 'Service deleted.');
    }

    private function validatePayload(Request $request, ?Service $service = null): array
    {
        $slugRule = Rule::unique('services', 'slug');
        if ($service) {
            $slugRule = $slugRule->ignore($service->id);
        }

        return $request->validate([
            'service_category_id' => ['required', 'exists:service_categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', $slugRule],
            'short_description' => ['required', 'string'],
            'long_description' => ['required', 'string'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string'],
            'is_published' => ['nullable', 'boolean'],
            'featured_image' => ['nullable', 'image', 'max:4096'],
            'og_image' => ['nullable', 'image', 'max:4096'],
            'extra_images.*' => ['nullable', 'image', 'max:4096'],
            'extra_image_alts.*' => ['nullable', 'string', 'max:255'],
            'remove_image_ids.*' => ['nullable', 'integer'],
            'video_lines' => ['nullable', 'string'],
        ]);
    }

    private function fillService(Service $service, array $data, Request $request): void
    {
        $service->service_category_id = $data['service_category_id'];
        $service->title = $data['title'];
        $service->slug = $data['slug'] ?: Str::slug($data['title']);
        $service->short_description = $data['short_description'];
        $service->long_description = $data['long_description'];
        $service->meta_title = $data['meta_title'] ?? null;
        $service->meta_description = $data['meta_description'] ?? null;
        $service->is_published = (bool) ($data['is_published'] ?? false);

        if ($request->hasFile('featured_image')) {
            if ($service->featured_image) {
                Storage::disk('public')->delete($service->featured_image);
            }

            $service->featured_image = $request->file('featured_image')->store('services/featured', 'public');
        }

        if ($request->hasFile('og_image')) {
            if ($service->og_image) {
                Storage::disk('public')->delete($service->og_image);
            }

            $service->og_image = $request->file('og_image')->store('services/og', 'public');
        }
    }

    private function persistMedia(Service $service, Request $request, bool $replace): void
    {
        if ($replace) {
            $removeImageIds = collect($request->input('remove_image_ids', []))
                ->filter()
                ->map(fn ($id) => (int) $id)
                ->all();

            if ($removeImageIds) {
                $toDelete = ServiceImage::query()
                    ->where('service_id', $service->id)
                    ->whereIn('id', $removeImageIds)
                    ->get();

                foreach ($toDelete as $image) {
                    Storage::disk('public')->delete($image->path);
                    $image->delete();
                }
            }
        }

        $extraImages = $request->file('extra_images', []);
        $alts = $request->input('extra_image_alts', []);

        foreach ($extraImages as $index => $file) {
            if (!$file) {
                continue;
            }

            $path = $file->store('services/gallery', 'public');
            $service->images()->create([
                'path' => $path,
                'alt' => $alts[$index] ?? null,
            ]);
        }

        if ($replace) {
            $service->videos()->delete();
        }

        $videoLines = collect(preg_split('/\r\n|\r|\n/', (string) $request->input('video_lines')))
            ->map(fn ($line) => trim((string) $line))
            ->filter()
            ->unique()
            ->values();

        foreach ($videoLines as $url) {
            $service->videos()->create(['youtube_url' => $url]);
        }
    }
}
