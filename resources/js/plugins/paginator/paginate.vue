<template>
    <div v-if="meta" class="row">
        <div class="col-sm-4 m-b-sm">
            Page : &nbsp;<span class="label label-default"
                >{{ meta.current_page }} / {{ meta.last_page }}</span
            >&nbsp; &nbsp; Total records : &nbsp;
            <span class="label label-default text-left">{{ meta.total }}</span>
        </div>
        <div class="col-sm-4 text-center m-b-sm">
            <div
                class="form-group"
                :class="
                    (page > meta.last_page || page <= 0) && page !== ''
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
                            />
                            <span class="input-group-btn">
                                <button
                                    :disabled="
                                        page > meta.last_page || page <= 0
                                    "
                                    type="button"
                                    class="btn btn-default"
                                    @click="$paginate.jumpToPage(page)"
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
                    :disabled="meta.current_page === 1"
                    @click="$paginate.on('first')"
                >
                    <i class="fa fa-angle-double-left" />
                </a>
                <a
                    class="btn btn-default"
                    title="Previous"
                    :disabled="meta.current_page === 1"
                    @click="$paginate.on('prev')"
                >
                    <i class="fa fa-angle-left" />
                </a>
                <a
                    class="btn btn-default"
                    title="Next"
                    :disabled="meta.current_page === meta.last_page"
                    @click="$paginate.on('next')"
                >
                    <i class="fa fa-angle-right" />
                </a>
                <a
                    class="btn btn-default"
                    title="Last"
                    :disabled="meta.current_page === meta.last_page"
                    @click="$paginate.on('last')"
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
    props: {
        meta: {
            type: Object,
            default: null
        }
    },
    data: function() {
        return {
            page: ""
        };
    }
};
</script>

<style scoped />
