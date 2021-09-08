require('./bootstrap');

window.Vue = require('vue').default;

// src/plugins/vuetify.js



const opts = {}

// export default new Vuetify(opts)

let Fire = new Vue();
window.Fire = Fire;


//Import Alert
// import { Toast } from 'bootstrap';
import Swal from 'sweetalert2'
window.Swal = Swal;
const Toast = Swal.mixin({
    toast: true,
    position:'top-end',
    showConfirmButton: false,
    timer: 3000
});
window.Toast = Toast;

//Progresss Bar
import VueProgressBar from 'vue-progressbar'
Vue.use(VueProgressBar,{
    color: 'rgb(143,255,199)',
    failedColor: 'red',
    height: '5px'
})

import Vue from 'vue';

// import Vuetify from 'vuetify/lib'
// Vue.use(Vuetify)
// const opts = {}
// export default new Vuetify(opts)

import VueRouter from 'vue-router';
import { reduce } from 'lodash';
Vue.use(VueRouter)

// import { Form, HasError, AlertError } from 'vform'
// window.Form = Form;
// Vue.component(HasError.name, HasError);
// Vue.component(AlertError.name, AlertError);


let routes =[
    { path: '/data-user',component: require('./components/Pengguna/Data-pengguna.vue').default},
    { path: '/data-barang',component: require('./components/Pengguna/Data-barang.vue').default},
    { path: '/data-departemen',component: require('./components/Pengguna/Data-departemen.vue').default},
    { path: '/data-karyawan',component: require('./components/Pengguna/Data-karyawan.vue').default},
    { path: '/data-permintaan',component: require('./components/Pengguna/Data-permintaan.vue').default},
    { path: '/data-po',component: require('./components/Pengguna/Data-PO.vue').default}
]

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const router = new VueRouter({
    routes
})

const app = new Vue({
    el: '#app',
    router
});
