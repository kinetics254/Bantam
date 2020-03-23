import Pagination from "./paginate";

const Paginator = {
    install(Vue) {
        this.onPaginate = new Vue();

        Vue.component("pagination", Pagination);

        Vue.prototype.$paginate = {
            on(param) {
                Paginator.onPaginate.$emit("paginate", param);
            },
            jumpToPage(page) {
                Paginator.onPaginate.$emit("jump-to", page);
            }
        };
    }
};

export default Paginator;
