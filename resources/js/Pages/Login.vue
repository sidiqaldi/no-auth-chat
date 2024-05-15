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
                    <div class="w-full rounded-lg shadow border md:mt-0 sm:max-w-md xl:p-0 card-background">
                        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                            <h1 class="mb-4 text-center text-3xl font-extrabold leading-none tracking-tight md:text-4xl lg:text-6xl text-white">
                                <span class="text-primary-500">NoAuth</span>Chat
                            </h1>

                            <h1 class="text-center text-lg xs:text-xl font-bold leading-tight tracking-tight md:text-2xl text-white">
                                To get started, please enter <br/>a <span class="underline italic font-normal px-2">username</span> for you.
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
                                    <p v-if="form.errors.username" class="mt-2 text-center text-sm text-red-600 text-red-500">
                                        {{ form.errors.username }}
                                    </p>
                                </div>
                                <button type="submit" class="w-full button-primary">Start</button>
                            </form>
                        </div>
                    </div>


                    <div class="mt-5 w-full rounded-lg shadow border sm:max-w-md p-6 card-background">
                        <h5 class="mb-2 text-3xl font-bold text-white"><span class="text-primary-500">App</span>Stack.</h5>
                        <p class="mt-4 mb-10 max-w-screen-md mx-auto text-base text-gray-400 prose">
                            <ul>
                                <li>Laravel framework</li>
                                <li>Inertia.JS</li>
                                <li>Laravel reverb for websocket connection</li>
                                <li>No database <span class="text-white italic">* no conversation will be saved</span></li>
                            </ul>
                        </p>
                        <div class="items-center justify-center space-y-4 sm:flex sm:space-y-0 sm:space-x-4 rtl:space-x-reverse">
                            <a href="https://github.com/sidiqaldi/no-auth-chat" class="w-full sm:w-auto focus:ring-4 focus:outline-none text-white rounded-lg inline-flex items-center justify-center px-4 py-2.5 bg-gray-700 hover:bg-gray-600 focus:ring-gray-700">
                                <svg class=" text-gray-400 me-3 w-7 h-7" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M12.006 2a9.847 9.847 0 0 0-6.484 2.44 10.32 10.32 0 0 0-3.393 6.17 10.48 10.48 0 0 0 1.317 6.955 10.045 10.045 0 0 0 5.4 4.418c.504.095.683-.223.683-.494 0-.245-.01-1.052-.014-1.908-2.78.62-3.366-1.21-3.366-1.21a2.711 2.711 0 0 0-1.11-1.5c-.907-.637.07-.621.07-.621.317.044.62.163.885.346.266.183.487.426.647.71.135.253.318.476.538.655a2.079 2.079 0 0 0 2.37.196c.045-.52.27-1.006.635-1.37-2.219-.259-4.554-1.138-4.554-5.07a4.022 4.022 0 0 1 1.031-2.75 3.77 3.77 0 0 1 .096-2.713s.839-.275 2.749 1.05a9.26 9.26 0 0 1 5.004 0c1.906-1.325 2.74-1.05 2.74-1.05.37.858.406 1.828.101 2.713a4.017 4.017 0 0 1 1.029 2.75c0 3.939-2.339 4.805-4.564 5.058a2.471 2.471 0 0 1 .679 1.897c0 1.372-.012 2.477-.012 2.814 0 .272.18.592.687.492a10.05 10.05 0 0 0 5.388-4.421 10.473 10.473 0 0 0 1.313-6.948 10.32 10.32 0 0 0-3.39-6.165A9.847 9.847 0 0 0 12.007 2Z" clip-rule="evenodd"></path>
                                </svg>
                                <div class="text-left rtl:text-right">
                                    <div class="mb-1 text-xs">Source on the</div>
                                    <div class="-mt-1 font-sans text-sm font-semibold">GitHub</div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>


            </div>


        </div>


    </Layout>
</template>