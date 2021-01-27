<template>
    <div
        class="modal fade"
        id="exampleModalCenter"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="forget-pass">
                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                    >
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="payment-main-popup">
                        <form action="">
                            <div class="payment-modal-main">
                                <div class="payment-modal-inner">
                                    <div class="row">
                                        <div class="col-12">
                                            <img src="images/pass-logo.png" />
                                            <h1>Password Recovery</h1>
                                        </div>
                                        <div class="col-12 form-group">
                                            <i
                                                class="fa fa-envelope"
                                                aria-hidden="true"
                                            ></i>

                                            <input
                                                v-model="email"
                                                type="text"
                                                class="form-control"
                                                spellcheck="true"
                                                placeholder="Enter Email Address"
                                            />
                                        </div>
                                        <div
                                            class="col-12 form-group text-center"
                                        >
                                            <button
                                                @click="ResetPasswordEmail"
                                                type="button"
                                                class="can"
                                                data-dismiss="modal"
                                                id="cont"
                                            >
                                                Continue
                                            </button>
                                        </div>
                                        <div class="col-12 form-group">
                                            <a
                                                href="login.html"
                                                class="login back"
                                                ><i
                                                    class="fa fa-long-arrow-left"
                                                ></i
                                                >back to login</a
                                            >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { ValidationProvider } from "vee-validate";

export default {
    components: {
        ValidationProvider
    },
    data() {
        return {
            email: ""
        };
    },

    methods: {
        ResetPasswordEmail() {
            axios
                .post("api/password/email", this.email)
                .then(res => {
                    console.log(res);
                })
                .catch(err => {
                    console.log(err.response);
                });
        }
    }
};
</script>

<style></style>
