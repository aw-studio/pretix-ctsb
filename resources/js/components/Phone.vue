<template>
    <Text
        v-model="getAttr('phone').answer"
        label="Handynummer"
        class="w-full"
        name="tel"
        :state="phoneState"
    />
    <Error
        v-if="
            !hasAtLeastNDigits(getAttr('phone').answer, 7) &&
            phoneState == false
        "
    >
        Die Handynummer muss mindestens 7 Zahlen enthalten
    </Error>
</template>

<script setup lang="ts">
import { Text } from '@/components';
import { getAttr } from '@/modules/booking';
import { phoneState, hasAtLeastNDigits } from '@/modules/validation';
import Error from './Error.vue';
</script>
