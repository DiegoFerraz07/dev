import './bootstrap';

import {createApp} from 'vue';
import { ZiggyVue } from 'ziggy-js';
import { Ziggy } from './ziggy';
import store from './store';
import routes from './routes/routes';
import App from "./app.vue";



//import Login from './pages/login.vue';
//import Dashboard from './pages/dashboard.vue';
//import Register from './pages/register.vue'


//App.component('login', Login);
//App.component('dashboard', Dashboard);
//App.component('register', Register);

App.use(ZiggyVue, Ziggy);
App.use(store);

createApp(App)
.use(routes)
.use(store)
.mount("#app");
