<script setup>
import { vElementVisibility } from '@vueuse/components'
import {user} from "../../store/user";

const store = user();
</script>
<template>
    <app-navigation-back-home page-name="Profile" />
    <div class="h-64 bg-blue-400 relative">
        <AppUserProfileBanner v-if="userObject" :user-object="userObject" @follow="follow" @unfollow="unfollow"/>
    </div>
    <AppUserProfileInfo v-if="userObject" :joined-at="joinedAt.format('MMMM YYYY')" :user-object="userObject"/>
    <div class="h-12 border-b border-y-gray-700 text-gray-500">
        <button class="h-12 w-1/3" @click="changePage(1)" :class="{'text-gray-300': isActive(1)}">
            Tweets
        </button>
        <button class="h-12 w-1/3" @click="changePage(2)" :class="{'text-gray-300': isActive(2)}">
            Replies
        </button>
        <button class="h-12 w-1/3" @click="changePage(3)" :class="{'text-gray-300': isActive(3)}">
            Media
        </button>
    </div>
    <app-tweet
        v-if="activePage !== 2"
        v-for="tweet in tweets"
        :key="tweet.id"
        :tweet="tweet"
    />
    <app-tweet-variation-tweet
        v-if="activePage === 2"
        class="w-full inline-block p-4 border-b border-gray-800 hover:bg-gray-800"
        v-for="tweet in tweets"
        :key="tweet.id"
        :tweet="tweet"
    />
    <div id="loadMore" class="h-1" v-element-visibility="onElementVisibility"></div>
</template>

<script>
import moment from "moment";
import AppUserProfileBanner from "./AppUserProfileBanner.vue";
import AppUserProfileInfo from "./AppUserProfileInfo.vue";
import AppNavigationBackHome from "../navigation/AppNavigationBackHome.vue";
import AppTweetVariationTweet from "../tweets/variations/AppTweetVariationTweet.vue";
import AppTweet from "../tweets/AppTweet.vue";

export default {
    name: "AppUserProfile",
    components: {
        AppUserProfileBanner,
        AppNavigationBackHome,
        AppTweetVariationTweet,
        AppUserProfileInfo,
        AppTweet
    },
    props: {
        profileUser: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            page: 1,
            lastPage: 1,
            activePage: 1,
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
        },
        follow(id) {
            this.store.follow(id);
        },
        unfollow(id) {
            this.store.unfollow(id);
        },
        changePage(page) {
            this.activePage = page;
            this.page = 0;
            this.store.clearTweets();
            this.getTweets();
        },
        isActive(page) {
            return this.activePage == page;
        }
    },
    computed: {
        userObject() {
            return this.store.user;
        },
        joinedAt() {

            return new moment.utc(this.userObject.data.created_at);
        },
        tweets() {
            return this.store.tweets;
        },
        urlWithPage() {
            if (this.activePage == 1) {
                return `/api/user/${this.profileUser.id}/tweets?page=${this.page}`;
            } else if (this.activePage == 2) {
                return `/api/user/${this.profileUser.id}/replies`;
            } else if (this.activePage == 3) {
                return `/api/user/${this.profileUser.id}/media`;
            }
        }
    },
    mounted() {
        this.store.fetchUser(this.profileUser.id);
        this.loadMore();
        Echo.private(`timeline.${this.$user.id}`)
            .listen('.TweetCreated', (e) => {
                this.store.pushTweets([e]);
            });
    }
}
</script>

