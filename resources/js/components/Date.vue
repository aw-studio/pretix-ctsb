<template>
    <div class="grid grid-cols-3 gap-3">
        <Text
            :label="t('app.labels.dd')"
            v-model="day"
            type="text"
            inputmode="decimal"
            pattern="[0-9]*"
            :state="dayState(day)"
            name="bday-day"
        />
        <Text
            :label="t('app.labels.mm')"
            v-model="month"
            type="text"
            inputmode="decimal"
            pattern="[0-9]*"
            :state="monthState(month)"
            name="bday-month"
        />
        <Text
            :label="t('app.labels.yyyy')"
            v-model="year"
            type="text"
            inputmode="decimal"
            pattern="[0-9]*"
            :state="yearState(year)"
            name="bday-year"
        />
    </div>
</template>

<script setup lang="ts">
import { watch } from 'vue';
import { day, month, year } from '@/modules/booking/state';
import { dayState, monthState, yearState } from '@/modules/validation';
import Text from './Text.vue';
import { t } from '@/modules/i18n';

watch(
    () => day.value,
    value => {
        if (value.toString()?.length == 2) {
            let monthField = document.getElementById('bday-month');
            monthField.focus();
        }
    }
);
watch(
    () => month.value,
    value => {
        if (value.toString()?.length == 2) {
            let yearField = document.getElementById('bday-year');
            yearField.focus();
        }
    }
);
</script>
