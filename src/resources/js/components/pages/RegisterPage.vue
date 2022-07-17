<template>
    <div class="row justify-content-center mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Реєстрація</div>
                <div class="card-body">
                    <form @submit.prevent="sendCredentials">
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">
                                Ім'я
                            </label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" v-model="details.name"
                                       name="name" required autocomplete="email" autofocus>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">
                                Електронна адреса
                            </label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" v-model="details.email"
                                       name="email" required autocomplete="email">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">
                                Пароль
                            </label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required
                                       autocomplete="current-password" v-model="details.password">
                            </div>
                        </div>
                        <div class="checkbox mb-3 row">
                            <div class="d-flex justify-content-center col-12 ">
                                <button class="btn btn-primary justify-content-end">Реєстрація</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import {mapActions, mapGetters, mapMutations} from "vuex";

export default {
    name: "RegisterPage",
    data: function () {
        return {
            details: {
                name: "",
                email: "",
                password: "",
            },
            signIn: true,
            user_id: 0,
        };
    },
    mounted() {
        this.setErrors({});
    },
    methods: {
        ...mapMutations(["setErrors"]),
        ...mapActions("auth", ["sendRegisterRequest"]),
        async sendCredentials() {
                await this.sendRegisterRequest(this.details);
        },
    },
    computed: {
        ...mapGetters(["errors"]),
        ...mapGetters("auth", ["user", "apiToken"]),
    },
}
</script>

<style scoped>

</style>
