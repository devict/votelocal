@extends('layouts.admin')

@section('content')
<h1 class="mb-8 font-bold text-2xl">
    <a
        class="text-blue-400 hover:text-blue-500"
        href="{{ route('scheduled_messages.admin.index') }}"
    >Shedule Messages</a>
    <span class="text-blue-400 font-medium">/</span>
    Create Message
</h1>

<div class="max-w-xl bg-white rounded shadow overflow-hidden">
    @include('admin.scheduled_messages.form', [
        'scheduled_message' => $scheduled_message,
    ])
</div>
@endsection
