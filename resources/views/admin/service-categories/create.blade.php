@extends('admin.layout')

@section('content')
    <h1 class="mb-6 text-2xl font-bold">Create Service Category</h1>

    <div class="rounded-lg bg-white p-6 shadow">
        <form method="POST" action="{{ route('admin.service-categories.store') }}">
            @include('admin.service-categories._form')
        </form>
    </div>
@endsection
