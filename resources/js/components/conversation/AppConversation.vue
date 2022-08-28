<script setup>
import { conversation} from "../../store/conversation";
const store = conversation();
</script>

<template>
    <app-navigation-back-home page-name="Back to Home" />
    <div v-if="parents.length">
        <app-tweet-variation-tweet v-for="t in parents" :key="t.id" :tweet="t" class="p-3 border-b-2 border-gray-800 last:border-b-0"/>
    </div>
    <div v-if="parents.length" class="h-8 bg-gray-800 flex justify-center items-center text-xl text-gray-600">
    </div>
    <div class="text-lg">
        <app-tweet-variation-tweet v-if="tweet" :tweet="tweet" class="p-3"/>
    </div>
    <div v-if="replies.length" class="h-8 bg-gray-800 flex justify-center items-center text-xl text-gray-600">
    </div>
    <div v-if="replies.length" class="border-t-[12px] border-gray-800">
        <app-tweet-variation-tweet v-for="t in replies" :key="t.id" :tweet="t" class="p-3 border-b-2 border-gray-800"/>
    </div>
</template>

<script>
import AppTweetVariationTweet from "../tweets/variations/AppTweetVariationTweet.vue";
import AppNavigationBackHome from "../navigation/AppNavigationBackHome.vue";

export default {
    name: "AppConversation",
    components: {
        AppTweetVariationTweet,
        AppNavigationBackHome,
    },
    props: {
        id: {
            type: String,
            required: true
        }
    },
    computed: {
        tweet() {
            return this.store.tweet(this.id);
        },
        parents() {
            return this.store.parents(this.id);
        },
        replies() {
            return this.store.replies(this.id);
        }
    },
    mounted() {
        this.store.getTweets(`/api/tweet/${this.id}`);
        this.store.getTweets(`/api/tweet/${this.id}/reply`);
    }
}
</script>

<style scoped>

</style>
