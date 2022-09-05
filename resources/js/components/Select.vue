<template>
    <div>
        <select
            v-model="model"
            class="flex-1 w-full h-12 px-3 py-1 text-sm text-black border border-gray focus:outline-none focus:ring-1 focus:ring-blue-400 rounded-xs"
            :class="{
                'mt-0': label != null,
            }"
        >
            <option selected disabled>{{ label }}</option>
            <option :value="option.value" v-for="option in options">
                {{ option.label }}
            </option>
        </select>
    </div>
</template>

<script setup lang="ts">
import { i18n } from '@/modules/i18n';
import { defineEmits, ref, PropType, watch } from 'vue';
import { useI18n } from 'vue-i18n';

interface Option {
    label: string;
    value: string | number;
}

const props = defineProps({
    modelValue: {
        type: [String, Number],
        default: null,
    },
    options: {
        type: Array as PropType<any[]>,
        required: true,
    },
    label: {
        type: String,
        default: null,
    },
    name: {
        type: String,
        default: null,
    },
    type: {
        type: String,
        default: 'text',
    },
    state: {
        type: Boolean,
        default: null,
    },
});

const model = ref(props.modelValue);

const emit = defineEmits(['update:modelValue']);

watch(
    () => model.value,
    val => {
        emit('update:modelValue', val);
    }
);
</script>
