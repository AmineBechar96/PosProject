<template>
  <div class="mb-6 ml-3 w-8">
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
      class="w-16 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
    >
      <option v-for="option in data" :key="option.id" :value="option.id">
        {{ option.name }}
      </option>
    </select>
  </div>
</template>
  <script setup>
import { ref, watch, computed } from "vue";
import { useProductStore } from "../../stores/ProductStores.js";
import { useOptionStore } from "../../stores/OptionStores.js";
import { storeToRefs } from "pinia";

const props = defineProps({
  title: String,
  var_edit: Number,
  var_input: String,
  errors: Object,
});

const productStore = useProductStore();
const optionStore = useOptionStore();
let data;
productStore.getProductData();

const emit = defineEmits(["form"]);
const form_value = ref(props.var_edit);

if (props.title == "Product") {
  data = computed(() => productStore.products);
} else data = computed(() => optionStore.options);

watch(form_value, (value) => {
  if (props.title == "Product") optionStore.getOptionData(value);
  //emit("form", { value, form_inputs: props.var_input.toLowerCase() + "_id" });
});
</script>