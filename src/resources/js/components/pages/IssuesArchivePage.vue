<template>
    <div class="row list">
        <div class="col-lg-10 col-sm-12 last-states issues-list">
            <div class="search-issue-form justify-content-center mb-3">
                <div>
                    <select class="form-control" v-model="sortBy" @change="sortByOption">
                        <option disabled value="">Сортувати</option>
                        <option value="desc">Спочатку новіше</option>
                        <option value="asc">Спочатку старіше</option>
                    </select>
                </div>
                <div class="search-div ml-2">
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
            <div v-if="archiveIssues.length">
                <ul class="states-list">
                    <div class="last-states-title border-bottom-grey">
                        <p>Архів випусків</p>
                    </div>
                    <issues-list-element
                        v-for="issue in archiveIssues"
                        :key="issue.id"
                        :issue="issue"
                        class="list-element"
                    />
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
import IssuesListElement from "../list-elements/IssuesListElement";
import pagination from "laravel-vue-pagination";
import {mapActions, mapGetters} from "vuex";

export default {
    name: "IssuesArchivePage",
    data() {
        return {
            sortBy: '',
            localSearchMessage: '',
        }
    },
    components: {
        IssuesListElement, pagination,
    },
    computed: mapGetters('issue', ['archiveIssues']),
    methods: {
        ...mapActions('issue', ['getArchiveIssues', 'getIssueSearchMessage']),
        search() {
            this.getIssueSearchMessage(this.localSearchMessage)
        },
        sortByOption() {
            if (this.sortBy === 'desc') {
                this.archiveIssues.sort((a, b) => b['id'] > a['id'] ? 1 : -1);
            } else if (this.sortBy === 'asc') {
                this.archiveIssues.sort((a, b) => a['id'] > b['id'] ? 1 : -1);
            }
        },
    },
    mounted() {
        this.getArchiveIssues()
    },
}
</script>
