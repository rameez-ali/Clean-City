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
                                            Package Booking
                                        </h1>
                                    </div>
                                    <div class="right">
                                        <button
                                            @click="
                                                status = 'request';
                                                getQuotes();
                                            "
                                            class="button"
                                        >
                                            Quote Requests
                                        </button>
                                        <button
                                            @click="
                                                status = 'response';
                                                getQuotes();
                                            "
                                            class="button"
                                        >
                                            Quote Response
                                        </button>
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
                                <!-- Request Table -->
                                <table
                                    class="table table-striped table-bordered zero-configuration"
                                >
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr
                                            v-for="data in packageData"
                                            :key="data.id"
                                        >
                                            <td>{{ data.id }}</td>
                                            <td>
                                                {{ data.first_name }}
                                            </td>
                                            <td>{{ data.last_name }}</td>
                                            <td>{{ data.email }}</td>
                                            <td>{{ data.created_at }}</td>

                                            <td>{{ data.status }}</td>

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
                                                            :href="
                                                                '#/home/quoterequest/' +
                                                                    data.id +
                                                                    '/' +
                                                                    status
                                                            "
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

                                <!-- Response Table -->

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
            packageData: [{}],
            status: "request"
        };
    },
    mounted() {
        // this.getQuotes();
        this.datepicker();
        this.getQuotes();
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
            setTimeout(() => {
                if (
                    document.getElementById("select-date").value == "" ||
                    document.getElementById("select-date2").value == ""
                ) {
                } else {
                    console.log("event fired");
                    axios
                        .get("/api/admin/getpackagequoteToFrom", {
                            params: {
                                from: document.getElementById("select-date")
                                    .value,
                                to: document.getElementById("select-date2")
                                    .value,
                                status: this.status
                            }
                        })
                        .then(res => {
                            this.packageData = res.data.packages;
                        })
                        .catch(err => {
                            console.log(err.status);
                        });
                    //axios request according to date
                }
            }, 100);
        },
        getQuotes() {
            axios
                .get("/api/admin/getallpackagebookings", {
                    params: {
                        status: this.status
                    }
                })
                .then(res => {
                    //console.log(res.data.packages);
                    this.packageData = res.data.packages;
                })
                .catch(err => {
                    console.log(err.response);
                });
        }
    }
};
</script>

<style></style>
