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
                                        <h1 class="pull-left">{{ heading }}</h1>
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="row"></div>
                                        <div
                                            v-for="data in packageData"
                                            :key="data.id"
                                            class="col-xl-4 col-lg-4 col-md-6 col-sm-6 form-group"
                                        >
                                            <label for="">{{
                                                data.first_name
                                            }}</label>
                                        </div>
                                    </div>
                                    <div>
                                        <input v-model="quote" />
                                        <button
                                            class="button"
                                            @click="generateQuote"
                                        >
                                            Generate Quote
                                        </button>
                                    </div>
                                    <button class="button" @click="rejectQuote">
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
            heading: "",
            id: "",
            packageData: "",
            reason: "Demo reason",
            quote: "",
            date: "01/01/2022",
            time: "11:00 PM"
        };
    },
    watch: {
        $route(to, from) {
            this.getpackageData();
        }
    },
    mounted() {
        this.getpackageData();
        this.checkroute();
    },
    methods: {
        getpackageData() {
            this.id = this.$route.params.id;
            axios
                .get("/api/admin/getpackagequote", {
                    params: {
                        id: this.id
                    }
                })
                .then(res => {
                    console.log(res.data.package);
                    this.packageData = res.data.package;
                })
                .catch(err => {
                    // console.log(err.response);
                    this.$router.push("/home/packagebookings");
                });
        },
        checkroute() {
            var status = this.$route.params.status;
            if (status == "request") {
                this.heading = "Quote Request";
            } else {
                this.heading = "Quote Response";
            }
        },
        generateQuote() {
            axios
                .post("/api/admin/generateQuote", {
                    id: this.id,
                    quote: this.quote,
                    date: this.date,
                    time: this.time
                })
                .then(res => {
                    alert(res.data.status);
                })
                .catch(err => {
                    console.log(err.response);
                });
        },
        rejectQuote() {
            axios
                .post("/api/admin/rejectQuote", {
                    id: this.id,
                    reason: this.reason
                })
                .then(res => {
                    alert(res.data.status);
                })
                .catch(err => {
                    console.log(err.response);
                });
        }
    }
};
</script>

<style></style>
