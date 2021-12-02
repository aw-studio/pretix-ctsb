<template>
    <Text
        v-model="form.positions[0].attendee_name_parts.given_name"
        placeholder="Vorname"
        class="w-full"
        name="given-name"
        :state="state"
    />
</template>

<script setup lang="ts">
import { computed } from 'vue';

import { Text } from '@/components';
import { form } from '@/modules/booking';

const state = computed(() => {
    if (form.errors['positions.0.attendee_name_parts.given_name']) {
        return false;
    }

    if (form.positions[0].attendee_name_parts.given_name?.length >= 2) {
        return true;
    }
});
</script>
