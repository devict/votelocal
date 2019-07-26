<template>
    <div>
        <slot></slot>
        <slot name="label" :limit="limit" :remaining="remaining" :count="count">
            <small class="text-muted">
                {{ count }} character{{ count !== 1 ? 's' : '' }}
            </small>
        </slot>
    </div>
</template>

<script>
export default {
    props: {
        limit: {
            default: 0,
        },
    },

    data: () => ({
        count: 0,
        listener: null,
    }),

    mounted() {
        this.listener = event => {
            this.count = event.target.value.length;
        };

        this.$slots.default[0].elm.addEventListener('input', this.listener);
    },

    destroyed() {
        this.$slots.default[0].elm.removeEventListener(this.listener);
    },

    computed: {
        remaining() {
            return this.limit - this.count;
        },
    },

    methods: {
        updateCount(value) {
            this.count = String(value).length;
        },
    },
};
</script>
