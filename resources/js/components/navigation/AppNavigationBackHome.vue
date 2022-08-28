<template>
    <div class="h-12 flex items-center border-b-2 border-gray-800">
        <a href="/home" class="text-gray-500 text-2xl mx-5 hover:text-gray-400">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <span class="text-gray-500 text-2xl font-semibold">
            {{ pageName }}
        </span>
    </div>
</template>

<script>
export default {
    name: "AppNavigationBackHome",
    props: {
        pageName: {
            type: String,
            required: true,
        }
    },
}
</script>

<style scoped>

</style>
