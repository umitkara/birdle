<script setup>
import { vElementVisibility } from '@vueuse/components'
import {chat} from "../../store/chat";
const store = chat();
</script>

<template>
    <div class="h-screen">
        <div class="h-5/6 overflow-y-auto">
            <app-navigation-back-home pageName="Back to Home" />
            <div class="flex p-3 items-center border-b border-gray-800">
                <img :src="chat_to.avatar" class="w-12 h-12 mr-3 rounded-full" draggable="false"/>
                <app-tweet-username :user="chat_to"/>
            </div>
            <AppChatMessage v-for="message in messages" :key="message.id" :message="message" />
        </div>
        <AppChatMessageCompose :chat-id="currentChat.id"/>
    </div>
</template>

<script>
import AppNavigationBackHome from "../navigation/AppNavigationBackHome.vue";
import AppTweetUsername from "../tweets/AppTweetUsername.vue";
import AppChatMessage from "./message/AppChatMessage.vue";
import AppChatMessageCompose from "./message/AppChatMessageCompose.vue";

export default {
    name: "AppChatMessages",
    components: {
        AppNavigationBackHome,
        AppTweetUsername,
        AppChatMessage,
        AppChatMessageCompose,
    },
    props: {
        currentChat: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            page: 1,
            lastPage: 1,
        };
    },
    computed: {
        chat_to() {
            if (this.$user.id === this.currentChat.sender.id) {
                return this.currentChat.recipient;
            } else {
                return this.currentChat.sender;
            }
        },
        urlWithPage() {
            return `/api/chat/${this.currentChat.id}?page=${this.page}`;
        },
        messages() {
            return this.store.messages;
        },
    },
    methods: {
        loadMore() {
            this.getMessages();
        },
        getMessages() {
            this.store.getMessages(this.urlWithPage).then((response) => {
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
}
</script>

<style scoped>

</style>
