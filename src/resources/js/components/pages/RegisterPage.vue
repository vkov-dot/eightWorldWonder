<template>
    <div class="row justify-content-center mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Реєстрація</div>
                <div class="card-body">
                    <form @submit.prevent="sendCredentials" novalidate>
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">
                                Ім'я
                            </label>

                            <div class="col-md-6">
                                <input id="name" required
                                       type="text" autofocus
                                       class="form-control"
                                       v-model="name"
                                       :class="{invalid: ($v.name.$dirty && (!$v.name.required || !$v.name.requiredIf))}"
                                       name="name"
                                       autocomplete="email"
                                >
                                <div class="validation-email">
                                    <p class="mb-0 mt-1 text-left text-danger"
                                       v-if="$v.name.$dirty && !$v.name.required">
                                        Поле не повинно бути порожнім
                                    </p>
                                    <p class="mb-0 mt-1 text-left text-danger"
                                       v-else-if="$v.name.$dirty && !$v.name.requiredIf">
                                        Перевірте коректність вводу
                                    </p>
                                    <p class="mb-0 mt-1 text-left text-danger"
                                       v-else-if="$v.name.$dirty && !$v.name.minLength">
                                        Ім'я повинно бути мінімум {{ $v.name.$params.minLength.min }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">
                                Електронна адреса
                            </label>

                            <div class="col-md-6">
                                <input id="email"
                                       type="email" required
                                       class="form-control"
                                       v-model="email"
                                       :class="{invalid: ($v.email.$dirty && (!$v.email.required || !$v.email.email))}"
                                       name="email"
                                       autocomplete="email"
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
                                <input id="password" required
                                       type="password"
                                       class="form-control"
                                       name="password"
                                       :class="{invalid: ($v.password.$dirty && (!$v.password.required || !$v.password.minLength))}"
                                       autocomplete="current-password"
                                       v-model="password"
                                >
                                <div class="validation-email">
                                    <p class="mb-0 mt-1 text-left text-danger"
                                       v-if="$v.password.$dirty && !$v.password.required">
                                        Поле не повинно бути порожнім
                                    </p>
                                    <p class="mb-0 mt-1 text-left text-danger"
                                       v-else-if="$v.password.$dirty && !$v.password.minLength">
                                        Пароль повинен бути мінімум {{ $v.password.$params.minLength.min }}
                                    </p>
                                </div>
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
import {email, required, minLength, requiredIf} from 'vuelidate/lib/validators';

export default {
    name: "RegisterPage",
    data: function () {
        return {
            name: "",
            email: "",
            password: "",
            signIn: true,
            user_id: 0,
        };
    },
    validations() {
        return {
            name: {
                required,
                minLength: minLength(6),
                requiredIf: requiredIf(typeof this.name !== 'object')
            },
            email: {email, required},
            password: {required, minLength: minLength(8)},
        }
    },
    mounted() {
        this.setErrors({});
    },
    methods: {
        ...mapMutations(["setErrors"]),
        ...mapActions("auth", ["sendRegisterRequest"]),
        async sendCredentials() {
            if (this.$v.$invalid) {
                this.$v.$touch()
                return
            }
            let details = {
                name: this.name,
                email: this.email,
                password: this.password,
            }
            await this.sendRegisterRequest(details);
        },
    },
    computed: {
        ...mapGetters(["errors"]),
        ...mapGetters("auth", ["user", "apiToken"]),
    },
}
</script>
