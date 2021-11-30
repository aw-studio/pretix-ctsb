<template>
    <div>
        <label> Email </label>
        <input v-model="form.email" class="border" />
        <label> Email bestätigen </label>
        <input v-model="form.email_confirmation" class="border" />
        <Stage v-for="stage in stages" :stage="stage" />
    </div>
    <button @click="form.post('/orders')" class="px-4 py-1 text-white bg-blue">
        Senden
    </button>
    <div class="bg-red">
        {{ qr }}
    </div>
    <!-- <pre>{{ config }}</pre> -->
    <pre class="p-4 mt-4 text-xs bg-black text-green">{{ form }}</pre>
</template>

<script setup lang="ts">
import { PropType, watch, computed, onBeforeMount } from 'vue';
import { form, initForm, TInitFormConfig } from '@/modules/booking';
import Stage from '@/components/Stage.vue';

const props = defineProps({
    config: {
        type: Object as PropType<TInitFormConfig>,
        required: true,
    },
    qr: {
        type: String,
        default: null,
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
