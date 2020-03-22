<template>
    <img :src="avatar" :width="size" />
</template>

<script>
export default {
    name: "Avatar",
    props: {
        size: {
            type: String,
            default: "60"
        }
    },
    computed: {
        avatar() {
            return "/img/user.svg";
        }
    }
};
</script>

<style scoped></style>
