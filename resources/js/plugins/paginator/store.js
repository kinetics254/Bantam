export default {
    namespaced: true,
    state: {
        paginator: {}
    },
    mutations: {
        SET_PAGINATOR: (state, payload) => {
            state.paginator = payload;
        }
    },
    getters: {
        paginator: state => state.paginator
    }
};
