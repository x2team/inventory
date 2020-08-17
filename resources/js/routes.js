


let Login = require('./components/auth/Login.vue').default;
let Register = require('./components/auth/Register.vue').default;
let Forget = require('./components/auth/Forget.vue').default;
let Logout = require('./components/auth/Logout.vue').default;


// End Authentication
let Home = require('./components/Home.vue').default;
// Employee Component
let StoreEmployee = require('./components/employee/Create.vue').default;
let Employee = require('./components/employee/Index.vue').default;




export const routes = [
    { path: '/', component: Login, name: '/' },
    { path: '/register', component: Register, name: 'Register' },
    { path: '/forget', component: Forget, name: 'Forget' },
    { path: '/logout', component: Logout, name: 'Logout' },
    { path: '/home', component: Home, name: 'Home' },

    { path: '/store-employee', component: StoreEmployee, name: 'StoreEmployee' },
    { path: '/employee', component: Employee, name: 'Employee' },
  ]


