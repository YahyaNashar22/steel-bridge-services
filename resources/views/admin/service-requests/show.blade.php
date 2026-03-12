@extends('admin.layout')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-2xl font-bold">Service Request</h1>
        <a href="{{ route('admin.service-requests.index') }}" class="text-sm text-slate-600 hover:text-slate-900">Back</a>
    </div>

    <div class="rounded-lg bg-white p-6 shadow">
        <dl class="grid gap-4 md:grid-cols-2">
            <div>
                <dt class="text-sm text-slate-500">Full Name</dt>
                <dd class="font-medium">{{ $serviceRequest->full_name }}</dd>
            </div>
            <div>
                <dt class="text-sm text-slate-500">Email</dt>
                <dd class="font-medium">{{ $serviceRequest->email }}</dd>
            </div>
            <div>
                <dt class="text-sm text-slate-500">Phone</dt>
                <dd class="font-medium">{{ $serviceRequest->phone }}</dd>
            </div>
            <div>
                <dt class="text-sm text-slate-500">Selected Service</dt>
                <dd class="font-medium">{{ $serviceRequest->service?->title ?? 'Not selected' }}</dd>
            </div>
        </dl>

        <div class="mt-6">
            <h2 class="mb-2 text-sm text-slate-500">Description</h2>
            <p class="whitespace-pre-line rounded border border-slate-200 bg-slate-50 p-4">{{ $serviceRequest->description }}</p>
        </div>
    </div>
@endsection
