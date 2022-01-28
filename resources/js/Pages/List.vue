<template>
    <div v-for="item in list" class="flex bg-white border-b">
        <div>{{ item.given_name }} {{ item.family_name }}</div>
        <div>
            <img :src="item.qr" class="mx-auto w-52" />
            <div class="text-center text-gray">{{ item.code }}</div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { PropType } from 'vue';

const props = defineProps({
    list: {
        type: Array as PropType<any>,
        default: null,
    },
});
</script>
