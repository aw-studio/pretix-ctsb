<template>
    <div class="grid grid-cols-3 gap-3">
        <Text
            placeholder="Straße"
            v-model="street"
            type="text"
            class="col-span-2"
            :state="streetState"
        />
        <Text
            placeholder="Nr"
            v-model="number"
            type="text"
            :state="numberState"
        />
    </div>
</template>

<script setup lang="ts">
import { computed } from 'vue';

import { Text } from '@/components';
import { street, number } from './state';

const streetState = computed(() => {
    if (street?.length == 1) {
        return true;
    }
    if (street?.length >= 2) {
        return true;
    }
});
const numberState = computed(() => {
    if (!number.toString().match(/^\d/)) {
        console.log(number);

        return false;
    }
});
</script>
