export default {
    actions: {
        async getLastIssues(ctx) {
            axios.get("http://example.palmo/api/issues/latest")
                .then(response => ctx.commit('updateIssues', response.data))
                .catch(error => console.log(error))
        }
    },
    mutations: {
        updateIssues: (state, issues) => state.issues = issues,
    },
    state: {
        issues: []
    },
    getters: {
        lastIssues: state => state.issues,
    },
}
