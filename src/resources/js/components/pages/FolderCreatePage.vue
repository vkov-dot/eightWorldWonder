<template>
    <div class="row create-heading">
        <div class="create-heading-content">
            <div class="create-heading-form">
                <div>
                    <input
                        type="text"
                        class="add-heading-input"
                        placeholder="Назва папки"
                        v-model="name"
                        :class="{invalid: ($v.name.$dirty && (!$v.name.required || !$v.name.requiredIf))}"
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
                    <input
                        type="text"
                        class="add-heading-input"
                        placeholder="Посилання"
                        v-model="link"
                        :class="{invalid: ($v.link.$dirty && (!$v.link.required || !$v.link.url ))}"
                    >
                    <div>
                        <p class="mb-3 mt-1 text-left text-danger h5"
                           v-if="$v.link.$dirty && !$v.link.required">
                            Поле не повинно бути порожнім
                        </p>
                        <p class="mb-3 mt-1 text-left text-danger h5"
                           v-else-if="$v.link.$dirty && !$v.link.url">
                            Перевірте правильність вводу
                        </p>
                    </div>
                </div>
                <div class="submit-button">
                    <button type="submit" @click="folderStore">Опублікувати</button>
                </div>
            </div>
            <div class="to-page">
                <div>
                    <router-link :to="{ name: 'addInfo' }">Назад</router-link>
                    <router-link :to="{ name: 'start' }">На головну</router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {mapActions} from "vuex";
import {required, minLength, requiredIf, url} from 'vuelidate/lib/validators';

export default {
    name: "FolderCreate",
    data() {
        return {
            name: '',
            link: '',
        }
    },
    validations() {
        return {
            name: {
                required,
                minLength: minLength(6),
                requiredIf: requiredIf(typeof this.name === 'string')
            },
            link: {
                required, url,
            },
        }
    },

    methods: {
        ...mapActions('media', ['storeFolder']),
        folderStore() {
            if (this.$v.$invalid) {
                this.$v.$touch()
                return
            }
            let folder = {
                name: this.name,
                link: this.link,
            }
            this.storeFolder(folder)
        }
    }
}
</script>
