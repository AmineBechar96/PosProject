import { defineStore } from 'pinia'
import axios from 'axios';
import { router } from "@inertiajs/vue3";

export const usePayementStore = defineStore('payementStore', {
    state: () => ({ items: {} }),
    actions: {
        async addPayement(payement){
            const new_payement = {}
            const date = new Date().toLocaleDateString("fr-CA");
            const all_payements = this.items.payements;
            new_payement[0] = {"username":"Amine"};
            new_payement["date"] = date;
            new_payement["type"] = payement["type"]
            new_payement["paid"] = payement["paid"]
            
            if(new_payement["paid"] != 0)
            all_payements.push(new_payement);
            this.items.sale.paid = this.items.sale.paid + payement["paid"]
            this.items.payements = all_payements;
        },
        async deletePayement(id,paid){
            this.items.payements = this.items.payements.filter(p =>{return p.id !== id})
            this.items.sale.paid = this.items.sale.paid - paid
            router.delete("/payementIncome/" + id, );
        },
        async getPayementData(id) {
            await axios.get("/sales/" + id)
                .then(res => {
                    this.items = res.data;
                });
        },
        async getTicketData(id) {
            await axios.get("/ticket/" + id)
                .then(res => {
                    this.items = res.data;
                });
                console.log(this.items)
        }
    }
})