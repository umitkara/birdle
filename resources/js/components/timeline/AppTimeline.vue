<script setup>
    import { vElementVisibility } from '@vueuse/components'
    import {timeline} from "../../store/timeline";
    const store = timeline();
</script>

<template>
    <div>
        <div class="border-b-8 border-gray-800 p-4 w-full">
            <app-tweet-compose />
        </div>
        <app-tweet
            v-for="tweet in tweets"
            :key="tweet.id"
            :tweet="tweet"
        />
        <div id="loadMore" class="h-1" v-element-visibility="onElementVisibility"></div>
    </div>
</template>

<script>
import AppTweet from "../tweets/AppTweet.vue";
import AppTweetCompose from "../compose/AppTweetCompose.vue";
import {timeline} from "../../store/timeline";

export default {
    name: "AppTimeline",
    components: {AppTweet, AppTweetCompose},
    data() {
        return {
            page: 1,
            lastPage: 1,
        };
    },
    methods: {
        loadMore() {
            this.getTweets();
        },
        getTweets() {
            this.store.getTweets(this.urlWithPage).then((response) => {
                this.lastPage = response.data.meta.last_page;
            });
        },
        onElementVisibility(state) {
            if (!state) {
                return;
            }
            if (this.lastPage == this.page) {
                return;
            }
            this.page++;
            this.loadMore();
        }
    },
    mounted() {
        this.loadMore();
        Echo.private(`timeline.${this.$user.id}`)
            .listen('.TweetCreated', (e) => {
                this.store.pushTweets([e]);
            });
    },
    computed: {
        tweets() {
            return this.store.tweets;
        },
        urlWithPage() {
            return `/api/timeline?page=${this.page}`;
        }
    }
}
</script>

<style scoped>

</style>
