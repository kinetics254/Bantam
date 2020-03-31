<template>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Open Applications</h5>
                    <div class="ibox-tools">
                        <button
                            type="button"
                            class="btn btn-sm btn-primary"
                            data-toggle="modal"
                            data-target="#LeaveApplication"
                        >
                            Make Application <i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>

                <div class="ibox-content" :class="{ 'sk-loading': loading }">
                    <spinner v-if="loading" />

                    <div class="table-responsive">
                        <table class="table table-hover animated fadeIn">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Application Date</th>
                                    <th>Days Applied</th>
                                    <th>Leave Code</th>
                                    <th>Leave Period</th>
                                    <th>Start Date</th>
                                    <th>Return Date</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(application, index) in applications"
                                    :key="index"
                                    style="cursor: pointer"
                                    @dblclick="
                                        getApplicationDetails(application.id)
                                    "
                                >
                                    <td>{{ meta.from + index }}</td>
                                    <td>{{ application.Application_Date }}</td>
                                    <td>{{ application.Days_Applied }}</td>
                                    <td>{{ application.Leave_Code }}</td>
                                    <td>{{ application.Leave_Period }}</td>
                                    <td>{{ application.Start_Date }}</td>
                                    <td>{{ application.Return_Date }}</td>
                                    <td>
                                        <span
                                            class="label"
                                            :class="
                                                application.Status === 'New'
                                                    ? 'label-info'
                                                    : application.Status ===
                                                      'Review'
                                                    ? 'label-success'
                                                    : 'label-danger'
                                            "
                                            >{{ application.Status }}</span
                                        >
                                    </td>
                                    <td>
                                        <button
                                            class="btn btn-xs  cancelButton"
                                            :class="
                                                application.Status === 'Review'
                                                    ? 'btn-danger'
                                                    : 'btn-default'
                                            "
                                            :disabled="
                                                application.Status !== 'Review'
                                            "
                                            @click="
                                                deleteApplication(
                                                    application.id
                                                )
                                            "
                                        >
                                            Cancel &nbsp;
                                            <i class="fa fa-close"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr v-if="applications.length === 0">
                                    <td colspan="9" class="text-center">
                                        <i class="text-muted"
                                            >no applications found</i
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

        <!-- Modal for new leave application:: Added by Mayaka == -->
        <div
            id="LeaveApplication"
            class="modal inmodal fade"
            tabindex="-1"
            role="dialog"
            aria-hidden="true"
            style="display: none;"
        >
            <div class="modal-dialog">
                <div class="modal-content animated fadeInDown">
                    <div class="modal-header">
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                        >
                            <span aria-hidden="true">&times;</span
                            ><span class="sr-only">Close</span>
                        </button>
                        <h4 class="modal-title">New application</h4>
                    </div>
                    <div class="modal-body" style="background: white">
                        <div
                            class="ibox-content"
                            style="border: none"
                            :class="{ 'sk-loading': loading }"
                        >
                            <spinner v-if="loading" />
                            <div class="row">
                                <form class="form-horizontal" role="form">
                                    <div
                                        class="form-group"
                                        :class="formDataError.leave_code.status"
                                    >
                                        <label class="col-sm-4 control-label"
                                            >Leave type</label
                                        >
                                        <div class="col-sm-8">
                                            <select
                                                v-model="formData.leave_code"
                                                class="form-control col-sm-2"
                                            >
                                                <option
                                                    value=""
                                                    disabled
                                                    selected
                                                    >Leave type</option
                                                >
                                                <option
                                                    v-for="(leave,
                                                    i) in leaveTypes"
                                                    :key="i"
                                                    :value="leave.Code"
                                                    >{{
                                                        leave.Description
                                                    }}</option
                                                >
                                            </select>
                                            <span
                                                id="helpBlockLeaveCode"
                                                class="help-block"
                                                >{{
                                                    formDataError.leave_code
                                                        .message
                                                }}</span
                                            >
                                        </div>
                                    </div>
                                    <div
                                        class="form-group"
                                        :class="formDataError.start_date.status"
                                    >
                                        <label class="col-sm-4 control-label"
                                            >Start Date - End Date</label
                                        >
                                        <div class="col-sm-8">
                                            <datepicker
                                                v-model="dateRange"
                                                confirm
                                                placeholder="Select start date and end date"
                                                :disabled-days="disabledDays"
                                                format="yyyy-MM-dd"
                                                lang="en"
                                                range
                                                input-class="form-control"
                                            ></datepicker>
                                            <span class="help-block">{{
                                                formDataError.start_date.message
                                            }}</span>
                                        </div>
                                    </div>

                                    <div class="hr-line-dashed"></div>

                                    <div
                                        class="form-group"
                                        :class="formDataError.no_of_days.status"
                                    >
                                        <label class="col-sm-4 control-label"
                                            >Number of days</label
                                        >
                                        <div class="col-sm-8">
                                            <input
                                                v-model="formData.no_of_days"
                                                type="number"
                                                disabled
                                                placeholder="Number of days"
                                                class="form-control"
                                            />
                                            <span class="help-block">{{
                                                formDataError.no_of_days.message
                                            }}</span>
                                        </div>
                                    </div>
                                    <div
                                        class="form-group"
                                        :class="
                                            formDataError.return_date.status
                                        "
                                    >
                                        <label class="col-sm-4 control-label"
                                            >Return Date</label
                                        >
                                        <div class="col-sm-8">
                                            <datepicker
                                                v-model="formData.return_date"
                                                disabled
                                                confirm
                                                format="yyyy-MM-dd"
                                                lang="en"
                                                input-class="form-control"
                                            ></datepicker>

                                            <span class="help-block">{{
                                                formDataError.return_date
                                                    .message
                                            }}</span>
                                        </div>
                                    </div>
                                    <div
                                        class="form-group"
                                        :class="formDataError.handOverTo.status"
                                    >
                                        <label class="col-sm-4 control-label"
                                            >Hand over to</label
                                        >
                                        <div class="col-sm-8">
                                            <select
                                                v-model="formData.handOverTo"
                                                class="form-control col-sm-2"
                                            >
                                                <option
                                                    value=""
                                                    disabled
                                                    selected
                                                    >Employee name</option
                                                >
                                                <option
                                                    v-for="(emp,
                                                    index) in employees"
                                                    :key="index"
                                                    :value="emp.No"
                                                    >{{
                                                        `${emp.First_Name ||
                                                            ""} ${emp.Middle_Name ||
                                                            ""} ${emp.Last_Name ||
                                                            ""}`
                                                    }}</option
                                                >
                                            </select>
                                            <span class="help-block">{{
                                                formDataError.handOverTo.message
                                            }}</span>
                                        </div>
                                    </div>
                                    <div
                                        class="form-group"
                                        :class="formDataError.comment.status"
                                    >
                                        <label class="col-sm-4 control-label"
                                            >Comments</label
                                        >
                                        <div class="col-sm-8">
                                            <textarea
                                                v-model="formData.comment"
                                                class="form-control"
                                                rows="2"
                                            ></textarea>
                                            <span class="help-block">{{
                                                formDataError.comment.message
                                            }}</span>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-white"
                            data-dismiss="modal"
                        >
                            Close
                        </button>
                        <button
                            type="submit"
                            class="btn btn-primary "
                            :disabled="formData.return_date === ''"
                            @click="saveLeaveApplication"
                        >
                            Submit
                            <i class="fa fa-send"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of New leave application modal -->

        <!-- view approvers modal -->
        <div
            id="approversModal"
            class="modal inmodal fade"
            tabindex="-1"
            role="dialog"
            aria-hidden="true"
            style="display: none;"
        >
            <div class="modal-dialog modal-sm">
                <div class="modal-content animated fadeInDown">
                    <div class="modal-body" style="background: white">
                        <div
                            class="ibox-content"
                            style="border: none"
                            :class="{ 'sk-loading': loading }"
                        >
                            <spinner v-if="loading" />
                            <table
                                class="table table-hover table-xs animated fadeIn"
                            >
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Approver</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="(appDetail,
                                        i) in applicationDetails"
                                        :key="i"
                                    >
                                        <td>{{ appDetail.Sequence_No }}</td>
                                        <td>
                                            {{ appDetail.Approval_Details }}
                                        </td>
                                        <td>
                                            <i
                                                :class="
                                                    appDetail.Status ===
                                                    'Approved'
                                                        ? 'fa fa-check'
                                                        : appDetail.Status ===
                                                          'Created'
                                                        ? 'fa fa-circle'
                                                        : appDetail.Status ===
                                                          'Rejected'
                                                        ? 'fa fa-circle'
                                                        : appDetail.Status ===
                                                          'Open'
                                                        ? 'fa fa-circle'
                                                        : 'Unknown'
                                                "
                                                :title="
                                                    appDetail.Status ===
                                                    'Approved'
                                                        ? 'Approved'
                                                        : appDetail.Status ===
                                                          'Created'
                                                        ? 'Pending'
                                                        : appDetail.Status ===
                                                          'Rejected'
                                                        ? 'Rejected'
                                                        : appDetail.Status ===
                                                          'Open'
                                                        ? 'Open'
                                                        : 'Unknown'
                                                "
                                                :style="
                                                    appDetail.Status ===
                                                    'Approved'
                                                        ? 'color: #2ecc71'
                                                        : appDetail.Status ===
                                                          'Created'
                                                        ? 'color: #bdc3c7'
                                                        : appDetail.Status ===
                                                          'Rejected'
                                                        ? 'color: #e74c3c'
                                                        : appDetail.Status ===
                                                          'Open'
                                                        ? 'color: #3498db'
                                                        : 'color: #ecf0f1'
                                                "
                                            >
                                            </i>
                                        </td>
                                    </tr>
                                    <tr v-if="applicationDetails.length === 0">
                                        <td colspan="3" class="text-center">
                                            <i class="text-muted"
                                                >no processing details</i
                                            >
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
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
import Datepicker from "vue2-datepicker";
import { helper, validator } from "../../../utilities";
export default {
    name: "LeaveApplication",
    components: { Spinner, Datepicker },
    mixins: [LoadingMixin, PaginationMixin],
    data: function() {
        return {
            dateRange: [],
            formData: {
                leave_code: "",
                start_date: "",
                no_of_days: "",
                end_date: "",
                return_date: "",
                comment: "",
                handOverTo: "",
                status: "Review"
            },
            formDataError: {
                leave_code: { status: "", message: "" },
                start_date: { status: "", message: "" },
                no_of_days: { status: "", message: "" },
                end_date: { status: "", message: "" },
                return_date: { status: "", message: "" },
                comment: { status: "", message: "" },
                handOverTo: { status: "", message: "" }
            },
            rules: {
                leave_code: "required",
                start_date: "required",
                no_of_days: "required",
                end_date: "required",
                return_date: "required",
                comment: "optional",
                handOverTo: "required"
            }
        };
    },
    beforeRouteEnter(to, from, next) {
        next(v => {
            v.getData();
            v.$store.dispatch("profile/getEmployee", v.$auth.user().id);
            v.$store.dispatch("leave/getLeaveTypes");
            v.$store.dispatch("leave/getDisabledDays");
        });
    },
    computed: {
        applications() {
            return this.paginate(this.$store.getters["leave/applications"]);
        },
        disabledDays() {
            return this.$store.getters["leave/disabledDays"];
        },
        applicationDetails() {
            return this.$store.getters["leave/applicationDetails"];
        },
        leaveTypes() {
            return this.$store.getters["leave/leaveTypes"];
        },
        employees() {
            return this.$store.getters["leave/employees"].filter(
                emp => parseInt(emp.id) !== parseInt(this.employee.id)
            );
        },
        employee() {
            return this.$store.getters["profile/employee"];
        },
        leaveDates() {
            return this.$store.getters["leave/leaveDates"];
        }
    },
    watch: {
        dateRange: {
            handler: function(n) {
                this.formData.start_date = helper.prepareDate(n[0]);
                this.formData.end_date = helper.prepareDate(n[1]);
                this.calculate();
            }
        },
        leaveDates: {
            handler: function(n) {
                this.formData.no_of_days = n.lDays;
                this.formData.return_date = n.rDate;
            }
        },
        employee: {
            handler: function(n) {
                this.$store.dispatch("leave/getEmployees", n.Department);
            }
        }
    },
    methods: {
        getData: function(url = null) {
            this.$store.dispatch("leave/getApplications", url || "");
        },

        getApplicationDetails: function(id) {
            this.$store.dispatch("leave/getApplicationDetails", id);

            // eslint-disable-next-line no-undef
            $("#approversModal").modal("toggle");
        },

        setDates: function() {
            this.formData.start_date = this.dateFix(this.dateRange[0]);
            this.formData.end_date = this.dateFix(this.dateRange[1]);
            this.calculate();
        },

        calculate: function() {
            /* validate */
            let res = validator.fields(
                this.formData,
                {
                    leave_code: "required",
                    start_date: "required",
                    no_of_days: "optional",
                    end_date: "required",
                    return_date: "optional",
                    comment: "optional",
                    handOverTo: "optional"
                },
                this.formDataError
            );
            if (res.hasErrors) {
                this.formDataError = res.errors;
                return;
            }

            this.$store.dispatch("leave/calculateDates", this.formData);
        },

        saveLeaveApplication: function() {
            /* validate form */

            if (this.formData.return_date === "") return;

            let res = validator.fields(
                this.formData,
                this.rules,
                this.formDataError
            );
            if (res.hasErrors) {
                this.formDataError = res.errors;
                return;
            }

            this.$store.dispatch("leave/submitApplication", this.formData);
        },

        deleteApplication: function(id) {
            this.$store.dispatch("leave/deleteApplication", {
                id: id,
                data: { Status: "Canceled" }
            });
        }
    }
};
</script>

<style scoped></style>
