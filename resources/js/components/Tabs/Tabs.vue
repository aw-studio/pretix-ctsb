<template>
    <div class="h-20">
        <button
            v-if="state.selectedIndex > 0"
            @click="selectTab(state.selectedIndex - 1)"
        >
            zurück
        </button>
        <div v-if="state.selectedIndex">{{ state.selectedIndex + 1 }} / 3</div>
    </div>
    <div ref="childs">
        <Intro v-if="state.selectedIndex == 0" />
        <div
            class="overflow-y-scroll bg-white shadow rounded-t-md"
            id="content"
        >
            <div class="flex flex-col justify-between h-full px-4 py-6">
                <slot />
                <div v-if="showArrows(state.selectedIndex)">
                    <Button
                        v-if="state.selectedIndex < state.tabs.length - 1"
                        @click="selectTab(state.selectedIndex + 1)"
                        :disabled="!canGoNext(state.selectedIndex)"
                        orange
                        class="w-full mt-4"
                        :class="{
                            'bg-opacity-20': !canGoNext(state.selectedIndex),
                        }"
                    >
                        Weiter
                    </Button>
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
} from 'vue';

import { StateInterface } from './state.interface';
import Button from '@/components/Button.vue';
import Intro from '@/Pages/components/Intro.vue';

const slots = useSlots();

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
});
</script>

<style>
#content {
    max-height: calc(100vh - 80px);
}
</style>
