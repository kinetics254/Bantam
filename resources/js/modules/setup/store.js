import call from "../../service/http";
import constants from "./constants";

export default {
    namespaced: true,
    state: {
        employees: [],
        projects: [],
        activities: [],
        tasks: [],
        locations: []
    },
    mutations: {
        SET_EMPLOYEES: (state, payload) => {
            state.employees = payload;
        },
        SET_PROJECTS: (state, payload) => {
            state.projects = payload;
        },
        SET_ACTIVITIES: (state, payload) => {
            state.activities = payload;
        },
        SET_TASKS: (state, payload) => {
            state.tasks = payload;
        },
        SET_LOCATIONS: (state, payload) => {
            state.locations = payload;
        }
    },
    getters: {
        employees: state => state.employees,
        projects: state => state.projects,
        activities: state => state.activities,
        tasks: state => state.tasks,
        locations: state => state.locations
    },
    actions: {
        getEmployees: context => {
            call("get", constants.employees).then(res => {
                context.commit("SET_EMPLOYEES", res.data.data);
            });
        },
        getProjects: context => {
            call("get", constants.projects).then(res => {
                context.commit("SET_PROJECTS", res.data.data);
            });
        },
        getActivities: context => {
            call("get", constants.activities).then(res => {
                context.commit("SET_ACTIVITIES", res.data.data);
            });
        },
        getTasks: context => {
            call("get", constants.tasks).then(res => {
                context.commit("SET_TASKS", res.data.data);
            });
        },
        getLocation: context => {
            call("get", constants.locations).then(res => {
                context.commit("SET_LOCATIONS", res.data.data);
            });
        }
    }
};
