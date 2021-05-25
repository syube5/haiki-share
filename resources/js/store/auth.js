import { OK, CREATED, UNPROCESSABLE_ENTITY } from "../util";

/*
 * ステート（ データの入れ物）
 */
const state = {
    // ログイン済みユーザーを保持
    user: null,
    // Api通信の成功、失敗の保持
    apiStatus: null,
    // ログインのエラーメッセージの保持
    loginErrorMessages: null,
    // 登録のエラーメッセージの保持
    registerErrorMessages: null,
    // リセットパスワードエラーメッセージの保持
    resetErrorMessages: null,
    // パスワード変更エラーメッセージの保持
    forgotErrorMessages: null,
    // プロフィール編集エラーメッセージの保持
    editErrorMessages: null
};

/*
 * ゲッター（ステートから算出される値）
 */
const getters = {
    check: state => !!state.user,
    username: state => (state.user ? state.user.name : "")
};

/*
 * ミューテーション（同期処理）
 */
const mutations = {
    // userステートの更新
    setUser(state, user) {
        state.user = user;
    },
    // Api通信の成功、失敗の更新
    setApiStatus(state, status) {
        state.apiStatus = status;
    },
    // ログインのエラーメッセージの更新
    setLoginErrorMessages(state, messages) {
        state.loginErrorMessages = messages;
    },
    // 登録のエラーメッセージの更新
    setRegisterErrorMessages(state, messages) {
        state.registerErrorMessages = messages;
    },
    // パスワード変更エラーメッセージの更新
    setForgotErrorMessages(state, messages) {
        state.forgotErrorMessages = messages;
    },
    // リセットパスワードエラーメッセージの更新
    setResetErrorMessages(state, messages) {
        state.resetErrorMessages = messages;
    },
    //プロフィール編集エラーメッセージの更新
    setEditErrorMessages(state, messages) {
        state.resetErrorMessages = messages;
    }
};

/*
 * アクション（非同期処理）
 */
const actions = {
    // ユーザーログイン
    async userLogin(context, data) {
        // apiStatusのクリア
        context.commit("setApiStatus", null);
        // Apiリクエスト
        const response = await axios.post("/api/user/login", data);

        if (response.status === OK) {
            context.commit("setApiStatus", true);
            context.commit("setUser", response.data);
            return false;
        }

        context.commit("setApiStatus", false);
        if (response.status === UNPROCESSABLE_ENTITY) {
            context.commit("setLoginErrorMessages", response.data.errors);
        } else {
            context.commit("error/setCode", response.status, { root: true });
        }
    },

    // ユーザー会員登録
    async userRegister(context, data) {
        // apiStatusのクリア
        context.commit("setApiStatus", null);
        // Apiリクエスト
        const response = await axios.post("/api/user/register", data);

        if (response.status === CREATED) {
            context.commit("setApiStatus", true);
            context.commit("setUser", response.data);
            return false;
        }

        context.commit("setApiStatus", false);
        if (response.status === UNPROCESSABLE_ENTITY) {
            context.commit("setRegisterErrorMessages", response.data.errors);
        } else {
            context.commit("error/setCode", response.status, { root: true });
        }
    },

    // ユーザーログアウト
    async logout(context) {
        // apiStatusのクリア
        context.commit("setApiStatus", null);
        // Apiリクエスト
        const response = await axios.post("/api/user/logout");

        if (response.status === OK) {
            context.commit("setApiStatus", true);
            context.commit("setUser", null);
            return false;
        }

        context.commit("setApiStatus", false);
        context.commit("error/setCode", response.status, { root: true });
    },

    // ユーザーパスワード変更
    async userForgot(context, data) {
        // apiStatusのクリア
        context.commit("setApiStatus", null);

        // Apiリクエスト
        const response = await axios.post("/api/user/password/email", data);

        // 通信成功の場合 201
        if (response.status === CREATED) {
            // apiStatus を true に更新
            context.commit("setApiStatus", true);
            // ここで終了
            return false;
        }

        // 通信失敗のステータスが 422（バリデーションエラー）の場合
        // apiStatus を false に更新
        context.commit("setApiStatus", false);

        // 通信失敗のステータスが 422（バリデーションエラー）の場合
        if (response.status === UNPROCESSABLE_ENTITY) {
            // registerErrorMessages にエラーメッセージを登録
            context.commit("setForgotErrorMessages", response.data.errors);
        }
        // 通信失敗のステータスがその他の場合
        else {
            // エラーストアの code にステータスコードを登録
            // 別ストアのミューテーションする場合は第三引数に { root: true } を追加
            context.commit("error/setCode", response.status, { root: true });
        }
    },

    // ユーザーパスワードリセット
    async userReset(context, data) {
        // apiStatusのクリア
        context.commit("setApiStatus", null);

        // Apiリクエスト
        const response = await axios.post("/api/user/password/reset/", data);

        // 通信成功の場合 200
        if (response.status === OK) {
            // apiStatus を true に更新
            context.commit("setApiStatus", true);
            // user にデータを登録
            context.commit("setUser", response.data);
            // ここで終了
            return false;
        }

        // apiStatus を false に更新
        context.commit("setApiStatus", false);

        // 通信失敗のステータスが 422（バリデーションエラー）の場合
        if (response.status === UNPROCESSABLE_ENTITY) {
            // validation error then set message
            context.commit("setResetErrorMessages", response.data.errors);
        }
        // 通信失敗のステータスがその他の場合
        else {
            // エラーストアの code にステータスコードを登録
            // 別ストアのミューテーションする場合は第三引数に { root: true } を追加
            context.commit("error/setCode", response.status, { root: true });
        }
    },

    // ユーザープロフィール編集
    async userEdit(context, data) {
        // apiStatusのクリア
        context.commit("setApiStatus", null);
        // Apiリクエスト
        const response = await axios.post("/api/user/edit-profile", data);

        if (response.status === CREATED) {
            context.commit("setApiStatus", true);
            context.commit("setUser", response.data);
            return false;
        }

        context.commit("setApiStatus", false);
        if (response.status === UNPROCESSABLE_ENTITY) {
            context.commit("setEditErrorMessages", response.data.errors);
        } else {
            context.commit("error/setCode", response.status, { root: true });
        }
    },

    // ログインユーザーチェック
    async currentUser(context) {
        context.commit("setApiStatus", null);
        const response = await axios.get("/api/user");
        const user = response.data || null;

        if (response.status === OK) {
            context.commit("setApiStatus", true);
            context.commit("setUser", user);
            return false;
        }

        context.commit("setApiStatus", false);
        context.commit("error/setCode", response.status, { root: true });
    }
};

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
};
