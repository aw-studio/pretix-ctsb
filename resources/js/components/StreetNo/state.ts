import { ref, computed, watch } from 'vue';
import { getAttr } from '@/modules/booking';

export const street = ref(null);
export const number = ref(null);

const streetNo = computed(() => {
    if (street.value && number.value) {
        return `${street.value} ${number.value}`;
    }
});

watch(
    () => streetNo.value,
    value => {
        getAttr('street-no').answer = value;
    }
);