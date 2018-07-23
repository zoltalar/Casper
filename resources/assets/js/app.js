/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

window.$ = window.jQuery = require('jquery');
window.Popper = require('popper.js').default;
window.Vue = require('vue');

require('bootstrap');
require('bootstrap-daterangepicker');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('alert', require('./components/alert'));
Vue.component('auto-complete', require('./components/auto-complete'));
Vue.component('date-range', require('./components/date-range'));

const app = new Vue({
    el: '#app',
    data: {
        'event': {
            allDay: false
        }
    },
    methods: {
        logout(event) {
            event.preventDefault();
            this.$refs.formLogout.submit();
        }
    }
});