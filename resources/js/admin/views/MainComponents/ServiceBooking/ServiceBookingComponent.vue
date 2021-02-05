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
                                            Service Bookings
                                        </h1>
                                    </div>
                                    <div class="right"></div>
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
                                <div
                                    id="DataTables_Table_0_wrapper"
                                    class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer"
                                >
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div
                                                class="dataTables_length"
                                                id="DataTables_Table_0_length"
                                            ></div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div
                                                id="DataTables_Table_0_filter"
                                                class="dataTables_filter"
                                            >
                                                <label
                                                    >Search:<input
                                                        v-model="searchText"
                                                        spellcheck="true"
                                                        type="search"
                                                        class="form-control form-control-sm"
                                                        placeholder="Search"
                                                        aria-controls="DataTables_Table_0"
                                                        @input="
                                                            getServiceRequests
                                                        "
                                                /></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
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
                                                        v-for="data in serviceBookings"
                                                        :key="data.id"
                                                    >
                                                        <td>{{ data.id }}</td>
                                                        <td>
                                                            {{
                                                                data.first_name
                                                            }}
                                                        </td>
                                                        <td>
                                                            {{ data.last_name }}
                                                        </td>
                                                        <td>
                                                            {{ data.email }}
                                                        </td>
                                                        <td>
                                                            {{
                                                                data.created_at
                                                            }}
                                                        </td>

                                                        <td>
                                                            {{ data.status }}
                                                        </td>

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
                                                                            '#/home/viewservicebookings/' +
                                                                                data.id
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
                                        </div>
                                    </div>
                                </div>

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
            searchText: "",
            datefrom: "",
            dateto: "",
            serviceBookings: []
        };
    },
    created() {},
    mounted() {
        this.getServiceRequests();
        this.datepicker();
    },
    methods: {
        getServiceRequests() {
            axios
                .get("/api/admin/getallServiceRequests", {
                    params: {
                        search: this.searchText
                    }
                })
                .then(res => {
                    this.serviceBookings = res.data.services;
                    //console.dir(res.data.services);
                })
                .catch(err => {
                    console.log(err.response);
                });
        },
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
                        .get("/api/admin/ServiceRequeststofrom", {
                            params: {
                                from: document.getElementById("select-date")
                                    .value,
                                to: document.getElementById("select-date2")
                                    .value
                            }
                        })
                        .then(res => {
                            this.serviceBookings = res.data.services;
                        })
                        .catch(err => {
                            console.log(err.status);
                        });
                    //axios request according to date
                }
            }, 100);
        }
    }
};
</script>

<style></style>
