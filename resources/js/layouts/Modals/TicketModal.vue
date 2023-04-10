<template>
  <TransitionRoot as="template" :show="open">
    <Dialog as="div" class="relative z-10" @close="open = false">
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
              class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg"
            >
            <div class="grid grid-cols-1" id="printMe" ref="myReference">
              <div class="flex flex-col" >
                <div
                  class="bg-white relative drop-shadow-2xl rounded-3xl p-4 m-4" ref="myReference"
                >
                  <div class="flex-none sm:flex">
                    <div class="relative h-32 w-32 sm:mb-0 mb-3 hidden">
                      <img
                        src="https://tailwindcomponents.com/storage/avatars/njkIbPhyZCftc4g9XbMWwVsa7aGVPajYLRXhEeoo.jpg"
                        alt="aji"
                        class="w-32 h-32 object-cover rounded-2xl"
                      />
                      <a
                        href="#"
                        class="absolute -right-2 bottom-2 -ml-3 text-white p-1 text-xs bg-green-400 hover:bg-green-500 font-medium tracking-wider rounded-full transition ease-in duration-300"
                      >
                        <svg
                          xmlns="http://www.w3.org/2000/svg"
                          viewBox="0 0 20 20"
                          fill="currentColor"
                          class="h-4 w-4"
                        >
                          <path
                            d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"
                          ></path>
                        </svg>
                      </a>
                    </div>
                    <div class="flex-auto justify-evenly">
                      <div class="flex items-center justify-between">
                        <div class="flex flex-col text-lg mx-auto font-bold">
                         Sale No.: {{(payementStore.items.data.id).toString().padStart(5, "0")}}
                        </div>
                      </div>
                      <div class="border-b border-dashed border-b-2 my-5"></div>
                      <div class="flex justify-between">
                        <div class="flex flex-col">
                          <div class="flex-auto text-sm text-gray-400 my-1">
                            <span class="mr-1">Date: </span
                            ><span>{{new Date(payementStore.items.data.created_at).toLocaleDateString('fr-CA')}}</span>
                          </div>

                          <div
                            class="w-full flex-none text-lg text-blue-800 font-bold leading-none mt-2"
                          >
                            <span class="text-gray-500">Customer:</span> {{payementStore.items.customer.name}}
                          </div>
                        </div>
                        <div class="flex ml-auto" id="printop">
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
                            <svg
                              xmlns="http://www.w3.org/2000/svg"
                              viewBox="0 0 448 512"
                            >
                              <!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                              <path
                                d="M0 64C0 28.7 28.7 0 64 0H224V128c0 17.7 14.3 32 32 32H384V304H296 272 184 160c-35.3 0-64 28.7-64 64v80 48 16H64c-35.3 0-64-28.7-64-64V64zm384 64H256V0L384 128zM160 352h24c30.9 0 56 25.1 56 56s-25.1 56-56 56h-8v32c0 8.8-7.2 16-16 16s-16-7.2-16-16V448 368c0-8.8 7.2-16 16-16zm24 80c13.3 0 24-10.7 24-24s-10.7-24-24-24h-8v48h8zm88-80h24c26.5 0 48 21.5 48 48v64c0 26.5-21.5 48-48 48H272c-8.8 0-16-7.2-16-16V368c0-8.8 7.2-16 16-16zm24 128c8.8 0 16-7.2 16-16V400c0-8.8-7.2-16-16-16h-8v96h8zm72-112c0-8.8 7.2-16 16-16h48c8.8 0 16 7.2 16 16s-7.2 16-16 16H400v32h32c8.8 0 16 7.2 16 16s-7.2 16-16 16H400v48c0 8.8-7.2 16-16 16s-16-7.2-16-16V432 368z"
                              />
                            </svg>
                          </button>
                        </div>
                      </div>
                      <div class="border-b border-dashed border-b-2 my-4 pt-5">
                        <div
                          class="absolute rounded-full w-5 h-5 bg-blue-900 -mt-2 -left-2"
                        ></div>
                        <div
                          class="absolute rounded-full w-5 h-5 bg-blue-900 -mt-2 -right-2"
                        ></div>
                      </div>
                      <div
                        class="is-scrollbar-hidden min-w-full overflow-x-auto"
                      >
                        <table x-ref="table" class="w-full text-left">
                          <thead>
                            <tr>
                              <th
                                class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
                              >
                                #
                              </th>
                              <th
                                class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
                              >
                                Product
                              </th>
                              <th
                                class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
                              >
                                Quantity
                              </th>
                              <th
                                class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
                              >
                                SubTotal
                              </th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr v-if="(payementStore.items.products.length) == 0">
                              <td class="whitespace-nowrap px-4 py-3 sm:px-5 text-center">
                                -
                              </td>
                              <td class="whitespace-nowrap px-4 py-3 sm:px-5 text-center">
                                -
                              </td>
                              <td class="whitespace-nowrap px-4 py-3 sm:px-5 text-center">
                                -
                              </td>
                              <td class="whitespace-nowrap px-4 py-3 sm:px-5 text-center">
                                -
                              </td>
                            </tr>
                            <tr v-else v-for="product in payementStore.items.products" :key="product.id">
                              <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                {{ i = i+1  }}
                              </td>
                              <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                {{product.name}}
                              </td>
                              <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                {{product.pivot.quantity}}
                              </td>
                              <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                <div class="flex flex-col">
                                  <span class="semibold">{{product.pivot.price}}</span>
                                  <div class="ml-3 text-sm">DA</div>
                                </div>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                      <div class="flex justify-between mt-3 p-5 text-sm">
                        <div class="flex flex-col">
                          <span class="text-sm">Total Items</span>
                        </div>
                        <div class="flex flex-col">
                          <div class="font-semibold">{{payementStore.items.data.total_items}}</div>
                        </div>
                        <div class="flex flex-col">
                          <span class="text-sm">Total</span>
                        </div>
                        <div class="flex flex-col">
                          <div class="font-semibold">{{payementStore.items.data.sub_total}} DA</div>
                        </div>
                      </div>
                      <div class="flex justify-between p-2 text-sm">
                        <div class="flex flex-col ml-auto">
                          <span class="text-md">Tax</span>
                        </div>
                        <div class="flex flex-col ml-2">
                          <div class="font-semibold text-md">{{payementStore.items.data.tax}} %</div>
                        </div>
                      </div>
                      <div class="flex justify-between mb-5 p-2 text-sm">
                        <div class="flex flex-col ml-auto">
                          <span class="text-md">Discount</span>
                        </div>
                        <div class="flex flex-col ml-2">
                          <div class="font-semibold text-md">{{payementStore.items.data.discount}} %</div>
                        </div>
                      </div>

                      <div class="flex justify-between mb-4 px-5">
                        <div class="flex flex-col text-sm">
                          <span class="font-semibold text-sm">Grand Total</span>
                        </div>

                        <div class="flex flex-col text-sm">
                          <span class="font-semibold text-sm">{{payementStore.items.data.total}} DA</span>
                        </div>
                      </div>

                      <div class="flex justify-between mb-4 px-5" v-if="payementStore.items.data.credit_card_number">
                        <div class="flex flex-col text-sm">
                          <span class="font-semibold text-sm">Credit Card Number:</span>
                        </div>

                        <div class="flex flex-col text-sm">
                          <span class="font-semibold text-lg"
                            >{{payementStore.items.data.credit_card_number}}</span
                          >
                        </div>
                      </div>

                      <div class="flex justify-between mb-4 px-5" v-if="payementStore.items.data.credit_card_holder">
                        <div class="flex flex-col text-sm">
                          <span class="font-semibold text-sm"
                            >Credit Card Holder:</span
                          >
                        </div>

                        <div class="flex flex-col text-sm">
                          <span class="font-semibold text-sm">{{ payementStore.items.data.credit_card_holder }} DA</span>
                        </div>
                      </div>
                      <div class="border-b border-dashed border-b-2 my-5 pt-5">
                        <div
                          class="absolute rounded-full w-5 h-5 bg-blue-900 -mt-2 -left-2"
                        ></div>
                        <div
                          class="absolute rounded-full w-5 h-5 bg-blue-900 -mt-2 -right-2"
                        ></div>
                      </div>
                      <div class="flex justify-between px-5 pt-3 text-sm">
                        <div class="flex flex-col">
                          <div class="font-semibold">{{payementStore.items.user.company_name}}</div>
                        </div>

                        <div class="flex flex-col">
                          <div class="font-semibold">Tel: {{payementStore.items.user.phone}}</div>
                        </div>
                      </div>
                      <div class="flex flex-col py-5 justify-center text-sm">
                        <div
                          class="barcode h-14 w-0 inline-block mt-4 relative left-auto"
                        ></div>
                        <h6 class="font-bold text-center">
                          {{payementStore.items.user.receiptfooter}}
                        </h6>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            </DialogPanel>
          </TransitionChild>
        </div>
      </div>
    </Dialog>
  </TransitionRoot>
