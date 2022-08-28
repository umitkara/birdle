<template>
    <a :href="`/hashtags/${body}`">
        <i class="fa-regular fa-hashtag"></i>{{ body }}
    </a>
</template>

<script>
export default {
    name: "AppTweetHashtagEntity",
    props: {
        body: {
            required: true,
            type: String,
        },
    },
}
</script>

<style scoped>

</style>
