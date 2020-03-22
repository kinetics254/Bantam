import Vue from "vue";
import VueRouter from "vue-router";
import nextFactory from "./middleware/MiddlewareFactory";
import AppDashboard from "../app/layout/AppDashboard";
import AppFallback from "../app/components/AppFallback";
import Auth from "./middleware/Auth";

Vue.use(VueRouter);

const routes = [
    {
        path: "/",
        component: AppDashboard,
        children: [],
        meta: { middleware: Auth, breadcrumb: "dashboard" }
    },
    {
        path: "*",
        component: AppFallback
    }
];
const router = new VueRouter({
    mode: "history",
    base: process.env.BASE_URL,
    routes
});
router.beforeEach((to, from, next) => {
    if (to.meta.middleware) {
        const middleware = Array.isArray(to.meta.middleware)
            ? to.meta.middleware
            : [to.meta.middleware];

        const context = {
            from,
            next,
            router
        };
        const nextMiddleware = nextFactory(context, middleware, 1);
        return middleware[0]({ ...context, next: nextMiddleware });
    }
    return next();
});
export default router;
