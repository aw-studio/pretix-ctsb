<template>
    <form class="flex flex-col h-screen" autocomplete="on" @submit.prevent>
        <Tabs>
            <Tab title="1/3" :enabled="true">
                <StageEmail />
            </Tab>
            <Tab title="2/3" :enabled="stageEmailValid">
                <StageForm />
            </Tab>
            <Tab title="3/3" :enabled="stageFormValid" :hideArrows="true">
                <StageSummary :event="event" />
            </Tab>
        </Tabs>
    </form>
</template>

<script setup lang="ts">
import { PropType, onBeforeMount } from 'vue';
import { form, initForm, TInitFormConfig } from '@/modules/booking';

import { stageEmailValid, stageFormValid } from '@/modules/validation';
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

onBeforeMount(() => {
    initForm(props.config);
});
</script>
