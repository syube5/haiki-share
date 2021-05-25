<template>
    <div class="l-container--small">
        <form class="form" @submit.prevent="edit">
            <label for="username" class="p-form__label">名前</label>
            <input
                type="text"
                class="p-form__item"
                id="username"
                v-model="editForm.name"
            />
            <div v-if="editErrors" class="p-errors">
                <ul v-if="editErrors.name">
                    <li v-for="msg in editErrors.name" :key="msg">
                        {{ msg }}
                    </li>
                </ul>
            </div>
            <label for="email" class="p-form__label">メールアドレス </label>
            <input
                type="text"
                class="p-form__item"
                id="email"
                v-model="editForm.email"
            />
            <div v-if="editErrors" class="p-errors">
                <ul v-if="editErrors.email">
                    <li v-for="msg in editErrors.email" :key="msg">
                        {{ msg }}
                    </li>
                </ul>
            </div>
            <div class="c-button__form">
                <button type="submit" class="c-button c-button--blue">
                    保存
                </button>
            </div>
        </form>
    </div>
</template>
<script>
import { mapState } from "vuex";
export default {
    data() {
        return {
            editForm: {
                name: "",
                email: ""
            }
        };
    },
    computed: mapState({
        apiStatus: state => state.auth.apiStatus,
        editErrors: state => state.auth.loginErrorMessages
    }),
    methods: {
        async edit() {
            // authストアのresigterアクションを呼び出す
            await this.$store.dispatch("auth/userEdit", this.editForm);
            if (this.apiStatus) {
                // トップページに移動する
                this.$router.push("/");
            }
            // AUTHストアのエラーメッセージをクリア
            this.clearError();
            // フォームをクリア
            this.clearForm();
        },
        clearError() {
            // AUTHストアのエラーメッセージをクリア
            this.$store.commit("auth/setEditErrorMessages", null);
        },
        //フォームの値をクリア
        clearForm() {
            // edit form
            this.editForm.name = "";
            this.editForm.email = "";
        }
    },
    created() {
        this.clearError();
    }
};
</script>
