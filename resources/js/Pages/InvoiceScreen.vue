<template>
  <Base>
    <div>
      <div class="bg-gray-100 w-screen">
        <div
          id="root"
          class="min-h-100vh flex grow bg-slate-50 dark:bg-navy-900"
        >
          <main class="main-content w-full px-18 pb-8">
            <div class="flex items-center justify-between py-5 lg:py-6">
              <div class="flex">
                <Link class="pt-2 mr-3" :href="page_name" @click="back()"
                  ><font-awesome-icon icon="fa-solid fa-arrow-left"
                /></Link>

                <h2
                  class="text-xl font-medium text-slate-700 line-clamp-1 dark:text-navy-50 lg:text-3xl"
                >
                  Invoice
                </h2>
              </div>
              <div class="flex">
                <button
                  @click="printDiv('printMe')"
                  class="btn h-8 w-8 rounded-full p-2 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25 sm:h-9 sm:w-9"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="1.5"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"
                    />
                  </svg>
                </button>
                <div id="editor"></div>
                <button
                  @click="toPdf()"
                  class="btn h-8 w-8 rounded-full p-2.5 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25 sm:h-9 sm:w-9"
                >
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                    <path
                      d="M0 64C0 28.7 28.7 0 64 0H224V128c0 17.7 14.3 32 32 32H384V304H296 272 184 160c-35.3 0-64 28.7-64 64v80 48 16H64c-35.3 0-64-28.7-64-64V64zm384 64H256V0L384 128zM160 352h24c30.9 0 56 25.1 56 56s-25.1 56-56 56h-8v32c0 8.8-7.2 16-16 16s-16-7.2-16-16V448 368c0-8.8 7.2-16 16-16zm24 80c13.3 0 24-10.7 24-24s-10.7-24-24-24h-8v48h8zm88-80h24c26.5 0 48 21.5 48 48v64c0 26.5-21.5 48-48 48H272c-8.8 0-16-7.2-16-16V368c0-8.8 7.2-16 16-16zm24 128c8.8 0 16-7.2 16-16V400c0-8.8-7.2-16-16-16h-8v96h8zm72-112c0-8.8 7.2-16 16-16h48c8.8 0 16 7.2 16 16s-7.2 16-16 16H400v32h32c8.8 0 16 7.2 16 16s-7.2 16-16 16H400v48c0 8.8-7.2 16-16 16s-16-7.2-16-16V432 368z"
                    />
                  </svg>
                </button>
              </div>
            </div>
            <div class="grid grid-cols-1" id="printMe" ref="myReference">
              <div class="card px-5 py-12 sm:px-18 bg-black">
                <div class="flex flex-col justify-between sm:flex-row">
                  <div class="text-center sm:text-left">
                    <h2
                      class="text-2xl font-semibold uppercase text-primary dark:text-accent-light"
                    >
                      {{ user.company_name }}
                    </h2>
                    <div class="space-y-1 pt-2">
                      <p></p>
                      <p>{{ user.phone }}</p>
                    </div>
                  </div>
                  <div class="mt-4 text-center sm:m-0 sm:text-right">
                    <h2
                      class="text-2xl font-semibold uppercase text-primary dark:text-accent-light"
                    >
                      invoice
                    </h2>
                    <div class="space-y-1 pt-2">
                      <p>
                        Invoice #:
                        <span class="font-semibold">{{ data.id }}</span>
                      </p>
                      <p>
                        Created:
                        <span class="font-semibold">{{
                          new Date(data.created_at).toLocaleDateString("en-CA")
                        }}</span>
                      </p>
                    </div>
                  </div>
                </div>
                <div class="my-7 h-px bg-slate-200 dark:bg-navy-500"></div>
                <div class="flex flex-row justify-between sm:flex-row">
                  <div class="text-center sm:text-left">
                    <p
                      class="text-lg font-medium text-slate-600 dark:text-navy-100"
                    >
                      Invoiced To :
                    </p>
                    <div class="space-y-1 pt-2">
                      <p v-if="customer" class="font-semibold">
                        {{ customer.name }}
                      </p>
                      <p v-else class="font-semibold">WalkIn Customer</p>
                      <p v-if="customer">{{ customer.email }}</p>
                      <p v-if="customer">{{ customer.phone }}</p>
                    </div>
                  </div>
                  <div class="mt-4 text-center sm:m-0 sm:text-right">
                    <p
                      class="text-lg font-medium text-slate-600 dark:text-navy-100"
                    >
                      Payment Method :
                    </p>
                    <div class="space-y-1 pt-2">
                      <p class="font-medium" v-if="data.type == '0'">Cash</p>
                      <p class="font-medium" v-if="data.type == '1'">Cheque</p>
                      <p class="font-medium" v-if="data.type == '2'">
                        Visa **** ****
                      </p>
                      <p v-if="data.type != '0'">
                        <span class="font-medium m-2" v-if="data.type == '1'"
                          >Cheque Number:</span
                        >{{ data.credit_card_number }}
                      </p>
                    </div>
                    <p
                      v-if="data.type == '2'"
                      class="text-lg font-medium text-slate-600 dark:text-navy-100 mt-3"
                    >
                      Credit Card Holder
                    </p>
                    <div class="space-y-1 pt-2" v-if="data.type == '2'">
                      <p class="font-medium">{{ data.credit_card_holder }}</p>
                    </div>
                  </div>
                </div>
                <div class="my-7 h-px bg-slate-200 dark:bg-navy-500"></div>
                <div class="is-scrollbar-hidden min-w-full">
                  <table class="is-zebra w-full text-left">
                    <thead>
                      <tr>
                        <th
                          class="whitespace-nowrap rounded-l-lg bg-slate-200 px-3 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
                        >
                          #
                        </th>
                        <th
                          class="whitespace-nowrap bg-slate-200 px-6 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
                        >
                          PRODUCT
                        </th>
                        <th
                          class="whitespace-nowrap bg-slate-200 px-3 py-3 text-right font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
                        >
                          QUANTITY
                        </th>
                        <th
                          class="whitespace-nowrap rounded-r-lg bg-slate-200 px-3 py-3 text-right font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
                        >
                          SUBTOTAL
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="product in data.products" :key="product.name">
                        <td
                          class="whitespace-nowrap rounded-l-lg px-4 py-3 sm:px-5"
                        >
                          {{ i++ }}
                        </td>
                        <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                          <div>
                            <p
                              class="font-medium text-slate-600 dark:text-navy-100"
                            >
                              {{ product.name }}
                            </p>
                          </div>
                        </td>
                        <td
                          class="w-3/12 whitespace-nowrap px-4 py-3 text-right sm:px-5"
                        >
                          {{ product.pivot.quantity }}
                        </td>

                        <td
                          class="w-3/12 whitespace-nowrap rounded-r-lg px-4 py-3 text-right font-semibold sm:px-5"
                        >
                          {{ product.pivot.price * product.pivot.quantity }}
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="my-7 h-px bg-slate-200 dark:bg-navy-500"></div>

                <div class="flex flex-col justify-end sm:flex-row">
                  <div class="mt-4 text-center sm:m-0 sm:text-right">
                    <p
                      class="text-lg font-medium text-slate-600 dark:text-navy-100"
                    >
                      Total Items : {{ data.total_items }}
                    </p>
                    <div class="space-y-1 pt-2">
                      <p>
                        Summary :
                        <span class="font-medium"
                          >{{ data.total_items }} DA</span
                        >
                      </p>
                      <p v-if="data.discount">
                        Discount :
                        <span class="font-medium">{{ data.discount }}%</span>
                      </p>
                      <p v-if="data.tax">
                        Tax : <span class="font-medium">{{ data.tax }}%</span>
                      </p>
                      <p class="text-lg text-primary dark:text-accent-light">
                        Total:
                        <span class="font-medium">{{ data.total }} DA</span>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </main>
        </div>
      </div>
    </div>
  </Base>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import jsPDF from "jspdf";
