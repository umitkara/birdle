<template>
    <div class="w-full flex p-4 border-b border-gray-800 hover:bg-gray-800 items-center">
        <img :src="user.avatar" class="w-12 h-12 mr-3 rounded-full" draggable="false"/>
        <div class="flex-grow">
            <app-tweet-username :user="user"/>
        </div>
    </div>
</template>

<script>
import AppTweetUsername from "../tweets/AppTweetUsername.vue";

export default {
    name: "AppUserProfileCard",
    components: {
        AppTweetUsername
    },
    props: {
        user: {
            type: Object,
            required: true
        },
    },
}
</script>

<style scoped>

</style>
