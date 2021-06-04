<template>
    <div class="container">
        <div class="p-form">
            <div class="p-form__body">
                <div class="p-form__title">ログイン</div>

                <form class="u-p9" @submit.prevent="login">
                    <div class="form-group u-mb3">
                        <label for="login-email" class="c-label"
                            >メールアドレス</label
                        >
                        <input
                            id="email"
                            type="email"
                            class="p-form__control"
                            name="email"
                            required
                            autocomplete="email"
                            autofocus
                            v-model="loginForm.email"
                        />
                        <div v-if="loginErrors" class="p-errors">
                            <ul v-if="loginErrors.email">
                                <li v-for="msg in loginErrors.email" :key="msg">
                                    {{ msg }}
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="form-group u-mb3">
                        <label for="login-password" class="c-label"
                            >パスワード</label
                        >
                        <input
                            id="password"
                            type="password"
                            class="p-form__control"
                            name="password"
                            required
                            autocomplete="current-password"
                            v-model="loginForm.password"
                        />
                        <div v-if="loginErrors" class="p-errors">
                            <ul v-if="loginErrors.password">
                                <li
                                    v-for="msg in loginErrors.password"
                                    :key="msg"
                                >
                                    {{ msg }}
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="form-group u-mb3">
                        <button
                            type="submit"
                            class="c-button c-button__block c-button--blue"
                        >
                            ログイン
                        </button>
                    </div>

                    <div>
                        アカウントをお持ちでないの方は<router-link
                            to="/user/register"
                            >こちら</router-link
                        >
                    </div>
                    <div class="u-mt1">
                        パスワードをお忘れの方は<router-link to="/user/email"
                            >こちら</router-link
                        >
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import { mapState } from "vuex";
export default {
    data() {
        return {
            loginForm: {
                email: "",
                password: ""
            }
        };
    },
    computed: mapState({
        apiStatus: state => state.auth.apiStatus,
        loginErrors: state => state.auth.loginErrorMessages
    }),
    methods: {
        async login() {
            // authストアのloginアクションを呼び出す
            await this.$store.dispatch("auth/userLogin", this.loginForm);
            if (this.apiStatus) {
                // トップページに移動する
                this.$router.push("/");
            }
        },
        clearError() {
            // AUTHストアのエラーメッセージをクリア
            this.$store.commit("auth/setLoginErrorMessages", null);
        },
        //フォームの値をクリア
        clearForm() {
            // login form
            this.loginForm.email = "";
            this.loginForm.password = "";
        }
    },
    created() {
        this.clearError();
    }
};
</script>
