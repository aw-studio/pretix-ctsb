<template>
    <div>
        <form class="flex flex-col h-screen" @submit.prevent>
            <input type="file" ref="fileInput" @change="onFilePicked" />
            <button @click="submit">sdfdsf</button>
            <div class="bg-red">
                {{ form.file }}
            </div>
        </form>
    </div>
</template>

<script setup lang="ts">
import { reactive } from 'vue';
import { Inertia } from '@inertiajs/inertia';

const props = defineProps({
    token: String,
});

const form = reactive({
    file: null,
});

const submit = () => {
    Inertia.post(`/import/${props.token}`, form);
};

const onFilePicked = event => {
    const files = event.target.files;
    form.file = files[0];
};
</script>
