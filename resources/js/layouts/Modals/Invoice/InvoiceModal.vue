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
              <form
                @submit.prevent="
                  router.post(
                    props.page_name + '/' + props.items.id,
                    {
                      _method: 'put',
                      client_id: form.client_id,
                      paid: form.paid,
                    },
                    {
                      preserveScroll: true,
                      onStart: () => (errors.date = null),
                      onSuccess: () => emit('close'),
                    }
                  )
                "
              >
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                  <div class="">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                      <DialogTitle
                        as="h3"
                        class="text-lg mb-8 font-medium leading-6 text-gray-900"
                      >
                        Payements</DialogTitle
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
                                $67.6k
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
                                12.6K
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
                                143
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
                                #
                              </th>
                              <th
                                class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
                              >
                                Name
                              </th>
                              <th
                                class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
                              >
                                Job
                              </th>
                              <th
                                class="whitespace-nowrap rounded-r-lg bg-slate-200 px-3 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
                              >
                                Favorite Color
                              </th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr
                              class="border border-transparent border-b-slate-200 dark:border-b-navy-500"
                            >
                              <td
                                class="whitespace-nowrap rounded-l-lg px-4 py-3 sm:px-5"
                              >
                                1
                              </td>
                              <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                Cy Ganderton
                              </td>
                              <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                Quality Control Specialist
                              </td>
                              <td
                                class="whitespace-nowrap rounded-r-lg px-4 py-3 sm:px-5"
                              >
                                Blue
                              </td>
                            </tr>
                            <tr
                              class="border border-transparent border-b-slate-200 dark:border-b-navy-500"
                            >
                              <td
                                class="whitespace-nowrap rounded-l-lg px-4 py-3 sm:px-5"
                              >
                                2
                              </td>
                              <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                Hart Hagerty
                              </td>
                              <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                Desktop Support Technician
                              </td>
                              <td
                                class="whitespace-nowrap rounded-r-lg px-4 py-3 sm:px-5"
                              >
                                Purple
                              </td>
                            </tr>
                            <tr
                              class="border border-transparent border-b-slate-200 dark:border-b-navy-500"
                            >
                              <td
                                class="whitespace-nowrap rounded-l-lg px-4 py-3 sm:px-5"
                              >
                                3
                              </td>
                              <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                Brice Swyre
                              </td>
                              <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                Tax Accountant
                              </td>
                              <td
                                class="whitespace-nowrap rounded-r-lg px-4 py-3 sm:px-5"
                              >
                                Red
                              </td>
                            </tr>
                            <tr
                              class="border border-transparent border-b-slate-200 dark:border-b-navy-500"
                            >
                              <td
                                class="whitespace-nowrap rounded-l-lg px-4 py-3 sm:px-5"
                              >
                                4
                              </td>
                              <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                Marjy Ferencz
                              </td>
                              <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                Office Assistant I
                              </td>
                              <td
                                class="whitespace-nowrap rounded-r-lg px-4 py-3 sm:px-5"
                              >
                                Crimson
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
                    v-if="form.processing"
                    disabled
                    type="button"
                    class="inline-flex w-full justify-center rounded-md border border-transparent bg-green-700 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm"
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
                  <button
                    v-else
                    class="inline-flex w-full justify-center rounded-md border border-transparent bg-green-700 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm"
                    :disabled="form.processing"
                  >
                    Add Payement
                  </button>
                  <button
                    type="button"
                    class="mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                    :disabled="form.processing"
                    @click="emit('close')"
                  >
                    Cancel
                  </button>
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

const props = defineProps({
  page_name: String,
  errors: Object,
  customers: Object,
  items: Object,
  open: Boolean,
});

const form = useForm({
  client_id: props.items.client_id,
  status: props.items.status,
});
function toTitleCase(str) {
  return str.replace(/\w\S*/g, function (txt) {
    return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
  });
}
const emit = defineEmits(["close", "update"]);

function form_method({ form_inputs, value }) {
  form[form_inputs] = value;
}
</script>