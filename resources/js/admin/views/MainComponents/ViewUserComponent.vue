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
                                        <h1 class="pull-left">User Profile</h1>
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-lg-6 col-md-8">
                                        <div class="media align-items-center">
                                            <div class="attached mr-2">
                                                <img
                                                    src="images/student-pro-girl.png"
                                                    class="img-full"
                                                    alt=""
                                                />
                                            </div>

                                            <div class="attached-details">
                                                <h2>{{ user.first_name }}</h2>
                                                <p>{{ user.email }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-4">
                                        <div class="right text-right"></div>
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <form action="">
                                            <div class="row">
                                                <label>
                                                    {{ user.first_name }}</label
                                                >---
                                                <label>
                                                    {{ user.last_name }}</label
                                                >---
                                                <label>
                                                    {{ user.address }}</label
                                                >---
                                                <label> {{ user.phone }}</label
                                                >---
                                                <label> {{ user.email }}</label
                                                >---
                                                <label>
                                                    {{ user.created_at }}</label
                                                >---
                                                <label> {{ user.status }}</label
                                                >---
                                            </div>
                                        </form>

                                        <button @click="blockUser">
                                            Block user
                                        </button>
                                        <button @click="unblockUser">
                                            unblock user
                                        </button>
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
            id: "",
            user: ""
        };
    },
    watch: {
        $route(to, from) {
            this.getUserData();
        }
    },
    mounted() {
        //this.id = this.$route.params.id;
        this.getUserData();
    },
    methods: {
        getUserData() {
            this.id = this.$route.params.id;
            axios
                .get("/api/admin/user", {
                    params: {
                        id: this.id
                    }
                })
                .then(res => {
                    this.user = res.data.user;
                    if (this.user == null) {
                        this.$router.push("/home/user");
                    }
                    console.log(this.user);
                })
                .catch(err => {
                    console.log(err.response);
                    this.$router.push("/home/user");
                });
        },
        blockUser() {
            axios
                .post("api/admin/blockuser", {
                    id: this.id,
                    status: "block"
                })
                .then(res => {
                    console.log(res.data.status);
                })
                .catch(err => {
                    console.log(err.response);
                });
        },
        unblockUser() {
            axios
                .post("api/admin/blockuser", {
                    id: this.id,
                    status: "active"
                })
                .then(res => {
                    console.log(res.data.status);
                })
                .catch(err => {
                    console.log(err.response);
                });
        }
    }
};
</script>

<style></style>
