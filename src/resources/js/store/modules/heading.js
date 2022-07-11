export default {
    actions: {
        async getAllHeadings(ctx) {
            axios.get("http://example.palmo/api/headings")
                .then(response => ctx.commit('updateHeadings', response.data))
                .catch(error => console.log(error))
        },
        async getStatesByHeadingId(ctx, heading) {
            axios.get(`http://example.palmo/api/headings/${heading}`)
                .then(response => ctx.commit('updateStates', response.data))
                .catch(error => console.log(error))
        },
    },
    mutations: {
        updateHeadings: (state, headings) => state.headings = headings,
        updateStates: (state, states) => state.states = states,
    },
    state: {
        headings: [],
        states: [],
    },
    getters: {
        allHeadings: state => state.headings,
        headingStates: state => state.states,
    },
}
