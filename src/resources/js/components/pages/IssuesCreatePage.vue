<template>
    <div class="row create-heading">
        <div class="create-heading-content">
            <div class="create-heading-form">
                <input
                    type="text"
                    class="add-heading-input"
                    placeholder="Название выпуска"
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
                <div>
                    <div class="states-heading-input">
                        <label for="category">
                            Категорія
                        </label>
                        <div class="ml-2">
                            <select
                                class="form-control"
                                id="category"
                                v-model="category_id"
                                :class="{invalid: ($v.category_id.$dirty && (!$v.category_id.required || !$v.category_id.requiredIf || !$v.category_id.minValue || !$v.category_id.maxValue))}"
                            >
                                <option value="1">Випуски</option>
                                <option value="2">Біблія</option>
                                <option value="3">День народження</option>
                            </select>
                        </div>
                    </div>

                    <p class="mb-3 mt-1 text-left text-danger h5"
                       v-if="$v.category_id.$dirty && !$v.category_id.required">
                        Поле не повинно бути порожнім
                    </p>
                    <p class="mb-3 mt-1 text-left text-danger h5"
                       v-else-if="$v.category_id.$dirty && !$v.category_id.requiredIf">
                        Перевірте правильність вводу
                    </p>
                    <p class="mb-3 mt-1 text-left text-danger h5"
                       v-else-if="$v.category_id.$dirty && (!$v.category_id.minValue || !$v.category_id.maxValue)">
                        Спробуйте ще раз. якщо не вдасться - перевантажте сторінку
                    </p>
                </div>
                <input
                    type="url"
                    class="add-heading-input"
                    placeholder="Посилання на випуск"
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
                <div class="submit-button">
                    <button type="submit" @click="issueStore">
                        Опублікувати
                    </button>
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
import {required, minLength, minValue, maxValue, requiredIf, url} from 'vuelidate/lib/validators';

export default {
    name: "IssuesCreatePage",
    data() {
        return {
            name: '',
            category_id: '',
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
            category_id: {
                required,
                requiredIf: requiredIf(typeof this.category_id === 'number'),
                minValue: minValue(1),
                maxValue: maxValue(3),
            },
            link: {
                required, url,
            },
        }
    },
    methods: {
        ...mapActions('issue', ['storeIssue']),
        issueStore() {
            if (this.$v.$invalid) {
                this.$v.$touch()
                return
            }
            let issue = {
                name: this.name,
                category_id: this.category_id,
                link: this.link,
            }
            this.storeIssue(issue)
        }
    }

}
</script>
