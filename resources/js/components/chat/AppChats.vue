<script setup>
import { vElementVisibility } from '@vueuse/components'
import {chat} from "../../store/chat";
const store = chat();
</script>

<template>
    <app-navigation-back-home pageName="Messages" />
    <app-chat v-for="(chat, index) in this.store.chats" :key="index" :chat="chat" />
</template>

<script>
import AppNavigationBackHome from "../navigation/AppNavigationBackHome.vue";
import AppChat from "./AppChat.vue";
export default {
    name: "AppChats",
    components: {
        AppNavigationBackHome,
        AppChat,
    },
    data() {
        return {
            page: 1,
            lastPage: 1,
        };
    },
    methods: {
        loadMore() {
            this.getChats();
        },
        getChats() {
            this.store.getChats(this.urlWithPage).then((response) => {
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
        chats() {
            return this.store.chats;
        },
        urlWithPage() {
            return `/api/chats?page=${this.page}`;
        }
    }
}
</script>

<style scoped>

</style>
