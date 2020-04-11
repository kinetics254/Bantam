<template>
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Leave summaries</h5>
                </div>
                <div class="ibox-content" :class="{ 'sk-loading': loading }">
                    <spinner v-if="loading" />

                    <div class="row">
                        <div class="col-md-12 -right p-lg">
                            <h5>Leave summary bar graph</h5>
                            <bar-chart :data="datasets" :options="options" />
                        </div>
                        <div class="col-md-6 p-lg">
                            <h5>Leave Taken Summary</h5>
                            <doughnut-chart
                                :data="doughnutData"
                                :options="{}"
                            />
                        </div>
                        <div class="col-md-6 p-lg">
                            <h5>Annual Leave Summary</h5>
                            <liner-chart />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { BarChart, DoughnutChart, LinerChart } from "../../../../charts";
import PaginationMixin from "../../../../plugins/paginator/paginator";
import Spinner from "../../../../plugins/loader/views/Spinner";
export default {
    name: "LeaveDashboard",
    components: { Spinner, BarChart, DoughnutChart, LinerChart },
    mixins: [PaginationMixin],
    data: function() {
        return {
            datasets: [
                {
                    label: "Days Taken",
                    backgroundColor: [
                        "rgb(255,99,132)",
                        "rgb(255,99,132)",
                        "rgb(255,99,132)",
                        "rgb(255,99,132)",
                        "rgb(255,99,132)",
                        "rgb(255,99,132)"
                    ],
                    borderColor: [],
                    borderWidth: 1,
                    data: []
                },
                {
                    label: "Accrued Days",
                    backgroundColor: [
                        "rgb(54,162,235)",
                        "rgb(54,162,235)",
                        "rgb(54,162,235)",
                        "rgb(54,162,235)",
                        "rgb(54,162,235)",
                        "rgb(54,162,235)"
                    ],
                    borderColor: [],
                    borderWidth: 1,
                    data: []
                },
                {
                    label: "Balance",
                    backgroundColor: [
                        "rgb(0,166,0)",
                        "rgb(0,166,0)",
                        "rgb(0,166,0)",
                        "rgb(0,166,0)",
                        "rgb(0,166,0)",
                        "rgb(0,166,0)"
                    ],
                    borderColor: [],
                    borderWidth: 1,
                    data: []
                },
                {
                    label: "Allocated Days",
                    backgroundColor: [
                        "rgb(255,206,86)",
                        "rgb(255,206,86)",
                        "rgb(255,206,86)",
                        "rgb(255,206,86)",
                        "rgb(255,206,86)",
                        "rgb(255,206,86)"
                    ],
                    borderColor: [],
                    borderWidth: 1,
                    data: []
                }
            ],
            doughnutData: [],
            options: {
                responsive: true,
                maintainAspectRatio: true,
                title: {
                    display: true,
                    position: "bottom",
                    text: "Custom Chart Title"
                },
                scales: {
                    xAxes: [
                        {
                            // stacked: true,
                            gridLines: { display: false }
                        }
                    ],
                    yAxes: [
                        {
                            // stacked: true
                        }
                    ]
                }
            }
        };
    },
    beforeRouteEnter(to, from, next) {
        next(v => {
            v.$store.dispatch("dashboard/getLeaveTypes");
            v.$store.dispatch("dashboard/getEmployee", v.$auth.user().id);
            v.$store.dispatch(
                "dashboard/getLeaveAllocation",
                v.$auth.user().id
            );
            v.initBarCharts(this.leaveAllocations);
            v.initDoughnutChart(this.leaveAllocations);
        });
    },
    computed: {
        leaveAllocations() {
            return [
                {
                    id: 3,
                    Leave_Period: "YR2018",
                    Employee_No: "AH",
                    Leave_Code: "SICK",
                    LTypes_Description: "Sick Leave",
                    Maturity_Date: "2018-12-31",
                    Balance_B_F: "0.00",
                    Accrued_Days: "7.00",
                    Allocated_Days: "7.00",
                    Taken: "0.00",
                    Balance: "7.00",
                    Comments: null,
                    Nav_Sync: 1,
                    Web_Sync: 1,
                    Nav_Sync_TimeStamp: "0001-01-01 00:00:00",
                    Web_Sync_TimeStamp: "0001-01-01 00:00:00",
                    created_at: "2018-03-19 12:34:07",
                    updated_at: "2018-03-19 12:34:07"
                },
                {
                    id: 2,
                    Leave_Period: "YR2018",
                    Employee_No: "AH",
                    Leave_Code: "COMPSS",
                    LTypes_Description: "Compassionate Leave",
                    Maturity_Date: "2018-12-31",
                    Balance_B_F: "0.00",
                    Accrued_Days: "5.00",
                    Allocated_Days: "5.00",
                    Taken: "0.00",
                    Balance: "5.00",
                    Comments: null,
                    Nav_Sync: 1,
                    Web_Sync: 1,
                    Nav_Sync_TimeStamp: "0001-01-01 00:00:00",
                    Web_Sync_TimeStamp: "0001-01-01 00:00:00",
                    created_at: "2018-03-19 12:34:07",
                    updated_at: "2018-03-19 12:34:07"
                },
                {
                    id: 1,
                    Leave_Period: "YR2018",
                    Employee_No: "AH",
                    Leave_Code: "ANNUAL",
                    LTypes_Description: "Annual Leave",
                    Maturity_Date: "2018-12-31",
                    Balance_B_F: "5.00",
                    Accrued_Days: "26.00",
                    Allocated_Days: "21.00",
                    Taken: "0.00",
                    Balance: "26.00",
                    Comments: null,
                    Nav_Sync: 1,
                    Web_Sync: 1,
                    Nav_Sync_TimeStamp: "0001-01-01 00:00:00",
                    Web_Sync_TimeStamp: "0001-01-01 00:00:00",
                    created_at: "2018-03-19 12:34:06",
                    updated_at: "2018-03-19 12:34:06"
                }
            ];
        },
        leaveTypes() {
            return [
                {
                    id: 1,
                    Code: "ANNUAL",
                    Description: "Annual Leave",
                    Days: "21.00",
                    InActive: 0,
                    Accrue_Days: 1,
                    Unlimited_Days: 0,
                    Gender: "both",
                    Balance: "Carry_Forward",
                    Inclusive_of_Holidays: 0,
                    Max_Carry_Forward_Days: "0.00",
                    Off_Holidays_Days_Leave: 0,
                    Nav_Sync: 1,
                    Web_Sync: 1,
                    Nav_Sync_TimeStamp: "0001-01-01 00:00:00",
                    Web_Sync_TimeStamp: "0001-01-01 00:00:00",
                    created_at: "2018-03-19 12:34:03",
                    updated_at: "2018-03-19 12:34:03"
                },
                {
                    id: 2,
                    Code: "COMPSS",
                    Description: "Compassionate Leave",
                    Days: "3.00",
                    InActive: 0,
                    Accrue_Days: 0,
                    Unlimited_Days: 0,
                    Gender: "both",
                    Balance: "Ignore",
                    Inclusive_of_Holidays: 0,
                    Max_Carry_Forward_Days: "0.00",
                    Off_Holidays_Days_Leave: 0,
                    Nav_Sync: 1,
                    Web_Sync: 1,
                    Nav_Sync_TimeStamp: "0001-01-01 00:00:00",
                    Web_Sync_TimeStamp: "0001-01-01 00:00:00",
                    created_at: "2018-03-19 12:34:04",
                    updated_at: "2018-03-19 12:34:04"
                },
                {
                    id: 3,
                    Code: "MATERNITY",
                    Description: "Maternity Leave",
                    Days: "90.00",
                    InActive: 0,
                    Accrue_Days: 0,
                    Unlimited_Days: 0,
                    Gender: "Female",
                    Balance: "Ignore",
                    Inclusive_of_Holidays: 1,
                    Max_Carry_Forward_Days: "0.00",
                    Off_Holidays_Days_Leave: 0,
                    Nav_Sync: 1,
                    Web_Sync: 1,
                    Nav_Sync_TimeStamp: "0001-01-01 00:00:00",
                    Web_Sync_TimeStamp: "0001-01-01 00:00:00",
                    created_at: "2018-03-19 12:34:04",
                    updated_at: "2018-03-19 12:34:04"
                },
                {
                    id: 4,
                    Code: "OFFDAY",
                    Description: "Off Days",
                    Days: "0.00",
                    InActive: 0,
                    Accrue_Days: 0,
                    Unlimited_Days: 0,
                    Gender: "both",
                    Balance: "Ignore",
                    Inclusive_of_Holidays: 0,
                    Max_Carry_Forward_Days: "0.00",
                    Off_Holidays_Days_Leave: 1,
                    Nav_Sync: 1,
                    Web_Sync: 1,
                    Nav_Sync_TimeStamp: "0001-01-01 00:00:00",
                    Web_Sync_TimeStamp: "0001-01-01 00:00:00",
                    created_at: "2018-03-19 12:34:05",
                    updated_at: "2018-03-19 12:34:05"
                },
                {
                    id: 6,
                    Code: "SICK",
                    Description: "Sick Leave",
                    Days: "7.00",
                    InActive: 0,
                    Accrue_Days: 1,
                    Unlimited_Days: 0,
                    Gender: "both",
                    Balance: "Ignore",
                    Inclusive_of_Holidays: 0,
                    Max_Carry_Forward_Days: "0.00",
                    Off_Holidays_Days_Leave: 0,
                    Nav_Sync: 1,
                    Web_Sync: 1,
                    Nav_Sync_TimeStamp: "0001-01-01 00:00:00",
                    Web_Sync_TimeStamp: "0001-01-01 00:00:00",
                    created_at: "2018-03-19 12:34:05",
                    updated_at: "2018-03-19 12:34:05"
                }
            ];
        }
    },
    methods: {
        initBarCharts: function(val) {
            this.initChartLabels(val);

            for (let dataset in this.datasets) {
                // loop through each data set
                for (let label in this.labels) {
                    // loop through the set labels
                    for (let v in val) {
                        // loop through leave allocations
                        if (this.labels[label] === val[v].LTypes_Description) {
                            // if leave matches the label
                            this.datasets[dataset].data.push(
                                val[v][this.leaveStats[dataset]]
                            );
                        }
                    }
                }
            }
        },
        initDoughnutChart: function(val) {
            for (let label in this.labels) {
                this.doughnutData[label] = 0;
                for (let v in val) {
                    if (this.labels[label] === val[v].LTypes_Description) {
                        this.doughnutData[label] =
                            parseInt(val[v][this.leaveStats[2]]) +
                            this.doughnutData[label];
                    }
                }
            }
        },
        initChartLabels: function(val) {
            // reset the labels array
            this.labels = [];
            for (let i in val) {
                this.labels.push(val[i].LTypes_Description);
            }
        }
    }
};
</script>

<style scoped></style>
