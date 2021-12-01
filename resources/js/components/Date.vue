<template>
    <div class="grid grid-cols-3 gap-3">
        <Text
            placeholder="TT"
            v-model="day"
            type="text"
            inputmode="decimal"
            pattern="[0-9]*"
        />
        <Text
            placeholder="MM"
            v-model="month"
            type="text"
            inputmode="decimal"
            pattern="[0-9]*"
        />
        <Text
            placeholder="YYYY"
            v-model="year"
            type="text"
            inputmode="decimal"
            pattern="[0-9]*"
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
