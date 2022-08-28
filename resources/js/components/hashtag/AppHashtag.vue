<template>
    <app-navigation-back-home page-name="Explore" />
    <div class="relative">
        <img src="https://picsum.photos/800/400" />
        <div class="absolute bottom-0 bg-gradient-to-b from-transparent to-gray-900 w-full h-full border-b border-gray-700"></div>
        <div class="absolute bottom-0 text-gray-300 p-4">
            <small>Most popular topic:</small>
            <br/>
            <b class="text-lg">{{ hashtags[0].name }}</b>
        </div>
    </div>
    <div class="text-gray-300 p-3 text-xl">
        Trends
    </div>
    <app-hashtag-body v-for="hashtag in hashtags" :hashtag="hashtag" />
</template>

<script>
import AppNavigationBackHome from "../navigation/AppNavigationBackHome.vue";
import AppHashtagBody from "./AppHashtagBody.vue";
export default {
    name: "AppHashtag",
    components: {
        AppHashtagBody,
        AppNavigationBackHome
    },
    props: {
        hashtags: {
            type: Array,
            required: true
        }
    }
}
</script>

<style scoped>

</style>
