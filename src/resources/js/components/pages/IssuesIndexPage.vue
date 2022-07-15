<template>
    <div class="col-lg-12 last-states notes-list-div">
        <div class="search-issue-form justify-content-center">
            <div>
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
            <div class="search-div ml-3">
                <div @keyup.enter="search" class="d-flex flex-row">
                    <input class="add-heading-input search-issue-input"
                           placeholder="Шукати"
                           type="text"
                           v-model.trim="localSearchMessage">
                    <div>
                        <button type="submit" class="search-submit" @click="search">
                            Пошук
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <ul class="states-list">
            <div class="last-states-title border-bottom-grey">
                <p>
                    Всі випуски
                </p>
            </div>
            <issues-list-element
                v-for="issue in allIssues"
                :key="issue.id"
                :issue="issue"
                class="list-element"
            />
        </ul>
        <pagination class="d-flex justify-content-center" :data="{allIssues}" @pagination-change-page="getAllIssues"></pagination>
    </div>
</template>

<script>
import IssuesListElement from "../list-elements/IssuesListElement";
import pagination from 'laravel-vue-pagination'
import { mapActions, mapGetters, mapMutations } from "vuex";

export default {
    name: "IssuesIndexPage",
    data() {
        return {
            sortBy: '',
            localSearchMessage: '',
        }
    },
    components: {
        IssuesListElement, pagination,
    },
    computed: mapGetters(['allIssues']),
    methods: {
        ...mapActions(['getAllIssues', 'getIssueSearchMessage']),
        ...mapMutations(['updateSearchMessage']),
        search() {
            this.getIssueSearchMessage(this.localSearchMessage)
        },
        sortByOption() {
            if (this.sortBy === 'desc') {
                this.allIssues.sort((a, b) => b['id'] > a['id'] ? 1 : -1);
            }
            else if (this.sortBy === 'asc') {
                this.allIssues.sort((a, b) => a['id'] > b['id'] ? 1 : -1);
            }
        },
    },
    mounted() {
        this.getAllIssues()
    },
}
</script>
