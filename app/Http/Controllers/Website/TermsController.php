<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Support\Facades\Schema;

class TermsController extends Controller
{
    public function __invoke()
    {
        $settings = collect();

        if (Schema::hasTable('settings')) {
            $settings = Setting::query()->pluck('value', 'key');
        }

        return view('website.legal', [
            'settings' => $settings,
            'metaTitle' => ($settings['terms_page_title'] ?? 'Terms and Conditions') . ' - ' . config('app.name'),
            'metaDescription' => $settings['terms_page_intro'] ?? 'Terms and conditions for Steel Bridge Services.',
            'pageKicker' => 'Legal',
            'pageTitle' => $settings['terms_page_title'] ?? 'Terms and Conditions',
            'pageIntro' => $settings['terms_page_intro'] ?? 'Review the terms governing the use of Steel Bridge Services and this website.',
            'contentTitle' => $settings['terms_page_title'] ?? 'Terms and Conditions',
            'contentBody' => $settings['terms_page_content'] ?? 'Terms content has not been added yet.',
        ]);
    }
}
