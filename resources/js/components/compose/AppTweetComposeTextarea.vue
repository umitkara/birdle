<template>
    <textarea
        class="bg-gray-900 border border-gray-700
        w-full text-gray-300 text-lg
        resize-none mb-2 p-2
        invalid:outline invalid:outline-2 invalid:outline-red-500"
        :placeholder="placeholder"
        autofocus v-model="form.body"
        @input="resize(); checkTweetLength()" ref="textarea" maxlength="240"></textarea>
</template>
<script>
export default {
    name: 'AppTweetComposeTextarea',
    props: {
        form: {},
        placeholder: {
            type: String,
            default: 'What\'s happening?',
            required: false
        }
    },
    methods: {
        resize() {
            this.$refs.textarea.style.height = 'auto';
            this.$refs.textarea.style.height = this.$refs.textarea.scrollHeight + 'px';
        },
        checkTweetLength(e) {
            if (this.form.body.length > 240) {
                e.preventDefault();
            }
            if (this.form.body.length == 240) {
                this.$refs.textarea.setCustomValidity('Tweet is full');
            } else {
                this.$refs.textarea.setCustomValidity('');
            }
        }
    },
}
</script>
