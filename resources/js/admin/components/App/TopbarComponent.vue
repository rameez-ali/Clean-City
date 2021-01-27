<template>
    <nav
        class="header-navbar navbar-expand-md navbar navbar-with-menu fixed-top navbar-light navbar-border"
    >
        <div class="navbar-wrapper">
            <div class="navbar-header">
                <ul class="nav navbar-nav flex-row">
                    <li class="nav-item mobile-menu d-md-none mr-auto">
                        <a
                            class="nav-link nav-menu-main menu-toggle hidden-xs"
                            href="#"
                            ><i class="ft-menu font-large-1"></i
                        ></a>
                    </li>
                    <li class="nav-item">
                        <a class="navbar-brand" href="admin#/welcome/"> </a>
                    </li>
                    <li class="nav-item d-md-none">
                        <a
                            class="nav-link open-navbar-container"
                            data-toggle="collapse"
                            data-target="#navbar-mobile"
                            ><i class="fa fa-ellipsis-v"></i
                        ></a>
                    </li>
                </ul>
            </div>
            <div class="navbar-container content">
                <div class="collapse navbar-collapse" id="navbar-mobile">
                    <ul class="nav navbar-nav mr-auto float-left"></ul>
                    <ul class="nav navbar-nav float-right">
                        <li
                            class="dropdown dropdown-notification nav-item"
                            v-bind:class="{ show: Notification }"
                        >
                            <a
                                class="nav-link nav-link-label"
                                href="#"
                                data-toggle="dropdown"
                                @click="NotificationChange"
                                ><i class="fa fa-bell" aria-hidden="true"></i
                            ></a>
                            <ul
                                class="dropdown-menu dropdown-menu-media dropdown-menu-right"
                                v-bind:class="{ show: Notification }"
                            >
                                <!-- <li class="dropdown-menu-header">
                  <h6 class="dropdown-header m-0"> <span class="grey darken-2">Notifications</span> <span class="notification-tag badge badge-default badge-danger float-right m-0">5 New</span>
                  </h6>
                </li> -->
                                <li
                                    class="scrollable-container media-list ps-container ps-theme-dark ps-active-y"
                                    data-ps-id="cbae8718-1b84-97ac-6bfa-47d792d8ad89"
                                >
                                    <a href="javascript:void(0)">
                                        <div class="media">
                                            <div class="media-body">
                                                <p
                                                    class="notification-text font-small-3 text-muted"
                                                >
                                                    Lorem ipsum dolor sit amet,
                                                    consectetuer elit.
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="javascript:void(0)">
                                        <div class="media">
                                            <div class="media-body">
                                                <p
                                                    class="notification-text font-small-3 text-muted"
                                                >
                                                    Aliquam tincidunt mauris eu
                                                    risus.
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="javascript:void(0)">
                                        <div class="media">
                                            <div class="media-body">
                                                <p
                                                    class="notification-text font-small-3 text-muted"
                                                >
                                                    Vestibulum auctor dapibus
                                                    neque.
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="dropdown-menu-footer">
                                    <a
                                        class="dropdown-item text-muted text-center"
                                        href="a-all-notifications.html"
                                        >View All</a
                                    >
                                </li>
                            </ul>
                        </li>
                        <li
                            class="dropdown dropdown-user nav-item"
                            v-bind:class="{ show: NavbarMenu }"
                        >
                            <a
                                class="dropdown-toggle nav-link dropdown-user-link"
                                href="#"
                                data-toggle="dropdown"
                                aria-expanded="true"
                                @click="NavbarMenuChange"
                            >
                                <span class="avatar avatar-online">
                                    <img
                                        src="images/student-pro-girl.png"
                                        alt="avatar"
                                /></span>
                                <span class="user-name">John Doe</span>
                            </a>
                            <div
                                class="dropdown-menu dropdown-menu-right profile-drp-down "
                                v-bind:class="{ show: NavbarMenu }"
                            >
                                <!-- <h3>Account</h3> -->
                                <ul class="">
                                    <li>
                                        <a href="a-profile.html"
                                            ><i
                                                class="fa fa-user"
                                                aria-hidden="true"
                                            ></i
                                            >Profile</a
                                        >
                                    </li>
                                    <li>
                                        <a href="a-my-calendar.html"
                                            ><i
                                                class="fa fa-calendar"
                                                aria-hidden="true"
                                            ></i
                                            >Calendar</a
                                        >
                                    </li>
                                    <li>
                                        <a href="a-feedback.html"
                                            ><i
                                                class="fa fa-phone"
                                                aria-hidden="true"
                                            ></i
                                            >Feedback</a
                                        >
                                    </li>
                                    <li>
                                        <a href="login.html"
                                            ><i
                                                class="fa fa-power-off"
                                                aria-hidden="true"
                                            ></i
                                            >Logout</a
                                        >
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item d-none d-md-block">
                            <a
                                class="nav-link nav-menu-main menu-toggle hidden-xs"
                                href="#"
                                ><i class="ft-menu"></i
                            ></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</template>

<script>
export default {
    data() {
        return {
            NavbarMenu: false,
            Notification: false
        };
    },
    methods: {
        NavbarMenuChange() {
            this.NavbarMenu = !this.NavbarMenu;
        },
        NotificationChange() {
            this.Notification = !this.Notification;
        }
    }
};
</script>

<style></style>
