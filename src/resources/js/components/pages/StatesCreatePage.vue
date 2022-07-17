<template>
    <div class="row create-heading">
        <div class="create-heading-content">
            <div>
                <div>
                    <div class="form-group create-state-name-heading">
                        <div class="state-name-div">
                            <input type="text" class="state-name-input" placeholder="Название статьи" v-model="state.name">
                        </div>

                        <div class="states-heading-input">
                            <label for="category">Рубрика</label>
                            <select class="form-control" id="heading" name="heading_id" v-model="state.heading_id">
                                <option :value="heading.id" v-for="heading in headingNames" :key="heading.id">
                                    {{ heading.name }}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="state-logo-input">
                        <div>
                            <label for="formFile" class="form-label">Титульная картинка</label>
                            <input class="form-control" name="logo[]" type="file" id="formFile" @change="addFile">
                        </div>
                    </div>

                    <textarea name="body" v-model="state.body">
                        {{ state.body }}
                    </textarea>

                    <div class="state-author-div">
                        <input type="text" class="state-author-input"
                               placeholder="Автор" v-model="state.author">
                    </div>
                </div>

                <div class="submit-button">
                    <button @click="createState">
                        Опублікувати
                    </button>
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
            state: {
                name: '',
                heading_id: '',
                logo: {},
                body: '',
                author: '',
            }
        }
    },
    computed: mapGetters('heading', ['headingNames']),
    methods: {
        ...mapActions('state',['storeState']),
        ...mapActions('heading',['getHeadingNames']),
        addFile(event) {
            let formData = new FormData();
            formData.append('logo[]', event.target.files[0])
            this.logo = formData;
            console.log(this.logo)
        },
        createState() {
            this.storeState(this.state)
        }
    },
    mounted() {
        this.getHeadingNames();
        this.ckeditor = CKEDITOR.replace('body').stringify
    }
}

</script>
