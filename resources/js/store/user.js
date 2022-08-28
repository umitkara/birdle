import { defineStore } from "pinia";
import axios from "axios";
import getters from "./tweets/getters";
import actions from "./tweets/actions";

export const user = defineStore("user", {
    namespaced: true,
    state: ()=> ({
        _user: {},
        _tweets: [],
    }),
    getters: {
        ...getters,
        user: state => state._user.data,
        tweets: state => state._tweets,
    },
    actions: {
        ...actions,
        async fetchUser(userId) {
            this._user = await axios.get(`/api/user/${userId}`);
        },
        async follow(userId) {
            await axios.post(`/api/user/${userId}/follow`);
        },
        async unfollow(userId) {
            await axios.delete(`/api/user/${userId}/unfollow`);
        },
        syncFollowers(count) {
            this._user.data.data.followers = count;
        },
        syncIsFollowing(isFollowing) {
            this._user.data.data.is_following = isFollowing;
        },
        clearTweets() {
            this._tweets = [];
        }
    }
});
