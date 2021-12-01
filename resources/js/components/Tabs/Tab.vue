<template>
    <div class="space-y-3 tab" v-if="isActive">
        <slot></slot>
    </div>
</template>

<script lang="ts">
import { defineComponent, onBeforeMount, ref, inject, watch } from 'vue';
import { StateInterface } from './state.interface';

export default defineComponent({
    name: 'Tab',
    props: {
        enabled: {
            type: Boolean,
            default: true,
        },
    },
    setup(props) {
        const index = ref(0);
        const isActive = ref(false);

        const tabs = inject('TabsProvider') as StateInterface;

        watch(
            () => tabs.selectedIndex,
            () => {
                isActive.value = index.value === tabs.selectedIndex;
            }
        );

        onBeforeMount(() => {
            index.value = tabs.count;
            tabs.count++;
            isActive.value = index.value === tabs.selectedIndex;
        });
        return { index, isActive };
    },
});
</script>
