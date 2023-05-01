<template>
  <TransitionRoot as="template" :show="open">
    <Dialog as="div" class="relative z-10" @close="emit('close')">
      <TransitionChild
        as="template"
        enter="ease-out duration-300"
        enter-from="opacity-0"
        enter-to="opacity-100"
        leave="ease-in duration-200"
        leave-from="opacity-100"
        leave-to="opacity-0"
      >
        <div
          class="fixed inset-0 bg-gray-500 bg-opacity-95 transition-opacity"
        />
      </TransitionChild>
      <div class="fixed inset-0 z-10 overflow-y-auto">
        <div
          class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0"
        >
          <TransitionChild
            as="template"
            enter="ease-out duration-300"
            enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            enter-to="opacity-100 translate-y-0 sm:scale-100"
            leave="ease-in duration-200"
            leave-from="opacity-100 translate-y-0 sm:scale-100"
            leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
          >
            <DialogPanel
              class="relative rounded-lg text-left transition-all w-[1218px]"
            >
              <form
                @submit.prevent="
                  form.post(page_name, {
                    preserveScroll: true,
                    onStart: () => (errors = null),
                    onSuccess: () => emit('close'),
                    onFinish: () => payementStore.addPayement(form),
                  })
                "
              >
                <div class="grid place-items-center">
                  <div class="card my-20 p-6 sm:p-8 w-[1200px]">
                    <div
                      class="relative mx-auto -mt-20 h-40 w-72 rounded-lg text-white shadow-xl transition-transform hover:scale-110 lg:h-48 lg:w-80"
                    >
                      <div
                        class="h-full w-full rounded-lg bg-gradient-to-r from-pink-300 via-purple-300 to-indigo-400"
                      ></div>
                      <div
                        class="absolute top-0 flex h-full w-full flex-col justify-between p-4 sm:p-5"
                      >
                        <div class="flex justify-between">
                          <div>
                            <p class="text-xs+ font-light">
                              {{
                                form.credit_card_holder
                                  ? form.credit_card_holder
                                  : "Name"
                              }}
                            </p>
                            <p
                              class="font-medium uppercase tracking-wide"
                              x-text="nameOnCard"
                            ></p>
                          </div>
                          <template x-if="cardLogoSrc">
                            <img
                              src="null"
                              class="w-12 rounded-lg"
                              alt="creditcard"
                            />
                          </template>
                        </div>

                        <div class="pt-4">
                          <p class="text-xs+ font-light">
                            {{
                              form.credit_card_number
                                ? form.credit_card_number
                                : "Card Number"
                            }}
                          </p>
                          <p
                            class="font-medium tracking-wide"
                            x-text="cardNumber"
                          ></p>
                        </div>
                      </div>
                    </div>
                    <div class="flex items-center justify-between py-4">
                      <p
                        class="text-xl font-semibold text-primary dark:text-accent-light"
                      >
                        Payement Gateaway
                      </p>
                    </div>
                    <div class="mb-3 flex justify-between py-4 -mx-2">
                      <div class="px-2">
                        <label
                          for="type2"
                          class="flex items-center cursor-pointer"
                        >
                          <input
                            type="radio"
                            class="form-radio h-5 w-5 text-indigo-500"
                            name="type"
                            id="type2"
                            value="0"
                            v-model="form.type"
                          />
                          <img
                            src="images/payement/cash.png"
                            class="h-10 ml-5"
                          />
                        </label>
                      </div>
                      <div class="px-2">
                        <label
                          for="type2"
                          class="flex items-center cursor-pointer"
                        >
                          <input
                            type="radio"
                            class="form-radio h-5 w-5 text-indigo-500"
                            name="type2"
                            id="type3"
                            value="1"
                            v-model="form.type"
                          />
                          <img
                            src="images/payement/cheque.png"
                            class="h-10 ml-5"
                          />
                        </label>
                      </div>
                      <div class="px-2">
                        <label
                          for="type1"
                          class="flex items-center cursor-pointer"
                        >
                          <input
                            type="radio"
                            class="form-radio h-5 w-5 text-indigo-500"
                            name="type"
                            id="type1"
                            value="2"
                            v-model="form.type"
                          />
                          <img
                            src="https://leadershipmemphis.org/wp-content/uploads/2020/08/780370.png"
                            class="h-8 ml-3"
                          />
                        </label>
                      </div>
                    </div>
                    <div class="space-y-4">
                      <label class="block">
                        <span>Paid</span>
                        <input
                          class="form-input mt-1.5 w-full rounded-lg bg-slate-150 px-3 py-2 ring-primary/50 placeholder:text-slate-400 hover:bg-slate-200 focus:ring dark:bg-navy-900/90 dark:ring-accent/50 dark:placeholder:text-navy-300 dark:hover:bg-navy-900 dark:focus:bg-navy-900"
                          placeholder="(DA)"
                          type="number"
                          required
                          v-model="form.paid"
                        />
                      </label>
                      <label v-if="form.type == 1" class="block">
                        <span>Cheque Number</span>
                        <input
                          class="form-input mt-1.5 w-full rounded-lg bg-slate-150 px-3 py-2 ring-primary/50 placeholder:text-slate-400 hover:bg-slate-200 focus:ring dark:bg-navy-900/90 dark:ring-accent/50 dark:placeholder:text-navy-300 dark:hover:bg-navy-900 dark:focus:bg-navy-900"
                          placeholder="**** **** **** ****"
                          type="number"
                          required
                          v-model="form.credit_card_number"
                        />
                      </label>
                      <label v-if="form.type == 2" class="block">
                        <span>Card Number</span>
                        <input
                          class="form-input mt-1.5 w-full rounded-lg bg-slate-150 px-3 py-2 ring-primary/50 placeholder:text-slate-400 hover:bg-slate-200 focus:ring dark:bg-navy-900/90 dark:ring-accent/50 dark:placeholder:text-navy-300 dark:hover:bg-navy-900 dark:focus:bg-navy-900"
                          placeholder="**** **** **** ****"
                          type="number"
                          required
                          v-model="form.credit_card_number"
                        />
                      </label>
                      <label v-if="form.type == 2" class="block">
                        <span>Name on Card</span>
                        <input
                          class="form-input mt-1.5 w-full rounded-lg bg-slate-150 px-3 py-2 ring-primary/50 placeholder:text-slate-400 hover:bg-slate-200 focus:ring dark:bg-navy-900/90 dark:ring-accent/50 dark:placeholder:text-navy-300 dark:hover:bg-navy-900 dark:focus:bg-navy-900"
                          placeholder="Your Name"
                          type="text"
                          required
                          v-model="form.credit_card_holder"
                        />
                      </label>
                      <div v-if="form.type == 2" class="grid grid-cols-2 gap-4">
                        <label class="block">
                          <span>Expiration Date</span>
                          <input
                            class="form-input mt-1.5 w-full rounded-lg bg-slate-150 px-3 py-2 ring-primary/50 placeholder:text-slate-400 hover:bg-slate-200 focus:ring dark:bg-navy-900/90 dark:ring-accent/50 dark:placeholder:text-navy-300 dark:hover:bg-navy-900 dark:focus:bg-navy-900"
                            placeholder="mm/yy"
                            type="text"
                            required
                            v-model="form.carddate"
                          />
                        </label>
                        <label class="block">
                          <span>CVV</span>
                          <input
                            class="form-input mt-1.5 w-full rounded-lg bg-slate-150 px-3 py-2 ring-primary/50 placeholder:text-slate-400 hover:bg-slate-200 focus:ring dark:bg-navy-900/90 dark:ring-accent/50 dark:placeholder:text-navy-300 dark:hover:bg-navy-900 dark:focus:bg-navy-900"
                            placeholder="***"
                            type="password"
                            pattern="[0-9]*"                           
                            maxlength="3"
                            required
                            v-model="form.cvv"
                          />
                        </label>
                      </div>
                      <div class="flex justify-center space-x-2 pt-4">
                        <a
                          @click="emit('close')"
                          class="btn min-w-[7rem] border border-slate-300 font-medium text-slate-800 hover:bg-slate-150 focus:bg-slate-150 active:bg-slate-150/80 dark:border-navy-450 dark:text-navy-50 dark:hover:bg-navy-500 dark:focus:bg-navy-500 dark:active:bg-navy-500/90"
                        >
                          Cancel
                        </a>
                        <button
                          v-if="form.processing"
                          disabled
                          type="button"
                          class="inline-flex w-full justify-center rounded-md border border-transparent bg-blue-700 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm"
                        >
                          <svg
                            aria-hidden="true"
                            role="status"
                            class="inline mr-2 w-4 h-4 text-gray-200 animate-spin dark:text-gray-600"
                            viewBox="0 0 100 101"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                          >
                            <path
                              d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                              fill="currentColor"
                            />
                            <path
                              d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                              fill="#1C64F2"
                            />
                          </svg>
                          Loading...
                        </button>
                        <button v-else
                          class="btn min-w-[7rem] bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90"
                        >
                          Save
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </DialogPanel>
          </TransitionChild>
        </div>
      </div>
    </Dialog>
  </TransitionRoot>
