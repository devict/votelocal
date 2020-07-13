@extends('layouts.admin')

@section('content')
<h1 class="mb-6 font-bold text-2xl">
    <a
        class="text-blue-400 hover:text-blue-500"
        href="{{ route('scheduled_messages.admin.index') }}"
    >Scheduled Messages</a>
    <span class="text-blue-400 font-medium">/</span>
    Message #{{ $scheduled_message->id }}
</h1>

<div class="max-w-xl bg-white rounded shadow overflow-hidden">
    @if ($scheduled_message->sent)
        <div class="px-4 pt-4 sm:pt-5 sm:px-6">
            <div class="p-4 bg-yellow-400 text-yellow-800 rounded border border-yellow-600 flex items-center justify-between">
                This message has been sent and can no longer be changed.
            </div>
        </div>
    @endif
    @include('admin.scheduled_messages.form', compact('scheduled_message'))
</div>

<h2 class="font-bold text-xl mt-8 mb-4">Message History</h2>

<div class="max-w-xl bg-white rounded shadow overflow-x-auto">
    <table class="w-full whitespace-no-wrap">
        <thead>
            <tr class="text-left font-bold">
                <th class="px-4 py-4 sm:px-6">Sent At</th>
                <th class="px-4 py-4 sm:px-6">To</th>
                <th class="px-4 py-4 sm:px-6">From</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($scheduled_message->messages as $message)
                @if ($message->subscriber)
                    <tr class="hover:bg-gray-100 focus-within:bg-gray-100">
                        <td class="border-t">
                            <a class="px-4 py-4 sm:px-6 flex items-center" href="{{ route('subscribers.admin.edit',  $message->subscriber) }}">
                                {{ $message->created_at->format('m/d/Y g:i A') }}
                            </a>
                        </td>
                        <td class="border-t">
                            <a class="px-4 py-4 sm:px-6 flex items-center" href="{{ route('subscribers.admin.edit',  $message->subscriber) }}">
                                {{ $message->to }}
                            </a>
                        </td>
                        <td class="border-t">
                            <a class="px-4 py-4 sm:px-6 flex items-center" href="{{ route('subscribers.admin.edit',  $message->subscriber) }}">
                                {{ $message->from }}
                            </a>
                        </td>
                        <td class="border-t w-px">
                            <a
                                class="px-4 flex items-center text-gray-500"
                                href="{{ route('scheduled_messages.admin.edit', $scheduled_message) }}"
                                tabindex="-1"
                            >
                                <svg class="fill-current block w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><polygon points="12.95 10.707 13.657 10 8 4.343 6.586 5.757 10.828 10 6.586 14.243 8 15.657 12.95 10.707"/></svg>
                            </a>
                        </td>
                    </tr>
                @else
                    <tr>
                        <td class="border-t px-4 py-4 sm:px-6">
                            {{ $message->created_at->format('m/d/Y g:i A') }}
                        </td>
                        <td class="border-t px-4 py-4 sm:px-6">
                            {{ $message->to }}
                        </td>
                        <td class="border-t px-4 py-4 sm:px-6">
                            {{ $message->from }}
                        </td>
                    </tr>
                @endif
            @empty
                <tr>
                    <td colspan="3" class="border-t px-4 py-4 sm:px-6">
                        @if($scheduled_message->sent)
                            No sent messages recorded.
                        @else
                            Recipients are recorded here when this message is sent.
                        @endif
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
