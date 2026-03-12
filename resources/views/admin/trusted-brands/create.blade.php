@extends('admin.layout')

@section('content')
    <h1 class="mb-6 text-2xl font-bold">Add Trusted Brand</h1>

    <div class="rounded-lg bg-white p-6 shadow">
        <form method="POST" action="{{ route('admin.trusted-brands.store') }}" enctype="multipart/form-data">
            @include('admin.trusted-brands._form')
        </form>
    </div>
@endsection
