require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router'          //import Vue Router
Vue.use(VueRouter)                          //Use Vue Router

 //Route Array and Corresponding Component 
let routes = [                           
    { path: '/dashboard', component: require('./components/Dashboard.vue').default },
    { path: '/profile', component: require('./components/Profile.vue').default },
    { path: '/users', component: require('./components/Users.vue').default },
  ]
  //Register our Route 
  const router = new VueRouter({
    mode: 'history',
    routes // short for `routes: routes`
  })

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default); //default Vue Component

const app = new Vue({
    el: '#app',
    router
});
