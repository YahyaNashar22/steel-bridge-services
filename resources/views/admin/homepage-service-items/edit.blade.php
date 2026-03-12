@extends('admin.layout')

@section('content')
    <h1 class="mb-6 text-2xl font-bold">Edit Homepage Service Item</h1>

    <div class="rounded-lg bg-white p-6 shadow">
        <form method="POST" action="{{ route('admin.homepage-service-items.update', $homepageServiceItem) }}" enctype="multipart/form-data">
            @method('PUT')
            @include('admin.homepage-service-items._form')
        </form>
    </div>
@endsection
