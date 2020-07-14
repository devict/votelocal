<form action="{{ $tag->exists ? route('tags.admin.update', $tag) : route('tags.admin.create') }}" method="POST">
    @csrf
    <div class="space-y-4 px-4 py-5 sm:px-6">
        <div>
            <x-text
                :label="__('Name')"
                name="name"
                :value="old('name', $tag->name)"
                required
                autofocus
            />
        </div>
        <div>
            <x-select
                :label="__('Category')"
                name="category"
                :value="old('name', $tag->category)"
                :options="$categories"
                required
            />
        </div>
        <x-fieldset label="Default For:">
            <ul>
                <li>
                    <x-checkbox label="Subscribers" name="subscriber_default" :checked="(bool) old('subscriber_default', $tag->subscriber_default)" />
                </li>
                <li>
                    <x-checkbox label="Messages" name="message_default" :checked="(bool) old('message_default', $tag->message_default)" />
                </li>
            </ul>
        </x-fieldset>
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
