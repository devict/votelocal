@extends('layouts.app', ['background' => 'bg-gray-200'])

@section('content')
<div class="py-8 md:p-12">
    <div class="max-w-xl mx-auto">
        <h1 class="mb-6 font-bold text-2xl">Message Archive</h1>
        <div class="bg-white rounded shadow">
            @foreach($messages as $message)
                <div class="border-t px-6 py-6 leading-normal ">
                    {!! $message->html !!}
                    <div class="text-sm text-gray-600 mt-4">
                        <div class="text-sm text-gray-600 border-gray-200 flex justify-between items-center">
                            <span><strong>Sent:</strong> {{ $message->send_at->toDayDateTimeString() }}</span>
                        </div>
                    </div>
                </div>
            @endforeach

            {{ $messages->links() }}
        </div>
    </div>
</div>
@endsection
