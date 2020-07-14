@include ('partials.flash')

<form action="{{ $subscriber->exists ? route('subscribers.admin.update', $subscriber) : route('subscribers.admin.create') }}" method="POST">
    @csrf
    <div class="space-y-4 px-4 py-5 sm:p-6">
        <div>
            <x-text
                type="tel"
                :label="__('Number')"
                name="number"
                :value="old('number', $subscriber->number)"
                :disabled="$subscriber->exists"
                required
            />
        </div>
        <div>
            <x-checkbox
                :label="__('Subscribed')"
                name="subscribed"
                :checked="old('subscribed', $subscriber->subscribed)"
            />
        </div>
    </div>
    <div class="bg-gray-100 border-t border-gray-200 flex justify-{{ $subscriber->exists ? 'between' : 'end' }} items-center px-4 py-4 sm:px-6">
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
