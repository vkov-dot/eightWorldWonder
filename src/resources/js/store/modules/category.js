export default {
    namespaced: true,

    actions: {
        async getIssuesByCategoryId(ctx, [id, pageNumber]) {
            axios.get(`http://example.palmo/api/issues/categories/${id}?page=${pageNumber}`)
                .then(response => {
                    ctx.commit('updateCategory', response.data)
                    ctx.commit('updateTotal', response.data.issues.total)
                })
                .catch(error => console.log(error))
        }
    },
    mutations: {
        updateCategory: (state, data) => {
            state.categoryIssues = data.issues.data;
            state.categoryName = data.category[0].name;
        },
        updateTotal: (state, count) => state.total = count,
    },
    state: {
        categoryIssues: [],
        categoryName: '',
        total: 1,
    },
    getters: {
        categoryName: state => state.categoryName,
        categoryIssues: state => state.categoryIssues,
        totalCategoryIssues: state => state.total,
    },
}
