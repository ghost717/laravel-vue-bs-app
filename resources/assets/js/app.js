window.Vue = require('vue');
import VueRouter from 'vue-router'
import { routes } from './routes';
import excel from 'vue-excel-export'
import { Form, HasError, AlertError } from 'vform'

Vue.use(VueRouter)
Vue.use(excel)

require('./bootstrap');
require('./progressbar');

window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

const router = new VueRouter({
    routes,
    mode: 'hash',
})

const app = new Vue({
    el: '#app',
    router
});
