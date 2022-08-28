<template>
    <div class="w-full inline-block p-4 border-b border-gray-800 hover:bg-gray-800">
        <component
            :is="`app-tweet-variation-${tweet.type}`"
            :tweet="tweet"
        />
    </div>
</template>

<script>
import AppTweetUsername from "./AppTweetUsername.vue";

export default {
    name: "AppTweet",
    components: {AppTweetUsername},
    props: {
        tweet: {
            required: true,
            avatar: String,
        }
    }
}
</script>

