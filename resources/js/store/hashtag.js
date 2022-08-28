import { defineStore } from "pinia";
import getters from "./tweets/getters";
import actions from "./tweets/actions";

export const hashtag = defineStore("hashtag", {
    namespaced: true,
    state: ()=> ({
        _tweets: [],
    }),
    getters: {
        ...getters,
    },
    actions: {
        ...actions,
    }
});
