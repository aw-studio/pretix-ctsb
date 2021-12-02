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
import { computed } from 'vue';
import { Text, Error } from '@/components';

import { form, emailConfirmed, validateEmail } from '@/modules/booking';

const emailState = computed(() => {
    if (!emailConfirmed.value) {
        return false;
    }
    if (validateEmail(form.email)) {
        return true;
    }
});

const emailConfirmationState = computed(() => {
    if (!emailConfirmed.value) {
        return false;
    }
    if (validateEmail(form.email_confirmation)) {
        return true;
    }
});
</script>
