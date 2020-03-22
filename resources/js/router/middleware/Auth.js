import authService from "../../plugins/auth/service";
export default function auth({ next, router }) {
    if (!authService.check()) {
        return router.push({ name: "login" });
    }
    return next();
}
