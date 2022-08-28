<template>
<span class="mr-6">
    <a :href="`/user/${user.data.username}/connections?ct=followings`" class="text-gray-500 hover:text-gray-400">
        <b class="text-gray-100">{{ user.data.following - 1 }}</b> Followings
    </a>
</span>
<span>
    <a :href="`/user/${user.data.username}/connections?ct=followers`" class="text-gray-500 hover:text-gray-400">
        <b class="text-gray-100">{{ user.data.followers - 1 }}</b> Followers
    </a>
</span>
</template>
<script>
export default {
    name: 'AppUserProfileStats',
    props: {
        user: {},
    }
}
</script>
