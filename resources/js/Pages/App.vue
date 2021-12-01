<template>
    <div class="flex flex-col h-screen">
        <Tabs>
            <Tab title="1/3" :enabled="true">
                <Text
                    v-model="form.email"
                    placeholder="E-Mail"
                    :errors="form.errors.email"
                    class="w-full"
                />
                <Text
                    v-model="form.email_confirmation"
                    placeholder="E-Mail wiederholen"
                    :errors="form.errors.email_confirmation"
                    class="w-full"
                />
                <p class="py-2">
                    <strong>Achtung:</strong> Das Ergebnis wird ausschließlich
                    an diese E-Mail-Adresse gesendet.
                </p>
            </Tab>
            <Tab title="2/3" :enabled="emailValid">
                <h2 class="py-4 text-lg font-bold text-center">
                    Deine persönlichen Angaben
                </h2>
                <Text
                    v-model="form.positions[0].attendee_name_parts.given_name"
                    placeholder="Vorname"
                    class="w-full"
                    :errors="
                        form.errors[
                            'positions.0.attendee_name_parts.given_name'
                        ]
                    "
                />
                <Text
                    v-model="form.positions[0].attendee_name_parts.family_name"
                    placeholder="Nachname"
                    class="w-full"
                    :errors="
                        form.errors[
                            'positions.0.attendee_name_parts.family_name'
                        ]
                    "
                />

                <StreetNo
                    v-model="getAttr('street-no').answer"
                    class="w-full"
                />
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
                    Zur Akzeptanz für Flugreisen muss ggf. die Ausweis oder
                    Passnummer hinterlegt werden.
                    <template v-slot:after>
                        <Text
                            v-model="getAttr('pass-id').answer"
                            placeholder="Ausweis- oder Passnummer"
                            class="w-full mt-6"
                        />
                    </template>
                </Boolean>
                <Boolean v-model="coronaApp" label="Corona Warn App">
                    Wir können dir Optional einen QR-Code zur Verfügung stellen,
                    mit dem du dein Testergebnis in die Corona-Warn-App
                    übertragen kannst.
                    <template v-slot:after>
                        <div class="mt-4">
                            <h3 class="pt-6 pb-2 text-sm font-semibold text">
                                Zustimmung zur Übermittlung des Ergebnisses an
                                die Corona-Warn-App.
                            </h3>
                            Für die Übertragung deines Ergebnisses als QR-Code
                            in die Corona-Warn-App kannst du Auswählen ob wir
                            das Ergebnis mit deinem Namen oder ohne deinen Namen
                            übermitteln sollen.
                            <div
                                class="flex w-full p-1 mt-4 space-x-1 bg-blue-500 bg-opacity-25 rounded-sm  text-blue"
                            >
                                <button
                                    class="flex items-center justify-center w-1/2 px-2 py-2 text-white bg-blue-600  rounded-xs"
                                    :class="{
                                        'bg-opacity-20':
                                            getAttr('consent-cwa-name')
                                                .answer == 'False',
                                    }"
                                    @click="toggleCwa('consent-cwa-name')"
                                >
                                    <div
                                        class="w-4 h-4 bg-white rounded-full  bg-opacity-20"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="-5 -7 24 24"
                                            class="w-4 h-4 fill-current"
                                            :class="{
                                                'opacity-0':
                                                    getAttr('consent-cwa-name')
                                                        .answer == 'False',
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
                                    class="flex items-center justify-center w-1/2 px-2 py-2 text-white bg-blue-600  rounded-xs"
                                    :class="{
                                        'bg-opacity-20':
                                            getAttr('consent-cwa-pseudo')
                                                .answer == 'False',
                                    }"
                                    @click="toggleCwa('consent-cwa-pseudo')"
                                >
                                    <div
                                        class="w-4 h-4 bg-white rounded-full  bg-opacity-20"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="-5 -7 24 24"
                                            class="w-4 h-4 fill-current"
                                            :class="{
                                                'opacity-0':
                                                    getAttr(
                                                        'consent-cwa-pseudo'
                                                    ).answer == 'False',
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
            </Tab>
            <Tab title="3/3" :enabled="formFinished" :hideArrows="true">
                <h2 class="py-4 text-lg font-bold text-center">
                    Kostenloser Bürgertest nach TESTVO
                </h2>
                <Boolean v-model="getAttr('consent').answer" label="Zustimmen">
                    Mit dem Absenden bestätige ich, dass die für die
                    Durchführung eines kostenfreien Antigen-Schnelltests auf der
                    Grundlage der Testverordnung (TestVO) des Bundesministeriums
                    für Gesundheit eingehalten werden. Ich möchte mein Ergebnis
                    per E-Mail erhalten.
                </Boolean>
                <Button
                    @click="form.post('/orders')"
                    class="w-full px-4 py-1 mt-6 text-white bg-green"
                    :class="{
                        'bg-opacity-20 pointer-events-none':
                            getAttr('consent').answer == 'False',
                    }"
                >
                    Senden
                </Button>
            </Tab>
        </Tabs>
    </div>
</template>

<script setup lang="ts">
import { PropType, watch, computed, onBeforeMount, ref } from 'vue';
import { form, initForm, TInitFormConfig, TAnswer } from '@/modules/booking';

import {
    Button,
    Text,
    Tabs,
    Tab,
    Date,
    Boolean,
    StreetNo,
    ZipCity,
} from '@/components';

const props = defineProps({
    config: {
        type: Object as PropType<TInitFormConfig>,
        required: true,
    },
});

watch(
    () => form.email,
    email => {
        form.positions[0].attendee_email = email;
    }
);

const getAttr = (key: string) => {
    let question = questions.value.find(
        question => question.question_identifier == key
    );
    return form.positions[0].answers.find(
        (answer: TAnswer) => answer.question == question.question
    );
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

const questions = computed(() => {
    return props.config.questions;
});

const emailValid = computed(() => {
    // TODO: remove
    return true;
    if (!validateEmail(form.email)) {
        return false;
    }
    return form.email == form.email_confirmation;
});

const formFinished = computed(() => {
    if (form.positions[0].attendee_name_parts.given_name?.length < 2) {
        return false;
    }
    if (form.positions[0].attendee_name_parts.family_name?.length < 2) {
        return false;
    }
    if (getAttr('street-no').answer == null) {
        return false;
    }
    if (getAttr('zip-city').answer == null) {
        return false;
    }
    if (getAttr('birthdate').answer == null) {
        return false;
    }

    return true;
});

const validateEmail = email => {
    return String(email)
        .toLowerCase()
        .match(
            /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
        );
};

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

onBeforeMount(() => {
    initForm(props.config);
});
</script>
