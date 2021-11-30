<template>
    <div>
        <h1>Foo</h1>
        <button @click="form.post('/orders')">Senden</button>
        <pre>{{ form }}</pre>
    </div>
</template>

<script setup lang="ts">
import { form } from '@/modules/booking';
</script>
