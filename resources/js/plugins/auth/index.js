import routes from "./routes";
import service from "./service";
export default {
    install(Vue, options) {
        options.router.addRoutes(routes);
        Vue.prototype.$auth = service;
    }
};
