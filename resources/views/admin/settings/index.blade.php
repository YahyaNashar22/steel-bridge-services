@extends('admin.layout')

@section('content')
    <h1 class="mb-6 text-2xl font-bold">Settings</h1>

    <div class="rounded-lg bg-white p-6 shadow">
        <form method="POST" action="{{ route('admin.settings.update') }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="rounded border border-slate-200 p-4">
                <h2 class="mb-3 text-sm font-semibold uppercase tracking-wide text-slate-600">Social Profile Keys</h2>
                <p class="text-sm text-slate-600">Use keys like: <code>company_phone</code>, <code>company_email</code>, <code>company_address</code>, <code>facebook_url</code>, <code>instagram_url</code>, <code>linkedin_url</code>, <code>youtube_url</code>, <code>tiktok_url</code>.</p>
            </div>

            <div class="space-y-4">
                @forelse ($settings as $setting)
                    <div>
                        <label class="mb-1 block text-sm font-medium">{{ $setting->key }}</label>
                        <textarea name="settings[{{ $setting->key }}]" rows="2" class="w-full rounded border border-slate-300 px-3 py-2">{{ old('settings.'.$setting->key, $setting->value) }}</textarea>
                    </div>
                @empty
                    <p class="text-sm text-slate-500">No settings created yet.</p>
                @endforelse
            </div>

            <div class="rounded border border-slate-200 p-4">
                <h2 class="mb-3 text-sm font-semibold uppercase tracking-wide text-slate-600">Add New Setting</h2>
                <div class="grid gap-3 md:grid-cols-2">
                    <input type="text" name="new_key" placeholder="key (e.g. company_phone)" class="w-full rounded border border-slate-300 px-3 py-2">
                    <input type="text" name="new_value" placeholder="value" class="w-full rounded border border-slate-300 px-3 py-2">
                </div>
            </div>

            <button type="submit" class="rounded bg-orange-500 px-4 py-2 font-medium text-white hover:bg-orange-600">Save Settings</button>
        </form>
    </div>
@endsection
