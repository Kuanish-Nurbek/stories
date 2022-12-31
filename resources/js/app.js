/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import bootstrap from 'bootstrap/dist/js/bootstrap' // подключаем bootrstrap
import { createApp } from 'vue';
import { createStore } from 'vuex'
import store from './store.js';
import axios from 'axios';
// axios.defaults.xsrfHeaderName = "X-CSRFTOKEN";
// axios.defaults.xsrfCookieName = "csrftoken";
// axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
// window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// let token = document.head.querySelector('meta[name="csrf-token"]');

// if (token) {
//     axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
// } else {
//     console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
// }




/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */
// Create a new store instance.


const app = createApp({});

import ExampleComponent from './components/ExampleComponent.vue';
import Users from './components/Users.vue';
import AccountComponent from './components/AccountComponent.vue';
import Post from './components/Post.vue';
import UserName from './components/UserName.vue';
import UserTest from './components/UserTest.vue';
import AllHistory from './components/AllHistoryComponent.vue';

app.component('example-component', ExampleComponent);
app.component('component-users', Users);
app.component('account-component', AccountComponent);
app.component('post-component', Post);
app.component('user-name-component', UserName);
app.component('user-test-component', UserTest);
app.component('all-history-component', AllHistory);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */
app.use(store);
app.use(bootstrap);

app.mount('#app');
