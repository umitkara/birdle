<template>
    <app-navigation-back-home :page-name="connectionType" class="capitalize" />
    <app-user-profile-card v-for="(user, index) in getConnectionArray(connectionType)" :user="user" :key="index" />
</template>

<script>
import AppNavigationBackHome from "../navigation/AppNavigationBackHome.vue";
import axios from "axios";
import AppUserProfileCard from "../user/AppUserProfileCard.vue";

export default {
    name: "AppUserProfileConnections",
    components: {
        AppUserProfileCard,
        AppNavigationBackHome
    },
    props: {
        user: {
            type: Object,
            required: true
        },
    },
    data() {
        return {
            connectionType: '',
            followings: [],
            followers: [],
        };
    },
    methods: {
        async fetchConnections() {
            const response = await axios.get(`/api/user/${this.user.id}/connections`);
            this.followings.push(...response.data.data.followers.filter(user => user.id !== this.user.id));
            this.followers.push(...response.data.data.following.filter(user => user.id !== this.user.id));
        },
        getConnectionArray(connection_type) {
            if (connection_type === 'followings') {
                return this.followings;
            } else if (connection_type === 'followers') {
                return this.followers;
            }
        }
    },
    mounted() {
        const params = new Proxy(new URLSearchParams(window.location.search), {
            get: (searchParams, prop) => searchParams.get(prop),
        });
        if (params.ct.toLowerCase() !== "followers" && params.ct.toLowerCase() !== "followings") {
            window.location.href = "/";
        }
        this.connectionType = params.ct;
        this.fetchConnections();
    }
}
</script>

<style scoped>

</style>
