import filterView from "./filter-view";
export default {
    install(Vue) {
        this.onStatus = new Vue();
        Vue.component("status-filter", filterView);
    }
};
