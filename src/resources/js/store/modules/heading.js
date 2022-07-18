import {axiosInstance} from "../../service/api";

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
                .then(response => console.log(response)/*ctx.commit('updateStates', response.data)*/)
                .catch(error => console.log(error))
        }
    },
    mutations: {
        updateHeadings: (state, headings) => state.headings = headings,
        updateStates: (state, states) => state.states = states,
        updateHeadingNames: (state, headingNames) => state.headingNames = headingNames,
    },
    state: {
        headings: [],
        states: [],
        headingNames: [],
    },
    getters: {
        allHeadings: state => state.headings,
        headingStates: state => state.states,
        headingNames: state => state.headingNames,
    },
}
