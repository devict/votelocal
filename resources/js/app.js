import 'alpinejs';

window.dropdown = () => {
    return {
        show: false,
        open() {
            this.show = true;
        },
        close() {
            this.show = false;
        },
        isOpen() {
            return this.show === true;
        },
    };
};
