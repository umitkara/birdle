<template>
    <div class="h-screen flex flex-col justify-center">
        <form class="bg-gray-700 flex flex-col justify-center items-center p-3 rounded-l" @submit.prevent="login">
            <div class="w-1/3">
                <div>
                    <h1 class="capitalize text-gray-300 text-3xl">
                        Login
                    </h1>
                </div>
                <div class="mb-3">
                    <label for="email" class="capitalize text-gray-300 text-sm">
                        Email
                    </label>
                    <div class="flex flex-col items-center">
                        <input type="email" name="email" id="email" class="border border-gray-300 p-2 w-full"
                               v-model="email" @keyup.enter="login" required autocomplete="email" autofocus>
                        <span v-if="errors.email" class="text-red-500 text-sm" role="alert">
                            {{ errors.email[0] }}
                        </span>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="password" class="capitalize text-gray-300 text-sm">
                        Password
                    </label>
                    <div class="flex flex-col items-center">
                        <input type="password" name="password" id="password" class="border border-gray-300 p-2 w-full"
                               v-model="password" @keyup.enter="login" required autocomplete="current-password">
                        <span v-if="errors.password" class="text-red-500 text-sm" role="alert">
                    {{ errors.password[0] }}
                </span>
                    </div>
                </div>
                <div class="mb-3 flex justify-center">
                    <div class="flex items-center">
                        <input type="checkbox" name="remember" id="remember" class="mr-2" v-model="remember">
                        <label for="remember" class="capitalize text-gray-300 text-sm">
                            Remember me
                        </label>
                    </div>
                </div>
                <div class="mb-3 flex justify-center">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full"
                            @click="login">
                        Login
                    </button>
                </div>
                <div class="mb-3 flex justify-center">
                    <a href="/password/reset" class="capitalize text-gray-300 text-sm">
                        Forgot Password?
                    </a>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "AppAuthLogin",
    data() {
        return {
            email: "",
            password: "",
            remember: false,
            errors: {},
        };
    },
    methods: {
        login() {
            axios.post("/login", {
                email: this.email,
                password: this.password,
                remember: this.remember
            })
                .then(response => {
                    window.location.href = "/home";
                })
                .catch(error => {
                    this.errors = error.response.data.errors;
                });
        }
    }
}
</script>

<style scoped>

</style>
