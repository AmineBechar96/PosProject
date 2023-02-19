<template>
    <div class="mb-6 ml-3">
        <label for="options" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ title }}</label>
        <select id="options"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-96 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            >
            <option>1</option>
            <option>2</option>
            <option>3</option>
        </select>
    </div>
</template>
<script setup>
import { ref, watch } from 'vue'

const props = defineProps({
    title: String,
    options: Object
})

const emit = defineEmits(["form"])
const form_value = ref("");


watch(form_value, value => {
    emit("form", { value, form_inputs: props.form_inputs.input })
});
</script>