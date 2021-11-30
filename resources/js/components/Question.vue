<template>
    <div class="p-4 border">
        <component
            :is="as"
            v-model="model.answer"
            :placeholder="question.question_identifier"
            :errors="form.errors[`positions.0.answers.${index}.answer`]"
        />
    </div>
</template>

<script setup lang="ts">
import { PropType, computed } from 'vue';
import { form, TQuestionConfig, TAnswer } from '@/modules/booking';
import Text from './Text.vue';
import Boolean from './Boolean.vue';
import Date from './Date.vue';

const props = defineProps({
    question: {
        type: Object as PropType<TQuestionConfig>,
        required: true,
    },
    index: {
        type: Number,
        required: true,
    },
});

const model = computed(() => {
    return form.positions[0].answers.find(
        (answer: TAnswer) => answer.question == props.question.question
    );
});

const as = computed(() => {
    return {
        Text,
        Boolean,
        Date,
    }[props.question.type];
});
</script>
