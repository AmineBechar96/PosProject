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
                class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-[800px]"
              >
              <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
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
              <div class="grid">
                <div class="bg-gray-200 my-20 max-w-sm p-6 sm:p-8 w-[600px]">

                </div>
            </div>
            </form>

              </div>
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

</style>