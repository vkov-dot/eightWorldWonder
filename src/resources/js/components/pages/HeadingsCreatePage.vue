<template>
    <div class="row create-heading">
        <div class="create-heading-content">
                 <div class="create-heading-form">
                <div>
                    <input type="text" class="add-heading-input" placeholder="Назва рубрики" v-model="heading.name">
                    <div class="mb-3">
                        <label for="formFile" class="form-label">
                            Аватар рубрики
                        </label>
                        <input class="form-control" type="file" id="file" ref="file" @change="addFile()"/>
                    </div>
                </div>
                <div class="submit-button">
                    <button type="submit" @click="submitHeading()">
                        Опублікувати
                    </button>
                </div>
            </div>

            <div class="to-page">
                <div>
                    <router-link :to="{ name: 'addInfo' }">
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
import {mapActions} from "vuex";

export default {
    name: "HeadingsCreatePage",
    data() {
        return {
            heading: {
                name: '',
                image: {},
            }
        }
    },
    methods: {
        ...mapActions('heading', ['storeHeading']),
        addFile() {
            this.heading.image = this.$refs.file.files[0];
        },
        submitHeading() {
            let formData = new FormData();
            formData.append('image', this.heading.image);
            formData.append('name', this.heading.name)
            this.storeHeading(formData)
        },
    }
}
</script>

