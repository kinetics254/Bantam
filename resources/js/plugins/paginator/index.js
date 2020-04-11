import Pagination from "./paginate";
import store from "./store";

const Paginator = {
    install(Vue, options) {
        options.store.registerModule("paginator", store);

        this.onPaginate = new Vue();

        Vue.component("pagination", Pagination);

        Vue.mixin({
            computed: {
                paginator() {
                    return this.$store.getters["paginator/paginator"];
                }
            },
            methods: {
                paginate: function(data) {
                    this.$store.commit("paginator/SET_PAGINATOR", data);
                    return data.data || data;
                }
            }
        });
    }
};

export default Paginator;
