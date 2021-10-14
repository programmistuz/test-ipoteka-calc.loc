require("./bootstrap");
window.Vue = require('vue').default;

// ------------------------------------------------------------------
// axios
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    window.axios.defaults.headers.common["X-CSRF-TOKEN"] = token.content;
} else {
    console.error(
        "CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token"
    );
}

// ------------------------------------------------------------------
// роутинг

import router from "./router";
import VueRouter from "vue-router";

window.router = router;
Vue.use(VueRouter);
window.VueRouter = VueRouter;

// ------------------------------------------------------------------
// глобальная регистрация компонент
// пагинация в списках
//Vue.component('pagination', require('laravel-vue-pagination'));

// ------------------------------------------------------------------
// Vuex
import Vuex from "vuex";
import state from "./store/state";
import mutations from "./store/mutations";
import actions from "./store/actions";

const store = new Vuex.Store({
    state,
    getters: {},
    mutations,
    actions
});
window.store = store;

// ------------------------------------------------------------------
// Vuetify
import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.min.css';

Vue.use(Vuetify)
// ------------------------------------------------------------------
// основной лайоут
import App from "./components/layouts/layout";

// ------------------------------------------------------------------
const app = new Vue({
    el: "#app",

    store,
    router,
    vuetify: new Vuetify(
        {
            theme:
                {
                    dark: true,
                }
        }
    ),

    render: h => h(App)
});
