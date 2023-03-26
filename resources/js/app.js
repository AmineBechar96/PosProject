import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3'
import TheNavbar from "./layouts/TheNavbar.vue";
import TheTooltip from "./layouts/Tooltip.vue";
import Base from './layouts/Base.vue'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { library } from '@fortawesome/fontawesome-svg-core';
import { fas } from '@fortawesome/free-solid-svg-icons';
import { createPinia } from 'pinia';
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'

library.add(fas);

createInertiaApp({
  resolve: name => {
    const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
    return pages[`./Pages/${name}.vue`]
  },
  title: title => `${title} - Project`,
  progress: false,
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(createPinia())
      .component('TheNavbar', TheNavbar)
      .component('TheTooltip', TheTooltip)
      .component('Base', Base)
      .component('VueDatePicker', VueDatePicker)
      .component('font-awesome-icon', FontAwesomeIcon)
      .mixin({ methods: { route } })
      .mount(el)
  },
})
