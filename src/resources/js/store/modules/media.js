import {axiosInstance} from "../../service/api";
import router from "../../router";

export default {
    namespaced: true,

    actions: {
        async getAllMedias(ctx, pageNumber) {
            axios.get(`http://example.palmo/api/media?page=${pageNumber}`)
                .then(response => {
                    ctx.commit('updateMedias', response.data.data)
                    ctx.commit('updateTotal', response.data.total)
                })
                .catch(error => console.log(error))
        },
        async storeFolder(ctx, folder) {
            if (localStorage.getItem("authToken")) {
                axiosInstance.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem("authToken")}`;
            }
            axiosInstance.post("http://example.palmo/api/media/store", folder)
                .then(() => router.push( { name: 'media.index' } ))
                .catch(error => console.log(error))
        },
        async getEditFolder(ctx, folder) {
            if (localStorage.getItem("authToken")) {
                axiosInstance.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem("authToken")}`;
            }
            axiosInstance.get(`http://example.palmo/api/media/${folder}/edit`)
                .then((response) => {
                    ctx.commit('setEditFolder', response.data)
                })
                .catch(error => console.log(error))
        },
        async updateFolder(ctx, folder) {
            if (localStorage.getItem("authToken")) {
                axiosInstance.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem("authToken")}`;
            }
            axiosInstance.post(`http://example.palmo/api/media/${folder.id}/update`, folder)
                .then(() => router.push( { name: 'media.index' } ))
                .catch(error => console.log(error))
        },
        async deleteFolder(ctx, folder) {
            if (localStorage.getItem("authToken")) {
                axiosInstance.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem("authToken")}`;
            }
            axiosInstance.delete(`http://example.palmo/api/media/${folder}`)
                .then(() => ctx.commit('deleteFolderInList', folder))
                .catch(error => console.log(error))
        }
    },
    mutations: {
        updateMedias: (state, medias) => state.medias = medias,
        updateTotal: (state, total) => state.total = total,
        setEditFolder: (state, folder) => state.editFolder = folder,
        deleteFolderInList: (state, folder) => {
            let index = state.medias.findIndex(item => item.id === folder);
            state.medias.splice(index, 1)
        },
    },
    state: {
        medias: [],
        total: 1,
        editFolder: {},
    },
    getters: {
        allMedias: state => state.medias,
        totalMedias: state => state.total,
        folderEdit: state => state.editFolder,
    },
}
