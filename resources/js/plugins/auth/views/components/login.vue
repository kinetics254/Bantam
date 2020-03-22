<template>
    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div
            class="ibox-content"
            :class="{ 'sk-loading': loading }"
            style="border: none"
        >
            <spinner v-if="loading" />
            <div>
                <div>
                    <logo size="150" />
                    <br />
                    <br />
                    <br />
                </div>
            </div>
            <h3>Log In</h3>
            <form class="m-t text-left">
                <div class="form-group" :class="formDataError.email.status">
                    <label class="label-control">Email</label>
                    <input
                        v-model="formData.email"
                        type="email"
                        class="form-control"
                        placeholder="Username"
                        required=""
                    />
                    <span class="help-block m-b-none">
                        {{ formDataError.email.message }}
                    </span>
                </div>
                <div class="form-group" :class="formDataError.password.status">
                    <label class="label-control">Password</label>
                    <input
                        v-model="formData.password"
                        type="password"
                        class="form-control"
                        placeholder="Password"
                        required=""
                    />
                    <span class="help-block m-b-none">
                        {{ formDataError.password.message }}
                    </span>
                </div>
                <button
                    type="submit"
                    class="btn btn-primary block full-width m-b"
                    @click.prevent="submit"
                >
                    Login
                </button>

                <router-link to="/auth/reset"
                    ><small>Forgot password?</small></router-link
                >
            </form>
            <auth-footer />
        </div>
    </div>
</template>

<script>
import { validator } from "../../../../utilities";
import Logo from "../../../../components/Logo";
import LoadingMixin from "../../../../mixins/loader/loader";
import AuthFooter from "./partials/AuthFooter";
import Spinner from "../../../../components/Spinner";
export default {
    name: "Login",
    components: { Spinner, AuthFooter, Logo },
    mixins: [LoadingMixin],
    data: function() {
        return {
            formData: {
                email: "",
                password: "",
                device_name: "bantam"
            },
            formDataError: {
                email: {
                    status: "",
                    message: ""
                },
                password: {
                    status: "",
                    message: ""
                }
            },
            rules: {
                email: "required|email",
                password: "required|min:4"
            }
        };
    },
    methods: {
        submit: function() {
            //validate form data
            let res = validator.fields(
                this.formData,
                this.rules,
                this.formDataError
            );
            if (res.hasErrors) {
                this.formDataError = res.errors;
            } else {
                this.$store.dispatch("auth/login", this.formData);
            }
        }
    }
};
</script>

<style scoped></style>
