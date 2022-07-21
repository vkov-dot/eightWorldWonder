import {axiosInstance} from "../../service/api";
import router from "../../router";

export default {
    namespaced: true,

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
        async getHeadingNames(ctx) {
            axios.get("http://example.palmo/api/headings/names")
                .then(response => ctx.commit('updateHeadingNames', response.data))
                .catch(error => console.log(error))
        },
        async storeHeading(ctx, heading) {
            if (localStorage.getItem("authToken")) {
                axiosInstance.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem("authToken")}`;
            }
            axiosInstance.post("http://example.palmo/api/headings/store", heading)
                .then(() => router.push({ name: 'headings.index' }))
                .catch(error => console.log(error))
        },
        async deleteHeading(ctx, heading) {
            if (localStorage.getItem("authToken")) {
                axiosInstance.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem("authToken")}`;
            }
            axiosInstance.delete(`http://example.palmo/api/headings/delete/${heading}`)
                .then(() => router.push({ name: 'headings.index' }))
                .catch(error => console.log(error))
        },
        async editHeading(ctx, heading) {
            if (localStorage.getItem("authToken")) {
                axiosInstance.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem("authToken")}`;
            }
            axiosInstance.get(`http://example.palmo/api/headings/${heading}/edit`)
                .then(response => ctx.commit('updateShowHeading', response.data))
                .catch(error => console.log(error))
        },
        async updateHeading(ctx, heading) {
            if (localStorage.getItem("authToken")) {
                axiosInstance.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem("authToken")}`;
            }
            axiosInstance.post(`http://example.palmo/api/headings/${heading.id}/update`, heading)
                .then(() => router.push({ name: 'headings.index' }) )
                .catch(error => console.log(error))
        },
    },
    mutations: {
        updateHeadings: (state, headings) => state.headings = headings,
        updateStates: (state, states) => state.states = states,
        updateHeadingNames: (state, headingNames) => state.headingNames = headingNames,
        updateShowHeading: (state, showHeading) => state.showHeading = showHeading,
    },
    state: {
        headings: [],
        states: [],
        headingNames: [],
        showHeading: {},
    },
    getters: {
        allHeadings: state => state.headings,
        headingStates: state => state.states,
        headingNames: state => state.headingNames,
        showHeading: state => state.showHeading,
    },
}
