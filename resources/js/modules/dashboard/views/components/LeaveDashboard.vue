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
                            <bar-chart
                                style="height: 500px"
                                :chart-data="barChart.chart"
                                :options="barChart.options"
                            />
                        </div>
                        <div class="col-md-6 p-lg">
                            <doughnut-chart
                                :chart-data="doughnutChart.chart"
                                :options="doughnutChart.options"
                            />
                        </div>
                        <div class="col-md-6 p-lg">
                            <pie-chart
                                :chart-data="pieChart.chart"
                                :options="pieChart.options"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { BarChart, DoughnutChart, PieChart } from "../../../../charts";
import PaginationMixin from "../../../../plugins/paginator/paginator";
import Spinner from "../../../../plugins/loader/views/Spinner";

export default {
    name: "LeaveDashboard",
    components: { Spinner, BarChart, DoughnutChart, PieChart },
    mixins: [PaginationMixin],
    data: function() {
        return {
            barChart: {
                chart: {},
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    title: {
                        display: true,
                        position: "top",
                        text: "Leave summary"
                    },
                    scales: {
                        xAxes: [
                            {
                                stacked: false,
                                gridLines: { display: false },
                                ticks: {
                                    beginAtZero: true
                                }
                            }
                        ],
                        yAxes: [
                            {
                                stacked: false,
                                ticks: {
                                    beginAtZero: true
                                }
                            }
                        ]
                    }
                }
            },
            doughnutChart: {
                chart: {},
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    pieceLabel: {
                        mode: "percentage",
                        precision: 1
                    },
                    title: {
                        display: true,
                        position: "top",
                        text: "Leave Taken summary"
                    }
                }
            },
            pieChart: {
                chart: {},
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    pieceLabel: {
                        mode: "percentage",
                        precision: 1
                    },
                    title: {
                        display: true,
                        position: "top",
                        text: "Annual Leave Summary"
                    }
                }
            }
        };
    },
    beforeRouteEnter(to, from, next) {
        next(v => {
            v.$store.dispatch("leave/getLeaveTypes");
            v.$store.dispatch("profile/getEmployee", v.$auth.user().id);
            v.$store.dispatch("leave/getAllocations", {
                id: v.$auth.user().id
            });
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
                    Taken: "10.00",
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
                    Taken: "5.00",
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
                    Taken: "1.00",
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
    mounted() {
        this.initBarCharts();
        this.initDoughnutChart();
        this.initPieChart();
    },
    methods: {
        initBarCharts: function() {
            let chart = {
                labels: [],
                datasets: [
                    {
                        label: "Allocated_Days",
                        backgroundColor: "rgba(255,177,193,0.56)",
                        borderColor: "#FFB1C1",
                        borderWidth: "1",
                        data: []
                    },
                    {
                        label: "Accrued_Days",
                        backgroundColor: "rgba(255,159,64,0.57)",
                        borderColor: "#ff9f40",
                        borderWidth: "1",
                        data: []
                    },
                    {
                        label: "Taken",
                        backgroundColor: "rgba(255,225,153,0.57)",
                        borderColor: "#ffe199",
                        borderWidth: "1",
                        data: []
                    },
                    {
                        label: "Balance",
                        backgroundColor: "rgba(147,217,217,0.56)",
                        borderColor: "#93d9d9",
                        borderWidth: "1",
                        data: []
                    }
                ]
            };

            let allocations = [...this.leaveAllocations];

            /* set labels */
            allocations.forEach(allocation => {
                chart.labels.push(allocation.LTypes_Description);
            });

            chart.labels.forEach(label => {
                allocations.forEach(allocation => {
                    if (allocation.LTypes_Description === label) {
                        chart.datasets.forEach(set => {
                            set.data.push(parseInt(allocation[set.label]));
                        });
                    }
                });
            });

            this.barChart.chart = chart;
        },
        initDoughnutChart: function() {
            let chart = {
                labels: [],
                datasets: [
                    {
                        backgroundColor: [
                            "rgba(255,177,193,0.56)",
                            "rgba(255,159,64,0.57)",
                            "rgba(255,225,153,0.57)",
                            "rgba(147,217,217,0.56)"
                        ],
                        data: []
                    }
                ]
            };

            let allocations = [...this.leaveAllocations];

            allocations.forEach(allocation => {
                chart.labels.push(allocation.LTypes_Description);
                chart.datasets[0].data.push(parseInt(allocation.Taken));
            });

            this.doughnutChart.chart = chart;
        },
        initPieChart: function() {
            let allocation = [...this.leaveAllocations]
                .filter(aloc => {
                    return aloc.Leave_Code === "ANNUAL";
                })
                .shift();

            let chart = {
                labels: ["Accrued_Days", "Allocated_Days", "Taken", "Balance"],
                datasets: [
                    {
                        backgroundColor: [
                            "rgba(255,177,193,0.56)",
                            "rgba(255,159,64,0.57)",
                            "rgba(255,225,153,0.57)",
                            "rgba(147,217,217,0.56)"
                        ],
                        data: [
                            allocation.Accrued_Days,
                            allocation.Allocated_Days,
                            allocation.Taken,
                            allocation.Balance
                        ]
                    }
                ]
            };

            this.pieChart.chart = chart;
        }
    }
};
</script>

<style scoped></style>
