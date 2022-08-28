<template>
    <div class="flex w-full" @mouseover="menuOpen=true;" @mouseout="menuOpen=false;">
        <img :src="tweet.user.avatar" class="w-12 h-12 mr-3 rounded-full" draggable="false"/>
        <div class="flex-grow">
            <div class="flex relative">
                <app-tweet-username :user="tweet.user"/>
                <i class="fa-solid fa-period ml-2 text-gray-600"></i>
                <a :href="'/tweets/' + tweet.id" class="text-gray-600 text-sm flex self-center ml-2 hover:text-gray-50">
                    {{ tweet.human_time }}
                </a>
                <div class="absolute right-1.5" v-show="menuOpen">
                    <app-dropdown :open-prop="menuOpen">
                        <template v-slot:trigger>
                            <i class="fa-solid fa-ellipsis text-gray-600 hover:text-gray-50 cursor-pointer w-full"></i>
                        </template>
                        <app-dropdown-item @click.prevent="quoteModal">
                            Quote
                        </app-dropdown-item>
                        <app-dropdown-item @click.prevent="deleteModal" v-if="tweet.user.id == this.$user.id">
                            Delete Tweet
                        </app-dropdown-item>
                    </app-dropdown>
                </div>
            </div>
            <div v-if="tweet.replying_to" class="text-gray-600 mb-2">
                Replying to
                <a href="#">
                    <i class="fa-regular fa-at"></i>{{ tweet.replying_to }}
                </a>
            </div>
            <app-tweet-body :tweet="tweet" />
            <div class="flex flex-wrap mb-4 mt-4" v-if="images.length">
                <div class="w-6/12 flex-grow" v-for="(image, index) in images" :key="index">
                    <img :src="image.id" class="rounded-lg cursor-pointer" @click.prevent="imageModal(index)"/>
                </div>
            </div>
            <div class="mt-4 mb-4" v-if="video">
                <video :src="video.id" controls class="rounded-lg"></video>
            </div>

            <AppTweetActionGroup :tweet="tweet"/>
        </div>
    </div>
</template>

<script>
import AppTweetActionGroup from "../actions/AppTweetActionGroup.vue";
import AppTweetImageModal from "../../modals/AppTweetImageModal.vue";
import AppTweetBody from "../AppTweetBody.vue";
import AppDropdown from "../../dropdown/AppDropdown.vue";
import AppDropdownItem from "../../dropdown/AppDropdownItem.vue";

export default {
    name: "AppTweetVariationTweet",
    components: {AppDropdown, AppTweetBody, AppTweetActionGroup, AppDropdownItem},
    props: {
        tweet: {
            required: true,
            avatar: String,
            like_count: Number,
        }
    },
    data() {
        return {
            menuOpen: false,
        };
    },
    computed: {
        images() {
            return this.tweet.media.data.filter(t => t.type === 'image');
        },
        video() {
            return this.tweet.media.data.filter(t => t.type === 'video')[0];
        }
    },
    methods: {
        imageModal(index) {
            this.$vfm.show({
                component: 'AppTweetImageModal',
                bind: {
                    images: this.images,
                    current_image: index,
                },
            });
        },
        quoteModal() {
            this.$vfm.show({
                component: 'AppTweetRetweetModal',
                bind: {
                    tweet: this.tweet,
                },
            });
        },
        deleteModal() {
            this.$vfm.show({
                component: 'AppTweetDeleteTweetModal',
                bind: {
                    tweet: this.tweet,
                },
            });
        },
    }
}
</script>

