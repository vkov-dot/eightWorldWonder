import {axiosInstance} from "../../service/api";
import router from "../../router";

export default {
    namespaced: true,

    actions: {
        async getAllStates(ctx, pageNumber) {
            axios(`http://example.palmo/api/states/all?page=${pageNumber}`)
                .then(response => {
                    ctx.commit('updateStates', response.data.data)
                    ctx.commit('updateTotal', response.data.total)
                })
                .catch(error => console.log(error));
        },
        async getLastStates(ctx) {
            axios("http://example.palmo/api/states/latest")
                .then(response => ctx.commit('updateStates', response.data))
                .catch(error => console.log(error));
        },
        async getStateById(ctx, id) {
            if (localStorage.getItem("authToken")) {
                axiosInstance.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem("authToken")}`;
            }
            axiosInstance.get(`http://example.palmo/api/states/${id}/show`)
                .then(response => {
                    ctx.commit('updateShowState', response.data)
                    ctx.commit('updateRating', response.data.rating)
                })
                .catch(error => console.log(error));
        },
        async getArchiveStates(ctx) {
            if (localStorage.getItem("authToken")) {
                axiosInstance.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem("authToken")}`;
            }
            axiosInstance.get('http://example.palmo/api/archived/states')
                .then(response => ctx.commit('updateArchiveStates', response.data))
                .catch(error => console.log(error))
        },
        async updateState(ctx, [state, stateId]) {
            if (localStorage.getItem("authToken")) {
                axiosInstance.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem("authToken")}`;
            }
            console.log(stateId);
            axiosInstance.post(`http://example.palmo/api/states/update/${stateId}`, state)
                .then(response => {
                    if(response.archived) router.push({ name: 'states.archive'})
                    else router.push({ name: 'states.index' })
                })
                .catch(error => console.log(error))
        },
        async addStateToArchive(ctx, state) {
            if (localStorage.getItem("authToken")) {
                axiosInstance.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem("authToken")}`;
            }
            axiosInstance.post(`http://example.palmo/api/states/archive/add/${state}`)
                .then(() => router.push({ name: 'states.archive' }))
                .catch(error => console.log(error))
        },
        async deleteShowState(ctx, state) {
            if (localStorage.getItem("authToken")) {
                axiosInstance.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem("authToken")}`;
            }
            axiosInstance.delete(`http://example.palmo/api/states/${state}`)
                .then(response => {
                    ctx.commit('updateArchiveStates', response.data)
                    router.push({ name: 'states.archive' })
                })
                .catch(error => console.log(error))
        },
        async recoverShowState(ctx, state) {
            if (localStorage.getItem("authToken")) {
                axiosInstance.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem("authToken")}`;
            }
            axiosInstance.put(`http://example.palmo/api/states/recover/${state}`)
                .then(() => router.push({ name: 'start' }))
                .catch(error => console.log(error))
        },
        async storeState(ctx, state) {
            if (localStorage.getItem("authToken")) {
                axiosInstance.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem("authToken")}`;
            }
            axiosInstance.post("http://example.palmo/api/states/store", state)
                .then(() => router.push({ name: 'states.index' }))
                .catch(error => console.log(error))
        },
        async storeRating(ctx, rating) {
            if (localStorage.getItem("authToken")) {
                axiosInstance.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem("authToken")}`;
            }
            axiosInstance.post("http://example.palmo/api/states/rating/store", rating)
                .catch(error => console.log(error))
        },
        async postComment(ctx, [state, message]) {
            if(localStorage.getItem("authToken")) {
                axiosInstance.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem("authToken")}`;
            }
            axiosInstance.post(`http://example.palmo/api/states/${state}/comments/store`, { message } )
                .then(response => ctx.commit('updateStateComments', response.data))
                .catch(error => console.log(error))
        },
        async deleteCommentState(ctx, [state, comment]) {
            if (localStorage.getItem("authToken")) {
                axiosInstance.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem("authToken")}`;
            }
            await axiosInstance.delete(`http://example.palmo/api/states/${state}/comments/${comment}`)
                .then((response) => ctx.commit('deleteCommentInList', comment))
                .catch(error => console.log(error))
        },
        getSearchMessage(ctx, message) {
            ctx.commit('updateSearchMessage', message)
        },
        getSearchOption(ctx, option) {
            ctx.commit('updateSearchOption', option)
        },
        deleteComment(ctx, commentId) {
            ctx.commit('deleteCommentInList', commentId)
        },
    },
    mutations: {
        updateStates: (state, states) => state.states = states,
        updateShowState: (state, showState) => state.showState = showState,
        updateStatesLocal: (state, statesLocal) => state.statesLocal = statesLocal,
        updateArchiveStates: (state, archive) => state.archiveStates = archive,
        updateSearchMessage: (state, message) => state.searchStateMessage = message,
        updateSearchOption: (state, option) => state.searchOption = option,
        statesDesc: state => state.states = state.states.sort((a, b) => b['id'] > a['id'] ? 1 : -1),
        statesAsc: state => state.states = state.states.sort((a, b) => a['id'] > b['id'] ? 1 : -1),
        archiveStatesDesc: state => state.archiveStates = state.archiveStates.sort((a, b) => b['id'] > a['id'] ? 1 : -1),
        archiveStatesAsc: state => state.archiveStates = state.archiveStates.sort((a, b) => a['id'] > b['id'] ? 1 : -1),
        updateStateComments: (state, comment) => state.showState.comments.unshift(comment),
        deleteCommentInList: (state, comment) => {
            let index = state.showState.comments.findIndex(item => item.id === comment);
            state.showState.comments.splice(index, 1)
        },
        updateTotal: (state, count) => state.total = count,
        updateRating: (state, rating) => state.rating = rating,
    },
    state: {
        states: [],
        showState: {},
        archiveStates: [],
        searchStateMessage: '',
        searchOption: '',
        total: 1,
        rating: 5,
    },
    getters: {
        lastStates: state => state.states,
        totalStates: state => state.total,
        stateRating: state => state.rating,
        showState: state => state.showState,
        allStates: state => {
            if(state.searchOption && state.searchStateMessage) {
                return state.states.filter(note => note[state.searchOption].includes(state.searchStateMessage))
            }
            return state.states
        },
        archiveStates: state => {
            if(state.searchOption && state.searchStateMessage) {
                return state.archiveStates.filter(note => note[state.searchOption].includes(state.searchStateMessage))
            }
            return state.archiveStates
        }
    },
}
