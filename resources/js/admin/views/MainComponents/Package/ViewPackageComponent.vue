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
                                        <h1 class="pull-left">Package</h1>
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="row"></div>
                                        <div
                                            class="col-xl-4 col-lg-4 col-md-6 col-sm-6 form-group"
                                        >
                                            <label for="">Name</label>
                                            <input
                                                v-model="packageData.name"
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
                                            <label for="">Id</label>
                                            <input
                                                v-model="packageData.id"
                                                type="number"
                                                name=""
                                                id=""
                                                class="form-control"
                                            />
                                        </div>
                                        <div
                                            class="col-xl-4 col-lg-4 col-md-6 col-sm-6 form-group"
                                        >
                                            <label for="">Price</label>
                                            <input
                                                v-model="packageData.price"
                                                type="number"
                                                name=""
                                                id=""
                                                class="form-control"
                                            />
                                        </div>

                                        <div
                                            class="col-xl-4 col-lg-4 col-md-6 col-sm-6 form-group"
                                        >
                                            <label for="">Description</label>
                                            <input
                                                v-model="
                                                    packageData.description
                                                "
                                                type="text"
                                                name=""
                                                placeholder="Abc"
                                                id=""
                                                class="form-control"
                                            />
                                        </div>
                                        <div
                                            class="col-xl-4 col-lg-4 col-md-6 col-sm-6 form-group"
                                        >
                                            <label for="">Recurrent Type</label>
                                            <input
                                                v-model="packageData.recurrency"
                                                type="text"
                                                name=""
                                                placeholder="Abc"
                                                id=""
                                                class="form-control"
                                            />
                                        </div>

                                        <div
                                            class="col-xl-4 col-lg-4 col-md-6 col-sm-6 form-group"
                                        >
                                            <label for="">Date created</label>
                                            <input
                                                v-model="packageData.created_at"
                                                type="text"
                                                name=""
                                                placeholder="Abc"
                                                id=""
                                                class="form-control"
                                            />
                                        </div>
                                    </div>
                                    <div
                                        class="col-xl-4 col-lg-4 col-md-6 col-sm-6 form-group"
                                    >
                                        <label for="">Status</label>
                                        <input
                                            v-model="packageData.status"
                                            type="text"
                                            name=""
                                            placeholder="Abc"
                                            id=""
                                            class="form-control"
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="row edit-btn">
                                <div class="col-12"></div>
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
            id: "",
            packageData: []
        };
    },
    mounted() {
        this.getPackageData();
    },

    watch: {
        $route(to, from) {
            this.getPackageData();
        }
    },

    methods: {
        getPackageData() {
            this.id = this.$route.params.id;
            axios
                .get("/api/admin/package", {
                    params: {
                        id: this.id
                    }
                })
                .then(res => {
                    this.packageData = res.data.package;
                    //console.log(res.data.package);

                    if (this.packageData == null) {
                        this.$router.push("/home/package");
                    }
                })
                .catch(err => {
                    console.log(err.response);
                    this.$router.push("/home/package");
                });
        }
    }
};
</script>

<style></style>
