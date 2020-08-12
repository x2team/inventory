


let Login = require('./components/auth/Login.vue').default;
let Register = require('./components/auth/Register.vue').default;


export const routes = [
    { path: '/', component: Login , name: '/'},
    { path: '/register', component: Register, name: 'Register' }
  ]