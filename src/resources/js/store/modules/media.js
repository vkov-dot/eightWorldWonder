import {axiosInstance} from "../../service/api";
import router from "../../router";

export default {
    actions: {
        async getAllMedias(ctx) {
            return await axios.get("http://example.palmo/api/media")
                .then(response => ctx.commit('updateMedias', response.data))
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
    },
    state: {
        medias: []
    },
    getters: {
        allMedias: state => state.medias,
    },
}
