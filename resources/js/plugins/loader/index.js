import Spinner from "./views/Spinner";
import store from "./store";

export default {
    install(Vue, options) {
        options.store.registerModule("loader", store);

        Vue.component("loader", Spinner);
        Vue.mixin({
            computed: {
                loading() {
                    return this.$store.getters["loader/loading"];
                }
            },
            mounted() {
                window.Pace.on("start", function() {
                    Event.$emit("loading", true);
                });

                window.Pace.on("stop", function() {
                    Event.$emit("loading", false);
                });

                window.Pace.on("done", function() {
                    Event.$emit("loading", false);
                });

                window.Pace.on("hide", function() {
                    Event.$emit("loading", false);
                });

                window.Pace.on("restart", function() {
                    Event.$emit("loading", true);
                });

                Event.$on("loading", state => {
                    this.$store.commit("loader/SET_LOADING", state);
                });
            }
        });
    }
};
