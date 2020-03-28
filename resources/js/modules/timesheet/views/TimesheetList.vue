<template>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Time Sheet</h5>
                    <div class="ibox-tools">
                        <a
                            class="btn btn-xs btn-primary"
                            data-toggle="dropdown"
                            @click="saveSheets"
                        >
                            <i class="fa fa-save" /> Save
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
                            <div class="input-group m-b">
                                <div class="input-group-btn">
                                    <button
                                        data-toggle="dropdown"
                                        class="btn btn-primary dropdown-toggle"
                                        type="button"
                                        aria-expanded="false"
                                    >
                                        {{ recFilter.field || "Select Field" }}
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li
                                            v-for="(field,
                                            index) in recFilterFields"
                                            :key="index"
                                            @click="recFilter.field = field"
                                        >
                                            <a href="#">{{ field }}</a>
                                        </li>
                                    </ul>
                                </div>
                                <input
                                    v-model="recFilter.value"
                                    type="text"
                                    class="form-control"
                                    :placeholder="recFilter.field"
                                />
                                <div class="input-group-btn">
                                    <button
                                        class="btn btn-white"
                                        type="button"
                                        @click="resetRecFilter"
                                    >
                                        Reset
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div
                        class="p-md m-b-sm border-left-right border-top-bottom"
                    >
                        <table class="table small">
                            <tr class="leave-form">
                                <td>
                                    <div
                                        class="form-group-sm"
                                        :class="timesheetError.Date.status"
                                    >
                                        <label>Date</label>
                                        <datepicker
                                            v-model="timesheet.Date"
                                            format="yyyy-MM-dd"
                                            input-class="form-control"
                                            placeholder="Date"
                                        />
                                        <span class="help-block">{{
                                            timesheetError.Date.message
                                        }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div
                                        class="form-group-sm"
                                        :class="timesheetError.Employee.status"
                                    >
                                        <label>Employee</label>
                                        <select
                                            v-model="timesheet.Employee"
                                            class="form-control input-sm"
                                            :value="timesheet.No"
                                        >
                                            <option
                                                v-for="(employee,
                                                index) in employees"
                                                :key="index"
                                                :value="employee.No"
                                                >{{
                                                    `${employee.First_Name} ${employee.Middle_Name} ${employee.Last_Name}`
                                                }}</option
                                            >
                                        </select>
                                        <span class="help-block">{{
                                            timesheetError.Employee.message
                                        }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div
                                        class="form-group-sm"
                                        :class="timesheetError.Project.status"
                                    >
                                        <label>Project</label>
                                        <select
                                            v-model="timesheet.Project"
                                            class="form-control input-sm"
                                        >
                                            <option
                                                v-for="(project, i) in projects"
                                                :key="i"
                                                :value="project.Code"
                                                >{{ project.Name }}</option
                                            >
                                        </select>
                                        <span class="help-block">{{
                                            timesheetError.Project.message
                                        }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div
                                        class="form-group-sm"
                                        :class="timesheetError.Location.status"
                                    >
                                        <label>Location</label>
                                        <select
                                            v-model="timesheet.Location"
                                            class="form-control input-sm"
                                        >
                                            <option
                                                v-for="(location,
                                                i) in locations"
                                                :key="i"
                                                :value="location.Code"
                                                >{{ location.Name }}</option
                                            >
                                        </select>
                                        <span class="help-block">{{
                                            timesheetError.Location.message
                                        }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div
                                        class="form-group-sm"
                                        :class="timesheetError.Activity.status"
                                    >
                                        <label>Activity</label>
                                        <select
                                            v-model="timesheet.Activity"
                                            class="form-control input-sm"
                                        >
                                            <option
                                                v-for="(activity,
                                                i) in activities"
                                                :key="i"
                                                :value="activity.Code"
                                                >{{
                                                    activity.Description
                                                }}</option
                                            >
                                        </select>
                                        <span class="help-block">{{
                                            timesheetError.Activity.message
                                        }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div
                                        class="form-group-sm"
                                        :class="timesheetError.Task.status"
                                    >
                                        <label>Task</label>
                                        <select
                                            v-model="timesheet.Task"
                                            class="form-control input-sm"
                                        >
                                            <option
                                                v-for="(task, i) in tasks"
                                                :key="i"
                                                :value="task.Code"
                                                >{{ task.Description }}</option
                                            >
                                        </select>
                                        <span class="help-block">{{
                                            timesheetError.Task.message
                                        }}</span>
                                    </div>
                                </td>
                                <td>
                                    <label>Hours</label>
                                    <div
                                        class="form-group-sm"
                                        :class="timesheetError.Hours.status"
                                    >
                                        <input
                                            v-model="timesheet.Hours"
                                            type="number"
                                            class="form-control input-sm"
                                            placeholder="Hours"
                                        />
                                        <span class="help-block">{{
                                            timesheetError.Hours.message
                                        }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div
                                        class="form-group-sm"
                                        :class="timesheetError.Comments.status"
                                    >
                                        <label>Comments</label>
                                        <input
                                            v-model="timesheet.Comments"
                                            type="text"
                                            class="form-control input-sm"
                                            placeholder="Comments"
                                            @click="setComment"
                                        />
                                        <span class="help-block">{{
                                            timesheetError.Comments.message
                                        }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group-sm">
                                        <label>Add</label><br />
                                        <a
                                            class="btn btn-sm btn-primary"
                                            @click="addTimesheet"
                                        >
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
                                    v-show="!sheet.deleted"
                                    :key="index"
                                >
                                    <td>{{ sheet.Entry_No || "pending" }}</td>
                                    <td>{{ sheet.Date || "" }}</td>
                                    <td>{{ sheet.Employee }}</td>
                                    <td>{{ sheet.Project }}</td>
                                    <td>{{ sheet.Activity }}</td>
                                    <td>{{ sheet.Task }}</td>
                                    <td>{{ sheet.Hours }}</td>
                                    <td>{{ sheet.Status || "pending" }}</td>
                                    <td>
                                        <a
                                            class="btn btn-default btn-xs"
                                            @click="viewComment(sheet)"
                                            ><i class="fa fa-comment-alt" />
                                            Comments</a
                                        >
                                    </td>
                                    <td>
                                        <a
                                            class="btn btn-default btn-xs"
                                            @click="edit(sheet, index)"
                                        >
                                            <i class="fa fa-edit"></i> Edit
                                        </a>
                                        <a
                                            class="btn btn-default btn-xs"
                                            @click="copy(sheet)"
                                        >
                                            <i class="fa fa-copy"></i> Copy
                                        </a>
                                        <a
                                            class="btn btn-xs btn-danger"
                                            @click="remove(sheet)"
                                        >
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
        <confirmation-modal />

        <!--Comment modal-->
        <div
            id="commentModal"
            class="modal inmodal fade"
            tabindex="-1"
            role="dialog"
            aria-hidden="true"
            style="display: none;"
        >
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header">
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                        >
                            <span aria-hidden="true">×</span
                            ><span class="sr-only">Close</span>
                        </button>
                        <h4 class="modal-title">Comments</h4>
                    </div>
                    <div class="modal-body" style="background-color: white">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Comments</label>
                                    <textarea
                                        v-model="comment"
                                        class="form-control"
                                        :disabled="!isCommentEditable"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button
                            v-if="isCommentEditable"
                            type="button"
                            class="btn btn-primary"
                            data-dismiss="modal"
                            style="margin-bottom: 0"
                            @click="addComment"
                        >
                            Done
                        </button>
                    </div>
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
import { helper, validator } from "../../../utilities";

export default {
    name: "TimesheetList",
    components: { Spinner, Datepicker },
    mixins: [LoadingMixin, PaginationMixin],
    data: function() {
        return {
            filter: "",
            recFilter: {
                field: "",
                value: ""
            },
            comment: "",
            isCommentEditable: false,
            timesheet: {
                Activity: "",
                Comments: "",
                Employee: "",
                Hours: "",
                Project: "",
                Location: "",
                Task: "",
                Date: ""
            },
            timesheetError: {
                Activity: { status: "", message: "" },
                Comments: { status: "", message: "" },
                Employee: { status: "", message: "" },
                Hours: { status: "", message: "" },
                Project: { status: "", message: "" },
                Location: { status: "", message: "" },
                Status: { status: "", message: "" },
                Task: { status: "", message: "" },
                Date: { status: "", message: "" }
            },
            rules: {
                Activity: "required",
                Comments: "optional",
                Employee: "required",
                Hours: "required|gt:6",
                Project: "required",
                Location: "required",
                Task: "required",
                Date: "required"
            }
        };
    },
    beforeRouteEnter(to, from, next) {
        next(v => {
            v.getData();
            v.$store.dispatch("setup/getEmployees");
            v.$store.dispatch("setup/getProjects");
            v.$store.dispatch("setup/getActivities");
            v.$store.dispatch("setup/getTasks");
            v.$store.dispatch("setup/getLocation");
        });
    },
    beforeRouteLeave(to, from, next) {
        let sheets = this.$store.getters["timesheet/timesheets"].data.filter(
            s => {
                return s.set === true || s.deleted === true;
            }
        );

        if (sheets.length > 0) {
            this.$confirm.show({
                title: "There are unsaved changes",
                text: `Are you sure you want to leave?. your unsaved changes will be lost`,
                onConfirm: () => {
                    next();
                }
            });
            next(false);
        } else {
            next();
        }
    },
    computed: {
        timesheets() {
            let v = this;
            let sheets = this.paginate(
                v.$store.getters["timesheet/timesheets"]
            );
            return v.filter === "" &&
                (v.recFilter.field === "" || v.recFilter.value === "")
                ? sheets
                : sheets.filter(c => {
                      return (
                          c.Status === v.filter ||
                          c[this.recFilter.field] === this.recFilter.value
                      );
                  });
        },
        recFilterFields() {
            return ["Activity", "Employee", "Location", "Project", "Task"];
        },
        employees() {
            return this.$store.getters["setup/employees"];
        },
        activities() {
            return this.$store.getters["setup/activities"];
        },
        projects() {
            return this.$store.getters["setup/projects"];
        },
        tasks() {
            return this.$store.getters["setup/tasks"];
        },
        locations() {
            return this.$store.getters["setup/locations"];
        }
    },
    methods: {
        getData: function(url = null) {
            this.$store.dispatch("timesheet/getTimeSheets", url || "");
        },
        edit: function(sheet) {
            this.timesheet = { ...sheet };
            this.$store.commit("timesheet/EDIT_TIMESHEET", sheet);
        },
        copy: function(sheet) {
            this.timesheet = { ...sheet };
            delete this.timesheet.id;
            delete this.timesheet.Entry_No;
        },
        remove: function(sheet) {
            this.$store.commit("timesheet/REMOVE_TIMESHEET", sheet);
        },
        resetRecFilter: function() {
            for (const key in this.recFilter) this.recFilter[key] = "";
        },
        addTimesheet: function() {
            /* Validate */
            let res = validator.fields(
                this.timesheet,
                this.rules,
                this.timesheetError
            );
            if (res.hasErrors) {
                this.timesheetError = res.errors;
                return;
            }

            /* other validations
             * Duplicates
             */

            let sheet = this.$store.getters["timesheet/timesheets"].data.filter(
                s => {
                    return (
                        s.Employee === this.timesheet.Employee &&
                        s.Project === this.timesheet.Project &&
                        s.Location === this.timesheet.Location &&
                        s.Activity === this.timesheet.Activity &&
                        s.Task === this.timesheet.Task &&
                        s.Date === this.timesheet.Date
                    );
                }
            );

            if (sheet.length !== 0) {
                Event.$emit("duplicate");
                return;
            }

            this.timesheet.set = true;
            this.timesheet.Date = helper.prepareDate(this.timesheet.Date);
            this.$store.commit("timesheet/ADD_TIMESHEET", {
                ...this.timesheet
            });
            for (let key in this.timesheet) this.timesheet[key] = "";
        },
        setComment: function() {
            // eslint-disable-next-line no-undef
            $("#commentModal").modal("show");
            this.isCommentEditable = true;
        },
        addComment: function() {
            // eslint-disable-next-line no-undef
            $("#commentModal").modal("hide");
            this.timesheet.Comments = this.comment;
            this.comment = "";
            this.isCommentEditable = false;
        },
        viewComment: function(sheet) {
            this.comment = sheet.Comments;
            // eslint-disable-next-line no-undef
            $("#commentModal").modal("show");
        },
        saveSheets: function() {
            let sheets = this.$store.getters[
                "timesheet/timesheets"
            ].data.filter(s => {
                return s.set === true || s.deleted === true;
            });

            sheets.forEach(s => {
                delete s.set;
            });

            this.$store.dispatch("timesheet/saveSheets", sheets);
        }
    }
};
</script>

<style scoped>
.leave-form td {
    padding: 4px;
}
</style>
