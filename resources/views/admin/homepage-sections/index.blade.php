@extends('admin.layout')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-2xl font-bold">Homepage Sections</h1>
        <a href="{{ route('admin.homepage-sections.create') }}" class="rounded bg-orange-500 px-4 py-2 text-sm font-medium text-white hover:bg-orange-600">Add Section</a>
    </div>

    <div class="overflow-hidden rounded-lg bg-white shadow">
        <table class="min-w-full text-left text-sm">
            <thead class="bg-slate-100 text-slate-600">
                <tr>
                    <th class="px-4 py-3">Key</th>
                    <th class="px-4 py-3">Title</th>
                    <th class="px-4 py-3">Subtitle</th>
                    <th class="px-4 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($sections as $section)
                    <tr class="border-t border-slate-200">
                        <td class="px-4 py-3 font-medium">{{ $section->key }}</td>
                        <td class="px-4 py-3">{{ $section->title }}</td>
                        <td class="px-4 py-3">{{ $section->subtitle }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-3">
                                <a href="{{ route('admin.homepage-sections.edit', $section) }}" class="text-orange-600 hover:text-orange-700">Edit</a>
                                <form method="POST" action="{{ route('admin.homepage-sections.destroy', $section) }}" onsubmit="return confirm('Delete this section?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-700">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-8 text-center text-slate-500">No sections found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $sections->links() }}</div>
@endsection
