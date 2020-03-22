import SearchComponent from "./view/search";
import _ from "lodash";

const SearchPlugin = {
    install(Vue) {
        this.onSearch = new Vue();

        Vue.component("search", SearchComponent);

        Vue.prototype.$search = _.debounce(term => {
            SearchPlugin.onSearch.$emit("search", term);
        }, 500);
    }
};

export default SearchPlugin;
