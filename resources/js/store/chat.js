import { defineStore } from "pinia";
import axios from "axios";

export const chat = defineStore("chat", {
    namespaced: true,
    state: () => ({
        _chats: [],
        _messages: []
    }),
    getters: {
        chats: state => state._chats,
        chat: state => id => state._chats.find(chat => chat.id == id),
        messages: state => state._messages,
    },
    actions: {
        async getChats(url) {
            const response = await axios.get(url);
            this.pushChats(response.data.data);
            return response;
        },
        pushChats(data) {
            this._chats.push(
                ...data.filter((chat) => {
                    return !this._chats.map(chat => chat.id).includes(chat.id);
                })
            );
        },
        async getMessages(url) {
            const response = await axios.get(url);
            this.pushMessages(response.data.data);
            return response;
        },
        pushMessages(data) {
            this._messages.push(
                ...data.filter((message) => {
                    return !this._messages.map(message => message.id).includes(message.id);
                })
            );
        },
    }
});
