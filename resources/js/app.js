import { createApp, h } from 'vue';
import { InertiaProgress } from '@inertiajs/progress';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import TheNavbar from "./layouts/TheNavbar.vue";
import '../../node_modules/flowbite/src/flowbite.js';

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
      .mixin({methods :{route}})
      .mount(el)
  },
});
