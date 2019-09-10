require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router' //import Vue Router
Vue.use(VueRouter)//Use Vue Router

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default); //default Vue Component

const app = new Vue({
    el: '#app',
});
