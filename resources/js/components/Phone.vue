<template>
    <Text
        v-model="getAttr('phone').answer"
        placeholder="Handynummer"
        class="w-full"
        :state="phoneState"
    />
</template>

<script setup lang="ts">
import { Text } from '@/components';
import { getAttr } from '@/modules/booking';
import { computed } from 'vue';

const phoneState = computed(() => {
    if (getAttr('phone').answer == null) {
        return;
    }
    return getAttr('phone').answer.toString().length >= 7;
});
</script>
