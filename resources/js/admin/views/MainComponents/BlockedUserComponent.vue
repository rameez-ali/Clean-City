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
                                        <h1 class="pull-left">Blocked Users</h1>
                                    </div>
                                    <div class="right">
                                        <a href="admin#/home/user"
                                            ><i
                                                class="fa fa-ban"
                                                aria-hidden="true"
                                            ></i>
                                            Users</a
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
                                <table-component
                                    :tHead="thead"
                                    :tRows="users"
                                    :actions="actions"
                                />
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
import TableComponent from "../../components/App/TableComponent.vue";

export default {
    data() {
        return {
            datefrom: "",
            dateto: "",
            users: [],
            thead: [
                "id",
                "First Name",
                "Last Name",
                "Email",
                "Registration Date",
                "Actions"
            ],
            actions: [
                {
                    class: "fa fa-eye",
                    href: "#/home/viewuser/",
                    text: "View"
                },
                {
                    class: "fa fa-ban",
                    href: "#",
                    text: "Block"
                },
                {
                    class: "fa fa-ticket",
                    href: "#",
                    text: "Edit"
                }
            ]
        };
    },
    beforeCreate() {},
    created() {
        this.getUsers();
    },

    components: {
        TableComponent
    },
    mounted() {
        setTimeout(() => {
            $(document).ready(() => {
                $(".dataTables_filter input").attr("placeholder", "Search");
            });
        }, 2000);

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
                console.log("event fired");
                axios
                    .get("/api/admin/getalluserstofrom", {
                        params: {
                            from: document.getElementById("select-date").value,
                            to: document.getElementById("select-date2").value
                        }
                    })
                    .then(res => {
                        this.users = res.data.users;
                    })
                    .catch(err => {
                        console.log(err.status);
                    });
                //axios request according to date
            }
        },

        getUsers() {
            axios
                .get("/api/admin/getallusers", {
                    params: {
                        blocked: true
                    }
                })
                .then(res => {
                    //console.log(res.data.users);
                    this.users = res.data.users;
                })
                .catch(err => {});
        }
    }
};
</script>

<style></style>
