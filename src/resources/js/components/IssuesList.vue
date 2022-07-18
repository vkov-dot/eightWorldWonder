<template>
    <div class="row list">
        <div class="col-10 last-states issues-list">
            <div class="col-12">
                <div>
                    <div class="notes-list-div states-list">
                        <ul>
                            <issues-list-element
                                v-for="issue in category"
                                :key="issue.id"
                                :issue="issue"
                                class="list-element"
                            />
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import IssuesListElement from "./list-elements/IssuesListElement";

export default {
    name: "IssuesList",
    components: {
        IssuesListElement
    },
    props: {
        category: [],
    }
}
</script>
