<template>
    <Text
        :label="t('app.labels.street-no')"
        v-model="getAttr('street-no').answer"
        type="text"
        class="w-full"
        name="address-line1"
        :state="streetNoState"
    />
</template>

<script setup lang="ts">
import { Text } from '@/components';
import { getAttr } from '@/modules/booking';
import { streetNoState } from '@/modules/validation';
import { t } from '@/modules/i18n';
</script>
