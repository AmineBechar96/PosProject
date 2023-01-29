import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3'
import TheNavbar from "./layouts/TheNavbar.vue";
import TheTooltip from "./layouts/Tooltip.vue";
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { library } from '@fortawesome/fontawesome-svg-core';
import { fas } from '@fortawesome/free-solid-svg-icons';


library.add(fas);

createInertiaApp({
  resolve: name => {
    const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
    return pages[`./Pages/${name}.vue`]
  },
  title: title => `${title} - Project`,
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .component('TheNavbar', TheNavbar)
      .component('TheTooltip', TheTooltip)
      .component('font-awesome-icon', FontAwesomeIcon)
      .mixin({ methods: { route } })
      .mount(el)
  },
})
