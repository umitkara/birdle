<template>
    <input type="file" name="tweetMedia" :id="id" class="hidden" multiple @change="$emit('selected', $event.target.files);" accept="image/png, image/jpeg, video/mp4"/>
    <label :for="id" class="text-gray-500 text-xl cursor-pointer hover:text-blue-500" title="Add media to your tweet...">
        <i class="fa-regular fa-camera w-5 h-5"></i>
    </label>
</template>

<script>
export default {
    name: "AppTweetComposeMediaButton",
    props: {
        id: {
            type: String,
            required: true,
        },
    },
}
</script>

<style scoped>

</style>
