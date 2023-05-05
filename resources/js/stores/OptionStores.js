import { defineStore } from 'pinia'
import axios from 'axios';

export const useOptionStore = defineStore('optionStore', {
    state: () => ({
        options: {}
    }),
    actions: {
        async getOptionData(id) {
                await axios.get("/options/" + id)
                    .then(res => {
                        this.options = res.data.options;
                    });
        },

    }
})