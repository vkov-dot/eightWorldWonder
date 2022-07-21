<template>
    <div class="row create-heading row ">
        <div class="create-heading-content col-lg-8 col-sm-12 justify-content-center">
            <div>
                <div class="create-state-name-heading mb-4">
                    <div class="create-state-name-heading margin-auto-null">
                        <label for="name">Ім'я</label>
                        <input type="text"
                               class="state-name-input"
                               placeholder="Користувач"
                               v-model="userLocal.name">
                    </div>
                    <div v-if="user && user.admin" class="states-heading-input margin-auto-null label">
                        <label for="admin">
                            Роль
                        </label>

                        <select class="form-control" id="heading" name="admin" v-model="userLocal.admin">
                            <option :value="+userLocal.admin">
                                {{ userLocal.admin ? 'Адмін' : 'Користувач' }}
                            </option>
                            <option :value="+!showUser.admin">
                                {{ !userLocal.admin ? 'Адмін' : 'Користувач' }}
                            </option>
                        </select>
                    </div>
                </div>
                <div class="create-state-name-heading mb-4 margin-auto-null">
                    <label for="email">Ел. адреса</label>
                    <input type="text"
                           class="state-name-input"
                           placeholder="Автор"
                           v-model="userLocal.email"
                    >
                </div>
                <div class="create-state-name-heading mb-4 margin-auto-null label">
                    <label for="password">Пароль</label>
                    <input type="password"
                           class="state-name-input"
                           placeholder="Пароль"
                           v-model="userLocal.password">
                </div>
            </div>

            <div class="submit-button">
                <button type="submit" @click="getUpdateUserResponse">
                    Відредагувати
                </button>
            </div>

            <div class="to-page">
                <div>
                    <div>
                        <router-link :to="{ name: 'users.index' }">
                            Назад
                        </router-link>
                    </div>
                    <div>
                        <router-link :to="{ name: 'states.index' }">
                            До статей
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import {mapActions, mapGetters} from "vuex";
import router from "../../router";

export default {
    name: "ProfileEditPage",
    data() {
        return {
            userLocal: {
                id: null,
                name: '',
                email: '',
                password: '',
                admin: '',
            }
        }
    },
    computed: {
        ...mapGetters('profile', ['showUser']),
        ...mapGetters("auth", ["user","apiToken"]),
    },
    methods: {
        ...mapActions('profile', ['getEditUserById', 'updateUser']),
        ...mapActions('auth', ['getUserData']),
        getUpdateUserResponse() {
            this.updateUser(this.userLocal);
        }
    },
    mounted() {
        this.getEditUserById(this.$route.params.user)
        this.getUserData()
    },
    watch: {
        'showUser'() {
            if (this.showUser) {
                this.userLocal.id = this.$route.params.user;
                this.userLocal.name = this.showUser.name;
                this.userLocal.email = this.showUser.email;
                this.userLocal.password = this.showUser.password;
                this.userLocal.admin = this.showUser.admin;
            }
        },
    }
}
</script>
