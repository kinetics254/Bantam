<template>
    <li class="nav-header">
        <div class="dropdown profile-element text-center">
            <span>
                <avatar size="80" class="img-circle" />
            </span>
            <a data-toggle="dropdown" class="dropdown-toggle " href="#">
                <span class="clear">
                    <br />
                    <span class="text-uppercase block"
                        >{{ user }} <b class="caret"></b
                    ></span>
                </span>
            </a>
            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                <li><a>Profile</a></li>
                <li><a>Settings</a></li>
            </ul>
        </div>
        <div
            class="logo-element navy-bg"
            style="cursor: pointer"
            @click="$router.push('/')"
        >
            LSK
        </div>
    </li>
</template>

<script>
import Avatar from "../../components/Avatar";

export default {
    name: "AppAccount",
    components: { Avatar },
    data: function() {
        return {
            baseUrl: process.env.BASE_URL
        };
    },
    computed: {
        user() {
            return "test user";
        }
    }
};
</script>

<style scoped></style>
