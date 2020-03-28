export default {
    order: 2,
    name: "Setup",
    icon: "fa-cogs",
    to: "/setup",
    subs: [
        {
            name: "Employees",
            icon: "fa-users",
            to: "/setup/employees"
        },
        {
            name: "Locations",
            icon: "fa-map-marked",
            to: "/setup/locations"
        },
        {
            name: "Projects",
            icon: "fa-briefcase",
            to: "/setup/projects"
        },
        {
            name: "Activities",
            icon: "fa-th-list",
            to: "/setup/activities"
        },
        {
            name: "Tasks",
            icon: "fa-tasks",
            to: "/setup/tasks"
        }
    ]
};
