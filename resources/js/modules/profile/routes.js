import AppDashboard from "../../app/layout/AppDashboard";
import Auth from "../../router/middleware/Auth";
import Profile from "./views/Profile";

export default [
    {
        path: "/profile",
        component: AppDashboard,
        children: [
            {
                path: "",
                components: {
                    view: Profile
                },
                meta: { middleware: Auth, breadcrumb: "Profile" }
            }
        ]
    }
];
