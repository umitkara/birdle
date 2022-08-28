<template>
  <div class="h-auto border-b border-y-gray-700 pt-20 px-5 pb-4">
    <h1 v-if="userObject" class="text-gray-50 font-bold text-2xl">
      {{ userObject.data.name }}
    </h1>
    <h2 v-if="userObject" class="text-gray-500 text-lg">
      <i class="far fa-at"></i>{{ userObject.data.username }}
    </h2>
    <h2 v-if="userObject" class="text-gray-500 text-lg">
      <i class="far fa-calendar mr-1"></i>Joined {{ joinedAt }}
    </h2>
    <div v-if="userObject" class="text-gray-500 mt-3">
      <AppUserProfileStats :user="userObject" :following="userObject.data.following" :follower="userObject.data.followers"/>
    </div>
  </div>
</template>
<script>
import AppUserProfileStats from "./AppUserProfileStats.vue"

export default {
  name: 'AppUserProfileInfo',
  components: {AppUserProfileStats},
  props: {
    joinedAt: {},
    userObject: {}
  }
}
</script>
