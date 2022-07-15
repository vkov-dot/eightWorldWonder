<template>
    <div class="row create-heading">
        <div class="create-heading-content">
            <div>
                <div>
                    <div class="form-group create-state-name-heading">
                        <div class="state-name-div">
                            <input type="text" class="state-name-input" placeholder="Название статьи" name="name">
                        </div>

                        <div class="states-heading-input">
                            <label for="category">Рубрика</label>
                            <select class="form-control" id="heading" name="heading_id">
                                <option :value="heading.id" v-for="heading in headingNames" :key="heading.id">
                                    {{ heading.name }}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="state-logo-input">
                        <div>
                            <label for="formFile" class="form-label">Титульная картинка</label>
                            <input class="form-control" type="file" id="formFile" name="logo">
                        </div>
                    </div>

                    <textarea name="body"></textarea>
                    <div>
                        {{ ckeditor }}
                    </div>

                    <div class="state-author-div">
                        <input type="text" class="state-author-input"
                               placeholder="Автор" name="author">
                    </div>
                </div>

                <div class="submit-button">
                    <button type="submit">Створити</button>
                </div>
            </div>

            <div class="to-page">
                <div>
                    <div>
                        <router-link :to="{ name: 'addInfo' }">
                            Назад
                        </router-link>
                    </div>
                    <div>
                        <router-link :to="{ name: 'states.index' }">
                            До статей
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapActions, mapGetters} from "vuex";

export default {
    name: "StatesCreatePage",
    data() {
        return {
            ckeditor,
        }
    },
    computed: mapGetters(['headingNames']),
    methods: {
        ...mapActions(['getHeadingNames']),
    },
    mounted() {
        this.getHeadingNames();
        this.ckeditor = CKEDITOR.replace('body').stringify;
    }
}

</script>

<style scoped>

</style>
