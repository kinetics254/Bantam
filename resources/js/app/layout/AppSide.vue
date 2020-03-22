<template>
    <ul id="side-menu" class="nav metismenu">
        <app-account />
        <li v-for="(link, i) in links" :key="i">
            <router-link v-if="!link.hasSubs" :to="!link.hasSubs ? link.to : ''"
                ><i :class="`fa ${link.icon}`"></i>
                <span class="nav-label">{{ link.name }}</span>
            </router-link>
            <a v-else>
                <i :class="`fa ${link.icon}`"></i>
                <span class="nav-label">{{ link.name }}</span>
                <span class="fa arrow"></span>
            </a>
            <ul class="nav nav-second-level collapse">
                <li v-for="(sub, idx) in link.subs" :key="idx">
                    <router-link :to="sub.to"
                        ><i :class="`fa ${sub.icon}`"></i>
                        <span class="nav-label">{{
                            sub.name
                        }}</span></router-link
                    >
                </li>
            </ul>
        </li>
    </ul>
</template>

<script>
import AppAccount from "./AppAccount";
export default {
    name: "AppSide",
    components: { AppAccount },
    computed: {
        links: function() {
            let sideLinks = this.$store.getters.links;

            sideLinks.forEach(l => {
                l.hasSubs = l.subs && l.subs.length !== 0;
            });

            return sideLinks;
        }
    }
};
</script>

<style scoped></style>
