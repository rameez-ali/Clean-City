import Vue from "vue";
import VueRouter from "vue-router";
import LoginComponent from "./views/LoginComponent";
import MainComponent from "./views/MainComponent";
import ProfileComponent from "./views/MainComponents/ProfileComponent";
import UserComponent from "./views/MainComponents/UserComponent";
import BlockedUserComponent from "./views/MainComponents/BlockedUserComponent";
import ViewUserComponent from "./views/MainComponents/ViewUserComponent";
import ServiceComponent from "./views/MainComponents/Service/ServiceComponent";
import AddServiceComponent from "./views/MainComponents/Service/AddServiceComponent";
import ViewServiceComponent from "./views/MainComponents/Service/ViewServiceComponent";
import EditServiceComponent from "./views/MainComponents/Service/EditServiceComponent";
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
            },
            {
                path: "viewuser/:id",
                component: ViewUserComponent
            },
            {
                path: "blockeduser",
                component: BlockedUserComponent
            },
            {
                path: "services",
                component: ServiceComponent
            },
            {
                path: "addservice",
                component: AddServiceComponent
            },
            {
                path: "viewservice/:id",
                component: ViewServiceComponent
            },
            {
                path: "editservice/:id",
                component: EditServiceComponent
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
