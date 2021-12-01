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
                    viewBox="0 0 106 36"
                    xmlns="http://www.w3.org/2000/svg"
                    class="w-24"
                >
                    <path
                        d="M0 36a20.828 20.828 0 0019.335-13.005C24.555 9.544 37.627 0 52.91 0h.179c15.206.075 28.196 9.597 33.396 22.995A20.83 20.83 0 00105.82 36H0z"
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
            <img :src="qr" class="mx-auto w-52" />
            <Button :href="pdf.url" class="w-full" orange>
                PDF-Download
            </Button>
            <Button :href="passbook.url" class="w-full" orange>
                Zur Apple Wallet hinzufügen
            </Button>
        </div>
    </div>
    <!-- {{ dummy }} -->
</template>

<script setup lang="ts">
import { Button } from '@/components';
import { computed } from '@vue/reactivity';
const props = defineProps({
    qr: {
        type: String,
        default: null,
    },
    downloads: {
        default: null,
    },
});

const pdf = computed(() => {
    return props.downloads.find(item => item.output == 'pdf');
});
const passbook = computed(() => {
    return props.downloads.find(item => item.output == 'passbook');
});
</script>
