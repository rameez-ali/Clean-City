<template>
    <section
        id="configuration"
        class="search view-cause profile lawyer-profile-main"
    >
        <div class="row">
            <div class="col-12">
                <div class="add-user">
                    <div class="card rounded pad-20">
                        <div class="card-content collapse show">
                            <div
                                class="card-body table-responsive card-dashboard"
                            >
                                <div class="row title">
                                    <div class="col-12">
                                        <h1 class="pull-left">Add Service</h1>
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <form action="">
                                            <div class="row">
                                                <div
                                                    class="col-xl-4 col-lg-4 col-md-6 col-sm-6 form-group"
                                                >
                                                    <label for="">Image</label>
                                                    <button
                                                        name="file"
                                                        class="camera-btn"
                                                        onclick="document.getElementById('file').click()"
                                                    >
                                                        <i
                                                            class="fa fa-camera"
                                                        ></i>
                                                    </button>
                                                    <input
                                                        type="file"
                                                        id="file"
                                                        ref="file"
                                                        name="file"
                                                        hidden
                                                    />
                                                </div>
                                                <div
                                                    class="col-xl-4 col-lg-4 col-md-6 col-sm-6 form-group"
                                                >
                                                    <label for="">Name</label>
                                                    <input
                                                        v-model="name"
                                                        type="text"
                                                        name=""
                                                        placeholder="Mark"
                                                        id=""
                                                        class="form-control"
                                                    />
                                                </div>
                                                <div
                                                    class="col-xl-4 col-lg-4 col-md-6 col-sm-6 form-group"
                                                >
                                                    <label for=""
                                                        >Validity Hours</label
                                                    >
                                                    <input
                                                        v-model="validity"
                                                        type="number"
                                                        name=""
                                                        id=""
                                                        class="form-control"
                                                    />
                                                </div>

                                                <div
                                                    class="col-xl-4 col-lg-4 col-md-6 col-sm-6 form-group"
                                                >
                                                    <label for=""
                                                        >Description</label
                                                    >
                                                    <input
                                                        v-model="description"
                                                        type="text"
                                                        name=""
                                                        placeholder="Abc"
                                                        id=""
                                                        class="form-control"
                                                    />
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="row edit-btn">
                                    <div class="col-12">
                                        <a @click="addService">
                                            Add Membership
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    data() {
        return {
            name: "",
            description: "",
            validity: "",
            file: ""
        };
    },

    methods: {
        addService() {
            this.file = this.$refs.file.files[0];
            let formData = new FormData();

            formData.append("photo", this.file);
            formData.append("name", this.name);
            formData.append("description", this.description);
            formData.append("validity", this.validity);

            axios
                .post(
                    "api/admin/addservice",

                    formData,

                    {
                        headers: {
                            "Content-Type": "multipart/form-data"
                        }
                    }
                )
                .then(res => {
                    //console.log("SUCCESS!!");
                    console.log(res.data.status);
                    this.$router.push("/home/services");
                    //localStorage.setItem("photo", res.data.user.photo);
                    //this.photo_url = localStorage.getItem("photo");
                })
                .catch(err => {
                    console.log(err.response);
                });
        }
    }
};
</script>

<style></style>
