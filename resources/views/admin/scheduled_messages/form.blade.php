<form action="{{ $scheduled_message->exists ? route('scheduled_messages.admin.update', $scheduled_message) : route('scheduled_messages.admin.create') }}" method="POST">
    <div class="p-8">
        @include('partials.flash')
        @csrf

        @include('partials/fields/character-count', [
            'label' => __('Body (English)'),
            'name' => 'body_en',
            'value' => old('body_en', $scheduled_message->body_en),
            'attributes' => [
                'required' => true,
                'disabled' => (bool) $scheduled_message->sent,
                'rows' => 5,
            ]
        ])

        @include('partials/fields/character-count', [
            'label' => __('Body (Spanish)'),
            'name' => 'body_es',
            'value' => old('body_es', $scheduled_message->body_es),
            'class' => 'mt-4',
            'attributes' => [
                'required' => true,
                'disabled' => (bool) $scheduled_message->sent,
                'rows' => 5,
            ]
        ])

        @include('partials/fields/input', [
            'label' => __('Send At'),
            'name' => 'send_at',
            'value' => old('send_at', $scheduled_message->send_at->format('Y-m-d\TH:i')),
            'class' => 'mt-4',
            'attributes' => [
                'required' => true,
                'disabled' => (bool) $scheduled_message->sent,
            ]
        ])


        <div class="mt-4">
            <label>Targets:</label>
            <label class="pl-2" for="target_sms">
                <input type="checkbox" class="form-checkbox" name="target_sms" id="target_sms" @if($scheduled_message->target_sms) checked @endif>
                <span>SMS</span>
            </label>

            <label class="pl-2" for="target_twitter">
                <input type="checkbox" class="form-checkbox" name="target_twitter" id="target_twitter" @if($scheduled_message->target_twitter) checked @endif>
                <span>Twitter</span>
            </label>
        </div>
    </div>

    @if (! $scheduled_message->sent)
        <div class="px-8 py-4 bg-gray-100 border-t border-gray-200 flex justify-{{ $scheduled_message->exists ? 'between' : 'end' }} items-center">
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
