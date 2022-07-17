import {axiosInstance} from "../../service/api";

export default {
    namespaced: true,

    actions: {
        async postComment(ctx, [state, message]) {
            if(localStorage.getItem("authToken")) {
                axiosInstance.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem("authToken")}`;
            }
            axiosInstance.post(`http://example.palmo/api/states/${state}/comments/store`, { message } )
                .then(response => {
                    console.log(response)
                    ctx.commit('updateStateComments', response.data)
                })
                .catch(error => console.log(error))
        },

        async deleteCommentState(ctx, [state, comment]) {
            if (localStorage.getItem("authToken")) {
                axiosInstance.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem("authToken")}`;
            }
            await axiosInstance.delete(`http://example.palmo/api/states/${state}/comments/${comment}`)
                .then(() => ctx.commit('deleteCommentInList', comment))
                .catch(error => console.log(error))
        }
    },
    mutations: {

    },
    state: {
        stateComments: [],
        commentMessage: '',
    },
    getters: {
        getStateComments: state => state.stateComments,
    },
}
