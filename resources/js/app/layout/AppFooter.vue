<template>
    <div class="footer">
        <div class="pull-right">
            Made with <i class="fa fa-heart text-danger" /> by
            <a href="https://kinetics.co.ke/" target="_blank">
                Kinetic Technology</a
            >
        </div>
        <div>
            <strong>Copyright</strong> {{ appName | capitalize }} ©
            {{ new Date().getFullYear() }}
        </div>
    </div>
</template>

<script>
export default {
    name: "AppFooter"
};
</script>

<style scoped></style>
