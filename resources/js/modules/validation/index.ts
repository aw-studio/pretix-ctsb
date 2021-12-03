import { computed } from "vue";
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
        return form.email?.toLowerCase() == form.email_confirmation?.toLowerCase();
    }
    return true
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

    if(containsDigits(attribute)){
        return false;
    }

    if (attribute?.length >= 2) {
        return true;
    }
});

export const familyNameState = computed(() => {
    if (form.errors['positions.0.attendee_name_parts.family_name']) {
        return false;
    }

    let attribute = form.positions[0].attendee_name_parts.family_name;

    if(containsDigits(attribute)){
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
    if(street?.length < 1 || street == null || street == '') {
        return null;
    }
    
    // ... it contains a digit
    if(!containsDigits(street)){
        return false;
    }
    // ... it contains a number
    if(!containsLetter(street)){
        return false;
    }
    
    // ... it is at least 5 chars long (e.g. "Tal 1")
    if (street?.length < 5) {
        return false;
    }

    return true;
});


export const zipState = (zip) => {
    if (zip == null) {
        return;
    }
    return zip.toString().length >= 3;
};
export const cityState =(city) => {
    if (city == null) {
        return;
    }
    
    return city.toString().length >= 2;
};


export const phoneState = computed(() => {
    if (getAttr('phone').answer == null || getAttr('phone').answer == '') {
        return;
    }

    // attribute is valid when...
    let attribute = getAttr('phone').answer;

    // ... has at least 7 digits
    if(attribute?.toString().match(/[0-9]{7,}/g) == null){
        return false
    } 
    // ... has no letters
    if(containsLetter(attribute)){
        return false
    } 

    return true
});

/**
 * The form stage is valid
 */
export const stageFormValid = computed(()=>{

});

export const hasAtLeastNDigits = (val: any, digits: number ) => {
    let rule = `[0-9]{${digits},}`
    let regex = new RegExp(rule,"g");
    return val?.toString().match(regex) != null
       
}

export const containsDigits = (val: any) => {
    let matches = val?.toString().match(/\d+/g);
    return matches != null;
}

export const containsLetter = (val: any) => {
    let matches = val?.toString().match(/[a-zA-ZßöäüÖÄÜ]+/g);
    return matches != null;
}
