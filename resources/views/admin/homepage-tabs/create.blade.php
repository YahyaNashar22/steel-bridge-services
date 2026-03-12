@extends('admin.layout')

@section('content')
    <h1 class="mb-6 text-2xl font-bold">Create Homepage Tab</h1>

    <div class="rounded-lg bg-white p-6 shadow">
        <form method="POST" action="{{ route('admin.homepage-tabs.store') }}" enctype="multipart/form-data">
            @include('admin.homepage-tabs._form')
        </form>
    </div>
@endsection
