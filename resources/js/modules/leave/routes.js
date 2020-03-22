import AppDashboard from "../../app/layout/AppDashboard";
import Auth from "../../router/middleware/Auth";
import LeaveApplication from "./views/LeaveApplication";
import LeaveAllocation from "./views/LeaveAllocation";
import LeaveHistory from "./views/LeaveHistory";
import LeavePlanner from "./views/LeavePlanner";

export default [
    {
        path: "/leave",
        component: AppDashboard,
        children: [
            {
                path: "",
                redirect: "/leave/application"
            },
            {
                path: "application",
                components: {
                    view: LeaveApplication
                },
                meta: { middleware: Auth, breadcrumb: "Leave Applications" }
            },
            {
                path: "allocation",
                components: {
                    view: LeaveAllocation
                },
                meta: { middleware: Auth, breadcrumb: "Leave Allocations" }
            },
            {
                path: "history",
                components: {
                    view: LeaveHistory
                },
                meta: { middleware: Auth, breadcrumb: "Leave History" }
            },
            {
                path: "planner",
                components: {
                    view: LeavePlanner
                },
                meta: { middleware: Auth, breadcrumb: "Leave Planner" }
            }
        ]
    }
];
