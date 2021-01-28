import Vue from "vue";
import VueRouter from "vue-router";
import LoginComponent from "./views/LoginComponent";
import MainComponent from "./views/MainComponent";
import ProfileComponent from "./views/MainComponents/ProfileComponent";
import UserComponent from "./views/MainComponents/UserComponent";

Vue.use(VueRouter);

const routes = [
    {
        path: "/",
        component: LoginComponent
    },
    {
        path: "/home",
        component: MainComponent,
        children: [
            {
                path: "profile",
                component: ProfileComponent
            },
            {
                path: "user",
                component: UserComponent
            }
        ],
        beforeEnter: (to, from, next) => {
            axios
                .get("api/admin/verify")
                .then(res => {
                    next();
                })
                .catch(err => next("/"));
        }
    }
];

const router = new VueRouter({ routes });

router.beforeEach((to, from, next) => {
    const token = localStorage.getItem("token") || null;
    window.axios.defaults.headers.common["Authorization"] = "Bearer " + token;
    next();
});

export default router;
