import { defineStore } from "pinia";

import getters from "./tweets/getters";
import actions from "./tweets/actions";

export const timeline = defineStore("timeline", {
    namespaced: true,
    state: ()=> ({
        _tweets: []
    }),
    getters,
    actions,
});
