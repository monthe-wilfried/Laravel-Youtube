<template>

    <div>
        <div class="text-center">
            <button @click="toggleSubscription" class="btn btn-danger">
                {{ owner ? '' : subscribed ? 'Unsubscribed' : 'Subscribe' }} {{ count }} {{ owner ? 'Subscribers' : '' }}
            </button>
        </div>
    </div>

</template>

<script>
    export default {
        name: 'subscribe-button',
        props: {
            channel: {
                type: Object,
                required: true,
                default: () => ({})
            },
            initialSubscriptions: {
                type: Array,
                required: true,
                default: () => []
            },
        },
        data: function () {
            return {
                subscriptions: this.initialSubscriptions
            }
        },
        computed: {
            subscribed(){
                if (__auth() && this.channel.user_id !== __auth().id){
                    // !! is to render true or false in the vue console
                    return !!this.subscription
                }
                return false
            },
            owner(){
                return __auth() && this.channel.user_id === __auth().id;

            },
            count(){
                return numeral(this.subscriptions.length).format('0a')
            },
            subscription(){
                return this.subscriptions.find(subscriptions => subscriptions.user_id === __auth().id)
            }
        },
        methods: {
            toggleSubscription() {
                if (!__auth()) {
                     return alert('Please login to subscribe.')
                }

                if (this.owner) {
                    return alert('You cannot subscribe to your own channel.')
                }

                if (this.subscribed){
                    axios.delete('/channels/'+this.channel.id+'/subscriptions/'+this.subscription.id)
                    .then(() => {
                        this.subscriptions = this.subscriptions.filter(s => s.id !== this.subscription.id)
                    })
                }else{
                    axios.post('/channels/'+this.channel.id+'/subscriptions')
                    .then(response => {
                        this.subscriptions = [
                            ...this.subscriptions,
                            response.data
                        ]

                    })
                }
            }
        }
    }
</script>

<style scoped>

</style>
