<template>
    <h2 class="py-4 text-lg font-bold text-center">
        {{ t('app.lines.personal-data') }}
    </h2>
    <GivenName />
    <FamilyName />
    <StreetNo />
    <ZipCity />
    <Phone />
    <!-- TODO: Land -->

    <h3 class="pt-6 text-sm font-semibold">{{ t('app.lines.birthday') }}</h3>
    <Date />

    <template v-if="getAttr('buergertest-grund')">
        <h3 class="pt-6 text-sm font-semibold">
            {{ t('app.lines.eligibility') }}
        </h3>
        <Eligibility />
    </template>

    <h3 class="pt-8 text-sm font-semibold text">
        {{ t('app.lines.optional') }}
    </h3>

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
    Eligibility,
} from '@/components';

import { t } from '@/modules/i18n';
import { getAttr } from '@/modules/booking';
</script>
