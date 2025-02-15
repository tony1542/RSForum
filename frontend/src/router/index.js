import Vue from "vue";
import VueRouter from "vue-router";
import Home from "../views/Home.vue";

Vue.use(VueRouter);

const routes = [
    {
        path: "/",
        name: "Home",
        component: Home,
    },
    {
        path: "/About",
        name: "About",
        component: () => import(/* webpackChunkName: "about" */ "../views/About.vue"),
    },
    {
        path: "/SignIn",
        name: "Sign In",
        component: () => import(/* webpackChunkName: "signin" */ "../views/SignIn.vue"),
    },
    {
        path: "/Register",
        name: "Register",
        component: () => import(/* webpackChunkName: "register" */ "../views/Register.vue"),
    },
    {
        path: "/Account",
        name: "Account",
        component: () => import(/* webpackChunkName: "account" */ "../views/Account.vue"),
    },
];

const router = new VueRouter({
    mode: "history",
    routes,
});

export default router;
