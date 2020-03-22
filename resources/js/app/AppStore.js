export default {
    state: {
        notifications: [],
        sideLinks: []
    },
    mutations: {
        ADD_LINK: (state, link) => {
            if (state.sideLinks.find(l => l.name === link.name) === undefined)
                state.sideLinks.push(link);
        },
        RESET: state => {
            for (const key in state) state[key] = [];
        }
    },
    getters: {
        links: state => state.sideLinks
    },
    actions: {}
};
