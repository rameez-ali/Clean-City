<template>
    <section class="register loginn">
        <div class="container">
            <div class="login-main-inner">
                <div class="login-main">
                    <div class="row m-0">
                        <div class="col-md-6 col-sm-12 p-0">
                            <div class="login-img">
                                <img src="images/login-left-img-2.png" />
                                <img
                                    src="images/login-logo.png"
                                    class="login-logo"
                                />
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 p-0 login-right">
                            <div class="register-main">
                                <img
                                    src="images/logo.png"
                                    class="d-xl-none d-lg-none d-md-none d-sm-block"
                                />
                                <h1>Login</h1>
                                <h2>Login to your account</h2>
                                <div class="form-main">
                                    <!--fields start here-->
                                    <form action="">
                                        <div class="fields">
                                            <div class="row ">
                                                <div
                                                    class="col-md-12 form-group"
                                                >
                                                    <i
                                                        class="fa fa-envelope"
                                                    ></i
                                                    ><input
                                                        spellcheck="true"
                                                        type="text"
                                                        class="form-control"
                                                        placeholder="Enter Email Address"
                                                    />
                                                </div>
                                                <div
                                                    class="col-md-12 form-group"
                                                >
                                                    <i class="fa fa-lock"></i
                                                    ><input
                                                        spellcheck="true"
                                                        type="password"
                                                        class="form-control"
                                                        placeholder="Enter Password"
                                                    />
                                                </div>
                                            </div>
                                            <div class="row align-items-end">
                                                <div class="col-md-6 col-6">
                                                    <label class="check"
                                                        >Remember me
                                                        <input
                                                            spellcheck="true"
                                                            type="checkbox"
                                                        />
                                                        <span
                                                            class="checkmark"
                                                        ></span>
                                                    </label>
                                                </div>
                                                <div class="col-md-6 col-6">
                                                    <a
                                                        data-toggle="modal"
                                                        data-target="#exampleModalCenter"
                                                        >Forgot Password?</a
                                                    >
                                                </div>
                                            </div>
                                            <button
                                                type="button"
                                                class="form-control login-btn"
                                                onclick="window.open('a-dashboard.html')"
                                            >
                                                Login
                                                <i
                                                    class="fa fa-angle-right"
                                                    aria-hidden="true"
                                                ></i>
                                            </button>
                                            <div class="new-user">
                                                <a
                                                    href="login.html"
                                                    class="login back"
                                                    ><i
                                                        class="fa fa-long-arrow-left"
                                                    ></i
                                                    >back to home</a
                                                >
                                            </div>
                                            <!--fields end here-->
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="login-fail-main user forgot-pass">
            <div class="featured inner ">
                <forgot-password-email-component />
                <forgot-password-code-component />
                <new-password-component />
            </div>
        </div>
    </section>
</template>

<script>
import ForgotPasswordCodeComponent from "../components/Auth/ForgotPasswordCodeComponent.vue";
import ForgotPasswordEmailComponent from "../components/Auth/ForgotPasswordEmailComponent.vue";
import NewPasswordComponent from "../components/Auth/NewPasswordComponent.vue";
export default {
    components: {
        ForgotPasswordEmailComponent,
        ForgotPasswordCodeComponent,
        NewPasswordComponent
    },
    data() {
        return {
            login_details: {
                email: "",
                password: ""
            }
        };
    },

    mounted() {
        $("#cont").on("click", function() {
            $("#exampleModalCenter").modal("hide");
            $("#exampleModal").modal("show");
        });
        $("#cont2").on("click", function() {
            $("#exampleModal").modal("hide");
            $("#exampleModal2").modal("show");
        });
        $("#cont3").on("click", function() {
            $("#exampleModalCenter2").modal("hide");
            $("#exampleModal3").modal("show");
        });
    },
    methods: {}
};
</script>

<style></style>
