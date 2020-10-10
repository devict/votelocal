@props(['events' => []])

<div class="calendar">
    <input type="date" class="hidden" x-data="calendar({
        events: {{ json_encode($events) }}
    })" x-init="init()" />
</div>
