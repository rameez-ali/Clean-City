import Vue from "vue";
import VueRouter from "vue-router";
import LoginComponent from "./views/LoginComponent";
import MainComponent from "./views/MainComponent";
import ProfileComponent from "./views/MainComponents/ProfileComponent";
import UserComponent from "./views/MainComponents/UserComponent";
import BlockedUserComponent from "./views/MainComponents/BlockedUserComponent";
import ViewUserComponent from "./views/MainComponents/ViewUserComponent";
//services
import ServiceComponent from "./views/MainComponents/Service/ServiceComponent";
import AddServiceComponent from "./views/MainComponents/Service/AddServiceComponent";
import ViewServiceComponent from "./views/MainComponents/Service/ViewServiceComponent";
import EditServiceComponent from "./views/MainComponents/Service/EditServiceComponent";
//packages
import PackageComponent from "./views/MainComponents/Package/PackageComponent";
import AddPackageComponent from "./views/MainComponents/Package/AddPackageComponent";
import ViewPackageComponent from "./views/MainComponents/Package/ViewPackageComponent";
import EditPackageComponent from "./views/MainComponents/Package/EditPackageComponent";
import PackageRequestComponent from "./views/MainComponents/PackageRequest/PackageRequestComponent";

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
            //service
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
            },
            //package
            {
                path: "package",
                component: PackageComponent
            },
            {
                path: "addpackage",
                component: AddPackageComponent
            },
            {
                path: "viewpackage/:id",
                component: ViewPackageComponent
            },
            {
                path: "editpackage/:id",
                component: EditPackageComponent
            },
            //Package Request
            {
                path: "packageRequests",
                component: PackageRequestComponent
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
