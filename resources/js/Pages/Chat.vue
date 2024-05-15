<script setup>
import { ref, computed, onMounted } from 'vue';
import { Head, router, useForm, usePage } from '@inertiajs/vue3';
import axios from 'axios';

import ChatBubble from '@/Components/ChatBubble.vue'
import Layout from '@/Layout.vue'

import { DynamicScroller, DynamicScrollerItem } from 'vue-virtual-scroller'
import 'vue-virtual-scroller/dist/vue-virtual-scroller.css';

import dayjs from 'dayjs';
import relativeTime from "dayjs/plugin/relativeTime";
dayjs.extend(relativeTime)

const page = usePage()
const user = computed(() => page.props.auth.user)

const props = defineProps({
    room: Object
})

const messages = ref([
    {
        id: 1,
        user: {
            username: "System"
        },
        message: "Hello welcome to chat room",
        time: new Date
    },
])

const members = ref([]);

const form = useForm({
    message: ''
})

const sendMessage = () => {
    if (form.message) {
        let message = form.message;

        form.reset();

        axios.post(route('chat.send'), {
            room: props.room.name,
            message: message,
        }).catch((err) => {
            router.visit(route('rooms'))
        });
    }
}

onMounted(() => {
    scrollToBottom();

    Echo.join(`rooms.${props.room.name}`)
        .here((users) => {
            members.value = [...users];
        })
        .joining((user) => {
            setTimeout(() => {
                members.value.push(user);
            }, 400)
        })
        .leaving((user) => {
            members.value = members.value.filter(item => item.id !== user.id);
        })
        .listen('.incoming.message', function (e) {
            messages.value.push(e)

            messages.value = [...messages.value];

            scrollToBottom();
        });
})

const scrollToBottom = () => {
    setTimeout(() => {
        let chatWindow = document.getElementById('chat-window');

        chatWindow.scrollTop = chatWindow.scrollHeight;
    }, 400);
}

const leave = () => {
    Echo.leave(`rooms.${props.room.name}`)

    router.visit(route('rooms'));
}
</script>

<template>
    <Head :title="props.room.name + ' - Chat Room'" />

    <Layout>

        <nav class="fixed top-0 start-0 w-full z-20 bg-gray-800 border-gray-700 shadow-md">
            <div class="max-w-screen-sm flex flex-wrap items-center justify-between mx-auto p-4">
                <div class="flex items-center space-x-3 rtl:space-x-reverse">
                    <button @click.prevent="leave" class="inline">
                        <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12l4-4m-4 4 4 4"/>
                        </svg>
                    </button>
                    <button data-modal-target="default-modal" data-modal-toggle="default-modal" class="self-center text-2xl font-semibold whitespace-nowrap text-primary-500">{{ props.room.name }}</button>
                </div>
            </div>
        </nav>

        <div id="default-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-2xl max-h-full">
                <div class="relative rounded-lg shadow bg-gray-700">
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-600">
                        <h3 class="text-xl font-semibold text-white">
                            Members
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center hover:bg-gray-600 hover:text-white" data-modal-hide="default-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <div class="p-4 md:p-5 space-y-4">
                        <ul class="max-w-md space-y-1 list-disc list-inside text-gray-400">
                            <li v-for="member in members">
                                <span class="text-white font-bold">{{ member.username }}</span>#{{ member.id }} <span class="text-primary-500 font-thin" v-if="member.id == user.id">(this is you)</span>
                            </li>
                        </ul>
                    </div>
                    <div class="flex items-center justify-end p-4 md:p-5 border-t rounded-b border-gray-600">
                        <button data-modal-hide="default-modal" type="button" class="text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-primary-600 hover:bg-primary-700 focus:ring-primary-800">Close</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="relative min-h-screen flex flex-col items-center justify-center">
            <div class="relative w-full min-h-screen max-h-screen max-w-2xl mx-auto p-6">

                <div class="absolute left-6 right-6 bottom-6 top-6 p-6 pb-16 border rounded-lg shadow  bg-gray-800 border-gray-700 overflow-y-auto">
                    <DynamicScroller
                        id="chat-window"
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
                            <input
                                type="text"
                                v-model="form.message"
                                id="simple-search"
                                class="input-text"
                                placeholder="Type message..."
                                aria-autocomplete="both" aria-haspopup="false" autocapitalize="off" autocomplete="off" autocorrect="off" autofocus="" spellcheck="false"
                            />
                        </div>
                        <button type="submit" class="p-2.5 ms-2 text-sm button-primary">
                            Send
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </Layout>
</template>

<style scoped>
.scroller {
    height: 100%;
}
.items {
    padding-top: 5px;
}
</style>