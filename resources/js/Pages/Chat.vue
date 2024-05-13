<script setup>
import ChatBubble from '@/Components/ChatBubble.vue'
import { ref, onMounted } from 'vue';
</script>

<template>
    <div class="relative min-h-screen flex flex-col items-center justify-center">
        <div class="relative w-full min-h-screen max-h-screen max-w-2xl mx-auto p-6">

            <div v-chat-scroll class="block w-full max-h-[90vh] h-full p-6 border rounded-lg shadow  bg-gray-800 border-gray-700 overflow-scroll">

                    <ChatBubble />
                    <ChatBubble />
                    <ChatBubble />
                    <ChatBubble />
                    <ChatBubble />
                    <ChatBubble />
                    <ChatBubble />

            </div>


            <div class="absolute bottom-6 right-6 left-6">
                <form class="flex items-center w-full mx-auto">
                    <label for="simple-search" class="sr-only">Search</label>
                    <div class="relative w-full">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        </div>
                        <input type="text" id="simple-search" class="input-text" placeholder="Type message..." />
                    </div>
                    <button type="submit" class="p-2.5 ms-2 text-sm button-primary">
                        Send
                    </button>
                </form>
            </div>

        </div>
    </div>
</template>