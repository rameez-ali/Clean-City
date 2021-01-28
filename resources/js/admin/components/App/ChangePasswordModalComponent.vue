<template>
    <div class="login-fail-main user">
        <div class="featured inner">
            <div
                class="modal fade bd-example-modal-lg"
                id="exampleModalCenter"
                tabindex="-1"
                role="dialog"
                aria-labelledby="exampleModalCenterTitle"
                aria-hidden="true"
            >
                <div class="modal-dialog modal-lgg conf">
                    <div class="modal-content">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button
                                    type="button"
                                    class="close"
                                    data-dismiss="modal"
                                    aria-label="Close"
                                >
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="">
                                <div class="payment-modal-main">
                                    <div class="payment-modal-inner">
                                        <div class="row">
                                            <div class="col-12">
                                                <h1 class="text-center">
                                                    Change Password
                                                </h1>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div
                                                class="col-md-8 offset-md-2 form-group"
                                            >
                                                <form action="">
                                                    <div class="row">
                                                        <div
                                                            class="col-12 form-group"
                                                        >
                                                            <label for=""
                                                                >Current
                                                                Password</label
                                                            >
                                                            <input
                                                                v-model="
                                                                    current_password
                                                                "
                                                                type="password"
                                                                placeholder="Current Password"
                                                                class="form-control"
                                                            />
                                                        </div>
                                                        <div
                                                            class="col-12 form-group"
                                                        >
                                                            <label for=""
                                                                >New
                                                                Password</label
                                                            >
                                                            <input
                                                                v-model="
                                                                    new_password
                                                                "
                                                                type="password"
                                                                placeholder="New Password"
                                                                class="form-control"
                                                            />
                                                        </div>
                                                        <div
                                                            class="col-12 form-group pass-change"
                                                        >
                                                            <label for=""
                                                                >Re-type
                                                                Password</label
                                                            >
                                                            <input
                                                                v-model="
                                                                    retype_password
                                                                "
                                                                type="password"
                                                                placeholder="Re-type Password"
                                                                class="form-control"
                                                            />
                                                        </div>
                                                        <div
                                                            class="col-12 form-group"
                                                        >
                                                            <a
                                                                @click="
                                                                    changePassword
                                                                "
                                                                href="#"
                                                                data-dismiss="modal"
                                                                >Update</a
                                                            >
                                                        </div>
                                                    </div>
                                                </form>
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
        <!--user profile end here-->
    </div>
</template>

<script>
export default {
    data() {
        return {
            current_password: "",
            new_password: "",
            retype_password: ""
        };
    },
    methods: {
        changePassword() {
            if (this.new_password == this.retype_password) {
                axios
                    .post("/api/admin/changepassword", {
                        current_password: this.current_password,
                        new_password: this.new_password,
                        retype_password: this.retype_password
                    })
                    .then(res => {
                        console.log(res.data.status);
                    })
                    .catch(err => {
                        console.dir(err.response);
                    });
            }
        }
    }
};
</script>

<style></style>
