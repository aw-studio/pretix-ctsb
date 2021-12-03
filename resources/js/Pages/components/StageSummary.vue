<template>
    <h2 class="py-4 text-lg font-bold text-center">
        {{ t('app.lines.headline-testvo') }}
    </h2>
    <Boolean
        v-model="getAttr('consent').answer"
        :label="t('app.labels.consent')"
    >
        {{ t('app.lines.consent') }}
    </Boolean>
    <Button
        @click="submit()"
        class="w-full px-4 py-1 mt-6 text-white"
        green
        :disabled="getAttr('consent').answer == 'False'"
        :class="{
            'bg-opacity-50 pointer-events-none':
                getAttr('consent').answer == 'False',
        }"
    >
        {{ t('app.buttons.send') }}
        <svg
            xmlns="http://www.w3.org/2000/svg"
            xmlns:xlink="http://www.w3.org/1999/xlink"
            class="w-6 h-6 ml-4 fill-current -mr-1-6 rotate"
            :class="{
                'opacity-0': !form.processing,
            }"
            viewBox="0 0 100 100"
        >
            <circle
                cx="50"
                cy="50"
                fill="none"
                stroke="#fff"
                stroke-width="10"
                r="35"
                stroke-dasharray="164.93361431346415 56.97787143782138"
            ></circle>
        </svg>
    </Button>
</template>

<script setup lang="ts">
import { Boolean, Button } from '@/components';
import { form, getAttr } from '@/modules/booking';
import { t } from '@/modules/i18n';

const props = defineProps({
    event: {
        type: String,
        required: true,
    },
});

const submit = () => {
    form.transform(data => ({
        ...transformFormdata(data),
    })).post(`/orders/${props.event}`);
};

/**
 * Purge empty pass id
 */
const transformFormdata = data => {
    let passId = data.positions[0].answers.find(
        answer => answer.question_identifier == 'pass-id'
    );

    if (passId.answer == null) {
        console.log('transforming');

        let index = data.positions[0].answers.findIndex(
            answer => answer.question_identifier == 'pass-id'
        );
        data.positions[0].answers.splice(index, 1);
    }

    return { ...data };
};
</script>
