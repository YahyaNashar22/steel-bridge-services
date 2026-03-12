@extends('admin.layout')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-2xl font-bold">Service Categories</h1>
        <a href="{{ route('admin.service-categories.create') }}" class="rounded bg-orange-500 px-4 py-2 text-sm font-medium text-white hover:bg-orange-600">Add Category</a>
    </div>

    <div class="overflow-hidden rounded-lg bg-white shadow">
        <table class="min-w-full text-left text-sm">
            <thead class="bg-slate-100 text-slate-600">
                <tr>
                    <th class="px-4 py-3">Name</th>
                    <th class="px-4 py-3">Slug</th>
                    <th class="px-4 py-3">Services</th>
                    <th class="px-4 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $category)
                    <tr class="border-t border-slate-200">
                        <td class="px-4 py-3 font-medium">{{ $category->name }}</td>
                        <td class="px-4 py-3">{{ $category->slug }}</td>
                        <td class="px-4 py-3">{{ $category->services_count }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-3">
                                <a href="{{ route('admin.service-categories.edit', $category) }}" class="text-orange-600 hover:text-orange-700">Edit</a>
                                <form method="POST" action="{{ route('admin.service-categories.destroy', $category) }}" onsubmit="return confirm('Delete this category?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-700">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-8 text-center text-slate-500">No categories found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $categories->links() }}</div>
@endsection
