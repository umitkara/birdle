import { defineStore } from "pinia";
import axios from "axios";
import { without } from "lodash";

export const likes = defineStore("likes", {
    namespaced: true,
    state: () => ({
        _likes: []
    }),
    getters: {
        likes (state) {
            return state._likes;
        }
    },
    actions: {
        pushLikes(data) {
            this._likes.push(...data);
        },
        async like(tweet) {
            await axios.post(`/api/tweet/${tweet}/like`);
        },
        async unlike(tweet) {
            await axios.delete(`/api/tweet/${tweet}/like`);
        },
        pushLike(id) {
            this._likes.push(id);
        },
        popLike(id) {
            this._likes = without(this._likes, id);
        },
        syncLikes(id) {
            if (this._likes.includes(id)) {
                this.popLike(id);
                return;
            }
            this.pushLike(id);
        }
    },
});
