import { createRouter, createWebHistory } from "vue-router";
import login from "../pages/login.vue";
import dashboard from "../pages/dashboard.vue";
const routes = [
	{
		path: "/",
		name: "login",
		component: login
	},
	{
		path: "/dashboard",
		name: "dashboard",
		component: dashboard,
	}

];

export default createRouter({
	history: createWebHistory(),
	routes,
})