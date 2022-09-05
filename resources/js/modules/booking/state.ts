import { ref, computed, watch } from 'vue';
import { getAttr } from '@/modules/booking';

export const zip = ref(null);
export const city = ref(null);

export const zipCity = computed(() => {
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

export const year = ref(null);
export const month = ref(null);
export const day = ref(null);

export const date = computed(() => {
    if (year.value?.toString().length < 4) {
        return;
    }
    if (month.value?.toString().length < 2) {
        return;
    }
    if (day.value?.toString().length < 2) {
        return;
    }

    if (year.value && month.value && day.value) {
        return `${year.value}-${month.value}-${day.value}`;
    }
});

watch(
    () => date.value,
    value => {
        getAttr('birthdate').answer = value;
    }
);
