<template>

    <div>
        <div class="media" v-for="comment in comments.data">
            <avatar :username="comment.user.name" class="mr-2" :size="40"></avatar>

            <div class="media-body">
                <h5 class="mt-0">{{ comment.user.name }}</h5>
                <small>{{ comment.body }}</small>

                <div class="form-inline my-4 w-full">
                    <input type="text" class="form-control form-control-sm w-80">
                    <button class="btn btn-sm btn-primary"><small>Add Comment</small></button>
                </div>

                <div class="media mt-3">
                    <img src="https://picsum.photos/id/42/200/200" class="mr-3 rounded-circle" width="30" height="30">

                    <div class="media-body">
                        <h5 class="mt-0">Media heading</h5>
                        <small>Cras sit amet nibh libero, in ia congue felis in faucibus.</small>

                        <div class="form-inline my-4 w-full">
                            <input type="text" class="form-control form-control-sm w-80">
                            <button class="btn btn-sm btn-primary"><small>Add Comment</small></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center">
            <button v-if="comments.next_page_url" @click="fetchComments" class="btn btn-secondary">Load More</button>

            <div v-else class="text-center">No more comments to show :)</div>
        </div>
    </div>

</template>

<script>
    import Avatar from 'vue-avatar'

    export default {
        props: ['video'],
        components: {
            Avatar
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

