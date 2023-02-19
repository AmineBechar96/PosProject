<template>
    <div class="mb-6 ml-3">
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload file</label>
        <input
            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
            aria-describedby="file_input_help" id="file_input" type="file">
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG, JPG or GIF (MAX.
            800x400px).</p>
    </div>
</template>
<script setup>
import { ref, watch } from "vue";

const props = defineProps({
  title: String,
  data: Object,
});

const emit = defineEmits(["form"]);
const form_value = ref("");

watch(form_value, (value) => {
    console.log(value)
  emit("form", { value, form_inputs: props.form_inputs.var_model });
});
</script>