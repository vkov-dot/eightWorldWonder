<template>
    <div class="comment-list">
        <div>
            <div v-for="comment in comments">
                <div class="comment-element justify-content-between">
                    <div class="comment-element">
                        <p>
                            {{ comment.userName }}
                        </p>
                        <p class="comment-date">
                            {{ comment.published_at }}
                        </p>
                    </div>
                    <div v-if="user">
                        <button v-if="user.id === comment.user_id || user.admin" @click="commentDelete(comment.id)" class="bg-white border-0">
                            ✕
                        </button>
                    </div>
                </div>
                <div>
                    <p>
                        {{ comment.message }}
                    </p>
                </div>
            </div>
        </div>
    </div>

</template>

<script>

import {mapActions, mapGetters} from "vuex";

export default {
    name: "CommentsList",
    props: {
        comments: Array,
        stateId: '',
        userAdmin: 0,
    },
    computed: {
        ...mapGetters("auth", ["user", "apiToken"]),
    },
    methods: {
        ...mapActions('state', ['deleteCommentState']),
        commentDelete(commentId) {
            this.deleteCommentState([this.stateId, commentId])
        },
    },
}
</script>
