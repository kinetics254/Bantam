export default {
    order: 0,
    name: "Dashboard",
    icon: "fa-tachometer-alt",
    to: "/dashboard",
    subs: [
        {
            name: "Leave",
            icon: "fa-chart-bar",
            to: "/dashboard/leave"
        },
        {
            name: "Time sheet",
            icon: "fa-chart-pie",
            to: "/dashboard/time-sheet"
        }
    ]
};
