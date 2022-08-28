import { defineStore } from "pinia";
import axios from "axios";
import { without } from "lodash";

export const retweets = defineStore("retweets", {
    namespaced: true,
    state: () => ({
        _retweets: []
    }),
    getters: {
        retweets (state) {
            return state._retweets;
        }
    },
    actions: {
        pushRetweets(data) {
            this._retweets.push(...data);
        },
        async retweet(tweet) {
            await axios.post(`/api/tweet/${tweet}/retweet`);
        },
        async unretweet(tweet) {
            await axios.delete(`/api/tweet/${tweet}/retweet`);
        },
        pushRetweet(tweet) {
            this._retweets.push(tweet);
        },
        removeRetweet(tweet) {
            this._retweets = without(this._retweets, tweet);
        },
        syncRetweets(id) {
            if (this._retweets.includes(id)) {
                this.removeRetweet(id);
                return;
            }
            this.pushRetweet(id);
        }
    }
});
