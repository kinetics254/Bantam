import call from "../../service/http";
import constants from "./constants";

export default {
    namespaced: true,
    state: {
        employees: [],
        applications: [],
        historicalApplications: [],
        allocations: [],
        leaveTypes: [],
        disabledDays: [],
        applicationDetails: {},
        leaveDates: {}
    },
    mutations: {
        SET_EMPLOYEES: (state, payload) => {
            state.employees = payload;
        },
        SET_APPLICATIONS: (state, payload) => {
            state.applications = payload;
        },
        SET_ALLOCATIONS: (state, payload) => {
            state.allocations = payload;
        },
        SET_HISTORICAL_APPLICATIONS: (state, payload) => {
            state.historicalApplications = payload;
        },
        SET_LEAVE_TYPES: (state, payload) => {
            state.leaveTypes = payload;
        },
        SET_DISABLED_DAYS: (state, payload) => {
            state.disabledDays = payload;
        },
        SET_APPLICATION_DETAILS: (state, payload) => {
            state.applicationDetails = payload;
        },
        SET_LEAVE_DATES: (state, payload) => {
            state.leaveDates = payload;
        }
    },
    getters: {
        employees: state => state.employees,
        applications: state => state.applications,
        allocations: state => state.allocations,
        historicalApplications: state => state.historicalApplications,
        leaveTypes: state => state.leaveTypes,
        disabledDays: state => state.disabledDays,
        applicationDetails: state => state.applicationDetails,
        leaveDates: state => state.leaveDates
    },
    actions: {
        getApplications: (context, url) => {
            call("get", url || constants.applications).then(res => {
                context.commit("SET_APPLICATIONS", res.data);
            });
        },
        getHistoricalApplications: (context, url) => {
            call("get", url || constants.historicalApplications).then(res => {
                context.commit("SET_HISTORICAL_APPLICATIONS", res.data);
            });
        },
        getAllocations: (context, data) => {
            call("get", data.url || constants.allocations(data.id)).then(
                res => {
                    context.commit("SET_ALLOCATIONS", res.data);
                }
            );
        },
        getLeaveTypes: context => {
            call("get", constants.leaveTypes).then(res => {
                context.commit("SET_LEAVE_TYPES", res.data.data);
            });
        },
        getDisabledDays: context => {
            call("get", constants.disablesDays).then(res => {
                context.commit("SET_DISABLED_DAYS", res.data.data);
            });
        },
        getApplicationDetails: (context, id) => {
            call("get", constants.applicationsDetails(id)).then(res => {
                context.commit("SET_APPLICATION_DETAILS", res.data.data);
            });
        },
        getEmployees: (context, department) => {
            call("get", constants.departmentEmployees(department)).then(res => {
                context.commit("SET_EMPLOYEES", res.data.data);
            });
        },
        statusChange: ({ dispatch }, data) => {
            call("post", constants.statusChange(data.id), data.data).then(
                () => {
                    dispatch("getApplications", null);
                }
            );
        },
        calculateDates: (context, data) => {
            call("post", constants.calculateDates, data).then(res => {
                context.commit("SET_LEAVE_DATES", res.date);
            });
        },
        submitApplication: ({ dispatch }, data) => {
            call("post", constants.submitApplication, data).then(() => {
                dispatch("getApplications", null);
            });
        }
    }
};
