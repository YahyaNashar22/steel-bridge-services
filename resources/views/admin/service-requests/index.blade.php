@extends('admin.layout')

@section('content')
    <h1 class="mb-6 text-2xl font-bold">Service Requests</h1>

    <div class="overflow-hidden rounded-lg bg-white shadow">
        <table class="min-w-full text-left text-sm">
            <thead class="bg-slate-100 text-slate-600">
                <tr>
                    <th class="px-4 py-3">Name</th>
                    <th class="px-4 py-3">Service</th>
                    <th class="px-4 py-3">Email</th>
                    <th class="px-4 py-3">Phone</th>
                    <th class="px-4 py-3">Date</th>
                    <th class="px-4 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($requests as $requestItem)
                    <tr class="border-t border-slate-200">
                        <td class="px-4 py-3 font-medium">{{ $requestItem->full_name }}</td>
                        <td class="px-4 py-3">{{ $requestItem->service?->title ?? 'Not selected' }}</td>
                        <td class="px-4 py-3">{{ $requestItem->email }}</td>
                        <td class="px-4 py-3">{{ $requestItem->phone }}</td>
                        <td class="px-4 py-3">{{ $requestItem->created_at->format('Y-m-d H:i') }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-3">
                                <a href="{{ route('admin.service-requests.show', $requestItem) }}" class="text-orange-600 hover:text-orange-700">View</a>
                                <form method="POST" action="{{ route('admin.service-requests.destroy', $requestItem) }}" onsubmit="return confirm('Delete this request?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-700">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-8 text-center text-slate-500">No requests found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $requests->links() }}</div>
@endsection
