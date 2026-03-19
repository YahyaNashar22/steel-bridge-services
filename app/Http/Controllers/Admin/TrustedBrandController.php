<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TrustedBrand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TrustedBrandController extends Controller
{
    public function index()
    {
        $trustedBrands = TrustedBrand::query()
            ->orderBy('sort_order')
            ->orderByDesc('id')
            ->paginate(20);

        return view('admin.trusted-brands.index', compact('trustedBrands'));
    }

    public function create()
    {
        return view('admin.trusted-brands.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'logo' => ['required', 'image', 'max:4096'],
            'website_url' => ['nullable', 'url', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['logo'] = $request->file('logo')->store('trusted-brands', 'public');
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);
        $data['is_active'] = (bool) ($data['is_active'] ?? false);

        TrustedBrand::create($data);

        return redirect()
            ->route('admin.trusted-brands.index')
            ->with('status', 'Trusted brand added.');
    }

    public function edit(TrustedBrand $trustedBrand)
    {
        return view('admin.trusted-brands.edit', compact('trustedBrand'));
    }

    public function update(Request $request, TrustedBrand $trustedBrand)
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'website_url' => ['nullable', 'url', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
            'remove_logo' => ['nullable', 'boolean'],
        ];

        if ($request->hasFile('logo')) {
            $rules['logo'] = ['image', 'max:4096'];
        }

        $data = $request->validate($rules);

        if ((bool) ($data['remove_logo'] ?? false) && $trustedBrand->logo) {
            Storage::disk('public')->delete($trustedBrand->logo);
            $trustedBrand->logo = '';
        }

        if ($request->hasFile('logo')) {
            if ($trustedBrand->logo) {
                Storage::disk('public')->delete($trustedBrand->logo);
            }
            $trustedBrand->logo = $request->file('logo')->store('trusted-brands', 'public');
        }

        $trustedBrand->name = $data['name'];
        $trustedBrand->website_url = $data['website_url'] ?? null;
        $trustedBrand->sort_order = (int) ($data['sort_order'] ?? 0);
        $trustedBrand->is_active = (bool) ($data['is_active'] ?? false);
        $trustedBrand->save();

        return redirect()
            ->route('admin.trusted-brands.index')
            ->with('status', 'Trusted brand updated.');
    }

    public function destroy(TrustedBrand $trustedBrand)
    {
        if ($trustedBrand->logo) {
            Storage::disk('public')->delete($trustedBrand->logo);
        }

        $trustedBrand->delete();

        return redirect()
            ->route('admin.trusted-brands.index')
            ->with('status', 'Trusted brand deleted.');
    }
}
