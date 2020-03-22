<template>
    <div id="page-wrapper" class="gray-bg" style="min-height: 635px;">
        <div class="row border-bottom">
            <app-nav />
        </div>
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-6">
                <app-bread-crumb />
            </div>
            <div class="col-lg-6">
                <router-view name="action"></router-view>
            </div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <router-view name="view"></router-view>
        </div>
        <app-footer />
    </div>
</template>

<script>
import AppNav from "../components/AppNav";
import AppBreadCrumb from "../components/AppBreadCrumb";
import AppFooter from "./AppFooter";

export default {
    name: "AppPage",
    components: { AppFooter, AppBreadCrumb, AppNav }
};
</script>

<style scoped>
.router-link-exact-active {
    font-weight: bold;
}
</style>
