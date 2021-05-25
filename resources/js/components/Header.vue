<template>
    <nav class="l-header">
        <RouterLink class="l-header__brand" to="/">
            Haiki_share
        </RouterLink>
        <div class="l-header__menu">
            <!--<div v-if="isLogin" class="l-header__item">
                <button class="button">
                    <i class="icon ion-md-add"></i>
                    Submit a photo
                </button>
            </div>-->
            <span v-if="isLogin" class="l-header__item">
                {{ username }}
            </span>
            <div v-else class="l-header__item">
                <RouterLink class="c-button c-button--link" to="/login">
                    Login / Register
                </RouterLink>
            </div>
        </div>
    </nav>
</template>

<script>
export default {
    computed: {
        isLogin() {
            return this.$store.getters["auth/check"];
        },
        username() {
            return this.$store.getters["auth/username"];
        }
    }
};
</script>
