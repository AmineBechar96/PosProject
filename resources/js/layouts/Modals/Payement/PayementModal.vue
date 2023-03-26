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
              class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-[1218px]"
            >
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                  <div class="">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                      <DialogTitle
                        as="h3"
                        class="text-lg mb-8 font-medium leading-6 text-gray-900"
                      >
                        Detailed Payements</DialogTitle
                      >

                      <div class="col-span-12 lg:col-span-4">
                        <div
                          class="grid grid-cols-2 gap-3 sm:grid-cols-3 sm:gap-5 lg:grid-cols-3"
                        >
                          <div
                            class="rounded-lg bg-slate-150 p-4 dark:bg-navy-700"
                          >
                            <div class="flex justify-between space-x-1">
                              <p
                                class="text-xl font-semibold text-slate-700 dark:text-navy-100"
                              >
                                {{ payementStore.items.sale.total }} DA
                              </p>
                              <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-8 w-8 text-primary dark:text-accent"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                              >
                                <path
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                />
                              </svg>
                            </div>
                            <p class="mt-1">Total</p>
                          </div>
                          <div
                            class="rounded-lg bg-slate-150 p-4 dark:bg-navy-700"
                          >
                            <div class="flex justify-between">
                              <p
                                class="text-xl font-semibold text-slate-700 dark:text-navy-100"
                              >
                                {{ payementStore.items.sale.paid }} DA
                              </p>
                              <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-8 w-8 text-success"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                              >
                                <path
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"
                                />
                              </svg>
                            </div>
                            <p class="mt-1">Paid</p>
                          </div>
                          <div
                            class="rounded-lg bg-slate-150 p-4 dark:bg-navy-700"
                          >
                            <div class="flex justify-between">
                              <p
                                class="text-xl font-semibold text-slate-700 dark:text-navy-100"
                              >
                                {{
                                  (payementStore.items.sale.total - payementStore.items.sale.paid).toFixed(
                                    2
                                  )
                                }}
                                DA
                              </p>
                              <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-8 w-8 text-warning"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                              >
                                <path
                                  stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                                />
                              </svg>
                            </div>
                            <p class="mt-1">Change</p>
                          </div>
                        </div>
                      </div>
                      <div
                        class="is-scrollbar-hidden min-w-full overflow-x-auto mt-3"
                      >
                        <table class="is-hoverable w-full text-left mt-5">
                          <thead>
                            <tr>
                              <th
                                class="whitespace-nowrap rounded-l-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
                              >
                                Date
                              </th>
                              <th
                                class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
                              >
                                Name
                              </th>
                              <th
                                class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
                              >
                                Amount
                              </th>
                              <th
                                class="whitespace-nowrap rounded-r-lg bg-slate-200 px-3 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
                              >
                                Method
                              </th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr
                              class="border border-transparent border-b-slate-200 dark:border-b-navy-500"
                            >
                              <td
                                class="whitespace-nowrap rounded-l-lg px-4 py-3 sm:px-5"
                              >
                                {{
                                  new Date(
                                    payementStore.items.sale.created_at
                                  ).toLocaleDateString("fr-CA")
                                }}
                              </td>
                              <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                {{ payementStore.items.user.username }}
                              </td>
                              <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                {{ payementStore.items.sale.first_payement }} DA
                              </td>
                              <td
                                class="whitespace-nowrap rounded-r-lg px-4 py-3 sm:px-5"
                              >
                                <div
                                  v-if="payementStore.items.sale.type == 0"
                                  class="badge rounded-full border border-info text-info"
                                >
                                  Cash
                                </div>
                                <div
                                  v-else-if="payementStore.items.sale.type == 1"
                                  class="badge rounded-full border border-info text-primary"
                                >
                                  Cheque
                                </div>
                                <div
                                  v-else
                                  class="badge rounded-full border border-success text-success"
                                >
                                  Visa
                                </div>
                              </td>
                            </tr>
                            <tr
                              v-for="payement in payementStore.items.payements"
                              :key="payement.id"
                              class="border border-transparent border-b-slate-200 dark:border-b-navy-500"
                            >
                              <td
                                class="whitespace-nowrap rounded-l-lg px-4 py-3 sm:px-5"
                              >
                                {{ payement.date }}
                              </td>
                              <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                {{ payement[0].username }}
                              </td>
                              <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                {{ payement.paid }} DA
                              </td>
                              <td
                                class="whitespace-nowrap rounded-r-lg px-4 py-3 sm:px-5"
                              >
                                <div
                                  v-if="payement.type == 0"
                                  class="badge rounded-full border border-info text-info"
                                >
                                  Cash
                                </div>
                                <div
                                  v-else-if="payement.type == 1"
                                  class="badge rounded-full border border-info text-primary"
                                >
                                  Cheque
                                </div>
                                <div
                                  v-else
                                  class="badge rounded-full border border-success text-success"
                                >
                                  Visa
                                </div>
                              </td>
                              <td>
                                <a class="cursor-pointer" @click="deletePayement(payement.id)">
                                  <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-6 w-4 text-warning"
                                    viewBox="0 0 20 20"
                                    fill="none"
                                  >
                                    <path
                                      fill="#000000"
                                      fill-rule="evenodd"
                                      d="M7 1a2 2 0 00-2 2v2H2a1 1 0 000 2h.884c.036.338.078.754.12 1.213.11 1.202.218 2.664.218 3.787 0 1.47-.183 3.508-.315 4.776a2.015 2.015 0 002 2.224h10.186a2.015 2.015 0 002-2.224c-.132-1.268-.315-3.306-.315-4.776 0-1.123.107-2.585.218-3.787.042-.459.084-.875.12-1.213H18a1 1 0 100-2h-3V3a2 2 0 00-2-2H7zm6 4V3H7v2h6zM4.996 8.03c-.035-.378-.07-.728-.101-1.03h10.21a81.66 81.66 0 00-.1 1.03c-.112 1.212-.227 2.75-.227 3.97 0 1.584.194 3.714.325 4.982v.007a.02.02 0 01-.005.008l-.003.003H4.905a.024.024 0 01-.008-.01v-.008c.131-1.268.325-3.398.325-4.982 0-1.22-.115-2.758-.226-3.97zM8 8a1 1 0 011 1v6a1 1 0 11-2 0V9a1 1 0 011-1zm5 1a1 1 0 10-2 0v6a1 1 0 102 0V9z"
                                    />
                                  </svg>
                                </a>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>

                <div
                  class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6"
                >
                  <button
                    class="inline-flex w-full justify-center rounded-md border border-transparent bg-green-700 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm"
                    @click="activeAddModal = true"
                  >
                    Add Payement
                  </button>
                  <button
                    type="button"
                    class="mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                    @click="emit('close')"
                  >
                    Cancel
                  </button>
                </div>
          
              <Teleport to="body">
                <AlertModal
                  v-if="activeAlertModal"
                  :id="item_id"
                  @close="closeModal()"
                  @confirm="confirm_delete_item"
                >
                </AlertModal>
                <AddPayement
                  v-if="activeAddModal"
                >
                </AddPayement>
                
              </Teleport>
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
import { ref,reactive,toRefs } from "vue";
import AlertModal from "../AlertModal.vue";
import AddPayement from "./AddPayement.vue";
import { usePayementStore } from "../../../stores/PayementStores.js";

const props = defineProps({
  page_name: String,
  errors: Object,
  open: Boolean,
})

const payementStore = usePayementStore()
const items = ref(payementStore.items)
const item_id = ref(0);


const activeAlertModal = ref(false);
const activeAddModal = ref(false);

function toTitleCase(str) {
  return str.replace(/\w\S*/g, function (txt) {
    return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
  });
}
const emit = defineEmits(["close", "update"]);

function deletePayement(id) {
  item_id.value = id;
  activeAlertModal.value = true;
}
async function confirm_delete_item({ decision, id }) {
  activeAlertModal.value = false;
  if (decision == true) {
    await payementStore.deletePayement(id)
  }
}
</script>

<style scoped>
.badge,
.tag {
  @apply inline-flex items-center justify-center px-2 py-1.5
     text-xs font-inter tracking-wide align-baseline transition-all duration-200
     leading-none rounded font-medium;
}
</style>