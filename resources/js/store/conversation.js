import { defineStore } from "pinia";
import actions from "./tweets/actions";

export const conversation = defineStore("conversation", {
    namespaced: true,
    state: ()=> ({
        _tweets: []
    }),
    getters: {
        tweets: state => state._tweets,
        tweet: state => id => state._tweets.find(tweet => tweet.id == id),
        parents: state => id => state._tweets.filter(tweet => {
            return tweet.id != id && !tweet.parent_ids.includes(parseInt(id))
        }).sort((a, b) => a.created_at - b.created_at),
        replies: state => id => state._tweets.filter(tweet => tweet.parent_id == id)
                                             .sort((a, b) => a.created_at - b.created_at)
    },
    actions
});
