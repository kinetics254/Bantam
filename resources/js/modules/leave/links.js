export default {
    order: 2,
    name: "Leave",
    icon: "fa-calendar-alt",
    to: "/leave",
    subs: [
        {
            name: "Leave Application",
            icon: "fa-file-contract",
            to: "/leave/application"
        },
        {
            name: "Leave Allocation",
            icon: "fa-tasks",
            to: "/leave/allocation"
        },
        {
            name: "Leave History",
            icon: "fa-history",
            to: "/leave/history"
        },
        {
            name: "Leave Planner",
            icon: "fa-calendar-day",
            to: "/leave/planner"
        }
    ]
};
