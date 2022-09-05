<template>
    <Text
        v-model="form.email"
        :label="t('app.labels.email')"
        :state="emailState"
        class="w-full"
        name="email"
        id="email"
        type="email"
        inputmode="email"
    />
    <Text
        v-model="form.email_confirmation"
        :label="t('app.labels.confirm-email')"
        :state="emailConfirmationState"
        class="w-full"
        name="email"
        type="email"
        inputmode="email"
    />
    <Error v-if="!emailConfirmed">
        {{ t('app.errors.email-confirmed') }}
    </Error>

    <p class="py-2 text-center">
        <strong>{{ t('app.lines.attention') }}:</strong>
        {{ t('app.lines.only-sending-to-this-email') }}
    </p>
</template>

<script setup lang="ts">
import { watch } from 'vue';
import { Text, Error } from '@/components';
import { t } from '@/modules/i18n';
import { form } from '@/modules/booking';
import {
    emailConfirmed,
    emailState,
    emailConfirmationState,
} from '@/modules/validation';

watch(
    () => form.email,
    email => {
        form.positions[0].attendee_email = email;
    }
);
</script>
