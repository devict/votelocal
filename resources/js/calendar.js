import flatpickr from 'flatpickr';

export default options => {
    return {
        events: [],
        init() {
            flatpickr(this.$el, {
                inline: true,
                enable: this.events.map(event => new Date(event))
            });
        },
        ...options
    };
};
