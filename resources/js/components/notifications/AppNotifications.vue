<script setup>
import { vElementVisibility } from '@vueuse/components'
import {notification} from "../../store/notification";
const store = notification();
</script>

<template>
    <app-navigation-back-home page-name="Notifications" />
    <div v-if="notifications.length > 0">
        <AppNotification v-for="notification in notifications"
        :key="notification.id"
        :notification="notification"
                         :store="store"
        />
        <div id="loadMore" class="h-1" v-element-visibility="onElementVisibility"></div>
    </div>
    <div v-else class="p-5 border-b border-gray-800">
        <div class="text-center text-gray-400 text-2xl">
            <i class="fa-solid fa-bell mr-2"></i>
            No notifications yet...
        </div>
    </div>
</template>

<script>
import AppNotification from "./AppNotification.vue";
import AppNavigationBackHome from "../navigation/AppNavigationBackHome.vue";

export default {
    name: "AppNotifications",
    components: {
        AppNotification,
        AppNavigationBackHome
    },
    data() {
        return {
            page: 1,
            lastPage: 1,
        }
    },
    methods: {
        loadMore() {
            this.getNotifications();
        },
        async getNotifications() {
            await this.store.getNotifications(this.urlWithPage).then((response) => {
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
        /*
        Echo.private(`timeline.${this.$user.id}`)
            .listen('.TweetCreated', (e) => {
                this.store.pushTweets([e]);
            });
        */
    },
    computed: {
        notifications() {
            return this.store.notifications;
        },
        urlWithPage() {
            return `/api/notifications?page=${this.page}`;
        }
    }
}
</script>

<style scoped>

</style>
