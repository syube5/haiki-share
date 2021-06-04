import Vue from "vue";
import VueRouter from "vue-router";

// ページコンポーネントをインポートする
import PhotoList from "./pages/user/PhotoList.vue";
import Login from "./pages/user/Login.vue";
//import Login2 from "./pages/user/Login_copy.vue";
import Register from "./pages/user/Register.vue";
import SystemError from "./pages/errors/System.vue";
import Reset from "./pages/user/Reset.vue";
import Email from "./pages/user/Email.vue";
import ProfileEdit from "./pages/user/ProfileEdit.vue";

import store from "./store";

// VueRouterプラグインを使用する
// これによって<RouterView />コンポーネントなどを使うことができる
Vue.use(VueRouter);

export default new VueRouter({
    // モードの設定
    mode: "history",
    routes: [
        {
            path: "/",
            component: PhotoList
        },
        {
            // urlのパス
            path: "/user/login",
            // インポートしたページ
            component: Login,
            // ページコンポーネントが切り替わる直前に呼び出される関数
            // to はアクセスされようとしているルートのルートオブジェクト
            // from はアクセス元のルート
            // next はページの移動先
            beforeEnter(to, from, next) {
                if (store.getters["auth/check"]) {
                    next("/");
                } else {
                    next();
                }
            }
        },
        {
            // urlのパス
            path: "/user/register",
            // インポートしたページ
            component: Register,
            // ページコンポーネントが切り替わる直前に呼び出される関数
            // to はアクセスされようとしているルートのルートオブジェクト
            // from はアクセス元のルート
            // next はページの移動先
            beforeEnter(to, from, next) {
                if (store.getters["auth/check"]) {
                    next("/");
                } else {
                    next();
                }
            }
        },
        {
            // urlのパス
            path: "/user/email",
            // インポートしたページ
            component: Email,
            // ページコンポーネントが切り替わる直前に呼び出される関数
            // to はアクセスされようとしているルートのルートオブジェクト
            // from はアクセス元のルート
            // next はページの移動先
            beforeEnter(to, from, next) {
                if (store.getters["auth/check"]) {
                    next("/");
                } else {
                    next();
                }
            }
        },
        {
            // urlのパス
            path: "/user/edit-profile",
            // インポートしたページ
            component: ProfileEdit,
            // ページコンポーネントが切り替わる直前に呼び出される関数
            // to はアクセスされようとしているルートのルートオブジェクト
            // from はアクセス元のルート
            // next はページの移動先
            beforeEnter(to, from, next) {
                if (store.getters["auth/check"]) {
                    next();
                } else {
                    next("/");
                }
            }
        },
        {
            path: "/500",
            component: SystemError
        }
    ]
});
