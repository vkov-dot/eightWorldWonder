import Vue from 'vue'
import Vuex from 'vuex'
import state from './modules/state'
import issue from './modules/issue'
import media from './modules/media'
import heading from "./modules/heading";
import category from "./modules/category";
import comment from "./modules/comment";
import auth from './modules/auth';

Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        state, issue, media, auth,
        heading, category, comment,
    },
    mutations: {
        setErrors: (state, errors) => state.errors = errors,
    },
    getters: {
        errors: state => state.errors,
    },
})


