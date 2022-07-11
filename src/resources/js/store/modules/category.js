export default {
    actions: {
        async getIssuesByCategoryId(ctx, id) {
            axios.get(`http://example.palmo/api/issues/categories/${id}`)
                .then(response => ctx.commit('updateCategory', response.data))
                .catch(error => console.log(error))
        }
    },
    mutations: {
        updateCategory: (state, data) => {
            state.categoryIssues = data.issues.data;
            state.categoryName = data.category[0].name;
        },
    },
    state: {
        categoryIssues: [],
        categoryName: '',
    },
    getters: {
        categoryName: state => state.categoryName,
        categoryIssues: state => state.categoryIssues
    },
}
