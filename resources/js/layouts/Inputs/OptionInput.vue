<template>
  <div class="grid md:grid-cols-5 md:gap-6">
    <div class="relative z-0 w-full mb-2 group">
      <SelectOptionInput title="Product" class="w-6"></SelectOptionInput>
    </div>
    <div class="relative z-0 w-full mb-2 group">
      <SelectOptionInput title="Option" class="w-6"></SelectOptionInput>
    </div>
    <div class="relative z-0 w-full mt-2 group">
      <input
        type="text"
        name="floating_last_name"
        id="floating_last_name"
        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-red-500 focus:outline-none focus:ring-0 focus:border-red-600 peer"
        placeholder=" "
        required
      />
      <label
        for="floating_last_name"
        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-red-600 peer-focus:dark:text-red-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
        >Quantity</label
      >
    </div>
    <div class="relative z-0 w-full mt-2 group">
      <input
        type="text"
        name="floating_last_name"
        id="floating_last_name"
        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-red-500 focus:outline-none focus:ring-0 focus:border-red-600 peer"
        placeholder=" "
        required
      />
      <label
        for="floating_last_name"
        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-red-600 peer-focus:dark:text-red-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
        >Cost</label
      >
    </div>
    <div class="relative z-0 w-full mt-2 group">
      <input
        type="text"
        name="floating_last_name"
        id="floating_last_name"
        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-red-500 focus:outline-none focus:ring-0 focus:border-red-600 peer"
        placeholder=" "
        required
      />
      <label
        for="floating_last_name"
        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-red-600 peer-focus:dark:text-red-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
        >Price</label
      >
    </div>
  </div>
  <div class="pb-3 sm:flex sm:flex-row mb-6">
    <button
      class="inline-flex w-full justify-center rounded-md border border-transparent bg-red-700 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm"
    >
    <font-awesome-icon :icon="['fas', 'minus']" />
    </button>

    <button
      type="button"
      class="mt-3 inline-flex w-full justify-center rounded-md border border-green-300 bg-white px-4 py-2 text-base font-medium text-green-700 shadow-sm hover:bg-green-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
    >
    <font-awesome-icon :icon="['fas', 'plus']" />
    </button>
  </div>
</template>

<script setup>
import SelectOptionInput from './SelectOptionInput.vue'

const props = defineProps({
    title: String,
    products: Object,
    var_edit: Number,
    var_input: String,
    errors: Object,
  });
</script>