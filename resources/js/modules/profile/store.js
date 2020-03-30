import call from "../../service/http";
import constants from "./constants";

export default {
    namespaced: true,
    state: {
        employee: {}
    },
    mutation: {
        SET_EMPLOYEE: (state, payload) => {
            state.employee = payload;
        }
    },
    getters: {
        employee: state => state.employee
    },
    actions: {
        getEmployee: (context, id) => {
            call("get", constants.employee(id)).then(res => {
                context.commit("SET_EMPLOYEE", res.data.data);
            });
        }
    }
};
