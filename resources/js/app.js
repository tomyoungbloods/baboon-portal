/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('admin-lte');

import Vue from 'vue';
import moment from 'moment'
import VueProgressBar from 'vue-progressbar'
import VueRouter from 'vue-router'
window.Vue = require('vue');
import Dashboard from './components/Dashboard';
import Profile from './components/Profile';
import Users from './components/Users';
import Developer from './components/Developer';
import Tasks from './components/tasks/Tasks';
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
        { path: '/verzoeken', component: Tasks },
        { path: '/alleverzoeken', component: AllTasks }
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

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router,
    data :{
      search: ''
    },
    methods:{
      searchit: _.debounce(() => {
        Fire.$emit('searching'); //Create a event called searching
      },1000)// Wait for 2sec
    }
});
