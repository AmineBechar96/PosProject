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
              class="relative  rounded-lg text-left transition-all"
            >
              <form
                @submit.prevent="
                  router.post(
                    'map',
                    {
                      _method: 'put',
                    },
                    {
                      preserveScroll: true,
                      onStart: () => (errors.date = null),
                      onSuccess: () => emit('close'),
                    }
                  )
                "
              >
                <div class="grid place-items-center">
                  <div
                    class="card my-20 max-w-sm p-6 sm:p-8 "
                  >
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
                            <p class="text-xs+ font-light">Name</p>
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
                          <p class="text-xs+ font-light">Card Number</p>
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
                        x-text="cardText"
                      ></p>
                    </div>
                    <div class="space-y-4">
                      <label class="block">
                        <span>Card number</span>
                        <input
                          class="form-input mt-1.5 w-full rounded-lg bg-slate-150 px-3 py-2 ring-primary/50 placeholder:text-slate-400 hover:bg-slate-200 focus:ring dark:bg-navy-900/90 dark:ring-accent/50 dark:placeholder:text-navy-300 dark:hover:bg-navy-900 dark:focus:bg-navy-900"
                          placeholder="**** **** **** ****"
                          type="text"
                          x-model.debounce="cardNumber"
                          x-input-mask="creditCardInput"
                        />
                      </label>
                      <label class="block">
                        <span>Name on card</span>
                        <input
                          class="form-input mt-1.5 w-full rounded-lg bg-slate-150 px-3 py-2 ring-primary/50 placeholder:text-slate-400 hover:bg-slate-200 focus:ring dark:bg-navy-900/90 dark:ring-accent/50 dark:placeholder:text-navy-300 dark:hover:bg-navy-900 dark:focus:bg-navy-900"
                          placeholder="John Doe"
                          type="text"
                          x-model.debounce="nameOnCard"
                        />
                      </label>
                      <div class="grid grid-cols-2 gap-4">
                        <label class="block">
                          <span>Expiration date</span>
                          <input
                            class="form-input mt-1.5 w-full rounded-lg bg-slate-150 px-3 py-2 ring-primary/50 placeholder:text-slate-400 hover:bg-slate-200 focus:ring dark:bg-navy-900/90 dark:ring-accent/50 dark:placeholder:text-navy-300 dark:hover:bg-navy-900 dark:focus:bg-navy-900"
                            placeholder="mm/yy"
                            type="text"
                            x-input-mask="{ date: true, datePattern: ['m', 'y'] }"
                          />
                        </label>
                        <label class="block">
                          <span>CVV</span>
                          <input
                            class="form-input mt-1.5 w-full rounded-lg bg-slate-150 px-3 py-2 ring-primary/50 placeholder:text-slate-400 hover:bg-slate-200 focus:ring dark:bg-navy-900/90 dark:ring-accent/50 dark:placeholder:text-navy-300 dark:hover:bg-navy-900 dark:focus:bg-navy-900"
                            placeholder="***"
                            type="password"
                            x-input-mask="{ numeral: true }"
                            maxlength="3"
                          />
                        </label>
                      </div>
                      <div class="flex justify-center space-x-2 pt-4">
                        <button
                          class="btn min-w-[7rem] border border-slate-300 font-medium text-slate-800 hover:bg-slate-150 focus:bg-slate-150 active:bg-slate-150/80 dark:border-navy-450 dark:text-navy-50 dark:hover:bg-navy-500 dark:focus:bg-navy-500 dark:active:bg-navy-500/90"
                        >
                          Cancel
                        </button>
                        <button
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

import InvoiceComponent from "../../../components/InvoiceComponent.vue";

const emit = defineEmits(["close", "update"]);
</script>
  
  <style scoped>
.badge,
.tag {
  @apply inline-flex items-center justify-center px-2 py-1.5
       text-xs font-inter tracking-wide align-baseline transition-all duration-200
       leading-none rounded font-medium;
}

.card {
  @apply relative flex  min-w-[1px] flex-col break-words rounded-lg  bg-white text-slate-500 shadow-soft dark:bg-navy-700 dark:text-navy-200 dark:shadow-none  sm:w-96 print:border;
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