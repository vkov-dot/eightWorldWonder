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
                            <label for="formFile" class="form-label">Титульна картинка</label>
                            <input class="form-control" type="file" id="file" ref="file"/>
                        </div>
                    </div>

                    <textarea name="body" v-model="state.body"></textarea>

                    <div class="state-author-div">
                        <input type="text" class="state-author-input" placeholder="Автор" v-model="state.author">
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
    name: "StateEditPage",
    data() {
        return {
            ckeditor: null,
            state: {
                name: '',
                heading_id: '',
                logo: '',
                body: '',
                author: '',
            }
        }
    },
    computed: {
        ...mapGetters('heading', ['headingNames']),
        ...mapGetters('state', ['showState']),
    },
    methods: {
        ...mapActions('state', ['storeState', 'getStateById', 'updateState']),
        ...mapActions('heading', ['getHeadingNames']),
        createState() {
            this.state.logo = this.$refs.file.files[0];
            this.state.body = CKEDITOR.instances['body'].getData();
            let formData = new FormData();
            formData.append('id', this.$route.params.state);
            formData.append('logo', this.state.logo);
            formData.append('name', this.state.name);
            formData.append('heading_id', this.state.heading_id);
            formData.append('body', this.state.body);
            formData.append('author', this.state.author);
            this.updateState([formData, this.$route.params.state])
        }
    },
    mounted() {
        this.getHeadingNames();
        this.getStateById(this.$route.params.state);
        this.ckeditor = CKEDITOR.replace('body').stringify;
    },
    watch: {
        'showState'() {
            if(this.showState) {
                this.state.name = this.showState.name;
                this.state.body = this.showState.body;
                this.state.author = this.showState.author;
                this.state.heading_id = this.showState.heading_id;
            }
        }
    },
}
</script>

