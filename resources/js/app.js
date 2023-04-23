import './bootstrap';

import Swal from 'sweetalert2/dist/sweetalert2.js'
import 'sweetalert2/dist/sweetalert2.css'

window.Swal = Swal;
const toast = Swal.mixin({
    toast:true,
    position:'top-end',
    showConfirmButton:false,
    timer: 5000
});

window.toast = toast;

import { createApp } from 'vue';

 import app from './components/app.vue'// create app.vue under components folder which is default vue page
 
 import router from './router/index.js' // to access the routes defined in index js which exported as router

 createApp(app).use(router).mount("#app")// app is an id which given for default laravel blade and then we use it here