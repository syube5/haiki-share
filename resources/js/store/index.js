import Vue from "vue";
import Vuex from "vuex";
import error from "./error";
import message from "./message";

import auth from "./auth";

Vue.use(Vuex);

const store = new Vuex.Store({
    modules: {
        auth,
        error,
        message
    }
});

export default store;
