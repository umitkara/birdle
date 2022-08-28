<template>
    <div class="flex w-full">
        <div class="w-1/2 bg-gray-700 text-white p-3 m-3 rounded-lg">
            <small>
                {{ message.human_time }}
            </small>
            <p>
                {{ message.message }}
            </p>
        </div>
    </div>
</template>

<script>
export default {
    name: "AppChatMessagesReceiver",
    props: {
        message: {
            type: Object,
            required: true,
        },
    },
}
</script>

<style scoped>

</style>
