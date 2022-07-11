<template>
    <div class="col-lg-12 last-states notes-list-div">
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
</template>

<script>
import {mapActions, mapGetters} from "vuex";
import IssuesListElement from "../list-elements/IssuesListElement";


export default {
    name: "CategoryShowPage",
    components: {
        IssuesListElement
    },
    computed: mapGetters(['categoryName', 'categoryIssues']),
    methods: {
        ...mapActions(['getIssuesByCategoryId']),
    },
    mounted() {
        this.getIssuesByCategoryId(this.$route.params.id);
    },
    watch: {
        '$route'(){
            this.getIssuesByCategoryId(this.$route.params.id);
        }
    }
}
</script>

<style scoped>

</style>
