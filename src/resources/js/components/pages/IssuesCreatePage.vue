<template>
    <div class="row create-heading">
        <div class="create-heading-content">
            <div class="create-heading-form">
                <input type="text" class="add-heading-input" placeholder="Название выпуска" v-model="issue.name">

                <div class="states-heading-input">
                    <label for="category">
                        Категорія
                    </label>
                    <select class="form-control" id="category" v-model="issue.category_id">
                        <option value="1">
                            Випуски
                        </option>
                        <option value="2">
                            Біблія
                        </option>
                        <option value="3">
                            День народження
                        </option>
                    </select>
                </div>
                <input type="text" class="add-heading-input" placeholder="Посилання на випуск" v-model="issue.link">
                <div class="submit-button">
                    <button type="submit" @click="issueStore">
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
    name: "IssuesCreatePage",
    data() {
        return {
            issue: {
                name: '',
                category_id: '',
                link: '',
            }
        }
    },
    methods: {
        ...mapActions('issue', ['storeIssue']),
        issueStore() {
            this.storeIssue(this.issue)
        }
    }

}
</script>
