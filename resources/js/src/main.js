 require('./../bootstrap');
 import Vue from 'vue';
 window.Vue = Vue;

 import App from './App.vue';
 import store from './store';
 import vuetify from './plugins/vuetify';
 import router from './router';
 import './plugins';

 Vue.config.productionTip = false;

 const app = new Vue({
     el: '#app',
     router,
     store,
     vuetify,
     render: h => h(App),
 });
