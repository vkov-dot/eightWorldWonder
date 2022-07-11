<template>
    <div>
        <p class="date">
            {{ issue.published_at }}
        </p>
        <a :href="issue.link" class="state-name" target="_blank">
            {{ issue.name }}
        </a>
    </div>
</template>

<script>
export default {
    name: "IssueListElement",
    props: {
        issue: Object,
    }
}
</script>
