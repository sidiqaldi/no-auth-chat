<script setup>
const props = defineProps({
    message: Object,
    relativeTime: String,
    right: {
        type: Boolean,
        default: false,
    }
})
</script>

<template>
    <div v-if="right" class="flex items-start justify-end gap-2.5 mt-2">
        <div class="flex flex-col w-full max-w-[320px] leading-1.5 p-4 border-gray-200 rounded-s-xl rounded-br-xl bg-primary-600">
            <div class="flex items-center space-x-2 rtl:space-x-reverse">
                <span class="text-sm font-semibold text-white">{{ message.user.username }}</span>
                <span class="text-sm font-normal text-gray-800" :title="message.time">{{ relativeTime }}</span>
            </div>
            <p class="text-sm font-normal py-2.5 text-white">{{ message.message }}</p>
            <span class="text-sm font-normal text-gray-400"></span>
        </div>
    </div>
    <div v-else class="flex items-start gap-2.5 mt-2">
        <div class="flex flex-col w-full max-w-[320px] leading-1.5 p-4 border-gray-200 rounded-e-xl rounded-es-xl bg-gray-700">
            <div class="flex items-center space-x-2 rtl:space-x-reverse">
                <span class="text-sm font-semibold text-primary-600">{{ message.user.username }}<small class="text-gray-300">#{{ message.user.id ?? ''}}</small></span>
                <span class="text-sm font-normal text-gray-400" :title="message.time">{{ relativeTime }}</span>
            </div>
            <p class="text-sm font-normal py-2.5 text-white">{{ message.message }}</p>
            <span class="text-sm font-normal text-gray-400"></span>
        </div>
    </div>
</template>