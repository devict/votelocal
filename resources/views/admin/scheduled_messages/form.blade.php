<form action="{{ $scheduled_message->exists ? route('scheduled_messages.admin.update', $scheduled_message) : route('scheduled_messages.admin.create') }}" method="POST">
    <div class="space-y-6 px-4 py-5 sm:p-6">
        <div>
            @include('partials.flash')
            @csrf
            <div class="space-y-4">
                <div>
                    <x-character-count
                        :label="__('Body (English)')"
                        name="body_en"
                        :value="old('body_en', $scheduled_message->body_en)"
                        :disabled="(bool) $scheduled_message->sent"
                        rows="5"
                        required
                    />
                </div>
                <div>
                    <x-character-count
                        :label="__('Body (Spanish)')"
                        name="body_en"
                        :value="old('body_es', $scheduled_message->body_es)"
                        :disabled="(bool) $scheduled_message->sent"
                        rows="5"
                        required
                    />
                </div>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <x-fieldset label="Locations">
                <ul>
                    @foreach ($locationTags as $tag)
                        <li>
                            <x-checkbox
                                :label="ucwords($tag->name)"
                                name="tags[{{ $tag->id }}]"
                                :checked="$scheduled_message->hasTag($tag) || (!$scheduled_message->exists && $tag->message_default)"
                            />
                        </li>
                    @endforeach
                </ul>
            </x-fieldset>
            <x-fieldset label="Topics">
                <ul>
                    @foreach ($topicTags as $tag)
                        <li>
                            <x-checkbox
                                :label="ucwords($tag->name)"
                                name="tags[{{ $tag->id }}]"
                                :checked="$scheduled_message->hasTag($tag) || (!$scheduled_message->exists && $tag->message_default)"
                            />
                        </li>
                    @endforeach
                </ul>
            </x-fieldset>
        </div>

        <div>
            <x-text
                :label="__('Send At')"
                name="sent_at"
                :value="old('send_at', $scheduled_message->send_at->format('Y-m-d\TH:i'))"
                :disabled="(bool) $scheduled_message->sent"
                required
            />
        </div>

        <x-fieldset label="Targets">
            <div>
                <x-checkbox
                    label="SMS"
                    name="target_sms"
                    :checked="$scheduled_message->target_sms"
                />
            </div>
            <div>
                <x-checkbox
                    :label="__('Twitter')"
                    name="target_twitter"
                    :checked="$scheduled_message->target_twitter"
                />
            </div>
        </x-fieldset>
    </div>

    @if (! $scheduled_message->sent)
        <div class="bg-gray-100 border-t border-gray-200 flex justify-{{ $scheduled_message->exists ? 'between' : 'end' }} items-center px-4 py-4 sm:px-6">
            @if ($scheduled_message->exists && ! $scheduled_message->sent)
                <a href="{{ route('scheduled_messages.admin.destroy', $scheduled_message) }}" onclick="return confirm('Are you sure?');" class="focus:text-red-500 hover:text-red-500">
                    Delete Message
                </a>
                <input type="hidden" name="_method" value="PUT">
            @endif
            <button class="btn">
                {{ $scheduled_message->exists ? 'Update' : 'Create' }}
            </button>
        </div>
    @endif
</form>
