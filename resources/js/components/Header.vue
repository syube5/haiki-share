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
            </div>
            <span v-if="isLogin" class="l-header__item">
                {{ username }}
            </span>
            <div v-else class="l-header__item">
                <RouterLink class="c-button c-button--link" to="/login">
                    Login / Register
                </RouterLink>
            </div>-->
            <div class="l-hamburger__btn" v-on:click="ActiveBtn = !ActiveBtn">
                <span
                    class="l-hamburger__btn--line line_01"
                    v-bind:class="{ btn_line01: ActiveBtn }"
                ></span>
                <span
                    class="l-hamburger__btn--line line_02"
                    v-bind:class="{ btn_line02: ActiveBtn }"
                ></span>
                <span
                    class="l-hamburger__btn--line line_03"
                    v-bind:class="{ btn_line03: ActiveBtn }"
                ></span>
            </div>
            <transition name="menu">
                <div class="l-menu" v-show="ActiveBtn">
                    <div v-if="isLogin" class="l-menu__name">
                        {{ username }}様
                    </div>
                    <ul class="l-menu__list" v-if="!isLogin">
                        <li class="l-menu__item">
                            <router-link
                                class="l-menu__item--link"
                                to="/user/login"
                                >ユーザーの方はこちら</router-link
                            >
                        </li>
                        <li class="l-menu__item">
                            <a class="l-menu__item--link" href="#"
                                >コンビニの方はこちら</a
                            >
                        </li>
                    </ul>
                    <ul class="l-menu__list" v-if="isLogin">
                        <li class="l-menu__item">
                            <router-link to="/user/edit-profile"
                                >プロフィール編集</router-link
                            >
                        </li>
                        <li class="l-menu__item">
                            <div
                                class="l-menu__item--link c-button__pointer"
                                @click="logout"
                            >
                                ログアウト
                            </div>
                        </li>
                    </ul>
                </div>
            </transition>
        </div>
    </nav>
</template>

<script>
import { mapState, mapGetters } from "vuex";
export default {
    data: function() {
        return {
            ActiveBtn: false
        };
    },
    computed: {
        ...mapState({
            apiStatus: state => state.auth.apiStatus
        }),
        ...mapGetters({
            isLogin: "auth/check",
            username: "auth/username"
        })
        /*isLogin() {
            return this.$store.getters["auth/check"];
        },
        username() {
            return this.$store.getters["auth/username"];
        },*/
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
</script>

<style>
/* vue固有のスタイル */
.btn_line01 {
    transform: translateY(10px) rotate(-45deg);
    transition: 0.4s ease;
}
.btn_line02 {
    transition: 0.4s ease;
    opacity: 0;
}
.btn_line03 {
    transform: translateY(-10px) rotate(45deg);
    transition: 0.4s ease;
}

.menu-enter-active,
.menu-leave-active {
    transition: opacity 0.4s;
}
.menu-enter,
.menu-leave-to {
    opacity: 0;
}
.menu-leave,
.menu-enter-to {
    opacity: 1;
}
</style>
