import Vue from 'vue'
import Vuex from 'vuex'
import state from './modules/state'
import issue from './modules/issue'
import media from './modules/media'

Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        state,
        issue,
        media,
    }
})


