<script setup>
import { retweets } from '../../../store/retweet';
const store = retweets();
</script>

<template>
    <div class="flex items-center
                    text-base text-gray-600
                    hover:text-green-400
                    transition ease-in-out duration-100 cursor-pointer" :class="{'text-green-400': retweeted}" v-if="!retweeted">
        <app-dropdown >
            <template v-slot:trigger>
                <i id="retweet-icon" ref="retweetIcon" class="fa-regular fa-retweet w-5 mr-1"></i>
                <span>{{ tweet.retweet_count }}</span>
            </template>
            <app-dropdown-item @click.prevent="retweetTweet">
                Retweet
            </app-dropdown-item>
            <app-dropdown-item @click.prevent="quoteModal">
                Quote
            </app-dropdown-item>
        </app-dropdown>
    </div>
    <a v-else class="flex items-center
                    text-base text-gray-600
                    hover:text-green-400
                    transition ease-in-out duration-100 cursor-pointer" :class="{'text-green-400': retweeted}" @click.prevent="retweetTweet">
        <i id="retweet-icon" ref="retweetIcon" class="fa-regular fa-retweet w-5 mr-1"></i>
        <span>{{ tweet.retweet_count }}</span>
    </a>
</template>
<script>
import AppDropdown from "../../dropdown/AppDropdown.vue";
import AppDropdownItem from "../../dropdown/AppDropdownItem.vue";
import AppTweetRetweetModal from "../../modals/AppTweetRetweetModal.vue";

export default {
    name: 'AppTweetRetweetAction',
    components: {AppDropdownItem, AppDropdown},
    props: {
        tweet: {
            required: true,
            avatar: String,
            id: Number,
            retweet_count: Number,
        }
    },
    computed: {
        retweeted() {
            return this.store.retweets.includes(this.tweet.id);
        },
    },
    methods: {
        retweetTweet() {
            if (this.retweeted) {
                this.store.unretweet(this.tweet.id);
            } else {
                this.store.retweet(this.tweet.id);
            }
        },
        quoteModal() {
            this.$vfm.show({
                component: 'AppTweetRetweetModal',
                bind: {
                    tweet: this.tweet,
                },
            });
        },
    },
}
</script>
