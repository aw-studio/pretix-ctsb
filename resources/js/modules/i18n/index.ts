import { createI18n, TranslateOptions, useI18n } from 'vue-i18n'


const w: any = window;
const messages = w.i18n;

export const i18n: any = createI18n({
    legacy: false,
    locale: 'de',
    fallbackLocale: 'de',
    messages,
});

export const t = (
    key: string | number,
    plural?: number,
    options?: TranslateOptions
    ) => {
    const { t } = useI18n();
    return t(key, plural, options);
}
