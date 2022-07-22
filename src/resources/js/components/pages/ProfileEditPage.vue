<template>
    <div class="row create-heading row ">
        <div class="create-heading-content col-lg-8 col-sm-12 justify-content-center">
            <div>
                <div class="create-state-name-heading mb-4">
                    <div>
                        <div class="create-state-name-heading margin-auto-null">
                            <label for="name">Ім'я</label>
                            <input type="text"
                                   class="state-name-input"
                                   placeholder="Користувач"
                                   v-model="name"
                                   :class="{invalid: ($v.name.$dirty && (!$v.name.required || !$v.name.requiredIf))}"
                            >
                        </div>
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
                    <div v-if="user && user.admin" class="states-heading-input margin-auto-null label">
                        <label for="admin">
                            Роль
                        </label>

                        <select class="form-control" id="heading" name="admin" v-model="admin">
                            <option :value="+admin">
                                {{ admin ? 'Адмін' : 'Користувач' }}
                            </option>
                            <option :value="+!showUser.admin">
                                {{ !admin ? 'Адмін' : 'Користувач' }}
                            </option>
                        </select>
                    </div>
                </div>
                <div class="create-state-name-heading mb-0 margin-auto-null">
                    <label for="email">Ел. адреса</label>
                    <input type="text"
                           class="state-name-input"
                           placeholder="Автор"
                           v-model="email"
                           :class="{invalid: ($v.email.$dirty && (!$v.email.required || !$v.email.email))}"
                    >
                </div>
                <div class="validation-email mt-0">
                    <p class="text-left text-danger"
                       v-if="$v.email.$dirty && !$v.email.required">
                        Поле не повинно бути порожнім
                    </p>
                    <p class="mb-0 mt-1 text-left text-danger"
                       v-else-if="$v.email.$dirty && !$v.email.email">
                        Перевірте коректність вводу
                    </p>
                </div>
                <div class="create-state-name-heading mb-4 mt-4 margin-auto-null label">
                    <label for="password">Пароль</label>
                    <input type="password"
                           class="state-name-input"
                           placeholder="Пароль"
                           v-model="password"
                           :class="{invalid: ($v.password.$dirty && !$v.password.minLength)}"
                    >
                    <div class="validation-email">
                        <p class="mb-0 mt-1 text-left text-danger"
                           v-if="$v.password.$dirty && !$v.password.minLength">
                            Пароль повинен бути мінімум {{ $v.password.$params.minLength.min }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="submit-button">
                <button type="submit" @click="getUpdateUserResponse">Відредагувати</button>
            </div>

            <div class="to-page">
                <div>
                    <div>
                        <router-link :to="{ name: 'users.index' }">Назад</router-link>
                    </div>
                    <div>
                        <router-link :to="{ name: 'states.index' }">До статей</router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import {mapActions, mapGetters} from "vuex";
import {email, minLength, required, requiredIf, maxLength} from "vuelidate/lib/validators";

export default {
    name: "ProfileEditPage",
    data() {
        return {
            id: null,
            name: '',
            email: '',
            password: '',
            admin: '',
        }
    },
    validations() {
        return {
            name: {
                required,
                minLength: minLength(6),
                requiredIf: requiredIf(typeof this.name !== 'object')
            },
            email: {
                email, required
            },
            password: {
                minLength: minLength(8)
            },
            admin: {
                required,
                minLength: minLength(0),
                maxLength: maxLength(1),
            }
        }
    },
    computed: {
        ...mapGetters('profile', ['showUser']),
        ...mapGetters("auth", ["user", "apiToken"]),
    },
    methods: {
        ...mapActions('profile', ['getEditUserById', 'updateUser']),
        ...mapActions('auth', ['getUserData']),
        getUpdateUserResponse() {
            if (this.$v.$invalid) {
                this.$v.$touch()
                return
            }
            let user = {
                id: this.id,
                name: this.name,
                email: this.email,
                password: this.password,
                admin: this.admin,
            }
            this.updateUser(user);
        }
    },
    mounted() {
        this.getEditUserById(this.$route.params.user)
        this.getUserData()
    },
    watch: {
        'showUser'() {
            if (this.showUser) {
                this.id = this.$route.params.user;
                this.name = this.showUser.name;
                this.email = this.showUser.email;
                this.password = this.showUser.password;
                this.admin = this.showUser.admin;
            }
        },
    }
}
</script>
