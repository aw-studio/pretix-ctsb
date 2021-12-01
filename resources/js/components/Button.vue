<template>
    <button
        class="inline-flex items-center justify-center h-12 px-4 text-sm font-medium tracking-wider text-white transition-transform duration-75 transform rounded-sm "
        :class="{
            'bg-orange': orange,
            'bg-green': green,
        }"
    >
        <slot />
    </button>
</template>

<script setup lang="ts">
defineProps({
    orange: {
        type: Boolean,
        defaul: false,
    },
    green: {
        type: Boolean,
        defaul: false,
    },
});
</script>
