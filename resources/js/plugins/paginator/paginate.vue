<template>
    <div v-if="paginator.meta" class="row">
        <div class="col-sm-4 m-b-sm">
            Page : &nbsp;<span class="label label-default"
                >{{ paginator.meta.current_page }} /
                {{ paginator.meta.last_page }}</span
            >&nbsp; &nbsp; Total records : &nbsp;
            <span class="label label-default text-left">{{
                paginator.meta.total
            }}</span>
        </div>
        <div class="col-sm-4 text-center m-b-sm">
            <div
                class="form-group"
                :class="
                    (page > paginator.meta.last_page || page <= 0) &&
                    page !== ''
                        ? 'has-error'
                        : ''
                "
            >
                <div class="row">
                    <div class="col-sm-6 col-sm-push-3">
                        <div class="input-group input-group-sm">
                            <input
                                v-model="page"
                                type="number"
                                class="form-control"
                                placeholder="Go to Page"
                                :disabled="
                                    page > paginator.meta.last_page || page <= 0
                                "
                            />
                            <span class="input-group-btn">
                                <button
                                    :disabled="
                                        page > paginator.meta.last_page ||
                                            page <= 0
                                    "
                                    type="button"
                                    class="btn btn-default"
                                    @click="
                                        navigate(
                                            `${paginator.meta.path}?page=${page}`
                                        )
                                    "
                                >
                                    Go!
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
                <span id="helpBlockLeaveCode" class="help-block" />
            </div>
        </div>
        <div class="col-sm-4 m-b-sm">
            <div class="btn-group btn-group-justified">
                <a
                    class="btn btn-default"
                    title="First"
                    :disabled="paginator.meta.current_page === 1"
                    @click="navigate(paginator.links.first)"
                >
                    <i class="fa fa-angle-double-left" />
                </a>
                <a
                    class="btn btn-default"
                    title="Previous"
                    :disabled="paginator.meta.current_page === 1"
                    @click="navigate(paginator.links.prev)"
                >
                    <i class="fa fa-angle-left" />
                </a>
                <a
                    class="btn btn-default"
                    title="Next"
                    :disabled="
                        paginator.meta.current_page === paginator.meta.last_page
                    "
                    @click="navigate(paginator.links.next)"
                >
                    <i class="fa fa-angle-right" />
                </a>
                <a
                    class="btn btn-default"
                    title="Last"
                    :disabled="
                        paginator.meta.current_page === paginator.meta.last_page
                    "
                    @click="navigate(paginator.links.last)"
                >
                    <i class="fa fa-angle-double-right" />
                </a>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Paginate",
    data: function() {
        return {
            page: ""
        };
    },
    methods: {
        navigate: function(link) {
            if (link) this.$parent.getData(link);
        }
    }
};
</script>

<style scoped />
