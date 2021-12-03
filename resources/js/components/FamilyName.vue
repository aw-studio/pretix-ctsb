<template>
    <Text
        v-model="form.positions[0].attendee_name_parts.family_name"
        :label="t('app.labels.family-name')"
        class="w-full"
        name="family-name"
        :state="familyNameState"
    />
</template>

<script setup lang="ts">
import { Text } from '@/components';
import { form } from '@/modules/booking';
import { familyNameState } from '@/modules/validation';
import { t } from '@/modules/i18n';
</script>
