<template>
    <p class="text-gray-300 whitespace-pre-wrap relative">
        <component :is="body" />
    </p>
</template>

<script>
export default {
    name: "AppTweetBody",
    props: {
        tweet: {
            required: true,
            avatar: String,
        }
    },
    computed: {
        body() {
            return {
                'template': `<div>${this.replaceEntities(this.tweet.body)}</div>`
            };
        },
        entities () {
            return this.tweet.entities.data.sort((a, b) => b.start - a.start);
        }
    },
    methods: {
        replaceEntities(body) {
            this.entities.forEach(entity => {
                body = body.substring(0, entity.start) + this.entityComponent(entity) + body.substring(entity.end);
            });
            return body;
        },
        entityComponent(entity) {
            return `<app-tweet-${entity.type}-entity body="${entity.body_plain}" />`;
        }
    },
}
</script>

<style scoped>

</style>
