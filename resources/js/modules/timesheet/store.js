import call from "../../service/http";
import constants from "./constants";

export default {
    namespaced: true,
    state: {
        timesheets: [],
        projects: [],
        activities: [],
        task: []
    },
    mutations: {
        SET_TIMESHEET: (state, payload) => {
            state.timesheets = payload;
        },
        SET_PROJECTS: (state, payload) => {
            state.projects = payload;
        },
        SET_ACTIVITIES: (state, payload) => {
            state.activities = payload;
        },
        SET_TASKS: (state, payload) => {
            state.tasks = payload;
        }
    },
    getters: {
        timesheets: state => state.timesheets
    },
    actions: {
        getTimeSheet: (context, url) => {
            call("get", url || constants.timesheet).then(res => {
                context.commit("SET_TIMESHEET", res.data);
            });
        }
    }
};
