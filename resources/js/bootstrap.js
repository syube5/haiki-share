// クッキーを簡単に扱えるモジュールをインポート
import Cookies from "js-cookie";

/*
 * lodash
 * あると便利のなのでそのままおいておく
 */
window._ = require("lodash");

/*
 * axios
 * Ajax通信にはこれを使う
 */
window.axios = require("axios");

// Ajaxリクエストであることを示すヘッダーを付与する
window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

// requestの設定
window.axios.interceptors.request.use(config => {
    // クッキーからトークンを取り出す
    const xsrfToken = Cookies.get("XSRF-TOKEN");
    // ヘッダーに添付する
    config.headers["X-XSRF-TOKEN"] = xsrfToken;
    return config;
});

// responseの設定
// API通信の成功、失敗でresponseの形が変わるので、どちらとも response にレスポンスオブジェクトを代入
window.axios.interceptors.response.use(
    // 成功時の処理
    response => response,
    // 失敗時の処理
    error => error.response || error
);
