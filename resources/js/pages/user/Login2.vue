<template>
    <div class="l-container--small">
        <ul class="p-tab">
            <li
                class="p-tab__item"
                :class="{ 'p-tab__item--active': tab === 1 }"
                @click="tab = 1"
            >
                ログイン
            </li>
            <li
                class="p-tab__item"
                :class="{ 'p-tab__item--active': tab === 2 }"
                @click="tab = 2"
            >
                会員情報登録
            </li>
            <li
                class="p-tab__item"
                :class="{ 'p-tab__item--active': tab === 3 }"
                @click="tab = 3"
            >
                パスワードリセット
            </li>
        </ul>
        <div class="p-panel" v-show="tab === 1">
            <form class="form" @submit.prevent="login">
                <label for="login-email" class="p-form__label"
                    >メールアドレス</label
                >
                <input
                    type="email"
                    class="p-form__item"
                    id="login-email"
                    v-model="loginForm.email"
                />
                <div v-if="loginErrors" class="p-errors">
                    <ul v-if="loginErrors.email">
                        <li v-for="msg in loginErrors.email" :key="msg">
                            {{ msg }}
                        </li>
                    </ul>
                </div>
                <label for="login-password" class="p-form__label"
                    >パスワード</label
                >
                <input
                    type="password"
                    class="p-form__item"
                    id="login-password"
                    v-model="loginForm.password"
                />
                <div v-if="loginErrors" class="p-errors">
                    <ul v-if="loginErrors.password">
                        <li v-for="msg in loginErrors.password" :key="msg">
                            {{ msg }}
                        </li>
                    </ul>
                </div>
                <div class="c-button__form">
                    <button type="submit" class="c-button c-button--blue">
                        ログイン
                    </button>
                </div>
            </form>
        </div>
        <div class="p-panel" v-show="tab === 2">
            <form class="form" @submit.prevent="register">
                <label for="username" class="p-form__label">名前</label>
                <input
                    type="text"
                    class="p-form__item"
                    id="username"
                    v-model="registerForm.name"
                />
                <div v-if="registerErrors" class="p-errors">
                    <ul v-if="registerErrors.name">
                        <li v-for="msg in registerErrors.name" :key="msg">
                            {{ msg }}
                        </li>
                    </ul>
                </div>
                <label for="email" class="p-form__label">メールアドレス </label>
                <input
                    type="text"
                    class="p-form__item"
                    id="email"
                    v-model="registerForm.email"
                />
                <div v-if="registerErrors" class="p-errors">
                    <ul v-if="registerErrors.email">
                        <li v-for="msg in registerErrors.email" :key="msg">
                            {{ msg }}
                        </li>
                    </ul>
                </div>
                <label for="password" class="p-form__label">パスワード</label>
                <input
                    type="password"
                    class="p-form__item"
                    id="password"
                    v-model="registerForm.password"
                />
                <div v-if="registerErrors" class="p-errors">
                    <ul v-if="registerErrors.password">
                        <li v-for="msg in registerErrors.password" :key="msg">
                            {{ msg }}
                        </li>
                    </ul>
                </div>
                <label for="password-confirmation" class="p-form__label"
                    >パスワード再確認</label
                >
                <input
                    type="password"
                    class="p-form__item"
                    id="password-confirmation"
                    v-model="registerForm.password_confirmation"
                />
                <div class="c-button__form">
                    <button type="submit" class="c-button c-button--blue">
                        会員登録
                    </button>
                </div>
            </form>
        </div>

        <div class="p-panel" v-show="tab === 3">
            <form class="form" @submit.prevent="forgot">
                <label for="login-email" class="p-form__label"
                    >メールアドレス</label
                >
                <input
                    type="email"
                    class="p-form__item"
                    id="forgotForm-email"
                    v-model="forgotForm.email"
                />
                <div v-if="forgotErrors" class="p-errors">
                    <ul v-if="forgotErrors.email">
                        <li v-for="msg in forgotErrors.email" :key="msg">
                            {{ msg }}
                        </li>
                    </ul>
                </div>
                <div class="c-button__form">
                    <button type="submit" class="c-button c-button--blue">
                        送信
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import { mapState } from "vuex";
export default {
    data() {
        return {
            tab: 1,
            loginForm: {
                email: "",
                password: ""
            },
            registerForm: {
                name: "",
                email: "",
                password: "",
                password_confirmation: ""
            },
            forgotForm: {
                email: ""
            }
        };
    },
    computed: mapState({
        apiStatus: state => state.auth.apiStatus,
        loginErrors: state => state.auth.loginErrorMessages,
        registerErrors: state => state.auth.registerErrorMessages,
        forgotErrors: state => state.auth.forgotErrorMessages
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
        async register() {
            // authストアのresigterアクションを呼び出す
            await this.$store.dispatch("auth/userRegister", this.registerForm);
            if (this.apiStatus) {
                // トップページに移動する
                this.$router.push("/");
            }
            // AUTHストアのエラーメッセージをクリア
            this.clearError();
            // フォームをクリア
            this.clearForm();
        },
        async forgot() {
            // authストアのforgotアクションを呼び出す
            await this.$store.dispatch("auth/userForgot", this.forgotForm);
            if (this.apiStatus) {
                // show message
                this.$store.commit("message/setContent", {
                    content: "パスワードリセットメールを送信しました。",
                    timeout: 10000
                });
                // AUTHストアのエラーメッセージをクリア
                this.clearError();
                // フォームをクリア
                this.clearForm();
            }
        },
        clearError() {
            // AUTHストアのエラーメッセージをクリア
            this.$store.commit("auth/setLoginErrorMessages", null);
            this.$store.commit("auth/setRegisterErrorMessages", null);
            this.$store.commit("auth/setForgotErrorMessages", null);
        },
        //フォームの値をクリア
        clearForm() {
            // login form
            this.loginForm.email = "";
            this.loginForm.password = "";
            // register form
            this.registerForm.name = "";
            this.registerForm.email = "";
            this.registerForm.password = "";
            this.registerForm.password_confirmation = "";
            // forgot form
            this.forgotForm.email = "";
        }
    },
    created() {
        this.clearError();
    }
};
</script>
