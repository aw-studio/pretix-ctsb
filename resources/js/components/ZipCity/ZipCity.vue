<template>
    <div class="grid grid-cols-3 gap-3">
        <Text
            label="PLZ"
            v-model="zip"
            type="text"
            name="postal-code"
            :state="zipState(zip)"
        />
        <Text
            label="Ort"
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
import { zip, city } from '@/modules/booking/state';
import { zipState, cityState } from '@/modules/validation';
</script>
