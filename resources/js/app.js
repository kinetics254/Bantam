import "./bootstrap";
import Vue from "vue";
import { router } from "./router";
import store from "./store";
import auth from "./plugins/auth";
import dashboard from "./modules/dashboard/";
import profile from "./modules/profile/";
import leave from "./modules/leave";
import payslip from "./modules/payslip";
import timesheet from "./modules/timesheet";
import { filters } from "./utilities";
import { listener, status } from "./mixins";
import * as Sentry from "@sentry/browser";
import * as Integrations from "@sentry/integrations";
import app from "./app/layout/AppDashboard";
import breadCrumb from "vue-breadcrumbs";

Sentry.init({
    dsn: "https://763982db792b4a178c4f376211cbb364@sentry.io/5169173",
    integrations: [new Integrations.Vue({ Vue, attachProps: true })]
});

const options = { router, store };

/* plugins/modules registration*/
Vue.use(auth, options);
Vue.use(dashboard, options);
Vue.use(profile, options);
Vue.use(leave, options);
Vue.use(payslip, options);
Vue.use(timesheet, options);
Vue.use(breadCrumb, {
    template: ` <ol class="breadcrumb m-t" style="cursor: pointer" v-if="$breadcrumbs.length"><li v-for="(crumb, key) in $breadcrumbs"><small class="text-muted"><a  :key="key">{{ crumb | crumbText | capitalize }}</a></small></li></ol>`
});

// eslint-disable-next-line no-global-assign
Event = new Vue();

Vue.prototype.appName = process.env.MIX_VUE_APP_NAME;

filters.forEach(f => {
    Vue.filter(f.name, f.execute);
});

Vue.component("app", app.default);

// eslint-disable-next-line no-unused-vars
const vueApp = new Vue({
    el: "#app",
    router,
    store,
    mixins: [status, listener]
});
