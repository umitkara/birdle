<template>
    <a v-if="item.name !== 'Logout'" :href="item.url" class="flex text-2xl mb-3 hover:text-gray-50">
        <span>
            <i class="fas w-10" :class="'fa-' + item.icon" > </i>
        </span>
        <span>
            {{item.name}}
        </span>
    </a>
    <a href="javascript:void(0)" v-else class="flex text-2xl mb-3 hover:text-gray-50" @click.prevent="logout">
        <span>
            <i class="fas w-10" :class="'fa-' + item.icon" > </i>
        </span>
        <span>
            {{item.name}}
        </span>
    </a>
</template>

<script>
import axios from "axios";

export default {
    name: "AppNavigationItem",
    props: {
        item: {
            type: Object,
            required: true,

        }
    },
    methods: {
        logout() {
            axios.post("/logout").then(response => {
                // redirect to home page
                window.location.href = "/";
            });
        }
    }
}
</script>

<style scoped>

</style>
