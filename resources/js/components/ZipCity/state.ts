import { ref, computed, watch } from 'vue';
import { getAttr } from '@/modules/booking';

export const zip = ref(null);
export const city = ref(null);

const zipCity = computed(() => {
    if (zip.value && city.value) {
        return `${zip.value} ${city.value}`;
    }
});

watch(
    () => zipCity.value,
    value => {
        getAttr('zip-city').answer = value;
    }
);