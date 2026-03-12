@extends('admin.layout')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-2xl font-bold">Homepage Service Items</h1>
        <a href="{{ route('admin.homepage-service-items.create') }}" class="rounded bg-orange-500 px-4 py-2 text-sm font-medium text-white hover:bg-orange-600">Add Item</a>
    </div>

    <div class="overflow-hidden rounded-lg bg-white shadow">
        <table class="min-w-full text-left text-sm">
            <thead class="bg-slate-100 text-slate-600">
                <tr>
                    <th class="px-4 py-3">Image</th>
                    <th class="px-4 py-3">Section</th>
                    <th class="px-4 py-3">Title</th>
                    <th class="px-4 py-3">Sort</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($items as $item)
                    <tr class="border-t border-slate-200">
                        <td class="px-4 py-3">
                            @if ($item->image)
                                <img src="{{ asset('storage/'.$item->image) }}" alt="{{ $item->title }}" class="h-10 w-10 rounded-full object-cover">
                            @endif
                        </td>
                        <td class="px-4 py-3">{{ $item->section === 'hard_facility' ? 'Hard Facility' : 'Soft Facility' }}</td>
                        <td class="px-4 py-3 font-medium">{{ $item->title }}</td>
                        <td class="px-4 py-3">{{ $item->sort_order }}</td>
                        <td class="px-4 py-3">
                            <span class="rounded px-2 py-1 text-xs {{ $item->is_active ? 'bg-green-100 text-green-700' : 'bg-slate-100 text-slate-700' }}">
                                {{ $item->is_active ? 'Active' : 'Hidden' }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-3">
                                <a href="{{ route('admin.homepage-service-items.edit', $item) }}" class="text-orange-600 hover:text-orange-700">Edit</a>
                                <form method="POST" action="{{ route('admin.homepage-service-items.destroy', $item) }}" onsubmit="return confirm('Delete this item?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-700">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-8 text-center text-slate-500">No homepage items yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $items->links() }}</div>
@endsection
