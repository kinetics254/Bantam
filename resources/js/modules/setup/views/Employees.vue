<template>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Activities</h5>
                </div>
                <div class="ibox-content " :class="{ 'sk-loading': loading }">
                    <spinner v-if="loading" />

                    <div class="table-responsive m-b-md">
                        <table class="table table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Gender</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(employee, index) in employees"
                                    :key="index"
                                >
                                    <td>
                                        {{ parseInt(index) + 1 }}
                                    </td>
                                    <td>{{ employee.No }}</td>
                                    <td>
                                        {{
                                            `${employee.First_Name} ${employee.Middle_Name} ${employee.Last_Name} `
                                        }}
                                    </td>
                                    <td>{{ employee.Gender }}</td>
                                    <td>{{ employee.Phone_No }}</td>
                                    <td>{{ employee.E_Mail }}</td>
                                </tr>
                                <tr>
                                    <td
                                        v-if="employees.length === 0"
                                        colspan="6"
                                        class="text-center"
                                    >
                                        No employee found
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import LoadingMixin from "../../../mixins/loader/loader";
import Spinner from "../../../components/Spinner";
export default {
    name: "Employees",
    components: { Spinner },
    mixins: [LoadingMixin],
    beforeRouteEnter(to, from, next) {
        next(v => {
            v.$store.dispatch("setup/getEmployees");
        });
    },
    computed: {
        employees() {
            return this.$store.getters["setup/employees"];
        }
    }
};
</script>

<style scoped></style>
