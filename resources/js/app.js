import './bootstrap';

import {createApp} from 'vue';
import { ZiggyVue } from 'ziggy-js';
import { Ziggy } from './ziggy';
import store from './store';
import router from './routes/routes';
import App from "./app.vue";


createApp(App)
	.use(router)
	.use(store)
	.use(ZiggyVue, Ziggy)
	.mount("#app");
