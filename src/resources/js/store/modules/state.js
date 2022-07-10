export default {
    actions: {
        async getAllStates(ctx) {
            return await axios("http://example.palmo/api/states/")
                .then(response => ctx.commit('updateStates', response.data))
                .catch(error => console.log(error));
        },
        async getLastStates(ctx) {
            return await axios("http://example.palmo/api/states/latest")
                .then(response => ctx.commit('updateStates', response.data))
                .catch(error => console.log(error));
        },
        async getStateById(ctx, id) {
            return await axios(`http://example.palmo/api/states/${id}`)
                .then(response => ctx.commit('updateShowState', response.data))
                .catch(error => console.log(error));
        }
    },
    mutations: {
        updateStates: (state, states) => state.states = states,
        updateShowState: (state, showState) => state.showState = showState,
    },
    state: {
        states: [],
        showState: Object,
    },
    getters: {
        allStates: state => state.states,
        lastStates: state => state.states,
        showState: state => state.showState
    },
}
