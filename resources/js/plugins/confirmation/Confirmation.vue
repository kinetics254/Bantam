<template>
    <div
        id="confirmationModal"
        class="modal"
        tabindex="-1"
        role="dialog"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-sm">
            <div class="modal-content animated fadeInDown">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">×</span
                        ><span class="sr-only">Close</span>
                    </button>
                    <!-- modal-dialog title-->
                    <h4 class="modal-title text-center">{{ params.title }}</h4>
                </div>
                <div class="modal-body text-center">
                    <!-- Action description-->
                    <h1>{{ params.text }}</h1>
                    <br />

                    <div v-if="params.input" class="form-group">
                        <textarea
                            v-model="input"
                            :placeholder="params.label"
                            rows="10"
                            cols="30"
                        />
                        <div v-if="hasErrors" class="col-md-12">
                            <div class="alert alert-danger">
                                Must provide a reason.
                            </div>
                        </div>
                    </div>
                    <hr />
                    <!--Actions-->
                    <div class="row">
                        <div class="col-xs-6">
                            <a
                                class="btn btn-lg btn-white btn-block"
                                data-dismiss="modal"
                                >No</a
                            >
                        </div>
                        <div class="col-xs-6">
                            <a
                                class="btn btn-lg btn-primary btn-block"
                                @click="confirm()"
                                >Yes</a
                            >
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Confirm from "./index";
export default {
    name: "Confirmation",
    data: function() {
        return {
            params: {
                title: "",
                text: "",
                input: false,
                label: "",
                onConfirm: {}
            },
            input: "",
            hasErrors: false
        };
    },

    mounted() {
        Confirm.onConfirm.$on("show", params => {
            this.show(params);
        });
    },

    methods: {
        show: function(params) {
            this.params = params;
            // eslint-disable-next-line no-undef
            $("#confirmationModal").modal({
                backdrop: "static",
                keyboard: false,
                show: true
            });
        },

        hide: function() {
            // eslint-disable-next-line no-undef
            $("#confirmationModal").modal("hide");
        },

        confirm: function() {
            if (typeof this.params.onConfirm === "function") {
                if (this.params.input === true && this.input === "") {
                    this.hasErrors = true;
                } else {
                    this.hasErrors = false;
                    this.params.onConfirm(this.input);
                    this.hide();
                }
            } else {
                this.hide();
            }
        }
    }
};
</script>

<style scoped></style>
