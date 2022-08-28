<template>
    <div class="p-3">
        <a :href="`/hashtags/${hashtag.name}`" class="text-gray-300">
            {{ hashtag.name }}
            <br/>
            <small class="text-gray-500">
                {{ hashtag.tweet_count}} Tweet{{ hashtag.tweet_count > 1 ? 's' : '' }}
            </small>
        </a>
    </div>
</template>

<script>
export default {
    name: "AppHashtagBody",
    props: {
        hashtag: {
            type: Object,
            required: true
        }
    }
}
</script>

<style scoped>

</style>
