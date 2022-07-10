export default {
    actions: {
        async getAllMedias(ctx) {
            return await axios.get("http://example.palmo/api/media")
                .then(response => ctx.commit('updateMedias', response.data))
                .catch(error => console.log(error))
        }
    },
    mutations: {
        updateMedias: (state, medias) => state.medias = medias,
    },
    state: {
        medias: []
    },
    getters: {
        allMedias: state => state.medias,
    },
}
