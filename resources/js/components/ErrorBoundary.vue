<template>
    <div>
        <slot v-if="err" name="error" :err="err" :v-model="vm" :info="info"
            >Something went wrong</slot
        >
        <slot v-else></slot>
    </div>
</template>

<script>
export default {
    name: "ErrorBoundary",
    props: {
        stopPropagation: Boolean
    },
    data: function() {
        return {
            err: false,
            vm: null,
            info: null
        };
    },
    errorCaptured(err, vm, info) {
        alert("error captured");
        this.err = err;
        this.vm = vm;
        this.info = info;
        return !this.stopPropagation;
    }
};
</script>

<style scoped></style>