</template>
    
    <script setup>
import { ref } from "vue";
import jsPDF from "jspdf";
import {
  Dialog,
  DialogPanel,
  DialogTitle,
  TransitionChild,
  TransitionRoot,
} from "@headlessui/vue";
import { ExclamationTriangleIcon } from "@heroicons/vue/24/outline";
import { usePayementStore } from "../../stores/PayementStores.js";

const payementStore = usePayementStore();
const props = defineProps({
  page_name: String,
  //open: Boolean,
  data:Object
});

const open = ref(true);
var i = - payementStore.items.products.length
const emit = defineEmits(["close"]);
const myReference = ref(null);

function toPdf() {
var doc = new jsPDF();
	
// Source HTMLElement or a string containing HTML.
var elementHTML = document.querySelector("printMe");

doc.html(myReference.value.innerHTML, {
    callback: function(doc) {
        // Save the PDF
        doc.save('tassyir-ticket.pdf');
    },
    x: 2,
    y: 2,
    width: 190, //target width in the PDF document
    windowWidth: 850 //window width in CSS pixels
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
@media print {
  #printMe {
    zoom: 120%;
  }
}

.barcode {
  left: 50%;
  box-shadow: 1px 0 0 1px, 5px 0 0 1px, 10px 0 0 1px, 11px 0 0 1px, 15px 0 0 1px,
    18px 0 0 1px, 22px 0 0 1px, 23px 0 0 1px, 26px 0 0 1px, 30px 0 0 1px,
    35px 0 0 1px, 37px 0 0 1px, 41px 0 0 1px, 44px 0 0 1px, 47px 0 0 1px,
    51px 0 0 1px, 56px 0 0 1px, 59px 0 0 1px, 64px 0 0 1px, 68px 0 0 1px,
    72px 0 0 1px, 74px 0 0 1px, 77px 0 0 1px, 81px 0 0 1px, 85px 0 0 1px,
    88px 0 0 1px, 92px 0 0 1px, 95px 0 0 1px, 96px 0 0 1px, 97px 0 0 1px,
    101px 0 0 1px, 105px 0 0 1px, 109px 0 0 1px, 110px 0 0 1px, 113px 0 0 1px,
    116px 0 0 1px, 120px 0 0 1px, 123px 0 0 1px, 127px 0 0 1px, 130px 0 0 1px,
    131px 0 0 1px, 134px 0 0 1px, 135px 0 0 1px, 138px 0 0 1px, 141px 0 0 1px,
    144px 0 0 1px, 147px 0 0 1px, 148px 0 0 1px, 151px 0 0 1px, 155px 0 0 1px,
    158px 0 0 1px, 162px 0 0 1px, 165px 0 0 1px, 168px 0 0 1px, 173px 0 0 1px,
    176px 0 0 1px, 177px 0 0 1px, 180px 0 0 1px;
  display: inline-block;
  transform: translateX(-90px);
}
</style>