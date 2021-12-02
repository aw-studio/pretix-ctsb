<template>
    <h2 class="py-4 text-lg font-bold text-center">
        Deine persönlichen Angaben
    </h2>
    <GivenName />
    <FamilyName />

    <StreetNo />
    <ZipCity />
    <Text
        v-model="getAttr('phone').answer"
        placeholder="Handynummer"
        class="w-full"
    />
    <!-- TODO: Land -->

    <h3 class="pt-6 text-sm font-semibold">Geburtstag</h3>
    <Date v-model="getAttr('birthdate').answer" />

    <h3 class="pt-8 text-sm font-semibold text">Optional</h3>

    <Pass />
    <CWA />
</template>

<script setup lang="ts">
import { Text, StreetNo, ZipCity, Date } from '@/components';

import { form, getAttr } from '@/modules/booking';
import { Pass, CWA, GivenName, FamilyName } from '@/components';
</script>
