<template>
    <a :href="`/messages/${chat.id}`">
        <div class="flex w-full inline-block p-4 border-b border-gray-800 hover:bg-gray-800">
            <img :src="chat_to.avatar" class="w-12 h-12 mr-3 rounded-full" draggable="false"/>
            <div class="flex-grow">
                <div class="flex relative">
                    <app-tweet-username :user="chat_to"/>
                    <span class="text-gray-600 text-sm flex self-center ml-2">
                        {{ chat.human_time }}
                    </span>
                </div>
                <div>
                    <p class="text-gray-300 whitespace-pre-wrap relative">
                        {{ this.truncate(lastMessage) }}
                    </p>
                </div>
            </div>
        </div>
    </a>
</template>

<script>
import AppTweetUsername from "../tweets/AppTweetUsername.vue";

export default {
    name: "AppChat",
    components: {
        AppTweetUsername
    },
    props: {
        chat: {
            type: Object,
            required: true,
        },
    },
    computed: {
        chat_to() {
            if (this.$user.id === this.chat.sender.id) {
                return this.chat.recipient;
            } else {
                return this.chat.sender;
            }
        },
        lastMessage() {
            return this.chat.lastMessage.message;
        },
    },
    methods: {
        truncate(string, length = 25) {
            if (string.length > length) {
                return string.substring(0, length) + "...";
            } else {
                return string;
            }
        }
    }
}
</script>

<style scoped>

</style>
