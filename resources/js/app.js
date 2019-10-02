import './bootstrap';
import Vue from 'vue';
import PortalVue from 'portal-vue';

Vue.use(PortalVue);

Vue.component('character-count', () =>
    import(
        /* webpackChunkName: 'js/character-count' */ './components/CharacterCount'
    )
);
Vue.component('dropdown', () =>
    import(/* webpackChunkName: 'js/dropdown' */ './components/Dropdown')
);

const app = new Vue({
    el: '#app',
});
