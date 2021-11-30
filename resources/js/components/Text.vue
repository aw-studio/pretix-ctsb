<template>
    <input
        v-model="model"
        @input="updateInput"
        class="flex-1 h-10 px-4 py-1 border  focus:outline-none text-gray focus:ring"
        :placeholder="placeholder"
        :type="type"
        :class="{
            'border border-red': errors != null,
        }"
    />
</template>

<script setup lang="ts">
import { defineEmits, ref } from 'vue';
const props = defineProps({
    modelValue: {
        type: [String, Number],
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

const updateInput = event => {
    emit('update:modelValue', event.target.value);
};
</script>
