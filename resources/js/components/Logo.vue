<template>
    <img src="/img/logo.png" :width="size" />
</template>

<script>
export default {
    name: "Logo",
    props: {
        size: {
            type: String,
            default: "60"
        }
    }
};
</script>

<style scoped />
