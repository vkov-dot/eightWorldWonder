import {axiosInstance} from "../../service/api";
import router from "../../router";

export default {
    namespaced: true,

    actions: {
        async getAllMedias(ctx, pageNumber) {
            return await axios.get(`http://example.palmo/api/media?page=${pageNumber}`)
                .then(response => {
                    console.log(response)
                    ctx.commit('updateMedias', response.data.data)
                    ctx.commit('updateTotal', response.data.total)
                })
                .catch(error => console.log(error))
        },
        async storeFolder(ctx, issue) {
            if (localStorage.getItem("authToken")) {
                axiosInstance.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem("authToken")}`;
            }
            axiosInstance.post("http://example.palmo/api/media/store", issue)
                .then(() => router.push( { name: 'media.index' } ))
                .catch(error => console.log(error))
        },
    },
    mutations: {
        updateMedias: (state, medias) => state.medias = medias,
        updateTotal: (state, total) => state.total = total,
    },
    state: {
        medias: [],
        total: 1,
    },
    getters: {
        allMedias: state => state.medias,
        totalMedias: state => state.total,
    },
}
