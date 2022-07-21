import { axiosInstance } from "../../service/api";
import router from "../../router";

export default {
    namespaced: true,

    actions: {
        async getAllUsers(ctx, pageNumber) {
            if (localStorage.getItem("authToken")) {
                axiosInstance.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem("authToken")}`;
            }
            axiosInstance.get(`http://example.palmo/api/users/all?page=${pageNumber}`)
                .then(response => {
                    ctx.commit('updateUsers', response.data.data)
                    ctx.commit('updateTotal', response.data.total)
                })
                .catch(error => console.log(error));
        },
        async getUserById(ctx, id) {
            if (localStorage.getItem("authToken")) {
                axiosInstance.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem("authToken")}`;
            }
            axiosInstance.get(`http://example.palmo/api/users/${id}/show`)
                .then(response => ctx.commit('updateShowUser', response.data))
                .catch(error => console.log(error));
        },
        async getEditUserById(ctx, id) {
            if (localStorage.getItem("authToken")) {
                axiosInstance.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem("authToken")}`;
            }
            axiosInstance.get(`http://example.palmo/api/users/${id}/edit`)
                .then(response => ctx.commit('updateShowUser', response.data))
                .catch(error => console.log(error));
        },
        async updateUser(ctx, user) {
            if (localStorage.getItem("authToken")) {
                axiosInstance.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem("authToken")}`;
            }
            axiosInstance.put("http://example.palmo/api/users/update", user)
                .then(() => router.push({ name: 'users.index' }))
                .catch(error => console.log(error))
        },
        getSearchMessage: (ctx, message) => ctx.commit('updateSearchMessage', message),
        getSearchOption: (ctx, option) => ctx.commit('updateSearchOption', option),
        deleteComment: (ctx, commentId) => ctx.commit('deleteCommentInList', commentId),
    },
    mutations: {
        updateUsers: (state, states) => state.users = states,
        updateShowUser: (state, user) => state.showUser = user,
        updateSearchMessage: (state, message) => state.searchUserMessage = message,
        updateSearchOption: (state, option) => state.searchUserOption = option,
        usersDesc: state => state.users = state.users.sort((a, b) => b['id'] > a['id'] ? 1 : -1),
        usersAsc: state => state.users = state.users.sort((a, b) => a['id'] > b['id'] ? 1 : -1),
        updateTotal: (state, count) => state.total = count,
    },
    state: {
        users: [],
        showUser: {},
        searchUserMessage: '',
        searchUserOption: '',
        total: 1,
    },
    getters: {
        totalUsers: state => state.total,
        showUser: state => state.showUser,
        allUsers: state => {
            if(state.searchUserOption && state.searchUserMessage) {
                return state.users.filter(note => note[state.searchUserOption].includes(state.searchUserMessage))
            }

            return state.users
        },
    },
}
