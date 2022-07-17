<template>
    <div class="last-states issues-list">
        <div class="search-issue-form justify-content-center">
            <div class="mr-3">
                <select class="form-control" v-model="sortBy" @change="sortByOption">
                    <option disabled value="">Сортувати</option>
                    <option value="desc">Спочатку новіше</option>
                    <option value="asc">Спочатку старіше</option>
                </select>
            </div>
            <div class="div-search">
                <label class="states-search-label">
                    <select class="form-control" v-model="localSearchOption" required>
                        <option disabled value="">Шукати за</option>
                        <option value="name">ім'ям</option>
                        <option value="email">поштою</option>
                    </select>
                </label>
                <div>
                    <div @keyup.enter="search">
                        <input class="add-heading-input search-issue-input"
                               placeholder="Шукати"
                               type="text"
                               v-focus
                               v-model.trim="localSearchMessage">
                        <div>
                            <button type="submit" class="search-submit" @click="search">
                                Пошук
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="this.allUsers?.length">
            <div>
                <div class="col-lg-12 last-states notes-list-div mr-auto ml-auto">
                    <ul class="states-list">
                        <div class="last-states-title border-bottom-grey">
                            <p>
                                Користувачі
                            </p>
                        </div>
                        <users-list-element
                            v-for="user in allUsers"
                            :key="user.id"
                            :user="user"
                            class="list-element"
                        />
                    </ul>
                </div>
            </div>
        </div>
        <pagination
            :total="totalUsers"
            :item="10"
            @page-changed="getAllUsers"
        />
    </div>

</template>

<script>
import { mapActions, mapGetters, mapMutations } from "vuex";
import UsersListElement from "../list-elements/UsersListElement";
import Pagination from "../Pagination";

export default {
    name: "UsersIndexPage",
    components: {
        UsersListElement, Pagination
    },
    data() {
        return {
            sortBy: '',
            localSearchOption: '',
            localSearchMessage: '',
            page: 1,
        }
    },

    computed: mapGetters('user', ['allUsers', 'totalUsers']),

    methods: {
        ...mapActions('user', ['getAllUsers', 'getSearchOption', 'getSearchMessage']),
        ...mapMutations('user', ['usersDesc', 'usersAsc']),
        sortByOption() {
            if (this.sortBy === 'desc') {
                this.usersDesc()
            }
            else if (this.sortBy === 'asc') {
                this.usersAsc()
            }
        },
        search() {
            this.getSearchMessage(this.localSearchMessage)
            this.getSearchOption(this.localSearchOption)
        },
    },
    mounted() {
        this.getAllUsers(this.page)
    },
}
</script>

<style scoped>

</style>
