<script setup>
import { Link, useForm, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import dayjs from 'dayjs';
import relativeTime from "dayjs/plugin/relativeTime";
dayjs.extend(relativeTime)

const page = usePage()

const user = computed(() => page.props.auth.user)

const props = defineProps({
    rooms: Array
})

const form = useForm({
    name: '',
    hidden: false,
})

const joinRoom = () => {
    form.post(route('rooms.store'))
}

</script>
<template>
    <div class="relative min-h-screen flex flex-col items-center justify-center">
        <div class="relative w-full max-w-2xl mx-auto px-6">

            <div class="block w-full p-6 border rounded-lg shadow  bg-gray-800 border-gray-700">
                <h1 class="mb-4 text-center text-2xl font-extrabold leading-none tracking-tight md:text-3xl lg:text-4xl text-white">
                    Hi <span class="text-primary-500">{{ user.username }}</span><small class="text-gray-400">#{{ user.id }}</small>
                </h1>

                <form @submit.prevent="joinRoom">
                    <p v-if="form.errors.name" class="mt-2 text-center text-sm text-red-500">
                        {{ form.errors.name }}
                    </p>
                    <div class="mt-2 flex items-center max-w-sm mx-auto" >
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

                    <div class="mt-2 flex items-center max-w-sm mx-auto" >
                        <div class="flex items-center mb-4">
                            <input id="default-checkbox" type="checkbox" v-model="form.hidden" class="w-4 h-4 text-primary-600   rounded focus:ring-primary-600 ring-offset-gray-800 focus:ring-2 bg-gray-700 border-gray-600">
                            <label for="default-checkbox" class="ms-2 text-sm font-medium text-gray-300">hidden</label>
                        </div>
                    </div>
                </form>

            </div>


            <div class="block mt-2 w-full p-6 border rounded-lg shadow  bg-gray-800 border-gray-700">
                <h1 class="mb-4 text-center text-2xl font-extrabold leading-none tracking-tight md:text-3xl lg:text-4xl text-white">
                    <span class="text-primary-500">Public</span> Rooms.
                </h1>

                <div class="mt-2 w-full text-sm font-medium border rounded-lg bg-gray-700 border-gray-600 text-white">
                    <Link v-for="(room, index) in props.rooms" :href="route('rooms.show', room.name)" :class="{'rounded-t-lg': index == 0, 'rounded-b-lg' : index == (props.rooms.length - 1)}"
                        class="flex justify-between w-full px-4 py-2 border-b cursor-pointer focus:outline-none focus:ring-2 border-gray-600 hover:bg-gray-600 hover:text-white focus:ring-gray-500 focus:text-white"
                    >
                        <div>{{ room.name }}</div> <div>expired {{ dayjs().to(dayjs(room.expired_at)) }}</div>
                    </Link>
                    <div v-if="props.rooms.length == 0" class="flex text-gray-500 justify-center w-full px-4 py-2 rounded-y-lg cursor-pointer  border-gray-600">
                        <div> No public room available right now.</div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>