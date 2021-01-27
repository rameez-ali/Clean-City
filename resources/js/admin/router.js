import Vue from "vue";
import VueRouter from "vue-router";
import LoginComponent from "./views/LoginComponent";
import MainComponent from "./views/MainComponent";

Vue.use(VueRouter);

const routes = [
    {
        path: "/",
        component: LoginComponent
    },
    {
        path: "/home",
        component: MainComponent
    }
];

const router = new VueRouter({ routes });

router.beforeEach((to, from, next) => {
    const token = localStorage.getItem("token") || null;
    window.axios.defaults.headers.common["Authorization"] = "Bearer " + token;
    next();
});

export default router;
