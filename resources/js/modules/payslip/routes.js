import AppDashboard from "../../app/layout/AppDashboard";
import Auth from "../../router/middleware/Auth";
import PayslipList from "./views/PayslipList";
import PayslipCard from "./views/PayslipCard";

export default [
    {
        path: "/payslip",
        component: AppDashboard,
        children: [
            {
                path: "",
                components: {
                    view: PayslipList
                },
                meta: { middleware: Auth, breadcrumb: "Payslips" }
            },
            {
                path: ":id",
                components: {
                    view: PayslipCard
                },
                meta: { middleware: Auth, breadcrumb: "Payslip" }
            }
        ]
    }
];
