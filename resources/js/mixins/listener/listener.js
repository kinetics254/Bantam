const listener = {
    mounted: function() {
        // Global Event Listeners
        Event.$on("login", () => {
            window.location = "/";
        });

        Event.$on("logout", () => {
            this.$router.push("/auth/login");
        });

        Event.$on("ApiError", (status, message) => {
            this.$toasted.show(message, {
                position: "top-center",
                keepOnHover: true,
                iconPack: "fontawesome",
                duration: 7000,
                type: "error",
                icon: "exclamation-circle",
                closeOnSwipe: true
            });
        });

        Event.$on("duplicate", () => {
            this.$toasted.show("Cannot add duplicate timesheet", {
                position: "top-center",
                keepOnHover: true,
                iconPack: "fontawesome",
                duration: 7000,
                type: "error",
                icon: "exclamation-circle",
                closeOnSwipe: true
            });
        });
    }
};
export default listener;
