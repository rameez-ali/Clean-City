<template>
    <div>
        <topbar-component />
        <sidebar-component />
        <div class="app-content content view user wim-home">
            <div class="content-wrapper">
                <div class="content-body">
                    <!-- Basic form layout section start -->
                    <router-view />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import SidebarComponent from "../components/App/SidebarComponent.vue";
import TopbarComponent from "../components/App/TopbarComponent.vue";
export default {
    components: { SidebarComponent, TopbarComponent },
    mounted() {
        // Vue.prototype.$messaging.onMessage(payload => {
        //     console.log("Message received. ", payload);
        //     // ...
        // });
    },

    created() {}
};
</script>

<style></style>
