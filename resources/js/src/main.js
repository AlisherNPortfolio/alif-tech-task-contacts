 require('./../bootstrap');
 import Vue from 'vue';
 window.Vue = Vue;

 import App from './App.vue';
 import VueRouter from 'vue-router';
 import { routes } from './routes';
 import './plugins';
 import vuetify from './plugins/vuetify';



 Vue.use(VueRouter);

 const router = new VueRouter({
     mode: 'history',
     routes: routes
 });

 const app = new Vue({
     el: '#app',
     router: router,
     vuetify,
     render: h => h(App),
 });
