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
                                    <th>Code</th>
                                    <th>Description</th>
                                    <th>Min hours</th>
                                    <th>Max hours</th>
                                    <th>Max hours</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(activity, index) in activities"
                                    :key="index"
                                >
                                    <td>
                                        {{ parseInt(index) + 1 }}
                                    </td>
                                    <td>{{ activity.Code }}</td>
                                    <td>{{ activity.Description }}</td>
                                    <td>{{ activity.Min_hours }}</td>
                                    <td>{{ activity.Max_hours }}</td>
                                </tr>
                                <tr>
                                    <td
                                        v-if="activities.length === 0"
                                        colspan="6"
                                        class="text-center"
                                    >
                                        No activity found
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
    name: "Activities",
    components: { Spinner },
    mixins: [LoadingMixin],
    beforeRouteEnter(to, from, next) {
        next(v => {
            v.$store.dispatch("setup/getActivities");
        });
    },
    computed: {
        activities() {
            return this.$store.getters["setup/activities"];
        }
    }
};
</script>

<style scoped></style>
