<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\HomepageSection;
use App\Models\HomepageServiceItem;
use App\Models\HomepageTab;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\Setting;
use App\Models\TrustedBrand;
use Illuminate\Support\Facades\Schema;

class HomeController extends Controller
{
    public function __invoke()
    {
        $sections = collect();
        $settings = collect();
        $services = collect();
        $categories = collect();
        $trustedBrands = collect();
        $hardFacilityItems = collect();
        $softFacilityItems = collect();
        $homepageTabs = collect();

        if (Schema::hasTable('homepage_sections')) {
            $sections = HomepageSection::query()->get()->keyBy('key');
        }

        if (Schema::hasTable('settings')) {
            $settings = Setting::query()->pluck('value', 'key');
        }

        if (Schema::hasTable('services') && Schema::hasTable('service_categories')) {
            $services = Service::query()
                ->with('category:id,name,slug')
                ->where('is_published', true)
                ->latest()
                ->limit(6)
                ->get();
            $categories = ServiceCategory::query()->orderBy('name')->get();
        }

        if (Schema::hasTable('trusted_brands')) {
            $trustedBrands = TrustedBrand::query()
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->orderBy('id')
                ->get();
        }

        if (Schema::hasTable('homepage_service_items')) {
            $allItems = HomepageServiceItem::query()
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->orderBy('id')
                ->get();

            $hardFacilityItems = $allItems->where('section', 'hard_facility')->values();
            $softFacilityItems = $allItems->where('section', 'soft_facility')->values();
        }

        if (Schema::hasTable('homepage_tabs')) {
            $homepageTabs = HomepageTab::query()
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->orderBy('id')
                ->get();
        }

        return view('website.home', compact(
            'sections',
            'settings',
            'services',
            'categories',
            'trustedBrands',
            'hardFacilityItems',
            'softFacilityItems',
            'homepageTabs'
        ));
    }
}
