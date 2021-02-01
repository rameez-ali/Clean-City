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
                <li class="nav-item">
                    <a href="admin#/welcome/bid"
                        ><i class="fa fa-user" aria-hidden="true"></i
                        ><span class="menu-title" data-i18n="">Bids</span></a
                    >
                </li>
                <li class="nav-item">
                    <a href="admin#/home/user"
                        ><i class="fa fa-user" aria-hidden="true"></i
                        ><span class="menu-title" data-i18n=""
                            >User Management</span
                        ></a
                    >
                </li>

                <li class="nav-item">
                    <a href="#"
                        ><i class="fa fa-cog" aria-hidden="true"></i
                        ><span class="menu-title" data-i18n=""
                            >Settings</span
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
    }
};
</script>

<style></style>
