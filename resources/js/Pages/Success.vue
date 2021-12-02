<template>
    <div class="flex flex-col min-h-screen">
        <div class="px-8 mt-16 text-center text-white">
            <h1 class="mb-4 text-xl font-medium leading-tight tracking-wide">
                Deine Buchung war erfolgreich!
            </h1>
            <p>
                Wir haben die deinen QR-Code an deine angegebene E-Mail
                versendet. Mit diesem Code kannst du dich an unserer Station
                testen lassen.
            </p>
        </div>
        <div class="flex justify-center w-full mt-12">
            <div class="relative w-24">
                <svg
                    viewBox="0 0 96 40"
                    xmlns="http://www.w3.org/2000/svg"
                    class="w-24 h-10 -mb-2"
                >
                    <path
                        d="M0 40.017v-7.985c7.936-.001 14.745-4.772 17.541-11.571C22.276 8.492 34.135 0 48 0h.163c13.794.067 25.579 8.539 30.296 20.461C81.256 27.26 88.064 32.031 96 32.032v7.985H0Z"
                        fill="#fff"
                    />
                </svg>
                <div
                    class="absolute bottom-0 flex items-center justify-center w-10 h-10 -mb-5 text-white bg-green-500 rounded-full  left-7"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="-5 -7 24 24"
                        class="w-8 h-8 fill-current"
                    >
                        <path
                            d="M5.486 9.73a.997.997 0 0 1-.707-.292L.537 5.195A1 1 0 1 1 1.95 3.78l3.535 3.535L11.85.952a1 1 0 0 1 1.415 1.414L6.193 9.438a.997.997 0 0 1-.707.292z"
                        ></path>
                    </svg>
                </div>
            </div>
        </div>
        <div
            class="flex-1 px-4 pt-6 space-y-3 overflow-hidden bg-white  shadow-top rounded-t-md"
        >
            <div>
                <img :src="qr" class="mx-auto w-52" />
                <div class="text-center text-gray">{{ code }}</div>
            </div>
            <div class="font-bold text-center">
                {{ event }}
            </div>

            <!-- <Button :href="pdf.url" class="w-full" orange>
                PDF-Download
            </Button>
            <Button :href="passbook.url" class="w-full" orange>
                Zur Apple Wallet hinzufügen
            </Button> -->
        </div>
    </div>
</template>

<script setup lang="ts">
import { Button } from '@/components';
import { computed } from '@vue/reactivity';
const props = defineProps({
    qr: {
        type: String,
        default: null,
    },
    code: {
        type: String,
        default: null,
    },
    event: {
        type: String,
        default: null,
    },
    // downloads: {
    //     default: null,
    // },
});

// const pdf = computed(() => {
//     return props.downloads.find(item => item.output == 'pdf');
// });
// const passbook = computed(() => {
//     return props.downloads.find(item => item.output == 'passbook');
// });
</script>
