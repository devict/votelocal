require('./bootstrap');

window.Vue = require('vue');

Vue.component(
    'character-count',
    require('./components/CharacterCount').default
);

const app = new Vue({
    el: '#app',
});
