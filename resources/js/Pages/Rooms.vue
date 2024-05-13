<script setup>
import { useForm } from '@inertiajs/vue3';
import { onMounted } from 'vue'

const form = useForm({
    name: '',
    hidden: false,
})

const joinRoom = () => {
    form.post(route('rooms.store'))
}

onMounted(() => {
    Echo.join(`rooms.25`)
        .here((users) => {
            console.log(users);
        })
        .joining((user) => {
            console.log(user);
        })
})

</script>
<template>
    <div class="relative min-h-screen flex flex-col items-center justify-center">
        <div class="relative w-full max-w-2xl mx-auto px-6">

            <div class="block w-full p-6 border rounded-lg shadow  bg-gray-800 border-gray-700">

                <form @submit.prevent="joinRoom">
                    <div class="flex items-center max-w-sm mx-auto" >
                        <label for="simple-search" class="sr-only">Search</label>
                        <div class="relative w-full">
                            <input
                                type="text"
                                id="simple-search"
                                v-model="form.name"
                                class="text-center input-text"
                                placeholder="Enter room name..."
                            />
                        </div>
                        <button type="submit" class="p-2.5 ms-2 text-sm font-medium text-white rounded-lg border border-primary-700 focus:ring-4 focus:outline-none bg-primary-600 hover:bg-primary-700 focus:ring-primary-800">
                            <span>Create/Join</span>
                        </button>
                    </div>
                    <p v-if="form.errors.name" class="mt-2 text-center text-sm text-red-600 dark:text-red-500">
                        {{ form.errors.name }}
                    </p>
                    <div class="mt-2 flex items-center max-w-sm mx-auto" >
                        <div class="flex items-center mb-4">
                            <input id="default-checkbox" type="checkbox" v-model="form.hidden" class="w-4 h-4 text-primary-600   rounded focus:ring-primary-600 ring-offset-gray-800 focus:ring-2 bg-gray-700 border-gray-600">
                            <label for="default-checkbox" class="ms-2 text-sm font-medium text-gray-300">hidden</label>
                        </div>
                    </div>
                </form>

            </div>


        </div>
    </div>
</template>