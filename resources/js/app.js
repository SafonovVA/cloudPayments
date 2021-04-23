require('./bootstrap');

import Vue from 'vue';

Vue.component('side-bar', require('./components/SideBar.vue').default);

const app = new Vue({
    el: '#app',
});
