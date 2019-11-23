import Vue from 'vue';
import router from './router';
import App from './components/App';
import Multiselect from 'vue-multiselect'

require('./bootstrap');

window.Vue = require('vue');

Vue.component('multiselect',Multiselect)

const app = new Vue({
    el: '#app',
    components: {
        App,
    },
    router
});
