<template>
    <component :is="`app-chat-messages-${messageType}`" :message="message" :key="message.id" />
</template>

<script>
import AppChatMessagesSender from "./AppChatMessagesSender.vue";
import AppChatMessagesReceiver from "./AppChatMessagesReceiver.vue";

export default {
    name: "AppChatMessage",
    props: {
        message: {
            type: Object,
            required: true,
        },
    },
    computed : {
        messageType() {
            if (this.$user.id === this.message.user.id) {
                return 'sender';
            } else {
                return 'receiver';
            }
        },
    },
}
</script>

<style scoped>

</style>
