export default {
    state: {
        notifications: [],
        sideLinks: [
            {
                name: "Link",
                icon: "fa-gavel",
                to: "/cases",
                subs: [
                    {
                        name: "sub link",
                        icon: "fa-comments",
                        to: "/complaint"
                    }
                ]
            }
        ]
    },
    mutations: {
        ADD_LINK: (state, link) => {
            state.sideLinks.push(link);
        }
    },
    getters: {
        links: state => state.sideLinks
    },
    actions: {}
};
