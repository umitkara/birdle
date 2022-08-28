<template>
    <vue-final-modal
        v-slot="{ close }"
        v-bind="$attrs"
        classes="flex justify-center items-center"
        content-class="bg-gray-900 rounded-lg p-8 relative w-6/12"
        :esc-to-close="true">
        <button class="text-gray-50 absolute top-2.5 right-2.5" @click="close">
            <i class="fa-regular fa-xmark text-lg"></i>
        </button>
        <div>
            <component
                v-if="$attrs.tweet"
                :is="`app-tweet-variation-${$attrs.tweet.type}`"
                :tweet="$attrs.tweet"
                class="p-4"
            />
            <app-tweet-reply-compose
                :tweet="$attrs.tweet"
                :close="close"
                class="p-4"
            />
        </div>
    </vue-final-modal>
</template>

<script>
import AppTweetReplyCompose from "../compose/AppTweetReplyCompose.vue";
export default {
    name: "AppTweetReplyModal",
    components: {AppTweetReplyCompose},
    inheritAttrs: false,
}
</script>

<style scoped>

</style>
