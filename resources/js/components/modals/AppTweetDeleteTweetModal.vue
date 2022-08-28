<script setup>
    import {timeline} from "../../store/timeline";
    const store = timeline();
</script>

<template>
    <vue-final-modal
        v-slot="{ close }"
        v-bind="$attrs"
        classes="flex justify-center items-center"
        content-class="bg-gray-900 rounded-lg p-8 relative w-4/12"
        :esc-to-close="true" @keydown.left="prev" @keydown.right="next">
        <div class="text-center text-gray-50">
            <h1 class="text-2xl font-semibold mb-3">
                Delete Tweet?
            </h1>
            <p class="mb-3">
                This can't be undone and will remove the tweet from your profile, timeline of any accounts that follow you, and from search results.
            </p>
            <p>
                <button class="p-3 bg-gray-700 rounded-full w-2/12 mr-6 hover:bg-gray-600" @click="close">
                    Cancel
                </button>
                <button class="p-3 bg-red-500 rounded-full w-2/12 hover:bg-red-700" @click="deleteTweet">
                    Delete
                </button>
            </p>
        </div>
    </vue-final-modal>
</template>

<script>
export default {
    name: "AppTweetDeleteTweetModal",
    inheritAttrs: false,
    methods: {
        deleteTweet() {
            this.store.deleteTweet(this.$attrs.tweet.id);
            this.close();
        },
        close() {
            this.$vfm.hideAll();
        },
    }
}
</script>

<style scoped>

</style>
