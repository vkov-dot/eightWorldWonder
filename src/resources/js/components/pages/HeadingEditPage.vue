<template>
    <div class="row create-heading">
        <div class="create-heading-content">
            <div class="create-heading-form">
                <div>
                    <input type="text" class="add-heading-input" placeholder="Назва рубрики" v-model="heading.name">
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Аватар рубрики</label>
                        <input class="form-control" type="file" id="file" ref="file" @change="addFile()"/>
                    </div>
                </div>
                <div class="submit-button">
                    <button type="submit" @click="updateHeadingButton">
                        Опублікувати
                    </button>
                </div>
            </div>

            <div class="to-page">
                <div>
                    <router-link :to="{ name: 'headings.index' }">Назад</router-link>
                    <router-link :to="{ name: 'start' }">На головну</router-link>
                </div>
            </div>
        </div>
    </div>

</template>

<script>


import {mapActions, mapGetters} from "vuex";

export default {
    name: "HeadingEditPage",
    data() {
        return {
            heading: {
                name: '',
                image: null,
            }
        }
    },
    computed: mapGetters('heading', ['showHeading']),
    methods: {
        ...mapActions('heading', ['editHeading', 'updateHeading']),
        addFile() {
            this.heading.image = this.$refs.file.files[0];
        },
        updateHeadingButton() {
            let formData = new FormData();
            formData.append('id', this.$route.params.heading)
            formData.append('image', this.heading.image);
            formData.append('name', this.heading.name)
            this.updateHeading(formData)
        },
    },
    mounted() {
        this.editHeading(this.$route.params.heading)
    },
    watch: {
        'showHeading'() {
            this.heading.name = this.showHeading.name;
        }
    }
}
</script>
