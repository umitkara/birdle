<template>
    <form class="p-3 flex items-center" @submit.prevent="sendMessage">
        <input type="hidden" name="chat_id" :value="chatId">
        <textarea name="message" class="bg-gray-900 border border-gray-700
            w-full text-gray-300 text-lg
            resize-none mr-2 p-2" @input="resize()" ref="textarea" placeholder="Type your message..."></textarea>
        <button class="min-w-[90px] bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full h-fit" type="submit">
            <i class="fa-solid fa-paper-plane-top"></i> Send
        </button>
    </form>
</template>

<script>
import axios from "axios";
export default {
    name: "AppChatMessageCompose",
    props: {
        chatId: {
            type: Number,
            required: true,
        },
    },
    methods: {
        resize() {
            this.$refs.textarea.style.height = 'auto';
            this.$refs.textarea.style.height = this.$refs.textarea.scrollHeight + 'px';
        },
        async sendMessage() {
            await axios.post(`/api/chat/${this.chatId}/message`, {
                chat_id: this.chatId,
                message: this.$refs.textarea.value,
            });
            this.$refs.textarea.value = '';
            this.resize();
            // emit message sent event
            this.$emit('messageSent');
        },
    },
}
</script>

<style scoped>

</style>
