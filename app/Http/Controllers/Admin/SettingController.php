<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::query()->orderBy('key')->get();

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'settings' => ['nullable', 'array'],
            'settings.*' => ['nullable', 'string'],
            'new_key' => ['nullable', 'string', 'max:255'],
            'new_value' => ['nullable', 'string'],
        ]);

        foreach ($validated['settings'] ?? [] as $key => $value) {
            Setting::query()->updateOrCreate(['key' => $key], ['value' => $value ?? '']);
        }

        $newKey = trim((string) ($validated['new_key'] ?? ''));
        if ($newKey !== '') {
            Setting::query()->updateOrCreate(
                ['key' => $newKey],
                ['value' => (string) ($validated['new_value'] ?? '')]
            );
        }

        return redirect()
            ->route('admin.settings.index')
            ->with('status', 'Settings updated.');
    }
}
