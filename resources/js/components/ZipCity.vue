<template>
    <div class="grid grid-cols-3 gap-3">
        <Text
            placeholder="PLZ"
            v-model="zip"
            type="text"
            inputmode="decimal"
            pattern="[0-9]*"
        />
        <Text placeholder="Ort" v-model="city" type="text" class="col-span-2" />
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

const zip = ref(null);
const city = ref(null);

const emit = defineEmits(['update:modelValue']);

const zipCity = computed(() => {
    if (zip.value && city.value) {
        return `${zip.value} ${city.value}`;
    }
});

watch(
    () => zipCity.value,
    value => {
        emit('update:modelValue', value);
    }
);
</script>
