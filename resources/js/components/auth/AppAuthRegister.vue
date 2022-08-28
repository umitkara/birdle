<template>
    <div class="h-screen flex flex-col justify-center">
        <form class="bg-gray-700 flex flex-col justify-center items-center p-3 rounded-l" @submit.prevent="register">
            <div>
                <div>
                    <h1 class="capitalize text-gray-300 text-3xl">
                        Register
                    </h1>
                </div>
                <div class="mb-3">
                    <label for="username" class="capitalize text-gray-300 text-sm">
                        Username
                    </label>
                    <div class="flex flex-col items-center">
                        <input type="text" name="username" id="username" class="border border-gray-300 p-2 w-full"
                               v-model="username" required autocomplete="username">
                        <span v-if="errors.username" class="text-red-500 text-sm" role="alert">
                            {{ errors.username[0] }}
                        </span>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="name" class="capitalize text-gray-300 text-sm">
                        Name
                    </label>
                    <div class="flex flex-col items-center">
                        <input type="text" name="name" id="name" class="border border-gray-300 p-2 w-full"
                               v-model="name" required autocomplete="name">
                        <span v-if="errors.name" class="text-red-500 text-sm" role="alert">
                            {{ errors.name[0] }}
                        </span>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="email" class="capitalize text-gray-300 text-sm">
                        Email
                    </label>
                    <div class="flex flex-col items-center">
                        <input type="email" name="email" id="email" class="border border-gray-300 p-2 w-full"
                               v-model="email" required autocomplete="email">
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
                               v-model="password" required autocomplete="new-password">
                        <span v-if="errors.password" class="text-red-500 text-sm" role="alert">
                            {{ errors.password[0] }}
                        </span>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="password-confirm" class="capitalize text-gray-300 text-sm">
                        Confirm Password
                    </label>
                    <div class="flex flex-col items-center">
                        <input type="password" name="password_confirmation" id="password-confirm" class="border border-gray-300 p-2 w-full"
                               v-model="password_confirmation" required autocomplete="new-password">
                        <span v-if="errors.password_confirmation" class="text-red-500 text-sm" role="alert">
                            {{ errors.password_confirmation[0] }}
                        </span>
                    </div>
                </div>
                <div class="mb-3 w-full">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full w-full">
                        Register
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: "AppAuthRegister",
    data() {
        return {
            username: '',
            name: '',
            email: '',
            password: '',
            password_confirmation: '',
            errors: {},
        };
    },
    methods: {
        register() {
            axios.post('/register', {
                username: this.username,
                name: this.name,
                email: this.email,
                password: this.password,
                password_confirmation: this.password_confirmation
            })
                .then(response => {
                    window.location.href = '/login';
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
