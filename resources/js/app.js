/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('admin-lte');

import Vue from 'vue';
import moment from 'moment'
import vuetify from '../../src/vuetify/plugins'
import VueProgressBar from 'vue-progressbar'
import VueRouter from 'vue-router'
import * as firebase from "firebase";
window.Vue = require('vue');
import Dashboard from './components/Dashboard';
import Profile from './components/Profile';
import Users from './components/Users';
import Developer from './components/Developer';
import MyTasks from './components/tasks/MyTasks';
import AllTasks from './components/tasks/AllTasks';


import Gate from "./Gate";
Vue.prototype.$gate = new Gate(window.user); 



import { Form, HasError, AlertError } from 'vform'

window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

import swal from 'sweetalert2'
window.swal = swal;

// Toast Modal Pop Up 

const toast = swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: (toast) => {
      toast.addEventListener('mouseenter', swal.stopTimer)
      toast.addEventListener('mouseleave', swal.resumeTimer)
    }
  })

  window.toast = toast;

// Progress Bar

const options = {
    color: '#D6E74D',
    failedColor: '#874b4b',
    thickness: '6px',
    transition: {
      speed: '0.2s',
      opacity: '0.6s',
      termination: 300
    },
    autoRevert: true,
    location: 'top',
    inverse: false
  }
  
  Vue.use(VueProgressBar, options)




Vue.use(VueRouter)

const router = new VueRouter({
    mode: 'history',
    routes : [
        { path: '/dashboard', component: Dashboard },
        { path: '/profile', component: Profile },
        { path: '/users', component: Users },
        { path: '/developer', component: Developer },
        { path: '/mijnverzoeken', component: MyTasks },
        { path: '/alleverzoeken', component: AllTasks },
    ]
  })
  
// Vue Filters Start here

  Vue.filter('upText', function(text){
        return text.charAt(0).toUpperCase() + text.slice(1);
  });

  Vue.filter('myDate', function(created){
        return moment(created).format("MMM Do YYYY"); 
  });

// Create Custom Event

window.Fire = new Vue();

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

Vue.component(
  'passport-clients',
  require('./components/passport/Clients.vue').default
);

Vue.component(
  'passport-authorized-clients',
  require('./components/passport/AuthorizedClients.vue').default
);

Vue.component(
  'passport-personal-access-tokens',
  require('./components/passport/PersonalAccessTokens.vue').default
);

Vue.component(
  'not-found',
  require('./components/NotFound.vue').default
);

var config = {
    apiKey: "AIzaSyBtLvHr2gYFVMdad8JmtUeLUATc1TV4qFI",
    authDomain: "portal-baboon.firebaseapp.com",
    databaseURL: "https://portal-baboon.firebaseio.com",
    projectId: "portal-baboon",
    storageBucket: "portal-baboon.appspot.com",
    messagingSenderId: "172957971468",
    appId: "1:172957971468:web:34c41d3f1c771b1b8faa29",
    measurementId: "G-8QVGKVYDKZ"
}; // 4. Get Firebase Configuration
firebase.initializeApp(config);

const messaging = firebase.messaging();

messaging.usePublicVapidKey("BDPgYQqbP7s-D_sCDINZQA0p5HHxmv7YyOOca9CpaRaZlZgfcSsQcmXnuRTCa7bwCHnxBqTWF2qkidFfaX0DrRc"); // 1. Generate a new key pair

// Request Permission of Notifications
messaging.requestPermission().then(() => {
  console.log('Notification permission granted.');

  // Get Token
  messaging.getToken().then((token) => {
    console.log(token) 
  })
}).catch((err) => {
  console.log('Unable to get permission to notify.', err);
});

messaging.usePublicVapidKey("xxxxxxx"); // 1. Generate a new key pair

// Request Permission of Notifications
messaging.requestPermission().then(() => {
  console.log('Notification permission granted.');

  // Get Token
  messaging.getToken().then((token) => {
    console.log(token)
  })
}).catch((err) => {
  console.log('Unable to get permission to notify.', err);
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    vuetify,
    router,
    data :{
      search: ''
    },
    mode: {
      mode: 'production'
    },
    methods:{
      searchit: _.debounce(() => {
        Fire.$emit('searching'); //Create a event called searching
      },1000)// Wait for 2sec
    }
});

