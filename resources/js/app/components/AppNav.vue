<template>
    <nav
        class="navbar navbar-static-top"
        role="navigation"
        style="margin-bottom: 0"
    >
        <div class="navbar-header">
            <a
                class="navbar-minimalize minimalize-styl-2 btn btn-primary "
                href="#"
                ><i class="fa fa-bars"></i>
            </a>
        </div>
        <ul class="nav navbar-top-links navbar-right">
            <li>
                <span class="m-r-sm text-muted welcome-message">{{
                    today.toLocaleDateString("en-US", options)
                }}</span>
            </li>
            <li class="dropdown">
                <a
                    class="dropdown-toggle count-info"
                    data-toggle="dropdown"
                    href="#"
                >
                    <i class="fa fa-bell"></i>
                    <span class="label label-primary"></span>
                </a>
                <ul class="dropdown-menu dropdown-alerts"></ul>
            </li>
            <li>
                <a title="Sign out" @click="$auth.logout()">
                    <i class="fa fa-sign-out-alt"></i>
                </a>
            </li>
        </ul>
    </nav>
</template>

<script>
export default {
    name: "AppNav",
    data: function() {
        return {
            today: new Date(),
            options: {
                weekday: "long",
                year: "numeric",
                month: "long",
                day: "numeric"
            }
        };
    }
};
</script>

<style scoped></style>
