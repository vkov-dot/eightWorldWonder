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
                        <div class="required">
                            <div class="col-sm-12">
                                <star-rating
                                    :round-start-rating="false"
                                    :increment="0.1"
                                    :star-size="40"
                                    :glow="5"
                                    :padding="15"
                                    @rating-selected="setRating"
                                    :rating="this.stateRating"
                                    text-class="state-rating-p"/>
                                <div class="d-flex mt-2 mb-4">
                                    <p class="state-rating-p">
                                        Середня: {{ this.stateRating }}
                                    </p>
                                    <p class="state-rating-p">
                                        Вже оцінили: {{ this.showState?.ratingCount }}
                                    </p>
                                </div>
                            </div>
                        </div>
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
                        <div class="destroy-state" v-if="!showState.archived">
                            <button type="submit" @click="archiveState">
                                До архіва
                            </button>
                        </div>
                        <div class="destroy-state" v-if="showState.archived">
                            <button type="submit" @click="destroyState">
                                Видалити
                            </button>
                        </div>
                        <div v-if="showState.archived">
                            <button type="submit" @click="recoverState" class="btn btn-primary recovery-button">
                                Відновити
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="last-states states state-show-div">
                <div class="comments-count">
                    <p>
                        Коментарі: {{ this.showState.comments?.length }}
                    </p>
                </div>
                <div class="row">
                    <div>
                        <div class="row">
                            <div class="col-12 comment-send-div">
                                <textarea class="comment-message" name="message" v-model="commentMessage"
                                          placeholder="Додати коментар">
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
import StarRating from 'vue-star-rating'
import router from "../../router";
import {mapActions, mapGetters, mapMutations} from "vuex";

export default {
    name: "StateShowPage",
    data() {
        return {
            commentMessage: null,
        }
    },
    components: {
        CommentsList, StarRating,
        LastStatesList,
    },

    computed: {
        ...mapGetters('state', ['showState', 'lastStates', 'stateRating']),
        ...mapGetters('comment', ['getStateComments']),
        ...mapGetters("auth", ["user", "apiToken"]),
    },
    methods: {
        ...mapActions('state', ['getStateById', 'getLastStates', 'deleteShowState', 'recoverShowState', 'storeRating']),
        ...mapActions('state', ['postComment', 'deleteComment', 'addStateToArchive']),
        ...mapMutations('state', ['updateRating']),
        createComment() {
            if (this.user && this.commentMessage?.length > 5) {
                this.postComment([this.showState.id, this.commentMessage])
                this.commentMessage = '';
            } else if(!this.user) {
                router.push({ name: 'login' })
            }
        },
        destroyState() {
            this.deleteShowState(this.showState.id)
        },
        archiveState() {
            this.addStateToArchive(this.showState.id);
        },
        recoverState() {
            this.recoverShowState(this.showState.id)
        },
        setRating(ratingCount) {
            if(this.user) {
                let rating = {
                    rating: ratingCount,
                    state_id: this.showState.id,
                }
                this.storeRating(rating)
            } else {
                router.push({ name: 'login'})
            }
        },
    },
    mounted() {
        this.getStateById(this.$attrs.state)
        this.getLastStates()
    },
    watch: {
        '$route'() {
            this.getStateById(this.$attrs.state)
        },
        'showState'() {
            this.rating = this.showState.rating
        }
    }
}
</script>
