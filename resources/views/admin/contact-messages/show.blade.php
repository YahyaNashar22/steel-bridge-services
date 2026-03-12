@extends('admin.layout')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-2xl font-bold">Contact Message</h1>
        <a href="{{ route('admin.contact-messages.index') }}" class="text-sm text-slate-600 hover:text-slate-900">Back</a>
    </div>

    <div class="rounded-lg bg-white p-6 shadow">
        <dl class="grid gap-4 md:grid-cols-2">
            <div>
                <dt class="text-sm text-slate-500">Full Name</dt>
                <dd class="font-medium">{{ $contactMessage->full_name }}</dd>
            </div>
            <div>
                <dt class="text-sm text-slate-500">Email</dt>
                <dd class="font-medium">{{ $contactMessage->email }}</dd>
            </div>
            <div>
                <dt class="text-sm text-slate-500">Phone</dt>
                <dd class="font-medium">{{ $contactMessage->phone }}</dd>
            </div>
            <div>
                <dt class="text-sm text-slate-500">Submitted At</dt>
                <dd class="font-medium">{{ $contactMessage->created_at->format('Y-m-d H:i') }}</dd>
            </div>
        </dl>

        <div class="mt-6">
            <h2 class="mb-2 text-sm text-slate-500">Message</h2>
            <p class="whitespace-pre-line rounded border border-slate-200 bg-slate-50 p-4">{{ $contactMessage->message }}</p>
        </div>
    </div>
@endsection
