<template>
    <p class="m-t">
        <small>
            {{ appName | capitalize }} © {{ new Date().getFullYear() }}
        </small>
    </p>
</template>

<script>
export default {
    name: "AuthFooter"
};
</script>

<style scoped></style>
