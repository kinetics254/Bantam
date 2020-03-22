import Vue from "vue";
import Vuex from "vuex";
import VuexPersist from "vuex-persist";
import store from "../plugins/auth/store";

Vue.use(Vuex);

const vuexLocalStorage = new VuexPersist({
    key: "vuex",
    storage: window.localStorage
});

export default new Vuex.Store({
    state: {},
    mutations: {},
    getters: {},
    actions: {},
    modules: {
        auth: store
    },
    plugins: [vuexLocalStorage.plugin]
});
