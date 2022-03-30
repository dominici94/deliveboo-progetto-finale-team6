window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.Vue = require('vue');


import App from './App.vue'

import router from "./router";

export const bus = new Vue();
const app = new Vue({
    el: '#app',
    render: h => h(App),
    router
});

// if(JSON.parse(localStorage.getItem("theme")) == "dark"){
//     document.getElementById('corpo').classList.remove('light');
//     document.getElementById('corpo').classList.add('dark');
//     document.getElementById('nava').classList.remove('navbar-light');
//     document.getElementById('nava').classList.add('navbar-dark');
// }
// else{
//     document.getElementById('corpo').classList.remove('dark');
//     document.getElementById('corpo').classList.add('light');
//     document.getElementById('nava').classList.remove('navbar-dark');
//     document.getElementById('nava').classList.add('navbar-light');
// }

// const corpo = document.getElementById('corpo');
// const theme_switch = document.getElementById('theme');
// const navaa = document.getElementById('nava');

// theme_switch.addEventListener('click', function () {
//     if (theme_switch.checked) {
//         corpo.classList.remove('light');
//         corpo.classList.add('dark');
//         navaa.classList.remove('navbar-light');
//         navaa.classList.add('navbar-dark');
//         const parsed = JSON.stringify('dark');
//         localStorage.setItem("theme", parsed);
//     }
//     else {
//         corpo.classList.remove('dark');
//         corpo.classList.add('light');
//         navaa.classList.remove('navbar-dark');
//         navaa.classList.add('navbar-light');
//         const parsed = JSON.stringify('light');
//         localStorage.setItem("theme", parsed);
//     }
// });


