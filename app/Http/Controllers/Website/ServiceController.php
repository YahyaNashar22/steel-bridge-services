<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\Setting;
use Illuminate\Support\Facades\Schema;

class ServiceController extends Controller
{
    public function index()
    {
        abort_unless(Schema::hasTable('services') && Schema::hasTable('service_categories'), 404);

        $services = Service::query()
            ->with('category:id,name,slug')
            ->where('is_published', true)
            ->latest()
            ->paginate(12);
        $categories = ServiceCategory::query()->orderBy('name')->get();
        $settings = Setting::query()->pluck('value', 'key');

        return view('website.services.index', compact('services', 'categories', 'settings'));
    }

    public function show(Service $service)
    {
        abort_unless(Schema::hasTable('services'), 404);
        abort_unless($service->is_published, 404);

        $service->load(['category:id,name,slug', 'images', 'videos']);
        $settings = Setting::query()->pluck('value', 'key');

        return view('website.services.show', compact('service', 'settings'));
    }
}
