<template>
    <div class="text-center">
        <div class="row justify-content-center mt-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Вхід до акаунту</div>
                    <div class="card-body">
                        <form @submit.prevent="sendCredentials" novalidate>
                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">
                                    Електронна адреса
                                </label>

                                <div class="col-md-6">
                                    <input id="email" autofocus
                                           type="email"
                                           class="form-control"
                                           :class="{invalid: ($v.email.$dirty && (!$v.email.required || !$v.email.email))}"
                                           v-model.trim="email"
                                           name="email"
                                           required autocomplete="email"
                                    >
                                    <div class="validation-email">
                                        <p class="mb-0 mt-1 text-left text-danger"
                                           v-if="$v.email.$dirty && !$v.email.required">
                                            Поле не повинно бути порожнім
                                        </p>
                                        <p class="mb-0 mt-1 text-left text-danger"
                                           v-else-if="$v.email.$dirty && !$v.email.email">
                                            Перевірте коректність вводу
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">
                                    Пароль
                                </label>

                                <div class="col-md-6">
                                    <input id="password"
                                           type="password"
                                           class="form-control"
                                           :class="{invalid: ($v.password.$dirty && (!$v.password.required || !$v.password.minLength))}"
                                           name="password" required
                                           autocomplete="current-password"
                                           v-model.trim="password"
                                    >
                                    <div class="validation-email">
                                        <p class="mb-0 mt-1 text-left text-danger" v-if="$v.password.$dirty && !$v.password.required">
                                            Поле не повинно бути порожнім
                                        </p>
                                        <p class="mb-0 mt-1 text-left text-danger" v-else-if="$v.password.$dirty && !$v.password.minLength">
                                            Пароль повинен бути мінімум {{ $v.password.$params.minLength.min }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="checkbox mb-3">
                                <div>
                                    <button class="btn btn-primary">Увійти</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import {mapActions, mapGetters, mapMutations} from "vuex";
import {email, required, minLength} from 'vuelidate/lib/validators';

export default {
    name: 'Auth',
    data() {
        return {
            email: '',
            password: '',
            user_id: 0,
        };
    },
    validations: {
        email: {email, required},
        password: {required, minLength: minLength(8)},
    },
    computed: {
        ...mapGetters(["errors"]),
        ...mapGetters("auth", ["user", "apiToken"]),
    },
    methods: {
        ...mapMutations(["setErrors"]),
        ...mapActions("auth", ["sendLoginRequest", "sendRegisterRequest"]),
        async sendCredentials() {
            if (this.$v.$invalid) {
                this.$v.$touch()
                return
            }
            let details = {
                email: this.email,
                password: this.password,
            }
            await this.sendLoginRequest(details);
        },
    },
    mounted() {
        this.setErrors({});
    },
}
</script>
