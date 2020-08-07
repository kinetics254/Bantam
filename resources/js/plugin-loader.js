import Vue from "vue";
import auth from "./plugins/auth";
import dashboard from "./modules/dashboard/";
import loader from "./plugins/loader/";
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
import breadCrumb from "vue-breadcrumbs";

const plugins = [
    loader,
    [auth, { name: "auth module" }],
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
    confirmation,
    [
        breadCrumb,
        {
            template: ` <ol class="breadcrumb m-t" style="cursor: pointer" v-if="$breadcrumbs.length"><li v-for="(crumb, key) in $breadcrumbs"><small class="text-muted"><a  :key="key">{{ crumb | crumbText | capitalize }}</a></small></li></ol>`
        }
    ]
];

const pluginLoader = {
    boot: args => {
        let options;
        plugins.forEach(plugin => {
            try {
                options = {};
                plugin = Array.isArray(plugin) ? plugin : [plugin, options];
                options = typeof plugin[1] === "object" ? plugin[1] : {};
                Vue.use(plugin.shift(), { ...args, ...options });
            } catch (e) {
                console.log(e);
            }
        });
    }
};

export default pluginLoader;
