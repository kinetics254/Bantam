import LeaveDashboard from "./views/components/LeaveDashboard";
import TimeSheetDashboard from "./views/components/TimeSheetDashboard";
import AppDashboard from "../../app/layout/AppDashboard";
import Auth from "../../router/middleware/Auth";

export default [
    {
        path: "/dashboard",
        component: AppDashboard,
        children: [
            {
                path: "",
                redirect: "/dashboard/leave"
            },
            {
                path: "leave",
                components: {
                    view: LeaveDashboard
                },
                meta: { middleware: Auth, breadcrumb: "Leave Dashboard" }
            },
            {
                path: "time-sheet",
                components: {
                    view: TimeSheetDashboard
                },
                meta: { middleware: Auth, breadcrumb: "Time Sheet Dashboard" }
            }
        ]
    }
];
