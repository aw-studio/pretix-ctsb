<template>
    <Select
        v-if="getAttr('buergertest-grund')"
        v-model="model"
        :options="(options as any[])"
    />
</template>

<script setup lang="ts">
import { getAttr } from '@/modules/booking';
import { usePage } from '@inertiajs/inertia-vue3';
import { computed, ref, watch } from 'vue';
import Select from './Select.vue';
import { useI18n } from 'vue-i18n';

const eligibility: any = computed(() => {
    return usePage().props.value.eligibility || [];
});

const { locale } = useI18n({ useScope: 'global' });

const options = computed(() => {
    return eligibility.value.options?.map(option => {
        console.log(locale);

        return {
            value: option.id,
            label:
                option.answer[locale.value as any] ||
                option.answer['de'] ||
                option.answer['en'],
        };
    });
});

const model = ref();

watch(
    // watch id of answer
    () => model.value,
    id => {
        if (id) {
            let option = eligibility.value.options.find(item => item.id == id);

            getAttr('buergertest-grund').answer =
                option.answer[locale.value as any] ||
                option.answer['de'] ||
                option.answer['en'];
            getAttr('buergertest-grund').options = [id];
            getAttr('buergertest-grund').option_identifiers = [
                option.identifier,
            ];
        }
    }
);
</script>
