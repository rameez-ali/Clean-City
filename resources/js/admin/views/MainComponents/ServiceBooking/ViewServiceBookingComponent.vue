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
                                            Service Booking
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
                                                serviceBooking[0].first_name
                                            }}</label>
                                        </div>
                                        <div
                                            class="col-xl-4 col-lg-4 col-md-6 col-sm-6 form-group"
                                        >
                                            <label for="">{{
                                                serviceBooking[0].last_name
                                            }}</label>
                                        </div>
                                        <div
                                            class="col-xl-4 col-lg-4 col-md-6 col-sm-6 form-group"
                                        >
                                            <label for="">{{
                                                serviceBooking[0].email
                                            }}</label>
                                        </div>
                                        <div
                                            class="col-xl-4 col-lg-4 col-md-6 col-sm-6 form-group"
                                        >
                                            <label for="">{{
                                                serviceBooking[0].phone
                                            }}</label>
                                        </div>
                                        <div
                                            class="col-xl-4 col-lg-4 col-md-6 col-sm-6 form-group"
                                        >
                                            <label for="">{{
                                                serviceBooking[0].address
                                            }}</label>
                                        </div>
                                        <div
                                            class="col-xl-4 col-lg-4 col-md-6 col-sm-6 form-group"
                                        >
                                            <label for="">{{
                                                serviceBooking[0].created_at
                                            }}</label>
                                        </div>
                                        <div
                                            class="col-xl-4 col-lg-4 col-md-6 col-sm-6 form-group"
                                        >
                                            <label for="">{{
                                                serviceBooking[0].selected_date
                                            }}</label>
                                        </div>
                                        <div
                                            class="col-xl-4 col-lg-4 col-md-6 col-sm-6 form-group"
                                        >
                                            <label for="">{{
                                                serviceBooking[0].time_required
                                            }}</label>
                                        </div>
                                        <div
                                            class="col-xl-4 col-lg-4 col-md-6 col-sm-6 form-group"
                                        >
                                            <label for="">{{
                                                serviceBooking[0].time_slot
                                            }}</label>
                                        </div>
                                        <div
                                            class="col-xl-4 col-lg-4 col-md-6 col-sm-6 form-group"
                                        >
                                            <label for="">{{
                                                serviceBooking[0].status
                                            }}</label>
                                        </div>
                                    </div>
                                    <button
                                        @click="approveRejectRequest('approve')"
                                        class="button"
                                    >
                                        Approve
                                    </button>
                                    <button
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
            quote: "50",
            reason: "Test denied",
            serviceBooking: [{}]
        };
    },
    mounted() {
        this.getServiceData();
    },
    methods: {
        getServiceData() {
            this.id = this.$route.params.id;
            axios
                .get("/api/admin/ServiceRequests", {
                    params: {
                        id: this.id
                    }
                })
                .then(res => {
                    this.serviceBooking = res.data.servicebooking;
                    //console.log(res.data.servicebooking);

                    if (this.serviceBooking == null) {
                        this.$router.push("/home/servicebookings");
                    }
                })
                .catch(err => {
                    console.log(err.response);
                    this.$router.push("/home/servicebookings");
                });
        },
        approveRejectRequest(type) {
            axios
                .post("/api/admin/approveRejectService", {
                    id: this.id,
                    status: type,
                    quote: this.quote,
                    reason: this.reason
                })
                .then(res => {
                    if (res.data.status) {
                        alert(res.data.status);
                        this.$router.push("/home/servicebookings");
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
