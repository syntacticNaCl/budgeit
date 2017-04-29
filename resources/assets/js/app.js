
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import BootstrapVue from 'bootstrap-vue';
import ClickConfirm from 'click-confirm/src/ClickConfirm.vue';
import Draggable from 'vuedraggable';


Vue.use(BootstrapVue);
Vue.component('clickConfirm', ClickConfirm);
Vue.component('Draggable', Draggable);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('budget', require('./components/Budget.vue'));

const app = new Vue({
    el: '#app'
});

