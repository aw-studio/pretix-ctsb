<template>
    <Text
        v-model="form.email"
        label="E-Mail"
        :state="emailState"
        class="w-full"
        name="email"
        id="email"
        type="email"
    />
    <Text
        v-model="form.email_confirmation"
        label="E-Mail wiederholen"
        :state="emailConfirmationState"
        class="w-full"
        name="email"
        type="email"
    />
    <Error v-if="!emailConfirmed">
        Die E-Mail-Adressen stimmen nicht überein.
    </Error>
    <p class="py-2 text-center">
        <strong>Achtung:</strong> Das Ergebnis wird ausschließlich an diese
        E-Mail-Adresse gesendet.
    </p>
</template>

<script setup lang="ts">
import { Text, Error } from '@/components';

import { form } from '@/modules/booking';
import {
    emailConfirmed,
    emailState,
    emailConfirmationState,
} from '@/modules/validation';
</script>
