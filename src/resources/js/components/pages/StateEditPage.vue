<template>
    <div class="row create-heading">
        <div class="create-heading-content">
            <div>
                <div>
                    <div class="form-group create-state-name-heading">
                        <div class="state-name-div">
                            <input
                                type="text"
                                class="state-name-input"
                                placeholder="Название статьи"
                                v-model="name"
                                :class="{invalid: ($v.name.$dirty && (!$v.name.required || !$v.name.requiredIf || !$v.name.minLength))}"
                            >
                            <div class="validation-email">
                                <p class="mb-3 mt-1 text-left text-danger h5"
                                   v-if="$v.name.$dirty && !$v.name.required">
                                    Поле не повинно бути порожнім
                                </p>
                                <p class="mb-3 mt-1 text-left text-danger h5"
                                   v-else-if="$v.name.$dirty && !$v.name.requiredIf">
                                    Перевірте коректність вводу
                                </p>
                                <p class="mb-3 mt-1 text-left text-danger h5"
                                   v-else-if="$v.name.$dirty && !$v.name.minLength">
                                    Ім'я повинно бути мінімум {{ $v.name.$params.minLength.min }}
                                </p>
                            </div>
                        </div>
                        <div>
                            <div class="states-heading-input">
                                <label for="category">Рубрика</label>
                                <select
                                    class="form-control"
                                    id="heading"
                                    name="heading_id"
                                    v-model="heading_id"
                                    :class="{invalid: ($v.heading_id.$dirty && (!$v.heading_id.required || !$v.heading_id.requiredIf))}"
                                >
                                    <option :value="heading.id" v-for="heading in headingNames" :key="heading.id">
                                        {{ heading.name }}
                                    </option>
                                </select>
                            </div>
                            <p class="mb-3 mt-1 text-left text-danger h5"
                               v-if="$v.heading_id.$dirty && !$v.heading_id.required">
                                Поле не повинно бути порожнім
                            </p>
                            <p class="mb-3 mt-1 text-left text-danger h5"
                               v-else-if="$v.heading_id.$dirty && !$v.heading_id.requiredIf">
                                Перевірте правильність вводу
                            </p>
                        </div>
                    </div>
                    <div class="state-logo-input">
                        <div>
                            <label for="formFile" class="form-label">Титульна картинка</label>
                            <input
                                class="form-control"
                                type="file"
                                id="file"
                                ref="file"
                                :class="{invalid: ($v.logo.$dirty && (!$v.logo.required || !$v.logo.requiredIf || error))}"
                            />
                            <div class="validation-email">
                                <p class="mb-3 mt-1 text-left text-danger h5"
                                   v-if="$v.logo.$dirty && !$v.logo.required">
                                    Поле не повинно бути порожнім
                                </p>
                                <p class="mb-3 mt-1 text-left text-danger h5"
                                   v-if="$v.logo.$dirty && error">
                                    Невірний тип файлу
                                </p>
                            </div>
                        </div>
                    </div>

                    <textarea name="body" v-model="body"></textarea>
                    <div class="validation-email">
                        <p class="mb-3 mt-1 text-left text-danger h5"
                           v-if="$v.body.$dirty && !$v.body.required">
                            Поле не повинно бути порожнім
                        </p>
                        <p class="mb-3 mt-1 text-left text-danger h5"
                           v-else-if="$v.body.$dirty && !$v.body.requiredIf">
                            Перевірте коректність вводу
                        </p>
                        <p class="mb-3 mt-1 text-left text-danger h5"
                           v-else-if="$v.body.$dirty && !$v.body.minLength">
                            Довжина статті має бути мінімум {{ $v.body.$params.minLength.min }} символів
                        </p>
                    </div>
                    <div class="state-author-div">
                        <input
                            type="text"
                            class="state-author-input"
                            placeholder="Автор"
                            v-model="author"
                            :class="{invalid: ($v.author.$dirty && (!$v.author.required || !$v.author.requiredIf))}"
                        >
                        <div class="validation-email">
                            <p class="mb-3 mt-1 text-left text-danger h5"
                               v-if="$v.author.$dirty && !$v.author.required">
                                Поле не повинно бути порожнім
                            </p>
                            <p class="mb-3 mt-1 text-left text-danger h5"
                               v-else-if="$v.author.$dirty && !$v.author.requiredIf">
                                Перевірте коректність вводу
                            </p>
                        </div>
                    </div>
                </div>

                <div class="submit-button">
                    <button @click="createState">Опублікувати</button>
                </div>
            </div>

            <div class="to-page">
                <div>
                    <div>
                        <router-link :to="{ name: 'addInfo' }">Назад</router-link>
                    </div>
                    <div>
                        <router-link :to="{ name: 'states.index' }">До статей</router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {mapActions, mapGetters} from "vuex";
import {minLength, required, requiredIf} from "vuelidate/lib/validators";

export default {
    name: "StateEditPage",
    data() {
        return {
            ckeditor: null,
            name: '',
            heading_id: '',
            logo: '',
            body: '',
            author: '',
            error: null,
        }
    },
    validations() {
        return {
            name: {
                required,
                minLength: minLength(6),
                requiredIf: requiredIf(typeof this.name === 'string')
            },
            heading_id: {
                required,
                requiredIf: requiredIf(typeof this.heading_id === 'number'),
            },
            logo: {required},
            body: {
                required,
                minLength: minLength(100),
                requiredIf: requiredIf(typeof this.body === 'string')
            },
            author: {
                required,
                requiredIf: requiredIf(typeof this.author === 'string')
            },
        }
    },
    computed: {
        ...mapGetters('heading', ['headingNames']),
        ...mapGetters('state', ['showState']),
    },
    methods: {
        ...mapActions('state', ['storeState', 'getStateById', 'updateState']),
        ...mapActions('heading', ['getHeadingNames']),
        checkedImage() {
            if (this.$v.logo.required && !this.$refs.file.files[0]?.type.includes('image')) {
                this.$v.$touch()
                this.error = true;
                return 0;
            } else {
                this.error = false;
            }
        },
        createState() {
            this.checkedImage();
            this.logo = this.$refs.file.files[0];
            this.body = CKEDITOR.instances['body'].getData();
            if (this.$v.$invalid && !this.error) {
                this.$v.$touch()
                return
            }
            let formData = new FormData();
            formData.append('id', this.$route.params.state);
            formData.append('logo', this.logo);
            formData.append('name', this.name);
            formData.append('heading_id', this.heading_id);
            formData.append('body', this.body);
            formData.append('author', this.author);
            if (!this.error) {
                this.updateState([formData, this.$route.params.state])
            }
        }
    },
    mounted() {
        this.getHeadingNames();
        this.getStateById(this.$route.params.state);
        this.ckeditor = CKEDITOR.replace('body').stringify;
    },
    watch: {
        'showState'() {
            if (this.showState) {
                this.name = this.showState.name;
                this.body = this.showState.body;
                this.author = this.showState.author;
                this.heading_id = this.showState.heading_id;
            }
        }
    },
}
</script>

