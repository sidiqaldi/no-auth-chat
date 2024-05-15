<script setup>
import { initFlowbite } from 'flowbite';
import { onMounted } from 'vue';

onMounted(() => {
    initFlowbite();
})
</script>

<template>
    <div class="antialiased">
        <slot />
    </div>
</template>
