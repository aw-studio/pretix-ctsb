import { createI18n } from 'vue-i18n'

const w: any = window;
const messages = w.i18n;

const locale = 'de';

export const i18n: any = createI18n({
    legacy: false,
    locale: locale,
    fallbackLocale: 'de',
    messages,
});