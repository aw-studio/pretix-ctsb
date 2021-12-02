<template>
    <div class="grid grid-cols-3 gap-3">
        <Text
            placeholder="PLZ"
            v-model="zip"
            type="text"
            inputmode="decimal"
            pattern="[0-9]*"
        />
        <Text placeholder="Ort" v-model="city" type="text" class="col-span-2" />
    </div>
</template>

<script setup lang="ts">
import { Text } from '@/components';
import { zip, city } from './state';
</script>
