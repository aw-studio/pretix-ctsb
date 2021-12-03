<template>
    <Text
        label="Vorname"
        v-model="form.positions[0].attendee_name_parts.given_name"
        type="text"
        class="w-full"
        name="given-name"
        :state="givenNameState"
    />
</template>

<script setup lang="ts">
import { Text } from '@/components';
import { form } from '@/modules/booking';
import { givenNameState } from '@/modules/validation';
</script>
