import Vue from 'vue';
import router from './router';
import App from './components/App';
import Multiselect from 'vue-multiselect';
import { Datetime } from 'vue-datetime';
import 'vue-datetime/dist/vue-datetime.css';
import Gravatar from 'vue-gravatar';
 

require('./bootstrap');

window.Vue = require('vue');

Vue.component('multiselect', Multiselect);

Vue.use(require('vue-moment'));

Vue.component('datetime', Datetime);

Vue.component('v-gravatar', Gravatar);

const app = new Vue({
    el: '#app',
    components: {
        App,
    },
    router
});