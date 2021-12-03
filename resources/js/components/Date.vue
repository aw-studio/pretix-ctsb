<template>
    <div class="grid grid-cols-3 gap-3">
        <Text
            label="TT"
            v-model="day"
            type="text"
            inputmode="decimal"
            pattern="[0-9]*"
            :state="dayState(day)"
            name="bday-day"
        />
        <Text
            label="MM"
            v-model="month"
            type="text"
            inputmode="decimal"
            pattern="[0-9]*"
            :state="monthState(month)"
            name="bday-month"
        />
        <Text
            label="YYYY"
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
