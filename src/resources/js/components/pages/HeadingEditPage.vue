<template>
    <div class="row create-heading">
        <div class="create-heading-content">
            <div class="create-heading-form">
                <div>
                    <input
                        type="text"
                        class="add-heading-input"
                        placeholder="Назва рубрики"
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
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Аватар рубрики</label>
                        <input
                            class="form-control"
                            type="file"
                            id="file"
                            ref="file"
                            @change="addFile()"
                            :class="{invalid: ($v.image.$dirty && (!$v.image.required || !$v.image.requiredIf))}"
                        />
                        <div class="validation-email">
                            <p class="mb-3 mt-1 text-left text-danger h5"
                               v-if="$v.image.$dirty && !$v.image.required">
                                Поле не повинно бути порожнім
                            </p>
                            <p class="mb-3 mt-1 text-left text-danger h5"
                               v-if="$v.image.$dirty && error">
                                Невірний тип файлу
                            </p>
                        </div>
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
import {minLength, required, requiredIf} from "vuelidate/lib/validators";

export default {
    name: "HeadingEditPage",
    data() {
        return {
            name: '',
            image: null,
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
            image: {required},
        }
    },
    computed: mapGetters('heading', ['showHeading']),
    methods: {
        ...mapActions('heading', ['editHeading', 'updateHeading']),
        checkedImage() {
            if(this.$v.image.required && !this.$refs.file.files[0]?.type.includes('image')) {
                this.$v.$touch()
                this.error = true;
                return 0;
            } else {
                this.error = false;
            }
        },
        addFile() {
            this.image = this.$refs.file.files[0];
        },
        updateHeadingButton() {
            this.checkedImage();
            if (this.$v.$invalid && !this.error) {
                this.$v.$touch()
                return
            }
            let formData = new FormData();
            formData.append('id', this.$route.params.heading)
            formData.append('image', this.image);
            formData.append('name', this.name)
            if(!this.error) {
                this.updateHeading(formData)
            }
        },
    },
    mounted() {
        this.editHeading(this.$route.params.heading)
    },
    watch: {
        'showHeading'() {
            this.name = this.showHeading.name;
        }
    }
}
</script>
