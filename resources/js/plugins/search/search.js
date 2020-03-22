import Search from "./index";

const SearchMixin = {
    mounted() {
        Search.onSearch.$on("search", term => {
            this.search(term);
        });
    }
};

export default SearchMixin;
