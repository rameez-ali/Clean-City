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
                                        <h1 class="pull-left">Users</h1>
                                    </div>
                                    <div class="right">
                                        <a href="admin#/home/blockeduser"
                                            ><i
                                                class="fa fa-ban"
                                                aria-hidden="true"
                                            ></i>
                                            Blocked Users</a
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
                                <div class="login-fail-main user">
                                    <div class="featured inner">
                                        <div
                                            class="modal fade bd-example-modal-lg"
                                            id="exampleModalCenter"
                                            tabindex="-1"
                                            role="dialog"
                                            aria-labelledby="exampleModalCenterTitle"
                                            aria-hidden="true"
                                        >
                                            <div
                                                class="modal-dialog modal-lgg conf"
                                            >
                                                <div class="modal-content">
                                                    <div class="modal-content">
                                                        <div
                                                            class="modal-header"
                                                        >
                                                            <button
                                                                type="button"
                                                                class="close"
                                                                data-dismiss="modal"
                                                                aria-label="Close"
                                                            >
                                                                <span
                                                                    aria-hidden="true"
                                                                    >&times;</span
                                                                >
                                                            </button>
                                                        </div>
                                                        <form action="">
                                                            <div
                                                                class="payment-modal-main"
                                                            >
                                                                <div
                                                                    class="payment-modal-inner"
                                                                >
                                                                    <div
                                                                        class="row"
                                                                    >
                                                                        <div
                                                                            class="col-12 text-center"
                                                                        >
                                                                            <img
                                                                                src="images/block.png"
                                                                                class="img-fluid"
                                                                                alt=""
                                                                            />
                                                                            <h3>
                                                                                Are
                                                                                you
                                                                                sure
                                                                                you
                                                                                want
                                                                                to
                                                                                block
                                                                                this
                                                                                employee?
                                                                            </h3>
                                                                        </div>
                                                                    </div>
                                                                    <div
                                                                        class="row"
                                                                    >
                                                                        <div
                                                                            class="col-12 text-center"
                                                                        >
                                                                            <button
                                                                                type="button"
                                                                                class="can"
                                                                                data-dismiss="modal"
                                                                            >
                                                                                Cancel
                                                                            </button>
                                                                            <button
                                                                                type="button"
                                                                                class="con"
                                                                                data-dismiss="modal"
                                                                            >
                                                                                Block
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--user profile end here-->
                                </div>

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
            dataTable: null,
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
                    text: "Block",
                    target: "#exampleModalCenter",
                    toggle: "modal",
                    aria: "true"
                }
            ]
        };
    },
    beforeCreate() {},
    created() {},

    components: {
        TableComponent
    },
    mounted() {
        $(document).ready(() => {
            $(".dataTables_filter input").attr("placeholder", "Search");
        });
        this.getUsers();

        // this.dataTable = $("#test-table").DataTable({});

        // this.users.forEach(user => {
        //     this.dataTable.row
        //         .add([
        //             user.id,
        //             user.first_name,
        //             user.last_name,
        //             user.email,
        //             user.last_name,
        //             user.created_at
        //         ])
        //         .draw(true);
        // });

        this.datepicker();
    },

    methods: {
        checkclick(id) {
            console.log(id);
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
                    //console.log("event fired");

                    axios
                        .get("/api/admin/getalluserstofrom", {
                            params: {
                                from: document.getElementById("select-date")
                                    .value,
                                to: document.getElementById("select-date2")
                                    .value
                            }
                        })
                        .then(res => {
                            //console.log(res.data.users);
                            this.users = res.data.users;
                        })
                        .catch(err => {
                            console.log(err.status);
                        });
                    //axios request according to date
                }
            }, 100);
        },

        getUsers() {
            axios
                .get("/api/admin/getallusers", {
                    params: {
                        blocked: false
                    }
                })
                .then(res => {
                    //console.log(res.data.users);
                    this.users = res.data.users;
                })
                .catch(err => {});
        }
    },

    blockUser(id) {
        axios
            .post("api/admin/blockuser", {
                id: id
            })
            .then(res => {
                console.log(res.data.status);
            })
            .catch(err => {
                console.log(err.response);
            });
    }
};
</script>

<style></style>
