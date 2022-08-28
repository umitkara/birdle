<template>
    <div class="h-12 border-b border-y-gray-700 text-gray-500">
        <button class="h-12 w-1/3" @click="activePage=1">
            Tweets
        </button>
        <button class="h-12 w-1/3" @click="activePage=2">
            Replies
        </button>
        <button class="h-12 w-1/3" @click="activePage=3">
            Media
        </button>
    </div>
    <app-tweet
        v-if="activePage == 1"
        v-for="tweet in tweets"
        :key="tweet.id"
        :tweet="tweet"
    />
</template>
<script>
import AppTweet from "../tweets/AppTweet.vue"

export default {
    name: 'AppUserProfileTimeline',
    components: {AppTweet},
    props: {
        tweets: {}
    },
    data() {
        return {
            activePage: 1,
        };
    },
}
</script>
