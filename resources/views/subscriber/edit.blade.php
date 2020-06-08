@extends('layouts.admin')

@section('content')
<h1 class="mb-6 font-bold text-2xl">
    <a
        class="text-blue-400 hover:text-blue-500"
        href="{{ route('subscribers.admin.index') }}"
    >Subscribers</a>
    <span class="text-blue-400 font-medium">/</span>
    {{ $subscriber->number }}
</h1>

<div class="max-w-xl bg-white rounded shadow overflow-hidden">
    @include('admin.subscribers.form', compact('subscriber'))
</div>

<div class="max-w-xl sm:flex items-center justify-between mt-8 mb-4">
    <h2 class="font-bold text-xl">Message History</h2>
    <form class="flex max-w-xs bg-white shadow rounded mt-4 sm:mt-0">
        @include('partials/fields/select', [
            'label' => '',
            'name' => 'type',
            'options' => $types,
            'class' => 'w-full',
            'value' => $filters->get('type'),
            'attributes' => ['class' => 'border-0 border-r rounded-tr-none rounded-br-none relative z-10'],
        ])

        <button class="btn bg-white text-gray-800 rounded-tl-none rounded-bl-none hover:bg-gray-100">
            Filter
        </button>
    </form>
</div>

<div class="max-w-xl bg-white rounded shadow overflow-x-auto">
    @foreach ($messages as $message)
        <div class="border-t px-6 py-6 leading-normal {{ $message->to !== $subscriber->number ? 'bg-gray-100' : '' }}">
            {{ $message->body }}
            <div class="text-sm text-gray-600 mt-4">
                <div class="text-sm text-gray-600 border-gray-200 flex justify-between items-center">
                    <span><strong>To:</strong> {{ $message->to }}</span>
                    <span><strong>Sent:</strong> {{ $message->created_at->format('m/d/Y g:i A') }}</span>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
