import { defineStore } from 'pinia'
import axios from 'axios';

export const usePayementStore = defineStore('payementStore', {
    state: () => ({ items: {} }),
    actions: {
        async addPayement(payement){
            this.items.push(payement);
        },
        async deletePayement(id){
            this.items.payements = this.items.payements.filter(p =>{return p.id !== id})
            axios.delete("/payementIncome/" + id, );
        },
        async getPayementData(id) {
            await axios.get("sales/" + id)
                .then(res => {
                    this.items = res.data;
                });
        }
    }
})