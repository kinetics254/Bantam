<template>
    <div>
        <div class="btn-group-xs">
            <button
                class="btn"
                :class="filter === '' ? 'btn-primary' : 'btn-white'"
                @click="setFilter('')"
            >
                All
            </button>
            <button
                v-for="(item, index) in data"
                :key="index"
                class="btn"
                :class="filter === item[key] ? 'btn-primary' : 'btn-white'"
                type="button"
                @click="setFilter(item[key])"
            >
                {{ item[label] | capitalize }}
            </button>
        </div>
    </div>
</template>

<script>
export default {
    name: "FilterView",
    props: {
        data: {
            type: Array,
            default: null
        },
        filterKey: {
            type: String,
            default: null
        },
        filterLabel: {
            type: String,
            default: ""
        }
    },
    data: function() {
        return {
            filter: ""
        };
    },
    computed: {
        key() {
            return this.filterKey ? this.filterKey : this.getItemKey();
        },
        label() {
            return this.filterLabel ? this.filterLabel : this.filterKey;
        }
    },
    methods: {
        setFilter: function(filter) {
            this.filter = filter;
            this.$parent.filter = filter;
        }
    }
};
</script>
<style scoped />
