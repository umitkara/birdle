<template>
  <a href="#" class="flex items-center
                    text-base text-gray-600
                    hover:text-blue-400
                    transition ease-in-out duration-100" @click.prevent="replyModal">
    <i class="fa-regular fa-reply w-5 mr-1"></i>
    <span>{{ tweet.reply_count }}</span>
  </a>
</template>
<script>
import AppTweetReplyModal from "../../modals/AppTweetReplyModal.vue";

export default {
    name: 'AppTweetReplyAction',
    props: {
        tweet: {
            required: true,
            reply_count: Number,
        }
    },
    methods: {
        replyModal() {
            this.$vfm.show({
                component: 'AppTweetReplyModal',
                bind: {
                    tweet: this.tweet,
                },
            });
        },
    },
}
</script>