</template>
    
<script setup>
import {
  Dialog,
  DialogPanel,
  DialogTitle,
  TransitionChild,
  TransitionRoot,
} from "@headlessui/vue";
import { ExclamationTriangleIcon } from "@heroicons/vue/24/outline";
import { Head, useForm, router } from "@inertiajs/vue3";
import { usePayementStore } from "../../../stores/PayementStores.js";
const payementStore = usePayementStore();
const props = defineProps({
  page_name: String,
  errors: Object,
  open: Boolean,
});

const form = useForm({
  paid: 0,
  type: 0,
  credit_card_number: null,
  credit_card_holder: null,
  carddate: "",
  cvv: "",
  created_by: 12,
  register_id: 12,
  waiter_id: 12,
  data_id: payementStore.items.data.id,
});

const emit = defineEmits(["close"]);
</script>
  
<style scoped>
.badge,
.tag {
  @apply inline-flex items-center justify-center px-2 py-1.5
       text-xs font-inter tracking-wide align-baseline transition-all duration-200
       leading-none rounded font-medium;
}

.card {
  @apply relative flex  min-w-[1px] flex-col break-words rounded-lg  bg-white text-slate-500 shadow-soft dark:bg-navy-700 dark:text-navy-200 dark:shadow-none  sm:w-[650px] print:border;
}

.form-input,
.form-textarea,
.form-select,
.form-multiselect,
.form-radio,
.form-checkbox,
.form-switch,
.form-checkbox::before,
.form-radio::before,
.form-switch::before {
  @apply transition-all duration-200 ease-in-out;
}

.form-input,
.form-textarea,
.form-select,
.form-multiselect {
  @apply appearance-none tracking-wide outline-none placeholder:font-light focus:outline-none;
  contain: paint;
}

.btn {
  @apply inline-flex cursor-pointer items-center justify-center rounded-lg px-5 py-2
   text-center tracking-wide outline-none transition-all duration-200
   focus:outline-none disabled:pointer-events-none;
}
</style>