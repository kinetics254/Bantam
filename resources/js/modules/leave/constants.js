export default {
    departmentEmployees: department => `employees?status=${department || ""}`,
    applicationsDetails: id => `leave_applications/${id}/approvals`,
    statusChange: id => `leave_applications/${id}/status`,
    allocations: id => `employee/${id}/leave_allocations`,
    disablesDays: `leave_applications/disabled_days`,
    leaveTypes: `leave_types`,
    applications: `employee/leave_applications?status[]=New&status[]=Review`,
    historicalApplications: `employee/leave_applications?status[]=Approved&status[]=Rejected'`,
    calculateDates: `leave_applications/calculate_leave_dates`,
    submitApplication: `leave_applications`
};
