<template>
  <div class="mb-6 ml-3">
    <label
      for="message"
      class="block mb-2 text-sm font-medium"
      :class="{
        'text-gray-900 dark:text-white': errors == null,
        'text-red-700 dark:text-red-500': errors != null,
      }"
      >{{ form_inputs.input }}</label
    >
    <textarea
      id="message"
      rows="4"
      class="
        block
        p-2.5
        w-full
        text-sm
        rounded-lg
        focus:ring-blue-500 focus:border-blue-500
        dark:bg-gray-700
        dark:border-gray-600
        dark:placeholder-gray-400
        dark:text-white
        dark:focus:ring-blue-500
        dark:focus:border-blue-500
      "
      :class="{'bg-red-50 hover:bg-red-50 border border-red-500 text-red-900 dark:text-red-500 dark:border-red-500': (errors != null), 'bg-gray-50 hover:bg-gray-50 border border-gray-300 text-gray-900 dark:border-gray-600 dark:text-white': (errors == null) }"
      placeholder="Write your notes here..."
      v-model="form_value" @focus="errors = null">
    ></textarea>
    <p v-if="errors" class="mt-2 text-sm text-red-600 dark:text-red-500">
      <span class="font-medium">{{ errors }}</span>
    </p>
  </div>
</template>

<script setup>
import { ref, watch } from "vue";

const props = defineProps({
  form_inputs: Object,
  type: String,
  errors: String,
});

const emit = defineEmits(["form"]);
const form_value = ref("");
form_value.value = props.form_inputs.var_edit;

watch(form_value, (value) => {
  emit("form", { value, form_inputs: props.form_inputs.var_model });
});
</script>