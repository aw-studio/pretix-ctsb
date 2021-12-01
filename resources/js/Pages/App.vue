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

                <Text
                    v-model="getAttr('street-no').answer"
                    class="w-full"
                    placeholder="Straße + Hausnummer"
                />
                <Text
                    v-model="getAttr('zip-city').answer"
                    class="w-full"
                    placeholder="PLZ + Ort"
                />
                <!-- TODO: Land -->

                <h3 class="pt-6 text-sm font-semibold">Geburtstag</h3>
                <Date v-model="getAttr('birthdate').answer" />

                <h3 class="pt-8 text-sm font-semibold text">Optional</h3>

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
                        </div>
                    </template>
                </Boolean>
            </Tab>
            <Tab title="3/3" :enabled="formFinished" :hideArrows="true">
                <button
                    @click="form.post('/orders')"
                    class="px-4 py-1 text-white bg-blue"
                >
                    Senden
                </button>
            </Tab>
        </Tabs>
    </div>
</template>

<script setup lang="ts">
import { PropType, watch, computed, onBeforeMount, ref } from 'vue';
import { form, initForm, TInitFormConfig, TAnswer } from '@/modules/booking';

import { Text, Tabs, Tab, Date, Boolean } from '@/components';

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

const coronaApp = ref(false);

const questions = computed(() => {
    return props.config.questions;
});

const emailValid = computed(() => {
    return true;
    if (!validateEmail(form.email)) {
        return false;
    }
    return form.email == form.email_confirmation;
});

const formFinished = computed(() => {
    return true;
});

const validateEmail = email => {
    return String(email)
        .toLowerCase()
        .match(
            /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
        );
};

onBeforeMount(() => {
    initForm(props.config);
});
</script>
