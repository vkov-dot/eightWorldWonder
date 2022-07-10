<template>
    <div class="comment-list">
        <div>
            <div v-for="comment in this.comments">
                <div class="comment-element justify-content-between">
                    <div class="comment-element">
                        <p>
                            {{ comment.user.name }}
                        </p>
                        <p class="comment-date">
<!--
                            {{ \Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}
-->
                        </p>
                    </div>
                    <form :action="{ name: 'states.comments.destroy', params: {'state': comment.state_id, 'comment': comment.id } }"
                        enctype="multipart/form-data" class="delete-comment" method="POST">
                        <input type="submit" value="&#215;">
                    </form>
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
export default {
    name: "CommentsList",
    props: {
        comments: Array,
    },
    mounted() {
        console.log(this.comments);
    }
}
</script>

<style scoped>

</style>
