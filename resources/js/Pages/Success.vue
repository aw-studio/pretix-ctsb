<template>
    <img :src="qr" />
    {{ downloads }}
</template>

<script setup lang="ts">
defineProps({
    qr: {
        type: String,
        default: null,
    },
    downloads: {
        default: null,
    },
});
</script>
