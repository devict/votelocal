import './bootstrap';
import Vue from 'vue';

Vue.component('character-count', () => import('./components/CharacterCount'));

const app = new Vue({
    el: '#app',
});
