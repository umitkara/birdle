<template>
    <div class="flex w-full border-b border-gray-800">
        <component :is="`AppNotification${notification.type}`" :notification="notification" :store="store"/>
    </div>
</template>

<script>
export default {
    name: "AppNotification.vue",
    props: {
        notification: {
            type: Object,
            required: true,
        },
        store: {
            type: Object,
            required: true,
        },
    },
}
</script>

<style scoped>

</style>
