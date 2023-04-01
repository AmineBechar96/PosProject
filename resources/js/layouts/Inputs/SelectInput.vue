<template>
  <div class="mb-6 ml-3">
    <label
      for="options"
      class="block mb-2 text-sm font-medium"
      :class="{
        'text-gray-900 dark:text-white': errors == null,
        'text-red-700 dark:text-red-500': errors != null,
      }"
      >{{ title }}</label
    >
    <select
      id="options"
      v-model="form_value"
      @focus="errors = null"
      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-96 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
    >
      <option v-for="option in data" :key="option.id" :value="option.id">
        {{ option.name }}
      </option>
    </select>
    <p v-if="errors" class="mt-2 text-sm text-red-600 dark:text-red-500">
      <span class="font-medium">{{ errors }}</span>
    </p>
  </div>
</template>
<script setup>
import { ref, watch } from "vue";

const props = defineProps({
  title: String,
  data: Object,
  var_edit: Number,
  var_input: String,
  errors: Object,
});

const emit = defineEmits(["form"]);
const form_value = ref(props.var_edit);

watch(form_value, (value) => {
  emit("form", { value, form_inputs: props.var_input.toLowerCase() + "_id" });
});
</script>