<template>
    <div class="last-states issues-list">
        <div class="search-issue-form justify-content-center">
            <div class="mr-3">
                <select class="form-control" v-model="sortBy" @change="sortByOption">
                    <option disabled value="">
                        Сортувати
                    </option>
                    <option value="asc">
                        Спочатку новіше
                    </option>
                    <option value="desc">
                        Спочатку старіше
                    </option>
                </select>
            </div>
            <div class="div-search">
                <label class="states-search-label">
                    <select class="form-control" v-model="searchOption" required>
                        <option disabled value="" >
                            Шукати за
                        </option>
                        <option value="author">
                            автором
                        </option>
                        <option value="name">
                            назвою
                        </option>
                    </select>
                </label>
                <div>
                    <div @keyup.enter="searchToMixin">
                        <input class="add-heading-input search-issue-input"
                               placeholder="Шукати"
                               type="text"
                               v-focus
                               v-model.trim="searchMessage">
                        <div>
                            <button type="submit" class="search-submit" @click="searchToMixin">
                                Пошук
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="this.states.length">
            <index-states-list :states="this.states" v-model:states="this.states"/>
        </div>
    </div>
</template>

<script>
import indexStatesList from "../IndexStatesList";
import { mapActions, mapGetters } from "vuex";
import searchMixin from "../../mixins/search";

export default {
    name: "StatesIndexPage",
    mixins: [searchMixin],
    data() {
        return {
            sortBy: '',
            states: Array,
        }
    },
    components: {
        indexStatesList,
    },
    computed: mapGetters(['allStates']),
    methods: {
        ...mapActions(['getLastStates']),

        ToStateShowPage(id) {
            this.$router.push({name: 'states.show', state: id})
        },

        sortByOption() {
            if (this.sortBy === 'desc') {
                this.allStates.sort((a, b) => b['id'] > a['id'] ? 1 : -1);
            }
            else if (this.sortBy === 'asc') {
                this.allStates.sort((a, b) => a['id'] > b['id'] ? 1 : -1);
            }
        },
        searchToMixin() {
            this.states = this.search(this.allStates)
        },
    },
    beforeMount() {
        this.states = this.allStates
        console.log(this.states)
    },
    mounted() {
        this.getAllStates;
    },
}
</script>

<style scoped>

</style>
