<template>
    <div class="text-center">
        <div class="form-signin">
            <form @submit.prevent="sendCredentials">
                <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
                <div class="form-floating">
                <input type="email" v-model="details.email" class="form-control" id="floatingEmail" placeholder="name@example.com">
                <label for="floatingEmail">Email address</label>
            </div>
                <div class="form-floating">
                    <input type="password" v-model="details.password" class="form-control" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">Password</label>
                </div>

                <div class="checkbox mb-3">
                    <label>
                        <span v-if="signIn" @click="signIn = !signIn"  class="signin text-decoration-underline"> Sign In </span>
                        <span v-else @click="signIn = !signIn" class="signin text-decoration-underline"> Log In </span>
                    </label>
                </div>
                <button v-if="signIn" class="w-100 btn btn-lg btn-primary"> Login </button>
                <button v-else class="w-100 btn btn-lg btn-primary"> Sign in </button>
                <p class="mt-5 mb-3 text-muted">&copy;Palmo-mater 2022</p>
            </form>
        </div>
    </div>
</template>
<script>
import {mapActions, mapGetters, mapMutations} from "vuex";
export default {
    name: 'Auth',
    data: function () {
        return {
            details: {
                name: "John Doe",
                email: "palmo@example.net",
                password: "12345678",
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
        ...mapActions("auth", ["sendLoginRequest", "sendRegisterRequest"]),
        async sendCredentials() {
            if (this.signIn) {
                await this.sendLoginRequest(this.details);
            } else {
                await this.sendRegisterRequest(this.details);
            }
        },
    },
    computed: {
        ...mapGetters(["errors"]),
        ...mapGetters("auth", ["user", "apiToken"]),
    },
}
</script>
