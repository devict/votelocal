import './bootstrap';
import Vue from 'vue';
import PortalVue from 'portal-vue';

Vue.use(PortalVue);

Vue.component('character-count', () => import('./components/CharacterCount'));
Vue.component('dropdown', () => import('./components/Dropdown'));
Vue.component('elected-official-lookup', () => import('./components/ElectedOfficialLookup'));

const app = new Vue({
    el: '#app',
});
