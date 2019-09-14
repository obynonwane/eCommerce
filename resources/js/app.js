require('./bootstrap');

window.Vue = require('vue');
import { Form, HasError, AlertError } from 'vform' //import Vform for form validation


//import moment for date formating  
import moment from 'moment';

//---------------------------Sweet Alert -------------//
import swal from 'sweetalert2'
window.swal = swal 


const toast = swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000
})

window.toast = toast;
//-------------------------Close Sweet Alert ------------//


//----------Global Event Listening Object (i.e)For component Communication--------------//

  window.Fire = new Vue()

//---------CLose Global Event Listenig Object ----------//

//--------------Register Laravel Vue Pagination ---------//
Vue.component('pagination', require('laravel-vue-pagination'));

//-------------End Laravel Vue Pagination -------------//


//Register a global Component for V-form 
window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

import VueRouter from 'vue-router'          //import Vue Router
Vue.use(VueRouter)                          //Use Vue Router


//------------------------------ProgressBar ---------------//
import VueProgressBar from 'vue-progressbar'

Vue.use(VueProgressBar, {
  color: 'rgb(143, 255, 199)',
  failedColor: 'red',
  height: '10px'
})

//--------------------------------Close Progress Bar -----------//

 //Route Array and Corresponding Component 
let routes = [    
    { path: '/home', component: require('./components/DepositHistory.vue').default },                       
    { path: '/sent', component: require('./components/SentHistory.vue').default },
    { path: '/received', component: require('./components/ReceivedHistory.vue').default },
    { path: '/profile', component: require('./components/Profile.vue').default },
    { path: '/users', component: require('./components/Users.vue').default },
  ]
  //Register our Route 
  const router = new VueRouter({
    mode: 'history',
    routes // short for `routes: routes`
  })


    //text to capital letter global variable
    Vue.filter('upText', function(text){
        return text.charAt(0).toUpperCase() + text.slice(1)
      })
    
      //format date global variable
      Vue.filter('myDate', function(created){
        return moment(created).format('MMMM Do YYYY, h:mm:ss a');
      })

//--------------------------------------Start Passport Component---------------------------------------//
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

//--------------------------------------End Passport Component------------------------------------------//


// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default); //default Vue Component
Vue.component('deposit-component', require('./components/DepositHistory.vue').default); 

const app = new Vue({
    el: '#app',
    router,
    data:{
      search: '',
    },
    methods:{
      searchit(){
        Fire.$emit('searching'); //create a custom event ..You can listen to this cistome event any where in our application
      }
    }
});
