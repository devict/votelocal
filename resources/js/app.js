import './bootstrap';
import Vue from 'vue';
import CharacterCount from './components/CharacterCount';

Vue.component('character-count', () => CharacterCount);

const app = new Vue({
    el: '#app',
});
