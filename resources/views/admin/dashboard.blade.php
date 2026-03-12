@extends('admin.layout')

@section('content')
    <h1 class="mb-6 text-2xl font-bold">Dashboard</h1>

    <div class="mb-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-6">
        <div class="rounded-lg bg-white p-4 shadow">
            <p class="text-sm text-slate-500">Categories</p>
            <p class="mt-2 text-2xl font-semibold">{{ $stats['categories'] }}</p>
        </div>
        <div class="rounded-lg bg-white p-4 shadow">
            <p class="text-sm text-slate-500">Services</p>
            <p class="mt-2 text-2xl font-semibold">{{ $stats['services'] }}</p>
        </div>
        <div class="rounded-lg bg-white p-4 shadow">
            <p class="text-sm text-slate-500">Published Services</p>
            <p class="mt-2 text-2xl font-semibold">{{ $stats['published_services'] }}</p>
        </div>
        <div class="rounded-lg bg-white p-4 shadow">
            <p class="text-sm text-slate-500">Contact Messages</p>
            <p class="mt-2 text-2xl font-semibold">{{ $stats['contact_messages'] }}</p>
        </div>
        <div class="rounded-lg bg-white p-4 shadow">
            <p class="text-sm text-slate-500">Service Requests</p>
            <p class="mt-2 text-2xl font-semibold">{{ $stats['service_requests'] }}</p>
        </div>
        <div class="rounded-lg bg-white p-4 shadow">
            <p class="text-sm text-slate-500">Trusted Logos</p>
            <p class="mt-2 text-2xl font-semibold">{{ $stats['trusted_brands'] }}</p>
        </div>
    </div>

    <div class="grid gap-6 lg:grid-cols-2">
        <section class="rounded-lg bg-white p-5 shadow">
            <div class="mb-4 flex items-center justify-between">
                <h2 class="text-lg font-semibold">Latest Contact Messages</h2>
                <a href="{{ route('admin.contact-messages.index') }}" class="text-sm text-orange-600 hover:text-orange-700">View all</a>
            </div>
            <div class="space-y-3">
                @forelse ($latestMessages as $message)
                    <div class="rounded border border-slate-200 p-3">
                        <p class="font-medium">{{ $message->full_name }}</p>
                        <p class="text-sm text-slate-500">{{ $message->email }} - {{ $message->phone }}</p>
                    </div>
                @empty
                    <p class="text-sm text-slate-500">No messages yet.</p>
                @endforelse
            </div>
        </section>

        <section class="rounded-lg bg-white p-5 shadow">
            <div class="mb-4 flex items-center justify-between">
                <h2 class="text-lg font-semibold">Latest Service Requests</h2>
                <a href="{{ route('admin.service-requests.index') }}" class="text-sm text-orange-600 hover:text-orange-700">View all</a>
            </div>
            <div class="space-y-3">
                @forelse ($latestRequests as $requestItem)
                    <div class="rounded border border-slate-200 p-3">
                        <p class="font-medium">{{ $requestItem->full_name }}</p>
                        <p class="text-sm text-slate-500">
                            {{ $requestItem->service?->title ?? 'No specific service' }}
                        </p>
                    </div>
                @empty
                    <p class="text-sm text-slate-500">No service requests yet.</p>
                @endforelse
            </div>
        </section>
    </div>
@endsection
