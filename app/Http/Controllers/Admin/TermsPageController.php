<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class TermsPageController extends Controller
{
    public function edit()
    {
        $settings = Setting::query()->pluck('value', 'key');

        return view('admin.terms.edit', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'terms_page_title' => ['nullable', 'string', 'max:255'],
            'terms_page_intro' => ['nullable', 'string'],
            'terms_page_content' => ['nullable', 'string'],
            'copyright_title' => ['nullable', 'string', 'max:255'],
            'copyright_content' => ['nullable', 'string'],
        ]);

        foreach ($data as $key => $value) {
            Setting::query()->updateOrCreate(
                ['key' => $key],
                ['value' => (string) ($value ?? '')]
            );
        }

        return redirect()
            ->route('admin.terms.edit')
            ->with('status', 'Terms page updated.');
    }
}
