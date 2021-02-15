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
                                            Services
                                        </h1>
                                    </div>
                                    <div class="right">
                                        <a href="admin#/home/addservice"
                                            ><i
                                                class="fa fa-ban"
                                                aria-hidden="true"
                                            ></i>
                                            Add Service</a
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
                                                        @input="getServices"
                                                /></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table-component
                                                :tHead="thead"
                                                :tRows="services"
                                                :actions="actions"
                                            />
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
import TableComponent from "../../../components/App/TableComponent.vue";

export default {
    components: { TableComponent },
    data() {
        return {
            searchText: "",
            datefrom: "",
            dateto: "",
            services: [],
            thead: [
                "Service id",
                "Service Name",
                "Date Added",
                "Status",
                "Actions"
            ],
            actions: [
                {
                    class: "fa fa-eye",
                    href: "#/home/viewservice/",
                    text: "View"
                },
                {
                    class: "fa fa-ban",
                    href: "#",
                    text: "Active/Inactive"
                },
                {
                    class: "fa fa-ticket",
                    href: "#/home/editservice/",
                    text: "Edit"
                }
            ]
        };
    },
    created() {
        this.getServices();
    },
    mounted() {
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
            setTimeout(() => {
                if (
                    document.getElementById("select-date").value == "" ||
                    document.getElementById("select-date2").value == ""
                ) {
                } else {
                    console.log("event fired");
                    axios
                        .get("/api/admin/servicetofrom", {
                            params: {
                                from: document.getElementById("select-date")
                                    .value,
                                to: document.getElementById("select-date2")
                                    .value
                            }
                        })
                        .then(res => {
                            this.services = res.data.services;
                        })
                        .catch(err => {
                            console.log(err.status);
                        });
                    //axios request according to date
                }
            }, 100);
        },

        getServices() {
            axios
                .get("/api/admin/getallservices", {
                    params: {
                        search: this.searchText
                    }
                })
                .then(res => {
                    //console.log(res.data.users);
                    this.services = res.data.services;
                })
                .catch(err => {});
        }
    }
};
</script>

<style></style>
