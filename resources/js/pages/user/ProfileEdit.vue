<template>
    <div class="container">
        <div class="p-form">
            <div class="p-form__body">
                <div class="p-form__title">プロフィール編集</div>

                <form class="u-p9" @submit.prevent="edit">
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
                            v-model="editForm.name"
                        />
                        <div v-if="editErrors" class="p-errors">
                            <ul v-if="editErrors.name">
                                <li v-for="msg in editErrors.name" :key="msg">
                                    {{ msg }}
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="form-group u-mb3">
                        <label for="email" class="p-form__label"
                            >メールアドレス
                        </label>
                        <input
                            id="email"
                            type="email"
                            class="p-form__control"
                            name="email"
                            required
                            autocomplete="email"
                            autofocus
                            v-model="editForm.email"
                        />
                        <div v-if="editErrors" class="p-errors">
                            <ul v-if="editErrors.email">
                                <li v-for="msg in editErrors.email" :key="msg">
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
                            保存
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
            editForm: {
                name: this.$store.state.auth.user.name,
                email: this.$store.state.auth.user.email
            }
        };
    },
    computed: mapState({
        apiStatus: state => state.auth.apiStatus,
        editErrors: state => state.auth.editErrorMessages
    }),
    methods: {
        async edit() {
            // authストアのresigterアクションを呼び出す
            await this.$store.dispatch("auth/edit", this.editForm);
            if (this.apiStatus) {
                this.$router.push("/");
                this.$store.commit("message/setContent", {
                    content: "プロフィールを更新しました。",
                    timeout: 10000
                });
                // AUTHストアのエラーメッセージをクリア
                this.clearError();
                // フォームをクリア
                //this.clearForm();
            }
            //this.$router.go({ path: "/", force: true });
        },
        clearError() {
            // AUTHストアのエラーメッセージをクリア
            this.$store.commit("auth/setEditErrorMessages", null);
        }
        //フォームの値をクリア
        /*clearForm() {
            // edit form
            this.editForm.name = "";
            this.editForm.email = "";
        }*/
    },
    created() {
        this.clearError();
    }
};
</script>
