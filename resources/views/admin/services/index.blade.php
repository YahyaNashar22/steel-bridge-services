@extends('admin.layout')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-2xl font-bold">Services</h1>
        <a href="{{ route('admin.services.create') }}" class="rounded bg-orange-500 px-4 py-2 text-sm font-medium text-white hover:bg-orange-600">Add Service</a>
    </div>

    <div class="overflow-hidden rounded-lg bg-white shadow">
        <table class="min-w-full text-left text-sm">
            <thead class="bg-slate-100 text-slate-600">
                <tr>
                    <th class="px-4 py-3">Title</th>
                    <th class="px-4 py-3">Category</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Slug</th>
                    <th class="px-4 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($services as $service)
                    <tr class="border-t border-slate-200">
                        <td class="px-4 py-3 font-medium">{{ $service->title }}</td>
                        <td class="px-4 py-3">{{ $service->category?->name }}</td>
                        <td class="px-4 py-3">
                            <span class="rounded px-2 py-1 text-xs {{ $service->is_published ? 'bg-green-100 text-green-700' : 'bg-slate-100 text-slate-700' }}">
                                {{ $service->is_published ? 'Published' : 'Draft' }}
                            </span>
                        </td>
                        <td class="px-4 py-3">{{ $service->slug }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-3">
                                <a href="{{ route('admin.services.edit', $service) }}" class="text-orange-600 hover:text-orange-700">Edit</a>
                                <form method="POST" action="{{ route('admin.services.destroy', $service) }}" onsubmit="return confirm('Delete this service?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-700">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-8 text-center text-slate-500">No services found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $services->links() }}</div>
@endsection
