let axios = require('axios');
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let debounce = require('lodash/debounce');

export default () => {
    return {
        message: '',
        stats: {
            messages: 0,
            remaining: 160
        },
        fetchMessageCount: debounce(function() {
            if (!this.message.length) {
                this.resetStats();
                return;
            }

            axios
                .get('/api/message-count', {
                    params: {
                        message: this.message
                    }
                })
                .then(response => {
                    this.stats = response.data;
                })
                .catch(error => {
                    console.error(error);
                });
        }, 1000),

        get characterCount() {
            return (
                this.message.length +
                ' ' +
                ' character' +
                (this.message.length !== 1 ? 's' : '')
            );
        },

        get messageCount() {
            return this.stats.messages + ' messages';
        },

        get messageCharactersRemaining() {
            return this.stats.remaining + ' characters remaining';
        },

        get messageStats() {
            return (
                this.characterCount +
                ' | ' +
                this.messageCount +
                ' | ' +
                this.messageCharactersRemaining
            );
        },

        resetStats() {
            this.stats = {
                messages: 0,
                remaining: 160
            };
        }
    };
};
