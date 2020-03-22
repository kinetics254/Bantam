import store from "../../store";
export default {
    check() {
        return !!store.getters["auth/token"];
    },
    token() {
        return store.getters["auth/token"];
    },
    user() {
        return store.getters["auth/user"];
    },
    logout() {
        store.dispatch("auth/logout");
    }
};
