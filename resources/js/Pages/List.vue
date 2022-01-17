<template>
    <div v-for="item in list" class="flex bg-white border-b">
        <div>{{ item.family_name }}, {{ item.given_name }}</div>
        <div>
            <img :src="item.qr" class="mx-auto w-52" />
            <div class="text-center text-gray">{{ item.code }}</div>
        </div>
    </div>
</template>

<script setup lang="ts">
const props = defineProps({
    list: {
        type: Array,
        default: null,
    },
});
</script>
