<template>
    <div class="container">
        <div class="p-form">
            <div class="p-form__body">
                <div class="p-form__title">会員情報登録</div>

                <form class="u-p9" @submit.prevent="register">
                    <div class="form-group u-mb3">
                        <label for="name" class="c-label">名前</label>
                        <input
                            id="name"
                            type="text"
                            class="p-form__control"
                            name="name"
                            required
                            autocomplete="name"
                            autofocus
                            placeholder="田中太郎"
                            v-model="registerForm.name"
                        />
                        <div v-if="registerErrors" class="p-errors">
                            <ul v-if="registerErrors.name">
                                <li
                                    v-for="msg in registerErrors.name"
                                    :key="msg"
                                >
                                    {{ msg }}
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="form-group u-mb3">
                        <label for="email" class="c-label"
                            >メールアドレス</label
                        >
                        <input
                            id="email"
                            type="text"
                            class="p-form__control"
                            name="email"
                            required
                            autocomplete="email"
                            placeholder="abc@example.com"
                            v-model="registerForm.email"
                        />
                        <div v-if="registerErrors" class="p-errors">
                            <ul v-if="registerErrors.email">
                                <li
                                    v-for="msg in registerErrors.email"
                                    :key="msg"
                                >
                                    {{ msg }}
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="form-group u-mb3">
                        <label for="password" class="c-label">パスワード</label>
                        <input
                            id="password"
                            type="password"
                            class="p-form__control"
                            name="password"
                            required
                            autocomplete="new-password"
                            v-model="registerForm.password"
                        />
                        <div v-if="registerErrors" class="p-errors">
                            <ul v-if="registerErrors.password">
                                <li
                                    v-for="msg in registerErrors.password"
                                    :key="msg"
                                >
                                    {{ msg }}
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="form-group u-mb3">
                        <label for="password-confirm" class="c-label"
                            >パスワード再入力</label
                        >
                        <input
                            id="password-confirmation"
                            type="password"
                            class="p-form__control"
                            name="password_confirmation"
                            required
                            autocomplete="new-password"
                            v-model="registerForm.password_confirmation"
                        />
                    </div>

                    <div class="form-group u-mb3">
                        <button
                            type="submit"
                            class="c-button c-button__block c-button--blue"
                        >
                            会員登録
                        </button>
                    </div>

                    <router-link to="/user/login"
                        >アカウントをお持ちの方はこちら</router-link
                    >
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
            registerForm: {
                name: "",
                email: "",
                password: "",
                password_confirmation: ""
            }
        };
    },
    computed: mapState({
        apiStatus: state => state.auth.apiStatus,
        registerErrors: state => state.auth.registerErrorMessages
    }),
    methods: {
        async register() {
            // authストアのresigterアクションを呼び出す
            await this.$store.dispatch("auth/register", this.registerForm);
            if (this.apiStatus) {
                // トップページに移動する
                this.$router.push("/");
            }
        },
        clearError() {
            // AUTHストアのエラーメッセージをクリア
            this.$store.commit("auth/setRegisterErrorMessages", null);
        },
        //フォームの値をクリア
        clearForm() {
            // register form
            this.registerForm.name = "";
            this.registerForm.email = "";
            this.registerForm.password = "";
            this.registerForm.password_confirmation = "";
        }
    },
    created() {
        this.clearError();
    }
};
</script>
