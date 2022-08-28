<template>
    <div class="p-4 flex-col flex-grow">
        <div class="text-gray-300 mb-4">
            <i class="fa-solid fa-quote-left mr-3 text-blue-500"></i>
            <app-tweet-username :user="notification.data.user" /> quoted your tweet.
        </div>
        <div class="text-gray-600 p-3 border border-gray-700 rounded-lg mt-4">
            <app-tweet-variation-quote v-if="resolvedTweet" :tweet="resolvedTweet" />

        </div>
    </div>
</template>

<script>
import AppTweetVariationTweet from "../../tweets/variations/AppTweetVariationTweet.vue";
import AppTweetUsername from "../../tweets/AppTweetUsername.vue";
import AppTweetVariationQuote from "../../tweets/variations/AppTweetVariationQuote.vue";

export default {
    name: "AppNotificationTweetQuoteNotification",
    components: {AppTweetVariationQuote, AppTweetVariationTweet, AppTweetUsername},
    props: {
        notification: {
            type: Object,
            required: true,
        },
        store: {
            type: Object,
            required: true,
        },
    },
    computed: {
        resolvedTweet: function() {
            return this.store.tweet(this.notification.data.tweet.id);
        },
        resolvedParentTweet: function() {
            return this.store.tweet(this.notification.data.parent_tweet.id);
        },
    },
}
</script>

<style scoped>

</style>
