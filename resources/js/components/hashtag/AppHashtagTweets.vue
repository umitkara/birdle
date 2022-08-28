<script setup>
import { vElementVisibility } from '@vueuse/components'
import { hashtag } from "../../store/hashtag";

const store = hashtag();
</script>


<template>
    <app-navigation-back-home page-name="Back to Home" />
    <div class="relative">
        <img src="https://picsum.photos/800/400" />
        <div class="absolute bottom-0 bg-gradient-to-b from-transparent to-gray-900 w-full h-full border-b border-gray-700"></div>
        <div class="absolute bottom-0 text-gray-300 p-4">
            <small>Tweets about</small>
            <br/>
            <i class="fa-solid fa-hashtag"></i> <b class="text-lg">{{ hashtagName }}</b>
        </div>
    </div>
    <app-tweet
        v-for="tweet in tweets"
        :key="tweet.id"
        :tweet="tweet"
    />
    <div id="loadMore" class="h-1" v-element-visibility="onElementVisibility"></div>
</template>

<script>
import AppNavigationBackHome from "../navigation/AppNavigationBackHome.vue";
import AppTweet from "../tweets/AppTweet.vue";
export default {
    name: "AppHashtagTweets",
    components: {
        AppNavigationBackHome
    },
    props: {
        hashtagName: {
            type: String,
            required: true
        }
    },
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
    },
    computed: {
        tweets() {
            return this.store.tweets;
        },
        urlWithPage() {
            return `/api/hashtag/${this.hashtagName}?page=${this.page}`;
        }
    }
}
</script>

<style scoped>

</style>
