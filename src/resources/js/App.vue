<template>
    <div>
        <header>
            <app-header/>
        </header>
        <main
            class="relative col-11 flex items-top justify-center min-h-slogo.tifcreen dark:bg-gray-900 sm:items-center sm:pt-0">
            <div class="row">
                <section>
                    <router-view></router-view>
                </section>
            </div>
        </main>
    </div>
</template>

<script>
import AppHeader from "./components/AppHeader";
import { mapActions, mapGetters } from "vuex";

export default {
    name: "App",
    props: {
        csrfToken: '',
    },
    components: {
        AppHeader
    },
    computed: mapGetters("auth", ["user","apiToken"]),
    methods: {
        ...mapActions("auth", ["getUserData", "sendLogoutRequest"]),
        logout() {
            this.sendLogoutRequest().then(() => {
                this.$router.push({
                    path:'/'
                })
            });
        }
    },
    mounted() {
        if (localStorage.getItem("authToken")) {
            this.getUserData(localStorage.getItem("authToken"));
        }
    }
}
</script>
