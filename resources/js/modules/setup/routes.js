import AppDashboard from "../../app/layout/AppDashboard";
import Auth from "../../router/middleware/Auth";
import Employees from "./views/Employees";
import Projects from "./views/Projects";
import Activities from "./views/Activities";
import Tasks from "./views/Tasks";
import Locations from "./views/Locations";

export default [
    {
        path: "/setup",
        component: AppDashboard,
        children: [
            {
                path: "",
                redirect: "/setup/employees"
            },
            {
                path: "employees",
                components: {
                    view: Employees
                },
                meta: { middleware: Auth, breadcrumb: "Employees" }
            },
            {
                path: "projects",
                components: {
                    view: Projects
                },
                meta: { middleware: Auth, breadcrumb: "Projects" }
            },
            {
                path: "activities",
                components: {
                    view: Activities
                },
                meta: { middleware: Auth, breadcrumb: "Activities" }
            },
            {
                path: "tasks",
                components: {
                    view: Tasks
                },
                meta: { middleware: Auth, breadcrumb: "Tasks" }
            },
            {
                path: "locations",
                components: {
                    view: Locations
                },
                meta: { middleware: Auth, breadcrumb: "Locations" }
            }
        ]
    }
];
