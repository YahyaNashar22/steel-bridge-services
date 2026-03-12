@extends('admin.layout')

@section('content')
    <h1 class="mb-6 text-2xl font-bold">Create Homepage Section</h1>

    <div class="rounded-lg bg-white p-6 shadow">
        <form method="POST" action="{{ route('admin.homepage-sections.store') }}" enctype="multipart/form-data">
            @include('admin.homepage-sections._form')
        </form>
    </div>
@endsection
