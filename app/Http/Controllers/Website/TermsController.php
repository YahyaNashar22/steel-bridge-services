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

        return view('website.terms', [
            'settings' => $settings,
            'metaTitle' => ($settings['terms_page_title'] ?? 'Terms and Copyrights') . ' - ' . config('app.name'),
            'metaDescription' => $settings['terms_page_intro'] ?? 'Terms and copyrights for Steel Bridge Services.',
        ]);
    }
}
