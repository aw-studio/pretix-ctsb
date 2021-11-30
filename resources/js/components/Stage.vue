<template>
    <Question v-for="question in stage" :question="question" />
</template>

<script setup lang="ts">
import { PropType } from 'vue';
import { TQuestionConfig } from '@/modules/booking';
import Question from './Question.vue';

const props = defineProps({
    stage: {
        type: Array as PropType<TQuestionConfig[]>,
        required: true,
    },
});
</script>
