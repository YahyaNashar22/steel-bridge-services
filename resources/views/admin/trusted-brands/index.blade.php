@extends('admin.layout')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-2xl font-bold">Trusted By Logos</h1>
        <a href="{{ route('admin.trusted-brands.create') }}" class="rounded bg-orange-500 px-4 py-2 text-sm font-medium text-white hover:bg-orange-600">Add Logo</a>
    </div>

    <div class="overflow-hidden rounded-lg bg-white shadow">
        <table class="min-w-full text-left text-sm">
            <thead class="bg-slate-100 text-slate-600">
                <tr>
                    <th class="px-4 py-3">Logo</th>
                    <th class="px-4 py-3">Name</th>
                    <th class="px-4 py-3">Sort</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($trustedBrands as $brand)
                    <tr class="border-t border-slate-200">
                        <td class="px-4 py-3">
                            @if ($brand->logo)
                                <img src="{{ asset('storage/'.$brand->logo) }}" alt="{{ $brand->name }}" class="h-10 w-auto rounded bg-slate-50 p-1">
                            @endif
                        </td>
                        <td class="px-4 py-3 font-medium">{{ $brand->name }}</td>
                        <td class="px-4 py-3">{{ $brand->sort_order }}</td>
                        <td class="px-4 py-3">
                            <span class="rounded px-2 py-1 text-xs {{ $brand->is_active ? 'bg-green-100 text-green-700' : 'bg-slate-100 text-slate-700' }}">
                                {{ $brand->is_active ? 'Active' : 'Hidden' }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-3">
                                <a href="{{ route('admin.trusted-brands.edit', $brand) }}" class="text-orange-600 hover:text-orange-700">Edit</a>
                                <form method="POST" action="{{ route('admin.trusted-brands.destroy', $brand) }}" onsubmit="return confirm('Delete this logo?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-700">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-8 text-center text-slate-500">No trusted logos found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $trustedBrands->links() }}</div>
@endsection
