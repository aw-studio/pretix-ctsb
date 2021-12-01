<template>
    <div
        class="px-6 py-3 mb-1 text-sm border-4 border-white rounded-md shadow"
        :class="{
            'bg-white': !isActive,
            'bg-blue-300 text-white border-blue-300': isActive,
        }"
    >
        <label
            :for="id"
            class="flex flex-row-reverse flex-wrap items-center justify-between cursor-pointer  hover:border-gray-100"
        >
            <input
                type="checkbox"
                :id="id"
                value="1"
                v-model="model"
                class="absolute opacity-0"
            />
            <div class="flex-1">
                <div class="mb-3 font-bold">{{ label }}</div>
                <div
                    :class="{
                        'text-gray': !isActive,
                    }"
                >
                    <slot />
                </div>
            </div>
            <div
                class="w-6 h-6 mr-4 -ml-3 rounded-full"
                :class="{
                    'bg-white bg-opacity-25': isActive,
                    'bg-blue-300 border border-blue-300 bg-opacity-10':
                        !isActive,
                }"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="-5 -7 24 24"
                    width="24"
                    fill="currentColor"
                    v-if="isActive"
                >
                    <path
                        d="M5.486 9.73a.997.997 0 0 1-.707-.292L.537 5.195A1 1 0 1 1 1.95 3.78l3.535 3.535L11.85.952a1 1 0 0 1 1.415 1.414L6.193 9.438a.997.997 0 0 1-.707.292z"
                    ></path>
                </svg>
            </div>
        </label>
        <div class="w-full" v-if="isActive">
            <slot name="after"> </slot>
        </div>
    </div>
</template>

<script setup lang="ts">
import { defineEmits, ref, watch, computed } from 'vue';
const props = defineProps({
    id: {
        type: String,
        required: true,
    },
    modelValue: {
        type: String,
        default: null,
    },
    label: {
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

const model = ref(props.modelValue == 'True');

const emit = defineEmits(['update:modelValue']);

const isActive = computed(() => {
    return model.value;
});

watch(
    () => model.value,
    value => {
        emit('update:modelValue', value ? 'True' : 'False');
    }
);
</script>
