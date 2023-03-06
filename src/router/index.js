import { createRouter, createWebHashHistory } from 'vue-router'

import Home from "../views/Home.vue"

const routes = [
	{
		path: "/",
		name: "Home",
		component: Home,
	},
	{
		path: "/About",
		name: "About",
		component: () => import( "../views/About.vue"),
	},
	{
		path: "/SignIn",
		name: "Sign In",
		component: () => import("../views/SignIn.vue"),
	},
	{
		path: "/Register",
		name: "Register",
		component: () => import("../views/Register.vue"),
	},
	{
		path: "/Account",
		name: "Account",
		component: () => import("../views/Account.vue"),
	},
]

const router = createRouter({
	history: createWebHashHistory(),
	routes,
})

export default router
