import { computed, watch, ref } from 'vue';
import { form, getAttr } from '@/modules/booking';

export const validateEmail = email => {
    return String(email)
        .toLowerCase()
        .match(
            /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
        );
};
export const emailConfirmed = computed(() => {
    if (validateEmail(form.email) && validateEmail(form.email_confirmation)) {
        return (
            form.email?.toLowerCase() == form.email_confirmation?.toLowerCase()
        );
    }
    return true;
});
export const emailState = computed(() => {
    if (!emailConfirmed.value) {
        return false;
    }
    if (validateEmail(form.email)) {
        return true;
    }
});
export const emailConfirmationState = computed(() => {
    if (!emailConfirmed.value) {
        return false;
    }
    if (validateEmail(form.email_confirmation)) {
        return true;
    }
});

/**
 * The email stage is valid, if the email address has a valid format and matches
 * the email_confirmation.
 */
export const stageEmailValid = computed(() => {
    if (!validateEmail(form.email)) {
        return false;
    }
    return form.email?.toLowerCase() == form.email_confirmation?.toLowerCase();
});

export const givenNameState = computed(() => {
    if (form.errors['positions.0.attendee_name_parts.given_name']) {
        return false;
    }

    let attribute = form.positions[0].attendee_name_parts.given_name;

    if (attribute == null || attribute == '') {
        return null;
    }

    if (containsDigits(attribute)) {
        return false;
    }

    if (attribute?.length < 2) {
        return null;
    }
    return true;
});
export const familyNameState = computed(() => {
    if (form.errors['positions.0.attendee_name_parts.family_name']) {
        return false;
    }

    let attribute = form.positions[0].attendee_name_parts.family_name;

    if (containsDigits(attribute)) {
        return false;
    }

    if (attribute?.length >= 2) {
        return true;
    }
});
export const streetNoState = computed(() => {
    // the street is valid if
    let street = getAttr('street-no').answer;

    // ... it is not emtpy
    if (street?.length < 1 || street == null || street == '') {
        return null;
    }

    // ... it contains a digit
    if (!containsDigits(street)) {
        return false;
    }
    // ... it contains a number
    if (!containsLetter(street)) {
        return false;
    }

    // ... it is at least 5 chars long (e.g. "Tal 1")
    if (street?.length < 5) {
        return false;
    }

    return true;
});

export const zipState = zip => {
    if (zip == null) {
        return;
    }
    return zip.toString().length >= 3;
};
export const cityState = city => {
    if (city == null) {
        return;
    }

    return city.toString().length >= 2;
};
import { zip, city, zipCity } from '@/modules/booking/state';
export const zipCityState = ref(null);

watch(
    () => zipCity.value,
    value => {
        zipCityState.value = zipState(zip.value) && cityState(city.value);
    }
);

export const phoneState = computed(() => {
    if (getAttr('phone').answer == null || getAttr('phone').answer == '') {
        return;
    }

    // attribute is valid when...
    let attribute = getAttr('phone').answer;

    // ... has at least 7 digits
    if (attribute?.toString().match(/[0-9]{7,}/g) == null) {
        return false;
    }
    // ... has no letters
    if (containsLetter(attribute)) {
        return false;
    }

    return true;
});

const validDayNumbers = [
    '01',
    '02',
    '03',
    '04',
    '05',
    '06',
    '07',
    '08',
    '09',
    '10',
    '11',
    '12',
    '13',
    '14',
    '15',
    '16',
    '17',
    '18',
    '19',
    '20',
    '21',
    '22',
    '23',
    '24',
    '25',
    '26',
    '27',
    '28',
    '29',
    '30',
    '31',
];
const validMonthNumbers = [
    '01',
    '02',
    '03',
    '04',
    '05',
    '06',
    '07',
    '08',
    '09',
    '10',
    '11',
    '12',
];

export const dayState = day => {
    if (day?.toString().length == 2) {
        return validDayNumbers.includes(day) ? true : false;
    }
    if (day?.toString().length > 2 || day?.toString().length == 1) {
        return false;
    }
};
export const monthState = month => {
    if (month?.toString().length == 2) {
        return validMonthNumbers.includes(month) ? true : false;
    }
    if (month?.toString().length > 2 || month?.toString().length == 1) {
        return false;
    }
};
export const yearState = year => {
    if (year?.toString().length == 4) {
        return parseInt(year) > 1900 && parseInt(year) < 2020 ? true : false;
    }
    if (year?.toString().length != 4 && year?.toString().length > 0) {
        return false;
    }
};

import { day, month, year, date } from '@/modules/booking/state';
export const birthdateState = ref(null);

watch(
    () => date.value,
    value => {
        birthdateState.value =
            dayState(day.value) &&
            monthState(month.value) &&
            yearState(year.value);
    }
);

/**
 * The form stage is valid
 */
export const stageFormValid = computed(() => {
    return (
        givenNameState.value &&
        familyNameState.value &&
        streetNoState.value &&
        phoneState.value &&
        zipCityState.value &&
        birthdateState.value &&
        (getAttr('buergertest-grund')
            ? getAttr('buergertest-grund').answer != null
            : true)
    );
});

export const hasAtLeastNDigits = (val: any, digits: number) => {
    let rule = `[0-9]{${digits},}`;
    let regex = new RegExp(rule, 'g');
    return val?.toString().match(regex) != null;
};

export const containsDigits = (val: any) => {
    let matches = val?.toString().match(/\d+/g);
    return matches != null;
};

export const containsLetter = (val: any) => {
    let matches = val?.toString().match(/[a-zA-ZßöäüÖÄÜ]+/g);
    return matches != null;
};
