@props([
    'name' => null,
    'id' => $name,
    'label' => '',
    'value' => '',
])
@if ($label)
    <label for="{{ $id }}" class="block text-gray-700">{!! $label !!}</label>
@endif
<div x-data="messageBox()" class="relative rounded-md shadow-sm {{ $label ? 'mt-1' : '' }}" x-init="message = '{{ $value }}'">
    <textarea name="{{ $name }}" id="{{ $id }}" x-model="message" {{ $attributes->merge([
        'class' => 'form-textarea rounded-b-none block w-full relative focus:z-10',
        'aria-describedby' => $errors->has($name) ? "{$id}-error" : null,
    ]) }} x-on:keyup="fetchMessageCount">{{ $value }}</textarea>
    <small
        class="block px-4 py-1 text-gray-600 border border-gray-300 border-t-0 rounded-b-md"
        x-text="messageStats">
    </small>
</div>
@error($name)
    <p class="mt-2 text-sm text-red-600" id="{{ $id }}-error">{{ $message }}</p>
@enderror

<script>
    function messageBox () {
        return {
            message: '',
            stats: {
                messages: 0,
                remaining: 160
            },
            fetchMessageCount: debounce(function () {
                if (! this.message.length) {
                    this.resetStats()
                    return
                }

                axios.get('/api/message-count', {
                    params: {
                        message: this.message
                    }
                })
                .then(response => {
                    this.stats = response.data
                })
                .catch(error => {
                    console.error(error)
                })
            }, 1000),

            get characterCount() {
                return this.message.length + ' ' + ' character' + (this.message.length !== 1 ? 's' : '')
            },

            get messageCount() {
                return this.stats.messages + ' messages'
            },

            get messageCharactersRemaining() {
                return this.stats.remaining + ' characters remaining'
            },

            get messageStats() {
                return this.characterCount + ' | ' + this.messageCount + ' | ' + this.messageCharactersRemaining
            },

            resetStats() {
                this.stats = {
                    messages: 0,
                    remaining: 160
                }
            }
        }
    }
</script>