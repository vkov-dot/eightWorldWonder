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
                    <button @click="commentDelete(comment.id)" class="bg-white border-0">
                        ✕
                    </button>
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

import {mapActions} from "vuex";

export default {
    name: "CommentsList",
    props: {
        comments: Array,
        stateId: '',
    },
    methods: {
        ...mapActions('comment', ['deleteCommentState']),
        commentDelete(commentId) {
            this.deleteCommentState([this.stateId, commentId])
        },
    },
}
</script>

<style scoped>

</style>
