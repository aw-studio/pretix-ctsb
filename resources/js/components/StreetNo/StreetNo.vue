<template>
    <Text
        label="Straße + Hausnummer"
        v-model="getAttr('street-no').answer"
        type="text"
        class="w-full"
        name="address-line1"
        :state="streetState(getAttr('street-no').answer)"
    />
</template>

<script setup lang="ts">
import { Text } from '@/components';
import { getAttr } from '@/modules/booking';

const streetState = street => {
    if (street?.length > 0 && street?.length < 3) {
        return false;
    }
    if (street?.length > 2) {
        return true;
    }
};
</script>
