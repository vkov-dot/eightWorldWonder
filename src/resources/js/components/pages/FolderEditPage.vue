<template>
    <div class="row create-heading">
        <div class="create-heading-content">
            <div class="create-heading-form">
                <div>
                    <input type="text" class="add-heading-input" placeholder="Назва папки" v-model="folder.name">
                </div>
                <div>
                    <input type="text" class="add-heading-input" placeholder="Посилання" v-model="folder.link">
                </div>
                <div class="submit-button">
                    <button type="submit" @click="updateFolderButton">
                        Опублікувати
                    </button>
                </div>
            </div>
            <div class="to-page">
                <div>
                    <router-link :to="{ name: 'media.index' }">
                        Назад
                    </router-link>
                    <router-link :to="{ name: 'start' }">
                        На головну
                    </router-link>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import {mapActions, mapGetters} from "vuex";

export default {
    name: "MediaEditPage",
    data() {
        return {
            folder: {
                id: null,
                name: '',
                link: '',
            }
        }
    },
    computed: {
        ...mapGetters('media', ['folderEdit'])
    },
    methods: {
        ...mapActions('media', ['updateFolder', 'getEditFolder']),
        updateFolderButton() {
            this.updateFolder(this.folder);
        }
    },
    mounted() {
        this.getEditFolder(this.$route.params.folder)
    },
    watch: {
        'folderEdit'() {
            if(this.folderEdit) {
                this.folder.id = this.folderEdit.id;
                this.folder.link = this.folderEdit.link;
                this.folder.name = this.folderEdit.name;
            }
        }
    }
}
</script>
