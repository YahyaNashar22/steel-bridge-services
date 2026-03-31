<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Support\Facades\Schema;

class PrivacyController extends Controller
{
    public function __invoke()
    {
        $settings = collect();

        if (Schema::hasTable('settings')) {
            $settings = Setting::query()->pluck('value', 'key');
        }

        return view('website.legal', [
            'settings' => $settings,
            'metaTitle' => ($settings['privacy_page_title'] ?? 'Privacy Policy') . ' - ' . config('app.name'),
            'metaDescription' => $settings['privacy_page_intro'] ?? 'Privacy policy for Steel Bridge Services.',
            'pageKicker' => 'Privacy',
            'pageTitle' => $settings['privacy_page_title'] ?? 'Privacy Policy',
            'pageIntro' => $settings['privacy_page_intro'] ?? 'Review how Steel Bridge Services collects, uses, and protects your information.',
            'contentTitle' => $settings['privacy_page_title'] ?? 'Privacy Policy',
            'contentBody' => $settings['privacy_page_content'] ?? 'Privacy policy content has not been added yet.',
        ]);
    }
}
