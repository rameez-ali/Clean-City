<template>
    <table class="table table-striped table-bordered zero-configuration">
        <thead>
            <tr>
                <th v-for="head in tHead" :key="head.id">{{ head }}</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="row in tRows" :key="row.id">
                <td>{{ row.id }}</td>
                <td>
                    {{ row.first_name }}
                </td>
                <td>{{ row.last_name }}</td>
                <td>{{ row.email }}</td>
                <td>{{ row.created_at }}</td>

                <td>
                    <div class="btn-group mr-1 mb-1">
                        <button
                            type="button"
                            class="btn  btn-drop-table btn-sm"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                        >
                            <i class="fa fa-ellipsis-v"></i>
                        </button>
                        <div
                            class="dropdown-menu"
                            x-placement="bottom-start"
                            style="position: absolute; transform: translate3d(4px, 23px, 0px); top: 0px; left: 0px; will-change: transform;"
                        >
                            <a
                                class="dropdown-item"
                                href="a-employee-profile.html"
                                ><i class="fa fa-eye"></i>View
                            </a>
                            <a
                                class="dropdown-item"
                                href="#"
                                data-toggle="modal"
                                data-target="#exampleModalCenter"
                                ><i class="fa fa-ban" aria-hidden="true"></i
                                >block</a
                            >
                            <a
                                class="dropdown-item"
                                href="a-employees-ticket-log.html"
                                ><i class="fa fa-ticket"></i>View Ticket Log</a
                            >
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
export default {
    props: {
        tHead: Array,
        tRows: Array
    },
    mounted() {},
    methods: {}
};
</script>

<style></style>
