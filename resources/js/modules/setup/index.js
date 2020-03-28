import routes from "./routes";
import store from "./store";
import links from "./links";

export default {
    install(Vue, options) {
        /* register store and routes */
        options.router.addRoutes(routes);
        options.store.registerModule("setup", store);

        /* register side links */
        options.store.commit("ADD_LINK", links);
    }
};
