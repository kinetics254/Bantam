<template>
    <h1 class="text-center">{{ name || $parent.$options.name }}</h1>
</template>

<script>
export default {
    name: "ComponentPlaceholder",
    props: {
        name: {
            type: String,
            default: null
        }
    }
};
</script>

<style scoped></style>
