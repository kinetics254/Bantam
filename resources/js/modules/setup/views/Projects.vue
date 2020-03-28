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
                                    <th>Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(project, index) in projects"
                                    :key="index"
                                >
                                    <td>
                                        {{ parseInt(index) + 1 }}
                                    </td>
                                    <td>{{ project.Code }}</td>
                                    <td>{{ project.Name }}</td>
                                    <td>{{ project.Description }}</td>
                                </tr>

                                <tr>
                                    <td
                                        v-if="projects.length === 0"
                                        colspan="6"
                                        class="text-center"
                                    >
                                        No project found
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
    name: "Projects",
    components: { Spinner },
    mixins: [LoadingMixin],
    beforeRouteEnter(to, from, next) {
        next(v => {
            v.$store.dispatch("setup/getProjects");
        });
    },
    computed: {
        projects() {
            return this.$store.getters["setup/projects"];
        }
    }
};
</script>

<style scoped></style>
