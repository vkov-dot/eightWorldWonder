<template>
    <div class="row list">
        <div class="col-lg-10 col-sm-12 last-states issues-list">
            <div class="search-issue-form justify-content-center mb-3">
                <div class="mr-3">
                    <select class="form-control" v-model="sortBy" @change="sortByOption">
                        <option disabled value="">
                            Сортувати
                        </option>
                        <option value="desc">
                            Спочатку новіше
                        </option>
                        <option value="asc">
                            Спочатку старіше
                        </option>
                    </select>
                </div>
                <div class="div-search">
                    <label class="states-search-label">
                        <select class="form-control" v-model="localSearchOption" required>
                            <option disabled value="">
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
                        <div @keyup.enter="searchStates">
                            <input class="add-heading-input search-issue-input"
                                   placeholder="Шукати"
                                   type="text"
                                   v-focus
                                   v-model.trim="localSearchMessage">
                            <div>
                                <button type="submit" class="search-submit" @click="searchStates">
                                    Пошук
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div v-if="archiveStates.length">
                <ul class="states-list">
                    <div class="last-states-title border-bottom-grey">
                        <p>
                            Архів статей
                        </p>
                    </div>
                    <states-list-element
                        v-for="state in archiveStates"
                        :key="state.id"
                        :state="state"
                        class="list-element"
                    />
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
import pagination from "laravel-vue-pagination";
import StatesListElement from "../list-elements/StatesListElement";
import {mapActions, mapGetters, mapMutations} from "vuex";

export default {
    name: "StatesArchivePage",
    data() {
        return {
            sortBy: '',
            localSearchOption: '',
            localSearchMessage: '',
        }
    },
    components: {
        StatesListElement, pagination,
    },
    computed: mapGetters('state', ['archiveStates']),
    methods: {
        ...mapActions('state', ['getArchiveStates', 'getSearchOption', 'getSearchMessage']),
        ...mapMutations('state', ['statesAsc', 'statesDesc']),
        searchStates() {
            this.getSearchMessage(this.localSearchMessage)
            this.getSearchOption(this.localSearchOption)
        },
        sortByOption() {
            if (this.sortBy === 'desc') {
                this.archiveStatesDesc
            } else if (this.sortBy === 'asc') {
                this.archiveStatesAsc
            }
        },
    },
    mounted() {
        this.getArchiveStates()
    },
}
</script>
