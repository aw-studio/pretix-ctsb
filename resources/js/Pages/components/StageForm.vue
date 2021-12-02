<template>
    <h2 class="py-4 text-lg font-bold text-center">
        Deine persönlichen Angaben
    </h2>
    <Text
        v-model="form.positions[0].attendee_name_parts.given_name"
        placeholder="Vorname"
        class="w-full"
        :errors="form.errors['positions.0.attendee_name_parts.given_name']"
    />
    <Text
        v-model="form.positions[0].attendee_name_parts.family_name"
        placeholder="Nachname"
        class="w-full"
        :errors="form.errors['positions.0.attendee_name_parts.family_name']"
    />

    <StreetNo v-model="getAttr('street-no').answer" class="w-full" />
    <ZipCity v-model="getAttr('zip-city').answer" class="w-full" />
    <Text
        v-model="getAttr('phone').answer"
        placeholder="Handynummer"
        class="w-full"
    />
    <!-- TODO: Land -->

    <h3 class="pt-6 text-sm font-semibold">Geburtstag</h3>
    <Date v-model="getAttr('birthdate').answer" />

    <h3 class="pt-8 text-sm font-semibold text">Optional</h3>

    <Boolean v-model="pass" label="Ausweis-/Passnummer hinterlegen">
        Zur Akzeptanz für Flugreisen muss ggf. die Ausweis oder Passnummer
        hinterlegt werden.
        <template v-slot:after>
            <Text
                v-model="getAttr('pass-id').answer"
                placeholder="Ausweis- oder Passnummer"
                class="w-full mt-6"
            />
        </template>
    </Boolean>
    <Boolean v-model="coronaApp" label="Corona Warn App">
        Wir können dir Optional einen QR-Code zur Verfügung stellen, mit dem du
        dein Testergebnis in die Corona-Warn-App übertragen kannst.
        <template v-slot:after>
            <div class="mt-4">
                <h3 class="pt-6 pb-2 text-sm font-semibold text">
                    Zustimmung zur Übermittlung des Ergebnisses an die
                    Corona-Warn-App.
                </h3>
                Für die Übertragung deines Ergebnisses als QR-Code in die
                Corona-Warn-App kannst du Auswählen ob wir das Ergebnis mit
                deinem Namen oder ohne deinen Namen übermitteln sollen.
                <div
                    class="flex w-full p-1 mt-4 space-x-1 bg-blue-600 bg-opacity-50 rounded-sm  text-blue"
                >
                    <button
                        class="flex items-center justify-center w-1/2 px-2 py-2  rounded-xs"
                        :class="{
                            'text-white opacity-80':
                                getAttr('consent-cwa-name').answer == 'False',
                            'bg-white text-blue-600':
                                getAttr('consent-cwa-name').answer == 'True',
                        }"
                        @click="toggleCwa('consent-cwa-name')"
                    >
                        <div
                            class="w-4 h-4 bg-blue-100 rounded-full  bg-opacity-20"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="-5 -7 24 24"
                                class="w-4 h-4 fill-current"
                                :class="{
                                    'opacity-0':
                                        getAttr('consent-cwa-name').answer ==
                                        'False',
                                }"
                            >
                                <path
                                    d="M5.486 9.73a.997.997 0 0 1-.707-.292L.537 5.195A1 1 0 1 1 1.95 3.78l3.535 3.535L11.85.952a1 1 0 0 1 1.415 1.414L6.193 9.438a.997.997 0 0 1-.707.292z"
                                ></path>
                            </svg>
                        </div>
                        <span class="w-full">MIT Namen</span>
                    </button>
                    <button
                        class="flex items-center justify-center w-1/2 px-2 py-2  rounded-xs"
                        :class="{
                            'text-white opacity-80':
                                getAttr('consent-cwa-pseudo').answer == 'False',
                            'bg-white text-blue-600':
                                getAttr('consent-cwa-pseudo').answer == 'True',
                        }"
                        @click="toggleCwa('consent-cwa-pseudo')"
                    >
                        <div
                            class="w-4 h-4 bg-blue-100 rounded-full  bg-opacity-20"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="-5 -7 24 24"
                                class="w-4 h-4 fill-current"
                                :class="{
                                    'opacity-0':
                                        getAttr('consent-cwa-pseudo').answer ==
                                        'False',
                                }"
                            >
                                <path
                                    d="M5.486 9.73a.997.997 0 0 1-.707-.292L.537 5.195A1 1 0 1 1 1.95 3.78l3.535 3.535L11.85.952a1 1 0 0 1 1.415 1.414L6.193 9.438a.997.997 0 0 1-.707.292z"
                                ></path>
                            </svg>
                        </div>
                        <span class="w-full">OHNE Namen</span>
                    </button>
                </div>
            </div>
        </template>
    </Boolean>
</template>

<script setup lang="ts">
import { watch, ref } from 'vue';
import { Text, Boolean, StreetNo, ZipCity, Date } from '@/components';

import { form, getAttr } from '@/modules/booking';

const toggleCwa = (key: string) => {
    if (
        getAttr('consent-cwa-name').answer == 'False' &&
        getAttr('consent-cwa-pseudo').answer == 'False'
    ) {
        getAttr(key).answer = 'True';
        return;
    }
    getAttr('consent-cwa-pseudo').answer =
        getAttr('consent-cwa-pseudo').answer == 'True' ? 'False' : 'True';
    getAttr('consent-cwa-name').answer =
        getAttr('consent-cwa-name').answer == 'True' ? 'False' : 'True';
};

const pass = ref('False');
const coronaApp = ref('False');
watch(
    () => coronaApp.value,
    value => {
        console.log(value);

        if (value == 'False') {
            getAttr('consent-cwa-name').answer = 'False';
            getAttr('consent-cwa-pseudo').answer = 'False';
        }
    }
);
</script>
