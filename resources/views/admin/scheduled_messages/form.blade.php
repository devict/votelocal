@include('partials.errors')

<form id="scheduled_message_form" action="/admin/scheduled_messages{{ $scheduled_message->exists ? '/' . $scheduled_message->id : '' }}" method="POST">
    @csrf
    <div class="form-group">
        <label class="form-label" for="body_en">Body (English)</label>
        <character-count>
            <textarea class="form-control" name="body_en" id="body_en" cols="30" rows="3">{{ $scheduled_message->body_en }}</textarea>
        </character-count>
    </div>

    <div class="form-group">
        <label class="form-label" for="body_es">Body (Spanish)</label>
        <character-count>
            <textarea class="form-control" name="body_es" id="body_es" cols="30" rows="3">{{ $scheduled_message->body_es }}</textarea>
        </character-count>
    </div>
    
    <div class="form-group">
        <label class="form-label">Targets</label>
        <div class="form-control">
            <div class="custom-control custom-checkbox custom-control-inline">
                <input type="checkbox" class="custom-control-input" name="target_sms" id="target_sms" @if($scheduled_message->target_sms) checked @endif>
                <label class="custom-control-label" for="target_sms">SMS</label>
            </div>
            <div class="custom-control custom-checkbox custom-control-inline">
                <input type="checkbox" class="custom-control-input" name="target_twitter" id="target_twitter" @if($scheduled_message->target_twitter) checked @endif>
                <label class="custom-control-label" for="target_twitter">Twitter</label>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label class="form-label" for="send_at">Send At</label>
        <input class="form-control" type="datetime-local" name="send_at" id="send_at" value="{{ $scheduled_message->send_at->format('Y-m-d\TH:i') }}">
    </div>

    <button type="submit" class="btn btn-success">
        {{ $scheduled_message->exists ? 'Update' : 'Create' }}
    </button>

    @if ($scheduled_message->exists)
        <input type="hidden" name="_method" value="PUT">
    @endif
</form>
