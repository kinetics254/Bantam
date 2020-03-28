import call from "../../service/http";
import constants from "./constants";
import _ from "lodash";

export default {
    namespaced: true,
    state: {
        timesheets: []
    },
    mutations: {
        SET_TIMESHEET: (state, payload) => {
            state.timesheets = payload;
        },
        ADD_TIMESHEET: (state, payload) => {
            state.timesheets.data.unshift(payload);
        },
        EDIT_TIMESHEET: (state, sheet) => {
            let index = _.findIndex(state.timesheets.data, sheet);
            state.timesheets.data.splice(index, 1);
        },
        REMOVE_TIMESHEET: (state, sheet) => {
            let index = _.findIndex(state.timesheets.data, sheet);
            state.timesheets.data[index].deleted = true;
        }
    },
    getters: {
        timesheets: state => state.timesheets
    },
    actions: {
        getTimeSheets: (context, url) => {
            call("get", url || constants.timesheets).then(res => {
                context.commit("SET_TIMESHEET", res.data);
            });
        },
        saveSheets: ({ dispatch }, data) => {
            call("post", constants.timesheets, data).then(() => {
                dispatch("getTimeSheets", null);
            });
        }
    }
};
