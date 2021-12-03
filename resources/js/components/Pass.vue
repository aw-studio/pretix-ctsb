<template>
    <Boolean v-model="pass" :label="t('app.labels.pass-headline')">
        {{ t('app.lines.pass-info') }}
        <template v-slot:after>
            <Text
                v-model="getAttr('pass-id').answer"
                :label="t('app.labels.pass')"
                class="w-full mt-6"
            />
        </template>
    </Boolean>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import { Text, Boolean } from '@/components';
import { t } from '@/modules/i18n';

import { getAttr } from '@/modules/booking';
const pass = ref('False');
</script>
