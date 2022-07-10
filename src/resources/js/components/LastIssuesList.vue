<template>
    <div class="col-lg-12 last-states notes-list-div">
        <ul class="states-list">
            <div class="last-states-title border-bottom-grey">
                <p>
                    Останні випуски
                </p>
            </div>
            <issues-list-element
                v-for="issue in issues"
                :key="issue.id"
                :issue="issue"
                class="list-element"
            />
        </ul>
    </div>
</template>

<script>
import IssuesListElement from "./list-elements/IssuesListElement";

export default {
    name: "LastIssuesList",
    components: {
        IssuesListElement
    },
    props: {
        issues: Array
    },
}
</script>
