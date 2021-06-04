import { INTERNAL_SERVER_ERROR } from './util'

<template>
    <div>
        <header>
            <Header />
        </header>
        <main>
            <div class="l-form">
                <div class="l-form__content">
                    <div class="l-row--middle">
                        <Message />
                        <RouterView />
                    </div>
                </div>
            </div>
        </main>
        <Footer />
    </div>
</template>

<script>
import Header from "./components/Header.vue";
import Footer from "./components/Footer.vue";
import Message from "./components/Message";
import { INTERNAL_SERVER_ERROR } from "./const";

export default {
    components: {
        Header,
        Footer,
        Message
    },
    computed: {
        errorCode() {
            return this.$store.state.error.code;
        }
    },
    watch: {
        errorCode: {
            handler(val) {
                if (val === INTERNAL_SERVER_ERROR) {
                    this.$router.push("/500");
                }
            },
            immediate: true
        },
        $route() {
            this.$store.commit("error/setCode", null);
        }
    }
};
</script>
