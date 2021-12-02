<template>
    <input
        v-model="model"
        @input="updateInput"
        class="flex-1 h-12 px-4 py-1 text-sm text-black border  border-gray focus:outline-none focus:ring-1 focus:ring-blue-400 rounded-xs"
        :placeholder="placeholder"
        :type="type"
        :class="{
            'border border-red': state === false,
            'border border-green': state === true,
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
    state: {
        type: Boolean,
        default: null,
    },
});

const model = ref(props.modelValue);

const emit = defineEmits(['update:modelValue']);

const updateInput = event => {
    emit('update:modelValue', event.target.value);
};
</script>
