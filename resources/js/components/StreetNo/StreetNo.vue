<template>
    <div class="grid grid-cols-3 gap-3">
        <Text
            placeholder="Straße"
            v-model="street"
            type="text"
            class="col-span-2"
            :state="streetState(street)"
        />
        <Text
            placeholder="Nr"
            v-model="number"
            type="text"
            :state="numberState(number)"
        />
    </div>
</template>

<script setup lang="ts">
import { Text } from '@/components';
import { street, number } from './state';

const streetState = street => {
    if (street?.length > 0 && street?.length < 3) {
        return false;
    }
    if (street?.length > 2) {
        return true;
    }
};
const numberState = number => {
    if (number == null) {
        return;
    }
    return /^\d/.test(number);
};
</script>
