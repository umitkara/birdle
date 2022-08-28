<template>
    <div class="p-4 flex-col flex-grow">
        <div class="text-gray-300 mb-4">
            <i class="fas fa-heart mr-3 text-red-500"></i>
            <app-tweet-username :user="notification.data.user" /> liked your tweet.
        </div>
        <div class="text-gray-600 p-3 border border-gray-700 rounded-lg mt-4">
            <app-tweet-variation-tweet v-if="resolvedTweet" :tweet="resolvedTweet" />
        </div>
    </div>
</template>

<script>
import AppTweetUsername from "../../tweets/AppTweetUsername.vue";
import AppTweetVariationTweet from "../../tweets/variations/AppTweetVariationTweet.vue";
export default {
    name: "AppNotificationTweetLikeNotification",
    components: {AppTweetVariationTweet, AppTweetUsername},
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
    },
}
</script>

<style scoped>

</style>
