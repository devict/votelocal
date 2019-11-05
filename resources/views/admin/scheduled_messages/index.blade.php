@extends('layouts.admin')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="font-bold text-2xl">Scheduled Messages</h1>
    <a href="{{ route('scheduled_messages.admin.new') }}" class="btn">
        <span>Create</span> <span class="hidden md:inline">Message</span>
    </a>
</div>

@include('partials.flash')

<div class="bg-white rounded shadow overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="text-left font-bold">
                    <th class="px-6 pt-6 pb-4">#</th>
                    <th class="px-6 pt-6 pb-4">Sent</th>
                    <th class="px-6 pt-6 pb-4">Send At</th>
                    <th class="px-6 pt-6 pb-4">Body (en)</th>
                    <th class="px-6 pt-6 pb-4">Body (es)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($scheduled_messages as $scheduled_message)
                    <tr class="hover:bg-gray-100 focus-within:bg-gray-100">
                        <td class="border-t">
                            <a
                                class="px-6 py-4 flex items-center"
                                href="{{ route('scheduled_messages.admin.edit', $scheduled_message) }}"
                                tabindex="-1"
                            >
                                {{ $scheduled_message->id }}
                            </a>
                        </td>
                        <td class="border-t">
                            <a
                                class="px-6 flex items-center text-gray-600"
                                href="{{ route('scheduled_messages.admin.edit', $scheduled_message) }}"
                                tabindex="-1"
                            >
                                @if ($scheduled_message->sent)
                                    <svg class="fill-current block h-8" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg"><path d="M5.707 7.293a1 1 0 0 0-1.414 1.414l2 2a1 1 0 0 0 1.414 0l4-4a1 1 0 0 0-1.414-1.414L7 8.586 5.707 7.293z" /></svg>
                                @else
                                    <div class="w-8 text-center">—</div>
                                @endif
                            </a>
                        </td>
                        <td class="border-t">
                            <a
                                class="px-6 py-4 flex items-center"
                                href="{{ route('scheduled_messages.admin.edit', $scheduled_message) }}"
                                tabindex="-1"
                            >
                                {{ $scheduled_message->send_at->format('m/d/Y g:i A') }}
                            </a>
                        </td>
                        <td class="border-t">
                            <a
                                class="px-6 py-4 flex items-center focus:text-blue-500 focus:outline-0"
                                href="{{ route('scheduled_messages.admin.edit', $scheduled_message) }}"
                            >
                                {{ $scheduled_message->body_en }}
                            </a>
                        </td>
                        <td class="border-t">
                            <a
                                class="px-6 py-4 flex items-center focus:text-blue-500 focus:outline-0"
                                href="{{ route('scheduled_messages.admin.edit', $scheduled_message) }}"
                            >
                                {{ $scheduled_message->body_es }}
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
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
