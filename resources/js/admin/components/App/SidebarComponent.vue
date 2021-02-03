<template>
    <div
        class="main-menu menu-fixed menu-light menu-accordion"
        data-scroll-to-active="true"
    >
        <div class="main-menu-content">
            <ul
                class="navigation navigation-main"
                id="main-menu-navigation"
                data-menu="menu-navigation"
            >
                <li
                    class="nav-item"
                    :class="{
                        active: this.$route.path == '/home/user'
                    }"
                >
                    <a href="admin#/home/user"
                        ><i class="fa fa-user" aria-hidden="true"></i
                        ><span class="menu-title" data-i18n=""
                            >User Management</span
                        ></a
                    >
                </li>

                <li
                    class="nav-item"
                    :class="{
                        active: this.$route.path == '/home/services'
                    }"
                >
                    <a href="admin#/home/services"
                        ><i class="fa fa-cog" aria-hidden="true"></i
                        ><span class="menu-title" data-i18n=""
                            >Services</span
                        ></a
                    >
                </li>
                <li
                    class="nav-item"
                    :class="{
                        active: this.$route.path == '/home/servicebookings'
                    }"
                >
                    <a href="admin#/home/servicebookings"
                        ><i class="fa fa-cog" aria-hidden="true"></i
                        ><span class="menu-title" data-i18n=""
                            >Service Bookings</span
                        ></a
                    >
                </li>

                <li
                    class="nav-item"
                    :class="{
                        active: this.$route.path == '/home/package'
                    }"
                >
                    <a href="admin#/home/package"
                        ><i class="fa fa-cog" aria-hidden="true"></i
                        ><span class="menu-title" data-i18n=""
                            >Packages</span
                        ></a
                    >
                </li>

                <li
                    class="nav-item"
                    :class="{
                        active: this.$route.path == '/home/packageRequests  '
                    }"
                >
                    <a href="admin#/home/packageRequests"
                        ><i class="fa fa-cog" aria-hidden="true"></i
                        ><span class="menu-title" data-i18n=""
                            >Package Requests</span
                        ></a
                    >
                </li>
                <li
                    class="nav-item"
                    :class="{
                        active: this.$route.path == '/home/packagebookings'
                    }"
                >
                    <a href="admin#/home/packagebookings"
                        ><i class="fa fa-cog" aria-hidden="true"></i
                        ><span class="menu-title" data-i18n=""
                            >Package Bookings</span
                        ></a
                    >
                </li>

                <li
                    class="nav-item"
                    :class="{
                        active: this.$route.path == '/home/feedbacks'
                    }"
                >
                    <a href="admin#/home/feedbacks"
                        ><i class="fa fa-cog" aria-hidden="true"></i
                        ><span class="menu-title" data-i18n=""
                            >Feedbacks</span
                        ></a
                    >
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {};
    },
    mounted() {
        console.log(this.$route);
    },
    methods: {
        changeclass() {
            //if(this.$route.path=="/home/feedbacks")
        }
    }
};
</script>

<style></style>
