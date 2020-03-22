import AppDashboard from "../../app/layout/AppDashboard";
import Auth from "../../router/middleware/Auth";
import TimesheetList from "./views/TimesheetList";
import Employees from "./views/Employees";
import Projects from "./views/Projects";
import Activities from "./views/Activities";
import Tasks from "./views/Tasks";
import Locations from "./views/Locations";

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
            },
            {
                path: "employees",
                components: {
                    view: Employees
                },
                meta: { middleware: Auth, breadcrumb: "Time Sheets" }
            },
            {
                path: "projects",
                components: {
                    view: Projects
                },
                meta: { middleware: Auth, breadcrumb: "Time Sheets" }
            },
            {
                path: "activities",
                components: {
                    view: Activities
                },
                meta: { middleware: Auth, breadcrumb: "Time Sheets" }
            },
            {
                path: "tasks",
                components: {
                    view: Tasks
                },
                meta: { middleware: Auth, breadcrumb: "Time Sheets" }
            },
            {
                path: "locations",
                components: {
                    view: Locations
                },
                meta: { middleware: Auth, breadcrumb: "Time Sheets" }
            }
        ]
    }
];
