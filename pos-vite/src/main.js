import { createApp } from 'vue'
import 'flowbite'
import './style.css'
import App from './App.vue'
import router from './router.js';
//import BaseBadge from './components/ui/BaseBadge.vue';
import { createStore } from "vuex";
import Store from './store/store.js';

const app = createApp(App);
const store = createStore(Store);

app.use(router);
app.use(store);

//app.component('base-badge', BaseBadge);

app.mount('#app');
