<template>
    <input v-model="model" type="checkbox" value="1" />
</template>

<script setup lang="ts">
import { defineEmits, ref, watch } from 'vue';
const props = defineProps({
    modelValue: {
        type: Boolean,
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

const model = ref(props.modelValue);

const emit = defineEmits(['update:modelValue']);

watch(
    () => model.value,
    value => {
        emit('update:modelValue', value ? 'True' : 'False');
    }
);
</script>
