<template>
    <div class="absolute top-[180px] flex items-end w-full justify-between px-4 z-10">
        <img :src="userObject.data.avatar" class="rounded-full border border-4 w-[150px] h-[150px]" draggable="false">
        <div v-if="this.$user.id !== userObject.data.id">
            <button v-if="!userObject.data.is_following" @click="$emit('follow', userObject.data.id)"
                class="bg-blue-500 text-2xl rounded-full text-gray-300 text-center px-4 py-3 font-bold leading-none hover:bg-blue-700 transition duration-75 ease-in-out">
                Follow
            </button>
            <button v-if="userObject.data.is_following" @click="$emit('unfollow', userObject.data.id)"
                class="bg-blue-500 text-2xl rounded-full text-gray-300 text-center px-4 py-3 font-bold leading-none hover:bg-blue-700 transition duration-75 ease-in-out">
                Unfollow
            </button>
        </div>
    </div>
</template>
<script>
import axios from "axios";

export default {
    name: 'AppUserProfileBanner',
    props: {
        userObject: {
            type: Object,
            required: true
        }
    },
}
</script>
