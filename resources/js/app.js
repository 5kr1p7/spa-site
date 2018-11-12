
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import 'babel-polyfill'
import Vue from 'vue';
import Vuetify from 'vuetify';
import VueRouter from 'vue-router';
//import VueResource  from 'vue-resource';

Vue.use(VueRouter)
Vue.use(Vuetify)
//Vue.use(VueResource)

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

const files = require.context('./', true, /\.vue$/i)

files.keys().map(key => {
     return Vue.component(_.last(key.split('/')).split('.')[0], files(key))
})

import LoginView from './views/LoginView'

const routes = [
    { path: '/login', name: 'login', component: LoginView },
    { path: '/', name: 'main', component: LoginView },

    { path: '*', redirect: '/' },
];

const router = new VueRouter({
  mode: 'history',
  routes: routes
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router
});

/*
Vue.http.interceptors.push(function (request, next) {
    request.headers['X-CSRF-TOKEN'] = Laravel.csrfToken;
    next();
});
*/