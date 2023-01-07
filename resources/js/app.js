import { createApp, h } from 'vue';
import { InertiaProgress } from '@inertiajs/progress';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import TheNavbar from "./layouts/TheNavbar.vue";
import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome';
import { library } from '@fortawesome/fontawesome-svg-core';
import { fas } from '@fortawesome/free-solid-svg-icons';

import '../../node_modules/flowbite/src/flowbite.js';

library.add(fas);
InertiaProgress.init({
  delay: 200,

  color: '#29d',

  includeCSS: true,

  showSpinner: false,
})

createInertiaApp({
  resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
  title: title => `${title} - Project`,
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .component('TheNavbar', TheNavbar)
      .component('font-awesome-icon', FontAwesomeIcon)
      .mixin({methods :{route}})
      .mount(el)
  },
});
