<template>
    <div class="flex w-full">
        <div class="mr-3">
            <img :src="tweet.user.avatar" class="w-12 rounded-full" />
        </div>
        <div class="flex-grow">
            <div class="flex">
                <app-tweet-username :user="tweet.user"/>
                <i class="fa-solid fa-period ml-2 text-gray-600"></i>
                <div class="text-gray-600 text-sm flex self-center ml-2">
                    {{ tweet.human_time }}
                </div>
            </div>
            <p class="text-gray-300 whitespace-pre-wrap">
                {{ tweet.body }}
            </p>
            <app-tweet
                class="border border-gray-700 rounded-lg mt-4 hover:border hover:border-blue-500"
                :tweet="tweet.original_tweet"
            />

            <AppTweetActionGroup :tweet="tweet"/>
        </div>
    </div>
</template>

<script>
import AppTweet from "../AppTweet.vue";

export default {
    name: "AppTweetVariationQuote",
    components: {AppTweet},
    props : {
        tweet : {
            required : true,
            avatar : String,
            original_tweet: Object,
        }
    }
}
</script>

<style scoped>

</style>
