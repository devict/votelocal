@include ('partials.flash')

<form action="{{ $subscriber->exists ? route('subscribers.admin.update', $subscriber) : route('subscribers.admin.create') }}" method="POST">
    <div class="p-8">
        @csrf
        @include('partials/fields/input', [
            'label' => __('Number'),
            'name' => 'number',
            'value' => old('number', $subscriber->number),
            'attributes' => [
                'required' => true,
                'disabled' => $subscriber->exists,
                'class' => $subscriber->exists ? 'bg-gray-300' : '',
            ]
        ])

        @include('partials/fields/checkbox', [
            'label' => __('Subscribed'),
            'name' => 'subscribed',
            'class' => 'mt-6',
            'checked' => old('subscribed', $subscriber->subscribed),
        ])
    </div>
    <div class="px-8 py-4 bg-gray-100 border-t border-gray-200 flex justify-{{ $subscriber->exists ? 'between' : 'end' }} items-center">
        @if ($subscriber->exists)
            <a
                href="{{ route('subscribers.admin.destroy', $subscriber) }}"
                onclick="return confirm('Are you sure?');"
                class="focus:text-red-500 hover:text-red-500"
            >
                Delete Subscriber
            </a>
            <input type="hidden" name="_method" value="PUT">
        @endif

        <button class="btn">
            {{ $subscriber->exists ? 'Update' : 'Create' }}
        </button>
    </div>
</form>
