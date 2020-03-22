import AppDashboard from "../../app/layout/AppDashboard";
import Auth from "../../router/middleware/Auth";
import TimesheetList from "./views/TimesheetList";
import TimesheetCard from "./views/TimesheetCard";

export default [
    {
        path: "/time-sheet",
        component: AppDashboard,
        children: [
            {
                path: "",
                components: {
                    view: TimesheetList
                },
                meta: { middleware: Auth, breadcrumb: "Time Sheets" }
            },
            {
                path: ":id",
                components: {
                    view: TimesheetCard
                },
                meta: { middleware: Auth, breadcrumb: "Time Sheet" }
            }
        ]
    }
];
