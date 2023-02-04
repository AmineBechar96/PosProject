<template>
    <div class="mb-6 ml-3">
        <label for="base-input" class="block mb-2 text-sm font-medium"
            :class="{ 'text-gray-900 dark:text-white': (errors == null), 'text-red-700 dark:text-red-500': (errors != null) }">{{
                form_inputs.input
            }}</label>
        <input type="text" id="base-input"
            class="w-96 font-semibold text-sm rounded-lg block w-full p-2.5"
            :class="{'bg-red-50 hover:bg-red-50 border border-red-500 text-red-900 dark:text-red-500 dark:border-red-500': (errors != null), 'bg-gray-50 hover:bg-blue-50 border border-gray-300 text-gray-900 dark:border-gray-600 dark:text-white': (errors == null) }"
            v-model="form_value" @focus="errors = null">
            <p v-if="errors" class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">{{ errors }}</span></p>     
    </div>
</template>

<script setup>
import { ref, watch } from 'vue'

const props = defineProps({
    form_inputs: Object,
    errors: String
})

const emit = defineEmits(["form"])
const form_value = ref("");

watch(form_value, value => {
    emit("form", { value, form_inputs: props.form_inputs.input })
});
</script>