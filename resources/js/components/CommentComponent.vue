<template>

    <div>
        <div class="form-inline my-4 w-full">
            <input type="text" placeholder="Add a public comment" class="form-control form-control-sm w-80" style="border-top: none; border-left: none; border-right: none;">
            <button class="btn btn-sm btn-primary"><small>Add Comment</small></button>
        </div>

        <div class="media mb-1" v-for="comment in comments.data">
            <avatar :username="comment.user.name" class="mr-2" :size="40"></avatar>

            <div class="media-body">
                <h5 class="mt-0">{{ comment.user.name }}</h5>
                <small>{{ comment.body }}</small>

                <vote-component :default_votes="comment.votes" :entity_id="comment.id" :entity_owner="comment.user.id"></vote-component>
                <replies :comment="comment"></replies>
            </div>
        </div>

        <div class="text-center">
            <button v-if="comments.next_page_url" @click="fetchComments" class="btn btn-secondary mt-3">Load More Comments</button>

            <div v-else class="text-center">No more comments to show :)</div>
        </div>
    </div>

</template>

<script>
    import Avatar from 'vue-avatar'
    import Replies from "./Replies";


    export default {
        props: ['video'],
        components: {
            Avatar,
            Replies,
        },
        mounted() {
            this.fetchComments()
        },
        data() {
            return {
                comments: {
                    data: []
                }
            }
        },
        methods: {
            fetchComments() {
                const url = this.comments.next_page_url ? this.comments.next_page_url : '/videos/'+this.video.id+'/comments'

                axios.get(url)
                .then(({ data }) => {
                    this.comments = {
                        ...data,
                        data: [
                            ...this.comments.data,
                            ...data.data
                        ]
                    }
                })
            }
        }
    }
</script>

