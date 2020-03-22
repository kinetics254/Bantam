import constants from "./constants";
import call from "../../service/http";

export default {
    namespaced: true,
    state: {
        creds: {
            token: "",
            user: ""
        }
    },
    mutations: {
        SET_AUTH: (state, logins) => {
            for (const key in state.creds) {
                state.creds[key] = logins[key];
            }
        },
        UNSET_AUTH: state => {
            // eslint-disable-next-line guard-for-in,no-restricted-syntax
            for (const key in state.creds) {
                state.creds[key] = "";
            }
        }
    },
    getters: {
        token: state => state.creds.token,
        user: state => state.creds.user
    },
    actions: {
        login: (context, data) => {
            call("post", constants.login, data).then(res => {
                context.commit("SET_AUTH", res.data);
                Event.$emit("login");
            });
        },
        logout: context => {
            call("post", constants.logout).then(() => {
                context.commit("UNSET_AUTH");
                Event.$emit("logout");
            });
        }
    }
};
