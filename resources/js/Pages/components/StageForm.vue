<template>
    <h2 class="py-4 text-lg font-bold text-center">
        Deine persönlichen Angaben
    </h2>
    <GivenName />
    <FamilyName />
    <StreetNo />
    <ZipCity />
    <Phone />
    <!-- TODO: Land -->

    <h3 class="pt-6 text-sm font-semibold">Geburtstag</h3>
    <Date />

    <h3 class="pt-8 text-sm font-semibold text">Optional</h3>

    <Pass />
    <CWA />
</template>

<script setup lang="ts">
import {
    StreetNo,
    ZipCity,
    Date,
    Pass,
    CWA,
    GivenName,
    FamilyName,
    Phone,
} from '@/components';
</script>
