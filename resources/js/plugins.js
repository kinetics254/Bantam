import Vue from "vue";
import auth from "./plugins/auth";
import dashboard from "./modules/dashboard/";
import profile from "./modules/profile/";
import leave from "./modules/leave";
import payslip from "./modules/payslip";
import timesheet from "./modules/timesheet";
import setup from "./modules/setup";
import statusFilter from "./plugins/status-filter";
import Toasted from "vue-toasted";
import search from "./plugins/search";
import pagination from "./plugins/paginator";
import confirmation from "./plugins/confirmation";

const plugins = [
    auth,
    dashboard,
    profile,
    leave,
    payslip,
    timesheet,
    setup,
    statusFilter,
    Toasted,
    search,
    pagination,
    confirmation
];

export default function init({ store, router }) {
    plugins.forEach(plugin => {
        Vue.use(plugin, { store, router });
    });
}
