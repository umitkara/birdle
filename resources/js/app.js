/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import { createApp } from 'vue';
import { createPinia } from 'pinia'
import { timeline } from "./store/timeline";
import { likes } from "./store/like";
import { retweets } from "./store/retweet";
import { notification } from "./store/notification";
import { conversation } from "./store/conversation";
import { user } from "./store/user";
import { hashtag } from "./store/hashtag";
import { chat } from "./store/chat";
import vfmPlugin from 'vue-final-modal'


/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const pinia = createPinia()
const app = createApp({});

app.config.globalProperties.$user = User;

/*import ExampleComponent from './components/ExampleComponent.vue';
app.component('example-component', ExampleComponent);*/

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

Object.entries(import.meta.globEager('./**/*.vue')).forEach(([path, definition]) => {
    app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
});

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */
app.use(vfmPlugin)
app.use(pinia);
const store = timeline();
const likesStore = likes();
const retweetStore = retweets();
const notificationStore = notification();
const conversationStore = conversation();
const userStore = user();
const hashtagStore = hashtag();
const chatStore = chat();
app.mount('#app');

Echo.channel('tweets')
    .listen('TweetCreated', (e) => {
        store.pushTweets([e.tweet]);
    })
    .listen('.TweetLikesUpdated', (e) => {
        if(e.user_id == User.id) {
            likesStore.syncLikes(e.id);
        }
        store.setLikes(e.id, e.count);
        notificationStore.setLikes(e.id, e.count);
        conversationStore.setLikes(e.id, e.count);
        userStore.setLikes(e.id, e.count);
        hashtagStore.setLikes(e.id, e.count);
    })
    .listen('.TweetRetweetUpdated', (e) => {
        if(e.user_id == User.id) {
            retweetStore.syncRetweets(e.id);
        }
        store.setRetweets(e.id, e.count);
        notificationStore.setRetweets(e.id, e.count);
        conversationStore.setRetweets(e.id, e.count);
        userStore.setRetweets(e.id, e.count);
        hashtagStore.setRetweets(e.id, e.count);
    })
    .listen('.TweetRetweetDeleted', (e) => {
        store.popTweet(e.id);
    })
    .listen('.TweetReplyUpdated', (e) => {
        store.setReplies(e.id, e.count);
        notificationStore.setReplies(e.id, e.count);
        conversationStore.setReplies(e.id, e.count);
        userStore.setReplies(e.id, e.count);
        hashtagStore.setReplies(e.id, e.count);
    });

Echo.channel('follow')
    .listen('.UserFollowerUpdated', (e) => {
        console.log(e)
        if(userStore.user.data.id == e.id) {
            userStore.syncFollowers(e.followers);
            userStore.syncIsFollowing(e.is_following);
        }
    });
