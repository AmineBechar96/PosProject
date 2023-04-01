import { defineStore } from 'pinia'
import axios from 'axios';
import { router } from "@inertiajs/vue3";

export const useStoreStore = defineStore('storeStore', {
    state: () => ({ items: {} }),
    actions: {
        async getStoreData(id) {
            await axios.get("/stores/" + id)
                .then(res => {
                    this.items = res.data;
                });
        },
    }
})