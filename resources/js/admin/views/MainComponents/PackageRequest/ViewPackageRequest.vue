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
                                        <h1 class="pull-left">
                                            Package Request
                                        </h1>
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="row"></div>
                                        <div
                                            class="col-xl-4 col-lg-4 col-md-6 col-sm-6 form-group"
                                        >
                                            <label for="">{{
                                                packageData[0].user.first_name
                                            }}</label>
                                        </div>
                                        <div
                                            class="col-xl-4 col-lg-4 col-md-6 col-sm-6 form-group"
                                        >
                                            <label for="">{{
                                                packageData[0].user.last_name
                                            }}</label>
                                        </div>
                                        <div
                                            class="col-xl-4 col-lg-4 col-md-6 col-sm-6 form-group"
                                        >
                                            <label for="">{{
                                                packageData[0].user.email
                                            }}</label>
                                        </div>
                                        <div
                                            class="col-xl-4 col-lg-4 col-md-6 col-sm-6 form-group"
                                        >
                                            <label for="">{{
                                                packageData[0].user.phone
                                            }}</label>
                                        </div>
                                        <div
                                            class="col-xl-4 col-lg-4 col-md-6 col-sm-6 form-group"
                                        >
                                            <label for="">{{
                                                packageData[0].user.address
                                            }}</label>
                                        </div>
                                        <div
                                            class="col-xl-4 col-lg-4 col-md-6 col-sm-6 form-group"
                                        >
                                            <label for="">{{
                                                packageData[0].created_at
                                            }}</label>
                                        </div>
                                        <div
                                            class="col-xl-4 col-lg-4 col-md-6 col-sm-6 form-group"
                                        >
                                            <label for="">{{
                                                packageData[0].selected_date
                                            }}</label>
                                        </div>
                                        <div
                                            class="col-xl-4 col-lg-4 col-md-6 col-sm-6 form-group"
                                        >
                                            <label for="">{{
                                                packageData[0].time_required
                                            }}</label>
                                        </div>
                                        <div
                                            class="col-xl-4 col-lg-4 col-md-6 col-sm-6 form-group"
                                        >
                                            <label for="">{{
                                                packageData[0].time_slot
                                            }}</label>
                                        </div>
                                        <div
                                            class="col-xl-4 col-lg-4 col-md-6 col-sm-6 form-group"
                                        >
                                            <label for="">{{
                                                packageData[0].payment_status
                                            }}</label>
                                        </div>
                                        <div
                                            class="col-xl-4 col-lg-4 col-md-6 col-sm-6 form-group"
                                        >
                                            <label for="">{{
                                                packageData[0].recurrency
                                            }}</label>
                                        </div>
                                    </div>
                                    <button
                                        v-if="packageData[0].status == 'reject'"
                                        @click="approveRejectRequest('approve')"
                                        class="button"
                                    >
                                        Approve
                                    </button>
                                    <button
                                        v-if="packageData[0].status != 'reject'"
                                        @click="approveRejectRequest('reject')"
                                        class="button"
                                    >
                                        Reject
                                    </button>
                                </div>
                                <div class="row edit-btn">
                                    <div class="col-12"></div>
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
            id: "",
            packageData: [
                {
                    user: "",
                    package: ""
                }
            ]
        };
    },

    created() {
        this.getPackageData();
    },
    mounted() {},
    methods: {
        getPackageData() {
            this.id = this.$route.params.id;
            axios
                .get("/api/admin/PackageRequests", {
                    params: {
                        id: this.id
                    }
                })
                .then(res => {
                    this.packageData = res.data.package;
                    //console.log(res.data.package);

                    if (this.packageData == null) {
                        this.$router.push("/home/packageRequests");
                    }
                })
                .catch(err => {
                    console.log(err.response);
                    this.$router.push("/home/packageRequests");
                });
        },

        approveRejectRequest(type) {
            axios
                .post("/api/admin/approveRejectPackage/", {
                    id: this.id,
                    status: type
                })
                .then(res => {
                    if (res.data.status) {
                        alert(res.data.status);
                        this.$router.push("/home/packageRequests");
                    }
                })
                .catch(err => {
                    console.log(err.response);
                });
        }
    }
};
</script>

<style></style>
