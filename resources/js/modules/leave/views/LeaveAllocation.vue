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
                        <table class="table table-striped animated fadeIn">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>leave code</th>
                                    <th>Maturity Date</th>
                                    <th>Balance</th>
                                    <th>Accrued Days</th>
                                    <th>Days Taken</th>
                                    <th>Allocated Days</th>
                                    <th>Leave Period</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(allocation, index) in allocations"
                                    :key="index"
                                >
                                    <td>{{ meta.from + index }}</td>
                                    <td>{{ allocation.Leave_Code }}</td>
                                    <td>{{ allocation.Maturity_Date }}</td>
                                    <td>{{ allocation.Balance }}</td>
                                    <td>{{ allocation.Accrued_Days }}</td>
                                    <td>{{ allocation.Taken }}</td>
                                    <td>{{ allocation.Allocated_Days }}</td>
                                    <td>{{ allocation.Leave_Period }}</td>
                                </tr>
                                <tr v-if="allocations.length === 0">
                                    <td colspan="8" class="text-center">
                                        <i class="text-muted"
                                            >no allocations found</i
                                        >
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!--Pagination component expects a prop meta-->
                    <pagination :meta="meta" />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Spinner from "../../../components/Spinner";
import LoadingMixin from "../../../mixins/loader/loader";
import PaginationMixin from "../../../plugins/paginator/paginator";

export default {
    name: "LeaveAllocation",
    components: { Spinner },
    mixins: [LoadingMixin, PaginationMixin],
    beforeRouteEnter(to, from, next) {
        next(v => {
            v.$store.dispatch("profile/getEmployee", v.$auth.user().id);
        });
    },
    computed: {
        allocations() {
            return this.paginate(this.$store.getters["leave/allocations"]);
        },
        employee() {
            return this.$store.getters["profile/employee"];
        }
    },
    watch: {
        employee: {
            handler: function() {
                this.getData();
            }
        }
    },
    methods: {
        getData: function(url = null) {
            this.$store.dispatch(
                "leave/getAllocations",
                { url: url, id: this.employee.id } || ""
            );
        }
    }
};
</script>

<style scoped></style>
