<template>
    <div class="text-gray-600 font-medium text-sm flex items-center mb-3">
        <span><i class="fa-regular fa-retweet"></i> {{ tweet.user.name }} retweeted
        </span>
        <span class="text-gray-600 text-sm flex self-center ml-2">
            <i class="fa-solid fa-period mr-2 text-gray-600"></i>
            {{ tweet.human_time }}
        </span>
    </div>
    <component
        :is="`app-tweet-variation-${tweet.original_tweet.type}`"
        :tweet="tweet.original_tweet"
    />
</template>

<script>
export default {
    name: "AppTweetVariationRetweet",
    props: {
        tweet: {
            required: true,
            avatar: String,
            original_tweet: Object,
        }
    }
}
</script>

<style scoped>

</style>
