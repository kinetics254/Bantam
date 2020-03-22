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
export default {
    name: "AppDashboard",
    components: { Page, Side }
};
</script>

<style scoped></style>
