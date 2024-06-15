import { createRouter, createWebHashHistory } from "vue-router";
import Login from "../pages/login.vue";
import Dashboard from "../pages/dashboard.vue";
import Register from '../pages/register.vue'

const routes = [
	{
		path: "/",
		name: "login",
		component: Login
	},
	{
		path: "/dashboard",
		name: "dashboard",
		component: Dashboard,
	},
	{
		path: "/register",
		name: "register",
		component: Register,
	}

];
const router = createRouter({
	history: createWebHashHistory(),
	routes
  });

  export default router;