<template>
    <div>
        <p class="date">
            {{ media.published_at }}
        </p>
        <!--a :href="media.link"-->
        <a :href="media.link"  class="state-name" target="_blank">
            {{ media.name }}
        </a>
    </div>
</template>

<script>
export default {
    name: "MediaListElement",
    props: {
        media: Array,
    },
}
</script>

<style scoped>

</style>
