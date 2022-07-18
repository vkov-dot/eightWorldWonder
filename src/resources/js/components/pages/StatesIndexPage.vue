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
                        <option value="author">автором</option>
                        <option value="name">назвою</option>
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
        <div v-if="this.allStates.length">
            <states-list :states="this.allStates" v-model:states="this.allStates"/>
        </div>
        <Pagination
            :total="totalStates"
            :item="10"
            @page-changed="getAllStates"
        />
    </div>
</template>

<script>
import StatesList from "../StatesList";
import Pagination from "../Pagination";
import { mapActions, mapGetters, mapMutations } from "vuex";

export default {
    name: "StatesIndexPage",

    data() {
        return {
            sortBy: '',
            localSearchOption: '',
            localSearchMessage: '',
            page: 1,
        }
    },
    components: {
        StatesList, Pagination
    },
    computed: mapGetters('state', ['allStates', 'totalStates']),
    methods: {
        ...mapActions('state', ['getAllStates', 'getSearchOption', 'getSearchMessage']),
        ...mapMutations('state', ['updateStates', 'statesDesc', 'statesAsc']),
        sortByOption() {
            if (this.sortBy === 'desc') {
                this.statesDesc()
            }
            else if (this.sortBy === 'asc') {
                this.statesAsc()
            }
        },
        search() {
            this.getSearchMessage(this.localSearchMessage)
            this.getSearchOption(this.localSearchOption)
        },
    },
    mounted() {
        this.getAllStates(this.page)
    },
}
</script>
