import {axiosInstance} from "../../service/api";

export default {
    namespaced: true,

    actions: {

    },
    mutations: {

    },
    state: {
        stateComments: [],
        commentMessage: '',
    },
    getters: {
        getStateComments: state => state.stateComments,
    },
}
