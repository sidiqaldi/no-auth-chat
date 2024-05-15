<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import Layout from '@/Layout.vue'

const form = useForm({
    username: ''
})

const submit = () => {
    form.post(route('setup.store'));
}
</script>

<template>
    <Head title="No Auth Chat" />

    <Layout>
        <div class="relative min-h-screen flex flex-col items-center justify-center">
            <div class="relative w-full max-w-2xl mx-auto px-6">
                <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
                    <div class="w-full rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 card-background">
                        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                            <h1 class="text-center text-xl font-bold leading-tight tracking-tight md:text-2xl text-white">
                                To get started, please enter a <span class="underline italic font-normal px-2">username</span> for you.
                            </h1>
                            <form @submit.prevent="submit" class="space-y-4 md:space-y-6">
                                <div>
                                    <label for="username" class="sr-only block input-label">Username</label>
                                    <input
                                        type="text"
                                        v-model="form.username"
                                        name="username"
                                        id="username"
                                        class="text-center input-text"
                                        placeholder="please type your username"
                                    >
                                    <p v-if="form.errors.username" class="mt-2 text-center text-sm text-red-600 dark:text-red-500">
                                        {{ form.errors.username }}
                                    </p>
                                </div>
                                <button type="submit" class="w-full button-primary">Start</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>