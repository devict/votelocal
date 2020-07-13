@extends('layouts.admin')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="font-bold text-2xl">Subscribers</h1>
    <a href="{{ route('subscribers.admin.new') }}" class="btn">
        <span>Create</span> <span class="hidden md:inline">Subscriber</span>
    </a>
</div>

@include('partials.flash')

<div class="bg-white rounded shadow overflow-x-auto">
    <table class="w-full">
        <thead>
            <tr class="text-left font-bold">
                <th class="px-4 py-4 sm:px-6">Subscriber Number</th>
                <th class="px-4 py-4 sm:px-6">Subscribed</th>
                <th class="px-4 py-4 sm:px-6">Locale</th>
                <th class="px-4 py-4 sm:px-6">Created</th>
                <th class="px-4 py-4 sm:px-6">Updated</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($subscribers as $subscriber)
                <tr class="hover:bg-gray-100 focus-within:bg-gray-100">
                    <td class="border-t">
                        <a
                            class="px-4 py-4 sm:px-6 flex items-center focus:text-blue-500 focus:outline-0"
                            href="{{ route('subscribers.admin.edit', $subscriber) }}"
                        >
                            {{ $subscriber->number }}
                        </a>
                    </td>
                    <td class="border-t">
                        <a
                            class="px-6 flex items-center text-gray-600"
                            href="{{ route('subscribers.admin.edit', $subscriber) }}"
                            tabindex="-1"
                        >
                            @if ($subscriber->subscribed)
                                <x-icon-checkmark width="24" />
                            @else
                                <div class="w-8 text-center">—</div>
                            @endif

                        </a>
                    </td>
                    <td class="border-t">
                        <a
                            class="px-4 py-4 sm:px-6 flex items-center"
                            href="{{ route('subscribers.admin.edit', $subscriber) }}"
                            tabindex="-1"
                        >
                            {{ $subscriber->locale }}
                        </a>
                    </td>
                    <td class="border-t">
                        <a
                            class="px-4 py-4 sm:px-6 flex items-center"
                            href="{{ route('subscribers.admin.edit', $subscriber) }}"
                            tabindex="-1"
                        >
                            {{ $subscriber->created_at->format('m/d/Y') }}
                        </a>
                    </td>
                    <td class="border-t">
                        <a
                            class="px-4 py-4 sm:px-6 flex items-center"
                            href="{{ route('subscribers.admin.edit', $subscriber) }}"
                            tabindex="-1"
                        >
                            {{ $subscriber->updated_at->format('m/d/Y') }}
                        </a>
                    </td>
                    <td class="border-t w-px">
                        <a
                            class="px-4 flex items-center text-gray-500"
                            href="{{ route('subscribers.admin.edit', $subscriber) }}"
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
{{ $subscribers->links() }}
@endsection
