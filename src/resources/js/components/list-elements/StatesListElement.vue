<template>
    <div>
        <p class="date">
            {{ state.published_at }}
        </p>
        <router-link :to="{ name: 'states.show', params: { state: state.id } }" class="state-name">
            {{ state.name }}
        </router-link>
        <p class="author">
            {{ state.author }}
        </p>
    </div>
</template>

<script>
export default {
    name: "StatesListElement",
    props: {
        state: Object,
    },
}
</script>
