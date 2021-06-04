<template>
    <footer class="l-footer">
        <!--<button v-if="isLogin" class="c-button c-button--link" @click="logout">
            Logout
        </button>
        <RouterLink v-else class="c-button c-button--link" to="/user/login">
            Login / Register
        </RouterLink> -->
        Copyright <router-link to="/">Haiki_share</router-link>. All Rights
        Reserved.
    </footer>
</template>

<!--<script>
import { mapState, mapGetters } from "vuex";

export default {
    computed: {
        ...mapState({
            apiStatus: state => state.auth.apiStatus
        }),
        ...mapGetters({
            isLogin: "auth/check"
        })
    },
    methods: {
        async logout() {
            await this.$store.dispatch("auth/logout");
            if (this.apiStatus) {
                this.$router.push("/user/login");
            }
        }
    }
};
</script>-->
