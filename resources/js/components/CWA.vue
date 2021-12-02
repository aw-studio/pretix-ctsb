<template>
    <Boolean v-model="coronaApp" label="QR-Code für Corona-Warn-App">
        <p>
            Hiermit erkläre ich mein Einverständnis zum Übermitteln des
            Testergebnisses und meines pseudonymen Codes an das Serversystem des
            RKI, damit ich mein Testergebnis mit der Corona-Warn-App abrufen
            kann:
        </p>
        <template v-slot:after>
            <div class="pl-6 mt-6">
                <h3 class="font-bold">Bitte auswählen</h3>
                <div class="p-2 mt-4 bg-blue-600 bg-opacity-50 rounded-sm">
                    <button
                        class="flex items-center justify-center px-2 py-2  rounded-xs"
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
                        <div class="w-full pl-4 text-left">
                            <h3 class="pb-2 font-bold">
                                Einwilligung zur NAMENTLICHEN Übermittlung der
                                Daten an die Corona-Warn-App:
                            </h3>
                            Ich willige außerdem in die Übermittlung meines
                            Namens und Geburtsdatums an die App ein, damit mein
                            Testergebnis in der App als namentlicher
                            Testnachweis angezeigt werden kann.
                        </div>
                    </button>
                </div>
                <div class="p-2 mt-4 bg-blue-600 bg-opacity-50 rounded-sm">
                    <button
                        class="flex items-center justify-center px-2 py-2  rounded-xs"
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
                        <div class="w-full pl-4 text-left">
                            <h3 class="pb-2 font-bold">
                                Einwilligung zur NICHT-NAMENTLICHEN Übermittlung
                                der Daten an die Corona-Warn-App:
                            </h3>
                            Das Testergebnis in der App kann hierbei nicht als
                            namentlicher Testnachweis verwendet werden.
                        </div>
                    </button>
                </div>
            </div>
            <div class="pt-4">
                Mir wurden
                <a
                    href="https://pretix.eu/redirect/?url=https%3A//pretix.eu/ctsb/%3AxF1lYuL7-kQhdZk84hrt4u-4F90kJiSkPGEBNo2U2pQ"
                    class="underline"
                    >Hinweise zum Datenschutz</a
                >
                ausgehändigt.
            </div>
        </template>
    </Boolean>
</template>

<script setup lang="ts">
import { watch, ref } from 'vue';
import { Boolean } from '@/components';

import { getAttr } from '@/modules/booking';

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
