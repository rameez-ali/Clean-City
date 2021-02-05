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
                                        <h1 class="pull-left">Add Package</h1>
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <form action="">
                                            <div class="row">
                                                <div
                                                    class="col-xl-4 col-lg-4 col-md-6 col-sm-6 form-group"
                                                >
                                                    <label for="">Name</label>
                                                    <input
                                                        v-model="name"
                                                        type="text"
                                                        name=""
                                                        placeholder="Mark"
                                                        id=""
                                                        class="form-control"
                                                    />
                                                </div>
                                                <div
                                                    class="col-xl-4 col-lg-4 col-md-6 col-sm-6 form-group"
                                                >
                                                    <label for="">Price</label>
                                                    <input
                                                        v-model="price"
                                                        type="number"
                                                        name=""
                                                        id=""
                                                        class="form-control"
                                                    />
                                                </div>

                                                <div
                                                    class="col-xl-4 col-lg-4 col-md-6 col-sm-6 form-group"
                                                >
                                                    <label for=""
                                                        >Description</label
                                                    >
                                                    <input
                                                        v-model="description"
                                                        type="text"
                                                        name=""
                                                        placeholder="Abc"
                                                        id=""
                                                        class="form-control"
                                                    />
                                                </div>
                                                <div
                                                    class="col-xl-4 col-lg-4 col-md-6 col-sm-6 form-group"
                                                >
                                                    <label for=""
                                                        >Recurrency</label
                                                    >
                                                    <input
                                                        v-model="recurrency"
                                                        type="text"
                                                        name=""
                                                        placeholder="Abc"
                                                        id=""
                                                        class="form-control"
                                                    />
                                                    <span
                                                        v-if="error.recurrency"
                                                        >{{
                                                            error.recurrency[0]
                                                        }}</span
                                                    >
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="row edit-btn">
                                    <div class="col-12">
                                        <a @click="addPackage">
                                            Add Package
                                        </a>
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
            error: [{}],
            name: "",
            description: "",
            price: "",
            recurrency: ""
        };
    },
    methods: {
        addPackage() {
            axios
                .post("api/admin/addpackage", {
                    name: this.name,
                    description: this.description,
                    price: this.price,
                    recurrency: this.recurrency
                })
                .then(res => {
                    if (res.data.status == 1) alert("Successfully Added");
                })
                .catch(err => {
                    this.error = err.response.data.errors;
                    console.log(err.response.data.errors.recurrency[0]);
                });
        }
    }
};
</script>

<style></style>
