import "./bootstrap";
import Vue from "vue";
import { router } from "./router";
import store from "./store";
import { filters } from "./utilities";
import { listener, status } from "./mixins";
import * as Sentry from "@sentry/browser";
import * as Integrations from "@sentry/integrations";
import app from "./app/layout/AppDashboard";
import breadCrumb from "vue-breadcrumbs";
import init from "./plugins";

Sentry.init({
    dsn: "https://763982db792b4a178c4f376211cbb364@sentry.io/5169173",
    integrations: [new Integrations.Vue({ Vue, attachProps: true })]
});

init({ router, store });

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
