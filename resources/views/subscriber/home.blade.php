@extends('layouts.app', ['background' => 'bg-gray-200'])

@section('content')
<main class="mt-16 sm:px-6 lg:px-8">
    <div class="w-full max-w-sm mx-auto">
        <div class="mt-16 bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="px-4 py-5 sm:p-6">
                <h1 class="text-center font-bold text-3xl">
                    <span class="block text-base text-gray-600">Subscription for</span>
                    {{ $subscriber->number }}
                </h1>
                <div class="mx-auto mt-6 w-24 border-b-2"></div>


                @if(!$subscriber->subscribed)
                    <div class="mt-6">
                        <dl class="flex justify-center items-center">
                            <dt>Status:</dt>
                            <dd class="ml-2 font-semibold bg-yellow-200 text-yellow-800 rounded-full text-sm py-1 px-3">Not Active</dd>
                        </dl>
                        <form action="{{ route('subscriber.enable')}}" method="POST" class="mt-4 text-center">
                            @csrf
                            <button class="btn" type="submit">Sign back up!</submit>
                        </form>
                    </div>
                @else
                    <div class="mt-6">
                        <dl class="flex justify-center items-center">
                            <dt>Status:</dt>
                            <dd class="ml-2 font-semibold bg-green-200 text-green-800 rounded-full text-sm py-1 px-3">Active</dd>
                        </dl>

                        @if (!$subscriber->pledged)
                            <form class="" method="POST" action="{{ route('subscriber.pledge') }}">
                                @csrf
                                <x-text
                                    :label="__('Name')"
                                    name="name"
                                    :value="old('name', $subscriber->name)"
                                    required
                                />
                                <x-checkbox
                                    :label="__('Don\'t display my name publicly')"
                                    name="hide_from_pledge_board"
                                    :value="old('hide_from_pledge_board', $subscriber->hide_from_pledge_board)"
                                />
                                <button class="btn text-xl font-bold mt-6">Pledge to Vote!</button>
                            </form>
                        @else
                            <h2 class="text-xl font-bold mt-6">Thank you for your pledge!</h2>
                        @endif

                        <h2 class="text-xl font-bold mt-6">Preferences</h2>
                        <div
                            x-data="tagManager({
                                updateEndpoint: '{{ route('subscriber.updateTags') }}',
                                activeTags: {{ json_encode($subscriber->tagIds()) }}
                            })"
                            class="mt-4 grid grid-cols-2 gap-4"
                        >
                            <x-fieldset label="Locations">
                                <ul>
                                    @foreach($locationTags as $tag)
                                        <li>
                                            <label>
                                                <input type="checkbox"
                                                    value="{{ $tag->id }}"
                                                    :disabled="loading"
                                                    @change="updateTags"
                                                    :checked="isChecked({{ $tag->id }})"
                                                >
                                                {{ $tag->name }}
                                            </label>
                                        </li>
                                    @endforeach
                                </ul>
                            </x-fieldset>
                            <x-fieldset label="Topics">
                                <ul>
                                    @foreach($topicTags as $tag)
                                        <li>
                                            <label>
                                                <input type="checkbox"
                                                    value="{{ $tag->id }}"
                                                    :disabled="loading"
                                                    @change="updateTags"
                                                    :checked="isChecked({{ $tag->id }})"
                                                >
                                                {{ $tag->name }}
                                            </label>
                                        </li>
                                    @endforeach
                                </ul>
                            </x-fieldset>
                        </div>
                        <form action="{{ route('subscriber.disable')}}" method="POST" class="mt-16 text-center">
                            @csrf
                            <button onclick="return confirm('Are you sure?')" class="hover:underline text-red-400">Disable your subscription</button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</main>
@endsection
