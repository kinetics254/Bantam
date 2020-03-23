<template>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Time Sheet</h5>
                    <div class="ibox-tools">
                        <a
                            class="dropdown-toggle"
                            data-toggle="dropdown"
                            href="#"
                        >
                            <i class="fa fa-bars" />
                        </a>
                    </div>
                </div>
                <div class="ibox-content " :class="{ 'sk-loading': loading }">
                    <spinner v-if="loading" />

                    <div class="row m-b-md ">
                        <div class="col-lg-6">
                            <status-filter
                                :data="[
                                    { Status: 'Pending' },
                                    { Status: 'Approved' },
                                    { Status: 'Declined' },
                                    { Status: 'Closed' }
                                ]"
                                filter-key="Status"
                            />
                        </div>
                        <div class="col-lg-6">
                            <search />
                        </div>
                    </div>

                    <div
                        class="p-md m-b-sm border-left-right border-top-bottom"
                    >
                        <table class="table small">
                            <tr class="leave-form">
                                <td>
                                    <div class="form-group-sm">
                                        <label>Date</label>
                                        <datepicker
                                            format="yyyy-MM-dd"
                                            input-class="form-control"
                                        />
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group-sm">
                                        <label>Employee</label>
                                        <select class="form-control input-sm">
                                            <option>Employee1</option>
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group-sm">
                                        <label>Project</label>
                                        <select class="form-control input-sm">
                                            <option>Project1</option>
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group-sm">
                                        <label>Activity</label>
                                        <select class="form-control input-sm">
                                            <option>Activity1</option>
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group-sm">
                                        <label>Task</label>
                                        <select class="form-control input-sm">
                                            <option>Task1</option>
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <label>Hours</label>
                                    <div class="form-group-sm">
                                        <input
                                            type="number"
                                            class="form-control input-sm"
                                        />
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group-sm">
                                        <label>Comments</label>
                                        <input
                                            type="text"
                                            class="form-control input-sm"
                                        />
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group-sm">
                                        <label>Add</label><br />
                                        <a class="btn btn-sm btn-primary">
                                            <i class="fa fa-plus"></i> Add
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <div class="table-responsive m-b-md">
                        <table
                            id="advocates-table"
                            class="table table-hover table-condensed small"
                        >
                            <thead>
                                <tr>
                                    <th>Entry No</th>
                                    <th>Date</th>
                                    <th>Employee</th>
                                    <th>Project</th>
                                    <th>Activity</th>
                                    <th>Task</th>
                                    <th>Hours</th>
                                    <th>Status</th>
                                    <th>Comment</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(sheet, index) in timesheets"
                                    :key="index"
                                >
                                    <td>{{ sheet.Entry_No }}</td>
                                    <td>{{ sheet.date || "" }}</td>
                                    <td>{{ sheet.Employee }}</td>
                                    <td>{{ sheet.Project }}</td>
                                    <td>{{ sheet.Activity }}</td>
                                    <td>{{ sheet.Task }}</td>
                                    <td>{{ sheet.Hours }}</td>
                                    <td>{{ sheet.Status }}</td>
                                    <td>
                                        <a class="btn btn-default btn-xs"
                                            ><i class="fa comment-alt" />
                                            Comments</a
                                        >
                                    </td>
                                    <td>
                                        <a class="btn btn-default btn-xs">
                                            <i class="fa fa-edit"></i> Edit
                                        </a>
                                        <a class="btn btn-default btn-xs">
                                            <i class="fa fa-copy"></i> Copy
                                        </a>
                                        <a class="btn btn-xs btn-danger">
                                            <i class="fa fa-trash"></i> Delete
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td
                                        v-if="timesheets.length === 0"
                                        colspan="8"
                                        class="text-center"
                                    >
                                        Nothing here
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
import Datepicker from "vuejs-datepicker";
export default {
    name: "TimesheetList",
    components: { Spinner, Datepicker },
    mixins: [LoadingMixin, PaginationMixin],
    data: function() {
        return {
            filter: ""
        };
    },
    beforeRouteEnter(to, from, next) {
        next(v => {
            v.getData();
        });
    },
    computed: {
        timesheets() {
            let v = this;
            let sheets = this.paginate(
                v.$store.getters["timesheet/timesheets"]
            );
            return v.filter === ""
                ? sheets
                : sheets.filter(c => {
                      return c.Status === v.filter;
                  });
        }
    },
    methods: {
        getData: function(url = null) {
            this.$store.dispatch("timesheet/getTimeSheet", url || "");
        }
    }
};
</script>

<style scoped>
.leave-form td {
    padding: 4px;
}
</style>
