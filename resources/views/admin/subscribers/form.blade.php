@include ('partials.errors')

<form id="subscriber_form" action="{{ $subscriber->exists ? route('subscribers.admin.update', $subscriber) : route('subscribers.admin.create') }}" method="POST">
    @csrf
    <div class="form-group">
        <label class="form-label" for="body">Number</label>
        <input type="text" class="form-control" name="number" id="number" value="{{ old('number', $subscriber->number) }}">
    </div>

    <div class="form-group">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="subscribed" id="subscribed" value="1"{{ 1 == old('subscribed', $subscriber->subscribed) ? ' checked' : '' }}>
            <label class="form-check-label" for="subscribed">Subscribed</label>
        </div>
    </div>

    <button type="submit" class="btn btn-success">
        {{ $subscriber->exists ? 'Update' : 'Create' }}
    </button>

    @if ($subscriber->exists)
        <input type="hidden" name="_method" value="PUT">
    @endif
</form>
