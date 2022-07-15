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
                    <button type="submit" @click="folderStore">
                        Опублікувати
                    </button>
                </div>
            </div>

            <div class="to-page">
                <div>
                    <router-link :to="{ name: 'addInfo' }">
                        Назад
                    </router-link>
                    <router-link :to="{ name: 'start.index' }">
                        На головну
                    </router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {mapActions} from "vuex";

export default {
    name: "FolderCreate",
    data() {
        return {
            folder: {
                name: '',
                link: '',
            }
        }
    },
    methods: {
        ...mapActions(['storeFolder']),
        folderStore() {
            this.storeFolder(this.folder)
        }
    }
}
</script>

<style scoped>

</style>
