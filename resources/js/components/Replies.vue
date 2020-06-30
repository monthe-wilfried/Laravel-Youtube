<template>

    <div>
        <div class="form-inline my-4 w-full">
            <input type="text" class="form-control form-control-sm w-80" style="border-top: none; border-left: none; border-right: none;">
            <button class="btn btn-sm btn-primary"><small>Add Reply</small></button>
        </div>

        <div class="media mt-3" v-for="reply in replies.data">
            <avatar :username="reply.user.name" class="mr-2" :size="20"></avatar>

            <div class="media-body">
                <h5 class="mt-0">{{ reply.user.name }}</h5>
                <small>{{ reply.body }}</small>
                <vote-component :default_votes="reply.votes" :entity_id="reply.id" :entity_owner="reply.user.id"></vote-component>
            </div>
        </div>

        <div class="text-center">
            <button v-if="comment.repliesCount > 0 && replies.next_page_url" @click="fetchReplies" class="btn btn-secondary btn-sm">View replies</button>
        </div>
    </div>

</template>

<script>
    import Avatar from 'vue-avatar'

    export default {
        name: "Replies",
        props: ['comment'],
        components: {
            Avatar
        },
        data() {
            return {
                replies: {
                    data: [],
                    next_page_url:  '/comments/'+this.comment.id+'/replies'
                }
            }
        },
        methods: {
            fetchReplies() {

                axios.get(this.replies.next_page_url)
                    .then(({ data }) => {
                        this.replies = {
                            ...data,
                            data: [
                                ...this.replies.data,
                                ...data.data
                            ]
                        }
                    })
            }
        }
    }
</script>

<style scoped>

</style>
