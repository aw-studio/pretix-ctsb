<template>
    <Text
        v-model="form.positions[0].attendee_name_parts.family_name"
        label="Nachname"
        class="w-full"
        name="family-name"
        :state="state"
    />
</template>

<script setup lang="ts">
import { computed } from 'vue';

import { Text } from '@/components';
import { form } from '@/modules/booking';

const state = computed(() => {
    if (form.errors['positions.0.attendee_name_parts.family_name']) {
        return false;
    }

    if (form.positions[0].attendee_name_parts.family_name?.length >= 2) {
        return true;
    }
});
</script>
