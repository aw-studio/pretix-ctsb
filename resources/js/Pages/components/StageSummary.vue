<template>
    <h2 class="py-4 text-lg font-bold text-center">
        Kostenloser Bürgertest nach TESTVO
    </h2>
    <Boolean v-model="getAttr('consent').answer" label="Zustimmen">
        Mit dem Absenden bestätige ich, dass die für die Durchführung eines
        kostenfreien Antigen-Schnelltests auf der Grundlage der Testverordnung
        (TestVO) des Bundesministeriums für Gesundheit eingehalten werden. Ich
        möchte mein Ergebnis per E-Mail erhalten.
    </Boolean>
    <Button
        @click="form.post('/orders')"
        class="w-full px-4 py-1 mt-6 text-white"
        green
        :disabled="getAttr('consent').answer == 'False'"
        :class="{
            'bg-opacity-50 pointer-events-none':
                getAttr('consent').answer == 'False',
        }"
    >
        Senden
        <svg
            xmlns="http://www.w3.org/2000/svg"
            xmlns:xlink="http://www.w3.org/1999/xlink"
            class="w-6 h-6 ml-4 fill-current -mr-1-6 rotate"
            :class="{
                'opacity-0': !form.processing,
            }"
            viewBox="0 0 100 100"
        >
            <circle
                cx="50"
                cy="50"
                fill="none"
                stroke="#fff"
                stroke-width="10"
                r="35"
                stroke-dasharray="164.93361431346415 56.97787143782138"
            ></circle>
        </svg>
    </Button>
</template>

<script setup lang="ts">
import { Boolean, Button } from '@/components';

import { form, getAttr } from '@/modules/booking';
</script>
