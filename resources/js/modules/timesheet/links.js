export default {
    order: 2,
    name: "Time Sheet",
    icon: "fa-clipboard-list",
    to: "/time-sheet",
    subs: [
        {
            name: "Time Sheet",
            icon: "fa-file-contract",
            to: "/time-sheet/sheet"
        },
        {
            name: "Employees",
            icon: "fa-users",
            to: "/time-sheet/employees"
        },
        {
            name: "Locations",
            icon: "fa-map-marked",
            to: "/time-sheet/locations"
        },
        {
            name: "Projects",
            icon: "fa-briefcase",
            to: "/time-sheet/projects"
        },
        {
            name: "Activities",
            icon: "fa-th-list",
            to: "/time-sheet/activities"
        },
        {
            name: "Tasks",
            icon: "fa-tasks",
            to: "/time-sheet/tasks"
        }
    ]
};
