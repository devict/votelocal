import 'alpinejs';

window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

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

window.tagManager = options => {
    return {
        updateEndpoint: '',
        activeTags: [],
        loading: false,
        updateTags(event) {
            this.loading = true;
            let tagId = parseInt(event.target.value);
            let oldTags = this.activeTags;
            if (this.activeTags.indexOf(tagId) === -1) {
                this.addTag(tagId);
            } else {
                this.remTag(tagId);
            }
            axios
                .post(this.updateEndpoint, { tags: this.activeTags })
                .then(res => {
                    this.loading = false;
                    this.activeTags = res.data;
                })
                .catch(err => {
                    this.loading = false;
                    this.activeTags = oldTags;
                    console.log(err);
                });
        },
        addTag(tagId) {
            this.remTag(tagId); // To prevent duplicates.
            this.activeTags.push(tagId);
        },
        remTag(tagId) {
            this.activeTags = this.activeTags.filter(id => id !== tagId);
        },
        isChecked(tagId) {
            return this.activeTags.includes(tagId);
        },
        ...options
    };
};

window.copyOnClick = options => {
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
      setTimeout(() => { this.showMsg = false; }, 5000);
    },
    ...options
  };
};
