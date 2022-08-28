<template>
    <form class="flex" @submit.prevent="submit">
        <img :src="$user.avatar" class="mr-3 mt-3 w-12 h-12 rounded-full" draggable="false" />
        <div class="flex-grow">
            <AppTweetComposeTextarea :form="form" v-on:keyup.ctrl.enter="submit"/>

            <app-tweet-image-preview :images="media.images" v-if="media.images.length" @removed="removeImage"/>
            <app-tweet-video-preview :video="media.video" v-if="media.video" @removed="removeVideo"/>
            <div class="text-red-400 mt-3 text-sm" v-if="mediaError">
                * {{ this.mediaError }}
            </div>
            <app-tweet-media-progress :progress="media.progress" v-if="media.progress > 0"  class="mb-4"/>
            <div class="flex justify-between">
                <ul class="flex items-center">
                    <li class="mr-4">
                        <app-tweet-compose-media-button id="tweetMedia" @selected="handleTweetMedia"/>
                    </li>
                </ul>
                <div class="flex items-center justify-end">
                    <div class="text-sm text-gray-600 mr-2">
                        {{ form.body.length }} / 240
                    </div>
                    <button type="submit"
                            class="bg-blue-500 rounded-full
                            text-gray-300 text-center
                            px-4 py-3 font-bold leading-none
                            hover:bg-blue-700 transition duration-75 ease-in-out">
                        Tweet
                    </button>
                </div>
            </div>
        </div>
    </form>
</template>

<script>
import AppTweetComposeTextarea from "./AppTweetComposeTextarea.vue";
import AppTweetComposeMediaButton from "./media/AppTweetComposeMediaButton.vue";
import AppTweetImagePreview from "./media/AppTweetImagePreview.vue";
import AppTweetVideoPreview from "./media/AppTweetVideoPreview.vue";
import AppTweetMediaProgress from "./media/AppTweetMediaProgress.vue";

import compose from "../../mixins/compose";
import axios from "axios";

export default {
    name: "AppTweetCompose",
    components: {
        AppTweetMediaProgress,
        AppTweetVideoPreview, AppTweetImagePreview, AppTweetComposeMediaButton, AppTweetComposeTextarea},
    mixins: [compose],
    methods: {
        async post() {
            await axios.post('/api/tweet', this.form);
        }
    }
}
</script>

