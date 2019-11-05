@if ($status = session('status'))
    <div role="alert" class="p-4 mb-8 bg-green-100 text-green-800 rounded border border-green-600 flex items-center justify-between">
        {{ $status }}
    </div>
@endif
@if ($count = $errors->count())
    <div role="alert" class="p-4 mb-8 bg-red-100 text-red-800 rounded border border-red-600 flex items-center justify-between">
        There {{ $count > 1 ? "are {$count} errors" : 'is one error' }} on the page.
    </div>
@endif
