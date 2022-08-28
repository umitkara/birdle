<template>
    <ul class="flex mt-4">
        <li class="w-3/12">
            <AppTweetReplyAction :tweet="tweet"/>
        </li>
        <li class="w-3/12" id="retweet">
            <AppTweetRetweetAction :tweet="tweet"/>
        </li>
        <li class="w-3/12">
            <AppTweetLikeAction :tweet="tweet"/>
        </li>
    </ul>
</template>
<script>
import AppTweetReplyAction from "./AppTweetReplyAction.vue";
import AppTweetRetweetAction from "./AppTweetRetweetAction.vue";
import AppTweetLikeAction from "./AppTweetLikeAction.vue";

export default {
    name: 'AppTweetActionGroup',
    components: {AppTweetLikeAction, AppTweetRetweetAction, AppTweetReplyAction},
    props: {
        tweet: {
            required: true,
            avatar: String,
            like_count: Number,
        }
    },
}
</script>
