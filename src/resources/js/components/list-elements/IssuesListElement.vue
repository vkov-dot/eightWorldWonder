<template>
    <div>
        <p class="date">
            {{ issue.published_at }}
        </p>
        <a :href="issue.link" class="state-name" target="_blank">
            {{ issue.name }}
        </a>
        <div v-if="user && user.admin && !issue.archived" class="destroy-issue">
            <button type="submit" @click="deleteIssue(issue)">
                До архіва
            </button>
        </div>
        <div v-if="user && user.admin && issue.archived" class="destroy-recover-div">
            <button type="submit" class="destroy-note-submit" @click="deleteIssue(issue)">
                Видалити
            </button>
            <button type="submit" class="recover-note-submit" @click="recoverIssue(issue.id)">
                Відновити
            </button>
        </div>
    </div>
</template>

<script>
import {mapActions, mapGetters} from "vuex";

export default {
    name: "IssueListElement",
    props: {
        issue: Object,
    },
    computed: mapGetters("auth", ["user","apiToken"]),
    methods: {
        ...mapActions(['actionDeleteIssue', 'actionDeleteArchivedIssue', 'actionRecoverIssue']),
        deleteIssue(issue) {
            if(issue.archived === 1) {
                this.actionDeleteArchivedIssue(issue.id)
            } else {
                this.actionDeleteIssue(issue.id)
            }
        },
        recoverIssue(issue) {
            this.actionRecoverIssue(issue)
        },
    },
}
</script>
