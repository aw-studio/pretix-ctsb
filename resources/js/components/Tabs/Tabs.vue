<template>
    <div
        class="sticky top-0 flex items-center justify-between px-4 py-5 text-sm text-white"
    >
        <button
            v-if="state.selectedIndex > 0"
            @click="selectTab(state.selectedIndex - 1)"
            class="flex items-center"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                height="24px"
                viewBox="0 0 24 24"
                class="w-5 h-5 mr-2 fill-current"
            >
                <path d="M0 0h24v24H0V0z" fill="none" />
                <path
                    d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"
                />
            </svg>
            {{ t('app.buttons.back') }}
        </button>
        <div
            v-if="state.selectedIndex"
            class="text-xs tracking-widest uppercase"
        >
            {{ t('app.labels.step') }} {{ state.selectedIndex + 1 }}/3
        </div>
    </div>
    <div ref="childs" class="z-10">
        <div v-if="state.selectedIndex == 0">
            <div
                class="flex items-center justify-between px-4 mb-4 -mt-4 text-sm text-white"
            >
                <div>
                    <div
                        class="text-white fill-current"
                        :style="`background-image: url('${logo}'); width: 120px; height: 74px; background-size: contain; background-repeat: no-repeat;`"
                        v-if="logo"
                    ></div>
                </div>
                <div class="flex space-x-2">
                    <button
                        @click="locale = 'en'"
                        class="w-12 h-12 font-thin border border-white rounded-full"
                        :class="{
                            'opacity-50': locale != 'en',
                            'bg-white text-blue-600 font-bold': locale == 'en',
                        }"
                    >
                        EN
                    </button>
                    <button
                        @click="locale = 'de'"
                        class="w-12 h-12 font-thin border border-white rounded-full"
                        :class="{
                            'opacity-50': locale != 'de',
                            'bg-white text-blue-600 font-bold': locale == 'de',
                        }"
                    >
                        DE
                    </button>
                </div>
            </div>
            <Intro />
        </div>
        <div class="bg-white shadow-top rounded-t-md">
            <div class="flex flex-col justify-between h-full px-4 py-6">
                <slot />
                <div v-if="showArrows(state.selectedIndex)" class="pt-6">
                    <Button
                        v-if="state.selectedIndex < state.tabs.length - 1"
                        @click="selectTab(state.selectedIndex + 1)"
                        :disabled="!canGoNext(state.selectedIndex)"
                        orange
                        class="w-full mt-4"
                        :class="{
                            'bg-opacity-50': !canGoNext(state.selectedIndex),
                        }"
                    >
                        {{ t('app.buttons.next') }}
                    </Button>
                    <p
                        class="pt-2 text-xs text-center text-gray"
                        v-if="!canGoNext(state.selectedIndex)"
                    >
                        {{ t('app.lines.fill-all-inputs') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="flex-1 bg-white"></div>
</template>

<script setup lang="ts">
import {
    onBeforeMount,
    onMounted,
    onBeforeUpdate,
    provide,
    reactive,
    useSlots,
    computed,
} from 'vue';

import { StateInterface } from './state.interface';
import Button from '@/components/Button.vue';
import Intro from '@/Pages/components/Intro.vue';
import { t } from '@/modules/i18n';
import { useI18n } from 'vue-i18n';
import { usePage } from '@inertiajs/inertia-vue3';

const browserLocale = computed(() => {
    return usePage().props.value.locale;
});

const { locale } = useI18n({ useScope: 'global' });

const slots = useSlots();

defineProps({
    logo: {
        type: String,
        default: null,
    },
});

const state = reactive<StateInterface>({
    selectedIndex: 0,
    tabs: [],
    count: 0,
});

provide('TabsProvider', state);

const selectTab = (i: number) => {
    if (!state.tabs[i].props.enabled) {
        return;
    }

    state.selectedIndex = i;
};

const canGoNext = (selectedIndex: number) => {
    if (selectedIndex < 0) {
        selectedIndex = 0;
    }

    if (!state.tabs[selectedIndex + 1].props.enabled) {
        return false;
    }
    return true;
};

const showArrows = (i: number) => {
    if (!state.tabs[i].props.hideArrows) {
        return true;
    }

    return false;
};

const update = () => {
    if (slots.default) {
        state.tabs = slots
            .default()
            .filter((child: any) => child.type.name === 'Tab');
    }
};

onBeforeMount(() => update());
onBeforeUpdate(() => update());

onMounted(() => {
    selectTab(0);
    locale.value = browserLocale.value;
});
</script>
