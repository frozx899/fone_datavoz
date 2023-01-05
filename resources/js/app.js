import './bootstrap';
import { createApp } from 'vue';
import router from './router.js';
import App from './components/App.vue';

import Swal from 'sweetalert2';

import 'vue-good-table-next/dist/vue-good-table-next.css';
import  VueGoodTable  from 'vue-good-table-next';



const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })
window.Swal = Swal;
window.Toast = Toast;


const app = createApp({});
app.use(router);
app.use(VueGoodTable);


app.mount("#app");




