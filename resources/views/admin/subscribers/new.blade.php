@extends('layouts.admin')

@section('content')
<h1 class="mb-8 font-bold text-2xl">
    <a
        class="text-blue-400 hover:text-blue-500"
        href="{{ route('subscribers.admin.index') }}"
    >Subscribers</a>
    <span class="text-blue-400 font-medium">/</span>
    Create Subscriber
</h1>

<div class="bg-white rounded shadow overflow-hidden max-w-sm">
    @include('admin.subscribers.form', compact('subscriber'))
</div>
@endsection
