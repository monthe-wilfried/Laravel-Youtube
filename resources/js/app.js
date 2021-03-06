/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');


// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('subscribe-button', require('./components/SubscribeButton').default);
Vue.component('channel-uploads', require('./components/ChannelUploads').default);
Vue.component('vote-component', require('./components/VoteComponent').default);
Vue.component('comment-component', require('./components/CommentComponent').default);
Vue.component('replies', require('./components/Replies').default);

const app = new Vue({
    el: '#app',
});
