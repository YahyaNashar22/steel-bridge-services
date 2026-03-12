@extends('admin.layout')

@section('content')
    <h1 class="mb-6 text-2xl font-bold">Edit Service</h1>

    <div class="rounded-lg bg-white p-6 shadow">
        <form method="POST" action="{{ route('admin.services.update', $service) }}" enctype="multipart/form-data">
            @method('PUT')
            @include('admin.services._form')
        </form>
    </div>
@endsection
