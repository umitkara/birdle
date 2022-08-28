<template>
    <a :href="`/user/${body}`">
        <i class="fa-regular fa-at"></i>{{ body }}
    </a>
</template>

<script>
export default {
    name: "AppTweetMentionEntity",
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
