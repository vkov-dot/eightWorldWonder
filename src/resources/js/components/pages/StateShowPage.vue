<template>
    <div class="row flex-row">
        <div class="col-xl-4 col-lg-12 last-states">
            <last-states-list :states="this.lastStates"></last-states-list>
        </div>
        <div class="last-states col-xl-8 col-lg-12" v-model="showState">
            <div class="states state-show-div">
                <div>
                    <p class="state-show-name">
                        {{ this.showState.name }}
                    </p>
                    <div>
                        <form :action="{ name: 'rating.store', stateId: this.showState.id }"
                              id="addStar" method="POST" class="form-horizontal poststars">
                            <div class="required">
                                <div class="col-sm-12">
                                    <div class="state-rating-div">
                                        <p class="state-rating-p">
                                            Середня: {{ this.showState.rating }}
                                        </p>
                                        <p class="state-rating-p">
                                            Вже оцінили: {{ this.showState.ratingCount }}
                                        </p>
                                    </div>
                                    <div>
                                        <input class="star star-5" value="5" id="star-5" type="submit" name="star"/>
                                        <label class="star star-5" for="star-5"></label>
                                        <input class="star star-4" value="4" id="star-4" type="submit" name="star"/>
                                        <label class="star star-4" for="star-4"></label>
                                        <input class="star star-3" value="3" id="star-3" type="submit" name="star"/>
                                        <label class="star star-3" for="star-3"></label>
                                        <input class="star star-2" value="2" id="star-2" type="submit" name="star"/>
                                        <label class="star star-2" for="star-2"></label>
                                        <input class="star star-1" value="1" id="star-1" type="submit" name="star"/>
                                        <label class="star star-1" for="star-1"></label>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="mb-4">
                        <img :src="/storage/ + this.showState.logo" class="d-block w-100">
                    </div>
                    <p v-html="this.showState.body">
                        {{ this.showState.body }}
                    </p>
                    <p class="state-show-author">
                        {{ this.showState.author }}
                    </p>
                    <div v-if="user && user.admin" class="state-show-redact-destroy">
                        <div class="redact-state-link">
                            <router-link :to="{ name: 'states.edit', params: { state: this.showState.id } }">
                                Редагувати
                            </router-link>
                        </div>
                        <div class="destroy-state">
                            <button type="submit" @click="destroyState">
                                {{ +showState.archived === 1 ? 'Видалити' : 'До архіва' }}
                            </button>
                        </div>
                        <div v-if="showState.archived">
                            <button type="submit" @click="recoverState" class="btn btn-primary">
                                Відновити
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="last-states states state-show-div">
                <div class="comments-count">
                    <p>
                        Коментарі: {{ this.showState.comments.length }}
                    </p>
                </div>
                <div class="row">
                    <div>
                        <div class="row">
                            <div class="col-12 comment-send-div">
                                <textarea class="comment-message" name="message" v-model="commentMessage" placeholder="Додати коментар">
                                </textarea>
                            </div>
                            <div class="row">
                                <div class="col-12 comment-submit">
                                    <input
                                        @click="createComment()"
                                        type="submit"
                                        value="Опублікувати"
                                        class="btn">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <comments-list
                    :comments="showState.comments"
                    :state-id="showState.id"
                    v-model:comments="showState.comments"
                />
            </div>
        </div>
    </div>
</template>

<script>
import LastStatesList from "../LastStatesList";
import CommentsList from "../CommentsList";
import StateShow from "../StateShow";
import { mapActions, mapGetters } from "vuex";

export default {
    name: "StateShowPage",
    data() {
        return {
            commentMessage: '',
        }
    },
    components: {
        CommentsList,
        LastStatesList,
        StateShow,
    },

    computed: {
        ...mapGetters(['showState', 'lastStates', 'getStateComments']),
        ...mapGetters("auth", ["user","apiToken"]),
    },
    methods: {
        ...mapActions(['getStateById', 'getLastStates', 'postComment', 'deleteShowState', 'recoverShowState']),
        createComment() {
            this.postComment([this.showState.id, this.commentMessage])
            this.commentMessage = '';
        },
        destroyState() {
            this.deleteShowState(this.showState.id)
        },
        recoverState() {
            this.recoverShowState(this.showState.id)
        },
    },
    mounted() {
        this.getStateById(this.$attrs.state)
        this.getLastStates()
    },
    watch: {
        '$route'() {
            this.getStateById(this.$attrs.state)
        }
    }
}
</script>
