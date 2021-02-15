<template>
    <table
        class="table table-striped table-bordered zero-configuration"
        id="test-table"
    >
        <thead>
            <tr>
                <th v-for="head in tHead" :key="head.id">{{ head }}</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="row in tRows" :key="row.id">
                <td v-for="data in row" :key="data">
                    {{ data }}
                </td>

                <td>
                    <div class="btn-group mr-1 mb-1 show">
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
                                v-for="action in actions"
                                :key="action.text"
                                class="dropdown-item"
                                :aria-hidden="action.aria"
                                :data-toggle="action.toggle"
                                :data-target="action.target"
                                :href="action.href + row.id"
                                ><i :class="action.class"></i>{{ action.text }}
                            </a>
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
        tRows: Array,
        actions: Array
    },
    mounted() {},
    methods: {}
};
</script>

<style></style>
