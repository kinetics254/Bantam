<template>
    <router-view />
</template>

<script>
export default {
    name: "Auth",
    beforeCreate() {
        document.body.className = "gray-bg";
    }
};
</script>

<style scoped></style>
