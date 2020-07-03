import './bootstrap';
import Vue from 'vue';
import PortalVue from 'portal-vue';

Vue.use(PortalVue);

Vue.component('character-count', () => import('./components/CharacterCount'));
Vue.component('dropdown', () => import('./components/Dropdown'));

const app = new Vue({
    el: '#app',
});
