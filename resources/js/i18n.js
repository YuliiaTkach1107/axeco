import { createI18n } from 'vue-i18n'
import fr from './lang/fr'
import en from './lang/en'
import nl from './lang/nl'

const messages = {
    fr,
    en,
    nl
}

const i18n = createI18n({
    legacy: false,
    locale: 'fr',
    fallbackLocale: 'en',
    messages
})

export default i18n