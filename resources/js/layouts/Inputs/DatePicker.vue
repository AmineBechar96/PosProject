<template>
  <div class="mb-6 ml-3">
    <label for="date" class="block mb-2 text-sm font-medium"
            :class="{ 'text-gray-900 dark:text-white': (errors == null), 'text-red-700 dark:text-red-500': (errors != null) }">{{
                form_inputs.input }}</label>
    <VueDatePicker
      id="date"
      class="w-96"
      v-model="date"
      @focus="errors = null"
      placeholder="Start Typing ..."
      date
    />
    <p v-if="errors" class="mt-2 text-sm text-red-600 dark:text-red-500">
      <span class="font-medium">{{ errors }}</span>
    </p>
  </div>
  
</template>

<script setup>
import { ref, watch } from 'vue'

const props = defineProps({
    form_inputs: Object,
    errors: String
})

const emit = defineEmits(["form"])
const date = ref();
date.value = props.form_inputs.var_edit

watch(date, value => {
    const day = value.getDate();
    const month = value.getMonth() + 1;
    const year = value.getFullYear();
    value = `${year}-${month}-${day}`;
    emit("form", { value, form_inputs: props.form_inputs.var_model })
});
</script>
