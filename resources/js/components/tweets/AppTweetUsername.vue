<template>
<a :href="`/user/${user.username}`" class="text-gray-300 font-bold">
                    {{ user.name }}
                    <span class="text-gray-600 font-normal">
                        @{{ user.username }}
                    </span>
                </a>
</template>
<script>
export default {
    name: 'app-tweet-username',
    props: {
        user: {
            required: true,
        }
    }
}
</script>
