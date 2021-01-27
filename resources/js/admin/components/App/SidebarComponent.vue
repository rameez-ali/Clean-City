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
                    <a href="admin#/welcome/Memberships"
                        ><i class="fa fa-user" aria-hidden="true"></i
                        ><span class="menu-title" data-i18n=""
                            >Memberships</span
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
                    <ul class="menu-content">
                        <li>
                            <a
                                class="menu-item"
                                href="admin#/welcome/generalSettings"
                                ><i
                                    class="fa fa-th-large"
                                    aria-hidden="true"
                                ></i
                                >General</a
                            >
                        </li>
                        <li>
                            <a
                                class="menu-item"
                                href="admin#/welcome/SliderSettings"
                                ><i
                                    class="fa fa-th-large"
                                    aria-hidden="true"
                                ></i
                                >Slider</a
                            >
                        </li>
                    </ul>
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
