import { axiosInstance } from '../../service/api'
import router from "../../router";

export default {
    namespaced: true,
    actions: {
        getUserData(ctx, token=null) {
            if(token) {
                axiosInstance.defaults.headers.common['Authorization'] = `Bearer ${token}`;
            }
            axiosInstance.get("/api/user")
                .then(response => ctx.commit("setUserData", response.data))
                .catch(() => {
                    localStorage.removeItem("authToken");
                    ctx.commit("setApiToken", null);
                });
        },
        sendLoginRequest({ commit }, data) {
            commit("setErrors", {}, { root: true });
            return axiosInstance.post('/api/login', data)
                .then(response => {
                    commit("setUserData", response.data.user);
                    localStorage.setItem("authToken", response.data.token)
                    commit("setApiToken", response.data.token);
                    router.push({ name: 'start' })
                }).catch(err => console.log(err));
        },
        sendRegisterRequest({ commit }, data) {
            commit("setErrors", {}, { root: true });
            return axiosInstance.post("/api/register", data)
                .then(response => {
                    commit("setUserData", response.data.user);
                    localStorage.setItem("authToken", response.data.token);
                    localStorage.setItem('x_xsrf_token', response.config.headers['X-XSRF-TOKEN'])
                    router.push({ name: 'start' })
                })
                .catch(err => console.log(err));
        },
        sendLogoutRequest({ commit }) {
            return axiosInstance.post("/api/logout").then(() => {
                commit("setUserData", null);
                localStorage.removeItem("authToken");
            });
        },
    },
    mutations: {
        setUserData: (state, user) => state.userData = user,
        setApiToken: (state, token) => state.apiToken = token,
    },
    getters: {
        user: state => state.userData,
        apiToken: state => state.apiToken,
    },
    state: () => ({
        userData: null,
        apiToken: '',
    }),

}
