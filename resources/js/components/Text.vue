<template>
    <div class="relative text-black" :class="useAttrs().class">
        <input
            v-bind="{ ...useAttrs(), class: '' }"
            v-model="model"
            @input="updateInput"
            @focusin="focus = true"
            @focusout="focus = false"
            class="flex-1 w-full h-12 px-4 py-1 text-sm text-black border  border-gray focus:outline-none focus:ring-1 focus:ring-blue-400 rounded-xs"
            :placeholder="label"
            :type="type"
            :class="{
                'border border-red': state === false,
                'border border-green': state === true,
            }"
            :name="name"
            :id="name"
            :autocomplete="name"
            autocomplete="on"
        />
        <div
            class="absolute left-0 mx-1 ml-2 text-sm transition-all duration-75 origin-left transform bg-white rounded-sm pointer-events-none  top-1"
            :class="{
                ' px-2 py-2.5 mt-0': isEmpty && !focus,
                ' px-2 py-0 scale-75 -mt-3.5': !isEmpty || focus,
            }"
        >
            {{ label }}
        </div>
        <div
            class="absolute flex items-center justify-center w-4 h-4 rounded-full pointer-events-none  top-4 right-4"
            :class="{
                'pulse bg-gray': state != true && state != false,
                'bg-green text-white': state == true,
                'bg-red text-white': state == false,
            }"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="-5 -7 24 24"
                class="w-3 h-3 fill-current"
                v-if="state == true"
            >
                <path
                    d="M5.486 9.73a.997.997 0 0 1-.707-.292L.537 5.195A1 1 0 1 1 1.95 3.78l3.535 3.535L11.85.952a1 1 0 0 1 1.415 1.414L6.193 9.438a.997.997 0 0 1-.707.292z"
                ></path>
            </svg>
            <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="-6 -6 24 24"
                width="24"
                class="w-3 h-3 fill-current"
                v-if="state == false"
            >
                <path
                    d="M7.314 5.9l3.535-3.536A1 1 0 1 0 9.435.95L5.899 4.485 2.364.95A1 1 0 1 0 .95 2.364l3.535 3.535L.95 9.435a1 1 0 1 0 1.414 1.414l3.535-3.535 3.536 3.535a1 1 0 1 0 1.414-1.414L7.314 5.899z"
                ></path>
            </svg>
        </div>
    </div>
</template>

<script setup lang="ts">
import { defineEmits, ref, computed, useAttrs } from 'vue';

const props = defineProps({
    modelValue: {
        type: [String, Number],
        default: null,
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
const focus = ref(false);

const emit = defineEmits(['update:modelValue']);

const isEmpty = computed(() => {
    return model.value == null || model.value == '';
});

const updateInput = event => {
    emit('update:modelValue', event.target.value);
};
</script>

<style>
@keyframes pulse {
    from {
        transform: scale(1);
        opacity: 1;
    }
    to {
        transform: scale(1.5);
        opacity: 0.2;
    }
}
.pulse {
    animation: pulse 1s linear infinite;
}
</style>
