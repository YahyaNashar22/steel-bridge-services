@extends('admin.layout')

@section('content')
    <h1 class="mb-6 text-2xl font-bold">Contact Messages</h1>

    <div class="overflow-hidden rounded-lg bg-white shadow">
        <table class="min-w-full text-left text-sm">
            <thead class="bg-slate-100 text-slate-600">
                <tr>
                    <th class="px-4 py-3">Name</th>
                    <th class="px-4 py-3">Email</th>
                    <th class="px-4 py-3">Phone</th>
                    <th class="px-4 py-3">Date</th>
                    <th class="px-4 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($messages as $message)
                    <tr class="border-t border-slate-200">
                        <td class="px-4 py-3 font-medium">{{ $message->full_name }}</td>
                        <td class="px-4 py-3">{{ $message->email }}</td>
                        <td class="px-4 py-3">{{ $message->phone }}</td>
                        <td class="px-4 py-3">{{ $message->created_at->format('Y-m-d H:i') }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-3">
                                <a href="{{ route('admin.contact-messages.show', $message) }}" class="text-orange-600 hover:text-orange-700">View</a>
                                <form method="POST" action="{{ route('admin.contact-messages.destroy', $message) }}" onsubmit="return confirm('Delete this message?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-700">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-8 text-center text-slate-500">No messages found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $messages->links() }}</div>
@endsection
