<template>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Pay Periods</h5>
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
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Starting Date</th>
                                    <th>Closed</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(period, index) in periods"
                                    :key="index"
                                >
                                    <td>{{ meta.from + index }}</td>
                                    <td>{{ period.Name }}</td>
                                    <td>
                                        <span
                                            v-if="period.Current"
                                            class="label label-info"
                                            >Current</span
                                        >
                                        <span v-else></span>
                                    </td>
                                    <td>{{ period.Starting_Date }}</td>
                                    <td>{{ period.Closed }}</td>
                                    <td>
                                        <button
                                            class="btn btn-xs btn-success"
                                            @click="
                                                getPayslip(period.Starting_Date)
                                            "
                                        >
                                            View Payslip
                                            <i class="fa fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr v-if="periods.length == 0">
                                    <td colspan="8" class="text-center">
                                        <i class="text-muted"
                                            >no periods found</i
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
        </div>
    </div>
</template>

<script>
import Spinner from "../../../plugins/loader/views/Spinner";
export default {
    name: "PayslipList",
    components: { Spinner },
    beforeRouteEnter(to, from, next) {
        next(v => {
            v.getData();
        });
    },
    computed: {
        periods() {
            return this.paginate(
                this.$store.getters["leave/historicalApplications"]
            );
        }
    },
    methods: {
        getData: function(url = null) {
            this.$store.dispatch("payslip/getPeriods", url || "");
        },
        getPayslip: function(period) {
            this.$store.dispatch("payslip/getPayslip", period);
        }
    }
};
</script>

<style scoped></style>
