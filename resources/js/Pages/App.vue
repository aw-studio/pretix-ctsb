<template>
    <form class="flex flex-col h-screen" autocomplete="on" @submit.prevent>
        <Tabs>
            <Tab title="1/3" :enabled="true">
                <StageEmail />
            </Tab>
            <Tab title="2/3" :enabled="emailValid">
                <StageForm />
            </Tab>
            <Tab title="3/3" :enabled="formFinished" :hideArrows="true">
                <StageSummary :event="event" />
            </Tab>
        </Tabs>
    </form>
</template>

<script setup lang="ts">
import { PropType, watch, computed, onBeforeMount } from 'vue';
import {
    form,
    initForm,
    TInitFormConfig,
    TAnswer,
    validateEmail,
} from '@/modules/booking';

import { Tabs, Tab } from '@/components';
import StageEmail from './components/StageEmail.vue';
import StageForm from './components/StageForm.vue';
import StageSummary from './components/StageSummary.vue';

const props = defineProps({
    config: {
        type: Object as PropType<TInitFormConfig>,
        required: true,
    },
    event: {
        type: String,
        required: true,
    },
});

watch(
    () => form.email,
    email => {
        form.positions[0].attendee_email = email;
    }
);

const getAttr = (key: string) => {
    let question = questions.value.find(
        question => question.question_identifier == key
    );
    return form.positions[0].answers.find(
        (answer: TAnswer) => answer.question == question.question
    );
};

const questions = computed(() => {
    return props.config.questions;
});

const formFinished = computed(() => {
    if (form.positions[0].attendee_name_parts.given_name?.length < 2) {
        return false;
    }
    if (form.positions[0].attendee_name_parts.family_name?.length < 2) {
        return false;
    }
    if (getAttr('phone').answer == null) {
        return false;
    }
    if (getAttr('street-no').answer == null) {
        return false;
    }
    if (getAttr('zip-city').answer == null) {
        return false;
    }
    if (getAttr('birthdate').answer == null) {
        return false;
    }

    return true;
});

const emailValid = computed(() => {
    if (!validateEmail(form.email)) {
        return false;
    }
    return form.email?.toLowerCase() == form.email_confirmation?.toLowerCase();
});

onBeforeMount(() => {
    initForm(props.config);
});
</script>

<style>
@keyframes rotating {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
}
.rotate {
    animation: rotating 0.7s linear infinite;
}
</style>
