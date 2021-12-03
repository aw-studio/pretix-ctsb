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