import { ref, onMounted } from "vue";

const myReference = ref(null);

const props = defineProps({
  data: Object,
  products: Object,
  customer: Object,
  user: Object,
  page_name: String,
});
var i = 1;

function toPdf() {
  var doc = new jsPDF();

  // Source HTMLElement or a string containing HTML.
  var elementHTML = document.querySelector("printMe");

  doc.html(myReference.value.innerHTML, {
    callback: function (doc) {
      // Save the PDF
      doc.save("tassyir-invoice.pdf");
    },
    x: 2,
    y: 2,
    width: 190, //target width in the PDF document
    windowWidth: 850, //window width in CSS pixels
  });
}

function printDiv(divName) {
  var printContents = document.getElementById(divName).innerHTML;
  var originalContents = document.body.innerHTML;

  document.body.innerHTML = printContents;

  window.print();

  document.body.innerHTML = originalContents;
}
</script>


<style>
.card {
  @apply relative flex  min-w-[1px] flex-col break-words rounded-lg  bg-white text-slate-500 shadow-soft dark:bg-navy-700 dark:text-navy-200 dark:shadow-none  print:border;
}

.main-content {
  @apply mt-[60px] grid grid-cols-1 place-content-start transition-[width,margin-left,margin-right,padding-left,padding-right] duration-[.25s] ease-in print:m-0 md:ml-[var(--main-sidebar-width)];
}

@media print {
  #printMe {
    zoom: 70%;
  }
}
</style>