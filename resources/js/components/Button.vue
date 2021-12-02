<template>
    <component
        :is="as"
        :href="href"
        target="_blank"
        class="inline-flex items-center justify-center h-12 px-4 text-sm font-medium tracking-wider text-white transition-transform duration-75 transform rounded-sm "
        :class="{
            'bg-gray': disabled,
            'bg-orange': orange && !disabled,
            'bg-green': green && !disabled,
        }"
    >
        <slot />
    </component>
</template>

<script setup lang="ts">
import { computed } from 'vue';

const props = defineProps({
    orange: {
        type: Boolean,
        defaul: false,
    },
    green: {
        type: Boolean,
        defaul: false,
    },
    disabled: {
        type: Boolean,
        defaul: false,
    },
    href: {
        type: String,
        default: null,
    },
});

const as = computed(() => {
    return props.href == null ? 'button' : 'a';
});
</script>
