<template>
    <div class="grid grid-cols-3 gap-3">
        <Text
            placeholder="PLZ"
            v-model="zip"
            type="text"
            name="postal-code"
            :state="zipState(zip)"
        />
        <Text
            placeholder="Ort"
            v-model="city"
            type="text"
            class="col-span-2"
            name="address-level2"
            :state="cityState(city)"
        />
    </div>
</template>

<script setup lang="ts">
import { Text } from '@/components';
import { zip, city } from './state';

const zipState = zip => {
    if (zip == null) {
        return;
    }
    return zip.toString().length >= 3;
};
const cityState = city => {
    if (city == null) {
        return;
    }
    return city.toString().length >= 2;
};
</script>
