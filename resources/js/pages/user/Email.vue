<template>
    <div class="container">
        <div class="p-form">
            <div class="p-form__body">
                <div class="p-form__title">パスワードお忘れの方</div>

                <form class="u-p9" @submit.prevent="forgot">
                    <div class="form-group u-mb3">
                        <label for="email" class="c-label"
                            >メールアドレス</label
                        >
                        <input
                            id="forgotForm-email"
                            type="email"
                            class="p-form__control"
                            name="email"
                            required
                            autocomplete="email"
                            autofocus
                            v-model="forgotForm.email"
                        />
                        <div v-if="forgotErrors" class="p-errors">
                            <ul v-if="forgotErrors.email">
                                <li
                                    v-for="msg in forgotErrors.email"
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
                            送信
                        </button>
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
            forgotForm: {
                email: ""
            }
        };
    },
    computed: mapState({
        apiStatus: state => state.auth.apiStatus,
        forgotErrors: state => state.auth.forgotErrorMessages
    }),
    methods: {
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
            this.$store.commit("auth/setForgotErrorMessages", null);
        },
        //フォームの値をクリア
        clearForm() {
            // forgot form
            this.forgotForm.email = "";
        }
    },
    created() {
        this.clearError();
    }
};
</script>
