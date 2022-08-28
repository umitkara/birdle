import { defineStore } from "pinia";
import axios from "axios";

import actions from "./tweets/actions";
import getters from "./tweets/getters";

export const notification = defineStore("notification", {
    namespaced: true,
    state: ()=> ({
        _notifications: [],
        _tweets: []
    }),
    getters: {
        ...getters,
        notifications: state => state._notifications.sort((a, b) => b.created_at - a.created_at),
        tweetIdsFromNotifications: state => state._notifications.map(n => n.data.tweet.id),
    },
    actions: {
        ...actions,
        pushNotifications(data) {
            this._notifications.push(...data);
        },
        async getNotifications(url) {
            const response = await axios.get(url);
            this.pushNotifications(response.data.data);

            await this.getTweets(`api/tweet?ids=${this.tweetIdsFromNotifications.join(",")}`);

            return response;
        },
    }
});
