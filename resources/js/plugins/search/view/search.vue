<template>
    <div class="row">
        <div class="col-sm-12">
            <div class="input-group">
                <input
                    type="search"
                    v-model="term"
                    class="form-control"
                    aria-label="Search"
                    placeholder="Search"
                />
                <div class="input-group-btn">
                    <button
                        @click="term = ''"
                        type="button"
                        class="btn btn-white"
                    >
                        <i class="fa fa-times" />
                    </button>
                    <button type="button" class="btn btn-primary">
                        Go <i class="fa fa-arrow-right" />
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Search",
    data: function() {
        return {
            term: ""
        };
    },
    watch: {
        term: {
            handler: function(n, o) {
                if (n !== o) {
                    this.$search(escape(n.trim()));
                }
            }
        }
    }
};
</script>

<style scoped />
