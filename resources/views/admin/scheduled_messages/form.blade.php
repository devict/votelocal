@if ($errors->any())
    <div class="alert alert-success" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<form id="scheduled_message_form" action="/admin/scheduled_messages{{ $scheduled_message->exists ? '/' . $scheduled_message->id : '' }}" method="POST">
    @csrf
    <div class="form-group">
        <label class="form-label" for="body">Body</label>
        <textarea class="form-control" name="body" id="body" cols="30" rows="3">{{ $scheduled_message->body }}</textarea>
    </div>

    <div class="form-group">
        <label class="form-label" for="send_at">Send At</label>
        <input class="form-control" type="datetime-local" name="send_at" id="send_at" value="{{ $scheduled_message->send_at }}">
    </div>

    <button type="submit" class="btn btn-success">
        {{ $scheduled_message->exists ? 'Update' : 'Create' }}
    </button>

    @if ($scheduled_message->exists)
        <input type="hidden" name="_method" value="PUT">
    @endif
</form>
