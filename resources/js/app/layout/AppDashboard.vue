<template>
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <Side />
            </div>
        </nav>
        <Page />
    </div>
</template>

<script>
import Side from "./AppSide";
import Page from "./AppPage";
import AppStore from "../AppStore";
export default {
    name: "AppDashboard",
    components: { Page, Side },
    beforeCreate() {
        if (!this.$store._modules.root._children[`app`]) {
            this.$store.registerModule("app", AppStore);
        }
    }
};
</script>

<style scoped></style>
