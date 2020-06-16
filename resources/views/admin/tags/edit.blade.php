@extends('layouts.admin')

@section('content')
<h1 class="mb-8 font-bold text-2xl">
    <a
        class="text-blue-400 hover:text-blue-500"
        href="{{ route('tags.admin.index') }}"
    >Tags</a>
    <span class="text-blue-400 font-medium">/</span>
    Edit Tag
</h1>

<div class="max-w-xl bg-white rounded shadow overflow-hidden">
    @include('admin.tags.form', [ 'tag' => $tag ])
</div>
@endsection
