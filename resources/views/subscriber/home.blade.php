@extends('layouts.app', ['background' => 'bg-gray-200'])

@section('content')
<main class="mt-16 sm:px-6 lg:px-8">
    <div class="w-full max-w-sm mx-auto">
        <div class="mt-16 bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="px-4 py-5 sm:p-6">
                <h1 class="text-center font-bold text-3xl">
                    <span class="block text-base text-gray-600">@lang('Subscription for')</span>
                    {{ $subscriber->number }}
                </h1>
                <div class="mx-auto mt-6 w-24 border-b-2"></div>


                @if(!$subscriber->subscribed)
                    <div class="mt-6">
                        <dl class="flex justify-center items-center">
                            <dt>@lang('Subscription Status'):</dt>
                            <dd class="ml-2 font-semibold bg-yellow-200 text-yellow-800 rounded-full text-sm py-1 px-3">@lang('Not Active')</dd>
                        </dl>
                        <form action="{{ route('subscriber.enable')}}" method="POST" class="mt-4 text-center">
                            @csrf
                            <button class="btn" type="submit">@lang('Sign back up!')</submit>
                        </form>
                    </div>
                @else
                    <div class="mt-6">
                        <dl class="flex justify-center items-center">
                            <dt>@lang('Status'):</dt>
                            <dd class="ml-2 font-semibold bg-green-200 text-green-800 rounded-full text-sm py-1 px-3">@lang('Active')</dd>
                        </dl>

                        <div class="mx-auto mt-6 w-24 border-b-2"></div>

                        <div class="justify-center mt-8">
                            @if (!$subscriber->pledged)
                                <form class="" method="POST" action="{{ route('subscriber.pledge') }}">
                                    @csrf
                                    <x-text
                                        name="name"
                                        :value="old('name', $subscriber->name)"
                                        required
                                        :placeholder="__('Your Name')"
                                    />
                                    <div class="text-xs text-gray-600">
                                        <x-checkbox
                                            :label="__('Don\'t display my name publicly')"
                                            name="hide_from_pledge_board"
                                        />
                                    </div>
                                    <button class="btn text-xl font-bold mt-6 w-full">@lang('Pledge to Vote!')</button>
                                </form>
                            @else
                                {{-- <h2 class="text-xl font-bold mt-6">Thanks for pledging, {{ $subscriber->name }}!</h2> --}}
                                <p class="text-center">
                                    <strong class="text-lg">@lang('Thanks for pledging!')</strong>
                                    <br>@lang('Now share this link to boost your impact.')
                                </p>
                                <div x-data="copyOnClick({ showMsg: false, text: 'https://votelocalks.org/pledge/{{ $subscriber->referrer_id }}' })">
                                    <p @click="copyToClipboard" class="referral-link w-full justify-center my-4 p-3 bg-blue-100 border border-blue-500 rounded-md text-sm mb-0">
                                        https://votelocalks.org/pledge/{{ $subscriber->referrer_id }}
                                    </p>
                                    <p :class="{ 'hidden': !showMsg }"
                                        class="text-xs tex-bold text-gray-800 mt-2 pt-0">@lang('Copied to clipboard!')</p>
                                </div>
                                @if($subscriber->numReferrals() > 0)
                                    <p class="text-center mt-4">@lang('Great job! Your pledge has echoed<br><strong>:num times</strong> across the plains.', [ 'num' => $subscriber->numReferrals() ])</p>
                                @endif
                            @endif
                        </div>

                        <div class="mx-auto mt-6 w-24 border-b-2"></div>

                        <h2 class="text-xl font-bold mt-6">@lang('Notification Preferences')</h2>
                        <div
                            x-data="tagManager({
                                updateEndpoint: '{{ route('subscriber.updateTags') }}',
                                activeTags: {{ json_encode($subscriber->tagIds()) }}
                            })"
                            class="mt-4 grid grid-cols-2 gap-4"
                        >
                            <x-fieldset :label="__('Locations')">
                                <ul>
                                    @foreach($locationTags as $tag)
                                        <li class="text-sm">
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
                            <x-fieldset :label="__('Topics')">
                                <ul>
                                    @foreach($topicTags as $tag)
                                        <li class="text-sm">
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
                        @if ($subscriber->pledged)
                            @if(!$subscriber->hide_from_pledge_board)
                                <form action="{{ route('subscriber.pledgeDisplayUpdate')}}" method="POST" class="mt-16 text-center">
                                    @csrf
                                    <input type="hidden" name="hide_from_pledge_board" value="true">
                                    <button onclick="return confirm('Are you sure?')" class="hover:underline text-sm text-red-400">@lang('Hide name from the pledge board.')</button>
                                </form>
                            @else
                                <form action="{{ route('subscriber.pledgeDisplayUpdate')}}" method="POST" class="mt-16 text-center">
                                    @csrf
                                    <input type="hidden" name="hide_from_pledge_board" value="false">
                                    <button onclick="return confirm('Are you sure?')" class="hover:underline text-sm text-green-600">@lang('Show name on the pledge board.')</button>
                                </form>
                            @endif
                        @endif
                        <form action="{{ route('subscriber.updateLocale')}}" method="POST" class="mt-{{ $subscriber->pledged ? '4' : '16' }} mb-16">
                            @csrf
                            <select name="locale" class="w-1/2 bg-white border border-gray-400 hover:border-gray-500 px-2 py-2 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                                <option value="en" {{ $subscriber->locale === 'en' ? 'selected' : '' }}>@lang('English')</option>
                                <option value="es" {{ $subscriber->locale === 'es' ? 'selected' : '' }}>@lang('Spanish')</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                            </div>
                            <button onclick="return confirm('Are you sure?')" class="btn float-right">@lang('Update Language')</button>
                        </form>
                        <form action="{{ route('subscriber.disable')}}" method="POST" class="mt-{{ $subscriber->pledged ? '4' : '16' }} mb-16 text-center">
                            @csrf
                            <button onclick="return confirm('Are you sure?')" class="hover:underline text-sm text-red-400">@lang('Disable subscription.')</button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</main>
@endsection
