<template>
    <div class="col-lg-12 last-states notes-list-div">
        <div>
        <ul class="states-list">
            <div class="last-states-title border-bottom-grey">
                <p>
                    {{ categoryName }}
                </p>
            </div>
            <issues-list-element
                v-for="issue in categoryIssues"
                :key="issue.id"
                :issue="issue"
                class="list-element"
            />
        </ul>
        </div>
        <Pagination
            :total="totalCategoryIssues"
            :item="10"
            @page-changed="getPage"
        />
    </div>
</template>

<script>
import {mapActions, mapGetters} from "vuex";
import IssuesListElement from "../list-elements/IssuesListElement";
import Pagination from "../Pagination";

export default {
    name: "CategoryShowPage",
    data() {
        return {
            page: 1,
        }
    },
    components: {
        IssuesListElement, Pagination
    },
    computed: mapGetters('category', ['categoryName', 'categoryIssues', 'totalCategoryIssues']),
    methods: {
        ...mapActions('category', ['getIssuesByCategoryId']),
        getPage() {
            this.getIssuesByCategoryId([this.$route.params.id, this.page]);
        }
    },
    mounted() {
        this.getIssuesByCategoryId([this.$route.params.id, this.page]);
    },
    watch: {
        '$route'(){
            this.getIssuesByCategoryId([this.$route.params.id, this.page]);
        }
    }
}
</script>

<style scoped>

</style>
