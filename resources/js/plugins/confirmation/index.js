import ConfirmationModal from "./Confirmation";

const ConfirmPlugin = {
    install(Vue) {
        this.onConfirm = new Vue();

        Vue.component("confirmation-modal", ConfirmationModal);

        Vue.prototype.$confirm = {
            show(params) {
                ConfirmPlugin.onConfirm.$emit("show", params);
            }
        };
    }
};

export default ConfirmPlugin;
