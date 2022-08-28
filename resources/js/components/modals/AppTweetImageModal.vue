<template>
    <vue-final-modal
        v-slot="{ close }"
        v-bind="$attrs"
        classes="flex justify-center items-center"
        content-class="bg-gray-900 rounded-lg p-8 relative w-6/12"
        :esc-to-close="true" @keydown.left="prev" @keydown.right="next">
        <button class="text-gray-50 absolute top-2.5 right-2.5" @click="this.close()">
            <i class="fa-regular fa-xmark text-lg"></i>
        </button>
        <div v-if="this.$attrs.images.length > 1" class="text-gray-50 absolute left-2.5 top-1/2 cursor-pointer hover:text-gray-400" @click="prev">
            <i class="fa-regular fa-chevron-left text-lg"></i>
        </div>
        <div v-if="this.$attrs.images.length > 1" class="text-gray-50 absolute right-2.5 top-1/2 cursor-pointer hover:text-gray-400" @click="next">
            <i class="fa-regular fa-chevron-right text-lg"></i>
        </div>
        <div>
            <img :src="$attrs.images[current_image].id" />
        </div>
    </vue-final-modal>
</template>

<script>
export default {
    name: "AppTweetImageModal",
    inheritAttrs: false,
    data() {
        return {
            current_image: 0,
        };
    },
    methods: {
        close() {
            this.$vfm.hideAll();
        },
        next() {
            if (this.$attrs.images.length == 1) {
                return;
            }
            this.current_image++;
            if (this.current_image >= this.$attrs.images.length) {
                this.current_image = 0;
            }
        },
        prev() {
            if (this.$attrs.images.length == 1) {
                return;
            }
            this.current_image--;
            if (this.current_image < 0) {
                this.current_image = this.$attrs.images.length - 1;
            }
        },
    },
    mounted() {
        this.current_image = this.$attrs.current_image;
    }
}
</script>

<style scoped>

</style>
