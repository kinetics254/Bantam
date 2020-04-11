<template>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Leave Allocations</h5>
                </div>
                <div class="ibox-content " :class="{ 'sk-loading': loading }">
                    <spinner v-if="loading" />

                    <div class="table-responsive m-b-md">
                        <table
                            class="table table-hover table-condensed animated fadeIn"
                        >
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Application Code</th>
                                    <th>Application Date</th>
                                    <th>Days Applied</th>
                                    <th>Leave Code</th>
                                    <th>Leave Period</th>
                                    <th>Start Date</th>
                                    <th>Return Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(application, index) in applications"
                                    :key="index"
                                >
                                    <td>{{ meta.from + index }}</td>
                                    <td>{{ application.Application_Code }}</td>
                                    <td>{{ application.Application_Date }}</td>
                                    <td>{{ application.Days_Applied }}</td>
                                    <td>{{ application.Leave_Code }}</td>
                                    <td>{{ application.Leave_Period }}</td>
                                    <td>{{ application.Start_Date }}</td>
                                    <td>{{ application.Return_Date }}</td>
                                    <td>{{ application.Status }}</td>
                                </tr>
                                <tr v-if="applications.length === 0">
                                    <td colspan="8" class="text-center">
                                        <i class="text-muted"
                                            >no historical applications found</i
                                        >
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!--Pagination component -->
                    <pagination />
                </div>
            </div>
        </div></div
></template>

<script>
import Spinner from "../../../plugins/loader/views/Spinner";
export default {
    name: "LeaveHistory",
    components: { Spinner },
    beforeRouteEnter(to, from, next) {
        next(v => {
            v.getData();
        });
    },
    computed: {
        applications() {
            return this.paginate(
                this.$store.getters["leave/historicalApplications"]
            );
        }
    },
    methods: {
        getData: function(url = null) {
            this.$store.dispatch("leave/getHistoricalApplications", url || "");
        }
    }
};
</script>

<style scoped></style>
