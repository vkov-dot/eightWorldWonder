<template>
    <div>
        <p class="date">
            {{ media.published_at }}
        </p>
        <a :href="media.link"  class="state-name" target="_blank">
            {{ media.name }}
        </a>
        <div v-if="user && user.admin" class="index-folder-form">
            <router-link
                class="btn btn-primary"
                :to="{ name: 'media.edit', params: { folder: media.id }}"
            >
                Редагувати
            </router-link>
            <button class="btn btn-danger" @click="destroyFolderButton">
                Видалити
            </button>
        </div>
    </div>
</template>

<script>
import {mapActions, mapGetters} from "vuex";

export default {
    name: "MediaListElement",
    props: {
        media: {},
    },
    computed: mapGetters('auth', ['user']),
    methods: {
        ...mapActions('media', ['deleteFolder']),
        destroyFolderButton() {
            this.deleteFolder(this.media.id);
        }
    }
}
</script>
