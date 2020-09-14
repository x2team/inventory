

let Test = require('./components/Test.vue').default;

let Login = require('./components/auth/Login.vue').default;
let Register = require('./components/auth/Register.vue').default;
let Forget = require('./components/auth/Forget.vue').default;
let Logout = require('./components/auth/Logout.vue').default;


// End Authentication
let Home = require('./components/Home.vue').default;
// Employee Component
let StoreEmployee = require('./components/employee/Create.vue').default;
let Employee = require('./components/employee/Index.vue').default;
let EditEmployee = require('./components/employee/Edit.vue').default;
// Supplier Component
let StoreSupplier = require('./components/supplier/Create.vue').default;
let Supplier = require('./components/supplier/Index.vue').default;
let EditSupplier = require('./components/supplier/Edit.vue').default;
// Category Component
let StoreCategory = require('./components/category/Create.vue').default;
let Category = require('./components/category/Index.vue').default;
let EditCategory = require('./components/category/Edit.vue').default;
// Product Component
let StoreProduct = require('./components/product/Create.vue').default;
let Product = require('./components/product/Index.vue').default;
let EditProduct = require('./components/product/Edit.vue').default;
// Expense Component
let StoreExpense = require('./components/expense/Create.vue').default;
let Expense = require('./components/expense/Expense.vue').default;
let EditExpense = require('./components/expense/Edit.vue').default;
// Salary Component
let GivenSalary = require('./components/salary/All_Employee.vue').default;
let PaySalary = require('./components/salary/Create.vue').default;
let AllSalary = require('./components/salary/Index.vue').default;
let ViewSalary = require('./components/salary/View.vue').default;
let EditSalary = require('./components/salary/Edit.vue').default;

// Stock Component
let Stock = require('./components/product/Stock.vue').default;






export const routes = [
    { path: '/test', component: Test, name: 'Test' },

    { path: '/', component: Login, name: '/' },
    { path: '/register', component: Register, name: 'Register' },
    { path: '/forget', component: Forget, name: 'Forget' },
    { path: '/logout', component: Logout, name: 'Logout' },
    { path: '/home', component: Home, name: 'Home' },
    // Employee Router
    { path: '/store-employee', component: StoreEmployee, name: 'StoreEmployee' },
    { path: '/employee', component: Employee, name: 'Employee' },
    { path: '/edit-employee/:id', component: EditEmployee, name: 'EditEmployee' },
    // Supplier Router
    { path: '/store-supplier', component: StoreSupplier, name: 'StoreSupplier' },
    { path: '/supplier', component: Supplier, name: 'Supplier' },
    { path: '/edit-supplier/:id', component: EditSupplier, name: 'EditSupplier' },
    // Category Router
    { path: '/store-category', component: StoreCategory, name: 'StoreCategory' },
    { path: '/category', component: Category, name: 'Category' },
    { path: '/edit-category/:id', component: EditCategory, name: 'EditCategory' },
    // Product Router
    { path: '/store-product', component: StoreProduct, name: 'StoreProduct' },
    { path: '/product', component: Product, name: 'Product' },
    { path: '/edit-product/:id', component: EditProduct, name: 'EditProduct' },
    // Expense Router
    { path: '/store-expense', component: StoreExpense, name: 'StoreExpense' },
    { path: '/expense', component: Expense, name: 'Expense' },
    { path: '/edit-expense/:id', component: EditExpense, name: 'EditExpense' },
    // Salary Router
    { path: '/given-salary', component: GivenSalary, name: 'GivenSalary' },
    { path: '/pay-salary/:id', component: PaySalary, name: 'PaySalary' },
    { path: '/salary', component: AllSalary, name: 'AllSalary' },
    { path: '/view-salary/:id', component: ViewSalary, name: 'ViewSalary' },
    { path: '/edit-salary/:id', component: EditSalary, name: 'EditSalary' },

    // Stock Router
    { path: '/stock', component: Stock, name: 'Stock' },
    
    

    
  ]


