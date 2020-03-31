<template>
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Timesheet summaries</h5>
                </div>
                <div class="ibox-content" :class="{ 'sk-loading': loading }">
                    <spinner v-if="loading" />

                    <div class="row">
                        <div class="col-md-6 p-lg">
                            <h5>Projects</h5>
                            <bar-chart :data="datasets" :options="options" />
                        </div>
                        <div class="col-md-6 p-lg">
                            <h5>Activities</h5>
                            <bar-chart :data="datasets" :options="options" />
                        </div>
                        <div class="col-md-12 -right p-lg">
                            <h5>Employees</h5>
                            <bar-chart :data="datasets" :options="options" />
                        </div>
                    </div>
                </div>
            </div>
        </div></div
></template>

<script>
import PaginationMixin from "../../../../plugins/paginator/paginator";
import LoadingMixin from "../../../../mixins/loader/loader";
import Spinner from "../../../../components/Spinner";
import { BarChart } from "../../../../charts";

export default {
    name: "TimeSheetDashboard",
    components: { Spinner, BarChart },
    mixins: [LoadingMixin, PaginationMixin],
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
    }
};
</script>

<style scoped></style>
