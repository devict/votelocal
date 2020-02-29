<div x-data="dropdown()" class="relative {{ $class ?? '' }}">
    <button type="button" x-on:click="open()" class="{{ $buttonClass ?? '' }}">
        {{ $slot }}
    </button>
    <div
        style="position: fixed; top: 0; right: 0; left: 0; bottom: 0; z-index: 99998; background: black; opacity: .2"
        x-show="isOpen()"
        @click="close()"
    ></div>
    <div
        x-show="isOpen()"
        @click.away="close()"
        style="z-index: 99999; top: 100%;"
        class="absolute {{ $position }}"
    >
        {{ $menu }}
    </div>
</div>

