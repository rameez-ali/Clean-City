<template>
    <section id="configuration" class="search view-cause">
        <div class="row">
            <div class="col-12">
                <div class="card rounded pad-20">
                    <div class="card-content collapse show">
                        <div class="card-body table-responsive card-dashboard">
                            <div class="row">
                                <div
                                    class="col-12 d-block d-sm-flex justify-content-between"
                                >
                                    <div class="left">
                                        <h1 class="pull-left">
                                            Feedbacks
                                        </h1>
                                    </div>
                                    <div class="right">
                                        <a href="admin#/home/addpackage"
                                            ><i
                                                class="fa fa-ban"
                                                aria-hidden="true"
                                            ></i>
                                            Add Package</a
                                        >
                                    </div>
                                </div>
                            </div>
                            <div
                                class="row mt-2 filter-main justify-content-between"
                            >
                                <div class="col-12">
                                    <label>Sort By:</label>
                                </div>
                                <div
                                    class="col-lg-6 col-md-12 col-sm-12  form-group"
                                >
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <label for="">To:</label>
                                            <input
                                                v-model="datefrom"
                                                id="select-date"
                                                type="text"
                                                readonly=""
                                                @blur="changeDate"
                                            />
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <label for="">From:</label>
                                            <input
                                                v-model="dateto"
                                                id="select-date2"
                                                type="text"
                                                readonly=""
                                                @blur="changeDate"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row maain-tabble mt-2">
                                <table
                                    class="table table-striped table-bordered zero-configuration"
                                >
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th>Subject</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="a in feedbacks" :key="a.id">
                                            <td>{{ a.id }}</td>
                                            <td>{{ a.user.first_name }}</td>
                                            <td>{{ a.user.last_name }}</td>
                                            <td>{{ a.user.email }}</td>
                                            <td>{{ a.subject }}</td>

                                            <td>{{ a.created_at }}</td>

                                            <td>
                                                <div
                                                    class="btn-group mr-1 mb-1 show"
                                                >
                                                    <button
                                                        type="button"
                                                        class="btn  btn-drop-table btn-sm"
                                                        data-toggle="dropdown"
                                                        aria-haspopup="true"
                                                        aria-expanded="false"
                                                    >
                                                        <i
                                                            class="fa fa-ellipsis-v"
                                                        ></i>
                                                    </button>
                                                    <div
                                                        class="dropdown-menu"
                                                        x-placement="bottom-start"
                                                        style="position: absolute; transform: translate3d(4px, 23px, 0px); top: 0px; left: 0px; will-change: transform;"
                                                    >
                                                        <a
                                                            class="dropdown-item"
                                                            href="a-employee-profile.html"
                                                            ><i
                                                                class="fa fa-eye"
                                                            ></i
                                                            >View
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <!-- Modal -->

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
export default {
    data() {
        return {
            datefrom: "",
            dateto: "",
            feedbacks: {}
        };
    },
    mounted() {
        this.getAllFeedbacks();
        this.datepicker();
    },
    methods: {
        datepicker() {
            $("#select-date").datepicker({
                uiLibrary: "bootstrap4"
            });

            $("#select-date2").datepicker({
                uiLibrary: "bootstrap4"
            });
        },
        changeDate() {
            if (
                document.getElementById("select-date").value == "" ||
                document.getElementById("select-date2").value == ""
            ) {
            } else {
                //change date event goes here
            }
        },
        getAllFeedbacks() {
            axios
                .get("/api/admin/getallfeedbacks")
                .then(res => {
                    console.log(res.data.feedbacks);
                    this.feedbacks = res.data.feedbacks;
                })
                .catch(err => {
                    console.log(err.response);
                });
        }
    }
};
</script>

<style></style>
