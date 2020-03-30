import call from "../../service/http";
import constants from "./constants";

export default {
    namespaced: true,
    state: {
        employee: {}
    },
    mutations: {
        SET_EMPLOYEE: (state, payload) => {
            state.employee = payload;
        }
    },
    getters: {
        employee: state => state.employee
    },
    actions: {
        getEmployee: (conext, id) => {
            call("get", constants.employee(id)).then(res => {
                conext.commit("SET_EMPLOYEE", res.data.data);
            });
        }
    }
};
