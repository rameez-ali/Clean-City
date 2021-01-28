<template>
    <section id="configuration" class="search view-cause">
        <div class="row">
            <div
                class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2 col-md-10 offset-md-1 col-12"
            >
                <div class="add-user">
                    <div class="card rounded pad-20">
                        <div class="card-content collapse show">
                            <div
                                class="card-body table-responsive card-dashboard"
                            >
                                <div class="row profile-top">
                                    <div
                                        class="col-12 d-flex justify-content-between"
                                    >
                                        <h1 class="pull-left">Profile</h1>
                                        <a
                                            href="#"
                                            data-toggle="modal"
                                            data-target="#exampleModalCenter"
                                            >Change Password</a
                                        >
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="attached">
                                            <img
                                                :src="user.image"
                                                class="img-full"
                                                alt="Profile goes here"
                                            />
                                            <button
                                                name="file"
                                                class="camera-btn"
                                                onclick="document.getElementById('file').click()"
                                            >
                                                <i class="fa fa-camera"></i>
                                            </button>
                                            <input
                                                type="file"
                                                id="file"
                                                ref="file"
                                                name="file"
                                                @change="handleFileUpload()"
                                                hidden
                                            />
                                            <h2>
                                                {{
                                                    user.first_name +
                                                        " " +
                                                        user.last_name
                                                }}
                                            </h2>
                                            <p>{{ user.email }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <form action="">
                                            <div class="row">
                                                <div class="col-12 form-group">
                                                    <label for=""
                                                        >Full Name</label
                                                    >
                                                    <input
                                                        v-model="
                                                            user.first_name
                                                        "
                                                        type="text"
                                                        placeholder="Alex John"
                                                        class="form-control"
                                                    />
                                                </div>
                                                <div class="col-12 form-group">
                                                    <label for="">Email</label>
                                                    <input
                                                        v-model="user.email"
                                                        type="email"
                                                        placeholder="alex123@testmail.com"
                                                        class="form-control"
                                                        disabled
                                                    />
                                                </div>
                                                <div class="col-12 form-group">
                                                    <label for="">Phone</label>
                                                    <input
                                                        v-model="user.phone"
                                                        placeholder="123 456 789"
                                                        class="form-control"
                                                    />
                                                </div>
                                                <div class="col-12 form-group">
                                                    <label for=""
                                                        >Address</label
                                                    >
                                                    <input
                                                        v-model="user.address"
                                                        type="text"
                                                        placeholder="Abc"
                                                        class="form-control"
                                                    />
                                                </div>

                                                <div class="col-12 form-group">
                                                    <a @click="editUser"
                                                        >Update Profile</a
                                                    >
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- Modal -->
                                <change-password-modal-component />

                                <!--modal end here-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import ChangePasswordModalComponent from "../../components/App/ChangePasswordModalComponent.vue";
export default {
    components: { ChangePasswordModalComponent },
    data() {
        return {
            file: "",
            photo_url: "",
            user: "",
            edit: false
        };
    },
    created() {
        this.userData();
    },
    mounted() {},
    methods: {
        userData() {
            axios
                .get("/api/admin/userdata")
                .then(res => {
                    this.user = res.data.user;
                })
                .catch(err => {});
        },

        editUser() {
            axios
                .post("/api/admin/editUser", {
                    first_name: this.user.first_name,
                    phone: this.user.phone,
                    address: this.user.address
                })
                .then(res => {
                    console.log(res.data.status);
                })
                .catch(err => {
                    console.dir(errr.data);
                });
        },
        handleFileUpload() {
            this.file = this.$refs.file.files[0];
            let formData = new FormData();

            formData.append("photo", this.file);
            formData.append("user", localStorage.getItem("id"));

            axios
                .post("api/admin/profilephoto", formData, {
                    headers: {
                        "Content-Type": "multipart/form-data"
                    }
                })
                .then(res => {
                    //console.log("SUCCESS!!");
                    console.log(res.data.status);
                    //localStorage.setItem("photo", res.data.user.photo);
                    //this.photo_url = localStorage.getItem("photo");
                })
                .catch(err => {
                    console.log(err.status);
                });
        }
    }
};
</script>

<style></style>
