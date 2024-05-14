<script setup>
import ChatBubble from '@/Components/ChatBubble.vue'
import { DynamicScroller, DynamicScrollerItem } from 'vue-virtual-scroller'
import 'vue-virtual-scroller/dist/vue-virtual-scroller.css'
import { Link, useForm, usePage } from '@inertiajs/vue3';
import axios from 'axios';
import { ref, computed, onMounted } from 'vue';
import dayjs from 'dayjs';
import relativeTime from "dayjs/plugin/relativeTime";
dayjs.extend(relativeTime)

const page = usePage()

const user = computed(() => page.props.auth.user)

const props = defineProps({
    room: Object
})

const scroller = ref(null);

const messages = ref([
    {
        id: 1,
        user: {
            username: "Kleo"
        },
        message: "sadas dnkasn dkjasn dkjasn djknas kdnasjk ndkjas ndkjasnd kjansd kjasnd"
    },
    {
        id: 2,
        user: {
            username: "Kleo"
        },
        message: "sadas dnkasn dkjasn dkjasn djknas kdnasjk ndkjas ndkjasnd kjansd kjasnd"
    },
    {
        id: 3,
        user: {
            username: "Kleo"
        },
        message: "sadas dnkasn dkjasn dkjasn djknas kdnasjk ndkjas ndkjasnd kjansd kjasnd"
    },
    {
        id: 4,
        user: {
            username: "Kleo"
        },
        message: "sadas dnkasn dkjasn dkjasn djknas kdnasjk ndkjas ndkjasnd kjansd kjasnd"
    },
    {
        id: 5,
        user: {
            username: "Kleo"
        },
        message: "sadas dnkasn dkjasn dkjasn djknas kdnasjk ndkjas ndkjasnd kjansd kjasnd"
    },
    {
        id: 6,
        user: {
            username: "Kleo"
        },
        message: "sadas dnkasn dkjasn dkjasn djknas kdnasjk ndkjas ndkjasnd kjansd kjasnd"
    },
])

const form = useForm({
    message: ''
})

const sendMessage = () => {
    if (form.message) {
        axios.post(route('chat.send'), {
            room: props.room.name,
            message: form.message,
        }).finally(() => {
            form.reset();
        });
    }
}

onMounted(() => {
    console.log(props.room.name);

    Echo.join(`rooms.${props.room.name}`)
        .here((users) => {
            console.log(users);
        })
        .joining((user) => {
            console.log(user);
        })
        .listen('.incoming.message', function (e) {
            console.log(e)

            messages.value.push(e)

            messages.value = [...messages.value];
        });
})
</script>

<template>

    <nav class="fixed top-0 start-0 w-full z-20 bg-gray-800 border-gray-700 shadow-md">
        <div class="max-w-screen-sm flex flex-wrap items-center justify-between mx-auto p-4">
            <Link :href="route('rooms')" class="flex items-center space-x-3 rtl:space-x-reverse">
                <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12l4-4m-4 4 4 4"/>
                </svg>

                <span class="self-center text-2xl font-semibold whitespace-nowrap text-primary-500">{{ props.room.name }}</span>
            </Link>
        </div>
    </nav>

    <div class="relative min-h-screen flex flex-col items-center justify-center">
        <div class="relative w-full min-h-screen max-h-screen max-w-2xl mx-auto p-6">

            <div class="absolute left-6 right-6 bottom-6 top-6 p-6 pb-16 border rounded-lg shadow  bg-gray-800 border-gray-700 overflow-y-auto">
                <DynamicScroller
                    ref="scroller"
                    :items="messages"
                    :min-item-size="40"
                    class="scroller"
                >
                    <template v-slot="{ item, index, active }">
                        <DynamicScrollerItem
                            class="items"
                            :item="item"
                            :active="active"
                            :size-dependencies="[
                                item.message,
                            ]"
                            :data-index="index"
                        >
                            <ChatBubble :message="item" :right="item.user.id == user.id" :relative-time="dayjs(item.time).fromNow()"/>
                        </DynamicScrollerItem>
                    </template>
                </DynamicScroller>
            </div>


            <div class="absolute bottom-6 right-6 left-6">
                <form @submit.prevent="sendMessage" class="flex items-center w-full mx-auto">
                    <label for="simple-search" class="sr-only">Search</label>
                    <div class="relative w-full">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        </div>
                        <input type="text" v-model="form.message" id="simple-search" class="input-text" placeholder="Type message..." />
                    </div>
                    <button type="submit" class="p-2.5 ms-2 text-sm button-primary">
                        Send
                    </button>
                </form>
            </div>

        </div>
    </div>
</template>

<style scoped>
.scroller {
    height: 100%;
}
.items {
    padding-top: 5px;
}
</style>