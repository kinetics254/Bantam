import Vue from "vue";
import Vuex from "vuex";
import VuexPersist from "vuex-persist";
import auth from "../plugins/auth/store";
import AppStore from "../app/AppStore";

Vue.use(Vuex);

const vuexLocalStorage = new VuexPersist({
    key: "vuex",
    storage: window.localStorage,
    modules: ["auth"]
});

export default new Vuex.Store({
    state: {},
    mutations: {},
    getters: {},
    actions: {},
    modules: {
        app: AppStore,
        auth: auth
    },
    plugins: [vuexLocalStorage.plugin]
});
