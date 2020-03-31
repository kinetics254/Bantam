import call from "../../service/http";
import constants from "./constants";

export default {
    namespaced: true,
    state: {
        periods: []
    },
    mutations: {
        SET_PERIODS: (state, payload) => {
            state.periods = payload;
        }
    },
    getters: {
        periods: state => state.periods
    },
    actions: {
        getPeriods: context => {
            call("get", constants.periods).then(res => {
                context.commit("SET_PERIODS", res.data);
            });
        },
        getPayslip: (context, period) => {
            window.open(constants.payslip(period), "_blank");
        }
    }
};
