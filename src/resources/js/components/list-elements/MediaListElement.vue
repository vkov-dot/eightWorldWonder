<template>
    <div>
        <p class="date">
            {{ media.published_at }}
        </p>
        <!--a :href="media.link"-->
        <p  class="state-name">
            {{ media.name }}
        </p>
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
