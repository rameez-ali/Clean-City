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
                                        <h1 class="pull-left">Feedback</h1>
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="row"></div>
                                        <div
                                            class="col-xl-4 col-lg-4 col-md-6 col-sm-6 form-group"
                                        >
                                            <label for=""
                                                >Name:
                                                {{
                                                    feedback[0].user.first_name
                                                }}</label
                                            >
                                        </div>
                                        <div
                                            class="col-xl-4 col-lg-4 col-md-6 col-sm-6 form-group"
                                        >
                                            <label for=""
                                                >Subject:
                                                {{ feedback[0].subject }}</label
                                            >
                                        </div>
                                        <div
                                            class="col-xl-4 col-lg-4 col-md-6 col-sm-6 form-group"
                                        >
                                            <label for=""
                                                >Message:
                                                {{ feedback[0].message }}</label
                                            >
                                        </div>
                                    </div>
                                </div>

                                <button class="button" @click="deleteFeedback">
                                    Delete
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
    </section>
</template>

<script>
export default {
    data() {
        return {
            id: "",
            feedback: [
                {
                    user: [
                        {
                            first_name: ""
                        }
                    ]
                }
            ]
        };
    },

    mounted() {
        this.getfeedback();
    },
    methods: {
        getfeedback() {
            this.id = this.$route.params.id;
            axios
                .get("/api/admin/getfeedback", {
                    params: {
                        id: this.id
                    }
                })
                .then(res => {
                    console.log(res.data.feedback);
                    this.feedback = res.data.feedback;
                });
        },

        deleteFeedback() {
            axios
                .post("/api/admin/deletefeedback", {
                    id: this.id
                })
                .then(res => {
                    console.log(res.data.status);
                    //this.feedback = res.data.feedback;
                });
        }
    }
};
</script>

<style></style>
