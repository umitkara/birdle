<template>
    <div class="fixed">
        <img src="http://twitter.clone/img/favicon.svg" class="my-6" draggable="false" />
        <div v-for="item in items" :key="item.id">
            <app-navigation-item :item="item" />
        </div>
    </div>
</template>

<script>
import AppNavigationItem from "./AppNavigationItem.vue";
export default {
    name: "AppNavigation",
    components: {AppNavigationItem},
    data() {
        return {
            items: [
                {
                    name: 'Home',
                    url: '/home',
                    icon: 'home'
                },
                {
                    name: 'Explore',
                    url: '/explore',
                    icon: 'hashtag'
                },
                {
                    name: 'Notifications',
                    url: '/notifications',
                    icon: 'bell'
                },
                {
                    name: 'Messages',
                    url: '/messages',
                    icon: 'envelope'
                },
                {
                    name: 'Profile',
                    url: '/user/' + this.$user.username,
                    icon: 'user'
                },
                {
                    name: 'Logout',
                    url: '/logout',
                    icon: 'sign-out-alt'
                }
            ]
        }
    }
}
</script>

<style scoped>

</style>
