<template>
    <div>
        <Text
            v-model="form.email"
            placeholder="Email"
            :errors="form.errors.email"
        />
        <Text
            v-model="form.email_confirmation"
            placeholder="Email bestätigen"
            :errors="form.errors.email_confirmation"
        />
        <Text
            v-model="form.positions[0].attendee_name_parts.given_name"
            placeholder="Vorname"
            :errors="form.errors['positions.0.attendee_name_parts.given_name']"
        />
        <Text
            v-model="form.positions[0].attendee_name_parts.family_name"
            placeholder="Nachname"
            :errors="form.errors['positions.0.attendee_name_parts.family_name']"
        />

        <Stage v-for="stage in stages" :stage="stage" />
    </div>
    <button @click="form.post('/orders')" class="px-4 py-1 text-white bg-blue">
        Senden
    </button>
    <pre class="p-4 mt-4 text-xs bg-black text-green">{{ form }}</pre>
</template>

<script setup lang="ts">
import { PropType, watch, computed, onBeforeMount } from 'vue';
import { form, initForm, TInitFormConfig } from '@/modules/booking';
import Stage from '@/components/Stage.vue';
import Text from '@/components/Text.vue';

const props = defineProps({
    config: {
        type: Object as PropType<TInitFormConfig>,
        required: true,
    },
});

watch(
    () => form.email,
    email => {
        form.positions[0].attendee_email = email;
    }
);

const stages = computed(() => {
    return props.config.questions;
});

onBeforeMount(() => {
    initForm(props.config);
});
</script>
