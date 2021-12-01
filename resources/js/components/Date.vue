<template>
    <div class="grid grid-cols-3 gap-3">
        <Text
            placeholder="TT"
            v-model="day"
            type="text"
            inputmode="decimal"
            pattern="[0-9]*"
            :errors="dayValid"
        />
        <Text
            placeholder="MM"
            v-model="month"
            type="text"
            inputmode="decimal"
            pattern="[0-9]*"
            :errors="monthValid"
        />
        <Text
            placeholder="YYYY"
            v-model="year"
            type="text"
            inputmode="decimal"
            pattern="[0-9]*"
            :errors="yearValid"
        />
    </div>
</template>

<script setup lang="ts">
import { defineEmits, ref, watch, computed } from 'vue';
import Text from './Text.vue';
const props = defineProps({
    modelValue: {
        type: [String],
        default: null,
    },
    placeholder: {
        type: String,
        default: null,
    },
    type: {
        type: String,
        default: 'text',
    },
    errors: {
        type: String,
        default: null,
    },
});

const validDayNumbers = [
    '01',
    '02',
    '03',
    '04',
    '05',
    '06',
    '07',
    '08',
    '09',
    '10',
    '11',
    '12',
    '13',
    '14',
    '15',
    '16',
    '17',
    '18',
    '19',
    '20',
    '21',
    '22',
    '23',
    '24',
    '25',
    '26',
    '27',
    '28',
    '29',
    '30',
    '31',
];
const validMonthNumbers = [
    '01',
    '02',
    '03',
    '04',
    '05',
    '06',
    '07',
    '08',
    '09',
    '10',
    '11',
    '12',
];

const dayValid = computed(() => {
    if (day.value?.toString().length == 2) {
        return !validDayNumbers.includes(day.value) ? 'false' : null;
    }
});
const monthValid = computed(() => {
    if (month.value?.toString().length == 2) {
        return !validMonthNumbers.includes(month.value) ? 'false' : null;
    }
});
const yearValid = computed(() => {
    if (year.value?.toString().length == 4) {
        return parseInt(year.value) > 1900 && parseInt(year.value) < 2020
            ? null
            : 'false';
    }
});

const year = ref(props.modelValue?.split('-')?.[0]);
const month = ref(props.modelValue?.split('-')?.[1]);
const day = ref(props.modelValue?.split('-')?.[2]);

const emit = defineEmits(['update:modelValue']);

const date = computed(() => {
    if (year.value && month.value && day.value) {
        return `${year.value}-${month.value}-${day.value}`;
    }
});

watch(
    () => date.value,
    value => {
        emit('update:modelValue', value);
    }
);
</script>
