import AppDashboard from "../../app/layout/AppDashboard";
import Auth from "../../router/middleware/Auth";
import TimesheetList from "./views/TimesheetList";
export default [
    {
        path: "/time-sheet",
        component: AppDashboard,
        children: [
            {
                path: "",
                redirect: "/time-sheet/sheet"
            },
            {
                path: "sheet",
                components: {
                    view: TimesheetList
                },
                meta: { middleware: Auth, breadcrumb: "Time Sheets" }
            }
        ]
    }
];
