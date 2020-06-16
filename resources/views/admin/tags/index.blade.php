@extends('layouts.admin')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="font-bold text-2xl">Tags</h1>
    <a href="{{ route('tags.admin.new') }}" class="btn">
        <span>Create</span> <span class="hidden md:inline">Tag</span>
    </a>
</div>

@include('partials.flash')

<div class="bg-white rounded shadow overflow-x-auto">
    <table class="w-full">
        <thead>
            <tr class="text-left font-bold">
                <th class="px-6 pt-6 pb-4">Name</th>
                <th class="px-6 pt-6 pb-4">Category</th>
                <th class="px-6 pt-6 pb-4">Subscriber Default</th>
                <th class="px-6 pt-6 pb-4">Message Default</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tags as $tag)
                <tr class="hover:bg-gray-100 focus-within:bg-gray-100">
                    <td class="border-t">
                        <a
                            class="px-6 py-4 flex items-center"
                            href="{{ route('tags.admin.edit', $tag) }}"
                            tabindex="-1"
                        >
                            {{ $tag->name }}
                        </a>
                    </td>
                    <td class="border-t">{{ $tag->category }}</td>
                    <td class="border-t">
                        @if ($tag->subscriber_default)
                            X
                        @endif
                    </td>
                    <td class="border-t w-px">
                        @if ($tag->message_default)
                            X
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
