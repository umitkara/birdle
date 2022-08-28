<template>
    <div v-clickout="close" class="relative" @mouseleave="close">
        <div @click.prevent="open = !open">
            <slot name="trigger"/>
        </div>
        <div v-show="open" class="absolute bg-gray-900 z-50 rounded-lg w-56 overflow-hidden shadow-light">
            <slot></slot>
        </div>
    </div>
</template>


<script>
import vClickout from "vue3-clickout";

export default {
    name: "AppDropdown",
    data() {
        return {
            open: false
        }
    },
    methods: {
        close(e) {
            this.open = false;
        }
    },
    directives: {
        clickout: vClickout
    }
}
</script>

<style scoped>

</style>
