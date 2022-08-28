<template>
    <div id="video" class="mb-4 relative">
        <video class="rounded-lg" controls preload="metadata" :src="generateVideoPreview(video)"></video>
        <a id="closeVideo" href="#" class="bg-gray-900 w-8 h-8 rounded-full absolute top-0 right-0 mt-3 mr-3 flex items-center justify-center"
           @click.prevent="$emit('removed', video)">
            <i class="fa-regular fa-xmark"></i>
        </a>
    </div>
</template>

<script>
export default {
    name: "AppTweetVideoPreview",
    props: {
        video: {
            required: true,
            type: File,
        }
    },
    methods: {
        generateVideoPreview(video) {
            return URL.createObjectURL(video);
        }
    },
}
</script>

<style scoped>
#closeVideo {
    opacity: 0;
}

#video:hover #closeVideo {
    opacity: 1;
}
</style>
