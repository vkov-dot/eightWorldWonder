import {axiosInstance} from "../../service/api";
import router from "../../router";

export default {
    namespaced: true,

    actions: {
        async getLastIssues(ctx) {
            axios.get("http://example.palmo/api/issues/latest")
                .then(response => ctx.commit('updateLastIssues', response.data))
                .catch(error => console.log(error))
        },
        async getAllIssues(ctx, pageNumber) {
            axios.get(`http://example.palmo/api/issues?page=${pageNumber}`)
                .then(response => {
                    ctx.commit('updateAllIssues', response.data.data)
                    ctx.commit('updateTotal', response.data.total)
                })
                .catch(error => console.log(error))
        },
        async getArchiveIssues(ctx) {
            if (localStorage.getItem("authToken")) {
                axiosInstance.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem("authToken")}`;
            }
            axiosInstance.get("http://example.palmo/api/archived/issues")
                .then(response => ctx.commit('updateArchiveIssues', response.data))
                .catch(error => console.log(error))
        },
        async actionDeleteIssue(ctx, issue) {
            if (localStorage.getItem("authToken")) {
                axiosInstance.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem("authToken")}`;
            }
            await axiosInstance.delete(`http://example.palmo/api/issues/${issue}`)
                .then(() => ctx.commit('deleteIssueInList', issue))
                .catch(error => console.log(error))
        },
        async actionDeleteArchivedIssue(ctx, issue) {
            if (localStorage.getItem("authToken")) {
                axiosInstance.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem("authToken")}`;
            }
            await axiosInstance.delete(`http://example.palmo/api/issues/${issue}`)
                .then(() => ctx.commit('deleteArchivedIssueInList', issue))
                .catch(error => console.log(error))
        },
        async actionRecoverIssue(ctx, issue) {
            if (localStorage.getItem("authToken")) {
                axiosInstance.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem("authToken")}`;
            }
            await axiosInstance.put(`http://example.palmo/api/issues/recover/${issue}`)
                .then(() => ctx.commit('deleteArchivedIssueInList', issue))
                .catch(error => console.log(error))
        },
        async storeIssue(ctx, issue) {
            if (localStorage.getItem("authToken")) {
                axiosInstance.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem("authToken")}`;
            }
            axiosInstance.post("http://example.palmo/api/issues/store", issue)
                .then(() => router.push( { name: 'issues.index' } ))
                .catch(error => console.log(error))
        },
        getIssueSearchMessage(ctx, message) {
            ctx.commit('updateIssueSearchMessage', message)
        },
    },
    mutations: {
        updateLastIssues: (state, issues) => state.lastIssues = issues,
        updateAllIssues: (state, issues) => state.allIssues = issues,
        updateArchiveIssues: (state, archive) => state.archiveIssues = archive,
        updateIssueSearchMessage: (state, message) => state.searchMessage = message,
        deleteIssueInList: (state, issue) => {
            let index = state.allIssues.findIndex(item => item.id === issue);
            state.allIssues.splice(index, 1)
        },
        deleteArchivedIssueInList: (state, issue) => {
            let index = state.archiveIssues.findIndex(item => item.id === issue);
            state.archiveIssues.splice(index, 1)
        },
        updateTotal: (state, count) => state.total = count
    },
    state: {
        lastIssues: [],
        allIssues: [],
        archiveIssues: [],
        searchMessage: '',
        total: 1,
    },
    getters: {
        lastIssues: state => state.lastIssues,
        allIssues: state => state.allIssues.filter(note => note['name'].includes(state.searchMessage)),
        archiveIssues: state => state.archiveIssues.filter(note => note['name'].includes(state.searchMessage)),
        totalIssues: state => state.total
    }
}
