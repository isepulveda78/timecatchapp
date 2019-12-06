import Vue from 'vue';
import router from './router';
import App from './components/App';
import Multiselect from 'vue-multiselect';
import Gravatar from 'vue-gravatar';
import VuePluralize from 'vue-pluralize';

require('./bootstrap');

window.Vue = require('vue');

Vue.component('multiselect', Multiselect);

Vue.use(require('vue-moment'));

Vue.component('v-gravatar', Gravatar);

Vue.use(VuePluralize);

const app = new Vue({
    el: '#app',
    components: {
        App,
    },
    router
});