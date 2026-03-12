@extends('admin.layout')

@section('content')
    <h1 class="mb-6 text-2xl font-bold">Edit Service Category</h1>

    <div class="rounded-lg bg-white p-6 shadow">
        <form method="POST" action="{{ route('admin.service-categories.update', $serviceCategory) }}">
            @method('PUT')
            @include('admin.service-categories._form')
        </form>
    </div>
@endsection
