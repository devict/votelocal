<form action="{{ $tag->exists ? route('tags.admin.update', $tag) : route('tags.admin.create') }}" method="POST">
    @csrf
        @include('partials/fields/input', [
            'label' => __('Name'),
            'name' => 'name',
            'value' => old('name', $tag->name),
            'class' => 'mt-6',
            'attributes' => [ 'required' => true ],
        ])
    <div class="space-y-4 px-4 py-5 sm:px-6">
    </div>

    <div class="px-8">
        @include('partials/fields/select', [
            'label' => __('Category'),
            'name' => 'category',
            'value' => old('name', $tag->category),
            'class' => 'mt-6',
            'attributes' => [ 'required' => true ],
            'options' => $categories,
        ])
    </div>

    <div class="px-8 py-8">
        <label><strong>Default For:</strong></label>

        <label class="pl-2" for="subscriber_default">
            <input type="checkbox" class="form-checkbox" name="subscriber_default" id="subscriber_default" @if($tag->subscriber_default) checked @endif>
            <span>Subscribers</span>
        </label>

        <label class="pl-2" for="message_default">
            <input type="checkbox" class="form-checkbox" name="message_default" id="message_default" @if($tag->message_default) checked @endif>
            <span>Messages</span>
        </label>
    </div>

    <div class="bg-gray-100 border-t border-gray-200 flex justify-{{ $tag->exists ? 'between' : 'end' }} items-center px-4 py-4 sm:px-6">
        @if ($tag->exists)
            <a
                href="{{ route('tags.admin.destroy', $tag) }}"
                onclick="return confirm('Are you sure?');"
                class="focus:text-red-500 hover:text-red-500"
            >
                Delete Tag
            </a>
            <input type="hidden" name="_method" value="PUT">
        @endif
        <button class="btn">
            {{ $tag->exists ? 'Update' : 'Create' }}
        </button>
    </div>
</form>
