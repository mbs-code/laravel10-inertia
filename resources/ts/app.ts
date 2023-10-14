import './bootstrap'
import 'primevue/resources/themes/lara-light-blue/theme.css'
import 'primevue/resources/primevue.css'
import 'primeicons/primeicons.css'
import '../css/app.css'

import { createApp, h, DefineComponent } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m'
import { createPinia } from 'pinia'
import piniaPluginPersistedstate from 'pinia-plugin-persistedstate'
import PrimeVue from 'primevue/config'
import Tailwind from 'primevue/passthrough/tailwind'
import LocaleJa from './ja.json'

const appName = import.meta.env.VITE_APP_NAME || 'Laravel'

createInertiaApp({
  title: (title) => `${title} - ${appName}`,
  resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob<DefineComponent>('./Pages/**/*.vue')),
  setup ({ el, App, props, plugin }) {
    const pinia = createPinia()
    pinia.use(piniaPluginPersistedstate)

    createApp({ render: () => h(App, props) })
      .use(plugin)
      // eslint-disable-next-line no-undef
      .use(ZiggyVue, Ziggy)
      .use(pinia)
      .use(PrimeVue, {
        locale: LocaleJa,
        unstyled: true,
        pt: Tailwind,
        ptOptions: { mergeSections: true, mergeProps: true },
      })
      .mount(el)
  },
  progress: {
    color: '#4B5563',
  },
})
