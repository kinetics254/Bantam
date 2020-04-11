import "./bootstrap";
import Vue from "vue";
import "pace-js";
import { router } from "./router";
import store from "./store";
import { filters } from "./utilities";
import { listener, status } from "./mixins";
import loader from "./plugin-loader";

loader.boot({ router, store });

// eslint-disable-next-line no-global-assign
Event = new Vue();

Vue.prototype.appName = process.env.MIX_VUE_APP_NAME;

filters.forEach(f => {
    Vue.filter(f.name, f.execute);
});

new Vue({
    el: "#app",
    router,
    store,
    mixins: [status, listener]
});
