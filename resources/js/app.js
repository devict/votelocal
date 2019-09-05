import './bootstrap';
import Vue from 'vue';

Vue.component('character-count', () =>
    import(
        /* webpackChunkName: '/js/character-count' */ './components/CharacterCount'
    )
);

const app = new Vue({
    el: '#app',
});
