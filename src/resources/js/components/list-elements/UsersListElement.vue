<template>
    <div>
        <p class="date">
            {{ user.published_at }}
        </p>
        <router-link :to="{ name: 'profile.edit', params: { user: user.id } }" class="state-name">
            {{ user.name }}
        </router-link>
        <p class="author">
            {{ user.email }}
        </p>
    </div>
</template>

<script>
export default {
    name: "UsersListElement",
    props: {
        user: {},
    },
}
</script>

<style scoped>

</style>
