import { defineStore } from 'pinia'
import axios from 'axios';

export const useProductStore = defineStore('productStore', {
    state: () => ({
        products: {},
    }),
    actions: {
        async getProductData() {
                await axios.get("/options")
                    .then(res => {
                        this.products = res.data.products;
                    });
        },

    }
})