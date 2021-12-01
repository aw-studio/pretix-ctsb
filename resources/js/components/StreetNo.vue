<template>
    <div class="grid grid-cols-3 gap-3">
        <Text
            placeholder="Straße"
            v-model="street"
            type="text"
            class="col-span-2"
        />
        <Text placeholder="Nr" v-model="number" type="text" />
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
    type: {
        type: String,
        default: 'text',
    },
    errors: {
        type: String,
        default: null,
    },
});

const street = ref(null);
const number = ref(null);

const emit = defineEmits(['update:modelValue']);

const streetNo = computed(() => {
    if (street.value && number.value) {
        return `${street.value} ${number.value}`;
    }
});

watch(
    () => streetNo.value,
    value => {
        emit('update:modelValue', value);
    }
);
</script>
