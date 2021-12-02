<template>
    <Boolean v-model="pass" label="Ausweis-/Passnummer hinterlegen">
        Zur Akzeptanz für Flugreisen muss ggf. die Ausweis oder Passnummer
        hinterlegt werden.
        <template v-slot:after>
            <Text
                v-model="getAttr('pass-id').answer"
                label="Ausweis- oder Passnummer"
                class="w-full mt-6"
            />
        </template>
    </Boolean>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import { Text, Boolean } from '@/components';

import { getAttr } from '@/modules/booking';
const pass = ref('False');
</script>
