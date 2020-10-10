export default options => {
    return {
        text: '',
        showMsg: false,
        copyToClipboard(_event) {
            const el = document.createElement('textarea');
            el.value = this.text;

            document.body.appendChild(el);

            el.select();
            document.execCommand('copy');

            document.body.removeChild(el);

            this.showMsg = true;
            setTimeout(() => {
                this.showMsg = false;
            }, 5000);
        },
        ...options
    };
};
