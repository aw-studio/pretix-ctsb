<template>
    <Text
        :label="t('app.labels.phone')"
        v-model="getAttr('phone').answer"
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
        {{ t('app.errors.phone-digits') }}
    </Error>
</template>

<script setup lang="ts">
import { Text } from '@/components';
import { getAttr } from '@/modules/booking';
import { t } from '@/modules/i18n';
import { phoneState, hasAtLeastNDigits } from '@/modules/validation';
import Error from './Error.vue';
</script>
