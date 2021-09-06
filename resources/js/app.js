require('./bootstrap');

window.Vue = require('vue').default;

import Vue from 'vue';
import VueRouter from 'vue-router'
Vue.use(VueRouter)

let routes =[
    { path: '/data-user',component: require('./components/Pengguna/Data-pengguna.vue').default},
    { path: '/data-barang',component: require('./components/Pengguna/Data-barang.vue').default}
]

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const router = new VueRouter({
    routes
})


const app = new Vue({
    el: '#app',
    router
});
