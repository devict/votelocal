<form action="{{ $scheduled_message->exists ? route('scheduled_messages.admin.update', $scheduled_message) : route('scheduled_messages.admin.create') }}" method="POST">
    <div class="p-8">
        @include('partials.flash')

        @csrf
        <character-count>
            @include('partials/fields/textarea', [
                'label' => __('Body (English)'),
                'name' => 'body_en',
                'value' => old('body_en', $scheduled_message->body_en),
                'attributes' => [
                    'required' => true,
                    'disabled' => (bool) $scheduled_message->sent,
                    'class' => (bool) $scheduled_message->sent ? 'bg-gray-300' : '',
                    'rows' => 5,
                ]
            ])
        </character-count>

        <character-count class="mt-6">
            @include('partials/fields/textarea', [
                'label' => __('Body (Spanish)'),
                'name' => 'body_es',
                'value' => old('body_es', $scheduled_message->body_es),
                'attributes' => [
                    'required' => true,
                    'disabled' => (bool) $scheduled_message->sent,
                    'class' => (bool) $scheduled_message->sent ? 'bg-gray-300' : '',
                    'rows' => 5,
                ]
            ])
        </character-count>
    </div>

    <div class="px-8">
        <label class="font-bold">Targets</label>
        <label class="pl-2" for="target_sms">
            <input type="checkbox" class="form-checkbox" name="target_sms" id="target_sms" @if($scheduled_message->target_sms) checked @endif>
            <span>SMS</span>
        </label>

        <label class="pl-2" for="target_twitter">
            <input type="checkbox" class="form-checkbox" name="target_twitter" id="target_twitter" @if($scheduled_message->target_twitter) checked @endif>
            <span>Twitter</span>
        </label>
    </div>

    <div class="px-8 py-8 flex">
        <div class="w-1/2">
            <label class="font-bold">Locations</label>
            @foreach ($locationTags as $tag)
                <div>
                    <label class="pr-4" for="tags[{{ $tag->id }}]">
                        <input type="checkbox" class="form-checkbox" name="tags[{{ $tag->id }}]" id="tags[{{ $tag->id }}]" @if($scheduled_message->hasTag($tag)) checked @endif>
                        <span>{{ ucwords($tag->name) }}</span>
                    </label>
                </div>
            @endforeach
        </div>
        <div class="w-1/2">
            <label class="font-bold">Topics</label>
            @foreach ($topicTags as $tag)
                <div>
                    <label class="pr-4" for="tags[{{ $tag->id }}]">
                        <input type="checkbox" class="form-checkbox" name="tags[{{ $tag->id }}]" id="tags[{{ $tag->id }}]" @if($scheduled_message->hasTag($tag)) checked @endif>
                        <span>{{ ucwords($tag->name) }}</span>
                    </label>
                </div>
            @endforeach
        </div>
    </div>

    <div class="px-8 pb-8">
        @include('partials/fields/input', [
            'label' => __('Send At'),
            'name' => 'send_at',
            'value' => old('send_at', $scheduled_message->send_at->format('Y-m-d\TH:i')),
            'class' => 'mt-6',
            'attributes' => [
                'required' => true,
                'disabled' => (bool) $scheduled_message->sent,
                'class' => (bool) $scheduled_message->sent ? 'bg-gray-300' : '',
            ]
        ])
    </div>

    @if (! $scheduled_message->sent)
        <div class="px-8 py-4 bg-gray-100 border-t border-gray-200 flex justify-{{ $scheduled_message->exists ? 'between' : 'end' }} items-center">
            @if ($scheduled_message->exists && ! $scheduled_message->sent)
                <a
                    href="{{ route('scheduled_messages.admin.destroy', $scheduled_message) }}"
                    onclick="return confirm('Are you sure?');"
                    class="focus:text-red-500 hover:text-red-500"
                >
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
